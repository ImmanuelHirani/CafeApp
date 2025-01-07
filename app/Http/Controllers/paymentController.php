<?php


namespace App\Http\Controllers;

use App\Models\transaction;
use App\Models\user;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Midtrans\Config;
use Midtrans\Snap;

class PaymentController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = false; // Pastikan nilai ini sesuai dengan environment Anda
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function getTransactionToken()
    {
        try {
            Log::info('Payment Controller Called');
            Log::info('Midtrans Config:', [
                'Server Key' => Config::$serverKey,
                'Is Production' => Config::$isProduction
            ]);

            $user = user::find(Auth::id());
            if (!$user) {
                return redirect()->back()->with('error', 'Login First!');
            }

            $userID = $user->user_ID; // Pastikan 'user_ID' adalah kolom yang benar di tabel 'users'

            // Cek apakah ada transaksi dengan status 'in-progress' untuk pengguna
            $order = transaction::where('status_order', 'in-progress')
                ->where('user_ID', $userID) // Sesuaikan dengan kolom yang ada pada tabel transaksi
                ->first();

            if (!$order) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Order not found or no active orders found.'
                ], 404);
            }

            $transactionDetails = [
                'transaction_details' => [
                    'order_id' => $order->transaction_ID, // Pastikan kolom ini benar
                    'gross_amount' => $order->total_amounts, // Sesuaikan dengan kolom yang benar
                ],
                'customer_details' => [
                    'user_id' => $user->user_ID,
                    'first_name' => $user->username, // Pastikan username ada di tabel user
                    'email' => $user->email,
                    'phone' => $user->phone,
                ]
            ];

            // Mendapatkan Snap Token dari Midtrans
            $snapToken = Snap::getSnapToken($transactionDetails);

            return response()->json([
                'status' => 'success',
                'token' => $snapToken
            ]);
        } catch (\Exception $e) {
            // Menangani error dan logging
            Log::error('Midtrans Error:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
