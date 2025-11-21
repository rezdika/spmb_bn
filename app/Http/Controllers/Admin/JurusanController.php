<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    public function index()
    {
        $jurusans = Jurusan::paginate(10);
        return view('admin.pages.jurusan.index', compact('jurusans'));
    }

    public function create()
    {
        return view('admin.pages.jurusan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_jurusan' => 'required|string|max:255|unique:jurusans,nama',
            'kode_jurusan' => 'required|string|max:10|unique:jurusans,kode',
            'deskripsi' => 'nullable|string',
            'kuota' => 'required|integer|min:1',
            'is_active' => 'boolean'
        ], [
            'nama_jurusan.unique' => 'Nama jurusan sudah ada, silakan gunakan nama lain.',
            'kode_jurusan.unique' => 'Kode jurusan sudah ada, silakan gunakan kode lain.',
            'nama_jurusan.required' => 'Nama jurusan wajib diisi.',
            'kode_jurusan.required' => 'Kode jurusan wajib diisi.',
            'kuota.min' => 'Kuota minimal 1 siswa.'
        ]);

        Jurusan::create([
            'nama' => $request->nama_jurusan,
            'kode' => $request->kode_jurusan,
            'deskripsi' => $request->deskripsi,
            'kuota' => $request->kuota,
            'is_active' => $request->has('is_active') ? 1 : 0
        ]);
        
        return redirect()->route('admin.jurusan.index')->with('success', 'Jurusan berhasil ditambahkan');
    }

    public function show(Jurusan $jurusan)
    {
        return view('admin.pages.jurusan.show', compact('jurusan'));
    }

    public function edit(Jurusan $jurusan)
    {
        return view('admin.pages.jurusan.edit', compact('jurusan'));
    }

    public function update(Request $request, Jurusan $jurusan)
    {
        $request->validate([
            'nama_jurusan' => 'required|string|max:255|unique:jurusans,nama,' . $jurusan->id,
            'kode_jurusan' => 'required|string|max:10|unique:jurusans,kode,' . $jurusan->id,
            'deskripsi' => 'nullable|string',
            'kuota' => 'required|integer|min:1',
            'is_active' => 'boolean'
        ], [
            'nama_jurusan.unique' => 'Nama jurusan sudah ada, silakan gunakan nama lain.',
            'kode_jurusan.unique' => 'Kode jurusan sudah ada, silakan gunakan kode lain.',
            'nama_jurusan.required' => 'Nama jurusan wajib diisi.',
            'kode_jurusan.required' => 'Kode jurusan wajib diisi.',
            'kuota.min' => 'Kuota minimal 1 siswa.'
        ]);

        $jurusan->update([
            'nama' => $request->nama_jurusan,
            'kode' => $request->kode_jurusan,
            'deskripsi' => $request->deskripsi,
            'kuota' => $request->kuota,
            'is_active' => $request->has('is_active') ? 1 : 0
        ]);
        
        return redirect()->route('admin.jurusan.index')->with('success', 'Jurusan berhasil diupdate');
    }

    public function destroy(Jurusan $jurusan)
    {
        $jurusan->delete();
        return redirect()->route('admin.jurusan.index')->with('success', 'Jurusan berhasil dihapus');
    }
}