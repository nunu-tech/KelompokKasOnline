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
        // Ganti 'name' menjadi 'nama_lengkap' dan tambahkan id_role
        User::create([
            'nama_lengkap' => 'Melani',
            'kelamin'      => 'P',
            'username'     => 'melani123',
            'email'        => 'melani@gmail.com',
            'password'     => Hash::make('admin123'),
            'role'      => 1, // Sesuaikan dengan id_role untuk Siswa
        ]);
    }
}
