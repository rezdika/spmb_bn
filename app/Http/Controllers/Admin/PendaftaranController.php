<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;

class PendaftaranController extends Controller
{
    public function show($id)
    {
        $pendaftaran = Pendaftaran::with(['user', 'jurusan', 'gelombang', 'berkas', 'dataSiswa', 'dataOrtu', 'asalSekolah'])->findOrFail($id);
        
        return view('admin.pages.pendaftaran.show', compact('pendaftaran'));
    }
}
