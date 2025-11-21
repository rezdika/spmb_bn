<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use App\Models\Jurusan;
use App\Models\Gelombang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PetaSebaranController extends Controller
{
    public function index(Request $request)
    {
        $jurusans = Jurusan::all();
        $gelombangs = Gelombang::all();

        // Statistik
        $totalPendaftar = Pendaftaran::whereHas('dataSiswa', function($q) {
            $q->whereNotNull('lat')->whereNotNull('lng');
        })->count();

        $sebaranPerJurusan = Pendaftaran::select('jurusan_id', DB::raw('count(*) as total'))
            ->whereHas('dataSiswa', function($q) {
                $q->whereNotNull('lat')->whereNotNull('lng');
            })
            ->with('jurusan')
            ->groupBy('jurusan_id')
            ->get();

        $sebaranPerProvinsi = Pendaftaran::select(DB::raw('count(*) as total'))
            ->whereHas('dataSiswa', function($q) {
                $q->whereNotNull('lat')->whereNotNull('lng');
            })
            ->with(['dataSiswa.village.district.regency.province'])
            ->get()
            ->groupBy(function($item) {
                return $item->dataSiswa->village->district->regency->province->name ?? 'Unknown';
            })
            ->map(function($items) {
                return $items->count();
            })
            ->sortDesc()
            ->take(5);

        return view('admin.pages.peta-sebaran.index', compact(
            'jurusans', 'gelombangs', 'totalPendaftar', 'sebaranPerJurusan', 'sebaranPerProvinsi'
        ));
    }

    public function getData(Request $request)
    {
        $query = Pendaftaran::with(['user', 'jurusan', 'gelombang', 'dataSiswa.village.district.regency.province'])
            ->whereHas('dataSiswa', function($q) {
                $q->whereNotNull('lat')->whereNotNull('lng');
            });

        if ($request->jurusan_id) {
            $query->where('jurusan_id', $request->jurusan_id);
        }

        if ($request->gelombang_id) {
            $query->where('gelombang_id', $request->gelombang_id);
        }

        if ($request->status) {
            $query->where('status', $request->status);
        }

        $pendaftarans = $query->get();

        $markers = $pendaftarans->map(function($item) {
            return [
                'id' => $item->id,
                'lat' => (float) $item->dataSiswa->lat,
                'lng' => (float) $item->dataSiswa->lng,
                'nama' => $item->user->nama_lengkap,
                'no_pendaftaran' => $item->no_pendaftaran,
                'jurusan' => $item->jurusan->nama,
                'jurusan_id' => $item->jurusan_id,
                'gelombang' => $item->gelombang->nama,
                'status' => $item->status,
                'alamat' => $item->dataSiswa->full_address ?? $item->dataSiswa->alamat,
            ];
        });

        return response()->json($markers);
    }
}
