<?php

namespace App\Http\Controllers\Panitia;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use App\Models\PendaftarBerkas;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RiwayatController extends Controller
{
    public function index(Request $request)
    {
        // Query berkas yang sudah diverifikasi
        $query = PendaftarBerkas::whereNotNull('verified_at')
            ->with(['pendaftar.user', 'pendaftar.jurusan', 'pendaftar.gelombang', 'verifiedBy']);

        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->whereHas('pendaftar', function($q2) use ($request) {
                    $q2->where('no_pendaftaran', 'like', '%' . $request->search . '%');
                })
                ->orWhereHas('pendaftar.user', function($q2) use ($request) {
                    $q2->where('nama_lengkap', 'like', '%' . $request->search . '%');
                })
                ->orWhereHas('verifiedBy', function($q2) use ($request) {
                    $q2->where('nama_lengkap', 'like', '%' . $request->search . '%');
                });
            });
        }

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->tanggal_dari) {
            $query->whereDate('verified_at', '>=', $request->tanggal_dari);
        }

        if ($request->tanggal_sampai) {
            $query->whereDate('verified_at', '<=', $request->tanggal_sampai);
        }

        $riwayat = $query->orderBy('verified_at', 'desc')->paginate(20);

        // Statistik berdasarkan berkas yang sudah diverifikasi
        $totalVerifikasi = PendaftarBerkas::whereNotNull('verified_at')->count();
        $disetujui = PendaftarBerkas::where('status', 'approved')->count();
        $ditolak = PendaftarBerkas::where('status', 'rejected')->count();
        $revisi = PendaftarBerkas::where('status', 'revision')->count();
        $hariIni = PendaftarBerkas::whereNotNull('verified_at')
            ->whereDate('verified_at', today())->count();

        return view('panitia.pages.riwayat.index', compact(
            'riwayat', 'totalVerifikasi', 'disetujui', 'ditolak', 'revisi', 'hariIni'
        ));
    }
}
