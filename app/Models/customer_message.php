<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class customer_message extends Model
{
    // Pastikan nama tabel sesuai dengan database Anda
    protected $table = 'customer_messages';
    protected $primaryKey = 'message_ID';

    // Kolom yang dapat diisi
    protected $fillable = ['user_ID', 'name', 'email', 'messages'];
}
