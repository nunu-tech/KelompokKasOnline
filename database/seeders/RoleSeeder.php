<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        Role::insert([
            [
                'nama_role' => 'Admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_role' => 'Bendahara',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_role' => 'Siswa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_role' => 'Walikelas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
