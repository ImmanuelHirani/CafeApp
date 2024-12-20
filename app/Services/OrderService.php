<?php

namespace App\Services;

use App\Models\transactionDetails;
use App\Models\Menu;
use App\Repository\orderRepo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderService
{
    protected $orderRepo;

    public function __construct(orderRepo $orderRepo)
    {
        $this->orderRepo = $orderRepo;
    }

    public function makeOrder()
    {
        DB::beginTransaction();

        try {
            $customerId = Auth::user()->customer_ID;

            // Ambil order transaction yang sedang pending
            $orderTransaction = $this->orderRepo->getPendingOrderTransactionByCustomerId($customerId);

            // Jika tidak ada transaksi dengan status 'Pending', buat order baru
            if (!$orderTransaction) {
                // Membuat order baru jika tidak ada transaksi pending sebelumnya
                $orderTransaction = $this->orderRepo->createNewOrderTransaction($customerId);
            }

            // Ambil semua item dari cart
            $tempTransactions = $this->orderRepo->getCartItemsByCustomerId($customerId);

            if ($tempTransactions->isEmpty()) {
                return ['status' => false, 'message' => 'Cart Anda kosong!'];
            }

            // Looping untuk setiap item di cart
            foreach ($tempTransactions as $tempTransaction) {
                // Periksa apakah menu sudah ada di order transaction yang sedang pending
                $existingDetail = transactionDetails::where('order_ID', $orderTransaction->order_ID)
                    ->where('menu_ID', $tempTransaction->menu_ID)
                    ->first();

                // Jika menu sudah ada, beri pesan bahwa menu tersebut sudah ada
                if ($existingDetail) {
                    // Jika Anda ingin menambahkan quantity saja, tambahkan logika untuk memperbarui quantity
                    $existingDetail->quantity += $tempTransaction->quantity;  // Update jumlahnya
                    $existingDetail->subtotal = $existingDetail->quantity * $existingDetail->price; // Update subtotal sesuai dengan jumlah yang baru
                    $existingDetail->save();

                    // Update total_amount transaksi
                    $orderTransaction->total_amount += $tempTransaction->subtotal;
                    $orderTransaction->save();
                    continue;  // Skip ke item berikutnya
                }

                // Jika menu belum ada, tambahkan sebagai detail transaksi baru
                $this->orderRepo->addItemToOrderTransaction(
                    $orderTransaction,
                    $tempTransaction->menu_ID,
                    $tempTransaction->size,
                    $tempTransaction->quantity,
                    $tempTransaction->subtotal
                );

                // Update total_amount transaksi
                $orderTransaction->total_amount += $tempTransaction->subtotal;
                $orderTransaction->save();
            }

            // Hapus item dari cart setelah masuk ke transaction
            $this->orderRepo->deleteCartItemsByCustomerId($customerId);

            DB::commit();
            return ['status' => true, 'message' => 'Order berhasil dibuat!'];
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error saat membuat order: ' . $e->getMessage());
            return ['status' => false, 'message' => 'An order with this menu exists. Complete payment first.'];
        }
    }

    // public function updateCart($id, $quantity)
    // {
    //     $tempCart = $this->orderRepo->findTempTransactionById($id);

    //     if (!$tempCart) {
    //         return ['error' => 'Menu not found.', 'status' => 404];
    //     }

    //     if ($quantity < 1) {
    //         return ['error' => 'Min Qty 1.', 'status' => 400];
    //     }

    //     if ($quantity > 2) {
    //         return ['error' => 'Maximal Qty 2.', 'status' => 400];
    //     }

    //     $updatedCart = $this->orderRepo->updateTempTransactionItem(
    //         $tempCart,
    //         $quantity,
    //         $tempCart->menu->price
    //     );

    //     $totalSubtotal = $this->orderRepo->getTotalSubtotalForCustomer($tempCart->customer_ID);

    //     Log::info('Total Subtotal untuk customer ' . $tempCart->customer_ID . ': ' . $totalSubtotal);

    //     return [
    //         'success' => 'Updated Successfully',
    //         'quantity' => $updatedCart->quantity,
    //         'subtotal' => number_format($updatedCart->subtotal, 0, ',', '.'),
    //         'totalSubtotal' => number_format($totalSubtotal, 0, ',', '.'),
    //     ];
    // }

    // public function addToCart($customerId, $menuId, $quantity)
    // {
    //     try {
    //         $existingItem = $this->orderRepo->findExistingTempTransactionItem($menuId, $customerId);

    //         if ($existingItem) {
    //             $menu = $existingItem->menu;

    //             if (!$menu) {
    //                 return ['error' => 'Menu Not Found.'];
    //             }

    //             if ($existingItem->quantity >= 2) {
    //                 return ['error' => 'Max Qty 2'];
    //             }

    //             $newQuantity = $existingItem->quantity + $quantity;
    //             if ($newQuantity > 2) {
    //                 $newQuantity = 2;
    //             }

    //             $updatedItem = $this->orderRepo->updateTempTransactionItem($existingItem, $newQuantity, $menu->price);

    //             return ['success' => 'Cart Updated'];
    //         }

    //         $menuDetails = Menu::findOrFail($menuId);
    //         $subtotal = $menuDetails->price * $quantity;

    //         $data = [
    //             'menu_ID' => $menuId,
    //             'customer_ID' => $customerId,
    //             'quantity' => $quantity,
    //             'subtotal' => $subtotal,
    //         ];

    //         $this->orderRepo->addNewItemToTempTransaction($data);

    //         return ['success' => 'Menu Added'];
    //     } catch (\Exception $e) {
    //         Log::error('Add to Cart Error: ' . $e->getMessage());
    //         return ['error' => 'Something Wrongs'];
    //     }
    // }
}
