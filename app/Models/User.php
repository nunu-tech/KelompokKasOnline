<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'id'; // Pastikan ini sesuai primary key di tabel users

    protected $fillable = [
        'name',
        'username', 
        'email',
        'password',
    ];

    // ... (hidden & casts tetap sama) ...

    /**
     * RELASI: User punya banyak Transaksi
     */
    public function transaksi(): HasMany
    {
        // 'id_user' adalah kolom di tabel transaksis yang merujuk ke 'id' di tabel users
        return $this->hasMany(Transaksi::class, 'id_user', 'id');
    }
}