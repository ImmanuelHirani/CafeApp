<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class orderTransaction extends Model
{
    protected $table = 'order_transaction';
    protected $primaryKey = 'order_ID';

    protected $fillable = [
        'customer_ID',
        'total_amounts',
        'status_order',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_ID', 'customer_ID');
    }

    public function location()
    {
        return $this->hasMany(transactionLocation::class, 'order_ID', 'order_ID');
    }

    public function details()
    {
        return $this->hasMany(transactionDetails::class, 'order_ID', 'order_ID');
    }
}
