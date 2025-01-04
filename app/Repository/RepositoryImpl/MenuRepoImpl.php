<?php

// MenuRepoImpl.php
namespace App\Repository\RepositoryImpl;

use App\Repository\MenuRepo;
use App\Models\Menu;
use App\Models\menuProperties;
use App\Models\menus;
use Illuminate\Support\Facades\Log;

class MenuRepoImpl implements MenuRepo
{

    // Insert method di repository


    public function create(array $data): menus
    {
        return menus::create($data);
    }

    public function find($id)
    {
        return menus::find($id);
    }

    // MenuRepository.php

    public function update(menus $menu, array $data)
    {
        $menu->update($data);
    }


    public function delete($id)
    {
        $menu = menus::find($id);
        if ($menu) {
            $menu->delete();
            return true;
        }
        return false;
    }
}
