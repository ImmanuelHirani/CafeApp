<?php

namespace App\Repository;

use App\Models\customer;

interface CustomerRepo
{
    public function insert(customer $customer): customer;
    public function update(customer $customer): customer;
}
