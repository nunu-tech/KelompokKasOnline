<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany; // Pastikan ini tetap ada untuk relasi

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    //  Berhasil dibersihkan dari conflict Git, disatukan menjadi satu baris bersih
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



    //  * RELASI: User punya banyak Transaksi
    //  */
    public function transaksi(): HasMany
    {
        // Parameter: (Model Tujuan, Foreign Key di tabel tujuan, Local Key di tabel saat ini)
        // Karena Primary Key kita sekarang 'id_user', maka diubah menjadi seperti ini:
        return $this->hasMany(Transaksi::class, 'id_user', 'id_user');
    }
}
