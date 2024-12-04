<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class transactionDetails extends Model
{
    protected $table = 'order_transaction_detail';
    protected $primaryKey = 'detail_ID';

    protected $fillable = [
        'temp_ID',
        'additional_ID',
        'menu_ID',
        'custom_ID',
        'order_ID',
        'price',
    ];
}
