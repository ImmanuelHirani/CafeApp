<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuProperties extends Model
{
    protected $table = 'menu_properties';
    protected $primaryKey = 'property_ID'; // Sesuaikan dengan primary key di tabel

    protected $fillable = [
        'menu_ID',
        'size',
        'price',
        'is_active_properties',
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_ID', 'menu_ID');
    }
}
