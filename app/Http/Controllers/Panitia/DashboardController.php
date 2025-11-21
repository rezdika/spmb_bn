<?php

namespace App\Http\Controllers\Panitia;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use App\Models\PendaftarBerkas;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPendaftar = Pendaftaran::count();
        $menungguVerifikasi = Pendaftaran::where('status', 'SUBMIT')->count();
        $disetujui = Pendaftaran::where('status', 'ADM_PASS')->count();
        $ditolak = Pendaftaran::where('status', 'ADM_REJECT')->count();

        $totalBerkas = PendaftarBerkas::count();
        $berkasValid = PendaftarBerkas::where('status', 'approved')->count();
        $berkasTidakValid = PendaftarBerkas::whereIn('status', ['rejected', 'revision'])->count();
        $berkasBelumVerifikasi = PendaftarBerkas::where('status', 'pending')->count();

        $berkasByJenis = PendaftarBerkas::select('jenis', DB::raw('count(*) as total'))
            ->groupBy('jenis')
            ->get();

        $pendaftaranPerJurusan = Pendaftaran::select('jurusan_id', DB::raw('count(*) as total'))
            ->with('jurusan')
            ->groupBy('jurusan_id')
            ->get();

        $recentVerifikasi = PendaftarBerkas::whereNotNull('verified_at')
            ->with(['pendaftar.user', 'pendaftar.jurusan', 'verifiedBy'])
            ->orderBy('verified_at', 'desc')
            ->limit(10)
            ->get();

        // Trend pendaftaran 7 hari terakhir
        $trendPendaftaran = Pendaftaran::select(
                DB::raw('DATE(tanggal_daftar) as tanggal'),
                DB::raw('count(*) as total')
            )
            ->where('tanggal_daftar', '>=', now()->subDays(7))
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();

        // Status per gelombang
        $statusPerGelombang = Pendaftaran::select(
                'gelombang_id',
                'status',
                DB::raw('count(*) as total')
            )
            ->with('gelombang')
            ->groupBy('gelombang_id', 'status')
            ->get()
            ->groupBy('gelombang_id');

        return view('panitia.pages.dashboard', compact(
            'totalPendaftar', 'menungguVerifikasi', 'disetujui', 'ditolak',
            'totalBerkas', 'berkasValid', 'berkasTidakValid', 'berkasBelumVerifikasi',
            'berkasByJenis', 'pendaftaranPerJurusan', 'recentVerifikasi',
            'trendPendaftaran', 'statusPerGelombang'
        ));
    }
}
