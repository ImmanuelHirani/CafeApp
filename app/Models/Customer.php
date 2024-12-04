<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
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
}
