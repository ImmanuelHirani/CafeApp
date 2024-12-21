<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\orderTransaction;
use App\Models\transactionDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class profileController extends Controller
{
    public function profile()
    {
        // Ambil semua menu dengan relasi properties
        $menus = Menu::with('properties')->get();

        // Ambil data customer yang sedang login
        $customer = Auth::user();
        if (!$customer) {
            return redirect()->back()->with('error', 'Login First!');
        }

        // Ambil semua transaksi berdasarkan customer_ID dengan status_order tertentu
        $orders = orderTransaction::with(['details'])
            ->where('customer_ID', $customer->customer_ID)
            ->whereIn('status_order', ['paid', 'serve', 'shipped', 'completed', 'canceled']) // Tambahkan kondisi status_order
            ->get();

        // Hitung banyaknya data di tabel details untuk setiap order
        $transactions = $orders->map(function ($order) {
            $order->total_items = $order->details->count(); // Hitung banyaknya data berdasarkan order_ID
            return $order;
        });

        // Kirim data ke view
        return view('Frontend.profile', [
            'customer' => $customer,
            'menus' => $menus,
            'transactions' => $transactions,
        ]);
    }
}
