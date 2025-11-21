@extends('user.main')

@section('title', 'Pendaftaran Berhasil - SMK Bakti Nusantara 666')

@section('hero')
<section class="position-relative" style="height: 400px; background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('{{ asset('assets/image/hero_section/sekolah1.png') }}'); background-size: cover; background-position: center;">

    <div class="container py-5">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <div class="mb-4">
                    <i class="fas fa-check-circle" style="font-size: 5rem; color: #F5E8C7;"></i>
                </div>
                <h1 class="display-4 fw-bold mb-4 text-white">Pendaftaran <span style="color: #F5E8C7;">Berhasil!</span></h1>
                <p class="lead mb-4 opacity-90">Selamat! Pendaftaran Anda telah berhasil disubmit dan sedang dalam proses verifikasi.</p>
            </div>
        </div>
    </div>
</section>
@endsection

@section('content')
<section class="py-5" style="background-color: #f8f9fa;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-5 text-center">
                        <h4 class="fw-bold mb-4" style="color: #1B1A55;">🎉 Pendaftaran Anda Telah Diterima</h4>
                        
                        <div class="alert alert-success mb-4">
                            <h6 class="fw-bold mb-2">Status: Menunggu Verifikasi</h6>
                            <p class="mb-0">Tim kami akan memverifikasi data Anda dalam 1-3 hari kerja.</p>
                        </div>

                        <div class="row text-start mb-4">
                            <div class="col-md-6">
                                <h6 class="fw-bold mb-3" style="color: #1B1A55;">📋 Langkah Selanjutnya:</h6>
                                <ul class="list-unstyled">
                                    <li class="mb-2">✅ Tunggu email konfirmasi</li>
                                    <li class="mb-2">📧 Cek email secara berkala</li>
                                    <li class="mb-2">📱 Pantau WhatsApp untuk update</li>
                                    <li class="mb-0">🏫 Siapkan dokumen fisik</li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <h6 class="fw-bold mb-3" style="color: #1B1A55;">📞 Butuh Bantuan?</h6>
                                <ul class="list-unstyled">
                                    <li class="mb-2">📧 admin@smkbn666.sch.id</li>
                                    <li class="mb-2">📱 0812-3456-7890</li>
                                    <li class="mb-2">🕒 Senin-Jumat: 08:00-16:00</li>
                                    <li class="mb-0">🏢 Kantor PPDB SMK BN 666</li>
                                </ul>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center gap-3">
                            <a href="{{ route('home') }}" class="btn btn-outline-primary">
                                <i class="fas fa-home me-2"></i>Kembali ke Beranda
                            </a>
                            <a href="{{ route('profile.index') }}" class="btn btn-primary">
                                <i class="fas fa-user me-2"></i>Lihat Profile
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection