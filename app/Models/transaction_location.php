<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction_Location extends Model
{
    protected $table = 'transaction_location';
    protected $primaryKey = 'transaction_location_ID';

    protected $fillable = [
        'transaction_ID',
        'location_label',
        'reciver_address',
        'reciver_number',
        'reciver_name',
    ];


    public function order()
    {
        return $this->belongsTo(transaction::class, 'order_ID', 'order_ID');
    }
}
