<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Custom_categories_size_properties extends Model
{
    use Notifiable;

    protected $table = 'custom_categories_size_properties';
    protected $primaryKey = 'size_ID';

    protected $fillable = [
        'categories_ID',
        'size',
        'allowed_flavor',
        'price',
    ];

    // Relasi belongsTo ke Custom_categories_pizza
    public function pizzaCategory()
    {
        return $this->belongsTo(Custom_categories_pizza::class, 'categories_ID', 'categories_ID');
    }
}
