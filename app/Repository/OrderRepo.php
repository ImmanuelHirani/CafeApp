<?php

namespace App\Repository;

use App\Models\tempTransaction;

interface orderRepo
{
    public function add(array $validatedData): tempTransaction;
    public function delete($id): bool;
    public function update(tempTransaction $tempTransaction, array $data): tempTransaction;
}
