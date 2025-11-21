<?php

namespace App\Http\Controllers\Keuangan;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function harian(Request $request)
    {
        $tanggal = $request->tanggal ?? date('Y-m-d');
        
        $laporan = Pendaftaran::with(['user', 'jurusan'])
            ->where('status_pembayaran', 'lunas')
            ->whereDate('tgl_verifikasi_payment', $tanggal)
            ->get();

        $totalNominal = $laporan->sum('jumlah_pembayaran');
        $totalTransaksi = $laporan->count();

        return view('keuangan.pages.laporan.harian', compact('laporan', 'totalNominal', 'totalTransaksi', 'tanggal'));
    }

    public function bulanan(Request $request)
    {
        $bulan = $request->bulan ?? date('Y-m');
        
        $laporan = Pendaftaran::with(['user', 'jurusan'])
            ->where('status_pembayaran', 'lunas')
            ->whereYear('tgl_verifikasi_payment', substr($bulan, 0, 4))
            ->whereMonth('tgl_verifikasi_payment', substr($bulan, 5, 2))
            ->get();

        $totalNominal = $laporan->sum('jumlah_pembayaran');
        $totalTransaksi = $laporan->count();

        $perHari = Pendaftaran::where('status_pembayaran', 'lunas')
            ->whereYear('tgl_verifikasi_payment', substr($bulan, 0, 4))
            ->whereMonth('tgl_verifikasi_payment', substr($bulan, 5, 2))
            ->select(DB::raw('DATE(tgl_verifikasi_payment) as tanggal'), DB::raw('COUNT(*) as total'), DB::raw('SUM(jumlah_pembayaran) as nominal'))
            ->groupBy('tanggal')
            ->get();

        return view('keuangan.pages.laporan.bulanan', compact('laporan', 'totalNominal', 'totalTransaksi', 'bulan', 'perHari'));
    }

    public function jurusan(Request $request)
    {
        $jurusans = Jurusan::withCount(['pendaftarans as total_lunas' => function($q) {
            $q->where('status_pembayaran', 'lunas');
        }])->with(['pendaftarans' => function($q) {
            $q->where('status_pembayaran', 'lunas');
        }])->get();

        $laporan = $jurusans->map(function($jurusan) {
            return [
                'nama' => $jurusan->nama,
                'total_siswa' => $jurusan->total_lunas,
                'total_nominal' => $jurusan->pendaftarans->sum('jumlah_pembayaran')
            ];
        });

        $totalNominal = $laporan->sum('total_nominal');
        $totalSiswa = $laporan->sum('total_siswa');

        return view('keuangan.pages.laporan.jurusan', compact('laporan', 'totalNominal', 'totalSiswa'));
    }
}
