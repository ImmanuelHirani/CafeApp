<?php

// MenuRepoImpl.php
namespace App\Repository\RepositoryImpl;

use App\Repository\MenuRepo;
use App\Models\Menu;
use Illuminate\Database\Connection;

class MenuRepoImpl implements MenuRepo
{

    // Insert method di repository
    public function insert(array $validatedData): Menu
    {
        // Membuat objek menu baru berdasarkan data yang divalidasi
        $menu = new Menu();
        $menu->menu_type = $validatedData['menu_type'];
        $menu->name = $validatedData['name'];
        $menu->stock = $validatedData['stock'];
        $menu->menu_description = $validatedData['menu_description'];
        $menu->price = $validatedData['price'];
        $menu->is_active = $validatedData['is_active'];
        $menu->image = $validatedData['image'] ?? null; // Menggunakan image jika ada

        // Menyimpan data menu ke dalam database menggunakan Eloquent
        $menu->save();

        // Mengembalikan objek menu yang telah disimpan
        return $menu;
    }
    // Update method di repository
    public function update(Menu $menu, array $validatedData): Menu
    {
        $menu->update($validatedData);
        return $menu;
    }


    public function delete($id)
    {
        $menu = Menu::find($id);
        if ($menu) {
            $menu->delete();
            return true;
        }
        return false;
    }
}
