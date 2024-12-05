<?php

namespace App\Repository\RepositoryImpl;

use App\Models\orderTransaction;
use App\Models\tempTransaction;
use App\Models\transactionDetails;
use App\Repository\orderRepo;

class OrderRepoImpl implements orderRepo
{
    public function addTempTransaction(array $validatedData): tempTransaction
    {
        $tempTransaction = new tempTransaction();
        $tempTransaction->menu_ID = $validatedData['menu_ID'];
        $tempTransaction->customer_ID = $validatedData['customer_ID'];
        $tempTransaction->quantity = $validatedData['quantity'];
        $tempTransaction->subtotal = $validatedData['subtotal'];

        $tempTransaction->save();
        return $tempTransaction;
    }

    public function deleteTempTransactionById($id): bool
    {
        $tempTransaction = tempTransaction::find($id);
        if ($tempTransaction) {
            $tempTransaction->delete();
            return true;
        }
        return false;
    }

    public function updateTempTransaction(tempTransaction $tempTransaction, array $data): tempTransaction
    {
        $tempTransaction->update($data);
        return $tempTransaction;
    }

    public function getPendingOrderTransactionByCustomerId($customerId)
    {
        return orderTransaction::where('customer_ID', $customerId)
            ->where('status_order', 'Pending')
            ->first();
    }

    public function createNewOrderTransaction($customerId)
    {
        return orderTransaction::create([
            'customer_ID' => $customerId,
            'total_amount' => 0,
            'status_order' => 'Pending',
        ]);
    }

    public function getCartItemsByCustomerId($customerId)
    {
        return tempTransaction::where('customer_ID', $customerId)->get();
    }

    public function addItemToOrderTransaction($orderTransaction, $menuId, $quantity, $subtotal)
    {
        return transactionDetails::create([
            'menu_ID' => $menuId,
            'order_ID' => $orderTransaction->order_ID,
            'price' => $subtotal / $quantity,
            'quantity' => $quantity,
        ]);
    }

    public function deleteCartItemsByCustomerId($customerId)
    {
        tempTransaction::where('customer_ID', $customerId)->delete();
    }

    public function findTempTransactionById($id)
    {
        return tempTransaction::find($id);
    }

    public function getTotalSubtotalForCustomer($customerId)
    {
        return tempTransaction::where('customer_ID', $customerId)->sum('subtotal');
    }

    public function updateExistingTempTransaction($tempTransaction, $quantity, $price)
    {
        $tempTransaction->quantity = $quantity;
        $tempTransaction->subtotal = $price * $quantity;
        $tempTransaction->save();

        return $tempTransaction;
    }

    public function findExistingTempTransactionItem($menuId, $customerId)
    {
        return tempTransaction::where('menu_ID', $menuId)
            ->where('customer_ID', $customerId)
            ->first();
    }

    public function addNewItemToTempTransaction($data)
    {
        return tempTransaction::create($data);
    }

    public function updateTempTransactionItem($tempTransaction, $quantity, $price)
    {
        $tempTransaction->quantity = $quantity;
        $tempTransaction->subtotal = $price * $quantity;
        $tempTransaction->save();

        return $tempTransaction;
    }
}
