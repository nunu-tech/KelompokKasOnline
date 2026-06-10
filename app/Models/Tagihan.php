<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    use HasFactory;

    // Beritahu Laravel nama tabel yang benar (karena defaultnya Laravel akan mencari 'tagihans')
    protected $table = 'tagihan';
    
    // Beritahu primary key-nya
    protected $primaryKey = 'id_tagihan';

    // Kolom yang boleh diisi
    protected $fillable = [
        'id_user',
        'nominal',
        'keterangan',
        'jatuh_tempo',
        'status',
    ];

    /**
     * Relasi ke Model User (Siswa)
     * Satu tagihan dimiliki oleh satu user
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
