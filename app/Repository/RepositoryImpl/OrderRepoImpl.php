<?php

namespace App\Repository\RepositoryImpl;

use App\Models\tempTransaction;
use App\Repository\orderRepo;

class OrderRepoImpl implements orderRepo
{
    public function add(array $validatedData): tempTransaction
    {
        $tempTransaction = new tempTransaction();
        $tempTransaction->menu_ID = $validatedData['menu_ID'];
        $tempTransaction->customer_ID = $validatedData['customer_ID'];
        $tempTransaction->quantity = $validatedData['quantity'];
        $tempTransaction->subtotal = $validatedData['subtotal'];

        $tempTransaction->save();
        return $tempTransaction;
    }
    public function delete($id): bool
    {
        $tempTransaction = tempTransaction::find($id);
        if ($tempTransaction) {
            $tempTransaction->delete();
            return true;
        }
        return false;
    }
    public function update(tempTransaction $tempTransaction, array $data): tempTransaction
    {
        // Update the tempTransaction with the provided data
        $tempTransaction->update($data);

        // Return the updated tempTransaction
        return $tempTransaction;
    }
}
