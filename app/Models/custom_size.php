<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class custom_size extends Model
{
    use Notifiable;

    protected $table = 'custom_size';
    protected $primaryKey = 'size_ID';

    protected $fillable = ['size', 'allowed_flavor', 'price'];
}
