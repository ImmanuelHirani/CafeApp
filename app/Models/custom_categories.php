<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Custom_Categories extends Model
{
    use HasFactory;
    use Notifiable;

    protected $table = 'custom_categories';
    protected $primaryKey = 'categories_ID';

    protected $fillable = [
        'categories_type',
        'is_active',
    ];

    // Relasi ke Custom_categories_properties
    public function properties()
    {
        return $this->hasMany(custom_properties::class, 'categories_ID', 'categories_ID');
    }
}
