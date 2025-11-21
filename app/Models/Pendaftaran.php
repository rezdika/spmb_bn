<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $table = 'pendaftarans';
    
    protected $fillable = [
        'user_id',
        'jurusan_id', 
        'gelombang_id',
        'no_pendaftaran',
        'status',
        'status_pembayaran',
        'jumlah_pembayaran',
        'catatan_admin',
        'catatan_pembayaran',
        'tanggal_verifikasi',
        'bukti_pembayaran',
        'tanggal_daftar',
        'user_verifikasi_adm',
        'tgl_verifikasi_adm',
        'user_verifikasi_payment',
        'tgl_verifikasi_payment',
    ];

    protected $casts = [
        'tanggal_daftar' => 'datetime',
        'tanggal_verifikasi' => 'datetime',
        'tgl_verifikasi_adm' => 'datetime',
        'tgl_verifikasi_payment' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }

    public function gelombang()
    {
        return $this->belongsTo(Gelombang::class);
    }

    public function dataSiswa()
    {
        return $this->hasOne(PendaftarDataSiswa::class, 'pendaftar_id');
    }

    public function dataOrtu()
    {
        return $this->hasOne(PendaftarDataOrtu::class, 'pendaftar_id');
    }

    public function asalSekolah()
    {
        return $this->hasOne(PendaftarAsalSekolah::class, 'pendaftar_id');
    }

    public function berkas()
    {
        return $this->hasMany(PendaftarBerkas::class, 'pendaftar_id');
    }
}