<?php

namespace App\Repository\RepositoryImpl;

use App\Models\Customer;
use App\Repository\CustomerRepo;
use Illuminate\Database\Connection;

class CustomerRepoImpl implements CustomerRepo
{

    private Connection $conn;

    public function __construct(Connection $conn)
    {
        $this->conn = $conn;
    }

    public function insert(Customer $customer): Customer
    {
        $data = [
            'email' => $customer->email,
            'phone' => $customer->phone,
            'password' => $customer->password,
        ];

        $this->conn->table('customers')->insert($data);

        return $customer;
    }
}
