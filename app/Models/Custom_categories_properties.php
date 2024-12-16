<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Custom_categories_properties extends Model
{

    use Notifiable;

    protected $table = 'custom_categories_properties';
    protected $primaryKey = 'properties_ID';

    protected $fillable = [
        'categories_ID',
        'properties_name',
        'price',
        'is_active',
    ];


    // Relasi belongsTo ke Custom_categories_pizza
    public function pizzaCategory()
    {
        return $this->belongsTo(Custom_categories_pizza::class, 'categories_ID', 'categories_ID');
    }
}
