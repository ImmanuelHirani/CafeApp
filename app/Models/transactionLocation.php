<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class transactionLocation extends Model
{
    protected $table = 'order_transaction_location';
    protected $primaryKey = 'order_transaction_location_ID';

    protected $fillable = [
        'order_ID',
        'location_label',
        'reciver_address',
        'reciver_number',
        'reciver_name',
    ];


    public function order()
    {
        return $this->belongsTo(orderTransaction::class, 'order_ID', 'order_ID');
    }
}
