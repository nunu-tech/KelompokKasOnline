<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany; // Pastikan ini tetap ada untuk relasi

class User extends Authenticatable
{
    use HasFactory, Notifiable;


    // 1. Primary Key disesuaikan dengan ERD kamu
    protected $primaryKey = 'id_user';

    //  Berhasil dibersihkan dari conflict Git, disatukan menjadi satu baris bersih
    protected $primaryKey = 'id'; 


    // 2. Kolom-kolom disesuaikan dengan tabel users yang baru
    protected $fillable = [
        'id_kelas',
        'nama_lengkap', // Menggantikan 'name'
        'kelamin', 
        'username',
        'email',
        'password',
        'id_role',
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



    //  * RELASI: User punya banyak Transaksi
    //  */
    public function transaksi(): HasMany
    {
        // Parameter: (Model Tujuan, Foreign Key di tabel tujuan, Local Key di tabel saat ini)
        // Karena Primary Key kita sekarang 'id_user', maka diubah menjadi seperti ini:
        return $this->hasMany(Transaksi::class, 'id_user', 'id_user');
    }
}