<?php

namespace App\Http\Controllers;

use App\Models\customer_message;
use App\Models\menus;
use Illuminate\Support\Facades\Auth;

class contactUsController extends Controller
{
    public function contactUS()
    {
        if (!Auth::check()) {
            return redirect()->back()->with('error', 'Login First!');
        }
        $customer = Auth::user();
        $menus = menus::all();
        return view('Frontend.contact-us', [
            'menus' => $menus
        ]);
    }
    public function CSAdmin()
    {

        // Ambil data user dari database menggunakan guard 'admin'
        $user = Auth::guard('admin')->user();

        // Validasi apakah user valid dan memiliki user_type admin atau owner
        if (!$user || !in_array($user->user_type, ['admin', 'owner'])) {
            return redirect()->route('admin.auth')->with('error', 'Login First');
        }


        // Use the correct method to fetch all messages from the database
        $CSMessages = customer_message::all();

        return view('Backend.Admin-CService', [
            'CSMessages' => $CSMessages,
        ]);
    }
}
