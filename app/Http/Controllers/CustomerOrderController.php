<?php

namespace App\Http\Controllers;

use App\Models\Custom_categories_pizza;
use App\Models\Custom_categories_properties;
use App\Models\Custom_categories_size_properties;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerOrderController extends Controller
{
    public function customPizza()
    {
        $categories = Custom_categories_pizza::with('properties')->where('is_active', 1)->get();
        $menus = Menu::with('properties')->get();
        $sizes = Custom_categories_size_properties::all(); // Size dengan harga dan jumlah topping yang diperbolehkan



        return view('Frontend.custom', [
            'categories' => $categories,
            'menus' => $menus,
            'sizes' => $sizes,

        ]);
    }

    public function calculateTotal(Request $request)
    {

        // Mendapatkan user yang login
        $customer = Auth::user();

        if (!$customer) {
            return redirect()->back()->with('error', 'You need to login to make an order.');
        }

        // Validasi jika size_id tidak dipilih
        if (!$request->has('size_id') || empty($request->size_id)) {
            return response()->json(['error' => 'Size is required before selecting toppings.']);
        }

        // Ambil data ukuran pizza berdasarkan size_id yang dipilih
        $size = Custom_categories_size_properties::find($request->size_id);

        if (!$size) {
            return response()->json(['error' => 'Invalid size selected.']);
        }

        // Validasi jumlah topping
        $maxToppings = $size->max_toppings;  // Ambil batas maksimal topping dari ukuran pizza yang dipilih
        $toppingsCount = count($request->toppings);

        if ($toppingsCount > $maxToppings) {
            return response()->json([
                'warning' => "Max only {$maxToppings} toppings for this size."
            ]);
        }

        // Menghitung harga total
        $totalPrice = $size->price;

        // Jika topping dipilih, tambahkan harga topping
        $toppingPrice = 0;
        if ($request->has('toppings')) {
            foreach ($request->toppings as $toppingName) {
                $topping = Custom_categories_properties::where('properties_name', $toppingName)->first();
                if ($topping) {
                    $toppingPrice += $topping->price;
                }
            }
        }

        // Jumlahkan harga size dan topping
        $totalPrice += $toppingPrice;

        // Kembalikan total harga
        return response()->json([
            'total_price' => $totalPrice,
        ]);
    }

    // public function checkAuth()
    // {
    //     // Mendapatkan user yang login
    //     $customer = Auth::user();

    //     if (!$customer) {
    //         return redirect()->back()->with('error', 'You need to login to make an order.');
    //     }

    //     return response()->json(['isAuthenticated' => Auth::check()]);
    // }
}
