<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kas extends Model
{
    protected $table = 'kas';

    protected $fillable = [
        'nama',
        'tanggal',
        'jumlah',
        'keterangan'
    ];

    public function siswa()
{
    return $this->belongsTo(Siswa::class);
}
}