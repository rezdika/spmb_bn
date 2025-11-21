<?php

namespace App\Http\Controllers\Panitia;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use App\Models\PendaftarBerkas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerifikasiController extends Controller
{
    public function verifikasiBerkas(Request $request, $berkasId)
    {
        $request->validate([
            'action' => 'required|in:lulus,perbaikan,tolak',
            'catatan' => 'nullable|string|max:500'
        ], [
            'action.required' => 'Status verifikasi harus dipilih.'
        ]);

        $berkas = PendaftarBerkas::findOrFail($berkasId);
        $action = $request->action;
        $catatan = trim($request->catatan);
        
        if ($action === 'lulus') {
            $berkas->status = 'approved';
            $berkas->catatan_panitia = empty($catatan) ? 'Berkas disetujui' : $catatan;
        } elseif ($action === 'perbaikan') {
            $berkas->status = 'revision';
            $berkas->catatan_panitia = empty($catatan) ? 'Berkas perlu diperbaiki' : $catatan;
        } else { // tolak
            $berkas->status = 'rejected';
            $berkas->catatan_panitia = empty($catatan) ? 'Berkas ditolak' : $catatan;
        }
        
        $berkas->verified_at = now();
        $berkas->verified_by = Auth::id();
        
        $berkas->save();

        // Log activity
        \App\Models\LogAktivitas::log(
            'VERIFY_BERKAS_' . strtoupper($action), 
            'PendaftarBerkas', 
            [
                'berkas_id' => $berkas->id, 
                'pendaftar_id' => $berkas->pendaftar_id,
                'action' => $action,
                'verifikator' => Auth::user()->nama_lengkap
            ]
        );

        return response()->json([
            'success' => true, 
            'message' => 'Berkas berhasil diverifikasi dengan status: ' . strtoupper($action)
        ]);
    }

    public function bulkVerify(Request $request)
    {
        $request->validate([
            'berkas_ids' => 'required|array|min:1',
            'action' => 'required|in:lulus,perbaikan,tolak',
            'catatan' => 'nullable|array'
        ]);

        $berkasIds = $request->input('berkas_ids', []);
        $action = $request->input('action');
        $catatanArray = $request->input('catatan', []);

        $processed = 0;
        foreach ($berkasIds as $id) {
            $berkas = PendaftarBerkas::find($id);
            if (!$berkas) continue;

            $catatan = isset($catatanArray[$id]) ? trim($catatanArray[$id]) : '';

            if ($action === 'lulus') {
                $berkas->status = 'approved';
                $berkas->catatan_panitia = empty($catatan) ? 'Berkas disetujui' : $catatan;
            } elseif ($action === 'perbaikan') {
                $berkas->status = 'revision';
                $berkas->catatan_panitia = empty($catatan) ? 'Berkas perlu diperbaiki' : $catatan;
            } else { // tolak
                $berkas->status = 'rejected';
                $berkas->catatan_panitia = empty($catatan) ? 'Berkas ditolak' : $catatan;
            }
            
            $berkas->verified_at = now();
            $berkas->verified_by = Auth::id();

            $berkas->save();
            $processed++;

            // Log activity
            \App\Models\LogAktivitas::log(
                'VERIFY_BERKAS_' . strtoupper($action), 
                'PendaftarBerkas', 
                [
                    'berkas_id' => $berkas->id, 
                    'pendaftar_id' => $berkas->pendaftar_id,
                    'action' => $action,
                    'verifikator' => Auth::user()->nama_lengkap
                ]
            );
        }

        if ($processed === 0) {
            return response()->json(['success' => false, 'message' => 'Tidak ada berkas yang diproses.']);
        }

        return response()->json([
            'success' => true, 
            'message' => "Berhasil memproses {$processed} berkas dengan status: " . strtoupper($action)
        ]);
    }

    public function submitVerifikasi(Request $request, $pendaftaranId)
    {
        $request->validate([
            'status' => 'required|in:ADM_PASS,ADM_REJECT',
            'catatan_admin' => 'nullable|string'
        ]);

        $pendaftaran = Pendaftaran::findOrFail($pendaftaranId);

        if ($pendaftaran->status !== 'SUBMIT') {
            return redirect()->back()->with('error', 'Pendaftaran tidak dalam status SUBMIT');
        }

        $pendaftaran->update([
            'status' => $request->status,
            'catatan_admin' => $request->catatan_admin,
            'user_verifikasi_adm' => Auth::user()->nama_lengkap,
            'tanggal_verifikasi' => now()
        ]);

        return redirect()->route('panitia.pendaftaran.show', $pendaftaranId)
            ->with('success', 'Verifikasi berhasil disimpan');
    }
}
