<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class customer extends Authenticatable
{
    use Notifiable;

    protected $table = 'customers';
    protected $primaryKey = 'customer_ID';

    protected $fillable = [
        'username',
        'phone',
        'email',
        'password',
        'image',
        'is_active'
    ];

    protected $hidden = ['password'];

    public function favoriteMenus()
    {
        return $this->belongsToMany(menus::class, 'favorite_menu', 'customer_ID', 'menu_ID');
    }

    public function orderCustomer()
    {
        return $this->hasMany(transaction::class, 'customer_ID', 'customer_ID');
    }

    // Di model User
    public function customer()
    {
        return $this->hasOne(customer::class, 'customer_ID'); // pastikan kolom yang menghubungkan benar
    }


    public function locationCustomer()
    {
        return $this->hasMany(location::class, 'customer_ID', 'customer_ID');
    }
}
