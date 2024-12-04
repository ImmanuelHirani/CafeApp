<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class orderTransaction extends Model
{
    protected $table = 'order_transaction';
    protected $primaryKey = 'order_ID';

    protected $fillable = [
        'customer_ID',
        'total_amount',
        'status_order',
    ];
}
