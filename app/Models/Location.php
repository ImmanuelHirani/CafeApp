<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class location extends Model
{
    use Notifiable;

    protected $table = 'customer_location';
    protected $primaryKey = 'location_ID';

    protected $fillable = [
        'user_ID',
        'location_label',
        'reciver_address',
        'reciver_number',
        'reciver_name',
        'is_primary',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_ID', 'user_ID');
    }
}
