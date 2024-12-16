<?php

namespace App\Http\Controllers;

use App\Models\Custom_categories_pizza;
use Illuminate\Http\Request;

class CustomerOrderController extends Controller
{
    public function customPizza()
    {
        $categories = Custom_categories_pizza::with(['properties', 'sizeProperties'])->get();

        return view('Frontend.custom', [
            'categories' => $categories,
        ]);
    }
}
