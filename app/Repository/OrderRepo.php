<?php

namespace App\Repository;

use App\Models\tempTransaction;

interface orderRepo
{
    public function addTempTransaction(array $validatedData): tempTransaction;
    public function deleteTempTransactionById($id): bool;
    public function updateTempTransaction(tempTransaction $tempTransaction, array $data): tempTransaction;
    public function getPendingOrderTransactionByCustomerId($customerId);
    public function createNewOrderTransaction($customerId);
    public function getCartItemsByCustomerId($customerId);
    public function addItemToOrderTransaction($orderTransaction, $menuId, $quantity, $subtotal);
    public function deleteCartItemsByCustomerId($customerId);
    public function findTempTransactionById($id);
    public function getTotalSubtotalForCustomer($customerId);
    public function updateExistingTempTransaction($tempTransaction, $quantity, $price);
    public function findExistingTempTransactionItem($menuId, $customerId);
    public function addNewItemToTempTransaction($data);
    public function updateTempTransactionItem($tempTransaction, $quantity, $price);
}
