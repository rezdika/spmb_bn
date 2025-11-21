@extends('user.main')

@section('title', 'Beranda - PPDB SMK Bakti Nusantara 666')

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/css/home.css') }}">
@endsection

@section('hero')
<section class="hero-gradient text-white" style="background: url('{{ asset('assets/image/hero_section/sekolah_bn.jpg') }}') center/cover no-repeat; min-height: 70vh; position: relative; display: flex; align-items: center;">
    <div class="hero-overlay" style="position: absolute; inset: 0; background: rgba(0,0,0,0.35);"></div>
    <div class="container py-5" style="position: relative; z-index: 2;">
        <div class="row align-items-center min-vh-75">
            <div class="col-lg-6">
                <h1 class="display-3 fw-bold mb-4">Masa Depan Dimulai dari <span style="color: #647FBC;">Pilihan Tepat</span></h1>
                <p class="lead mb-4 opacity-90">Bergabunglah dengan 850+ siswa yang telah memilih SMK Bakti Nusantara 666 sebagai langkah awal menuju karier impian di era digital.</p>
                <div class="d-flex flex-wrap gap-3 mb-4">
                    <a href="{{ route('register') }}" class="btn btn-light btn-lg px-4 py-3">
                    Mulai Pendaftaran
                    </a>
                </div>
                
                <!-- Logo Jurusan -->
                <div class="d-flex align-items-center gap-3 mb-3">
                    <img src="{{ asset('assets/image/logo_jurusan/pplg.png') }}" alt="PPLG" style="width: 80px; height: 80px; object-fit: contain;">
                    <img src="{{ asset('assets/image/logo_jurusan/dkv.png') }}" alt="DKV" style="width: 80px; height: 80px; object-fit: contain;">
                    <img src="{{ asset('assets/image/logo_jurusan/akutansi.png') }}" alt="Akuntansi" style="width: 80px; height: 80px; object-fit: contain;">
                    <img src="{{ asset('assets/image/logo_jurusan/animasi.png') }}" alt="Animasi" style="width: 80px; height: 80px; object-fit: contain;">
                    <img src="{{ asset('assets/image/logo_jurusan/bdp.png') }}" alt="BDP" style="width: 80px; height: 80px; object-fit: contain;">
                </div>
                
                <div class="d-flex align-items-center gap-4 text-sm">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-users me-2"></i>
                        <span>1,200+ Alumni Sukses</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="fas fa-building me-2"></i>
                        <span>50+ Mitra Industri</span>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</section>
@endsection

@section('content')
<!-- Panduan PPDB Section -->
<section class="py-4" style="background: url('{{ asset('assets/image/background2.png') }}') center/cover no-repeat; overflow: visible; margin-top: 150px; position: relative;">
    <div style="position: absolute; inset: 0; background: rgba(27, 26, 85, 0.5);"></div>
    <div class="container" style="position: relative; z-index: 1;">
        <div class="row align-items-center">
            <div class="col-lg-5 position-relative" style="overflow: visible; min-height: 200px;">
                <img src="{{ asset('assets/image/panduan.png') }}" alt="Panduan PPDB 2024" class="img-fluid" style="position: absolute; top: -150px; left: 150px; width: 100%; max-width: 280px; object-fit: contain;">
            </div>
            
            <div class="col-lg-7">
                <div class="text-white ps-lg-4">
                    <h2 class="fw-bold mb-4" style="font-size: 20px;">Pintu masuk ke SMK Bakti Nusantara 666, di sini anda akan mendapatkan semua informasi mengenai tata cara masuk untuk sekolah di SMK BN 666.</h2>
                    
                    <a href="{{ route('panduan') }}" class="btn btn-light px-4 py-2 rounded-pill" style="font-size:16px;">
                        Lihat Panduan <i class="fas fa-arrow-right ms-2"></i> 
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Principal's Message -->
<section class="py-5" style="background-color: white;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h2 class="mb-4" style="color: #1B1A55;">Sambutan Kepala Sekolah</h2>
                <div class="pe-lg-4">
                    <div class="text-justify" style="color: #1B1A55;">
                        <p class="mb-3">Assalamu'alaikum warahmatullahi wabarakatuh.</p>
                        <p class="mb-3">Puji syukur marilah senantiasa kita panjatkan ke hadirat Allah Subhanahu wa Ta'ala, karena atas rahmat, taufik, dan hidayah-Nya, kita masih diberi kesempatan, kesehatan, serta semangat untuk terus menimba ilmu dan berbuat kebaikan.</p>
                        <p class="mb-3">Atas nama keluarga besar SMK Bakti Nusantara 666, kami menyampaikan selamat datang dan apresiasi yang setinggi-tingginya kepada seluruh calon peserta didik baru yang telah memilih dan mempercayakan masa depannya kepada sekolah ini.</p>
                        
                        <div id="shortText">
                            <p class="mb-3">SMK Bakti Nusantara 666 berkomitmen untuk menjadi lembaga pendidikan yang tidak hanya fokus pada peningkatan kompetensi akademik dan keterampilan vokasi, tetapi juga menanamkan nilai-nilai karakter yang luhur. Hal ini sejalan dengan slogan dan jati diri sekolah kami yang ikonik, yaitu <strong>SAJUTA — Santun, Jujur, dan Taat</strong>.</p>
                            <a href="{{ route('sambutan') }}" class="btn btn-link p-0" style="color: #1B1A55; text-decoration: none; font-weight: 600;">
                                Baca Selengkapnya <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <img src="{{ asset('assets/image/sambutan.png') }}" alt="Sambutan Kepala Sekolah" class="img-fluid w-100" style="display:block; border-radius:0; box-shadow:none; max-height:420px; object-fit:cover;">
            </div>
        </div>
    </div>
</section>



<!-- Fasilitas -->
<section class="py-5" style="background-color: #1B1A55; color: white;">
    <div class="container">
        <div class="mb-4">
            <h2 class="fw-bold text-white">Fasilitas <span style="color: #F5E8C7;">Sekolah</span></h2>
        </div>
        <div class="row g-4 align-items-start">
            <div class="col-lg-6">
                <img id="facilityImage" src="{{ asset('assets/image/fasilitas/labkom.jpg') }}" alt="Fasilitas SMK" class="img-fluid rounded-3 shadow">
            </div>
            
            <div class="col-lg-6">
                <div class="mb-4">
                    <h3 id="facilityTitle" class="mb-3 text-white">Laboratorium Komputer Modern</h3>
                    <p id="facilityDescription" class="text-white-50">Dilengkapi dengan 40 unit komputer terbaru dengan spesifikasi tinggi, software development terkini, dan koneksi internet berkecepatan tinggi untuk mendukung pembelajaran programming, desain grafis, dan teknologi informasi.</p>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="facility-item active mb-2" onclick="showFacility(0)">
                            <h6 class="mb-1 text-white">Laboratorium Komputer Modern</h6>
                            <small class="text-white-50">40 unit komputer terbaru</small>
                        </div>
                        <div class="facility-item mb-2" onclick="showFacility(1)">
                            <h6 class="mb-1 text-white">Studio Multimedia & Broadcasting</h6>
                            <small class="text-white-50">Peralatan broadcasting profesional</small>
                        </div>
                        <div class="facility-item mb-2" onclick="showFacility(2)">
                            <h6 class="mb-1 text-white">Workshop Praktik Industri</h6>
                            <small class="text-white-50">Standar industri profesional</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="facility-item mb-2" onclick="showFacility(3)">
                            <h6 class="mb-1 text-white">Perpustakaan Digital</h6>
                            <small class="text-white-50">Ribuan buku & jurnal digital</small>
                        </div>
                        <div class="facility-item mb-2" onclick="showFacility(4)">
                            <h6 class="mb-1 text-white">Ruang Server & Jaringan</h6>
                            <small class="text-white-50">Infrastruktur IT terdepan</small>
                        </div>
                        <div class="facility-item mb-2" onclick="showFacility(5)">
                            <h6 class="mb-1 text-white">Aula Serbaguna</h6>
                            <small class="text-white-50">Kapasitas 500 orang</small>
                        </div>
                    </div>
                </div>
            
            </div>
        </div>
    </div>
</section>



<!-- section jurusan -->
<section class="py-5" style="background-color: white;">
    <div class="container">
        <div class="text-center mb-5">
           
            <h2 class="fw-bold">Pilih Jurusan Sesuai Passion Mu</h2>
            <p class="text-muted">Setiap jurusan dirancang khusus untuk menghasilkan profesional terbaik di bidangnya</p>
        </div>
        <div class="row g-5">
            <div class="col-lg-4 col-md-6">
                <div class="p-4 rounded-3" style="background-color: #1B1A55; color: white; position: relative;">
                    <div class="d-flex align-items-center mb-4">
                        <img src="{{ asset('assets/image/siswa/pplg.png') }}" alt="Siswa PPLG" class="rounded-circle me-4" style="width: 120px; height: 120px; object-fit: cover;">
                        <div>
                            <h5 class="fw-bold mb-1 text-white">PPLG - Coding Expert</h5>
                        </div>
                    </div>
                    <p class="text-white-50 mb-3">Menjadi programmer handal dengan menguasai berbagai bahasa pemrograman terkini</p>
                    <div class="mb-3">
                        <span class="badge bg-light text-dark me-1">React</span>
                        <span class="badge bg-light text-dark me-1">Laravel</span>
                        <span class="badge bg-light text-dark me-1">Mobile Dev</span>
                    </div>
                    <a href="{{ route('jurusan') }}" class="btn btn-sm" style="background-color: #F5E8C7; color: #1B1A55; border: none;">Detail</a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="p-4 rounded-3" style="background-color: #1B1A55; color: white; position: relative;">
                    <div class="d-flex align-items-center mb-4">
                        <img src="{{ asset('assets/image/siswa/dkv.png') }}" alt="Siswa DKV" class="rounded-circle me-4" style="width: 120px; height: 120px; object-fit: cover;">
                        <div>
                            <h5 class="fw-bold mb-1 text-white">DKV - Creative Master</h5>
                        </div>
                    </div>
                    <p class="text-white-50 mb-3">Wujudkan kreativitas menjadi karya visual yang memukau dan bernilai komersial</p>
                    <div class="mb-3">
                        <span class="badge bg-light text-dark me-1">Photoshop</span>
                        <span class="badge bg-light text-dark me-1">Illustrator</span>
                        <span class="badge bg-light text-dark me-1">Video Edit</span>
                    </div>
                    <a href="{{ route('jurusan') }}" class="btn btn-sm" style="background-color: #F5E8C7; color: #1B1A55; border: none;">Detail</a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="p-4 rounded-3" style="background-color: #1B1A55; color: white;">
                    <div class="d-flex align-items-center mb-4">
                        <img src="{{ asset('assets/image/siswa/akt.png') }}" alt="Siswa Akuntansi" class="rounded-circle me-4" style="width: 120px; height: 120px; object-fit: cover;">
                        <div>
                            <h5 class="fw-bold mb-1 text-white">Akuntansi - Finance Pro</h5>
                        </div>
                    </div>
                    <p class="text-white-50 mb-3">Kuasai dunia keuangan dan menjadi ahli akuntansi yang dibutuhkan setiap perusahaan</p>
                    <div class="mb-3">
                        <span class="badge bg-light text-dark me-1">Excel Expert</span>
                        <span class="badge bg-light text-dark me-1">SAP</span>
                        <span class="badge bg-light text-dark me-1">Tax</span>
                    </div>
                    <a href="{{ route('jurusan') }}" class="btn btn-sm" style="background-color: #F5E8C7; color: #1B1A55; border: none;">Detail</a>
                </div>
            </div>
        </div>
        <div class="text-center mt-5">
            <a href="{{ route('jurusan') }}" class="btn btn-lg px-5" style="background-color: #1B1A55; color: white; border: none;">
                <i class="fas fa-eye me-2"></i>Lihat Semua Jurusan
            </a>
        </div>
    </div>
</section>

<!-- Prestasi Siswa -->
<section class="py-5" style="background-color: #F8F9FA;">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold" style="color: #1B1A55;">Prestasi <span style="color: #647FBC;">Siswa</span></h2>
            <p class="text-muted">Kebanggaan kami atas pencapaian luar biasa siswa-siswi SMK Bakti Nusantara 666</p>
        </div>

        @if($prestasi->count() > 0)
            @foreach($prestasi as $index => $item)
                @if($index % 2 == 0)
                    <!-- Foto Kiri, Info Kanan -->
                    <a href="{{ route('prestasi.detail', $item->slug) }}" class="text-decoration-none">
                        <div class="row align-items-center mb-5 g-4">
                            <div class="col-lg-5">
                                <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="img-fluid rounded-3 shadow" style="width: 100%; height: 350px; object-fit: cover;">
                            </div>
                            <div class="col-lg-7">
                                <div class="ps-lg-4">
                                    <div class="mb-3">
                                        <span class="badge px-3 py-2 me-2" style="background-color: #1B1A55; color: white;">{{ $item->category }}</span>
                                        <span class="badge px-3 py-2" style="background-color: #F5E8C7; color: #1B1A55;">{{ $item->level }}</span>
                                    </div>
                                    <h3 class="fw-bold mb-3" style="color: #1B1A55;">{{ $item->title }}</h3>
                                    <div class="mb-3">
                                        <p class="mb-2" style="color: #647FBC;"><i class="fas fa-user me-2"></i><strong>{{ $item->student_name }}</strong> - {{ $item->class }}</p>
                                        <p class="mb-2 text-muted"><i class="fas fa-calendar me-2"></i>{{ $item->formatted_date }}</p>
                                    </div>
                                    <p class="text-muted">{{ Str::limit($item->description, 150) }}</p>
                                </div>
                            </div>
                        </div>
                    </a>
                @else
                    <!-- Info Kiri, Foto Kanan -->
                    <a href="{{ route('prestasi.detail', $item->slug) }}" class="text-decoration-none">
                        <div class="row align-items-center mb-5 g-4">
                            <div class="col-lg-7 order-lg-1 order-2">
                                <div class="pe-lg-4">
                                    <div class="mb-3">
                                        <span class="badge px-3 py-2 me-2" style="background-color: #1B1A55; color: white;">{{ $item->category }}</span>
                                        <span class="badge px-3 py-2" style="background-color: #F5E8C7; color: #1B1A55;">{{ $item->level }}</span>
                                    </div>
                                    <h3 class="fw-bold mb-3" style="color: #1B1A55;">{{ $item->title }}</h3>
                                    <div class="mb-3">
                                        <p class="mb-2" style="color: #647FBC;"><i class="fas fa-user me-2"></i><strong>{{ $item->student_name }}</strong> - {{ $item->class }}</p>
                                        <p class="mb-2 text-muted"><i class="fas fa-calendar me-2"></i>{{ $item->formatted_date }}</p>
                                    </div>
                                    <p class="text-muted">{{ Str::limit($item->description, 150) }}</p>
                                </div>
                            </div>
                            <div class="col-lg-5 order-lg-2 order-1">
                                <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="img-fluid rounded-3 shadow" style="width: 100%; height: 350px; object-fit: cover;">
                            </div>
                        </div>
                    </a>
                @endif
            @endforeach
        @else
            <div class="text-center py-5">
                <p class="text-muted">Belum ada prestasi yang ditampilkan.</p>
            </div>
        @endif

           <div class="text-center mt-5">
            <a href="{{ route('prestasi.index') }}" class="btn btn-lg px-5" style="background-color: #1B1A55; color: white; border: none;">
                <i class="fas fa-eye me-2"></i>Lihat Semua Prestasi
            </a>
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
                <h2 class="fw-bold mb-0" style="color: #1B1A55;">Dokumentasi Kegiatan sekolah</h2>
            </div>
            <p class="text-muted ms-5 ps-4">SMK Bakti Nusantara 666</p>
        </div>

        <!-- Video Utama -->
        <div class="mb-5">
            <div class="ratio ratio-16x9" style="max-width: 100%; margin: 0 auto;">
                <iframe src="https://www.youtube.com/embed/_UljO3g9fsM" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="border-radius: 12px;"></iframe>
            </div>
        </div>

        <!-- Grid Video YouTube -->
        <div class="row g-4 mb-4">
            <div class="col-md-4">
                <div class="ratio ratio-16x9">
                    <iframe src="https://www.youtube.com/embed/z6jyqDKku2U" title="Video 1" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="border-radius: 8px;"></iframe>
                </div>
            </div>
            <div class="col-md-4">
                <div class="ratio ratio-16x9">
                    <iframe src="https://www.youtube.com/embed/mAZfnQBrFqI" title="Video 2" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="border-radius: 8px;"></iframe>
                </div>
            </div>
            <div class="col-md-4">
                <div class="ratio ratio-16x9">
                    <iframe src="https://www.youtube.com/embed/m-vxuKDSB94" title="Video 3" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="border-radius: 8px;"></iframe>
                </div>
            </div>
            <div class="col-md-4">
                <div class="ratio ratio-16x9">
                    <iframe src="https://www.youtube.com/embed/QaBxTU3V4Nc" title="Video 4" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="border-radius: 8px;"></iframe>
                </div>
            </div>
            <div class="col-md-4">
                <div class="ratio ratio-16x9">
                    <iframe src="https://www.youtube.com/embed/aHkQPd9h3ro" title="Video 5" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="border-radius: 8px;"></iframe>
                </div>
            </div>
            <div class="col-md-4">
                <div class="ratio ratio-16x9">
                    <iframe src="https://www.youtube.com/embed/oqpsZBMiv4U" title="Video 6" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="border-radius: 8px;"></iframe>
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



<!-- Testimonial Section -->
<section class="py-5" style="background:#1B1A55;">
    <div class="container">
        <div class="row align-items-center">
            <!-- Video Testimonial -->
            <div class="col-lg-6 mb-4 mb-lg-0">
                <div class="position-relative">
                    <img id="testimonialImage" src="{{ asset('assets/image/siswa/pplg.png') }}" alt="Alumni Testimonial" class="img-fluid rounded-3 shadow" style="width: 100%; height: 400px; object-fit: cover;">
                   
                </div>
            </div>
            
            <!-- Testimonial Content -->
            <div class="col-lg-6">
                <div class="text-white">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-white rounded p-2 me-3">
                            <i class="fas fa-graduation-cap" style="color: #1B1A55;"></i>
                        </div>
                        <span class="badge px-3 py-2" style="background-color: #F5E8C7; color: #1B1A55;">Alumni Success Story</span>
                    </div>
                    
                    <div id="testimonialContent">
                        <p class="lead mb-4">"SMK Bakti Nusantara 666 benar-benar mengubah hidup saya. Dari siswa biasa menjadi Software Engineer di perusahaan unicorn dengan gaji yang tidak pernah saya bayangkan sebelumnya."</p>
                        
                        <div class="d-flex align-items-center mb-3">
                            <img id="testimonialAvatar" src="{{ asset('assets/image/siswa/pplg.png') }}" alt="Alumni" class="rounded-circle me-3" style="width: 50px; height: 50px; object-fit: cover;">
                            <div>
                                <h6 class="mb-0 text-white" id="testimonialName">Rizky Pratama</h6>
                                <small class="text-white-50" id="testimonialPosition">Software Engineer at Gojek</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Alumni Avatar Carousel -->
        <div class="mt-5">
            <div class="d-flex justify-content-center align-items-center gap-3 flex-wrap">
                <div class="testimonial-avatar active" onclick="showTestimonial(0)" data-index="0">
                    <img src="{{ asset('assets/image/siswa/pplg.png') }}" alt="Rizky" class="rounded-circle" style="width: 60px; height: 60px; object-fit: cover; cursor: pointer; border: 3px solid #F5E8C7;">
                </div>
                <div class="testimonial-avatar" onclick="showTestimonial(1)" data-index="1">
                    <img src="{{ asset('assets/image/siswa/dkv.png') }}" alt="Anisa" class="rounded-circle" style="width: 60px; height: 60px; object-fit: cover; cursor: pointer; border: 3px solid transparent; opacity: 0.6;">
                </div>
                <div class="testimonial-avatar" onclick="showTestimonial(2)" data-index="2">
                    <img src="{{ asset('assets/image/siswa/akt.png') }}" alt="Budi" class="rounded-circle" style="width: 60px; height: 60px; object-fit: cover; cursor: pointer; border: 3px solid transparent; opacity: 0.6;">
                </div>
                <div class="testimonial-avatar" onclick="showTestimonial(3)" data-index="3">
                    <img src="{{ asset('assets/image/siswa/siswa1.png') }}" alt="Sari" class="rounded-circle" style="width: 60px; height: 60px; object-fit: cover; cursor: pointer; border: 3px solid transparent; opacity: 0.6;">
                </div>
                <div class="testimonial-avatar" onclick="showTestimonial(4)" data-index="4">
                    <img src="{{ asset('assets/image/siswa/pplg.png') }}" alt="Dimas" class="rounded-circle" style="width: 60px; height: 60px; object-fit: cover; cursor: pointer; border: 3px solid transparent; opacity: 0.6;">
                </div>
                <div class="testimonial-avatar" onclick="showTestimonial(5)" data-index="5">
                    <img src="{{ asset('assets/image/siswa/dkv.png') }}" alt="Maya" class="rounded-circle" style="width: 60px; height: 60px; object-fit: cover; cursor: pointer; border: 3px solid transparent; opacity: 0.6;">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Mitra Kerjasama Section -->
<section class="py-5" style="background-color: white;">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold" style="color: #1B1A55;">Mitra Kerjasama</h2>
            <div class="d-flex justify-content-center align-items-center gap-2 mb-2">
                <div style="width: 40px; height: 2px; background-color: #F5E8C7;"></div>
                <span style="color: #647FBC; font-weight: 600;">SMK BAKTI NUSANTARA 666</span>
                <div style="width: 40px; height: 2px; background-color: #F5E8C7;"></div>
            </div>
        </div>

        <div class="row g-4 justify-content-center">
            <div class="col-6 col-md-3">
                <div class="bg-white p-4 rounded-3 shadow-sm text-center" style="border: 1px solid #e9ecef; min-height: 150px; display: flex; align-items: center; justify-content: center;">
                    <img src="{{ asset('assets/image/mitra-kerjasama/ALF SOLUTION.png') }}" alt="ALF Solution" class="img-fluid" style="max-height: 80px; object-fit: contain;">
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="bg-white p-4 rounded-3 shadow-sm text-center" style="border: 1px solid #e9ecef; min-height: 150px; display: flex; align-items: center; justify-content: center;">
                    <img src="{{ asset('assets/image/mitra-kerjasama/BASIC.png') }}" alt="Basic" class="img-fluid" style="max-height: 80px; object-fit: contain;">
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="bg-white p-4 rounded-3 shadow-sm text-center" style="border: 1px solid #e9ecef; min-height: 150px; display: flex; align-items: center; justify-content: center;">
                    <img src="{{ asset('assets/image/mitra-kerjasama/CHARISMA.png') }}" alt="Charisma" class="img-fluid" style="max-height: 80px; object-fit: contain;">
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="bg-white p-4 rounded-3 shadow-sm text-center" style="border: 1px solid #e9ecef; min-height: 150px; display: flex; align-items: center; justify-content: center;">
                    <img src="{{ asset('assets/image/mitra-kerjasama/CYBER LAB.png') }}" alt="Cyber Lab" class="img-fluid" style="max-height: 80px; object-fit: contain;">
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="bg-white p-4 rounded-3 shadow-sm text-center" style="border: 1px solid #e9ecef; min-height: 150px; display: flex; align-items: center; justify-content: center;">
                    <img src="{{ asset('assets/image/mitra-kerjasama/DIAN GLOBAL.png') }}" alt="Dian Global" class="img-fluid" style="max-height: 80px; object-fit: contain;">
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="bg-white p-4 rounded-3 shadow-sm text-center" style="border: 1px solid #e9ecef; min-height: 150px; display: flex; align-items: center; justify-content: center;">
                    <img src="{{ asset('assets/image/mitra-kerjasama/GEKA SUBLIM.png') }}" alt="Geka Sublim" class="img-fluid" style="max-height: 80px; object-fit: contain;">
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="bg-white p-4 rounded-3 shadow-sm text-center" style="border: 1px solid #e9ecef; min-height: 150px; display: flex; align-items: center; justify-content: center;">
                    <img src="{{ asset('assets/image/mitra-kerjasama/GITS ID.png') }}" alt="GITS ID" class="img-fluid" style="max-height: 80px; object-fit: contain;">
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="bg-white p-4 rounded-3 shadow-sm text-center" style="border: 1px solid #e9ecef; min-height: 150px; display: flex; align-items: center; justify-content: center;">
                    <img src="{{ asset('assets/image/mitra-kerjasama/INOVINDO.png') }}" alt="Inovindo" class="img-fluid" style="max-height: 80px; object-fit: contain;">
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="bg-white p-4 rounded-3 shadow-sm text-center" style="border: 1px solid #e9ecef; min-height: 150px; display: flex; align-items: center; justify-content: center;">
                    <img src="{{ asset('assets/image/mitra-kerjasama/LPKIA.png') }}" alt="LPKIA" class="img-fluid" style="max-height: 80px; object-fit: contain;">
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="bg-white p-4 rounded-3 shadow-sm text-center" style="border: 1px solid #e9ecef; min-height: 150px; display: flex; align-items: center; justify-content: center;">
                    <img src="{{ asset('assets/image/mitra-kerjasama/NETKROM.png') }}" alt="Netkrom" class="img-fluid" style="max-height: 80px; object-fit: contain;">
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="bg-white p-4 rounded-3 shadow-sm text-center" style="border: 1px solid #e9ecef; min-height: 150px; display: flex; align-items: center; justify-content: center;">
                    <img src="{{ asset('assets/image/mitra-kerjasama/NUSAEDU.png') }}" alt="Nusaedu" class="img-fluid" style="max-height: 80px; object-fit: contain;">
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="bg-white p-4 rounded-3 shadow-sm text-center" style="border: 1px solid #e9ecef; min-height: 150px; display: flex; align-items: center; justify-content: center;">
                    <img src="{{ asset('assets/image/mitra-kerjasama/PXUAL.png') }}" alt="Pxual" class="img-fluid" style="max-height: 80px; object-fit: contain;">
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="bg-white p-4 rounded-3 shadow-sm text-center" style="border: 1px solid #e9ecef; min-height: 150px; display: flex; align-items: center; justify-content: center;">
                    <img src="{{ asset('assets/image/mitra-kerjasama/YOGYA.png') }}" alt="Yogya" class="img-fluid" style="max-height: 80px; object-fit: contain;">
                </div>
            </div>
        </div>
    </div>
</section>



<script src="{{ asset('assets/js/home.js') }}"></script>
@endsection