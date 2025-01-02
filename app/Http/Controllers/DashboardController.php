<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\orderTransaction;
use App\Models\transactionDetails;
use Illuminate\Support\Facades\DB; // Import DB
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function dashboard()
    {
        // Mengambil jumlah keseluruhan customer
        $totalCustomers = Customer::count();

        // Mengambil 10 order terbaru
        $orderCustomers = orderTransaction::with(['customer', 'details.menu'])
            ->latest()
            ->take(10)
            ->get();

        // Mengambil jumlah order berdasarkan status order
        $pendingOrders = orderTransaction::where('status_order', 'Pending')->count();
        $paidOrders = orderTransaction::where('status_order', 'Paid')->count();
        $inProgressOrders = orderTransaction::where('status_order', 'In-Progress')->count();
        $completedOrders = orderTransaction::where('status_order', 'completed')->count();

        // Mengambil total income (jumlah total amount) jika diperlukan
        $totalIncome = orderTransaction::sum('total_amounts');

        // Mengambil 10 menu yang paling sering dibeli (bukan custom_menu)
        $topProducts = transactionDetails::select('menu_ID', DB::raw('SUM(quantity) as total_quantity'))
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
