<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\customer_message as ModelMessage;

class Customer_Message extends Controller
{
    public function insertCS(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'messages' => 'required|string|min:1|max:255',
        ]);

        // Menyimpan pesan ke database
        ModelMessage::create([
            'user_ID' => Auth::id() ?? null, // Jika user login, ambil ID, jika tidak null
            'name' => $request->name,
            'email' => $request->email,
            'messages' => $request->messages,
        ]);

        return redirect()->back()->with('success', 'Your message has been sent');
    }
}
