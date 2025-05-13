<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $table = 'users';
    protected $primaryKey = 'user_ID';
    // Pastikan ini tidak di set ke false
    public $timestamps = true;

    protected $fillable = [
        'username',
        'phone',
        'email',
        'password',
        'image',
        'user_type',
        'is_active'
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        // Hapus ini untuk password
        // 'password' => 'hashed',
    ];



    public function favoriteMenus()
    {
        return $this->belongsToMany(menus::class, 'favorite_menu', 'user_ID', 'menu_ID');
    }

    public function orderuser()
    {
        return $this->hasMany(transaction::class, 'user_ID', 'user_ID');
    }

    public function locationuser()
    {
        return $this->hasMany(location::class, 'user_ID', 'user_ID');
    }
}
