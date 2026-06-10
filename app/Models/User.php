<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{

    protected $primaryKey = 'id_user';

    protected $fillable = [
        'nama_lengkap',
        'username',
        'email',
        'kelamin',
        'password',
        'role',
    ];
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




    //  * RELASI: User punya banyak Transaksi
    //  */
    public function transaksi(): HasMany
    {
        // Primary key user: id_user, foreign key di transaksi: id_user
        return $this->hasMany(Transaksi::class, 'id_user', 'id_user');
    }
}
