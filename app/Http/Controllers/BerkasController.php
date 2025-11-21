<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PendaftarBerkas;
use App\Models\Pendaftaran;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class BerkasController extends Controller
{
    public function upload(Request $request)
    {
        try {
            $request->validate([
                'pendaftar_id' => 'required|exists:pendaftarans,id',
                'jenis' => 'required|in:IJAZAH,RAPOR,KIP,KKS,AKTA,KK',
                'file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048'
            ]);

            // Check ownership
            $pendaftaran = Pendaftaran::where('id', $request->pendaftar_id)
                ->where('user_id', Auth::id())
                ->first();
                
            if (!$pendaftaran) {
                return response()->json([
                    'success' => false,
                    'message' => 'Pendaftaran tidak ditemukan atau tidak memiliki akses.'
                ], 403);
            }

            // Check if berkas already exists
            $existingBerkas = PendaftarBerkas::where('pendaftar_id', $request->pendaftar_id)
                ->where('jenis', $request->jenis)
                ->first();

            if ($existingBerkas) {
                return response()->json([
                    'success' => false, 
                    'message' => 'Berkas jenis ini sudah ada. Silakan ganti berkas yang sudah ada.'
                ], 422);
            }

            $file = $request->file('file');
            $fileName = time() . '_' . $request->jenis . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('berkas', $fileName, 'public');
            
            $berkas = PendaftarBerkas::create([
                'pendaftar_id' => $request->pendaftar_id,
                'jenis' => $request->jenis,
                'nama_file' => $file->getClientOriginalName(),
                'url' => $path,
                'ukuran_kb' => round($file->getSize() / 1024),
                'status' => 'pending'
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Berkas berhasil diupload!',
                'berkas' => $berkas
            ]);
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal: ' . implode(', ', $e->validator->errors()->all())
            ], 422);
        } catch (\Exception $e) {
            \Log::error('Upload berkas error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat upload berkas. Silakan coba lagi.'
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $berkas = PendaftarBerkas::findOrFail($id);
        
        // Check ownership
        if ($berkas->pendaftar->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Tidak memiliki akses!');
        }
        
        // Delete old file
        if (Storage::disk('public')->exists($berkas->url)) {
            Storage::disk('public')->delete($berkas->url);
        }
        
        // Upload new file
        $file = $request->file('file');
        $fileName = time() . '_' . $berkas->jenis . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('berkas', $fileName, 'public');
        
        $berkas->update([
            'nama_file' => $file->getClientOriginalName(),
            'url' => $path,
            'ukuran_kb' => round($file->getSize() / 1024),
            'status' => 'pending',
            'catatan_panitia' => null,
            'verified_at' => null,
            'verified_by' => null
        ]);
        
        return redirect()->route('profile.upload-berkas')->with('success', 'Berkas berhasil diganti!');
    }

    public function delete($id)
    {
        $berkas = PendaftarBerkas::findOrFail($id);
        
        // Check ownership
        if ($berkas->pendaftar->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Tidak memiliki akses!');
        }
        
        // Delete file from storage
        if (Storage::disk('public')->exists($berkas->url)) {
            Storage::disk('public')->delete($berkas->url);
        }
        
        $berkas->delete();
        
        return redirect()->route('profile.upload-berkas')->with('success', 'Berkas berhasil dihapus!');
    }

    public function preview($id)
    {
        $berkas = PendaftarBerkas::findOrFail($id);
        
        // Check ownership
        if ($berkas->pendaftar->user_id !== Auth::id()) {
            abort(403);
        }
        
        $filePath = storage_path('app/public/' . $berkas->url);
        
        if (!file_exists($filePath)) {
            abort(404);
        }
        
        return response()->file($filePath);
    }
}