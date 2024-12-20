<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\MenuProperties;
use App\Models\orderTransaction;
use App\Models\orderTranscationDetails;
use App\Models\transactionDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{

    public function AddToCart(Request $request)
    {
        // Validasi Customer Login
        $customer = Auth::user();
        if (!$customer) {
            return redirect()->back()->with('error', 'Login First!');
        }

        // Validasi Menu ID
        $menu = Menu::find($request->menu_ID);
        if (!$menu) {
            return redirect()->back()->with('error', 'Menu not found.');
        }

        // Validasi Stock Menu
        if ($menu->stock <= 0 || $request->quantity > $menu->stock) {
            $message = $menu->stock <= 0
                ? 'Stock is 0.'
                : 'Insufficient stock. Only ' . $menu->stock . ' left.';
            return redirect()->back()->with('error', $message);
        }

        // Validasi Input
        $request->validate([
            'customer_ID' => 'required|exists:customers,customer_ID',
            'size' => 'required|string',
            'quantity' => 'required|integer|min:1|max:2',
        ]);

        // Cek Properti Menu Berdasarkan Ukuran
        $property = MenuProperties::where('menu_ID', $request->menu_ID)
            ->where('size', $request->size)
            ->first();

        if (!$property) {
            return redirect()->back()->withErrors(['size' => 'Invalid size selected.']);
        }

        $quantity = $request->quantity;
        $total_amount = $quantity * $property->price;

        DB::beginTransaction();

        try {
            // Cek atau Buat Transaksi Baru
            $Transaction = orderTransaction::where('customer_ID', $customer->customer_ID)
                ->where('status_order', 'pending') // Pastikan status "pending"
                ->first();

            if (!$Transaction) {
                $Transaction = orderTransaction::create([
                    'customer_ID' => $customer->customer_ID,
                    'order_type' => 'normal_menu',
                    'total_amounts' => $total_amount,
                    'status_order' => 'pending', // Set status "pending"
                ]);
            } else {
                $Transaction->total_amounts += $total_amount;
                $Transaction->save();
            }

            // Cek Duplikasi Menu dalam Transaksi
            $existingDetail = transactionDetails::where('order_ID', $Transaction->order_ID)
                ->where('menu_ID', $request->menu_ID)
                ->first();

            if ($existingDetail) {
                return redirect()->back()->with('error', 'Menu Already Added.');
            }

            // Tambahkan Item ke Detil Transaksi
            transactionDetails::create([
                'order_ID' => $Transaction->order_ID,
                'menu_ID' => $request->menu_ID,
                'size' => $request->size,
                'menu_name' => $menu->name,
                'quantity' => $quantity,
                'subtotal' => $total_amount,
            ]);

            DB::commit();
            return redirect()->back()->with('success', 'Menu added to cart.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to add menu to cart. Please try again.');
        }
    }

    public function store(Request $request)
    {
        // // Debugging: Menampilkan semua data yang diterima
        // dd($request->all());

        // Validasi Customer Login
        $customer = Auth::user();

        // Validasi input
        $request->validate([
            'size_name' => 'required|string',
            'toppings' => 'required|string',
            'total_price' => 'required|numeric',
        ]);

        // Ambil data dari request
        $size = $request->input('size_name');
        $toppings = $request->input('toppings');
        $totalPrice = $request->input('total_price');

        // Buat transaksi baru pada orderTransaction
        $order = orderTransaction::create([
            'order_type' => 'custom_menu',
            'customer_ID' => $customer->customer_ID,
            'status' => 'pending',
            'total_amounts' => $totalPrice,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Buat detail transaksi untuk setiap topping
        $toppingList = explode(', ', $toppings);  // Mengubah topping menjadi array
        foreach ($toppingList as $topping) {
            transactionDetails::create([
                'order_ID' => $order->order_ID,
                'menu_ID' => -99,  // Custom menu, set menu_ID ke -99
                'size' => $size,
                'menu_name' => $topping,  // Menggunakan nama topping sebagai menu_name
                'quantity' => 1,  // Bisa disesuaikan jika quantity tersedia
                'subtotal' => $totalPrice,  // Sesuaikan subtotal jika perlu
            ]);
        }

        // Menyusun respons
        return response()->json([
            'order_ID' => $order->order_ID,
            'total_price' => $totalPrice,
            'toppings' => $toppingList,
            'size_name' => $size,
            'status' => 'pending',
        ]);
    }


    public function deleteCart($orderDetailID)
    {
        // Cari item berdasarkan orderDetailID
        $item = transactionDetails::find($orderDetailID);

        // Jika item tidak ditemukan, kembalikan error
        if (!$item) {
            return response()->json(['success' => false, 'message' => 'Item not found.']);
        }

        // Ambil order_ID dari item
        $orderID = $item->order_ID;

        // Hapus item dari keranjang
        $item->delete();

        // Hitung Total Subtotal Setelah Penambahan Item
        $totalSubtotal = transactionDetails::where('order_ID', $orderID)->sum('subtotal');

        // Update total_amount di tabel order_transaction
        $orderTransaction = orderTransaction::where('order_ID', $orderID)->first();
        if ($orderTransaction) {
            $orderTransaction->total_amounts = $totalSubtotal; // Perbarui total_amount
            $orderTransaction->save();
        }

        // Periksa apakah masih ada item dalam order
        $remainingItems = transactionDetails::where('order_ID', $orderID)->count();

        // Jika tidak ada item lagi dalam order, hapus order tersebut
        if ($remainingItems === 0) {
            $order = orderTransaction::find($orderID);
            if ($order) {
                $order->delete();
            }
        }

        // Kembalikan respons sukses dengan total subtotal yang baru
        return response()->json([
            'success' => true,
            'message' => 'Item removed from cart.',
            'totalSubtotal' => $totalSubtotal
        ]);
    }

    public function updateCartQuantity(Request $request, $orderDetailID)
    {
        // Cari item berdasarkan order_detail_ID yang diterima melalui parameter
        $item = transactionDetails::find($orderDetailID); // find() mencari berdasarkan primary key

        // Jika item tidak ditemukan, kembalikan error
        if (!$item) {
            return response()->json(['success' => false, 'message' => 'Item not found.']);
        }

        // Ambil harga berdasarkan menu_ID dan size
        $property = MenuProperties::where('menu_ID', $item->menu_ID)
            ->where('size', $item->size)
            ->first();

        if (!$property) {
            return response()->json(['success' => false, 'message' => 'Size not found for this menu.']);
        }

        // Cari menu untuk memeriksa stok
        $menu = Menu::where('menu_ID', $item->menu_ID)->first();
        if (!$menu) {
            return response()->json(['success' => false, 'message' => 'Menu not found.']);
        }

        // Validasi stok berdasarkan kuantitas yang baru
        if ($request->quantity > $menu->stock) {
            return response()->json([
                'success' => false,
                'message' => 'Insufficient stock. Only ' . $menu->stock . ' left.',
                'currentQuantity' => $item->quantity
            ]);
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

        // Update kuantitas dan hitung ulang subtotal
        $item->quantity = $request->quantity;
        $item->subtotal = $item->quantity * $property->price;
        $item->save();

        // Hitung total subtotal sisa keranjang
        $totalSubtotal = transactionDetails::where('order_ID', $item->order_ID)->sum('subtotal');

        // Update total_amount di tabel order_transaction
        $orderTransaction = orderTransaction::where('order_ID', $item->order_ID)->first();
        if ($orderTransaction) {
            $orderTransaction->total_amounts = $totalSubtotal; // Perbarui total_amount
            $orderTransaction->save();
        }

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

        // Gunakan relasi untuk mengakses 'order_transaction' yang memiliki customer_ID
        $cart_items = transactionDetails::whereHas('order', function ($query) use ($customerID) {
            $query->where('customer_ID', $customerID);
        })->with('menu')->get();

        if ($cart_items->isEmpty()) {
            return redirect('/menu')->with('error', 'Your cart is empty. Please add some menu.');
        }

        $totalSubtotal = $cart_items->sum('subtotal');

        // Ambil lokasi utama dari relasi
        $primaryLocation = $customer->locationCustomer->firstWhere('is_primary', 1);

        return view('Frontend.cart', [
            'customer' => $customer,
            'cart_items' => $cart_items,
            'totalSubtotal' => $totalSubtotal,
            'primaryLocation' => $primaryLocation, // Kirim lokasi utama ke Blade
        ]);
    }
}
