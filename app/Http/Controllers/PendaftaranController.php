<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jurusan;
use App\Models\Gelombang;
use App\Models\Pendaftaran;
use App\Models\PendaftarDataSiswa;
use App\Models\PendaftarDataOrtu;
use App\Models\PendaftarAsalSekolah;
use App\Models\LogAktivitas;

class PendaftaranController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        
        // Check if user already has submitted registration
        $existingPendaftaran = Pendaftaran::where('user_id', $user->id)
            ->whereIn('status', ['SUBMIT', 'ADM_PASS', 'ADM_REJECT', 'PAID'])
            ->first();
            
        if ($existingPendaftaran) {
            return redirect()->route('monitoring.index')
                ->with('info', 'Anda sudah melakukan pendaftaran. Silakan cek status pendaftaran Anda.');
        }
        
        // Check if profile is complete
        $profileComplete = $this->checkProfileComplete($user);
        $missingFields = $this->getMissingFields($user);
        
        $jurusans = Jurusan::all();
        $gelombangs = Gelombang::where('status', 'aktif')->get();
        
        // Auto-fill jurusan if coming from jurusan page
        $selectedJurusan = $request->get('jurusan');
        
        return view('user.pages.pendaftaran.index', compact('jurusans', 'gelombangs', 'selectedJurusan', 'user', 'profileComplete', 'missingFields'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'jurusan_id' => 'required|exists:jurusans,id',
            'gelombang_id' => 'required|exists:gelombangs,id',
        ]);
        
        // Check if user already has submitted registration
        $existingPendaftaran = Pendaftaran::where('user_id', auth()->id())
            ->whereIn('status', ['SUBMIT', 'ADM_PASS', 'ADM_REJECT', 'PAID'])
            ->first();
        
        if ($existingPendaftaran) {
            return redirect()->route('monitoring.index')
                ->with('error', 'Anda sudah melakukan pendaftaran sebelumnya.');
        }
        
        // Update existing DRAFT or create new
        $pendaftaran = Pendaftaran::where('user_id', auth()->id())->first();
        
        $gelombang = Gelombang::findOrFail($request->gelombang_id);
        
        if ($pendaftaran && $pendaftaran->status == 'DRAFT') {
            // Update existing draft
            $noPendaftaran = 'PPDB' . date('Y') . str_pad(Pendaftaran::where('status', '!=', 'DRAFT')->count() + 1, 3, '0', STR_PAD_LEFT);
            $pendaftaran->update([
                'jurusan_id' => $request->jurusan_id,
                'gelombang_id' => $request->gelombang_id,
                'no_pendaftaran' => $noPendaftaran,
                'status' => 'SUBMIT',
                'jumlah_pembayaran' => $gelombang->biaya_daftar,
                'tanggal_daftar' => now(),
            ]);
        } else {
            // Create new
            $noPendaftaran = 'PPDB' . date('Y') . str_pad(Pendaftaran::where('status', '!=', 'DRAFT')->count() + 1, 3, '0', STR_PAD_LEFT);
            $pendaftaran = Pendaftaran::create([
                'user_id' => auth()->id(),
                'jurusan_id' => $request->jurusan_id,
                'gelombang_id' => $request->gelombang_id,
                'no_pendaftaran' => $noPendaftaran,
                'status' => 'SUBMIT',
                'jumlah_pembayaran' => $gelombang->biaya_daftar,
                'tanggal_daftar' => now(),
            ]);
        }
        
        // Data sudah ada dari profile, tidak perlu create ulang jika sudah ada
        if (!$pendaftaran->dataSiswa) {
            PendaftarDataSiswa::create([
                'pendaftar_id' => $pendaftaran->id,
                'nik' => '',
                'nisn' => '',
                'nama' => auth()->user()->nama_lengkap,
                'jk' => 'L',
                'tmp_lahir' => '',
                'tgl_lahir' => now()->subYears(17),
                'alamat' => '',
            ]);
        }
        
        if (!$pendaftaran->dataOrtu) {
            PendaftarDataOrtu::create([
                'pendaftar_id' => $pendaftaran->id,
                'nama_ayah' => '',
                'pekerjaan_ayah' => '',
                'hp_ayah' => '',
                'nama_ibu' => '',
                'pekerjaan_ibu' => '',
                'hp_ibu' => '',
                'wali_nama' => '',
                'wali_hp' => '',
            ]);
        }
        
        if (!$pendaftaran->asalSekolah) {
            PendaftarAsalSekolah::create([
                'pendaftar_id' => $pendaftaran->id,
                'npsn' => '',
                'nama_sekolah' => '',
                'kabupaten' => '',
                'nilai_rata' => 0,
            ]);
        }
        
        // Log aktivitas
        LogAktivitas::log('SUBMIT_PENDAFTARAN', 'Pendaftaran', [
            'no_pendaftaran' => $noPendaftaran,
            'jurusan_id' => $request->jurusan_id,
            'gelombang_id' => $request->gelombang_id
        ]);
        
        return redirect()->route('pendaftaran.success')->with('success', 'Pendaftaran berhasil disubmit!');
    }
    
    public function success()
    {
        return view('user.pages.pendaftaran.success');
    }
    
    private function checkProfileComplete($user)
    {
        // Cek apakah ada pendaftaran DRAFT untuk user ini
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
    
    private function getMissingFields($user)
    {
        $missing = [];
        $pendaftaran = Pendaftaran::where('user_id', $user->id)
            ->where('status', 'DRAFT')
            ->with(['dataSiswa', 'dataOrtu', 'asalSekolah', 'berkas'])
            ->first();
        
        if (!$pendaftaran) {
            return ['Data Pribadi', 'Data Orang Tua', 'Asal Sekolah', 'Upload Berkas'];
        }
        
        // Check data siswa
        $dataSiswa = $pendaftaran->dataSiswa;
        if (!$dataSiswa || empty($dataSiswa->nik) || empty($dataSiswa->jk) || empty($dataSiswa->tmp_lahir) || empty($dataSiswa->alamat)) {
            $missing[] = 'Data Pribadi (NIK, Jenis Kelamin, Tempat/Tanggal Lahir, Alamat)';
        }
        
        // Check data ortu
        $dataOrtu = $pendaftaran->dataOrtu;
        if (!$dataOrtu || empty($dataOrtu->nama_ayah) || empty($dataOrtu->pekerjaan_ayah) || empty($dataOrtu->nama_ibu) || empty($dataOrtu->pekerjaan_ibu)) {
            $missing[] = 'Data Orang Tua (Nama & Pekerjaan Ayah/Ibu)';
        }
        
        // Check asal sekolah
        $asalSekolah = $pendaftaran->asalSekolah;
        if (!$asalSekolah || empty($asalSekolah->nama_sekolah) || empty($asalSekolah->kabupaten) || $asalSekolah->nilai_rata <= 0) {
            $missing[] = 'Asal Sekolah (Nama Sekolah, Kabupaten, Nilai Rata-rata)';
        }
        
        // Check berkas
        $berkasCount = $pendaftaran->berkas->count();
        if ($berkasCount < 3) {
            $missing[] = 'Upload Berkas (Minimal 3 berkas wajib: Ijazah, Rapor, KK/Akta)';
        }
        
        return $missing;
    }
}