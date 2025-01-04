<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\menu_size;
use App\Models\MenuProperties;
use App\Models\menus;
use App\Models\orderTransaction;
use App\Models\orderTranscationDetails;
use App\Models\transaction;
use App\Models\transaction_details;
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
        $menu = menus::find($request->menu_ID);
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
        $property = menu_size::where('menu_ID', $request->menu_ID)
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
            $Transaction = transaction::where('customer_ID', $customer->customer_ID)
                ->where('status_order', 'pending') // Pastikan status "pending"
                ->first();

            if (!$Transaction) {
                $Transaction = transaction::create([
                    'customer_ID' => $customer->customer_ID,
                    'total_amounts' => $total_amount,
                    'status_order' => 'pending', // Set status "pending"
                ]);
            } else {
                $Transaction->total_amounts += $total_amount;
                $Transaction->save();
            }

            // Cek Duplikasi Menu dalam Transaksi
            $existingDetail = transaction_details::where('transaction_ID', $Transaction->transaction_ID)
                ->where('menu_ID', $request->menu_ID)
                ->first();

            if ($existingDetail) {
                return redirect()->back()->with('error', 'Menu Already Added.');
            }

            // Tambahkan Item ke Detil Transaksi
            transaction_details::create([
                'transaction_ID' => $Transaction->transaction_ID,
                'order_type' => 'normal_menu',
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

    public function AddToCartCustom(Request $request)
    {
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
        $toppings = $request->input('toppings');  // Tidak perlu di-explode
        $totalPrice = $request->input('total_price');

        // Mulai transaksi
        DB::beginTransaction();

        try {
            // Cek apakah ada transaksi pending sebelumnya
            $order = transaction::where('customer_ID', $customer->customer_ID)
                ->where('status_order', 'pending') // Pastikan status "pending"
                ->first();

            if (!$order) {
                // Jika tidak ada transaksi pending, buat transaksi baru
                $order = transaction::create([
                    'customer_ID' => $customer->customer_ID,
                    'status_order' => 'pending',
                    'total_amounts' => $totalPrice,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            } else {
                // Jika ada transaksi pending, update total amount
                $order->total_amounts += $totalPrice;
                $order->save();
            }

            // Cek apakah sudah ada item custom_menu dalam transactionDetails
            $existingCustomMenu = transaction_details::where('transaction_ID', $order->transaction_ID)
                ->where('order_type', 'custom_menu')
                ->first();

            if ($existingCustomMenu) {
                // Jika sudah ada, tidak bisa menambahkan lagi
                DB::rollBack();  // Rollback transaksi jika custom menu sudah ada
                return redirect()->back()->with('error', 'Custom menu can only be added once per transaction');
            }

            // Simpan detail transaksi tanpa loop topping
            transaction_details::create([
                'transaction_ID' => $order->transaction_ID,
                'order_type' => 'custom_menu',
                'menu_ID' => -99,  // Custom menu, set menu_ID ke -99
                'size' => $size,
                'menu_name' => $toppings,  // Menggunakan seluruh topping sebagai menu_name
                'quantity' => 1,  // Bisa disesuaikan jika quantity tersedia
                'subtotal' => $totalPrice,  // Sesuaikan subtotal jika perlu
            ]);

            // Commit transaksi
            DB::commit();

            // Menyusun respons jika berhasil
            return redirect()->back()->with('success', 'Custom Menu added to cart.');
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi error
            DB::rollBack();
            // Menangani kesalahan dan mengembalikan error response
            return redirect()->back()->with('error', 'An error occurred. Please try again later.');
        }
    }

    public function deleteCart($orderDetailID)
    {
        // Cari item berdasarkan orderDetailID
        $item = transaction_details::find($orderDetailID);

        // Jika item tidak ditemukan, kembalikan error
        if (!$item) {
            return response()->json(['success' => false, 'message' => 'Item not found.']);
        }

        // Ambil transaction_ID dari item
        $transactionID = $item->transaction_ID;

        // Hapus item dari keranjang
        $item->delete();

        // Hitung Total Subtotal Setelah Penambahan Item
        $totalSubtotal = transaction_details::where('transaction_ID', $transactionID)->sum('subtotal');

        // Update total_amount di tabel order_transaction
        $orderTransaction = transaction::where('transaction_ID', $transactionID)->first();
        if ($orderTransaction) {
            $orderTransaction->total_amounts = $totalSubtotal; // Perbarui total_amount
            $orderTransaction->save();
        }

        // Periksa apakah masih ada item dalam order
        $remainingItems = transaction_details::where('transaction_ID', $transactionID)->count();

        // Jika tidak ada item lagi dalam order, hapus order tersebut
        if ($remainingItems === 0) {
            $order = transaction::find($transactionID);
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
        $item = transaction_details::find($orderDetailID); // find() mencari berdasarkan primary key

        // Jika item tidak ditemukan, kembalikan error
        if (!$item) {
            return response()->json(['success' => false, 'message' => 'Item not found.']);
        }

        // Ambil harga berdasarkan menu_ID dan size
        $property = menu_size::where('menu_ID', $item->menu_ID)
            ->where('size', $item->size)
            ->first();

        if (!$property) {
            return response()->json(['success' => false, 'message' => 'Size not found for this menu.']);
        }

        // Cari menu untuk memeriksa stok
        $menu = menus::where('menu_ID', $item->menu_ID)->first();
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
        $totalSubtotal = transaction_details::where('transaction_ID', $item->transaction_ID)->sum('subtotal');

        // Update total_amount di tabel order_transaction
        $orderTransaction = transaction::where('transaction_ID', $item->transaction_ID)->first();
        if ($orderTransaction) {
            $orderTransaction->total_amounts = $totalSubtotal; // Perbarui total_amount
            $orderTransaction->save();
        }

        return response()->json([
            'success' => true,
            'message' => 'Quantity updated.',
            'quantity' => $item->quantity,
            'subtotal' => $item->subtotal,
            'totalSubtotal' => $totalSubtotal,
            'price' => $property->price
        ]);
    }

    public function cartMenu()
    {
        // Ambil data pengguna yang sedang login
        $customer = Auth::user();

        // Periksa apakah pengguna belum login
        if (!$customer) {
            return redirect()->back()->with('error', 'log in first!');
        }

        $customerID = $customer->customer_ID;

        // Ambil item dalam cart hanya dari pesanan dengan status 'pending'
        $cart_items = transaction_details::whereHas('order', function ($query) use ($customerID) {
            $query->where('customer_ID', $customerID)->where('status_order', 'pending');
        })->with('menu')->get();

        // Periksa jika cart kosong
        if ($cart_items->isEmpty()) {
            return redirect('/menu')->with('error', 'cart is empty , add some menu');
        }

        // Hitung total subtotal dari semua item dalam cart
        $totalSubtotal = $cart_items->sum('subtotal');

        // Ambil lokasi utama pelanggan
        $primaryLocation = $customer->locationCustomer->firstWhere('is_primary', 1);

        // Periksa apakah pelanggan belum mengatur lokasi utama
        if (!$primaryLocation) {
            return redirect()->route('frontend.profile')->with('error', 'Set location now to proceed.');
        }

        // Tampilkan halaman cart dengan data yang diperlukan
        return view('Frontend.cart', [
            'customer' => $customer,
            'cart_items' => $cart_items,
            'totalSubtotal' => $totalSubtotal,
            'primaryLocation' => $primaryLocation, // Kirim lokasi utama ke Blade
        ]);
    }

    // Cart Make order:
    public function makeOrder()
    {
        // Mendapatkan user yang login
        $customer = Auth::user();

        // Validasi apakah user sudah login
        if (!$customer) {
            return redirect()->back()->with('error', 'You need to login to make an order.');
        }

        // Cek apakah ada order yang statusnya 'in-progress'
        $existingInProgressOrder = transaction::where('customer_ID', $customer->customer_ID)
            ->where('status_order', 'in-progress')
            ->exists();

        if ($existingInProgressOrder) {
            return redirect()->route('payment.view')->with('error', 'Finish your previous order before making a new one.');
        }

        // Cari transaksi dengan status 'pending' milik user yang login
        $order = transaction::where('customer_ID', $customer->customer_ID)
            ->where('status_order', 'pending')
            ->first();

        // Validasi apakah ada order yang ditemukan
        if (!$order) {
            return redirect()->back()->with('error', 'No pending orders found to process.');
        }

        // Update status_order menjadi 'in-progress'
        $order->update([
            'status_order' => 'in-progress',
            'updated_at' => now(),
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('payment.view')->with('success', 'Order made');
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
        return redirect()->Route('frontend.menu')->with('error', 'Order Canceled');
    }
}
