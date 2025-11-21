<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    public function index()
    {
        $gurus = Guru::paginate(10);
        $totalGuru = Guru::count();
        return view('admin.pages.guru.index', compact('gurus', 'totalGuru'));
    }

    public function create()
    {
        return view('admin.pages.guru.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_guru' => 'required|string|max:120',
            'mata_pelajaran' => 'required|string|max:150'
        ]);

        Guru::create($request->all());
        return redirect()->route('admin.guru.index')->with('success', 'Data guru berhasil ditambahkan');
    }

    public function edit(Guru $guru)
    {
        return view('admin.pages.guru.edit', compact('guru'));
    }

    public function update(Request $request, Guru $guru)
    {
        $request->validate([
            'nama_guru' => 'required|string|max:120',
            'mata_pelajaran' => 'required|string|max:150'
        ]);

        $guru->update($request->all());
        return redirect()->route('admin.guru.index')->with('success', 'Data guru berhasil diupdate');
    }

    public function destroy(Guru $guru)
    {
        $guru->delete();
        return redirect()->route('admin.guru.index')->with('success', 'Data guru berhasil dihapus');
    }
}
