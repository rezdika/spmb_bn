<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Regency;
use App\Models\District;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    public function index()
    {
        $districts = District::with('regency.province')->paginate(10);
        return view('admin.pages.wilayah.districts.index', compact('districts'));
    }

    public function create()
    {
        $regencies = Regency::with('province')->get();
        return view('admin.pages.wilayah.districts.create', compact('regencies'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id' => 'required|string|max:7|unique:districts',
            'regency_id' => 'required|exists:regencies,id',
            'name' => 'required|string|max:100'
        ]);

        District::create($request->all());
        return redirect()->route('admin.districts.index')->with('success', 'Kecamatan berhasil ditambahkan');
    }

    public function edit(District $district)
    {
        $regencies = Regency::with('province')->get();
        return view('admin.pages.wilayah.districts.edit', compact('district', 'regencies'));
    }

    public function update(Request $request, District $district)
    {
        $request->validate([
            'regency_id' => 'required|exists:regencies,id',
            'name' => 'required|string|max:100'
        ]);

        $district->update($request->all());
        return redirect()->route('admin.districts.index')->with('success', 'Kecamatan berhasil diupdate');
    }

    public function destroy(District $district)
    {
        $district->delete();
        return redirect()->route('admin.districts.index')->with('success', 'Kecamatan berhasil dihapus');
    }
}