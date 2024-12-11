<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class profileController extends Controller
{
    public function profile()
    {
        $customer = Auth::user();
        $menus = Menu::with('properties')->get();

        if (!$customer) {
            return redirect()->back()->with('error', 'Login First!');
        }
        return view('Frontend.profile', [
            'customer' => $customer,
            'menus' => $menus,

        ]);
    }
}
