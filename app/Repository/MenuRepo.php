<?php


namespace App\Repository;

use App\Models\Menu;

interface MenuRepo
{
    public function update(Menu $menu, array $validatedData): Menu;
    public function insert(array $validatedData): Menu;
    public function delete($id);
}
