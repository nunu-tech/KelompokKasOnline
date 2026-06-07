<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    // Sesuaikan nama tabel jika berbeda
    protected $table = 'roles'; 
    protected $fillable = ['nama_role'];

    // Relasi ke User (1 Role punya banyak User)
    public function users()
    {
        return $this->hasMany(User::class, 'id_role', 'id'); 
    }
}
