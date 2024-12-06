<?php


namespace App\Repository;

use App\Models\Menu;
use App\Models\menuProperties;

interface MenuRepo
{
    public function update(Menu $menu, menuProperties $properties,  array $data);
    public function create(array $data): Menu;
    public function delete($id);
}
