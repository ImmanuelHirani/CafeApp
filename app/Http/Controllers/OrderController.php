<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\tempTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Repository\orderRepo;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    private orderRepo $orderRepo;

    public function __construct(orderRepo $orderRepo)
    {
        $this->orderRepo = $orderRepo;
    }
    public function AddToCart(Request $request)
    {
        try {
            $customer = Auth::user();
            if (!$customer) {
                return redirect()->back()->with('error', 'You Must Login First!.');
            }

            $customerID = $customer->customer_ID;

            $validated = $request->validate([
                'menu_ID' => 'required|integer',
                'quantity' => 'required|integer|min:1|max:2',
            ]);

            $existingItem = tempTransaction::where('menu_ID', $validated['menu_ID'])
                ->where('customer_ID', $customerID)
                ->first();

            if ($existingItem) {
                $menu = $existingItem->menu;
                if (!$menu) {
                    return redirect()->back()->with('error', 'Menu Not Found.');
                }

                // Menambahkan pengecekan agar tidak melebihi jumlah maksimal (2)
                if ($existingItem->quantity >= 2) {
                    return redirect()->back()->with('error', 'Max Qty 2');
                }

                // Jika kuantitas lebih dari batas, sesuaikan
                $newQuantity = $existingItem->quantity + $validated['quantity'];
                if ($newQuantity > 2) {
                    $newQuantity = 2;
                }

                $existingItem->quantity = $newQuantity;
                $existingItem->subtotal = $menu->price * $newQuantity;
                $existingItem->save();

                return redirect()->back()->with('success', 'Cart Updated');
            }

            // Jika item belum ada di keranjang
            $menuDetails = Menu::findOrFail($validated['menu_ID']);
            $subtotal = $menuDetails->price * $validated['quantity'];

            $data = [
                'menu_ID' => $validated['menu_ID'],
                'customer_ID' => $customerID,
                'quantity' => $validated['quantity'],
                'subtotal' => $subtotal,
            ];

            // Tambahkan item baru ke keranjang
            $this->orderRepo->add($data);

            return redirect()->back()->with('success', 'Menu Added');
        } catch (\Exception $e) {
            Log::error('Add to Cart Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something Wrongs');
        }
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
        $cartItems = tempTransaction::where('customer_ID', $customerID)->with('menu')->get();
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
        $totalSubtotal = $temp_cart->sum('subtotal');
        return view('Frontend.cart', [
            'temp_cart' => $temp_cart,
            'totalSubtotal' => $totalSubtotal, // Total keseluruhan subtotal
        ]);
    }
    public function payment()
    {
        // Pastikan pengguna sudah login
        $customer = Auth::user();
        if (!$customer) {
            return redirect()->back()->with('error', 'Login First !');
        }

        $customerID = $customer->customer_ID;
        $temp_cart = tempTransaction::where('customer_ID', $customerID)->with('menu')->get();
        $totalSubtotal = $temp_cart->sum('subtotal');
        return view('Frontend.payment', [
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

        $temp_cart->delete();

        return response()->json([
            'success' => true,
            'message' => 'deleted successfully.',
        ]);
    }
    public function updateCart($id, Request $request)
    {
        try {
            $temp_cart = tempTransaction::find($id);

            if (!$temp_cart) {
                return response()->json(['error' => 'Menu not found.'], 404);
            }

            $quantity = $request->input('quantity');

            // Validate quantity (limit it to 1 and 2)
            if ($quantity < 1) {
                return response()->json(['error' => 'Min Qty 1.'], 400);
            }

            if ($quantity > 2) {
                return response()->json(['error' => 'Maximal Qty 2.'], 400);
            }

            // Update the quantity and recalculate the subtotal
            $temp_cart->quantity = $quantity;
            $temp_cart->subtotal = $temp_cart->menu->price * $quantity;
            $temp_cart->save();

            return response()->json([
                'success' => 'Updated Successfully',
                'quantity' => $temp_cart->quantity,
                'subtotal' => number_format($temp_cart->subtotal, 0, ',', '.'),  // Format the subtotal for display
            ]);
        } catch (\Exception $e) {
            Log::error('Menu update error: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to update: ' . $e->getMessage()], 500);
        }
    }
}
