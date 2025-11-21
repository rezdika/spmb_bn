<?php

use App\Http\Controllers\SejarahController;
use App\Http\Controllers\SambutanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InformasiController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\TenagaPendidikController;
use App\Http\Controllers\VisiMisiController;



// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/panduan', [HomeController::class, 'panduan'])->name('panduan');
Route::get('/prestasi', [PrestasiController::class, 'index'])->name('prestasi.index');
Route::get('/prestasi/{slug}', [PrestasiController::class, 'show'])->name('prestasi.detail');

// Informasi Routes
Route::get('/jadwal', [InformasiController::class, 'jadwal'])->name('jadwal');
Route::get('/biaya', [InformasiController::class, 'biaya'])->name('biaya');
Route::get('/pengumuman', [InformasiController::class, 'pengumuman'])->name('pengumuman');

// Tenaga Pendidik Routes
Route::get('/tenaga-pendidik', [TenagaPendidikController::class, 'index'])->name('tenaga-pendidik');

// Visi Misi Routes
Route::get('/visi-misi', [VisiMisiController::class, 'index'])->name('visi-misi');

// Sejarah Routes
Route::get('/sejarah', [SejarahController::class, 'index'])->name('sejarah');

// Sambutan Kepala Sekolah Routes
Route::get('/sambutan-kepala-sekolah', [SambutanController::class, 'index'])->name('sambutan');


// Jurusan Routes
Route::get('/jurusan', [JurusanController::class, 'index'])->name('jurusan');

// Kontak Routes
Route::get('/kontak', [KontakController::class, 'index'])->name('kontak');
Route::post('/kontak', [KontakController::class, 'store'])->name('kontak.store');

// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register/send-otp', [AuthController::class, 'sendOtp'])->name('send.otp');
Route::get('/verify-otp', [AuthController::class, 'showVerifyOtp'])->name('verify.otp.form');
Route::post('/verify-otp', [AuthController::class, 'verifyOtp'])->name('verify.otp');
Route::post('/resend-otp', [AuthController::class, 'resendOtp'])->name('resend.otp');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// CSRF Token Refresh Route
Route::get('/csrf-token', function () {
    return response()->json(['csrf_token' => csrf_token()]);
});

// Wilayah API Routes
Route::get('/api/regencies/{provinceId}', [ProfileController::class, 'getRegencies']);
Route::get('/api/districts/{regencyId}', [ProfileController::class, 'getDistricts']);
Route::get('/api/villages/{districtId}', [ProfileController::class, 'getVillages']);

// Admin Routes (Protected)
Route::prefix('admin')->name('admin.')->middleware(['auth', App\Http\Middleware\AdminMiddleware::class])->group(function () {
    Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('jurusan', App\Http\Controllers\Admin\JurusanController::class);
    Route::resource('gelombang', App\Http\Controllers\Admin\GelombangController::class);
    Route::resource('prestasi', App\Http\Controllers\Admin\PrestasiController::class);
    Route::resource('guru', App\Http\Controllers\Admin\GuruController::class);
    // Wilayah Management
    Route::resource('provinces', App\Http\Controllers\Admin\ProvinceController::class);
    Route::resource('regencies', App\Http\Controllers\Admin\RegencyController::class);
    Route::resource('districts', App\Http\Controllers\Admin\DistrictController::class);
    Route::resource('villages', App\Http\Controllers\Admin\VillageController::class);
    Route::resource('user', App\Http\Controllers\Admin\UserController::class);
    
    // Additional Admin Pages
    Route::get('/profile', [App\Http\Controllers\Admin\ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile', [App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [App\Http\Controllers\Admin\ProfileController::class, 'updatePassword'])->name('profile.password.update');
    
    // Monitoring Berkas
    Route::get('/monitoring-berkas', [App\Http\Controllers\Admin\MonitoringBerkasController::class, 'index'])->name('monitoring-berkas.index');
    Route::post('/monitoring-berkas/export', [App\Http\Controllers\Admin\MonitoringBerkasController::class, 'export'])->name('monitoring-berkas.export');
    
    // Pendaftaran Detail
    Route::get('/pendaftaran/{id}', [App\Http\Controllers\Admin\PendaftaranController::class, 'show'])->name('pendaftaran.show');
    
    // Peta Sebaran
    Route::get('/peta-sebaran', [App\Http\Controllers\Admin\PetaSebaranController::class, 'index'])->name('peta-sebaran.index');
    Route::get('/peta-sebaran/data', [App\Http\Controllers\Admin\PetaSebaranController::class, 'getData'])->name('peta-sebaran.data');
});

// Keuangan Routes (Protected)
Route::prefix('keuangan')->name('keuangan.')->middleware(['auth', App\Http\Middleware\KeuanganMiddleware::class])->group(function () {
    Route::get('/', [App\Http\Controllers\Keuangan\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/pembayaran', [App\Http\Controllers\Keuangan\PembayaranController::class, 'index'])->name('pembayaran.index');
    Route::get('/pembayaran/{id}', [App\Http\Controllers\Keuangan\PembayaranController::class, 'show'])->name('pembayaran.show');
    Route::get('/pembayaran/{id}/download-bukti', [App\Http\Controllers\Keuangan\PembayaranController::class, 'downloadBukti'])->name('pembayaran.download-bukti');
    Route::post('/pembayaran/{id}/verifikasi', [App\Http\Controllers\Keuangan\PembayaranController::class, 'verifikasi'])->name('pembayaran.verifikasi');
    
    // Transaksi
    Route::get('/transaksi/riwayat', [App\Http\Controllers\Keuangan\TransaksiController::class, 'riwayat'])->name('transaksi.riwayat');
    Route::get('/transaksi/lunas', [App\Http\Controllers\Keuangan\TransaksiController::class, 'lunas'])->name('transaksi.lunas');
    
    // Laporan
    Route::get('/laporan/harian', [App\Http\Controllers\Keuangan\LaporanController::class, 'harian'])->name('laporan.harian');
    Route::get('/laporan/bulanan', [App\Http\Controllers\Keuangan\LaporanController::class, 'bulanan'])->name('laporan.bulanan');
    Route::get('/laporan/jurusan', [App\Http\Controllers\Keuangan\LaporanController::class, 'jurusan'])->name('laporan.jurusan');
    
    // Rekap & Export
    Route::get('/rekap', [App\Http\Controllers\Keuangan\RekapController::class, 'index'])->name('rekap.index');
    Route::post('/rekap/export', [App\Http\Controllers\Keuangan\RekapController::class, 'export'])->name('rekap.export');
    
    // Profile
    Route::get('/profile', [App\Http\Controllers\Keuangan\ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile', [App\Http\Controllers\Keuangan\ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [App\Http\Controllers\Keuangan\ProfileController::class, 'updatePassword'])->name('profile.password.update');
});

// Kepala Sekolah Routes (Protected)
Route::prefix('kepala-sekolah')->name('kepala-sekolah.')->middleware(['auth', App\Http\Middleware\KepalaSekolahMiddleware::class])->group(function () {
    Route::get('/', [App\Http\Controllers\KepalaSekolah\DashboardController::class, 'index'])->name('dashboard');
    
    // Calon Siswa
    Route::get('/calon-siswa', [App\Http\Controllers\KepalaSekolah\CalonSiswaController::class, 'index'])->name('calon-siswa.index');
    Route::get('/calon-siswa/{id}', [App\Http\Controllers\KepalaSekolah\CalonSiswaController::class, 'show'])->name('calon-siswa.show');
    
    // Siswa Diterima
    Route::get('/siswa-diterima/rekap-pembayaran', [App\Http\Controllers\KepalaSekolah\RekapPembayaranController::class, 'index'])->name('siswa-diterima.rekap-pembayaran');
    Route::post('/siswa-diterima/rekap-pembayaran/export', [App\Http\Controllers\KepalaSekolah\RekapPembayaranController::class, 'export'])->name('siswa-diterima.rekap-pembayaran.export');
    
    Route::get('/siswa-diterima/asal-sekolah', [App\Http\Controllers\KepalaSekolah\AsalSekolahController::class, 'index'])->name('siswa-diterima.asal-sekolah');
    Route::post('/siswa-diterima/asal-sekolah/export', [App\Http\Controllers\KepalaSekolah\AsalSekolahController::class, 'export'])->name('siswa-diterima.asal-sekolah.export');
    
    Route::get('/siswa-diterima/sebaran-wilayah', [App\Http\Controllers\KepalaSekolah\SebaranWilayahController::class, 'index'])->name('siswa-diterima.sebaran-wilayah');
    Route::post('/siswa-diterima/sebaran-wilayah/export', [App\Http\Controllers\KepalaSekolah\SebaranWilayahController::class, 'export'])->name('siswa-diterima.sebaran-wilayah.export');
    
    // Profile
    Route::get('/profile', [App\Http\Controllers\KepalaSekolah\ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile', [App\Http\Controllers\KepalaSekolah\ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [App\Http\Controllers\KepalaSekolah\ProfileController::class, 'updatePassword'])->name('profile.password.update');
});

// Panitia Routes (Protected)
Route::prefix('panitia')->name('panitia.')->middleware(['auth', App\Http\Middleware\PanitiaMiddleware::class])->group(function () {
    Route::get('/', [App\Http\Controllers\Panitia\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/pendaftaran', [App\Http\Controllers\Panitia\PendaftaranController::class, 'index'])->name('pendaftaran.index');
    Route::get('/pendaftaran/{id}', [App\Http\Controllers\Panitia\PendaftaranController::class, 'show'])->name('pendaftaran.show');
    Route::get('/berkas', [App\Http\Controllers\Panitia\BerkasController::class, 'index'])->name('berkas.index');
    Route::get('/berkas/preview/{id}', [App\Http\Controllers\Panitia\BerkasController::class, 'preview'])->name('berkas.preview');
    Route::get('/berkas/download/{id}', [App\Http\Controllers\Panitia\BerkasController::class, 'download'])->name('berkas.download');
    Route::post('/berkas/verify/{id}', [App\Http\Controllers\Panitia\BerkasController::class, 'verify'])->name('berkas.verify');
    Route::post('/berkas/bulk-verify', [App\Http\Controllers\Panitia\BerkasController::class, 'bulkVerify'])->name('berkas.bulk-verify');
    Route::get('/riwayat', [App\Http\Controllers\Panitia\RiwayatController::class, 'index'])->name('riwayat.index');
    Route::get('/laporan', [App\Http\Controllers\Panitia\LaporanController::class, 'index'])->name('laporan.index');
    Route::post('/laporan/export', [App\Http\Controllers\Panitia\LaporanController::class, 'export'])->name('laporan.export');
    Route::get('/profile', [App\Http\Controllers\Panitia\ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile', [App\Http\Controllers\Panitia\ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [App\Http\Controllers\Panitia\ProfileController::class, 'updatePassword'])->name('profile.password.update');
    Route::post('/verifikasi/berkas/{berkasId}', [App\Http\Controllers\Panitia\VerifikasiController::class, 'verifikasiBerkas'])->name('verifikasi.berkas');
    Route::post('/verifikasi/bulk', [App\Http\Controllers\Panitia\VerifikasiController::class, 'bulkVerify'])->name('verifikasi.bulk');
    Route::post('/verifikasi/submit/{pendaftaranId}', [App\Http\Controllers\Panitia\VerifikasiController::class, 'submitVerifikasi'])->name('verifikasi.submit');
});

// Profile Routes (Protected)
Route::middleware('auth')->group(function () {
    // Specific profile routes first
    Route::get('/profile/data-pribadi', [ProfileController::class, 'dataPribadi'])->name('profile.data-pribadi');
    Route::post('/profile/data-pribadi', [ProfileController::class, 'storeDataPribadi'])->name('profile.data-pribadi.store');
    Route::get('/profile/data-orangtua', [ProfileController::class, 'dataOrangtua'])->name('profile.data-orangtua');
    Route::post('/profile/data-orangtua', [ProfileController::class, 'storeDataOrangtua'])->name('profile.data-orangtua.store');
    Route::get('/profile/asal-sekolah', [ProfileController::class, 'asalSekolah'])->name('profile.asal-sekolah');
    Route::post('/profile/asal-sekolah', [ProfileController::class, 'storeAsalSekolah'])->name('profile.asal-sekolah.store');
    Route::get('/profile/upload-berkas', [ProfileController::class, 'uploadBerkas'])->name('profile.upload-berkas');
    Route::post('/profile/upload-berkas', [ProfileController::class, 'storeUploadBerkas'])->name('profile.upload-berkas.store');
    Route::put('/profile/upload-berkas/{id}/update', [ProfileController::class, 'updateBerkas'])->name('profile.upload-berkas.update');
    Route::delete('/profile/upload-berkas/{id}', [ProfileController::class, 'deleteBerkas'])->name('profile.upload-berkas.delete');
    
    // General profile routes last
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    
    // API Routes untuk dropdown wilayah
    Route::get('/api/regencies/{provinceId}', [ProfileController::class, 'getRegencies']);
    Route::get('/api/districts/{regencyId}', [ProfileController::class, 'getDistricts']);
    Route::get('/api/villages/{districtId}', [ProfileController::class, 'getVillages']);
    
    // Pendaftaran Routes
    Route::get('/pendaftaran', [PendaftaranController::class, 'index'])->name('pendaftaran.index');
    Route::post('/pendaftaran', [PendaftaranController::class, 'store'])->name('pendaftaran.store');
    Route::get('/pendaftaran/success', [PendaftaranController::class, 'success'])->name('pendaftaran.success');
    
    // Berkas Routes
    Route::post('/berkas/upload', [App\Http\Controllers\BerkasController::class, 'upload'])->name('berkas.upload');
    Route::post('/berkas/{id}/update', [App\Http\Controllers\BerkasController::class, 'update'])->name('berkas.update');
    Route::delete('/berkas/{id}', [App\Http\Controllers\BerkasController::class, 'delete'])->name('berkas.delete');
    Route::get('/berkas/preview/{id}', [App\Http\Controllers\BerkasController::class, 'preview'])->name('berkas.preview');
    
    // Monitoring Routes
    Route::get('/monitoring', [App\Http\Controllers\MonitoringController::class, 'index'])->name('monitoring.index');
    Route::post('/monitoring/upload-pembayaran', [App\Http\Controllers\MonitoringController::class, 'uploadBuktiPembayaran'])->name('monitoring.upload-pembayaran');
    Route::get('/monitoring/cetak-kartu/{id}', [App\Http\Controllers\MonitoringController::class, 'cetakKartu'])->name('monitoring.cetak-kartu');
    Route::get('/monitoring/cetak-bukti-bayar/{id}', [App\Http\Controllers\MonitoringController::class, 'cetakBuktiBayar'])->name('monitoring.cetak-bukti-bayar');
});

