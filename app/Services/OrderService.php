<?php

namespace App\Services;

use App\Models\tempTransaction;
use App\Repository\orderRepo;

class OrderService
{
    protected $orderRepo;

    public function __construct(orderRepo $orderRepo)
    {
        $this->orderRepo = $orderRepo;
    }
}
