<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class CustomerOrderController extends Controller
{
    public function customPizza()
    {
        $menus = Menu::all();
        return view('Frontend.custom', [
            'menus' => $menus,
        ]);
    }
}
