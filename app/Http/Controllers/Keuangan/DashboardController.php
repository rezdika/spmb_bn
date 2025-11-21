<?php

namespace App\Http\Controllers\Keuangan;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPembayaran = Pendaftaran::where('status', 'ADM_PASS')->count();
        $lunas = Pendaftaran::where('status_pembayaran', 'lunas')->count();
        $menungguVerifikasi = Pendaftaran::where('status_pembayaran', 'menunggu_verifikasi')->count();
        $belumBayar = Pendaftaran::where('status', 'ADM_PASS')
            ->where('status_pembayaran', 'belum_bayar')->count();
        
        $totalNominal = Pendaftaran::where('status_pembayaran', 'lunas')
            ->sum('jumlah_pembayaran');

        // Chart pembayaran per bulan
        $pembayaranPerBulan = Pendaftaran::where('status_pembayaran', 'lunas')
            ->select(DB::raw('MONTH(tgl_verifikasi_payment) as bulan'), DB::raw('COUNT(*) as total'), DB::raw('SUM(jumlah_pembayaran) as nominal'))
            ->whereYear('tgl_verifikasi_payment', date('Y'))
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        // Chart per jurusan
        $pembayaranPerJurusan = Pendaftaran::where('status_pembayaran', 'lunas')
            ->select('jurusan_id', DB::raw('COUNT(*) as total'), DB::raw('SUM(jumlah_pembayaran) as nominal'))
            ->with('jurusan')
            ->groupBy('jurusan_id')
            ->get();

        // Transaksi hari ini
        $hariIni = Pendaftaran::where('status_pembayaran', 'lunas')
            ->whereDate('tgl_verifikasi_payment', date('Y-m-d'))
            ->count();

        $nominalHariIni = Pendaftaran::where('status_pembayaran', 'lunas')
            ->whereDate('tgl_verifikasi_payment', date('Y-m-d'))
            ->sum('jumlah_pembayaran');

        return view('keuangan.pages.dashboard', compact(
            'totalPembayaran', 'lunas', 'menungguVerifikasi', 'belumBayar', 'totalNominal', 
            'pembayaranPerBulan', 'pembayaranPerJurusan', 'hariIni', 'nominalHariIni'
        ));
    }
}
