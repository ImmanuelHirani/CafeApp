<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Custom_categories_size_properties extends Model
{
    use Notifiable;

    protected $table = 'custom_categories_size_properties';
    protected $primaryKey = 'size_ID';

    protected $fillable = ['size', 'allowed_flavor', 'price'];
}
