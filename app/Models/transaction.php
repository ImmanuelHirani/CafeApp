<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class transaction extends Model
{
    protected $table = 'transaction';
    protected $primaryKey = 'transaction_ID';

    protected $fillable = [
        'customer_ID',
        'total_amounts',
        'status_order',
    ];

    public function customer()
    {
        return $this->belongsTo(customer::class, 'customer_ID', 'customer_ID');
    }

    public function location()
    {
        return $this->hasMany(transaction_location::class, 'transaction_ID', 'transaction_ID');
    }

    public function details()
    {
        return $this->hasMany(transaction_details::class, 'transaction_ID', 'transaction_ID');
    }
}
