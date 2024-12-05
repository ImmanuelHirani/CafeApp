<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class transactionDetails extends Model
{
    protected $table = 'order_transaction_detail';
    protected $primaryKey = 'detail_ID';

    protected $fillable = [
        'menu_ID',
        'order_ID',
        'price',
        'quantity', // Pastikan kolom ini ditambahkan
    ];

    // Relasi ke tabel menu_items
    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_ID', 'menu_ID');
    }
    public function order()
    {
        return $this->belongsTo(orderTransaction::class, 'order_ID', 'order_ID');
    }
}
