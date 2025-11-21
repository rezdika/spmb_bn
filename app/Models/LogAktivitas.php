<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogAktivitas extends Model
{
    protected $table = 'log_aktivitas';

    protected $fillable = [
        'user_id', 'aksi', 'objek', 'objek_data', 'waktu', 'ip'
    ];

    protected $casts = [
        'objek_data' => 'array',
        'waktu' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function log($aksi, $objek, $objekData = null, $userId = null)
    {
        return self::create([
            'user_id' => $userId ?? auth()->id(),
            'aksi' => $aksi,
            'objek' => $objek,
            'objek_data' => $objekData ?? '{}',
            'waktu' => now(),
            'ip' => request()->ip()
        ]);
    }
}