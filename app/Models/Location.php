<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Location extends Model
{
    use Notifiable;

    protected $table = 'customers_location';
    protected $primaryKey = 'location_ID';

    protected $fillable = [
        'customer_ID',
        'location_label',
        'reciver_address',
        'reciver_number',
        'reciver_name',
        'is_primary',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_ID', 'customer_ID');
    }
}
