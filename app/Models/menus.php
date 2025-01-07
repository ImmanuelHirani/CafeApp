<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class menus extends Model
{
    protected $table = 'menus';
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
        return $this->hasMany(menu_size::class, 'menu_ID', 'menu_ID');
    }

    public function favoriteMenus()
    {
        return $this->belongsToMany(User::class, 'favorite_menu', 'menu_ID', 'user_ID');
    }


    public function reviews()
    {
        return $this->hasMany(menu_review::class, 'menu_ID');
    }
}
