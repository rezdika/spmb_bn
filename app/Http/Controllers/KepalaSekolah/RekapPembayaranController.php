<?php

namespace App\Http\Controllers\KepalaSekolah;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class RekapPembayaranController extends Controller
{
    public function index(Request $request)
    {
        $query = Pendaftaran::with(['user', 'jurusan', 'gelombang'])
            ->where('status', 'ADM_PASS');

        if ($request->status_pembayaran) {
            $query->where('status_pembayaran', $request->status_pembayaran);
        }

        if ($request->jurusan_id) {
            $query->where('jurusan_id', $request->jurusan_id);
        }

        if ($request->tanggal_dari && $request->tanggal_sampai) {
            $query->whereBetween('tgl_verifikasi_payment', [$request->tanggal_dari, $request->tanggal_sampai]);
        }

        $pembayarans = $query->orderBy('created_at', 'desc')->paginate(20);
        $jurusans = Jurusan::all();

        $totalNominal = Pendaftaran::where('status', 'ADM_PASS')
            ->where('status_pembayaran', 'lunas')
            ->sum('jumlah_pembayaran');

        // Statistik
        $totalDiterima = Pendaftaran::where('status', 'ADM_PASS')->count();
        $totalLunas = Pendaftaran::where('status', 'ADM_PASS')->where('status_pembayaran', 'lunas')->count();
        $totalMenunggu = Pendaftaran::where('status', 'ADM_PASS')->where('status_pembayaran', 'menunggu_verifikasi')->count();
        $totalBelumBayar = Pendaftaran::where('status', 'ADM_PASS')->where('status_pembayaran', 'belum_bayar')->count();

        return view('kepala-sekolah.pages.siswa-diterima.rekap-pembayaran', compact('pembayarans', 'jurusans', 'totalNominal', 'totalDiterima', 'totalLunas', 'totalMenunggu', 'totalBelumBayar'));
    }
}
