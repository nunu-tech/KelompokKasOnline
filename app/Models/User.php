<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // 1. WAJIB: Kasih tahu Laravel kalau Primary Key kita namanya id_user
    protected $primaryKey = 'id_user';

    /**
     * 2. WAJIB: Tambahin 'username' di sini supaya bisa disimpan lewat Seeder/Form
     */
    protected $fillable = [
        'name',
        'username', 
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}