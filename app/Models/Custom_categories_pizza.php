<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Custom_categories_pizza extends Model
{
    use HasFactory;
    use Notifiable;

    protected $table = 'custom_categories_pizza';
    protected $primaryKey = 'categories_ID';

    protected $fillable = [
        'categories_type',
        'is_active',
    ];

    // Relasi ke Custom_categories_properties
    public function properties()
    {
        return $this->hasMany(Custom_categories_properties::class, 'categories_ID', 'categories_ID');
    }

    // Relasi ke Custom_categories_size_properties
    public function sizeProperties()
    {
        return $this->hasMany(Custom_categories_size_properties::class, 'categories_ID', 'categories_ID');
    }
}
