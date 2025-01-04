<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\favorite_menu;
use App\Models\favoriteMenu;
use App\Models\Menu;
use App\Models\menus;
use App\Models\orderTransaction;
use App\Models\transaction;
use App\Models\transactionDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class profileController extends Controller
{
    public function profile()
    {
        // Ambil data customer yang sedang login
        $customer = Auth::user();


        if (!$customer) {
            return redirect()->back()->with('error', 'Login First!');
        }

        $menusFav = $customer->customer->favoriteMenus()->with('properties')->get();

        $menus = menus::all();


        // Ambil semua transaksi berdasarkan customer_ID dengan status_order tertentu
        $orders = transaction::with(['details'])
            ->where('customer_ID', $customer->customer_ID)
            ->whereIn('status_order', ['paid', 'serve', 'shipped', 'completed', 'canceled']) // Tambahkan kondisi status_order
            ->get();

        // Hitung banyaknya data di tabel details untuk setiap order
        $transactions = $orders->map(function ($order) {
            $order->total_items = $order->details->count(); // Hitung banyaknya data berdasarkan transaction_ID
            return $order;
        });

        // Kirim data ke view
        return view('Frontend.profile', [
            'customer' => $customer,
            'menus' => $menus,
            'menusFav' => $menusFav,  // Menampilkan hanya menu favorit
            'transactions' => $transactions,
        ]);
    }

    public function removeToFav($menuID)
    {
        // Mendapatkan data user yang sedang login
        $user = Auth::user();

        // Cek apakah user sudah login dan customer terkait ada
        if (!$user || !$user->customer) {
            return response()->json([
                'message' => 'Login First!',
            ], 401);
        }

        // Cari menu favorit berdasarkan customer_ID dan menu_ID
        $deleted = favorite_menu::where('customer_ID', $user->customer->customer_ID)
            ->where('menu_ID', $menuID)
            ->delete();

        // Cek apakah penghapusan berhasil
        if ($deleted) {
            return response()->json([
                'message' => 'Menu Removed From Favorite',
            ], 200);
        }

        // Jika menu tidak ditemukan di daftar favorit
        return response()->json([
            'message' => 'Menu Not Found In Favorites',
        ], 404);
    }

    public function clearAllFavorites()
    {
        // Mendapatkan data user yang sedang login
        $user = Auth::user();

        // Cek apakah user sudah login dan customer terkait ada
        if (!$user || !$user->customer) {
            return response()->json([
                'message' => 'Login First!',
            ], 401);
        }

        // Hapus semua data favorit untuk customer yang login
        $deletedCount = favorite_menu::where('customer_ID', $user->customer->customer_ID)->delete();

        // Jika tidak ada data yang dihapus
        if ($deletedCount === 0) {
            return response()->json([
                'message' => 'No favorite menus to clear!',
            ], 404);
        }

        return response()->json([
            'message' => 'All favorite menus cleared ',
        ], 200);
    }
}
