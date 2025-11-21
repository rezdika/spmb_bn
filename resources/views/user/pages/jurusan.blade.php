@extends('user.main')

@section('title', 'Program Keahlian - PPDB SMK Bakti Nusantara 666')

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/css/jurusan.css') }}">
@endsection

@section('hero')
<section class="text-white py-5 position-relative" style="min-height: 100vh; display: flex; align-items: center;">
    <div class="position-absolute w-100 h-100" style="background: url('{{ asset('assets/image/banner-jurusan/bdp.jpg') }}'); background-size: cover; background-position: center;  z-index: -1;"></div>
    <div class="container py-5 position-relative">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <div class="badge mb-3 px-3 py-2" style="background-color: #F5E8C7; color: #1B1A55;">
                    <i class="fas fa-tools me-2"></i>Program Keahlian
                </div>
                <h1 class="display-4 fw-bold mb-4">5 Jurusan Unggulan untuk Masa Depan Cemerlang</h1>
                <p class="lead mb-4 opacity-90">Pilih jurusan sesuai passion dan minatmu. Setiap program keahlian dirancang khusus untuk menghasilkan lulusan yang siap kerja dan berdaya saing tinggi.</p>
                <div class="d-flex align-items-center gap-4 text-white">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-users me-2"></i>
                        <span>180 Kuota Total</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="fas fa-briefcase me-2"></i>
                        <span>96% Tingkat Kerja</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="fas fa-money-bill-wave me-2"></i>
                        <span>Gaji 8-18 Juta</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('content')
<!-- Jurusan Section -->
<section class="py-5" style=" background:#1B1A55;">
    <div class="container">
        <div class="text-center mb-5 mt-5">
            <h2 class="fw-bold text-uppercase text-white" id="major-title">PEMROGRAMAN PERANGKAT LUNAK & GIM</h2>
        </div>
        
        <div class="row align-items-center mb-5">
            <div class="col-lg-6 mb-4 mb-lg-0" id="major-photo">
                <img src="{{ asset('assets/image/siswa/pplg.png') }}" alt="Siswa PPLG" class="img-fluid" style="width: 100%; height: 500px; object-fit: cover;">
            </div>
            
            <div class="col-lg-6 ps-lg-5" id="major-details">
                <h3 class="fw-bold mb-3 text-white">PPLG - Pengembangan Perangkat Lunak & Gim</h3>
                <p class="mb-4 text-white">Jurusan yang mempersiapkan kamu untuk menjadi talenta digital masa depan. Di sini kamu belajar membangun aplikasi, website, hingga game yang bisa digunakan banyak orang.</p>
                
                <div class="mb-4">
                    <h6 class="fw-bold mb-3 text-white">💼 Prospek Karier:</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2 text-white">• Software Developer (8-15 juta/bulan)</li>
                        <li class="mb-2 text-white">• Game Developer (10-18 juta/bulan)</li>
                        <li class="mb-2 text-white">• Full Stack Developer (12-20 juta/bulan)</li>
                    </ul>
                </div>
                
                <div class="mb-4">
                    <h6 class="fw-bold mb-3 text-white">🛠️ Skills yang Dipelajari:</h6>
                    <div class="d-flex flex-wrap gap-2">
                        <span class="badge bg-light text-dark px-3 py-2">HTML/CSS</span>
                        <span class="badge bg-light text-dark px-3 py-2">JavaScript</span>
                        <span class="badge bg-light text-dark px-3 py-2">PHP</span>
                        <span class="badge bg-light text-dark px-3 py-2">Laravel</span>
                    </div>
                </div>
                
                <a href="{{ route('pendaftaran.index') }}?jurusan=1" class="btn btn-lg px-4 py-3 daftar-btn" style="background-color: #F5E8C7; color: #1B1A55;" data-jurusan="1">
                    Daftar Sekarang
                </a>
            </div>
        </div>
        
        <!-- Navigation Buttons -->
        <div class="text-center mb-4">
            <div class="btn-group flex-wrap" role="group">
                <button type="button" class="btn btn-outline-light major-nav-btn active" data-major="pplg">PPLG</button>
                <button type="button" class="btn btn-outline-light major-nav-btn" data-major="dkv">DKV</button>
                <button type="button" class="btn btn-outline-light major-nav-btn" data-major="akuntansi">Akuntansi</button>
                <button type="button" class="btn btn-outline-light major-nav-btn" data-major="anm">ANM</button>
                <button type="button" class="btn btn-outline-light major-nav-btn" data-major="pemasaran">Pemasaran</button>
            </div>
        </div>
    </div>
</section>

<!-- Kenali Jurusan Section -->
<section class="py-5" style="background-color: #f8f9fa;">
    <div class="container">
        <div class="mb-5">
            <div class="d-flex align-items-center mb-2">
                <div class="d-flex align-items-center me-3">
                    <span style="width: 8px; height: 8px; background-color: #1B1A55; border-radius: 50%; display: inline-block;"></span>
                    <span style="width: 8px; height: 8px; background-color: #1B1A55; border-radius: 50%; display: inline-block; margin-left: 4px;"></span>
                    <span style="width: 8px; height: 8px; background-color: #1B1A55; border-radius: 50%; display: inline-block; margin-left: 4px;"></span>
                    <div style="width: 60px; height: 3px; background-color: #1B1A55; margin-left: 8px;"></div>
                </div>
                <h2 class="fw-bold mb-0" style="color: #1B1A55;">Kenali Jurusan</h2>
            </div>
            <p class="text-muted ms-5 ps-4">SMK Bakti Nusantara 666</p>
        </div>

        <!-- Video Utama -->
        <div class="mb-5">
            <div class="ratio ratio-16x9" style="max-width: 100%; margin: 0 auto;">
                <video controls class="w-100" style="border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                    <source src="{{ asset('assets/media/jurusan.mp4') }}" type="video/mp4">
                    Browser Anda tidak mendukung video.
                </video>
            </div>
        </div>

        <!-- Grid Video YouTube -->
        <div class="row g-4 mb-4">
            <div class="col-md-4">
                <div class="ratio ratio-16x9">
                    <iframe src="https://www.youtube.com/embed/l0HaezFwS7I" title="Video 1" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="border-radius: 8px;"></iframe>
                </div>
            </div>
            <div class="col-md-4">
                <div class="ratio ratio-16x9">
                    <iframe src="https://www.youtube.com/embed/r5Jju0XRi2E" title="Video 2" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="border-radius: 8px;"></iframe>
                </div>
            </div>
            <div class="col-md-4">
                <div class="ratio ratio-16x9">
                    <iframe src="https://www.youtube.com/embed/jAt_FUdtyn0" title="Video 3" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="border-radius: 8px;"></iframe>
                </div>
            </div>
            <div class="col-md-4">
                <div class="ratio ratio-16x9">
                    <iframe src="https://www.youtube.com/embed/aqB95sjSG6g" title="Video 4" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="border-radius: 8px;"></iframe>
                </div>
            </div>
            <div class="col-md-4">
                <div class="ratio ratio-16x9">
                    <iframe src="https://www.youtube.com/embed/G06hdHvT2IQ" title="Video 5" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="border-radius: 8px;"></iframe>
                </div>
            </div>
            <div class="col-md-4">
                <div class="ratio ratio-16x9">
                    <iframe src="https://www.youtube.com/embed/_UljO3g9fsM" title="Video 6" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="border-radius: 8px;"></iframe>
                </div>
            </div>
        </div>

        <!-- Button Selengkapnya -->
        <div class="text-center">
            <a href="https://www.youtube.com/@baknustv9545" target="_blank" class="btn btn-lg px-5 py-3" style="background-color: #F5E8C7; color: #1B1A55; font-weight: 600; border-radius: 8px;">
                <i class="fab fa-youtube me-2"></i>Selengkapnya
            </a>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <!-- FAQ Categories -->
            <div class="col-lg-3">
                <h3 class="fw-bold mb-4" style="color: #1B1A55;">Pertanyaan Seputar Jurusan</h3>
                <div class="list-group list-group-flush">
                    <a href="#" class="list-group-item list-group-item-action active border-0 py-3" data-category="pemilihan-jurusan" style="background-color: #F5E8C7; color: #1B1A55; font-weight: 600;">
                        Pemilihan Jurusan
                    </a>
                    <a href="#" class="list-group-item list-group-item-action border-0 py-3" data-category="prospek-karir" style="color: #1B1A55;">
                        Prospek Karir
                    </a>
                    <a href="#" class="list-group-item list-group-item-action border-0 py-3" data-category="fasilitas" style="color: #1B1A55;">
                        Fasilitas
                    </a>
                    <a href="#" class="list-group-item list-group-item-action border-0 py-3" data-category="persyaratan" style="color: #1B1A55;">
                        Persyaratan
                    </a>
                </div>
            </div>
            
            <!-- FAQ Content -->
            <div class="col-lg-9">
                <div class="faq-content" id="pemilihan-jurusan">
                    <div class="mb-4">
                        <h5 class="fw-bold mb-3" style="color: #1B1A55;">Bisakah pindah jurusan setelah diterima?</h5>
                        <p class="text-muted">Pindah jurusan hanya bisa dilakukan di semester 1 dengan syarat ada kuota kosong di jurusan tujuan dan persetujuan dari kedua jurusan.</p>
                    </div>
                    <div class="mb-4">
                        <h5 class="fw-bold mb-3" style="color: #1B1A55;">Bagaimana cara memilih jurusan yang tepat?</h5>
                        <p class="text-muted">Pertimbangkan minat, bakat, dan prospek karir masa depan. Konsultasikan dengan orang tua dan guru BK untuk mendapat saran yang tepat.</p>
                    </div>
                    <div class="mb-4">
                        <h5 class="fw-bold mb-3" style="color: #1B1A55;">Apakah ada tes masuk untuk jurusan tertentu?</h5>
                        <p class="text-muted">Tidak ada tes masuk khusus. Seleksi berdasarkan nilai rapor, kelengkapan berkas, dan urutan pendaftaran (first come first served).</p>
                    </div>
                    <div class="mb-4">
                        <h5 class="fw-bold mb-3" style="color: #1B1A55;">Berapa kuota masing-masing jurusan?</h5>
                        <p class="text-muted">Setiap jurusan memiliki kuota 36 siswa. Total kuota keseluruhan adalah 180 siswa untuk 5 jurusan yang tersedia.</p>
                    </div>
                </div>
                
                <div class="faq-content d-none" id="prospek-karir">
                    <div class="mb-4">
                        <h5 class="fw-bold mb-3" style="color: #1B1A55;">Jurusan mana yang paling mudah dapat kerja?</h5>
                        <p class="text-muted">Semua jurusan memiliki prospek kerja yang baik. PPLG dan DKV memiliki demand tinggi di era digital, sedangkan Akuntansi dan ANM selalu dibutuhkan.</p>
                    </div>
                    <div class="mb-4">
                        <h5 class="fw-bold mb-3" style="color: #1B1A55;">Berapa rata-rata gaji lulusan SMK BN 666?</h5>
                        <p class="text-muted">Rata-rata gaji fresh graduate berkisar 4-8 juta rupiah, tergantung jurusan dan perusahaan. Setelah berpengalaman bisa mencapai 10-20 juta rupiah.</p>
                    </div>
                    <div class="mb-4">
                        <h5 class="fw-bold mb-3" style="color: #1B1A55;">Apakah ada program magang?</h5>
                        <p class="text-muted">Ya, semua jurusan memiliki program magang di perusahaan partner. Magang dilakukan di kelas 12 selama 6 bulan untuk pengalaman kerja nyata.</p>
                    </div>
                </div>
                
                <div class="faq-content d-none" id="fasilitas">
                    <div class="mb-4">
                        <h5 class="fw-bold mb-3" style="color: #1B1A55;">Apa saja fasilitas yang tersedia?</h5>
                        <p class="text-muted">Lab komputer gaming spec, studio desain dengan iMac Pro, workshop praktik, perpustakaan digital, dan fasilitas olahraga lengkap.</p>
                    </div>
                    <div class="mb-4">
                        <h5 class="fw-bold mb-3" style="color: #1B1A55;">Apakah ada asrama atau tempat tinggal?</h5>
                        <p class="text-muted">Saat ini belum ada asrama, namun kami memiliki daftar kos dan kontrakan yang aman dan terjangkau di sekitar sekolah.</p>
                    </div>
                    <div class="mb-4">
                        <h5 class="fw-bold mb-3" style="color: #1B1A55;">Bagaimana dengan fasilitas transportasi?</h5>
                        <p class="text-muted">Sekolah mudah diakses dengan transportasi umum. Tersedia parkir luas untuk motor dan mobil siswa yang membawa kendaraan pribadi.</p>
                    </div>
                </div>
                
                <div class="faq-content d-none" id="persyaratan">
                    <div class="mb-4">
                        <h5 class="fw-bold mb-3" style="color: #1B1A55;">Berapa nilai minimum untuk diterima?</h5>
                        <p class="text-muted">Tidak ada nilai minimum khusus, namun kami merekomendasikan rata-rata rapor minimal 7.0 untuk meningkatkan peluang diterima.</p>
                    </div>
                    <div class="mb-4">
                        <h5 class="fw-bold mb-3" style="color: #1B1A55;">Apakah ada jalur beasiswa?</h5>
                        <p class="text-muted">Ya, tersedia beasiswa prestasi akademik dan non-akademik, serta beasiswa untuk siswa kurang mampu dengan syarat dan ketentuan berlaku.</p>
                    </div>
                    <div class="mb-4">
                        <h5 class="fw-bold mb-3" style="color: #1B1A55;">Bagaimana dengan siswa dari luar daerah?</h5>
                        <p class="text-muted">Siswa dari luar daerah sangat diterima. Kami akan membantu informasi tempat tinggal dan adaptasi dengan lingkungan sekolah.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<!-- CTA Section -->
<section class="py-5 position-relative" style="background: url('{{ asset('assets/image/background.png') }}'); background-size: cover; background-position: center;">
    <div class="container text-center text-white">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h2 class="fw-bold mb-4">Sudah Menentukan Pilihan?</h2>
                <p class="lead mb-4 opacity-90">Jangan tunda lagi! Beberapa jurusan sudah hampir penuh. Daftar sekarang sebelum kuota habis dan wujudkan impianmu!</p>
                <div class="d-flex justify-content-center gap-3 flex-wrap mb-4">
                    <a href="{{ route('pendaftaran.index') }}" class="btn btn-lg px-5 py-3 fw-bold" style="background-color: #F5E8C7; color: #1B1A55;">
                        Daftar Sekarang
                    </a>
                    <a href="{{ route('kontak') }}" class="btn btn-outline-light btn-lg px-5 py-3">
                        <i class="fas fa-question-circle me-2"></i>Konsultasi Jurusan
                    </a>
                </div>
                <div class="row g-3 justify-content-center">
                    <div class="col-auto">
                        <small class="opacity-75">✅ Kuota Terbatas</small>
                    </div>
                    <div class="col-auto">
                        <small class="opacity-75">✅ First Come First Served</small>
                    </div>
                    <div class="col-auto">
                        <small class="opacity-75">✅ 96% Tingkat Kerja</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script src="{{ asset('assets/js/jurusan.js') }}"></script>
@endsection