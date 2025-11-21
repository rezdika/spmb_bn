<?php

namespace Database\Seeders;

use App\Models\Gelombang;
use Illuminate\Database\Seeder;

class GelombangSeeder extends Seeder
{
    public function run(): void
    {
        Gelombang::create([
            'nama' => 'Gelombang 1',
            'tahun' => 2026,
            'tgl_mulai' => '2026-01-15',
            'tgl_selesai' => '2026-03-15',
            'biaya_daftar' => 150000.00,
            'status' => 'aktif'
        ]);
        
        Gelombang::create([
            'nama' => 'Gelombang 2',
            'tahun' => 2026,
            'tgl_mulai' => '2026-04-01',
            'tgl_selesai' => '2026-06-01',
            'biaya_daftar' => 175000.00,
            'status' => 'aktif'
        ]);
        
    }
}