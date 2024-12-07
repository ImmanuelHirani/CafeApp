<?php

namespace App\Http\Controllers;

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
    public function AddToCart(Request $request)
    {
        $customer = Auth::user();
        if (!$customer) {
            return redirect()->back()->with('error', 'You Must Login First!');
        }

        $validated = $request->validate([
            'menu_ID' => 'required|integer',
            'quantity' => 'required|integer|min:1|max:2',
        ]);

        $response = $this->orderService->addToCart($customer->customer_ID, $validated['menu_ID'], $validated['quantity']);

        if (isset($response['error'])) {
            return redirect()->back()->with('error', $response['error']);
        }

        return redirect()->back()->with('success', $response['success']);
    }
    public function getCartItems()
    {
        try {
            $customerID = Auth::user()->customer_ID; // Asumsi menggunakan autentikasi
            $cartItems = tempTransaction::where('customer_ID', $customerID)->with('menu')->get();
            return response()->json(['cartItems' => $cartItems], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error fetching cart items: ' . $e->getMessage()], 500);
        }
    }
    public function showCartSidebar()
    {
        $customerID = Auth::user()->customer_ID;
        $cartItems = tempTransaction::where('customer_ID', $customerID)
            ->with('menu')
            ->get();
        return view('layout.Sidebar', compact('cartItems'));
    }
    public function cartMenu()
    {
        // Pastikan pengguna sudah login
        $customer = Auth::user();
        if (!$customer) {
            return redirect()->back()->with('error', 'Login First!');
        }

        $customerID = $customer->customer_ID;
        $temp_cart = tempTransaction::where('customer_ID', $customerID)->with('menu')->get();

        // Cek jika tidak ada item di temp_cart
        if ($temp_cart->isEmpty()) {
            return redirect('/menu')->with('error', 'Your cart is empty. Please add some menu.');
        }

        $totalSubtotal = $temp_cart->sum('subtotal');
        return view('Frontend.cart', [
            'temp_cart' => $temp_cart,
            'totalSubtotal' => $totalSubtotal, // Total keseluruhan subtotal
        ]);
    }
    public function deleteCart($id)
    {
        $temp_cart = tempTransaction::find($id);

        if (!$temp_cart) {
            return response()->json([
                'success' => false,
                'message' => 'Item not found.',
            ]);
        }

        // Get the customer ID before deleting
        $customer = $temp_cart->customer_ID;

        // Delete the item
        $temp_cart->delete();

        // Calculate the new total subtotal for the customer
        $totalSubtotal = tempTransaction::where('customer_ID', $customer)
            ->sum('subtotal');

        return response()->json([
            'success' => true,
            'message' => 'Deleted successfully.',
            'totalSubtotal' => number_format($totalSubtotal, 0, ',', '.') // Format the total subtotal
        ]);
    }
    public function payment()
    {
        $customer = Auth::user();
        if (!$customer) {
            return redirect()->back()->with('error', 'Login First!');
        }
        $customerID = $customer->customer_ID;

        // Ambil order transaction yang terakhir untuk customer tersebut
        $orderTransaction = orderTransaction::with(['details.menu'])
            ->where('customer_ID', $customerID)
            ->first();

        if (!$orderTransaction) {
            // Redirect ke halaman lain jika tidak ada order transaction
            return redirect()->route('/menu')->with('error', 'No order transaction found!');
        }

        $orderDetails = $orderTransaction->details;

        if ($orderDetails->isEmpty()) {
            // Redirect ke halaman keranjang jika order details kosong
            return redirect()->route('/menu')->with('error', 'No order details found!');
        }

        return view('Frontend.payment', [
            'orderTransaction' => $orderTransaction,
            'orderDetail' => $orderDetails,
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
    public function updateCart($id, Request $request)
    {
        $quantity = $request->input('quantity');

        $response = $this->orderService->updateCart($id, $quantity);

        if (isset($response['error'])) {
            return response()->json(['error' => $response['error']], $response['status']);
        }

        return response()->json($response);
    }

    public function trackOrder()
    {

        $menus = Menu::all();

        return view('Frontend.Tracking-order', [
            'menus' => $menus,
        ]);
    }
}
