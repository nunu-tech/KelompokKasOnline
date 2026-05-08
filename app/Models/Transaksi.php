<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksis';
    protected $primaryKey = 'id_transaksi';

    // Kolom yang boleh diisi lewat web (Mass Assignment)
    protected $fillable = [
        'id_bendahara', 
        'id_user', 
        'jenis', 
        'nominal', 
        'keterangan', 
        'tanggal'
    ];

    /**
     * RELASI: Transaksi ini dimiliki oleh seorang Siswa (User)
     * Ini yang bikin kamu bisa panggil $item->user->name di tampilan
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    /**
     * RELASI: Transaksi ini dicatat oleh seorang Bendahara (User)
     */
    public function bendahara()
    {
        return $this->belongsTo(User::class, 'id_bendahara', 'id_user');
    }
}
