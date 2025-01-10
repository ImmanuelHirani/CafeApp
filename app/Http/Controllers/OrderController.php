<?php

namespace App\Http\Controllers;

use App\Models\Custom_categories_pizza;
use App\Models\Custom_categories_properties;
use App\Models\Custom_categories_size_properties;
use App\Models\Customer;
use App\Models\Location;
use App\Models\Menu;
use App\Models\menus;
use App\Models\orderTransaction;
use App\Models\tempTransaction;
use App\Models\transaction;
use App\Models\transaction_details;
use App\Models\transaction_location;
use App\Models\transactionDetails;
use App\Models\transactionLocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Repository\orderRepo;
use App\Services\OrderService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function payment()
    {
        $customer = Auth::user();
        if (!$customer) {
            return redirect()->back()->with('error', 'Login First!');
        }

        $menus = menus::with('properties')->get();

        $customerID = $customer->user_ID;

        // Fetch order transactions with their details and menu
        $orderTransactions = transaction::with(['details.menu'])
            ->where('user_ID', $customerID)
            ->where('status_order', 'in-progress') // Hanya transaksi dengan status "in-progress"
            ->get();

        if ($orderTransactions->isEmpty()) {
            return redirect()->route('frontend.menu')->with('error', 'No order transaction');
        }

        // Tambahkan subtotal untuk setiap transaksi
        $orderTransactions = $orderTransactions->map(function ($orderTransaction) {
            $subtotal = $orderTransaction->details->sum(function ($detail) {
                return $detail->price * $detail->quantity;
            });

            // Tambahkan subtotal ke objek transaksi
            $orderTransaction->subtotal = $subtotal;

            return $orderTransaction;
        });

        return view('Frontend.payment', [
            'orderTransactions' => $orderTransactions,
            'menus' => $menus,
        ]);
    }

    public function trackOrder($transactionID)
    {
        $customer = Auth::user();
        if (!$customer) {
            return redirect()->back()->with('error', 'Login First!');
        }

        $customerID = $customer->user_ID;

        // Fetch order transactions by transaction_ID and status
        $orderTransactions = transaction_details::whereHas('order', function ($query) use ($customerID, $transactionID) {
            $query->where('user_ID', $customerID)
                ->where('transaction_ID', $transactionID) // Filter by transaction_ID
                ->whereIn('status_order', ['paid', 'serve', 'shipped', 'completed', 'canceled']);
        })->with(['menu', 'order.location'])->get();

        if ($orderTransactions->isEmpty()) {
            return redirect()->route('frontend.menu')->with('error', 'No order transaction found.');
        }

        $menus = menus::all();


        $totalSubtotal = $orderTransactions->sum('subtotal');

        return view('Frontend.order-details', [
            'orderTransactions' => $orderTransactions,
            'totalSubtotal' => $totalSubtotal,
            'menus' => $menus
        ]);
    }

    public function adminOrder()
    {

        // Ambil data user dari database menggunakan guard 'admin'
        $user = Auth::guard('admin')->user();

        // Validasi apakah user valid dan memiliki user_type admin atau owner
        if (!$user || !in_array($user->user_type, ['admin', 'owner'])) {
            return redirect()->route('admin.auth')->with('error', 'Login First');
        }

        $orderCustomers = transaction::with(['user', 'details.menu'])->get();

        // Kirim data ke view
        return view('Backend.Admin-Order', [
            'orderCustomers' => $orderCustomers,
        ]);
    }

    public function getCustomerOrderDetails($id)
    {
        // Ambil data orderTransaction berdasarkan transaction_ID, termasuk relasi customer, details.menu, dan location
        $orderDetails = transaction::with([
            'user',        // Relasi ke customer
            'details.menu',    // Relasi ke menu dalam details
            'location'         // Relasi ke location
        ])->find($id);        // Menemukan berdasarkan transaction_ID

        // Periksa apakah order ditemukan
        if (!$orderDetails) {
            return response()->json([
                'message' => 'Order not found',
            ], 404);
        }

        // Ambil data orderCustomers yang mencakup semua orderTransaction dengan relasi customer, details.menu, dan location
        $orderCustomers = transaction::with([
            'user',        // Relasi ke customer
            'details.menu',    // Relasi ke menu dalam details
            'location'         // Relasi ke location
        ])->get();            // Menampilkan semua data orderTransaction

        // Kembalikan data ke view atau dalam bentuk JSON
        return view('Backend.Admin-Order', [
            'orderDetails' => $orderDetails,
            'orderCustomers' => $orderCustomers,
        ]);
    }

    public function updateStatus(Request $request, $transactionID)
    {
        // Validasi input status
        $validated = $request->validate([
            'status_order' => 'required|string|in:pending,in-progress,paid,serve,shipped,completed,canceled',
        ]);

        // Temukan order transaction berdasarkan order ID
        $orderTransaction = transaction::where('transaction_ID', $transactionID)->first();

        if ($orderTransaction) {
            // Update status_order dengan nilai yang dipilih
            $orderTransaction->status_order = $request->status_order;
            $orderTransaction->save(); // simpan perubahan

            // Kembalikan response sukses
            return back()->with('success', 'updated.');
        } else {
            // Jika order tidak ditemukan
            return back()->with('error', 'Order not found.');
        }
    }

    public function cancelOrder($transactionID)
    {
        // Find the order by its ID
        $orderTransaction = transaction::find($transactionID);

        if (!$orderTransaction) {
            // If the order does not exist, redirect back with an error message
            return redirect()->back()->with('error', 'Order not found.');
        }

        // Update the status of the order to 'canceled'
        $orderTransaction->status_order = 'canceled';
        $orderTransaction->save();

        // Redirect back with a success message
        return redirect()->Route('frontend.menu')->with('error', 'Order canceled');
    }

    public function payOrder($transactionID)
    {
        // Mendapatkan user yang login
        $customer = Auth::user();

        if (!$customer) {
            return redirect()->back()->with('error', 'You need to login to make an order.');
        }

        // Find the order by its ID
        $orderTransaction = transaction::find($transactionID);

        if (!$orderTransaction) {
            return redirect()->back()->with('error', 'Order not found.');
        }

        // Update the status of the order to 'paid'
        $orderTransaction->status_order = 'paid';
        $orderTransaction->save();

        // Ambil lokasi utama customer
        $primaryLocation = Location::where('user_ID', $customer->user_ID)
            ->where('is_primary', 1)
            ->first();

        if (!$primaryLocation) {
            return redirect()->back()->with('error', 'No primary address found.');
        }

        // Menyimpan data lokasi ke tabel order_transaction_location
        transaction_location::create([
            'transaction_ID' => $orderTransaction->transaction_ID,
            'location_label' => $primaryLocation->location_label,
            'reciver_address' => $primaryLocation->reciver_address,
            'reciver_number' => $primaryLocation->reciver_number,
            'reciver_name' => $primaryLocation->reciver_name,
        ]);

        // Mengurangi stok untuk setiap item di transactionDetails
        foreach ($orderTransaction->details as $detail) {
            // Ambil menu terkait
            $menu = $detail->menu;

            // Kurangi stok menu berdasarkan quantity yang dipesan
            if ($menu) {
                $menu->stock -= $detail->quantity;

                // Pastikan stok tidak negatif
                if ($menu->stock < 0) {
                    $menu->stock = 0;
                }

                $menu->save();
            }
        }

        // Redirect ke tracking view dengan transaction_ID
        return redirect()->route('order-details.view', ['transactionID' => $orderTransaction->transaction_ID])
            ->with('success', 'Order has been paid.');
    }
}
