<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tempTransaction extends Model
{
    protected $table = 'temp_transaction_order';
    protected $primaryKey = 'temp_ID';

    protected $fillable = [
        'menu_ID',
        'customer_ID',
        'quantity',
        'subtotal'
    ];


    // Relasi ke tabel menu_items
    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_ID', 'menu_ID');
    }
}
