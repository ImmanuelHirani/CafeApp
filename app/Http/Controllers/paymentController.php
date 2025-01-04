<?php

namespace App\Http\Controllers;

use App\Models\transaction;
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

            $customer = Auth::user();
            if (!$customer) {
                return redirect()->back()->with('error', 'Login First!');
            }

            $customerID = $customer->customer_ID;

            $order = transaction::where('status_order', 'in-progress')
                ->where('customer_ID', $customerID)
                ->first();

            if (!$order) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Order not found or no active orders found.'
                ], 404);
            }

            $transactionDetails = [
                'transaction_details' => [
                    'order_id' => $order->transaction_ID,
                    'gross_amount' => $order->total_amounts,
                ],
                'customer_details' => [
                    'customer_ID' => $customer->customer_ID,
                    'first_name' => $customer->username,
                    'email' => $customer->email,
                    'phone' => $customer->phone,
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
