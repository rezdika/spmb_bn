<?php

namespace App\Http\Controllers\Keuangan;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function riwayat(Request $request)
    {
        $query = Pendaftaran::with(['user', 'jurusan', 'gelombang'])
            ->where('status', 'ADM_PASS')
            ->whereNotNull('tgl_verifikasi_payment');

        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('no_pendaftaran', 'like', '%' . $request->search . '%')
                  ->orWhereHas('user', function($q2) use ($request) {
                      $q2->where('nama_lengkap', 'like', '%' . $request->search . '%');
                  });
            });
        }

        $transaksis = $query->orderBy('tgl_verifikasi_payment', 'desc')->paginate(20);
        
        $stats = [
            'total' => Pendaftaran::where('status', 'ADM_PASS')->whereNotNull('tgl_verifikasi_payment')->count(),
            'lunas' => Pendaftaran::where('status_pembayaran', 'lunas')->count(),
            'menunggu' => Pendaftaran::where('status_pembayaran', 'menunggu_verifikasi')->count(),
            'belum_bayar' => Pendaftaran::where('status', 'ADM_PASS')->where('status_pembayaran', 'belum_bayar')->count()
        ];

        return view('keuangan.pages.transaksi.riwayat', compact('transaksis', 'stats'));
    }

    public function lunas(Request $request)
    {
        $query = Pendaftaran::with(['user', 'jurusan', 'gelombang'])
            ->where('status_pembayaran', 'lunas');

        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('no_pendaftaran', 'like', '%' . $request->search . '%')
                  ->orWhereHas('user', function($q2) use ($request) {
                      $q2->where('nama_lengkap', 'like', '%' . $request->search . '%');
                  });
            });
        }

        $pembayarans = $query->orderBy('tgl_verifikasi_payment', 'desc')->paginate(20);
        
        $stats = [
            'total' => Pendaftaran::where('status', 'ADM_PASS')->count(),
            'lunas' => Pendaftaran::where('status_pembayaran', 'lunas')->count(),
            'menunggu' => Pendaftaran::where('status_pembayaran', 'menunggu_verifikasi')->count(),
            'belum_bayar' => Pendaftaran::where('status', 'ADM_PASS')->where('status_pembayaran', 'belum_bayar')->count()
        ];

        return view('keuangan.pages.transaksi.lunas', compact('pembayarans', 'stats'));
    }


}
