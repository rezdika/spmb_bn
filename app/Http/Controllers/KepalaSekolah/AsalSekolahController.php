<?php

namespace App\Http\Controllers\KepalaSekolah;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AsalSekolahController extends Controller
{
    public function index(Request $request)
    {
        $query = DB::table('pendaftarans')
            ->join('pendaftar_asal_sekolah', 'pendaftarans.id', '=', 'pendaftar_asal_sekolah.pendaftar_id')
            ->select('pendaftar_asal_sekolah.nama_sekolah as asal_sekolah', DB::raw('count(*) as total'))
            ->where('pendaftarans.status', 'ADM_PASS')
            ->whereNotNull('pendaftar_asal_sekolah.nama_sekolah')
            ->groupBy('pendaftar_asal_sekolah.nama_sekolah');

        if ($request->jurusan_id) {
            $query->where('pendaftarans.jurusan_id', $request->jurusan_id);
        }

        $asalSekolah = $query->orderBy('total', 'desc')->paginate(20);
        $jurusans = Jurusan::all();

        $topSekolah = DB::table('pendaftarans')
            ->join('pendaftar_asal_sekolah', 'pendaftarans.id', '=', 'pendaftar_asal_sekolah.pendaftar_id')
            ->select('pendaftar_asal_sekolah.nama_sekolah as asal_sekolah', DB::raw('count(*) as total'))
            ->where('pendaftarans.status', 'ADM_PASS')
            ->whereNotNull('pendaftar_asal_sekolah.nama_sekolah')
            ->groupBy('pendaftar_asal_sekolah.nama_sekolah')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->get();

        // Statistik
        $totalSekolah = DB::table('pendaftarans')
            ->join('pendaftar_asal_sekolah', 'pendaftarans.id', '=', 'pendaftar_asal_sekolah.pendaftar_id')
            ->where('pendaftarans.status', 'ADM_PASS')
            ->whereNotNull('pendaftar_asal_sekolah.nama_sekolah')
            ->distinct('pendaftar_asal_sekolah.nama_sekolah')
            ->count('pendaftar_asal_sekolah.nama_sekolah');
        
        $totalSiswa = Pendaftaran::where('status', 'ADM_PASS')->count();
        $sekolahTerbanyak = $topSekolah->first();
        $rataRata = $totalSekolah > 0 ? round($totalSiswa / $totalSekolah, 1) : 0;

        return view('kepala-sekolah.pages.siswa-diterima.asal-sekolah', compact('asalSekolah', 'jurusans', 'topSekolah', 'totalSekolah', 'totalSiswa', 'sekolahTerbanyak', 'rataRata'));
    }
}
