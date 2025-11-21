<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Village;
use Illuminate\Http\Request;

class VillageController extends Controller
{
    public function index()
    {
        $villages = Village::with('district.regency.province')->paginate(20);
        return view('admin.pages.wilayah.villages.index', compact('villages'));
    }

    public function create()
    {
        $districts = District::with('regency.province')->get();
        return view('admin.pages.wilayah.villages.create', compact('districts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id' => 'required|string|max:10|unique:villages',
            'district_id' => 'required|exists:districts,id',
            'name' => 'required|string|max:100'
        ]);

        Village::create($request->all());
        return redirect()->route('admin.villages.index')->with('success', 'Kelurahan/Desa berhasil ditambahkan');
    }

    public function edit(Village $village)
    {
        $districts = District::with('regency.province')->get();
        return view('admin.pages.wilayah.villages.edit', compact('village', 'districts'));
    }

    public function update(Request $request, Village $village)
    {
        $request->validate([
            'district_id' => 'required|exists:districts,id',
            'name' => 'required|string|max:100'
        ]);

        $village->update($request->all());
        return redirect()->route('admin.villages.index')->with('success', 'Kelurahan/Desa berhasil diupdate');
    }

    public function destroy(Village $village)
    {
        $village->delete();
        return redirect()->route('admin.villages.index')->with('success', 'Kelurahan/Desa berhasil dihapus');
    }
}