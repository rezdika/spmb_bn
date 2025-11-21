<?php

namespace App\Http\Controllers;

use App\Models\Gelombang;
use Illuminate\Http\Request;

class InformasiController extends Controller
{

    public function jadwal()
    {
        $gelombangs = Gelombang::orderBy('tgl_mulai')->get();
        return view('user.pages.jadwal', compact('gelombangs'));
    }

    public function biaya()
    {
        return view('user.pages.biaya');
    }

    public function pengumuman()
    {
        // Ambil data siswa yang diterima berdasarkan gelombang
        $siswaGelombang1 = \App\Models\Pendaftaran::with(['user', 'jurusan', 'gelombang'])
            ->where('status_pembayaran', 'lunas')
            ->whereHas('gelombang', function($q) {
                $q->where('nama', 'like', '%Gelombang 1%');
            })
            ->orderBy('tgl_verifikasi_payment', 'desc')
            ->get();
            
        $siswaGelombang2 = \App\Models\Pendaftaran::with(['user', 'jurusan', 'gelombang'])
            ->where('status_pembayaran', 'lunas')
            ->whereHas('gelombang', function($q) {
                $q->where('nama', 'like', '%Gelombang 2%');
            })
            ->orderBy('tgl_verifikasi_payment', 'desc')
            ->get();
            
        return view('user.pages.pengumuman', compact('siswaGelombang1', 'siswaGelombang2'));
    }
}