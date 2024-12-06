<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class favoriteMenu extends Model
{
    use Notifiable;

    protected $table = 'favorite_menu';
    protected $primaryKey = 'favorite_ID';

    protected $fillable = [
        'customer_ID',
        'menu_ID',
        'email',
    ];

    public function favoredByUsers()
    {
        return $this->belongsToMany(User::class, 'favorite_menus', 'menu_ID', 'customer_ID');
    }
}
