<?php

namespace App\Http\Controllers\Panitia;

use App\Http\Controllers\Controller;
use App\Models\PendaftarBerkas;
use App\Models\Jurusan;
use App\Models\Gelombang;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BerkasController extends Controller
{
    public function index(Request $request)
    {
        $query = PendaftarBerkas::with(['pendaftar.user', 'pendaftar.jurusan', 'pendaftar.gelombang']);

        if ($request->jenis) {
            $query->where('jenis', $request->jenis);
        }

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->search) {
            $query->whereHas('pendaftar.user', function($q) use ($request) {
                $q->where('nama_lengkap', 'like', '%' . $request->search . '%');
            });
        }

        // Group berkas by pendaftar
        $berkasList = $query->orderBy('created_at', 'desc')->get();
        $groupedBerkas = $berkasList->groupBy('pendaftar_id');
        
        // Convert to paginated collection
        $currentPage = request()->get('page', 1);
        $perPage = 10;
        $currentItems = $groupedBerkas->slice(($currentPage - 1) * $perPage, $perPage);
        
        $berkas = new \Illuminate\Pagination\LengthAwarePaginator(
            $currentItems,
            $groupedBerkas->count(),
            $perPage,
            $currentPage,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        // Statistik
        $totalBerkas = PendaftarBerkas::count();
        $berkasApproved = PendaftarBerkas::where('status', 'approved')->count();
        $berkasRevision = PendaftarBerkas::where('status', 'revision')->count();
        $berkasRejected = PendaftarBerkas::where('status', 'rejected')->count();
        $berkasPending = PendaftarBerkas::where('status', 'pending')->count();

        return view('panitia.pages.berkas.index', compact(
            'berkas', 'totalBerkas', 'berkasApproved', 'berkasRevision', 'berkasRejected', 'berkasPending'
        ));
    }

    public function preview($id)
    {
        $berkas = PendaftarBerkas::with(['pendaftar.user'])->findOrFail($id);
        
        $filePath = storage_path('app/public/' . $berkas->url);
        
        if (!file_exists($filePath)) {
            abort(404);
        }
        
        return response()->file($filePath);
    }

    public function download($id)
    {
        $berkas = PendaftarBerkas::with(['pendaftar.user'])->findOrFail($id);
        
        $filePath = storage_path('app/public/' . $berkas->url);
        
        if (!file_exists($filePath)) {
            abort(404);
        }
        
        return response()->download($filePath, $berkas->nama_file);
    }

    public function verify(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected,revision',
            'catatan_panitia' => 'nullable|string|max:500'
        ]);

        $berkas = PendaftarBerkas::findOrFail($id);
        
        $berkas->update([
            'status' => $request->status,
            'catatan_panitia' => $request->catatan_panitia,
            'verified_at' => now(),
            'verified_by' => Auth::id()
        ]);

        // Update status pendaftaran berdasarkan status berkas
        $this->updatePendaftaranStatus($berkas->pendaftar_id);

        return response()->json([
            'success' => true,
            'message' => 'Berkas berhasil diverifikasi!'
        ]);
    }

    private function updatePendaftaranStatus($pendaftarId)
    {
        $pendaftar = \App\Models\Pendaftaran::find($pendaftarId);
        if (!$pendaftar) return;

        $allBerkas = PendaftarBerkas::where('pendaftar_id', $pendaftarId)->get();
        $totalBerkas = $allBerkas->count();
        $approvedBerkas = $allBerkas->where('status', 'approved')->count();
        $rejectedBerkas = $allBerkas->where('status', 'rejected')->count();
        $revisionBerkas = $allBerkas->where('status', 'revision')->count();

        // Jika ada berkas yang ditolak, status = ADM_REJECT
        if ($rejectedBerkas > 0) {
            $pendaftar->update(['status' => 'ADM_REJECT']);
        }
        // Jika ada berkas yang perlu revisi, status tetap SUBMIT (perlu revisi)
        elseif ($revisionBerkas > 0) {
            $pendaftar->update(['status' => 'SUBMIT']);
        }
        // Jika semua berkas disetujui, status = ADM_PASS
        elseif ($approvedBerkas == $totalBerkas && $totalBerkas > 0) {
            $pendaftar->update(['status' => 'ADM_PASS']);
        }
        // Jika masih ada yang pending, status tetap SUBMIT
        else {
            $pendaftar->update(['status' => 'SUBMIT']);
        }
    }

    public function bulkVerify(Request $request)
    {
        $request->validate([
            'berkas_ids' => 'required|array',
            'berkas_ids.*' => 'exists:pendaftar_berkas,id',
            'status' => 'required|in:approved,rejected,revision',
            'catatan_panitia' => 'nullable|string|max:500'
        ]);

        // Get unique pendaftar IDs before update
        $pendaftarIds = PendaftarBerkas::whereIn('id', $request->berkas_ids)
            ->pluck('pendaftar_id')
            ->unique();

        PendaftarBerkas::whereIn('id', $request->berkas_ids)
            ->update([
                'status' => $request->status,
                'catatan_panitia' => $request->catatan_panitia,
                'verified_at' => now(),
                'verified_by' => Auth::id()
            ]);

        // Update status pendaftaran untuk setiap siswa yang terkena dampak
        foreach ($pendaftarIds as $pendaftarId) {
            $this->updatePendaftaranStatus($pendaftarId);
        }

        return response()->json([
            'success' => true,
            'message' => count($request->berkas_ids) . ' berkas berhasil diverifikasi!'
        ]);
    }
}
