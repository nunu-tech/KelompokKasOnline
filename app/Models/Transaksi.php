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
        // Parameter kedua: nama kolom di tabel transaksis (id_user)
        // Parameter ketiga: nama primary key di tabel users (id_user)
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    /**
     * RELASI: Menghubungkan ke Bendahara
     */
    public function bendahara()
    {
        // Parameter kedua: nama kolom di tabel transaksis (id_bendahara)
        // Parameter ketiga: nama primary key di tabel users (id_user)
        return $this->belongsTo(User::class, 'id_bendahara', 'id_user');
    }
}