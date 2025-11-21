<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Prestasi;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PrestasiController extends Controller
{
    public function index()
    {
        $prestasis = Prestasi::latest()->paginate(10);
        $totalPrestasi = Prestasi::count();
        $prestasiAktif = Prestasi::where('is_active', 1)->count();
        return view('admin.pages.prestasi.index', compact('prestasis', 'totalPrestasi', 'prestasiAktif'));
    }

    public function create()
    {
        return view('admin.pages.prestasi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'student_name' => 'required|string|max:255',
            'class' => 'required|string|max:50',
            'achievement_date' => 'required|date',
            'organizer' => 'required|string|max:255',
            'level' => 'required|in:Sekolah,Kecamatan,Kabupaten,Provinsi,Nasional,Internasional',
            'description' => 'required|string',
            'full_description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'is_active' => 'required|boolean'
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('prestasi', 'public');
        }

        Prestasi::create($data);
        return redirect()->route('admin.prestasi.index')->with('success', 'Prestasi berhasil ditambahkan');
    }

    public function show(Prestasi $prestasi)
    {
        return view('admin.pages.prestasi.show', compact('prestasi'));
    }

    public function edit(Prestasi $prestasi)
    {
        return view('admin.pages.prestasi.edit', compact('prestasi'));
    }

    public function update(Request $request, Prestasi $prestasi)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'student_name' => 'required|string|max:255',
            'class' => 'required|string|max:50',
            'achievement_date' => 'required|date',
            'organizer' => 'required|string|max:255',
            'level' => 'required|in:Sekolah,Kecamatan,Kabupaten,Provinsi,Nasional,Internasional',
            'description' => 'required|string',
            'full_description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'is_active' => 'required|boolean'
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title);

        if ($request->hasFile('image')) {
            if ($prestasi->image) {
                \Storage::disk('public')->delete($prestasi->image);
            }
            $data['image'] = $request->file('image')->store('prestasi', 'public');
        }

        $prestasi->update($data);
        return redirect()->route('admin.prestasi.index')->with('success', 'Prestasi berhasil diupdate');
    }

    public function destroy(Prestasi $prestasi)
    {
        if ($prestasi->image) {
            \Storage::disk('public')->delete($prestasi->image);
        }
        $prestasi->delete();
        return redirect()->route('admin.prestasi.index')->with('success', 'Prestasi berhasil dihapus');
    }
}
