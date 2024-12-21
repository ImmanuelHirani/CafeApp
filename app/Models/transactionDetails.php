<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class transactionDetails extends Model
{
    protected $table = 'order_transaction_details';
    protected $primaryKey = 'order_detail_ID';

    protected $fillable = [
        'order_ID',
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
        return $this->belongsTo(Menu::class, 'menu_ID', 'menu_ID');
    }

    public function order()
    {
        return $this->belongsTo(orderTransaction::class, 'order_ID', 'order_ID');
    }
}
