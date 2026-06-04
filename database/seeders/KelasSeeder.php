<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kelas;

class KelasSeeder extends Seeder
{
    public function run(): void
    {
        Kelas::insert([
        [
                'nama_kelas' => 'Guru',
                'created_at' => now(),
                'updated_at' => now(),
            ],    
        [
                'nama_kelas' => 'X RPL 1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kelas' => 'X RPL 2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kelas' => 'XI RPL 1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kelas' => 'XI RPL 2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kelas' => 'XII RPL 1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
