<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction_Details extends Model
{
    protected $table = 'transaction_details';
    protected $primaryKey = 'transaction_detail_ID';

    protected $fillable = [
        'transaction_ID',
        'order_type',
        'menu_ID',
        'size',
        'price',
        'menu_name',
        'quantity',
        'subtotal',
    ];

    public function menu()
    {
        return $this->belongsTo(menus::class, 'menu_ID', 'menu_ID');
    }

    public function order()
    {
        return $this->belongsTo(transaction::class, 'transaction_ID', 'transaction_ID');
    }
}
