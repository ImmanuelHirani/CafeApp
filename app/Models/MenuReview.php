<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuReview extends Model
{
    protected $table = 'customers_review';
    protected $primaryKey = 'review_ID'; // Sesuaikan dengan primary key di tabel

    protected $fillable = [
        'customer_ID',
        'menu_ID',
        'rating',
        'review_desc',
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_ID', 'menu_ID');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_ID', 'customer_ID');
    }
}
