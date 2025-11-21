<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Pendaftaran;
use App\Models\PendaftarDataSiswa;
use App\Models\PendaftarDataOrtu;
use App\Models\PendaftarAsalSekolah;
use App\Models\PendaftarBerkas;
use App\Models\Province;
use App\Models\Regency;
use App\Models\District;
use App\Models\Village;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $pendaftaran = Pendaftaran::where('user_id', $user->id)->with(['dataSiswa', 'dataOrtu', 'asalSekolah', 'berkas'])->first();
        
        return view('user.pages.profile.index', compact('user', 'pendaftaran'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'no_hp' => 'required|string|max:15',
            'foto_profile' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user = Auth::user();
        $user->nama_lengkap = $request->nama_lengkap;
        $user->email = $request->email;
        $user->no_hp = $request->no_hp;

        if ($request->hasFile('foto_profile')) {
            if ($user->foto_profile && Storage::disk('public')->exists($user->foto_profile)) {
                Storage::disk('public')->delete($user->foto_profile);
            }
            $user->foto_profile = $request->file('foto_profile')->store('profile_photos', 'public');
        }

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('profile.index')->with('success', 'Profile berhasil diupdate!');
    }

    public function dataPribadi()
    {
        $user = auth()->user();
        
        // Check if registration is already submitted
        $pendaftaran = Pendaftaran::where('user_id', $user->id)->first();
        if ($pendaftaran && in_array($pendaftaran->status, ['SUBMIT', 'ADM_PASS', 'ADM_REJECT', 'PAID'])) {
            return redirect()->route('monitoring.index')
                ->with('info', 'Data tidak dapat diubah karena pendaftaran sudah disubmit.');
        }
        
        $pendaftaran = Pendaftaran::where('user_id', $user->id)->with(['dataSiswa.village.district.regency.province'])->first();
        $dataSiswa = $pendaftaran ? $pendaftaran->dataSiswa : null;
        $provinsiList = Province::orderBy('name')->get();
        $isProfileComplete = $this->checkProfileComplete($user);
        
        return view('user.pages.profile.data-pribadi', compact('user', 'dataSiswa', 'provinsiList', 'isProfileComplete'));
    }

    public function storeDataPribadi(Request $request)
    {
        // Check if registration is already submitted
        $existingPendaftaran = Pendaftaran::where('user_id', auth()->id())
            ->whereIn('status', ['SUBMIT', 'ADM_PASS', 'ADM_REJECT', 'PAID'])
            ->first();
            
        if ($existingPendaftaran) {
            return redirect()->route('monitoring.index')
                ->with('error', 'Data tidak dapat diubah karena pendaftaran sudah disubmit.');
        }
        
        $request->validate([
            'nik' => 'required|string|size:16',
            'nisn' => 'nullable|string|max:10',
            'nama_lengkap' => 'required|string|max:120',
            'email' => 'required|email|unique:users,email,' . auth()->id(),
            'no_hp' => 'required|string|max:15',
            'jk' => 'required|in:L,P',
            'tmp_lahir' => 'required|string|max:60',
            'tgl_lahir' => 'required|date',
            'alamat' => 'required|string',
            'village_id' => 'required|exists:villages,id'
        ]);

        $user = Auth::user();
        $user->update([
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
        ]);

        $pendaftaran = $this->getOrCreatePendaftaran($user->id);

        // Get coordinates from village with proper error handling
        $village = Village::with('district.regency.province')->find($request->village_id);
        $lat = 0;
        $lng = 0;
        
        if ($village) {
            $coordinates = $this->getCoordinates($village);
            $lat = $coordinates['lat'];
            $lng = $coordinates['lng'];
        }
        
        // Update or create data siswa
        PendaftarDataSiswa::updateOrCreate(
            ['pendaftar_id' => $pendaftaran->id],
            [
                'nik' => $request->nik,
                'nisn' => $request->nisn,
                'nama' => $request->nama_lengkap,
                'jk' => $request->jk,
                'tmp_lahir' => $request->tmp_lahir,
                'tgl_lahir' => $request->tgl_lahir,
                'alamat' => $request->alamat,
                'village_id' => $request->village_id,
                'lat' => $lat,
                'lng' => $lng
            ]
        );

        return redirect()->route('profile.data-pribadi')->with('success', 'Data pribadi berhasil disimpan!');
    }

    public function dataOrangtua()
    {
        $user = auth()->user();
        
        // Check if registration is already submitted
        $pendaftaran = Pendaftaran::where('user_id', $user->id)->first();
        if ($pendaftaran && in_array($pendaftaran->status, ['SUBMIT', 'ADM_PASS', 'ADM_REJECT', 'PAID'])) {
            return redirect()->route('monitoring.index')
                ->with('info', 'Data tidak dapat diubah karena pendaftaran sudah disubmit.');
        }
        
        $pendaftaran = Pendaftaran::where('user_id', $user->id)->with('dataOrtu')->first();
        $dataOrtu = $pendaftaran ? $pendaftaran->dataOrtu : null;
        $isProfileComplete = $this->checkProfileComplete($user);
        
        return view('user.pages.profile.data-orangtua', compact('user', 'dataOrtu', 'isProfileComplete'));
    }

    public function storeDataOrangtua(Request $request)
    {
        // Check if registration is already submitted
        $existingPendaftaran = Pendaftaran::where('user_id', auth()->id())
            ->whereIn('status', ['SUBMIT', 'ADM_PASS', 'ADM_REJECT', 'PAID'])
            ->first();
            
        if ($existingPendaftaran) {
            return redirect()->route('monitoring.index')
                ->with('error', 'Data tidak dapat diubah karena pendaftaran sudah disubmit.');
        }
        
        $request->validate([
            'nama_ayah' => 'required|string|max:120',
            'pekerjaan_ayah' => 'required|string|max:100',
            'no_ayah' => 'required|string|max:20',
            'nama_ibu' => 'required|string|max:120',
            'pekerjaan_ibu' => 'required|string|max:100',
            'no_ibu' => 'required|string|max:20',
            'wali_nama' => 'nullable|string|max:120',
            'wali_hp' => 'nullable|string|max:20',
        ]);

        $user = Auth::user();
        $pendaftaran = $this->getOrCreatePendaftaran($user->id);

        // Update or create data ortu
        PendaftarDataOrtu::updateOrCreate(
            ['pendaftar_id' => $pendaftaran->id],
            [
                'nama_ayah' => $request->nama_ayah,
                'pekerjaan_ayah' => $request->pekerjaan_ayah,
                'no_ayah' => $request->no_ayah,
                'nama_ibu' => $request->nama_ibu,
                'pekerjaan_ibu' => $request->pekerjaan_ibu,
                'no_ibu' => $request->no_ibu,
                'wali_nama' => $request->wali_nama,
                'wali_hp' => $request->wali_hp,
            ]
        );

        return redirect()->route('profile.data-orangtua')->with('success', 'Data orang tua berhasil disimpan!');
    }

    public function asalSekolah()
    {
        $user = auth()->user();
        
        // Check if registration is already submitted
        $pendaftaran = Pendaftaran::where('user_id', $user->id)->first();
        if ($pendaftaran && in_array($pendaftaran->status, ['SUBMIT', 'ADM_PASS', 'ADM_REJECT', 'PAID'])) {
            return redirect()->route('monitoring.index')
                ->with('info', 'Data tidak dapat diubah karena pendaftaran sudah disubmit.');
        }
        
        $pendaftaran = Pendaftaran::where('user_id', $user->id)->with('asalSekolah')->first();
        $asalSekolah = $pendaftaran ? $pendaftaran->asalSekolah : null;
        $isProfileComplete = $this->checkProfileComplete($user);
        
        return view('user.pages.profile.asal-sekolah', compact('user', 'asalSekolah', 'isProfileComplete'));
    }

    public function storeAsalSekolah(Request $request)
    {
        // Check if registration is already submitted
        $existingPendaftaran = Pendaftaran::where('user_id', auth()->id())
            ->whereIn('status', ['SUBMIT', 'ADM_PASS', 'ADM_REJECT', 'PAID'])
            ->first();
            
        if ($existingPendaftaran) {
            return redirect()->route('monitoring.index')
                ->with('error', 'Data tidak dapat diubah karena pendaftaran sudah disubmit.');
        }
        
        $request->validate([
            'npsn' => 'nullable|string|max:20',
            'nama_sekolah' => 'required|string|max:150',
            'kabupaten' => 'required|string|max:100',
            'nilai_rata' => 'required|numeric|min:0|max:100',
        ]);

        $user = Auth::user();
        $pendaftaran = $this->getOrCreatePendaftaran($user->id);

        // Update or create asal sekolah
        PendaftarAsalSekolah::updateOrCreate(
            ['pendaftar_id' => $pendaftaran->id],
            [
                'npsn' => $request->npsn,
                'nama_sekolah' => $request->nama_sekolah,
                'kabupaten' => $request->kabupaten,
                'nilai_rata' => $request->nilai_rata,
            ]
        );

        return redirect()->route('profile.asal-sekolah')->with('success', 'Data asal sekolah berhasil disimpan!');
    }

    public function uploadBerkas()
    {
        $user = auth()->user();
        
        // Check if registration is already submitted - allow editing if there are berkas that need revision
        $pendaftaran = Pendaftaran::where('user_id', $user->id)->first();
        if ($pendaftaran && in_array($pendaftaran->status, ['ADM_PASS', 'ADM_REJECT', 'PAID'])) {
            return redirect()->route('monitoring.index')
                ->with('info', 'Berkas tidak dapat diubah karena pendaftaran sudah diproses final.');
        }
        
        // Allow editing if status is SUBMIT but there are berkas that need revision
        $hasRevisionNeeded = false;
        if ($pendaftaran && $pendaftaran->status === 'SUBMIT') {
            $hasRevisionNeeded = PendaftarBerkas::where('pendaftar_id', $pendaftaran->id)
                ->where('status', 'revision')
                ->exists();
        }
        
        $pendaftaran = Pendaftaran::where('user_id', $user->id)->with('berkas')->first();
        
        // Create pendaftaran if not exists
        if (!$pendaftaran) {
            $pendaftaran = $this->getOrCreatePendaftaran($user->id);
        }
        
        $berkasUser = $pendaftaran ? $pendaftaran->berkas : collect();
        $isProfileComplete = $this->checkProfileComplete($user);
        
        return view('user.pages.profile.upload-berkas', compact('user', 'pendaftaran', 'berkasUser', 'isProfileComplete'));
    }

    public function storeUploadBerkas(Request $request)
    {
        // Check if registration is already submitted - allow editing if there are berkas that need revision
        $existingPendaftaran = Pendaftaran::where('user_id', auth()->id())
            ->whereIn('status', ['ADM_PASS', 'ADM_REJECT', 'PAID'])
            ->first();
            
        if ($existingPendaftaran) {
            return redirect()->route('monitoring.index')
                ->with('error', 'Berkas tidak dapat diubah karena pendaftaran sudah diproses final.');
        }
        
        $user = Auth::user();
        $pendaftaran = $this->getOrCreatePendaftaran($user->id);

        // New flow: accept an array of documents (staged multi-upload)
        if ($request->hasFile('documents')) {
            $request->validate([
                'documents' => 'required|array',
                'documents.*' => 'file|mimes:pdf,jpg,jpeg,png|max:5120', // 5MB
            ]);

            $files = $request->file('documents');
            foreach ($files as $key => $file) {
                if (!$file) continue;

                // If a berkas with same jenis exists for this pendaftaran, replace it
                $existing = PendaftarBerkas::where('pendaftar_id', $pendaftaran->id)
                            ->where('jenis', $key)->first();

                $fileName = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('berkas', $fileName, 'public');

                if ($existing) {
                    // delete old file
                    if (Storage::disk('public')->exists($existing->url)) {
                        Storage::disk('public')->delete($existing->url);
                    }

                    // Reset status verifikasi ketika berkas diganti
                    $existing->update([
                        'nama_file' => $file->getClientOriginalName(),
                        'url' => $path,
                        'ukuran_kb' => round($file->getSize() / 1024),
                        'status' => 'pending',
                        'catatan_panitia' => null,
                        'verified_at' => null,
                        'verified_by' => null
                    ]);
                } else {
                    PendaftarBerkas::create([
                        'pendaftar_id' => $pendaftaran->id,
                        'jenis' => $key,
                        'nama_file' => $file->getClientOriginalName(),
                        'url' => $path,
                        'ukuran_kb' => round($file->getSize() / 1024),
                        'status' => 'pending'
                    ]);
                }
            }

            return redirect()->route('profile.upload-berkas')->with('success', 'Semua berkas berhasil diupload!');
        }

        // Fallback: support legacy single-file upload
        $request->validate([
            'jenis' => 'required|in:IJAZAH,RAPOR,KIP,KKS,AKTA,KK,LAINNYA',
            'file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('berkas', $fileName, 'public');

        // replace if exists
        $existing = PendaftarBerkas::where('pendaftar_id', $pendaftaran->id)
                    ->where('jenis', $request->jenis)->first();

        if ($existing) {
            if (Storage::disk('public')->exists($existing->url)) {
                Storage::disk('public')->delete($existing->url);
            }

            $existing->update([
                'nama_file' => $file->getClientOriginalName(),
                'url' => $path,
                'ukuran_kb' => round($file->getSize() / 1024),
                'status' => 'pending',
                'catatan_panitia' => null,
                'verified_at' => null,
                'verified_by' => null
            ]);
        } else {
            PendaftarBerkas::create([
                'pendaftar_id' => $pendaftaran->id,
                'jenis' => $request->jenis,
                'nama_file' => $file->getClientOriginalName(),
                'url' => $path,
                'ukuran_kb' => round($file->getSize() / 1024),
                'status' => 'pending'
            ]);
        }

        return redirect()->route('profile.upload-berkas')->with('success', 'Berkas berhasil diupload!');
    }
    
    public function getRegencies($provinceId)
    {
        $regencies = Regency::where('province_id', $provinceId)->orderBy('name')->get();
        return response()->json($regencies);
    }
    
    public function getDistricts($regencyId)
    {
        $districts = District::where('regency_id', $regencyId)->orderBy('name')->get();
        return response()->json($districts);
    }
    
    public function getVillages($districtId)
    {
        $villages = Village::where('district_id', $districtId)->orderBy('name')->get();
        return response()->json($villages);
    }
    
    private function checkProfileComplete($user)
    {
        $pendaftaran = Pendaftaran::where('user_id', $user->id)
            ->where('status', 'DRAFT')
            ->with(['dataSiswa', 'dataOrtu', 'asalSekolah', 'berkas'])
            ->first();
        
        if (!$pendaftaran) {
            return false;
        }
        
        // Check data siswa
        $dataSiswa = $pendaftaran->dataSiswa;
        if (!$dataSiswa || empty($dataSiswa->nik) || empty($dataSiswa->jk) || empty($dataSiswa->tmp_lahir) || empty($dataSiswa->alamat)) {
            return false;
        }
        
        // Check data ortu
        $dataOrtu = $pendaftaran->dataOrtu;
        if (!$dataOrtu || empty($dataOrtu->nama_ayah) || empty($dataOrtu->pekerjaan_ayah) || empty($dataOrtu->nama_ibu) || empty($dataOrtu->pekerjaan_ibu)) {
            return false;
        }
        
        // Check asal sekolah
        $asalSekolah = $pendaftaran->asalSekolah;
        if (!$asalSekolah || empty($asalSekolah->nama_sekolah) || empty($asalSekolah->kabupaten) || $asalSekolah->nilai_rata <= 0) {
            return false;
        }
        
        // Check minimal berkas wajib (minimal 3 berkas)
        $berkasCount = $pendaftaran->berkas->count();
        if ($berkasCount < 3) {
            return false;
        }
        
        return true;
    }
    
    private function getOrCreatePendaftaran($userId)
    {
        return Pendaftaran::firstOrCreate(
            ['user_id' => $userId],
            [
                'no_pendaftaran' => 'DRAFT-' . time(),
                'jurusan_id' => 1,
                'gelombang_id' => 1,
                'status' => 'DRAFT',
                'status_pembayaran' => 'belum_bayar',
                'jumlah_pembayaran' => 0,
                'tanggal_daftar' => now()
            ]
        );
    }
    
    private function getBerkasNotifications($userId)
    {
        $pendaftaran = Pendaftaran::where('user_id', $userId)->first();
        if (!$pendaftaran) {
            return ['count' => 0, 'berkas' => collect()];
        }
        
        $berkasPerluPerbaikan = PendaftarBerkas::where('pendaftar_id', $pendaftaran->id)
            ->whereIn('status', ['revision', 'rejected'])
            ->get();
            
        return [
            'count' => $berkasPerluPerbaikan->count(),
            'berkas' => $berkasPerluPerbaikan
        ];
    }
    
    private function getCoordinates($village)
    {
        $defaultCoords = ['lat' => 0, 'lng' => 0];
        
        try {
            $address = $village->name . ', ' . $village->district->name . ', ' . 
                      $village->district->regency->name . ', ' . 
                      $village->district->regency->province->name . ', Indonesia';
            
            $url = 'https://nominatim.openstreetmap.org/search?q=' . urlencode($address) . '&format=json&limit=1';
            
            $context = stream_context_create([
                'http' => [
                    'timeout' => 5,
                    'user_agent' => 'SPMB Application/1.0'
                ]
            ]);
            
            $response = @file_get_contents($url, false, $context);
            
            if ($response === false) {
                return $defaultCoords;
            }
            
            $data = json_decode($response, true);
            
            if (!empty($data) && isset($data[0]['lat'], $data[0]['lon'])) {
                return [
                    'lat' => (float) $data[0]['lat'],
                    'lng' => (float) $data[0]['lon']
                ];
            }
            
        } catch (\Exception $e) {
            \Log::warning('Geocoding failed: ' . $e->getMessage());
        }
        
        return $defaultCoords;
    }

    public function updateBerkas(Request $request, $id)
    {
        try {
            $berkas = PendaftarBerkas::whereHas('pendaftar', function($query) {
                $query->where('user_id', auth()->id());
            })->findOrFail($id);
            
            if (in_array($berkas->pendaftar->status, ['ADM_PASS', 'ADM_REJECT', 'PAID'])) {
                return redirect()->back()->with('error', 'Berkas tidak dapat diubah karena pendaftaran sudah diproses final.');
            }
            
            $request->validate([
                'file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            ]);
            
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('berkas', $fileName, 'public');
            
            if (Storage::disk('public')->exists($berkas->url)) {
                Storage::disk('public')->delete($berkas->url);
            }
            
            // Reset status verifikasi ketika berkas diganti
            $berkas->update([
                'nama_file' => $file->getClientOriginalName(),
                'url' => $path,
                'ukuran_kb' => round($file->getSize() / 1024),
                'status' => 'pending',
                'catatan_panitia' => null,
                'verified_at' => null,
                'verified_by' => null
            ]);
            
            // Log activity untuk audit trail
            \App\Models\LogAktivitas::log(
                'UPDATE_BERKAS_REVISION', 
                'PendaftarBerkas', 
                [
                    'berkas_id' => $berkas->id,
                    'pendaftar_id' => $berkas->pendaftar_id,
                    'jenis' => $berkas->jenis,
                    'user' => auth()->user()->nama_lengkap
                ]
            );
            
            return redirect()->route('profile.upload-berkas')->with('success', 'Berkas berhasil diganti!');
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengganti berkas.');
        }
    }

    public function deleteBerkas($id)
    {
        try {
            $berkas = PendaftarBerkas::whereHas('pendaftar', function($query) {
                $query->where('user_id', auth()->id());
            })->findOrFail($id);
            
            if (in_array($berkas->pendaftar->status, ['ADM_PASS', 'ADM_REJECT', 'PAID'])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Berkas tidak dapat dihapus karena pendaftaran sudah diproses final.'
                ]);
            }
            
            if (Storage::disk('public')->exists($berkas->url)) {
                Storage::disk('public')->delete($berkas->url);
            }
            
            $berkas->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Berkas berhasil dihapus'
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus berkas'
            ]);
        }
    }
}
