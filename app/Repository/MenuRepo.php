<?php


namespace App\Repository;



use App\Models\menus;


interface MenuRepo
{

    public function create(array $data): menus;
    public function delete($id);
    public function find($id);
    public function update(menus $menu, array $data);
}
