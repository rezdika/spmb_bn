<?php

namespace App\Http\Controllers;

use App\Models\Guru;

class TenagaPendidikController extends Controller
{
    public function index()
    {
        $guru = Guru::paginate(15);
        return view('user.pages.profile_sekolah.tenaga-pendidikan', compact('guru'));
    }
}
