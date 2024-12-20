<?php

namespace App\Http\Controllers;

use App\Models\Custom_categories_pizza;
use App\Models\Custom_categories_properties;
use App\Models\Custom_categories_size_properties;
use App\Models\Customer;
use App\Models\Menu;
use App\Models\orderTransaction;
use App\Models\tempTransaction;
use App\Models\transactionDetails;
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
            ->where('status_order', 'pendding')
            ->get(); // Get all records, not just the first one


        if (!$orderTransactions || $orderTransactions->isEmpty()) {
            // Redirect to another page if no order transaction with status "pending" found
            return redirect()->route('frontend.menu')->with('error', 'No order transaction found!');
        }


        // Prepare an array of subtotal for each order transaction
        $orderTransactions = $orderTransactions->map(function ($orderTransaction) {
            $subtotal = $orderTransaction->details->sum(function ($detail) {
                return $detail->price * $detail->quantity;
            });

            // Add subtotal to the order transaction object for easier access in the view
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

    public function trackOrder()
    {

        $menus = Menu::all();

        return view('Frontend.Tracking-order', [
            'menus' => $menus,
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
        // Ambil data customer berdasarkan ID, termasuk relasi orderTransaction dan orderDetails
        $orderCustomers = orderTransaction::with(['customer', 'details.menu'])->get();
        // Ambil data order berdasarkan order_ID, termasuk relasi customer dan details.menu
        $orderDetails = orderTransaction::with(['customer', 'details.menu'])->find($id);

        // Periksa apakah order ditemukan
        if (!$orderDetails) {
            return response()->json([
                'message' => 'Order not found',
            ], 404);
        }

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
            'status_order' => 'required|string|in:pending,in-progress,completed,canceled',
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
        // Find the order by its ID
        $orderTransaction = OrderTransaction::find($orderId);

        if (!$orderTransaction) {
            // If the order does not exist, redirect back with an error message
            return redirect()->back()->with('error', 'Order not found.');
        }

        // Update the status of the order to 'canceled'
        $orderTransaction->status_order = 'in-progress';
        $orderTransaction->save();

        // Redirect back with a success message
        return redirect()->Route('tracking.view')->with('success', 'Order has been Pay.');
    }
}
