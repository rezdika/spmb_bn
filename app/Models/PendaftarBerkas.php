<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PendaftarBerkas extends Model
{
    protected $table = 'pendaftar_berkas';

    protected $fillable = [
        'pendaftar_id', 'jenis', 'nama_file', 'url', 'ukuran_kb', 'status', 'catatan', 'catatan_panitia', 'verified_at', 'verified_by'
    ];

    protected $casts = [
        'verified_at' => 'datetime'
    ];

    public function pendaftar()
    {
        return $this->belongsTo(Pendaftaran::class, 'pendaftar_id');
    }

    public function verifiedBy()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            'pending' => '<span class="badge bg-warning">Menunggu</span>',
            'approved' => '<span class="badge bg-success">Disetujui</span>',
            'rejected' => '<span class="badge bg-danger">Ditolak</span>',
            'revision' => '<span class="badge bg-info">Perlu Perbaikan</span>',
            default => '<span class="badge bg-secondary">Unknown</span>'
        };
    }
}