<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{


    protected $table = 'menu_items';
    protected $primaryKey = 'menu_ID';

    protected $fillable = [
        'menu_type',
        'image',
        'name',
        'stock',
        'menu_description',
        'price',
        'is_active',
    ];
}
