<?php

namespace App\Http\Controllers;

use App\Models\Custom_categories_pizza;
use App\Models\Custom_categories_properties;
use App\Models\Custom_categories_size_properties;
use App\Models\Customer;
use App\Models\Location;
use App\Models\Menu;
use App\Models\orderTransaction;
use App\Models\tempTransaction;
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
    private $orderRepo;
    protected $orderService;

    public function __construct(orderRepo $orderRepo, OrderService $orderService)
    {
        $this->orderRepo = $orderRepo;
        $this->orderService = $orderService;
    }
    public function payment()
    {
        $customer = Auth::user();
        if (!$customer) {
            return redirect()->back()->with('error', 'Login First!');
        }

        $customerID = $customer->customer_ID;

        // Fetch order transactions with their details and menu
        $orderTransactions = orderTransaction::with(['details.menu'])
            ->where('customer_ID', $customerID)
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
        ]);
    }

    public function makeOrder()
    {
        $result = $this->orderService->makeOrder();

        if ($result['status']) {
            return redirect('/payment')->with('success', $result['message']);
        } else {
            return redirect()->back()->with('error', $result['message']);
        }
    }

    public function trackOrder($orderID)
    {
        $customer = Auth::user();
        if (!$customer) {
            return redirect()->back()->with('error', 'Login First!');
        }

        $customerID = $customer->customer_ID;

        // Fetch order transactions by order_ID and status
        $orderTransactions = transactionDetails::whereHas('order', function ($query) use ($customerID, $orderID) {
            $query->where('customer_ID', $customerID)
                ->where('order_ID', $orderID) // Filter by order_ID
                ->whereIn('status_order', ['paid', 'serve', 'shipped', 'completed']);
        })->with(['menu', 'order.location'])->get();

        if ($orderTransactions->isEmpty()) {
            return redirect()->route('frontend.menu')->with('error', 'No order transaction found.');
        }

        $menus = Menu::all();


        $totalSubtotal = $orderTransactions->sum('subtotal');

        return view('Frontend.Tracking-order', [
            'orderTransactions' => $orderTransactions,
            'totalSubtotal' => $totalSubtotal,
            'menus' => $menus
        ]);
    }

    public function adminOrder()
    {

        $orderCustomers = orderTransaction::with(['customer', 'details.menu'])->get();

        // Kirim data ke view
        return view('Backend.Admin-Order', [
            'orderCustomers' => $orderCustomers,
        ]);
    }

    public function getCustomerOrderDetails($id)
    {
        // Ambil data orderTransaction berdasarkan order_ID, termasuk relasi customer, details.menu, dan location
        $orderDetails = orderTransaction::with([
            'customer',        // Relasi ke customer
            'details.menu',    // Relasi ke menu dalam details
            'location'         // Relasi ke location
        ])->find($id);        // Menemukan berdasarkan order_ID

        // Periksa apakah order ditemukan
        if (!$orderDetails) {
            return response()->json([
                'message' => 'Order not found',
            ], 404);
        }

        // Ambil data orderCustomers yang mencakup semua orderTransaction dengan relasi customer, details.menu, dan location
        $orderCustomers = orderTransaction::with([
            'customer',        // Relasi ke customer
            'details.menu',    // Relasi ke menu dalam details
            'location'         // Relasi ke location
        ])->get();            // Menampilkan semua data orderTransaction

        // Kembalikan data ke view atau dalam bentuk JSON
        return view('Backend.Admin-Order', [
            'orderDetails' => $orderDetails,
            'orderCustomers' => $orderCustomers,
        ]);
    }


    public function updateStatus(Request $request, $orderID)
    {
        // Validasi input status
        $validated = $request->validate([
            'status_order' => 'required|string|in:pending,in-progress,paid,serve,shipped,completed,canceled',
        ]);

        // Temukan order transaction berdasarkan order ID
        $orderTransaction = OrderTransaction::where('order_ID', $orderID)->first();

        if ($orderTransaction) {
            // Update status_order dengan nilai yang dipilih
            $orderTransaction->status_order = $request->status_order;
            $orderTransaction->save(); // simpan perubahan

            // Kembalikan response sukses
            return back()->with('success', 'Order status updated.');
        } else {
            // Jika order tidak ditemukan
            return back()->with('error', 'Order not found.');
        }
    }

    public function cancelOrder($orderId)
    {
        // Find the order by its ID
        $orderTransaction = OrderTransaction::find($orderId);

        if (!$orderTransaction) {
            // If the order does not exist, redirect back with an error message
            return redirect()->back()->with('error', 'Order not found.');
        }

        // Update the status of the order to 'canceled'
        $orderTransaction->status_order = 'canceled';
        $orderTransaction->save();

        // Redirect back with a success message
        return redirect()->Route('frontend.menu')->with('error', 'Order has been canceled');
    }

    public function payOrder($orderId)
    {
        // Mendapatkan user yang login
        $customer = Auth::user();

        if (!$customer) {
            return redirect()->back()->with('error', 'You need to login to make an order.');
        }

        // Find the order by its ID
        $orderTransaction = OrderTransaction::find($orderId);

        if (!$orderTransaction) {
            return redirect()->back()->with('error', 'Order not found.');
        }

        // Update the status of the order to 'paid'
        $orderTransaction->status_order = 'paid';
        $orderTransaction->save();

        // Ambil lokasi utama customer
        $primaryLocation = Location::where('customer_ID', $customer->customer_ID)
            ->where('is_primary', 1)
            ->first();

        if (!$primaryLocation) {
            return redirect()->back()->with('error', 'No primary address found.');
        }

        // Menyimpan data lokasi ke tabel order_transaction_location
        transactionLocation::create([
            'order_ID' => $orderTransaction->order_ID,
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

        // Redirect ke tracking view dengan order_ID
        return redirect()->route('tracking.view', ['orderID' => $orderTransaction->order_ID])
            ->with('success', 'Order has been paid.');
    }
}
