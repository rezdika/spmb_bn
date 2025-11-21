@extends('user.main')

@section('title', 'Panduan Pendaftaran - PPDB SMK Bakti Nusantara 666')

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/css/panduan.css') }}">
@endsection

@section('hero')
<section class="text-white py-5 position-relative" style="min-height: 100vh; display: flex; align-items: center;">
    <div class="position-absolute w-100 h-100" style="background: url('{{ asset('assets/image/hero_section/sekolah1.png') }}'); background-size: cover; background-position: center; filter: blur(3px); z-index: -1;"></div>
    <div class="container py-5 position-relative">
        <div class="row align-items-center hero-content">
            <div class="col-lg-8">
                <div class="badge mb-3 px-4 py-2" style="background-color: rgba(245,232,199,0.2); color: white; border: 1px solid rgba(245,232,199,0.3); border-radius: 50px;">
                    <i class="fas fa-map-marked-alt me-2"></i>Step by Step Guide
                </div>
                <h1 class="display-4 fw-bold mb-4">Panduan Lengkap <span style="color: #F5E8C7;">Pendaftaran PPDB</span></h1>
                <p class="lead mb-4 opacity-90">Ikuti 6 langkah mudah ini untuk menjadi bagian dari keluarga besar SMK Bakti Nusantara 666. Proses pendaftaran 100% online dan bisa dilakukan kapan saja!</p>
                <div class="d-flex align-items-center gap-4 text-white flex-wrap">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-clock me-2"></i>
                        <span>Estimasi: 15 menit</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="fas fa-mobile-alt me-2"></i>
                        <span>Bisa via HP</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="fas fa-shield-alt me-2"></i>
                        <span>100% Aman</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('content')
<!-- Quick Stats -->
<section class="py-4" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
    <div class="container">
        <div class="row text-center g-4">
            <div class="col-md-3">
                <div class="d-flex align-items-center justify-content-center">
                    <i class="fas fa-users me-2" style="color: #1B1A55;"></i>
                    <div>
                        <strong style="color: #1B1A55;">1,234</strong>
                        <small class="d-block text-muted">Sudah Daftar</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="d-flex align-items-center justify-content-center">
                    <i class="fas fa-clock me-2" style="color: #1B1A55;"></i>
                    <div>
                        <strong style="color: #1B1A55;">45 Hari</strong>
                        <small class="d-block text-muted">Sisa Waktu</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="d-flex align-items-center justify-content-center">
                    <i class="fas fa-percentage me-2" style="color: #1B1A55;"></i>
                    <div>
                        <strong style="color: #1B1A55;">68%</strong>
                        <small class="d-block text-muted">Kuota Terisi</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="d-flex align-items-center justify-content-center">
                    <i class="fas fa-star me-2" style="color: #1B1A55;"></i>
                    <div>
                        <strong style="color: #1B1A55;">4.9/5</strong>
                        <small class="d-block text-muted">Rating Proses</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Step by Step Guide -->
<section class="pt-2 pb-2" style="background-color: white;">
    <div class="container">
        <div class="text-center mb-0">
            <h2 class="fw-bold mb-2" style="color: #1B1A55;">6 Langkah Mudah Pendaftaran</h2>
            <p class="text-muted mb-2">Ikuti panduan ini step by step, dijamin gampang!</p>
        </div>
        
            <img src="{{ asset('assets/image/steppendaftaran.png') }}" alt="Step Pendaftaran" class="img-fluid" style="max-width: 1400px; width: 100%; height: auto; margin-top: -0.5rem;">
    </div>
</section>


<!-- CTA Section -->
<section class="py-5 position-relative" style="background: url('{{ asset('assets/image/background.png') }}'); background-size: cover; background-position: center;">

    <div class="container text-center text-white">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h2 class="fw-bold mb-4">Siap Memulai Perjalanan Menuju Sukses?</h2>
                <p class="lead mb-4 opacity-90">Jangan tunggu lagi! Kuota terbatas dan waktu terus berjalan. Mulai pendaftaranmu sekarang juga!</p>
                <div class="d-flex justify-content-center gap-3 flex-wrap">
                    <a href="{{ route('register') }}" class="btn btn-lg px-5 py-3 fw-bold" style="background-color: #F5E8C7; color: #1B1A55;">
                        Mulai Daftar Sekarang
                    </a>
                    <a href="{{ route('kontak') }}" class="btn btn-outline-light btn-lg px-5 py-3">
                        <i class="fab fa-whatsapp me-2"></i>Butuh Bantuan?
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Requirements Section -->
<section class="py-5" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <h3 class="fw-bold mb-4" style="color: #1B1A55;">📋 Dokumen yang Harus Disiapkan</h3>
                <div class="mb-3 p-3 bg-white rounded shadow-sm border-start border-4" style="border-color: #1B1A55 !important;">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-graduation-cap me-3" style="color: #1B1A55;"></i>
                        <div>
                            <strong>Ijazah SMP/MTs</strong>
                            <small class="d-block text-muted">Atau surat keterangan lulus (PDF/JPG)</small>
                        </div>
                    </div>
                </div>
                <div class="mb-3 p-3 bg-white rounded shadow-sm border-start border-4" style="border-color: #1B1A55 !important;">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-chart-line me-3" style="color: #1B1A55;"></i>
                        <div>
                            <strong>Rapor Semester 1-5</strong>
                            <small class="d-block text-muted">Scan semua halaman yang ada nilai</small>
                        </div>
                    </div>
                </div>
                <div class="mb-3 p-3 bg-white rounded shadow-sm border-start border-4" style="border-color: #1B1A55 !important;">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-users me-3" style="color: #1B1A55;"></i>
                        <div>
                            <strong>Kartu Keluarga (KK)</strong>
                            <small class="d-block text-muted">Pastikan nama siswa tercantum</small>
                        </div>
                    </div>
                </div>
                <div class="mb-3 p-3 bg-white rounded shadow-sm border-start border-4" style="border-color: #1B1A55 !important;">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-id-card me-3" style="color: #1B1A55;"></i>
                        <div>
                            <strong>Akta Kelahiran</strong>
                            <small class="d-block text-muted">Dokumen resmi dari catatan sipil</small>
                        </div>
                    </div>
                </div>
                <div class="mb-3 p-3 bg-white rounded shadow-sm border-start border-4" style="border-color: #1B1A55 !important;">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-camera me-3" style="color: #1B1A55;"></i>
                        <div>
                            <strong>Pas Foto 3x4</strong>
                            <small class="d-block text-muted">Background merah, format digital</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <h3 class="fw-bold mb-4" style="color: #1B1A55;">💡 Tips Sukses Pendaftaran</h3>
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <div class="mb-4 pb-3 border-bottom">
                            <h6 class="fw-bold" style="color: #1B1A55;">Siapkan Dokumen Dulu</h6>
                            <p class="text-muted small mb-0">Scan semua dokumen sebelum mulai daftar agar prosesnya lancar.</p>
                        </div>
                        <div class="mb-4 pb-3 border-bottom">
                            <h6 class="fw-bold" style="color: #1B1A55;">Gunakan Koneksi Stabil</h6>
                            <p class="text-muted small mb-0">Pastikan internet stabil saat upload dokumen agar tidak gagal.</p>
                        </div>
                        <div class="mb-4 pb-3 border-bottom">
                            <h6 class="fw-bold" style="color: #1B1A55;">Double Check Data</h6>
                            <p class="text-muted small mb-0">Periksa kembali semua data sebelum submit, karena tidak bisa diubah.</p>
                        </div>
                        <div class="mb-4 pb-3 border-bottom">
                            <h6 class="fw-bold" style="color: #1B1A55;">Simpan Bukti Transfer</h6>
                            <p class="text-muted small mb-0">Screenshot bukti transfer dengan jelas, termasuk tanggal dan nominal.</p>
                        </div>
                        <div class="mb-0">
                            <h6 class="fw-bold" style="color: #1B1A55;">Pantau Status Berkala</h6>
                            <p class="text-muted small mb-0">Cek dashboard secara rutin untuk update status verifikasi.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <!-- FAQ Categories -->
            <div class="col-lg-3">
                <h3 class="fw-bold mb-4" style="color: #1B1A55;">Frequently Asked Questions</h3>
                <div class="list-group list-group-flush">
                    <a href="#" class="list-group-item list-group-item-action active border-0 py-3" data-category="getting-started" style="background-color: #F5E8C7; color: #1B1A55; font-weight: 600;">
                        Getting Started
                    </a>
                    <a href="#" class="list-group-item list-group-item-action border-0 py-3" data-category="documents" style="color: #1B1A55;">
                        Dokumen & Berkas
                    </a>
                    <a href="#" class="list-group-item list-group-item-action border-0 py-3" data-category="payment" style="color: #1B1A55;">
                        Pembayaran
                    </a>
                    <a href="#" class="list-group-item list-group-item-action border-0 py-3" data-category="verification" style="color: #1B1A55;">
                        Verifikasi
                    </a>
                </div>
            </div>
            
            <!-- FAQ Content -->
            <div class="col-lg-9">
                <div class="faq-content" id="getting-started">
                    <div class="mb-4">
                        <h5 class="fw-bold mb-3" style="color: #1B1A55;">Bagaimana cara memulai pendaftaran?</h5>
                        <p class="text-muted">Klik tombol "Mulai Daftar" di halaman utama, kemudian buat akun dengan email dan nomor HP aktif. Pastikan data yang dimasukkan benar karena akan digunakan untuk verifikasi.</p>
                    </div>
                    <div class="mb-4">
                        <h5 class="fw-bold mb-3" style="color: #1B1A55;">Apakah pendaftaran bisa dilakukan via HP?</h5>
                        <p class="text-muted">Ya, sistem pendaftaran kami responsive dan bisa diakses melalui smartphone. Pastikan koneksi internet stabil saat mengisi formulir dan upload dokumen.</p>
                    </div>
                    <div class="mb-4">
                        <h5 class="fw-bold mb-3" style="color: #1B1A55;">Berapa lama waktu yang dibutuhkan untuk mendaftar?</h5>
                        <p class="text-muted">Estimasi waktu pendaftaran sekitar 15-20 menit jika semua dokumen sudah disiapkan. Proses upload dokumen membutuhkan waktu paling lama.</p>
                    </div>
                    <div class="mb-4">
                        <h5 class="fw-bold mb-3" style="color: #1B1A55;">Apakah data saya aman?</h5>
                        <p class="text-muted">Tentu! Kami menggunakan enkripsi SSL dan sistem keamanan berlapis untuk melindungi data pribadi Anda. Semua informasi akan dijaga kerahasiaannya.</p>
                    </div>
                </div>
                
                <div class="faq-content d-none" id="documents">
                    <div class="mb-4">
                        <h5 class="fw-bold mb-3" style="color: #1B1A55;">Dokumen apa saja yang harus disiapkan?</h5>
                        <p class="text-muted">Ijazah SMP/MTs, Rapor semester 1-5, Kartu Keluarga, Akta Kelahiran, dan Pas Foto 3x4 background merah. Semua dalam format digital (PDF/JPG).</p>
                    </div>
                    <div class="mb-4">
                        <h5 class="fw-bold mb-3" style="color: #1B1A55;">Apakah bisa daftar tanpa ijazah asli?</h5>
                        <p class="text-muted">Bisa! Untuk pendaftaran online, cukup upload scan/foto ijazah. Ijazah asli dibawa saat daftar ulang nanti.</p>
                    </div>
                    <div class="mb-4">
                        <h5 class="fw-bold mb-3" style="color: #1B1A55;">Bagaimana jika ada dokumen yang ditolak?</h5>
                        <p class="text-muted">Tenang! Kamu bisa upload ulang dokumen yang ditolak. Admin akan kasih catatan kenapa ditolak dan cara perbaikannya.</p>
                    </div>
                </div>
                
                <div class="faq-content d-none" id="payment">
                    <div class="mb-4">
                        <h5 class="fw-bold mb-3" style="color: #1B1A55;">Berapa biaya pendaftaran?</h5>
                        <p class="text-muted">Biaya pendaftaran sebesar Rp 150.000 dan bisa dibayar melalui transfer bank atau e-wallet yang tersedia.</p>
                    </div>
                    <div class="mb-4">
                        <h5 class="fw-bold mb-3" style="color: #1B1A55;">Apakah ada biaya tambahan?</h5>
                        <p class="text-muted">Tidak ada! Biaya pendaftaran Rp 150.000 sudah final. Biaya lain seperti seragam dan buku baru dibayar saat daftar ulang.</p>
                    </div>
                    <div class="mb-4">
                        <h5 class="fw-bold mb-3" style="color: #1B1A55;">Bagaimana cara pembayaran?</h5>
                        <p class="text-muted">Transfer ke rekening yang tertera di sistem, kemudian upload bukti transfer. Pembayaran via e-wallet juga tersedia.</p>
                    </div>
                </div>
                
                <div class="faq-content d-none" id="verification">
                    <div class="mb-4">
                        <h5 class="fw-bold mb-3" style="color: #1B1A55;">Berapa lama proses verifikasi?</h5>
                        <p class="text-muted">Maksimal 1x24 jam setelah semua dokumen lengkap. Kamu akan dapat notifikasi via email dan WhatsApp.</p>
                    </div>
                    <div class="mb-4">
                        <h5 class="fw-bold mb-3" style="color: #1B1A55;">Bagaimana cara cek status verifikasi?</h5>
                        <p class="text-muted">Login ke dashboard pendaftaran untuk melihat status real-time. Notifikasi juga akan dikirim via email dan WhatsApp.</p>
                    </div>
                    <div class="mb-4">
                        <h5 class="fw-bold mb-3" style="color: #1B1A55;">Apa yang harus dilakukan setelah diterima?</h5>
                        <p class="text-muted">Download dan cetak kartu pendaftaran, kemudian tunggu pengumuman jadwal daftar ulang yang akan diinformasikan via email.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<script src="{{ asset('assets/js/panduan.js') }}"></script>
@endsection