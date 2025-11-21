<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MonitoringController extends Controller
{
    public function index()
    {
        $pendaftaran = Pendaftaran::with(['jurusan', 'gelombang', 'berkas'])
            ->where('user_id', Auth::id())
            ->first();
            
        $berkasNotifications = collect();
        if ($pendaftaran) {
            $berkasNotifications = \App\Models\PendaftarBerkas::where('pendaftar_id', $pendaftaran->id)
                ->whereIn('status', ['revision', 'rejected'])
                ->get();
        }

        return view('user.pages.monitoring.index', compact('pendaftaran', 'berkasNotifications'));
    }

    public function uploadBuktiPembayaran(Request $request)
    {
        \Log::info('Upload bukti pembayaran started', ['user_id' => Auth::id()]);
        
        try {
            $request->validate([
                'bukti_pembayaran' => 'required|file|mimes:jpeg,png,jpg,pdf|max:5120', // 5MB
                'catatan' => 'nullable|string|max:500'
            ]);
            \Log::info('Validation passed');
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Validation failed', ['errors' => $e->validator->errors()->all()]);
            return redirect()->back()->with('error', 'Validasi gagal: ' . implode(', ', $e->validator->errors()->all()));
        }

        try {
            $pendaftaran = Pendaftaran::where('user_id', Auth::id())->first();
            \Log::info('Pendaftaran found', ['pendaftaran_id' => $pendaftaran?->id, 'status' => $pendaftaran?->status]);
            
            if (!$pendaftaran || $pendaftaran->status !== 'ADM_PASS') {
                \Log::warning('User not eligible for payment upload', ['pendaftaran' => $pendaftaran]);
                return redirect()->back()->with('error', 'Anda belum diterima atau belum terdaftar.');
            }

            if ($request->hasFile('bukti_pembayaran')) {
                \Log::info('File detected', ['original_name' => $request->file('bukti_pembayaran')->getClientOriginalName()]);
                
                // Delete old file if exists
                if ($pendaftaran->bukti_pembayaran) {
                    Storage::disk('public')->delete('bukti_pembayaran/' . $pendaftaran->bukti_pembayaran);
                    \Log::info('Old file deleted', ['old_file' => $pendaftaran->bukti_pembayaran]);
                }
                
                $file = $request->file('bukti_pembayaran');
                $filename = 'bukti_' . Auth::id() . '_' . time() . '.' . $file->getClientOriginalExtension();
                \Log::info('Generated filename', ['filename' => $filename]);
                
                // Store file and get the path
                $path = $file->storeAs('bukti_pembayaran', $filename, 'public');
                \Log::info('File storage result', ['path' => $path, 'success' => !empty($path)]);
                
                if (!$path) {
                    \Log::error('File storage failed');
                    return redirect()->back()->with('error', 'Gagal menyimpan file. Silakan coba lagi.');
                }
                
                $pendaftaran->update([
                    'bukti_pembayaran' => $filename,
                    'status_pembayaran' => 'menunggu_verifikasi',
                    'catatan_pembayaran' => $request->catatan
                ]);
                \Log::info('Database updated successfully', ['filename' => $filename]);
                
                return redirect()->back()->with('success', 'Bukti pembayaran berhasil diupload! Panitia akan memverifikasi dalam 1x24 jam.');
            } else {
                \Log::warning('No file in request');
                return redirect()->back()->with('error', 'File tidak ditemukan. Silakan pilih file terlebih dahulu.');
            }
        } catch (\Exception $e) {
            \Log::error('Upload failed with exception', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function cetakKartu($id)
    {
        $pendaftaran = Pendaftaran::with(['user', 'jurusan', 'gelombang', 'dataSiswa', 'dataOrtu', 'asalSekolah'])
            ->where('user_id', Auth::id())
            ->where('status_pembayaran', 'lunas')
            ->findOrFail($id);

        return view('user.pages.monitoring.cetak-kartu', compact('pendaftaran'));
    }

    public function cetakBuktiBayar($id)
    {
        $pendaftaran = Pendaftaran::with(['user', 'jurusan', 'gelombang'])
            ->where('user_id', Auth::id())
            ->where('status_pembayaran', 'lunas')
            ->findOrFail($id);

        return view('user.pages.monitoring.cetak-bukti-bayar', compact('pendaftaran'));
    }
}