<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prestasi;

class HomeController extends Controller
{
    public function index()
    {
        $prestasi = Prestasi::where('is_active', true)
            ->orderBy('achievement_date', 'desc')
            ->limit(6)
            ->get();

        return view('user.pages.home', compact('prestasi'));
    }

    public function panduan()
    {
        return view('user.pages.panduan');
    }
}