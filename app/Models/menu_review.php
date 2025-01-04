<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class menu_review extends Model
{
    protected $table = 'menu_review';
    protected $primaryKey = 'review_ID'; // Sesuaikan dengan primary key di tabel

    protected $fillable = [
        'customer_ID',
        'menu_ID',
        'rating',
        'review_desc',
    ];

    public function menu()
    {
        return $this->belongsTo(menus::class, 'menu_ID', 'menu_ID');
    }

    public function customer()
    {
        return $this->belongsTo(customer::class, 'customer_ID', 'customer_ID');
    }
}
