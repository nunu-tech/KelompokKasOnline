<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

<<<<<<< HEAD
    // 1. WAJIB: Kasih tahu Laravel kalau Primary Key kita namanya id_user
    protected $primaryKey = 'id';
=======
    protected $primaryKey = 'id'; // Pastikan ini sesuai primary key di tabel users
>>>>>>> ad41cc6f72428be06f3b5b9f5322077bbec4250b

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