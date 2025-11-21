<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Province;
use App\Models\Regency;
use Illuminate\Http\Request;

class RegencyController extends Controller
{
    public function index()
    {
        $regencies = Regency::with('province')->paginate(10);
        return view('admin.pages.wilayah.regencies.index', compact('regencies'));
    }

    public function create()
    {
        $provinces = Province::all();
        return view('admin.pages.wilayah.regencies.create', compact('provinces'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id' => 'required|string|max:4|unique:regencies',
            'province_id' => 'required|exists:provinces,id',
            'name' => 'required|string|max:100'
        ]);

        Regency::create($request->all());
        return redirect()->route('admin.regencies.index')->with('success', 'Kabupaten/Kota berhasil ditambahkan');
    }

    public function edit(Regency $regency)
    {
        $provinces = Province::all();
        return view('admin.pages.wilayah.regencies.edit', compact('regency', 'provinces'));
    }

    public function update(Request $request, Regency $regency)
    {
        $request->validate([
            'province_id' => 'required|exists:provinces,id',
            'name' => 'required|string|max:100'
        ]);

        $regency->update($request->all());
        return redirect()->route('admin.regencies.index')->with('success', 'Kabupaten/Kota berhasil diupdate');
    }

    public function destroy(Regency $regency)
    {
        $regency->delete();
        return redirect()->route('admin.regencies.index')->with('success', 'Kabupaten/Kota berhasil dihapus');
    }
}