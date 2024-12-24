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
        'is_active',
    ];

    // Relasi satu ke banyak (One to Many)
    public function properties()
    {
        return $this->hasMany(menuProperties::class, 'menu_ID', 'menu_ID');
    }

    public function reviews()
    {
        return $this->hasMany(MenuReview::class, 'menu_ID');
    }
}
