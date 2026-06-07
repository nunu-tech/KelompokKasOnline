<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

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
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // 4. Bawaan keamanan Laravel
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
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
        // Parameter: (Model Tujuan, Foreign Key di tabel tujuan, Local Key di tabel saat ini)
        // Disamakan ke 'id_user' sebagai jembatan penghubungnya
        return $this->hasMany(Transaksi::class, 'id_user', 'id_user');
    }
}
