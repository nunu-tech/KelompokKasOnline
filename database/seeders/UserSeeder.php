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
        User::create([
            'nama_lengkap' => 'Nunu',
            'kelamin'      => 'Laki-Laki',
            'username'     => 'nunu123',
            'email'        => 'nunu@gmail.com',
            'password'     => Hash::make('password123'),
            'id_role'      => 1, // Sesuaikan dengan id_role untuk Admin
            'id_kelas'     => 2  // Sesuaikan dengan id_kelas untuk kelas X RPL 1
        ]);
        

        User::create([
            'nama_lengkap' => 'Melani',
            'kelamin'      => 'Perempuan',
            'username'     => 'melani123',
            'email'        => 'melani@gmail.com',
            'password'     => Hash::make('password123'),
            'id_role'      => 2, // Sesuaikan dengan id_role untuk Bendahara
            'id_kelas'     => 2  // Sesuaikan dengan id_kelas untuk kelas X RPL 1
        ]);

        User::create([
            'nama_lengkap' => 'Faiq',
            'kelamin'      => 'Laki-Laki',
            'username'     => 'faiq123',
            'email'        => 'faiq@gmail.com',
            'password'     => Hash::make('password123'),
            'id_role'      => 3, // Sesuaikan dengan id_role untuk Walikelas
            'id_kelas'     => 2 // Sesuaikan dengan id_kelas untuk kelas X RPL 1
        ]); 
        User::create([
            'nama_lengkap' => 'Fajrina',
            'kelamin'      => 'Perempuan',
            'username'     => 'fajrina123',
            'email'        => 'fajrina@gmail.com',
            'password'     => Hash::make('password123'),
            'id_role'      => 4, // Sesuaikan dengan id_role untuk Walikelas
            'id_kelas'     => 1 // Sesuaikan dengan id_kelas untuk kelas Guru
        ]);
    }
}

            
