<?php

namespace App\Services;

use App\Models\Customer;
use App\Repository\CustomerRepo;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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

    public function updateCustomer(Customer $customer, array $data): Customer
    {
        if (isset($data['image']) && $data['image'] instanceof \Illuminate\Http\UploadedFile) {
            $image = $data['image'];

            // Simpan gambar ke dalam storage
            $imagePath = Storage::disk('public')->put('customer_images', $image);

            // Hapus gambar lama jika ada
            if ($customer->image) {
                Storage::disk('public')->delete($customer->image);
            }

            // Update path gambar baru
            $data['image'] = $imagePath;
        }

        // Perbarui data customer
        $customer->fill($data);

        return $this->customerRepo->update($customer);
    }
}
