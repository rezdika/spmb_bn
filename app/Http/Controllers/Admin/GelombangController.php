<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gelombang;
use Illuminate\Http\Request;

class GelombangController extends Controller
{
    public function index()
    {
        $gelombangs = Gelombang::paginate(10);
        return view('admin.pages.gelombang.index', compact('gelombangs'));
    }

    public function create()
    {
        return view('admin.pages.gelombang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_gelombang' => 'required|string|max:255',
            'tahun' => 'required|integer|min:2000|max:2100',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
            'biaya_pendaftaran' => 'required|numeric|min:0',
            'status' => 'required|in:aktif,nonaktif'
        ], [
            'nama_gelombang.required' => 'Nama gelombang wajib diisi.',
            'tahun.required' => 'Tahun wajib diisi.',
            'tanggal_mulai.required' => 'Tanggal mulai wajib diisi.',
            'tanggal_selesai.required' => 'Tanggal selesai wajib diisi.',
            'tanggal_selesai.after' => 'Tanggal selesai harus setelah tanggal mulai.',
            'biaya_pendaftaran.required' => 'Biaya pendaftaran wajib diisi.',
            'biaya_pendaftaran.min' => 'Biaya pendaftaran tidak boleh negatif.'
        ]);

        // Check for duplicate nama + tahun combination
        $exists = Gelombang::where('nama', $request->nama_gelombang)
                          ->where('tahun', $request->tahun)
                          ->exists();
        
        if ($exists) {
            return back()->withErrors([
                'nama_gelombang' => 'Gelombang dengan nama "' . $request->nama_gelombang . '" pada tahun ' . $request->tahun . ' sudah ada.'
            ])->withInput();
        }

        Gelombang::create([
            'nama' => $request->nama_gelombang,
            'tahun' => $request->tahun,
            'tgl_mulai' => $request->tanggal_mulai,
            'tgl_selesai' => $request->tanggal_selesai,
            'biaya_daftar' => $request->biaya_pendaftaran,
            'status' => $request->status
        ]);
        
        return redirect()->route('admin.gelombang.index')->with('success', 'Gelombang berhasil ditambahkan');
    }

    public function show(Gelombang $gelombang)
    {
        return view('admin.pages.gelombang.show', compact('gelombang'));
    }

    public function edit(Gelombang $gelombang)
    {
        return view('admin.pages.gelombang.edit', compact('gelombang'));
    }

    public function update(Request $request, Gelombang $gelombang)
    {
        $request->validate([
            'nama_gelombang' => 'required|string|max:255',
            'tahun' => 'required|integer|min:2000|max:2100',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
            'biaya_pendaftaran' => 'required|numeric|min:0',
            'status' => 'required|in:aktif,nonaktif'
        ], [
            'nama_gelombang.required' => 'Nama gelombang wajib diisi.',
            'tahun.required' => 'Tahun wajib diisi.',
            'tanggal_mulai.required' => 'Tanggal mulai wajib diisi.',
            'tanggal_selesai.required' => 'Tanggal selesai wajib diisi.',
            'tanggal_selesai.after' => 'Tanggal selesai harus setelah tanggal mulai.',
            'biaya_pendaftaran.required' => 'Biaya pendaftaran wajib diisi.',
            'biaya_pendaftaran.min' => 'Biaya pendaftaran tidak boleh negatif.'
        ]);

        // Check for duplicate nama + tahun combination (exclude current record)
        $exists = Gelombang::where('nama', $request->nama_gelombang)
                          ->where('tahun', $request->tahun)
                          ->where('id', '!=', $gelombang->id)
                          ->exists();
        
        if ($exists) {
            return back()->withErrors([
                'nama_gelombang' => 'Gelombang dengan nama "' . $request->nama_gelombang . '" pada tahun ' . $request->tahun . ' sudah ada.'
            ])->withInput();
        }

        $gelombang->update([
            'nama' => $request->nama_gelombang,
            'tahun' => $request->tahun,
            'tgl_mulai' => $request->tanggal_mulai,
            'tgl_selesai' => $request->tanggal_selesai,
            'biaya_daftar' => $request->biaya_pendaftaran,
            'status' => $request->status
        ]);
        
        return redirect()->route('admin.gelombang.index')->with('success', 'Gelombang berhasil diupdate');
    }

    public function destroy(Gelombang $gelombang)
    {
        $gelombang->delete();
        return redirect()->route('admin.gelombang.index')->with('success', 'Gelombang berhasil dihapus');
    }
}