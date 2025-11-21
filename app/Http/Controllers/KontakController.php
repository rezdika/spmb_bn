<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kontak;
use Illuminate\Support\Facades\RateLimiter;

class KontakController extends Controller
{
    public function index()
    {
        return view('user.pages.kontak');
    }

    public function store(Request $request)
    {
        // Rate limiting - max 3 pesan per IP per jam
        $key = 'kontak:' . $request->ip();
        if (RateLimiter::tooManyAttempts($key, 3)) {
            $seconds = RateLimiter::availableIn($key);
            return back()->withErrors([
                'error' => 'Terlalu banyak pesan. Coba lagi dalam ' . ceil($seconds / 60) . ' menit.'
            ]);
        }
        
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'hp' => 'nullable|string|max:20',
            'subjek' => 'required|string|max:255',
            'pesan' => 'required|string|max:2000',
        ], [
            'nama.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'subjek.required' => 'Subjek pesan wajib dipilih.',
            'pesan.required' => 'Pesan wajib diisi.',
            'pesan.max' => 'Pesan maksimal 2000 karakter.'
        ]);
        
        try {
            // Simpan pesan kontak
            Kontak::create([
                'nama' => $request->nama,
                'email' => $request->email,
                'hp' => $request->hp,
                'subjek' => $request->subjek,
                'pesan' => $request->pesan,
                'status' => 'baru',
                'ip_address' => $request->ip()
            ]);
            
            // Hit rate limiter
            RateLimiter::hit($key, 3600); // 1 jam
            
            return redirect()->back()->with('success', 'Pesan berhasil dikirim! Kami akan merespon dalam 24 jam.');
            
        } catch (\Exception $e) {
            \Log::error('Kontak form error: ' . $e->getMessage());
            return back()->withErrors([
                'error' => 'Terjadi kesalahan sistem. Silakan coba lagi.'
            ])->withInput();
        }
    }
}