<?php

namespace App\Services;

use App\Models\user;
use App\Repository\userRepo;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class userService
{
    protected $userRepo;

    // Inisialisasi userRepo melalui Dependency Injection
    public function __construct(userRepo $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function registeruser(array $data): user
    {
        // Hash password sebelum menyimpannya ke database
        $data['password'] = Hash::make($data['password']); // Hanya hash password di sini

        // Buat instance user baru
        $user = new user($data);

        // Gunakan repository untuk menyimpan user
        return $this->userRepo->insert($user);
    }


    public function registerAdmin(array $data): user
    {
        // Hash password sebelum menyimpannya ke database
        $data['password'] = Hash::make($data['password']);

        // Buat instance user baru
        $user = new user($data);

        // Gunakan repository untuk menyimpan user
        return $this->userRepo->insertAdmin($user);
    }


    public function updateuser(user $user, array $data): user
    {
        if (isset($data['image']) && $data['image'] instanceof \Illuminate\Http\UploadedFile) {
            $image = $data['image'];

            // Simpan gambar ke dalam storage
            $imagePath = Storage::disk('public')->put('user_images', $image);

            // Hapus gambar lama jika ada
            if ($user->image) {
                Storage::disk('public')->delete($user->image);
            }

            // Update path gambar baru
            $data['image'] = $imagePath;
        }

        // Perbarui data user
        $user->fill($data);

        return $this->userRepo->update($user);
    }
}
