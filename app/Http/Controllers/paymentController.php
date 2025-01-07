<?php

namespace App\Http\Controllers;

use App\Models\transaction;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;
// use Midtrans\Transaction;
use Illuminate\Support\Facades\Log;
use Midtrans\Snap;

class PaymentController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = false;
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

            $user = User::find(Auth::id());
            if (!$user) {
                return redirect()->back()->with('error', 'Login First!');
            }

            $userID = $user->user_ID;

            $order = transaction::where('status_order', 'in-progress')
                ->where('user_ID', $userID)
                ->first();

            if (!$order) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Order not found or no active orders found.'
                ], 404);
            }

            $transactionDetails = [
                'transaction_details' => [
                    'order_id' => $order->transaction_ID . '-' . Str::uuid(), // Gunakan UUID
                    'gross_amount' => $order->total_amounts,
                ],
                'customer_details' => [
                    'user_id' => $user->user_ID,
                    'first_name' => $user->username,
                    'email' => $user->email,
                    'phone' => $user->phone,
                ]
            ];

            $snapToken = Snap::getSnapToken($transactionDetails);

            return response()->json([
                'status' => 'success',
                'token' => $snapToken
            ]);
        } catch (\Exception $e) {
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
