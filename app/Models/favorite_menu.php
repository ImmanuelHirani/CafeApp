<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorite_Menu extends Model
{
    protected $table = 'favorite_menu';
    protected $primaryKey = 'favorite_ID';

    protected $fillable = [
        'user_ID',
        'menu_ID',
    ];
}
