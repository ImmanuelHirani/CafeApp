<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class favorite_menu extends Model
{
    protected $table = 'favorite_menu';
    protected $primaryKey = 'favorite_ID';

    protected $fillable = [
        'customer_ID',
        'menu_ID',
    ];
}
