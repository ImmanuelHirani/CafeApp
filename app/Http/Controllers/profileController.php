<?php

namespace App\Http\Controllers;


use App\Models\favorite_menu;
use App\Models\menus;
use App\Models\transaction;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class profileController extends Controller
{
    public function profile()
    {
        // Ambil data customer yang sedang login
        $user = Auth::user();

        if (!$user) {
            return redirect()->back()->with('error', 'Login First!');
        }

        // Mengambil menu favorit dari customer dengan memanggil model User secara statis
        $menusFav = User::find($user->user_ID)->favoriteMenus()->with('properties')->get();

        $menus = menus::all();


        // Ambil semua transaksi berdasarkan user_ID dengan status_order tertentu
        $orders = transaction::with(['details'])
            ->where('user_ID', $user->user_ID)
            ->whereIn('status_order', ['paid', 'serve', 'shipped', 'completed', 'canceled']) // Tambahkan kondisi status_order
            ->get();

        // Hitung banyaknya data di tabel details untuk setiap order
        $transactions = $orders->map(function ($order) {
            $order->total_items = $order->details->count(); // Hitung banyaknya data berdasarkan transaction_ID
            return $order;
        });

        // Kirim data ke view
        return view('Frontend.profile', [
            'customer' => $user,
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
        if (!$user) {
            return response()->json([
                'message' => 'Login First!',
            ], 401);
        }

        // Cari menu favorit berdasarkan user_ID dan menu_ID
        $deleted = favorite_menu::where('user_ID', $user->user_ID)
            ->where('menu_ID', $menuID)
            ->delete();

        // Cek apakah penghapusan berhasil
        if ($deleted) {
            return response()->json([
                'message' => 'Menu Removed ',
            ], 200);
        }

        // Jika menu tidak ditemukan di daftar favorit
        return response()->json([
            'message' => 'Menu Not Found',
        ], 404);
    }

    public function clearAllFavorites()
    {
        // Mendapatkan data user yang sedang login
        $user = Auth::user();

        // Cek apakah user sudah login dan customer terkait ada
        if (!$user) {
            return response()->json([
                'message' => 'Login First!',
            ], 401);
        }

        // Hapus semua data favorit untuk customer yang login
        $deletedCount = favorite_menu::where('user_ID', $user->user_ID)->delete();

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
