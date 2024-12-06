<?php

// MenuRepoImpl.php
namespace App\Repository\RepositoryImpl;

use App\Repository\MenuRepo;
use App\Models\Menu;
use App\Models\menuProperties;

class MenuRepoImpl implements MenuRepo
{

    // Insert method di repository


    public function create(array $data): Menu
    {
        return Menu::create($data);
    }

    // Update method di repository
    public function update(Menu $menu, menuProperties $properties, array $data)
    {
        // Update menu dengan data validasi
        $menu->update([
            'menu_type' => $data['menu_type'],
            'image' => $data['image'] ?? $menu->image,
            'name' => $data['name'],
            'stock' => $data['stock'],
            'menu_description' => $data['menu_description'],
            'is_active' => $data['is_active'],
        ]);

        // Update menuProperties
        $properties->update([
            'price' => $data['price'],
            'is_active' => $data['is_active_properties'],
        ]);
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
