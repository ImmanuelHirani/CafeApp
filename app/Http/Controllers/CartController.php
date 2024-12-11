<?php

namespace App\Http\Controllers;

use App\Models\MenuProperties;
use App\Models\tempTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function AddToCart(Request $request)
    {

        // Pastikan pengguna sudah login
        $customer = Auth::user();
        if (!$customer) {
            return redirect()->back()->with('error', 'Login First!');
        }


        $request->validate([
            'menu_ID' => 'required|exists:menu_items,menu_ID',
            'customer_ID' => 'required|exists:customers,customer_ID', // Sesuaikan nama tabel customer
            'size' => 'required|string',
            'quantity' => 'required|integer|min:1|max:2',
        ]);

        // Cek apakah menu yang sama sudah ada di keranjang untuk customer yang sama
        $existingItem = tempTransaction::where('menu_ID', $request->menu_ID)
            ->where('customer_ID', $request->customer_ID)
            ->first();

        if ($existingItem) {
            return redirect()->back()->withErrors(['menu' => 'menu already in your cart.']);
        }

        // Ambil data property (size dan price) berdasarkan menu_ID dan size
        $property = MenuProperties::where('menu_ID', $request->menu_ID)
            ->where('size', $request->size)
            ->first();

        if (!$property) {
            return redirect()->back()->withErrors(['size' => 'Invalid size selected.']);
        }

        // Cek apakah quantity lebih dari 2
        $quantity = $request->quantity;
        if ($quantity > 2) {
            return redirect()->back()->withErrors(['quantity' => 'Maximum quantity is 2.']);
        }

        // Hitung subtotal
        $subtotal = $quantity * $property->price;

        // Simpan ke tabel temp_transaction_order
        tempTransaction::create([
            'menu_ID' => $request->menu_ID,
            'customer_ID' => $request->customer_ID,
            'size' => $property->size,
            'quantity' => $quantity,
            'subtotal' => $subtotal,
        ]);

        return redirect()->back()->with('success', 'Menu Added ');
    }

    public function deleteCart($tempID)
    {
        // Cari item berdasarkan temp_ID
        $item = tempTransaction::find($tempID);

        // Jika item tidak ditemukan, kembalikan error
        if (!$item) {
            return response()->json(['success' => false, 'message' => 'Item not found.']);
        }

        // Hapus item dari keranjang
        $item->delete();

        // Hitung total subtotal sisa keranjang
        $totalSubtotal = tempTransaction::where('customer_ID', Auth::id())->sum('subtotal');

        // Kembalikan respons sukses
        return response()->json([
            'success' => true,
            'message' => 'Item removed from cart.',
            'totalSubtotal' => $totalSubtotal
        ]);
    }

    public function updateCartQuantity(Request $request, $tempID)
    {
        // Cari item berdasarkan temp_ID
        $item = tempTransaction::find($tempID);

        // Jika item tidak ditemukan, kembalikan error
        if (!$item) {
            return response()->json(['success' => false, 'message' => 'Item not found.']);
        }

        // Ambil harga berdasarkan menu_ID dan size
        $property = MenuProperties::where('menu_ID', $item->menu_ID)
            ->where('size', $item->size)
            ->first();

        // Jika property tidak ditemukan, kembalikan error
        if (!$property) {
            return response()->json(['success' => false, 'message' => 'Size not found for this menu.']);
        }

        // Validasi kuantitas
        if ($request->quantity > 2) {
            return response()->json([
                'success' => false,
                'message' => 'Maximum quantity is 2.',
                'currentQuantity' => $item->quantity
            ]);
        }

        if ($request->quantity < 1) {
            return response()->json([
                'success' => false,
                'message' => 'Minimum quantity is 1.',
                'currentQuantity' => $item->quantity
            ]);
        }


        // Update kuantitas item
        $item->quantity = $request->quantity;

        // Hitung ulang subtotal berdasarkan kuantitas dan harga properti
        $item->subtotal = $item->quantity * $property->price;
        $item->save();

        // Hitung total subtotal sisa keranjang
        $totalSubtotal = tempTransaction::where('customer_ID', Auth::id())->sum('subtotal');

        // Kembalikan respons sukses dengan data terbaru
        return response()->json([
            'success' => true,
            'message' => 'Quantity updated successfully.',
            'quantity' => $item->quantity,
            'subtotal' => $item->subtotal,
            'totalSubtotal' => $totalSubtotal,
            'price' => $property->price
        ]);
    }

    public function cartMenu()
    {
        $customer = Auth::user();
        if (!$customer) {
            return redirect()->back()->with('error', 'Login First!');
        }

        $customerID = $customer->customer_ID;
        $temp_cart = tempTransaction::where('customer_ID', $customerID)->with('menu')->get();

        if ($temp_cart->isEmpty()) {
            return redirect('/menu')->with('error', 'Your cart is empty. Please add some menu.');
        }

        $totalSubtotal = $temp_cart->sum('subtotal');

        // Ambil lokasi utama dari relasi
        $primaryLocation = $customer->locationCustomer->firstWhere('is_primary', 1);

        return view('Frontend.cart', [
            'customer' => $customer,
            'temp_cart' => $temp_cart,
            'totalSubtotal' => $totalSubtotal,
            'primaryLocation' => $primaryLocation, // Kirim lokasi utama ke Blade
        ]);
    }
}
