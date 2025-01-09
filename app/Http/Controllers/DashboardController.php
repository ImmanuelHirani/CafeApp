<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\transaction;
use App\Models\transaction_details;
use App\Models\User;
use Illuminate\Support\Facades\DB; // Import DB
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function dashboard()
    {
        // Ambil data user dari database menggunakan guard 'admin'
        $user = Auth::guard('admin')->user();

        // Validasi apakah user valid dan memiliki user_type admin atau owner
        if (!$user || !in_array($user->user_type, ['admin', 'owner'])) {
            return redirect()->route('admin.auth')->with('error', 'Login First');
        }

        // Mengambil jumlah keseluruhan customer
        $totalCustomers = User::where('user_type', 'customer')->count();

        // Mengambil 10 order terbaru
        $orderCustomers = transaction::with(['user', 'details.menu'])
            ->latest()
            ->take(10)
            ->get();

        // Mengambil jumlah order berdasarkan status order
        $pendingOrders = transaction::where('status_order', 'Pending')->count();
        $paidOrders = transaction::where('status_order', 'Paid')->count();
        $inProgressOrders = transaction::where('status_order', 'In-Progress')->count();
        $completedOrders = transaction::where('status_order', 'completed')->count();

        // Mengambil total income (jumlah total amount) kecuali yang memiliki status_order Canceled, Pending, atau In-Progress
        $totalIncome = transaction::whereNotIn('status_order', ['Canceled', 'Pending', 'In-Progress'])
            ->sum('total_amounts');

        // Mengambil 10 menu yang paling sering dibeli (bukan custom_menu)
        $topProducts = transaction_details::select('menu_ID', DB::raw('SUM(quantity) as total_quantity'))
            ->groupBy('menu_ID')
            ->orderByDesc('total_quantity')
            ->with(['menu' => function ($query) {
                $query->where('menu_type', '!=', 'custom_menu'); // Mengabaikan custom_menu
            }])
            ->take(10)
            ->get()
            ->filter(function ($product) {
                return $product->menu !== null; // Pastikan menu ada
            });

        // Kirim data ke view
        return view('Backend.Admin-Dashboard', compact(
            'totalCustomers',
            'orderCustomers',
            'pendingOrders',
            'paidOrders',
            'inProgressOrders',
            'completedOrders',
            'totalIncome',
            'topProducts'
        ));
    }
}
