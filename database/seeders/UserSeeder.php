<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'nama_lengkap' => 'Admin SPMB',
            'email' => 'admin@spmb.com',
            'role' => 'admin',
            'no_hp' => '081234567890',
            'password' => Hash::make('admin123'),
        ]);

        User::create([
            'nama_lengkap' => 'Panitia SPMB',
            'email' => 'panitia@spmb.com',
            'role' => 'panitia',
            'no_hp' => '081234567891',
            'password' => Hash::make('panitia123'),
        ]);

        User::create([
            'nama_lengkap' => 'Ahmad Rizki Pratama',
            'email' => 'ahmad@test.com',
            'role' => 'calon_siswa',
            'no_hp' => '081234567892',
            'password' => Hash::make('password'),
        ]);
    }
}