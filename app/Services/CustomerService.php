<?php

namespace App\Services;

use App\Models\Customer;
use App\Repository\CustomerRepo;
use Illuminate\Support\Facades\Hash;

class CustomerService
{
    protected $customerRepo;

    // Inisialisasi CustomerRepo melalui Dependency Injection
    public function __construct(CustomerRepo $customerRepo)
    {
        $this->customerRepo = $customerRepo;
    }

    public function registerCustomer(array $data): Customer
    {
        // Hash password sebelum menyimpannya ke database
        $data['password'] = Hash::make($data['password']);

        // Buat instance Customer baru
        $customer = new Customer($data);

        // Gunakan repository untuk menyimpan customer
        return $this->customerRepo->insert($customer);
    }
}
