<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu_Size extends Model
{
    protected $table = 'menus_size';
    protected $primaryKey = 'menu_size_ID'; // Sesuaikan dengan primary key di tabel

    protected $fillable = [
        'menu_ID',
        'size',
        'price',
        'is_active_properties',
    ];

    public function menu()
    {
        return $this->belongsTo(menus::class, 'menu_ID', 'menu_ID');
    }
}
