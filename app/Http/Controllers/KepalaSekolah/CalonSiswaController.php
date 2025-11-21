<?php

namespace App\Http\Controllers\KepalaSekolah;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class CalonSiswaController extends Controller
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

        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('no_pendaftaran', 'like', '%' . $request->search . '%')
                  ->orWhereHas('user', function($q2) use ($request) {
                      $q2->where('nama_lengkap', 'like', '%' . $request->search . '%');
                  });
            });
        }

        $calonSiswa = $query->orderBy('created_at', 'desc')->paginate(20);
        $jurusans = Jurusan::all();

        // Statistik
        $totalPendaftar = Pendaftaran::count();
        $totalDiterima = Pendaftaran::where('status', 'ADM_PASS')->count();
        $totalDitolak = Pendaftaran::where('status', 'ADM_REJECT')->count();
        $totalMenunggu = Pendaftaran::where('status', 'SUBMIT')->count();

        return view('kepala-sekolah.pages.calon-siswa.index', compact('calonSiswa', 'jurusans', 'totalPendaftar', 'totalDiterima', 'totalDitolak', 'totalMenunggu'));
    }

    public function show($id)
    {
        $pendaftaran = Pendaftaran::with(['user', 'jurusan', 'gelombang', 'berkas', 'dataSiswa', 'dataOrtu', 'asalSekolah'])->findOrFail($id);
        
        return view('kepala-sekolah.pages.calon-siswa.show', compact('pendaftaran'));
    }
}
