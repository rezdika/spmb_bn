@extends('user.main')

@section('title', 'Jadwal & Gelombang - PPDB SMK Bakti Nusantara 666')

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/css/jadwal.css') }}">
@endsection

@section('hero')
<section class="text-white py-5 position-relative" style="min-height: 100vh; display: flex; align-items: center;">
    <div class="position-absolute w-100 h-100" style="background: url('{{ asset('assets/image/hero_section/sekolah1.png') }}'); background-size: cover; background-position: center; filter: blur(3px); z-index: -1;"></div>
    <div class="container py-5 position-relative">
        <div class="row align-items-center min-vh-50">
            <div class="col-lg-8">
                <div class="badge mb-3 px-3 py-2" style="background-color: #F5E8C7; color: #1B1A55;">
                    <i class="fas fa-calendar-check me-2"></i>Jadwal Pendaftaran PPDB 2025/2026
                </div>
                <h1 class="display-4 fw-bold mb-4">Jadwal & Gelombang <span style="color: #F5E8C7;">Pendaftaran</span></h1>
                <p class="lead mb-4 opacity-90">Informasi lengkap jadwal dan tahapan pendaftaran PPDB SMK Bakti Nusantara 666 tahun ajaran 2025/2026.</p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="{{ route('pendaftaran.index') }}" class="btn btn-light btn-lg px-4 py-3">
                        <i class="fas fa-rocket me-2"></i>Daftar Sekarang
                    </a>
                    <a href="#jadwal" class="btn btn-outline-light btn-lg px-4 py-3">
                        <i class="fas fa-info-circle me-2"></i>Lihat Jadwal
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('content')
<!-- Informasi Gelombang -->
<section class="py-5" style="background-color: white;">
    <div class="container">
        <div class="p-4 mb-4" style="background-color: #1B1A55; color: white;">
            <div class="row">
                <div class="col-lg-8">
                    <h3 class="fw-bold mb-3">📢 Informasi Penting</h3>
                    @foreach($gelombangs as $gelombang)
                    <p class="mb-2"><strong>{{ $gelombang->nama }}:</strong> {{ $gelombang->tgl_mulai->format('d M Y') }} - {{ $gelombang->tgl_selesai->format('d M Y') }} (Biaya: Rp {{ number_format($gelombang->biaya_daftar, 0, ',', '.') }})</p>
                    @endforeach
                    <p class="mb-0">Pastikan Anda memilih gelombang yang sesuai dengan kebutuhan dan kemampuan finansial.</p>
                </div>
                <div class="col-lg-4 text-center">
                    @foreach($gelombangs as $gelombang)
                    <span class="badge fs-6 me-2 mb-2" style="background-color: #1B1A55; color: white; border: 1px solid white;">{{ $gelombang->nama }}</span>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Jadwal Lengkap -->
<section class="py-5" id="jadwal" style="background-color: #f8f9fa;">
    <div class="container">
        <h2 class="section-title fw-bold text-center">Jadwal Pendaftaran PPDB 2025/2026</h2>
        <p class="text-center text-muted mb-5">Berikut adalah jadwal lengkap untuk semua gelombang pendaftaran</p>
        
        @foreach($gelombangs as $index => $gelombang)
        <div class="mb-5">
            <h3 class="fw-bold mb-3" style="color: #1B1A55;">{{ strtoupper($gelombang->nama) }}</h3>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead style="background-color: #1B1A55; color: white;">
                        <tr>
                            <th width="40%">Kegiatan</th>
                            <th width="30%">Tanggal</th>
                            <th width="30%">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>Pendaftaran Online</strong></td>
                            <td>{{ $gelombang->tgl_mulai->format('d M Y') }} - {{ $gelombang->tgl_selesai->format('d M Y') }}</td>
                            <td>Daftar melalui website</td>
                        </tr>
                        <tr>
                            <td><strong>Verifikasi Berkas</strong></td>
                            <td>{{ $gelombang->tgl_selesai->addDays(1)->format('d M Y') }} - {{ $gelombang->tgl_selesai->addDays(15)->format('d M Y') }}</td>
                            <td>Upload dokumen lengkap</td>
                        </tr>
                        <tr>
                            <td><strong>Pengumuman Hasil</strong></td>
                            <td>{{ $gelombang->tgl_selesai->addDays(20)->format('d M Y') }}</td>
                            <td>Cek di website resmi</td>
                        </tr>
                        <tr>
                            <td><strong>Daftar Ulang</strong></td>
                            <td>{{ $gelombang->tgl_selesai->addDays(25)->format('d M Y') }} - {{ $gelombang->tgl_selesai->addDays(30)->format('d M Y') }}</td>
                            <td>Datang ke sekolah</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <div class="p-3 mt-3" style="background-color: #1B1A55; color: white;">
                <h6 class="fw-bold">Informasi {{ $gelombang->nama }}:</h6>
                <div class="row">
                    <div class="col-md-6">
                        <ul class="mb-0">
                            <li>Biaya pendaftaran: Rp {{ number_format($gelombang->biaya_daftar, 0, ',', '.') }}</li>
                            @if($index == 0)
                            <li>Prioritas pemilihan jurusan</li>
                            @else
                            <li>Kesempatan bagi yang terlewat</li>
                            @endif
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul class="mb-0">
                            @if($index == 0)
                            <li>Cicilan lebih fleksibel</li>
                            <li>Waktu persiapan lebih lama</li>
                            @else
                            <li>Proses lebih cepat</li>
                            <li>Masih tersedia kuota</li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>

<!-- Persyaratan Umum -->
<section class="py-5" style="background-color: white;">
    <div class="container">
        <h2 class="section-title fw-bold text-center">Persyaratan Pendaftaran</h2>
        <p class="text-center text-muted mb-5">Persyaratan yang harus dipenuhi untuk kedua gelombang</p>
        
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead style="background-color: #1B1A55; color: white;">
                            <tr>
                                <th width="5%">No</th>
                                <th width="60%">Persyaratan</th>
                                <th width="20%">Status</th>
                                <th width="15%">Format</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Ijazah SMP/MTs atau surat keterangan lulus</td>
                                <td><span class="badge" style="background-color: #1B1A55; color: white;">Wajib</span></td>
                                <td>Fotocopy</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Fotocopy Kartu Keluarga</td>
                                <td><span class="badge" style="background-color: #1B1A55; color: white;">Wajib</span></td>
                                <td>Fotocopy</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Fotocopy Akta Kelahiran</td>
                                <td><span class="badge" style="background-color: #1B1A55; color: white;">Wajib</span></td>
                                <td>Fotocopy</td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Pas foto berwarna ukuran 3x4 (6 lembar)</td>
                                <td><span class="badge" style="background-color: #1B1A55; color: white;">Wajib</span></td>
                                <td>Cetak</td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>Surat keterangan sehat dari dokter</td>
                                <td><span class="badge" style="background-color: #1B1A55; color: white;">Opsional</span></td>
                                <td>Asli</td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td>Sertifikat prestasi akademik/non-akademik</td>
                                <td><span class="badge" style="background-color: #1B1A55; color: white;">Bonus</span></td>
                                <td>Fotocopy</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <div class="mt-4">
                    <h5 class="fw-bold mb-3">Catatan Penting:</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <ul>
                                <li>Semua dokumen wajib harus dilengkapi</li>
                                <li>Fotocopy harus jelas dan dapat dibaca</li>
                                <li>Pas foto dengan latar belakang merah</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul>
                                <li>Sertifikat prestasi dapat menambah nilai</li>
                                <li>Dokumen asli dibawa saat daftar ulang</li>
                                <li>Berkas tidak dapat dikembalikan</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-5 position-relative" style="background: url('{{ asset('assets/image/background.png') }}'); background-size: cover; background-position: center;">

    <div class="container text-center text-white">
        <h3 class="fw-bold mb-3">Siap Mendaftar?</h3>
        <p class="mb-4">Jangan tunda lagi! Daftar sekarang dan raih masa depan cerah bersama SMK Bakti Nusantara 666.</p>
        <div class="d-flex justify-content-center gap-3 flex-wrap">
            <a href="{{ route('register') }}" class="btn btn-light btn-lg px-4">
                Daftar Sekarang
            </a>
            <a href="{{ route('biaya') }}" class="btn btn-outline-light btn-lg px-4">
                <i class="fas fa-money-bill-wave me-2"></i>Lihat Biaya
            </a>
        </div>
    </div>
</section>
@endsection