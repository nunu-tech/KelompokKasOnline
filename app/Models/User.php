<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
<<<<<<< HEAD
use Illuminate\Database\Eloquent\Relations\HasMany; // Pastikan ini tetap ada untuk relasi
=======
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
>>>>>>> 60810f02bcb09570a9db86b401e027e9c156408a

class User extends Authenticatable
{

<<<<<<< HEAD
    protected $primaryKey = 'id_user';

    protected $fillable = [
        'nama_lengkap',
        'username',
        'email',
        'kelamin',
        'password',
        'role',
    ];
=======
    // 1. Primary Key disesuaikan dengan isi tabel users kamu
    protected $primaryKey = 'id_user';


    // 2. Kolom-kolom disesuaikan dengan tabel users yang baru
    protected $fillable = [
        'nama_lengkap',
        'username',
        'kelamin',
        'email',
        'password',
        'id_role',
        'id_kelas',
    ];




    // 3. Menyembunyikan data sensitif saat data dipanggil
>>>>>>> 60810f02bcb09570a9db86b401e027e9c156408a
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isWalikelas(): bool
    {
        return $this->role === 'walikelas';
    }

    public function isBendahara(): bool
    {
        return $this->role === 'bendahara';
    }

    public function isSiswa(): bool
    {
        return $this->role === 'siswa';
    }



    public function role()
    {
        return $this->belongsTo(Role::class, 'id_role');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }




    /**
     * RELASI: User punya banyak Transaksi
     */

    public function transaksi(): HasMany
    {
<<<<<<< HEAD
        // Primary key user: id_user, foreign key di transaksi: id_user
=======
        // Parameter: (Model Tujuan, Foreign Key di tabel tujuan, Local Key di tabel saat ini)
        // Disamakan ke 'id_user' sebagai jembatan penghubungnya
>>>>>>> 60810f02bcb09570a9db86b401e027e9c156408a
        return $this->hasMany(Transaksi::class, 'id_user', 'id_user');
    }
}
