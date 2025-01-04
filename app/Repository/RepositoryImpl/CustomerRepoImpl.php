<?php

namespace App\Repository\RepositoryImpl;

use App\Models\customer;
use App\Repository\customerRepo;
use Illuminate\Database\Connection;

class customerRepoImpl implements customerRepo
{

    private Connection $conn;

    public function __construct(Connection $conn)
    {
        $this->conn = $conn;
    }

    public function insert(customer $customer): customer
    {
        $data = [
            'email' => $customer->email,
            'phone' => $customer->phone,
            'password' => $customer->password,
        ];

        $this->conn->table('customers')->insert($data);

        return $customer;
    }

    public function update(customer $customer): customer
    {
        $data = $customer->only(['username', 'email', 'phone', 'image']);

        $this->conn->table('customers')
            ->where('customer_ID', $customer->customer_ID)
            ->update($data);

        return $customer;
    }
}
