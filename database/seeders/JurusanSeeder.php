<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Jurusan;

class JurusanSeeder extends Seeder
{
    public function run(): void
    {
        $jurusans = [
            [
                'kode' => 'PPLG',
                'nama' => 'Pengembangan Perangkat Lunak & Gim',
                'deskripsi' => 'Jurusan yang mempersiapkan kamu untuk menjadi talenta digital masa depan. Di sini kamu belajar membangun aplikasi, website, hingga game yang bisa digunakan banyak orang.',
                'kuota' => 36
            ],
            [
                'kode' => 'DKV',
                'nama' => 'Desain Komunikasi Visual',
                'deskripsi' => 'Jurusan yang mengembangkan kreativitas dan kemampuan desain untuk menciptakan karya visual yang menarik dan komunikatif.',
                'kuota' => 36
            ],
            [
                'kode' => 'AKL',
                'nama' => 'Akuntansi & Keuangan Lembaga',
                'deskripsi' => 'Jurusan yang mempersiapkan tenaga ahli di bidang akuntansi dan keuangan dengan kemampuan analisis yang kuat.',
                'kuota' => 36
            ],
            [
                'kode' => 'ANM',
                'nama' => 'Animasi',
                'deskripsi' => 'Jurusan yang mempersiapkan tenaga kesehatan profesional dengan kemampuan merawat dan membantu pasien.',
                'kuota' => 36
            ],
            [
                'kode' => 'BDP',
                'nama' => 'Bisnis Daring & Pemasaran',
                'deskripsi' => 'Jurusan yang mempersiapkan ahli pemasaran digital dan bisnis online di era teknologi modern.',
                'kuota' => 36
            ]
        ];

        foreach ($jurusans as $jurusan) {
            Jurusan::create($jurusan);
        }
    }
}