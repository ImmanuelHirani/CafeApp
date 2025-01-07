<?php

namespace App\Repository\RepositoryImpl;

use App\Models\user;
use App\Repository\userRepo;
use Illuminate\Database\Connection;
use Illuminate\Support\Str;
use Carbon\Carbon;


class userRepoImpl implements userRepo
{

    private Connection $conn;

    public function __construct(Connection $conn)
    {
        $this->conn = $conn;
    }

    public function insert(User $user): User
    {
        $data = [
            'username'       => $user->username,
            'email'          => $user->email,
            'phone'          => $user->phone,
            'password'       => $user->password, // Gunakan password yang sudah di-hash
            'image'          => $user->image,
            'is_active'      => $user->is_active ?? 1, // Set default active status
            'user_type'      => 'customer', // Default user type
            'remember_token' => Str::random(60), // Generate random token
            'email_verified_at' => now(), // Set email as verified
        ];

        $this->conn->table('users')->insert($data);

        return $user;
    }


    public function insertAdmin(User $user): User
    {
        $data = [
            'email' => $user->email,
            'phone' => $user->phone,
            'password' => $user->password,
            'is_active' => $user->is_active ?? 1,
            'user_type' => $user->user_type, // Gunakan user_type yang diterima
            'remember_token' => Str::random(60),
            'email_verified_at' => now(),
        ];

        $this->conn->table('users')->insert($data);

        return $user;
    }


    public function update(user $user): user
    {
        $data = $user->only(['username', 'email', 'phone', 'image']);

        $this->conn->table('users')
            ->where('user_ID', $user->user_ID)
            ->update($data);

        return $user;
    }
}
