<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Akun Siswa (Melani)
        User::create([
            'nama_lengkap' => 'Melani', // Sesuai migration
            'kelamin'      => 'perempuan',
            'username'     => 'melani123',
            'email'        => 'melani@gmail.com',
            'password'     => Hash::make('password123'),
            'id_role'      => 2, 
        ]);

        // 2. Akun Bendahara Kelas
        User::create([
            'nama_lengkap' => 'Bendahara Kelas', // Sesuai migration
            'kelamin'      => 'laki-laki', 
            'username'     => 'bendahara123', 
            'email'        => 'bendahara@gmail.com', 
            'password'     => Hash::make('bendahara123'), 
            'id_role'      => 3, 
        ]);
    }
}