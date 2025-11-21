<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Province;
use Illuminate\Http\Request;

class ProvinceController extends Controller
{
    public function index()
    {
        $provinces = Province::paginate(10);
        return view('admin.pages.wilayah.provinces.index', compact('provinces'));
    }

    public function create()
    {
        return view('admin.pages.wilayah.provinces.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id' => 'required|string|max:2|unique:provinces',
            'name' => 'required|string|max:100'
        ]);

        Province::create($request->all());
        return redirect()->route('admin.provinces.index')->with('success', 'Provinsi berhasil ditambahkan');
    }

    public function edit(Province $province)
    {
        return view('admin.pages.wilayah.provinces.edit', compact('province'));
    }

    public function update(Request $request, Province $province)
    {
        $request->validate([
            'name' => 'required|string|max:100'
        ]);

        $province->update($request->all());
        return redirect()->route('admin.provinces.index')->with('success', 'Provinsi berhasil diupdate');
    }

    public function destroy(Province $province)
    {
        $province->delete();
        return redirect()->route('admin.provinces.index')->with('success', 'Provinsi berhasil dihapus');
    }
}