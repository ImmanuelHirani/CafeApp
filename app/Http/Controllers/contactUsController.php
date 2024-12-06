<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class contactUsController extends Controller
{
    public function contactUS()
    {
        if (!Auth::check()) {
            return redirect()->back()->with('error', 'Login First!');
        }
        $customer = Auth::user();
        $menus = Menu::all();
        return view('Frontend.contact-us', [
            'menus' => $menus
        ]);
    }
}
