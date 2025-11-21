<?php

namespace App\Http\Controllers\Panitia;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    public function index(Request $request)
    {
        $query = Pendaftaran::with(['user', 'jurusan', 'gelombang']);

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->jurusan_id) {
            $query->where('jurusan_id', $request->jurusan_id);
        }

        if ($request->gelombang_id) {
            $query->where('gelombang_id', $request->gelombang_id);
        }

        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('no_pendaftaran', 'like', '%' . $request->search . '%')
                  ->orWhereHas('user', function($q2) use ($request) {
                      $q2->where('nama_lengkap', 'like', '%' . $request->search . '%');
                  });
            });
        }

        $pendaftarans = $query->orderBy('created_at', 'desc')->paginate(20);
        $jurusans = \App\Models\Jurusan::all();
        $gelombangs = \App\Models\Gelombang::all();

        // Statistik
        $totalPendaftar = Pendaftaran::count();
        $menungguVerifikasi = Pendaftaran::where('status', 'SUBMIT')->count();
        $disetujui = Pendaftaran::where('status', 'ADM_PASS')->count();
        $ditolak = Pendaftaran::where('status', 'ADM_REJECT')->count();

        return view('panitia.pages.pendaftaran.index', compact(
            'pendaftarans', 'jurusans', 'gelombangs',
            'totalPendaftar', 'menungguVerifikasi', 'disetujui', 'ditolak'
        ));
    }

    public function show($id)
    {
        $pendaftaran = Pendaftaran::with([
            'user', 
            'jurusan', 
            'gelombang', 
            'dataSiswa', 
            'dataOrtu', 
            'asalSekolah', 
            'berkas'
        ])->findOrFail($id);

        return view('panitia.pages.pendaftaran.detail', compact('pendaftaran'));
    }
}
