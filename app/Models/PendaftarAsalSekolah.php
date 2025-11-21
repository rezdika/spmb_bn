<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PendaftarAsalSekolah extends Model
{
    protected $table = 'pendaftar_asal_sekolah';
    protected $primaryKey = 'pendaftar_id';
    public $incrementing = false;

    protected $fillable = [
        'pendaftar_id', 'npsn', 'nama_sekolah', 'kabupaten', 'nilai_rata'
    ];

    protected $casts = [
        'nilai_rata' => 'decimal:2'
    ];

    public function pendaftar()
    {
        return $this->belongsTo(Pendaftaran::class, 'pendaftar_id');
    }
}