<?php

namespace App\Http\Controllers\KepalaSekolah;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SebaranWilayahController extends Controller
{
    public function index(Request $request)
    {
        $query = Pendaftaran::with(['user', 'dataSiswa.village.district.regency.province'])
            ->where('status', 'ADM_PASS')
            ->whereHas('dataSiswa');

        if ($request->jurusan_id) {
            $query->where('jurusan_id', $request->jurusan_id);
        }

        $sebaran = $query->get();
        $jurusans = Jurusan::all();

        $sebaranProvinsi = $sebaran->filter(function($item) {
            return $item->dataSiswa && $item->dataSiswa->village && $item->dataSiswa->village->district && $item->dataSiswa->village->district->regency && $item->dataSiswa->village->district->regency->province;
        })->groupBy(function($item) {
            return $item->dataSiswa->village->district->regency->province->name;
        })->map(function($items) {
            return $items->count();
        })->sortDesc();

        $sebaranKabupaten = $sebaran->filter(function($item) {
            return $item->dataSiswa && $item->dataSiswa->village && $item->dataSiswa->village->district && $item->dataSiswa->village->district->regency;
        })->groupBy(function($item) {
            return $item->dataSiswa->village->district->regency->name;
        })->map(function($items) {
            return $items->count();
        })->sortDesc()->take(10);

        // Statistik
        $totalProvinsi = $sebaranProvinsi->count();
        $totalKabupaten = $sebaran->filter(function($item) {
            return $item->dataSiswa && $item->dataSiswa->village && $item->dataSiswa->village->district && $item->dataSiswa->village->district->regency;
        })->groupBy(function($item) {
            return $item->dataSiswa->village->district->regency->name;
        })->count();
        $totalSiswa = $sebaran->count();
        $wilayahTerbanyak = $sebaranKabupaten->first();

        // Data pendaftar untuk peta
        $pendaftarData = $sebaran->map(function($item) {
            if ($item->dataSiswa && $item->dataSiswa->village && $item->dataSiswa->village->district && $item->dataSiswa->village->district->regency) {
                return [
                    'nama' => $item->user->nama_lengkap,
                    'kabupaten' => $item->dataSiswa->village->district->regency->name,
                    'provinsi' => $item->dataSiswa->village->district->regency->province->name ?? '-',
                    'lat' => $item->dataSiswa->lat ?? null,
                    'lng' => $item->dataSiswa->lng ?? null,
                    'jurusan' => $item->jurusan->nama ?? '-'
                ];
            }
            return null;
        })->filter();

        return view('kepala-sekolah.pages.siswa-diterima.sebaran-wilayah', compact('sebaran', 'jurusans', 'sebaranProvinsi', 'sebaranKabupaten', 'totalProvinsi', 'totalKabupaten', 'totalSiswa', 'wilayahTerbanyak', 'pendaftarData'));
    }
}
