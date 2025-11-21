<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LogAktivitas;

class LogController extends Controller
{
    public function index(Request $request)
    {
        $logs = LogAktivitas::with('user')
            ->when($request->user_id, function($query, $userId) {
                return $query->where('user_id', $userId);
            })
            ->when($request->aksi, function($query, $aksi) {
                return $query->where('aksi', 'like', "%{$aksi}%");
            })
            ->orderBy('waktu', 'desc')
            ->paginate(50);

        return view('admin.log.index', compact('logs'));
    }

    public function show($id)
    {
        $log = LogAktivitas::with('user')->findOrFail($id);
        return response()->json($log);
    }
}