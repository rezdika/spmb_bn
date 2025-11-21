<?php

namespace App\Http\Controllers\Keuangan;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembayaranController extends Controller
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
            $query->whereBetween('created_at', [$request->tanggal_dari, $request->tanggal_sampai]);
        }

        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('no_pendaftaran', 'like', '%' . $request->search . '%')
                  ->orWhereHas('user', function($q2) use ($request) {
                      $q2->where('nama_lengkap', 'like', '%' . $request->search . '%');
                  });
            });
        }

        $pembayarans = $query->orderBy('created_at', 'desc')->paginate(20);
        $jurusans = Jurusan::all();
        
        $stats = [
            'total' => Pendaftaran::where('status', 'ADM_PASS')->count(),
            'lunas' => Pendaftaran::where('status_pembayaran', 'lunas')->count(),
            'menunggu' => Pendaftaran::where('status_pembayaran', 'menunggu_verifikasi')->count(),
            'belum_bayar' => Pendaftaran::where('status', 'ADM_PASS')->where('status_pembayaran', 'belum_bayar')->count()
        ];

        return view('keuangan.pages.pembayaran.index', compact('pembayarans', 'jurusans', 'stats'));
    }

    public function show($id)
    {
        $pendaftaran = Pendaftaran::with(['user', 'jurusan', 'gelombang'])->findOrFail($id);
        
        return view('keuangan.pages.pembayaran.show', compact('pendaftaran'));
    }

    public function verifikasi(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:lunas,tolak',
            'catatan' => 'nullable|string|max:500'
        ]);

        $pendaftaran = Pendaftaran::findOrFail($id);

        // Jika ditolak, set status kembali ke belum_bayar
        $statusPembayaran = $request->status === 'tolak' ? 'belum_bayar' : 'lunas';

        $pendaftaran->update([
            'status_pembayaran' => $statusPembayaran,
            'catatan_pembayaran' => $request->catatan,
            'user_verifikasi_payment' => Auth::user()->nama_lengkap,
            'tgl_verifikasi_payment' => now()
        ]);

        $message = $request->status === 'tolak' ? 'Pembayaran ditolak' : 'Pembayaran berhasil diverifikasi';
        
        return redirect()->route('keuangan.pembayaran.index')
            ->with('success', $message);
    }

    public function downloadBukti($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        
        if (!$pendaftaran->bukti_pembayaran) {
            abort(404, 'Bukti pembayaran tidak ditemukan');
        }
        
        $filePath = storage_path('app/public/bukti_pembayaran/' . $pendaftaran->bukti_pembayaran);
        
        if (!file_exists($filePath)) {
            abort(404, 'File bukti pembayaran tidak ditemukan');
        }
        
        return response()->download($filePath, 'Bukti_Pembayaran_' . $pendaftaran->no_pendaftaran . '.' . pathinfo($filePath, PATHINFO_EXTENSION));
    }
}
