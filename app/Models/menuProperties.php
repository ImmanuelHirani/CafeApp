<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class menuProperties extends Model
{
    protected $table = 'menu_properties';
    protected $primaryKey = 'property_ID';

    protected $fillable = [
        'menu_ID',
        'size',
        'price',
        'is_active',
    ];

    // Relasi kebalikannya (Many to One)
    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_ID', 'menu_ID');
    }
}
