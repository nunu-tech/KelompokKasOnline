<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksis';
    protected $primaryKey = 'id_transaksi';

    protected $fillable = [
        'id_bendahara', 
        'id_user', 
        'jenis', 
        'nominal', 
        'keterangan', 
        'tanggal'
    ];

    /**
     * RELASI: Menghubungkan ke Siswa
     */
    public function user()
    {
        // 'id_user' di Transaksi merujuk ke 'id' di tabel Users
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    /**
     * RELASI: Menghubungkan ke Bendahara
     */
    public function bendahara()
    {
        return $this->belongsTo(User::class, 'id_bendahara', 'id');
    }
}