<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class menu_review extends Model
{
    protected $table = 'menu_review';
    protected $primaryKey = 'review_ID'; // Sesuaikan dengan primary key di tabel

    protected $fillable = [
        'user_ID',
        'menu_ID',
        'rating',
        'review_desc',
    ];

    public function menu()
    {
        return $this->belongsTo(menus::class, 'menu_ID', 'menu_ID');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_ID', 'user_ID');
    }
}
