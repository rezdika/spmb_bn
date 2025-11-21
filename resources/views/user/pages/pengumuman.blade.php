@extends('user.main')

@section('title', 'Pengumuman Hasil Seleksi - PPDB SMK Bakti Nusantara 666')

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/css/pengumuman.css') }}">
@endsection

@section('hero')
<section class="text-white py-5 position-relative" style="min-height: 100vh; display: flex; align-items: center;">
    <div class="position-absolute w-100 h-100" style="background: url('{{ asset('assets/image/hero_section/sekolah1.png') }}'); background-size: cover; background-position: center; filter: blur(3px); z-index: -1;"></div>
    <div class="container py-5 position-relative">
        <div class="row align-items-center min-vh-50">
            <div class="col-lg-8">
                <div class="badge mb-3 px-3 py-2" style="background-color: #F5E8C7; color: #1B1A55;">
                    <i class="fas fa-bullhorn me-2"></i>Pengumuman Hasil Seleksi PPDB 2024/2025
                </div>
                <h1 class="display-4 fw-bold mb-4">Pengumuman <span style="color: #F5E8C7;">Hasil Seleksi</span></h1>
                <p class="lead mb-4 opacity-90">Cek hasil seleksi PPDB SMK Bakti Nusantara 666 dengan memasukkan nomor pendaftaran Anda.</p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="#cek-hasil" class="btn btn-light btn-lg px-4 py-3">
                        <i class="fas fa-search me-2"></i>Cek Hasil
                    </a>
                    <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg px-4 py-3">
                        <i class="fas fa-rocket me-2"></i>Daftar Sekarang
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('content')
<!-- Status Pengumuman -->
<section class="py-5" style="background-color: white; ">
    <div class="container">
        <div class="p-4 mb-4" style="background-color: #1B1A55; color: white;">
            <div class="row">
                <div class="col-lg-8">
                    <h3 class="fw-bold mb-3">📢 Status Pengumuman</h3>
                    <p class="mb-2"><strong>Gelombang 1:</strong> Pengumuman tanggal 20 April 2024</p>
                    <p class="mb-2"><strong>Gelombang 2:</strong> Pengumuman tanggal 15 Agustus 2024</p>
                    <p class="mb-0">Hasil seleksi dapat dicek 24 jam setelah pengumuman resmi.</p>
                </div>
                <div class="col-lg-4 text-center">
                    <span class="badge fs-6 me-2 mb-2" style="background-color: #1B1A55; color: white; border: 1px solid white;">Gelombang 1 Aktif</span>
                    <span class="badge fs-6" style="background-color: #1B1A55; color: white; border: 1px solid white;">Hasil Tersedia</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Daftar Siswa Diterima -->
<section class="py-5" style="background-color: white;">
    <div class="container">
        <h2 class="fw-bold mb-4" style="color: #1B1A55;">Daftar Siswa Diterima</h2>
        
        <!-- Tab Navigation -->
        <ul class="nav nav-tabs mb-4" id="gelombangTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="gelombang1-tab" data-bs-toggle="tab" data-bs-target="#gelombang1" type="button" role="tab">
                    <i class="fas fa-users me-2"></i>Gelombang 1 ({{ $siswaGelombang1->count() }})
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="gelombang2-tab" data-bs-toggle="tab" data-bs-target="#gelombang2" type="button" role="tab">
                    <i class="fas fa-users me-2"></i>Gelombang 2 ({{ $siswaGelombang2->count() }})
                </button>
            </li>
        </ul>
        
        <!-- Tab Content -->
        <div class="tab-content" id="gelombangTabsContent">
            <!-- Gelombang 1 -->
            <div class="tab-pane fade show active" id="gelombang1" role="tabpanel">
                @if($siswaGelombang1->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead style="background-color: #1B1A55; color: white;">
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="20%">No. Pendaftaran</th>
                                    <th width="30%">Nama Lengkap</th>
                                    <th width="25%">Jurusan</th>
                                    <th width="20%">Tanggal Diterima</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($siswaGelombang1 as $index => $siswa)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $siswa->no_pendaftaran }}</td>
                                        <td>{{ $siswa->user->nama_lengkap }}</td>
                                        <td>{{ $siswa->jurusan->nama }}</td>
                                        <td>{{ $siswa->tgl_verifikasi_payment ? $siswa->tgl_verifikasi_payment->format('d/m/Y') : '-' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-5">
                        <h4 class="text-muted">Belum Ada Siswa Gelombang 1 yang Diterima</h4>
                        <p class="text-muted">Pengumuman hasil seleksi Gelombang 1 akan ditampilkan di sini.</p>
                    </div>
                @endif
            </div>
            
            <!-- Gelombang 2 -->
            <div class="tab-pane fade" id="gelombang2" role="tabpanel">
                @if($siswaGelombang2->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead style="background-color: #1B1A55; color: white;">
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="20%">No. Pendaftaran</th>
                                    <th width="30%">Nama Lengkap</th>
                                    <th width="25%">Jurusan</th>
                                    <th width="20%">Tanggal Diterima</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($siswaGelombang2 as $index => $siswa)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $siswa->no_pendaftaran }}</td>
                                        <td>{{ $siswa->user->nama_lengkap }}</td>
                                        <td>{{ $siswa->jurusan->nama }}</td>
                                        <td>{{ $siswa->tgl_verifikasi_payment ? $siswa->tgl_verifikasi_payment->format('d/m/Y') : '-' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-5">
                        <h4 class="text-muted">Belum Ada Siswa Gelombang 2 yang Diterima</h4>
                        <p class="text-muted">Pengumuman hasil seleksi Gelombang 2 akan ditampilkan di sini.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Jadwal Daftar Ulang -->
<section class="py-5" style="background-color: white;">
    <div class="container">
        <h2 class="section-title fw-bold text-center">Jadwal Daftar Ulang</h2>
        <p class="text-center text-muted mb-5">Jadwal dan persyaratan daftar ulang untuk siswa yang diterima</p>
        
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead style="background-color: #1B1A55; color: white;">
                            <tr>
                                <th width="25%">Gelombang</th>
                                <th width="30%">Tanggal Daftar Ulang</th>
                                <th width="25%">Waktu</th>
                                <th width="20%">Tempat</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>Gelombang 1</strong></td>
                                <td>25 - 30 April 2024</td>
                                <td>08.00 - 15.00 WIB</td>
                                <td>Aula Sekolah</td>
                            </tr>
                            <tr>
                                <td><strong>Gelombang 2</strong></td>
                                <td>20 - 25 Agustus 2024</td>
                                <td>08.00 - 15.00 WIB</td>
                                <td>Aula Sekolah</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <div class="mt-4">
                    <h5 class="fw-bold mb-3">Dokumen yang Harus Dibawa:</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <ul>
                                <li>Bukti hasil seleksi (print out)</li>
                                <li>Ijazah SMP/MTs asli + fotocopy</li>
                                <li>Kartu Keluarga asli + fotocopy</li>
                                <li>Akta kelahiran asli + fotocopy</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul>
                                <li>Pas foto 3x4 (6 lembar)</li>
                                <li>Bukti pembayaran biaya pendaftaran</li>
                                <li>Surat keterangan sehat</li>
                                <li>Map plastik untuk berkas</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-5" style="background-color: #1B1A55;">
    <div class="container text-center text-white">
        <h3 class="fw-bold mb-3">Belum Mendaftar?</h3>
        <p class="mb-4">Jangan sampai terlewat! Masih ada kesempatan di Gelombang 2. Daftar sekarang juga!</p>
        <div class="d-flex justify-content-center gap-3 flex-wrap">
            <a href="{{ route('register') }}" class="btn btn-light btn-lg px-4">
                <i class="fas fa-rocket me-2"></i>Daftar Sekarang
            </a>
            <a href="{{ route('jadwal') }}" class="btn btn-outline-light btn-lg px-4">
                <i class="fas fa-calendar-check me-2"></i>Lihat Jadwal
            </a>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script src="{{ asset('assets/js/pengumuman.js') }}"></script>
@endsection