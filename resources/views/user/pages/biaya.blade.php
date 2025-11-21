@extends('user.main')

@section('title', 'Biaya Pendaftaran - PPDB SMK Bakti Nusantara 666')

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
                    <i class="fas fa-money-bill-wave me-2"></i>Biaya Pendaftaran PPDB 2024/2025
                </div>
                <h1 class="display-4 fw-bold mb-4">Biaya <span style="color: #F5E8C7;">Pendaftaran</span></h1>
                <p class="lead mb-4 opacity-90">Informasi lengkap biaya pendaftaran dan rincian pembayaran untuk kedua gelombang PPDB SMK Bakti Nusantara 666.</p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="{{ route('register') }}" class="btn btn-light btn-lg px-4 py-3">
                        Daftar Sekarang
                    </a>
                    <a href="#biaya" class="btn btn-outline-light btn-lg px-4 py-3">
                        <i class="fas fa-info-circle me-2"></i>Lihat Biaya
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('content')
<!-- Informasi Biaya -->
<section class="py-5" style="background-color: white; ">
    <div class="container">
        <div class="p-4 mb-4" style="background-color: #1B1A55; color: white;">
            <div class="row">
                <div class="col-lg-8">
                    <h3 class="fw-bold mb-3"> Informasi Biaya</h3>
                    <p class="mb-2"><strong>Gelombang 1:</strong> Biaya pendaftaran Rp 150.000 (Lebih Hemat)</p>
                    <p class="mb-2"><strong>Gelombang 2:</strong> Biaya pendaftaran Rp 175.000 (Standar)</p>
                    <p class="mb-0">Semua biaya sudah termasuk administrasi dan tidak ada biaya tersembunyi.</p>
                </div>
                <div class="col-lg-4 text-center">
                    <span class="badge fs-6 me-2 mb-2" style="background-color: #1B1A55; color: white; border: 1px solid white;">Cicilan 0%</span>
                    <span class="badge fs-6" style="background-color: #1B1A55; color: white; border: 1px solid white;">Beasiswa Tersedia</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Rincian Biaya -->
<section class="py-5" id="biaya" style="background-color: #f8f9fa;">
    <div class="container">
        <h2 class="section-title fw-bold text-center">Rincian Biaya Pendaftaran</h2>
        <p class="text-center text-muted mb-5">Berikut adalah rincian lengkap biaya untuk kedua gelombang</p>
        
        <!-- Biaya Gelombang 1 -->
        <div class="mb-5">
            <h3 class="fw-bold mb-3" style="color: #1B1A55;">GELOMBANG 1</h3>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead style="background-color: #1B1A55; color: white;">
                        <tr>
                            <th width="50%">Komponen Biaya</th>
                            <th width="25%">Jumlah</th>
                            <th width="25%">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>Biaya Pendaftaran</strong></td>
                            <td><strong>Rp 150.000</strong></td>
                            <td>Sekali bayar</td>
                        </tr>
                        <tr>
                            <td>SPP per bulan</td>
                            <td>Rp 550.000</td>
                            <td>12 bulan</td>
                        </tr>
                        <tr>
                            <td>Seragam & Atribut</td>
                            <td>Rp 500.000</td>
                            <td>Paket lengkap</td>
                        </tr>
                        <tr>
                            <td>Buku & Modul</td>
                            <td>Rp 400.000</td>
                            <td>Per tahun</td>
                        </tr>
                        <tr>
                            <td>Kegiatan Siswa</td>
                            <td>Rp 200.000</td>
                            <td>Per tahun</td>
                        </tr>
                        <tr style="background-color: #f8f9fa;">
                            <td><strong>Total Tahun Pertama</strong></td>
                            <td><strong>Rp 4.150.000</strong></td>
                            <td>Sudah termasuk semua</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <div class="p-3 mt-3" style="background-color: #1B1A55; color: white;">
                <h6 class="fw-bold">Keunggulan Gelombang 1:</h6>
                <div class="row">
                    <div class="col-md-6">
                        <ul class="mb-0">
                            <li>Hemat Rp 25.000 biaya pendaftaran</li>
                            <li>Cicilan lebih fleksibel</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul class="mb-0">
                            <li>Prioritas pemilihan jurusan</li>
                            <li>Diskon seragam 10%</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Biaya Gelombang 2 -->
        <div class="mb-5">
            <h3 class="fw-bold mb-3" style="color: #1B1A55;">GELOMBANG 2</h3>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead style="background-color: #1B1A55; color: white;">
                        <tr>
                            <th width="50%">Komponen Biaya</th>
                            <th width="25%">Jumlah</th>
                            <th width="25%">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>Biaya Pendaftaran</strong></td>
                            <td><strong>Rp 175.000</strong></td>
                            <td>Sekali bayar</td>
                        </tr>
                        <tr>
                            <td>SPP per bulan</td>
                            <td>Rp 300.000</td>
                            <td>12 bulan</td>
                        </tr>
                        <tr>
                            <td>Seragam & Atribut</td>
                            <td>Rp 500.000</td>
                            <td>Paket lengkap</td>
                        </tr>
                        <tr>
                            <td>Buku & Modul</td>
                            <td>Rp 400.000</td>
                            <td>Per tahun</td>
                        </tr>
                        <tr>
                            <td>Kegiatan Siswa</td>
                            <td>Rp 200.000</td>
                            <td>Per tahun</td>
                        </tr>
                        <tr style="background-color: #f8f9fa;">
                            <td><strong>Total Tahun Pertama</strong></td>
                            <td><strong>Rp 3.800.000</strong></td>
                            <td>Sudah termasuk semua</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <div class="p-3 mt-3" style="background-color: #1B1A55; color: white;">
                <h6 class="fw-bold">Keunggulan Gelombang 2:</h6>
                <div class="row">
                    <div class="col-md-6">
                        <ul class="mb-0">
                            <li>Kesempatan kedua bagi yang terlewat</li>
                            <li>Proses lebih cepat</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul class="mb-0">
                            <li>Masih tersedia kuota</li>
                            <li>Pembayaran bisa dicicil</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Metode Pembayaran -->
<section class="py-5" style="background-color: white;">
    <div class="container">
        <h2 class="section-title fw-bold text-center">Metode Pembayaran</h2>
        <p class="text-center text-muted mb-5">Berbagai pilihan pembayaran untuk kemudahan Anda</p>
        
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead style="background-color: #1B1A55; color: white;">
                            <tr>
                                <th width="30%">Metode</th>
                                <th width="40%">Keterangan</th>
                                <th width="30%">Biaya Admin</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>Transfer Bank</strong></td>
                                <td>BCA, BNI, BRI, Mandiri</td>
                                <td>Gratis</td>
                            </tr>
                            <tr>
                                <td><strong>E-Wallet</strong></td>
                                <td>OVO, GoPay, DANA, ShopeePay</td>
                                <td>Rp 2.500</td>
                            </tr>
                            <tr>
                                <td><strong>Virtual Account</strong></td>
                                <td>Semua bank via ATM</td>
                                <td>Gratis</td>
                            </tr>
                            <tr>
                                <td><strong>Minimarket</strong></td>
                                <td>Indomaret, Alfamart</td>
                                <td>Rp 2.500</td>
                            </tr>
                            <tr>
                                <td><strong>Tunai di Sekolah</strong></td>
                                <td>Langsung ke bagian keuangan</td>
                                <td>Gratis</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <div class="mt-4">
                    <h5 class="fw-bold mb-3">Informasi Pembayaran:</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <ul>
                                <li>Pembayaran dapat dicicil maksimal 3x</li>
                                <li>Cicilan pertama minimal 50%</li>
                                <li>Bukti pembayaran wajib disimpan</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul>
                                <li>Pembayaran via transfer lebih cepat</li>
                                <li>Konfirmasi otomatis dalam 1x24 jam</li>
                                <li>Customer service siap membantu</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Program Beasiswa -->
<section class="py-5" style="background-color: #f8f9fa;">
    <div class="container">
        <h2 class="section-title fw-bold text-center">Program Beasiswa</h2>
        <p class="text-center text-muted mb-5">Berbagai program beasiswa untuk meringankan biaya pendidikan</p>
        
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead style="background-color: #1B1A55; color: white;">
                            <tr>
                                <th width="25%">Jenis Beasiswa</th>
                                <th width="25%">Potongan</th>
                                <th width="30%">Syarat</th>
                                <th width="20%">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>Beasiswa Prestasi</strong></td>
                                <td>50% - 100%</td>
                                <td>Juara 1-3 tingkat kabupaten/kota</td>
                                <td><span class="badge" style="background-color: #1B1A55; color: white;">Tersedia</span></td>
                            </tr>
                            <tr>
                                <td><strong>Beasiswa KIP</strong></td>
                                <td>100%</td>
                                <td>Memiliki Kartu Indonesia Pintar</td>
                                <td><span class="badge" style="background-color: #1B1A55; color: white;">Tersedia</span></td>
                            </tr>
                            <tr>
                                <td><strong>Beasiswa Yatim</strong></td>
                                <td>75%</td>
                                <td>Anak yatim/piatu dengan surat keterangan</td>
                                <td><span class="badge" style="background-color: #1B1A55; color: white;">Tersedia</span></td>
                            </tr>
                            <tr>
                                <td><strong>Beasiswa Ekonomi</strong></td>
                                <td>50%</td>
                                <td>Keluarga kurang mampu dengan surat RT/RW</td>
                                <td><span class="badge" style="background-color: #1B1A55; color: white;">Terbatas</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <div class="p-3 mt-3" style="background-color: #1B1A55; color: white;">
                    <h6 class="fw-bold">Catatan Penting Beasiswa:</h6>
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="mb-0">
                                <li>Beasiswa berlaku selama 3 tahun</li>
                                <li>Wajib mempertahankan prestasi</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="mb-0">
                                <li>Dokumen pendukung harus lengkap</li>
                                <li>Verifikasi dilakukan setiap semester</li>
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
            <a href="{{ route('jadwal') }}" class="btn btn-outline-light btn-lg px-4">
                <i class="fas fa-calendar-check me-2"></i>Lihat Jadwal
            </a>
        </div>
    </div>
</section>
@endsection