<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Prestasi;
use Illuminate\Support\Str;

class PrestasiSeeder extends Seeder
{
    public function run(): void
    {
        $prestasi = [
            [
                'title' => 'Juara 1 Lomba Web Design Tingkat Nasional',
                'category' => 'Teknologi',
                'student_name' => 'Rizky Pratama',
                'class' => 'XII PPLG 1',
                'achievement_date' => '2024-03-15',
                'organizer' => 'Kementerian Pendidikan dan Kebudayaan',
                'level' => 'Nasional',
                'description' => 'Berhasil meraih juara 1 dalam kompetisi web design tingkat nasional dengan karya website e-commerce yang inovatif dan user-friendly.',
                'full_description' => 'Rizky Pratama berhasil mengharumkan nama SMK Bakti Nusantara 666 dengan meraih juara 1 dalam Lomba Web Design Tingkat Nasional yang diselenggarakan oleh Kementerian Pendidikan dan Kebudayaan. Kompetisi ini diikuti oleh lebih dari 500 peserta dari seluruh Indonesia.

Karya Rizky berupa website e-commerce dengan desain modern, responsif, dan memiliki user experience yang sangat baik. Website tersebut dilengkapi dengan fitur-fitur canggih seperti payment gateway, live chat, dan sistem rekomendasi produk berbasis AI.

Prestasi ini membuktikan bahwa siswa SMK Bakti Nusantara 666 memiliki kompetensi yang sangat baik dalam bidang teknologi informasi dan siap bersaing di tingkat nasional maupun internasional.',
                'image' => 'prestasi/web-design.jpg',
                'is_active' => true
            ],
            [
                'title' => 'Juara 2 Lomba Desain Grafis Tingkat Provinsi',
                'category' => 'Seni',
                'student_name' => 'Anisa Putri',
                'class' => 'XI DKV 2',
                'achievement_date' => '2024-02-20',
                'organizer' => 'Dinas Pendidikan Provinsi',
                'level' => 'Provinsi',
                'description' => 'Meraih juara 2 dalam lomba desain grafis dengan tema "Indonesia Maju" yang menampilkan karya poster digital yang memukau.',
                'full_description' => 'Anisa Putri dari kelas XI DKV 2 berhasil meraih juara 2 dalam Lomba Desain Grafis Tingkat Provinsi dengan tema "Indonesia Maju". Kompetisi ini diikuti oleh 150 peserta dari berbagai sekolah di provinsi.

Karya Anisa berupa poster digital yang menggambarkan visi Indonesia di masa depan dengan perpaduan warna yang harmonis dan komposisi yang sangat baik. Desain tersebut berhasil menarik perhatian dewan juri karena pesan yang kuat dan eksekusi visual yang profesional.

Prestasi ini menunjukkan bahwa siswa jurusan DKV di SMK Bakti Nusantara 666 memiliki kreativitas dan skill desain yang sangat baik.',
                'image' => 'prestasi/desain-grafis.jpg',
                'is_active' => true
            ],
            [
                'title' => 'Juara 1 Olimpiade Akuntansi Tingkat Kota',
                'category' => 'Akademik',
                'student_name' => 'Budi Santoso',
                'class' => 'XII Akuntansi 1',
                'achievement_date' => '2024-01-10',
                'organizer' => 'Dinas Pendidikan Kota',
                'level' => 'Kota',
                'description' => 'Meraih juara 1 dalam Olimpiade Akuntansi dengan nilai sempurna dalam semua babak kompetisi.',
                'full_description' => 'Budi Santoso membuktikan keunggulan akademiknya dengan meraih juara 1 dalam Olimpiade Akuntansi Tingkat Kota. Kompetisi ini terdiri dari beberapa babak mulai dari tes tertulis, studi kasus, hingga presentasi.

Budi berhasil meraih nilai sempurna dalam semua babak dan mengungguli 80 peserta lainnya. Kemampuannya dalam menganalisis laporan keuangan dan memecahkan kasus akuntansi yang kompleks sangat mengesankan dewan juri.

Prestasi ini membuktikan bahwa program pembelajaran di jurusan Akuntansi SMK Bakti Nusantara 666 sangat berkualitas dan mampu mencetak siswa yang kompeten di bidangnya.',
                'image' => 'prestasi/olimpiade-akuntansi.jpg',
                'is_active' => true
            ],
            [
                'title' => 'Juara 3 Lomba Animasi 3D Tingkat Nasional',
                'category' => 'Teknologi',
                'student_name' => 'Sari Wulandari',
                'class' => 'XII Animasi 1',
                'achievement_date' => '2024-04-05',
                'organizer' => 'Indonesian Animation Association',
                'level' => 'Nasional',
                'description' => 'Berhasil meraih juara 3 dalam lomba animasi 3D dengan karya short movie berdurasi 5 menit yang menawan.',
                'full_description' => 'Sari Wulandari dari jurusan Animasi berhasil meraih juara 3 dalam Lomba Animasi 3D Tingkat Nasional yang diselenggarakan oleh Indonesian Animation Association. Kompetisi ini diikuti oleh lebih dari 300 peserta dari seluruh Indonesia.

Karya Sari berupa short movie animasi 3D berdurasi 5 menit dengan tema "Pelestarian Lingkungan". Animasi tersebut menampilkan karakter yang menarik, cerita yang kuat, dan kualitas rendering yang sangat baik.

Prestasi ini menunjukkan bahwa siswa jurusan Animasi di SMK Bakti Nusantara 666 memiliki kemampuan teknis dan kreativitas yang sangat baik dalam menciptakan karya animasi berkualitas tinggi.',
                'image' => 'prestasi/animasi-3d.jpg',
                'is_active' => true
            ],
            [
                'title' => 'Juara 1 Lomba Mobile App Development',
                'category' => 'Teknologi',
                'student_name' => 'Dimas Prasetyo',
                'class' => 'XII PPLG 2',
                'achievement_date' => '2024-03-25',
                'organizer' => 'Google Developer Student Clubs',
                'level' => 'Nasional',
                'description' => 'Meraih juara 1 dalam lomba pengembangan aplikasi mobile dengan aplikasi edukasi yang inovatif.',
                'full_description' => 'Dimas Prasetyo berhasil meraih juara 1 dalam Lomba Mobile App Development yang diselenggarakan oleh Google Developer Student Clubs. Kompetisi ini diikuti oleh lebih dari 400 peserta dari berbagai universitas dan sekolah di Indonesia.

Aplikasi yang dikembangkan Dimas adalah aplikasi edukasi untuk anak-anak dengan fitur gamifikasi yang menarik. Aplikasi tersebut menggunakan teknologi Flutter dan Firebase, serta memiliki UI/UX yang sangat baik.

Dewan juri sangat terkesan dengan inovasi dan kualitas aplikasi yang dikembangkan oleh Dimas. Prestasi ini membuktikan bahwa siswa SMK Bakti Nusantara 666 mampu bersaing dengan mahasiswa dari universitas terkemuka.',
                'image' => 'prestasi/mobile-app.jpg',
                'is_active' => true
            ],
            [
                'title' => 'Juara 2 Lomba Video Editing Tingkat Provinsi',
                'category' => 'Seni',
                'student_name' => 'Maya Anggraini',
                'class' => 'XI DKV 1',
                'achievement_date' => '2024-02-15',
                'organizer' => 'Dinas Pariwisata Provinsi',
                'level' => 'Provinsi',
                'description' => 'Meraih juara 2 dalam lomba video editing dengan tema promosi wisata daerah yang kreatif dan menarik.',
                'full_description' => 'Maya Anggraini berhasil meraih juara 2 dalam Lomba Video Editing Tingkat Provinsi dengan tema "Promosi Wisata Daerah". Kompetisi ini diselenggarakan oleh Dinas Pariwisata Provinsi dan diikuti oleh 120 peserta.

Video yang dibuat Maya menampilkan keindahan wisata daerah dengan teknik editing yang profesional, color grading yang menarik, dan storytelling yang kuat. Video tersebut berhasil menarik perhatian dewan juri dan mendapat apresiasi yang tinggi.

Prestasi ini menunjukkan bahwa siswa jurusan DKV di SMK Bakti Nusantara 666 tidak hanya mahir dalam desain grafis, tetapi juga dalam video production dan editing.',
                'image' => 'prestasi/video-editing.jpg',
                'is_active' => true
            ]
        ];

        foreach ($prestasi as $item) {
            Prestasi::create($item);
        }
    }
}
