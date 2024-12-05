<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\orderTransaction;
use App\Models\tempTransaction;
use App\Models\transactionDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Repository\orderRepo;
use Illuminate\Support\Facades\DB;
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
            return redirect()->back()->with('error', 'Your cart is empty Please add some menu ');
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
    public function updateCart($id, Request $request)
    {
        try {
            // Temukan transaksi berdasarkan ID
            $temp_cart = tempTransaction::find($id);

            if (!$temp_cart) {
                return response()->json(['error' => 'Menu not found.'], 404);
            }

            // Ambil customer dari temp_cart
            $customer = $temp_cart->customer_ID;

            // Ambil kuantitas dari request
            $quantity = $request->input('quantity');

            // Validasi kuantitas (batasi antara 1 dan 2)
            if ($quantity < 1) {
                return response()->json(['error' => 'Min Qty 1.'], 400);
            }

            if ($quantity > 2) {
                return response()->json(['error' => 'Maximal Qty 2.'], 400);
            }

            // Update kuantitas dan hitung subtotal kembali
            $temp_cart->quantity = $quantity;
            $temp_cart->subtotal = $temp_cart->menu->price * $quantity;
            $temp_cart->save();

            // Hitung total subtotal hanya untuk transaksi dengan customer yang sama
            $totalSubtotal = tempTransaction::where('customer_ID', $customer)
                ->sum('subtotal');  // Jumlahkan subtotal untuk customer yang sama

            // Log total subtotal untuk verifikasi
            Log::info('Total Subtotal untuk customer ' . $customer . ': ' . $totalSubtotal);

            return response()->json([
                'success' => 'Updated Successfully',
                'quantity' => $temp_cart->quantity,
                'subtotal' => number_format($temp_cart->subtotal, 0, ',', '.'),
                'totalSubtotal' => number_format($totalSubtotal, 0, ',', '.')  // Kirimkan totalSubtotal
            ]);
        } catch (\Exception $e) {
            Log::error('Menu update error: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to update: ' . $e->getMessage()], 500);
        }
    }

    public function payment()
    {
        $customer = Auth::user();
        if (!$customer) {
            return redirect()->route('login')->with('error', 'Login First!');
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
        DB::beginTransaction();

        try {
            $customerId = Auth::user()->customer_ID;

            // Ambil order transaction yang sedang pending
            $orderTransaction = orderTransaction::where('customer_ID', $customerId)
                ->where('status_order', 'Pending')
                ->first();

            // Jika tidak ada transaksi dengan status 'Pending', buat order baru
            if (!$orderTransaction) {
                $orderTransaction = orderTransaction::create([
                    'customer_ID' => $customerId,
                    'total_amount' => 0, // Atur total amount awal menjadi 0
                    'status_order' => 'Pending',
                ]);
            }

            // Ambil semua item dari cart
            $tempTransactions = tempTransaction::where('customer_ID', $customerId)->get();

            if ($tempTransactions->isEmpty()) {
                return redirect()->back()->with('error', 'Cart Anda kosong!');
            }

            // Looping untuk setiap item di cart
            foreach ($tempTransactions as $tempTransaction) {
                // Periksa apakah menu sudah ada di order transaction yang sedang pending
                $existingDetail = transactionDetails::where('order_ID', $orderTransaction->order_ID)
                    ->where('menu_ID', $tempTransaction->menu_ID)
                    ->first();

                // Jika menu sudah ada di order sebelumnya (payment), beri pesan bahwa menu tersebut sudah ada
                if ($existingDetail) {
                    return redirect('/payment')->with('error', 'Menu already added, please complete payment first.');
                }

                // Jika menu belum ada, tambahkan sebagai detail transaksi baru
                transactionDetails::create([
                    'menu_ID' => $tempTransaction->menu_ID,
                    'order_ID' => $orderTransaction->order_ID,
                    'price' => $tempTransaction->subtotal / $tempTransaction->quantity,
                    'quantity' => $tempTransaction->quantity,
                ]);

                // Update total_amount transaksi
                $orderTransaction->total_amount += $tempTransaction->subtotal;  // Update total amount
                $orderTransaction->save();
            }

            // Hapus item dari cart setelah masuk ke transaction
            tempTransaction::where('customer_ID', $customerId)->delete();

            DB::commit();
            return redirect('/payment')->with('success', 'Order berhasil dibuat!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error saat membuat order: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal membuat order! Silakan coba lagi.');
        }
    }
}
