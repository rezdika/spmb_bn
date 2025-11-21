<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Jurusan;
use App\Models\Gelombang;
use App\Models\Pendaftaran;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users' => User::count(),
            'total_jurusan' => Jurusan::count(),
            'total_gelombang' => Gelombang::count(),
            'total_pendaftaran' => Pendaftaran::count(),
        ];

        return view('admin.pages.dashboard', compact('stats'));
    }
}