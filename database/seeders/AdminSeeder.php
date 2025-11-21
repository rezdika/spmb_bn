<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'nama_lengkap' => 'Administrator',
            'email' => 'admin@smkbaktinusantara.sch.id',
            'no_hp' => '081234567890',
            'role' => 'admin',
            'password' => Hash::make('admin123'),
        ]);

        User::create([
            'nama_lengkap' => 'Panitia PPDB',
            'email' => 'panitia@smkbaktinusantara.sch.id',
            'no_hp' => '081234567891',
            'role' => 'panitia',
            'password' => Hash::make('panitia123'),
        ]);

        User::create([
            'nama_lengkap' => 'Bagian Keuangan',
            'email' => 'keuangan@smkbaktinusantara.sch.id',
            'no_hp' => '081234567892',
            'role' => 'keuangan',
            'password' => Hash::make('keuangan123'),
        ]);

        User::create([
            'nama_lengkap' => 'Kepala Sekolah',
            'email' => 'kepsek@smkbaktinusantara.sch.id',
            'no_hp' => '081234567893',
            'role' => 'kepala_sekolah',
            'password' => Hash::make('kepsek123'),
        ]);
    }
}