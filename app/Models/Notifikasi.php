<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    use HasFactory;

    // Menentukan nama tabel di database secara spesifik
    protected $table = 'notifikasis';

    // Mengizinkan kolom-kolom ini untuk diisi oleh Controller
    protected $fillable = [
        'siswa_id',
        'pesan',
        'is_read',
    ];

    /**
     * Relasi balik ke tabel User/Siswa (Opsional tapi bagus untuk laporan)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'siswa_id');
    }
}