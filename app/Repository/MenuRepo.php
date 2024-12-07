<?php


namespace App\Repository;

use App\Models\Menu;
use App\Models\menuProperties;
use Illuminate\Http\Request;

interface MenuRepo
{

    public function create(array $data): Menu;
    public function delete($id);
    public function find($id);
    public function findSize($id, $size);
    public function update(Menu $menu, array $data);
    public function updateSize(menuProperties $properties, array $data);
}
