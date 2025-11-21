<?php

namespace App\Http\Controllers\KepalaSekolah;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use App\Models\Jurusan;
use App\Models\PendaftarDataSiswa;
use App\Models\PendaftarAsalSekolah;
use App\Models\Regency;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Hanya tampilkan siswa yang diterima (status_pembayaran = 'lunas')
        $siswaDiterima = Pendaftaran::where('status_pembayaran', 'lunas');
        
        // KPI 1: Siswa Diterima vs Kuota
        $totalKuota = Jurusan::where('is_active', 1)->sum('kuota');
        $totalDiterima = $siswaDiterima->count();
        $persenKuota = $totalKuota > 0 ? round(($totalDiterima / $totalKuota) * 100, 1) : 0;
        
        // KPI 2: Tren Penerimaan Hari Ini
        $diterimaHariIni = Pendaftaran::where('status_pembayaran', 'lunas')
            ->whereDate('tgl_verifikasi_payment', Carbon::today())->count();
        $diterimaKemarin = Pendaftaran::where('status_pembayaran', 'lunas')
            ->whereDate('tgl_verifikasi_payment', Carbon::yesterday())->count();
        $trenSelisih = $diterimaHariIni - $diterimaKemarin;
        
        // KPI 3: Total Siswa Baru
        $totalSiswaBaru = $totalDiterima;
        
        // KPI 4: Rasio Penerimaan per Jurusan
        $jurusanTerisi = Jurusan::where('is_active', 1)
            ->whereHas('pendaftarans', function($q) {
                $q->where('status_pembayaran', 'lunas');
            })->count();
        $totalJurusan = Jurusan::where('is_active', 1)->count();
        $persenJurusanTerisi = $totalJurusan > 0 ? round(($jurusanTerisi / $totalJurusan) * 100, 1) : 0;
        
        // Tren Penerimaan 7 Hari Terakhir
        $tren7Hari = [];
        for ($i = 6; $i >= 0; $i--) {
            $tanggal = Carbon::today()->subDays($i);
            $tren7Hari[] = [
                'tanggal' => $tanggal->format('d/m'),
                'jumlah' => Pendaftaran::where('status_pembayaran', 'lunas')
                    ->whereDate('tgl_verifikasi_payment', $tanggal)->count()
            ];
        }
        $rataRataHarian = $totalDiterima > 0 ? round(array_sum(array_column($tren7Hari, 'jumlah')) / 7, 1) : 0;
        
        // Top 5 Asal Sekolah (Siswa Diterima)
        $topAsalSekolah = PendaftarAsalSekolah::select('nama_sekolah', DB::raw('count(*) as total'))
            ->join('pendaftarans', 'pendaftar_asal_sekolah.pendaftar_id', '=', 'pendaftarans.id')
            ->where('pendaftarans.status_pembayaran', 'lunas')
            ->groupBy('nama_sekolah')
            ->orderByDesc('total')
            ->limit(5)
            ->get()
            ->map(function($item) use ($totalDiterima) {
                $item->persen = $totalDiterima > 0 ? round(($item->total / $totalDiterima) * 100, 1) : 0;
                return $item;
            });
        
        // Top 5 Wilayah (Siswa Diterima)
        $topWilayah = PendaftarDataSiswa::select('districts.regency_id', 'regencies.name as regency_name', DB::raw('count(*) as total'))
            ->join('villages', 'pendaftar_data_siswa.village_id', '=', 'villages.id')
            ->join('districts', 'villages.district_id', '=', 'districts.id')
            ->join('regencies', 'districts.regency_id', '=', 'regencies.id')
            ->join('pendaftarans', 'pendaftar_data_siswa.pendaftar_id', '=', 'pendaftarans.id')
            ->where('pendaftarans.status_pembayaran', 'lunas')
            ->whereNotNull('pendaftar_data_siswa.village_id')
            ->groupBy('districts.regency_id', 'regencies.name')
            ->orderByDesc('total')
            ->limit(5)
            ->get()
            ->map(function($item) use ($totalDiterima) {
                $item->persen = $totalDiterima > 0 ? round(($item->total / $totalDiterima) * 100, 1) : 0;
                return $item;
            });
        
        // Detail per Jurusan (Siswa Diterima)
        $detailJurusan = Jurusan::where('is_active', 1)
            ->get()
            ->map(function($jurusan) {
                $jurusan->diterima_count = Pendaftaran::where('jurusan_id', $jurusan->id)
                    ->where('status_pembayaran', 'lunas')->count();
                $jurusan->persen = $jurusan->kuota > 0 ? round(($jurusan->diterima_count / $jurusan->kuota) * 100, 1) : 0;
                $jurusan->sisa_kuota = $jurusan->kuota - $jurusan->diterima_count;
                return $jurusan;
            });
        
        // Siswa Diterima Terbaru
        $siswaTerbaru = Pendaftaran::with(['user', 'jurusan'])
            ->where('status_pembayaran', 'lunas')
            ->orderBy('tgl_verifikasi_payment', 'desc')
            ->limit(10)
            ->get();
        
        // Additional variables for view compatibility
        $persenVerifikasi = 100; // All lunas students are verified
        $terverifikasi = $totalDiterima;
        $pendaftarHariIni = $diterimaHariIni;
        $persenLunas = 100; // All shown students are lunas
        $lunas = $totalDiterima;
        $diterima = $totalDiterima;
        
        return view('kepala-sekolah.pages.dashboard', compact(
            'totalKuota', 'totalDiterima', 'persenKuota',
            'diterimaHariIni', 'diterimaKemarin', 'trenSelisih',
            'totalSiswaBaru', 'jurusanTerisi', 'totalJurusan', 'persenJurusanTerisi',
            'tren7Hari', 'rataRataHarian',
            'topAsalSekolah', 'topWilayah',
            'detailJurusan', 'siswaTerbaru',
            'persenVerifikasi', 'terverifikasi', 'pendaftarHariIni',
            'persenLunas', 'lunas', 'diterima'
        ));
    }
}
