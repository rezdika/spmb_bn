<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PendaftarDataSiswa extends Model
{
    protected $table = 'pendaftar_data_siswa';
    protected $primaryKey = 'pendaftar_id';
    public $incrementing = false;

    protected $fillable = [
        'pendaftar_id', 'nik', 'nisn', 'nama', 'jk', 'tmp_lahir', 
        'tgl_lahir', 'alamat', 'village_id', 'lat', 'lng'
    ];

    protected $casts = [
        'tgl_lahir' => 'date',
        'lat' => 'decimal:7',
        'lng' => 'decimal:7'
    ];

    public function pendaftar()
    {
        return $this->belongsTo(Pendaftaran::class, 'pendaftar_id');
    }
    
    public function village()
    {
        return $this->belongsTo(Village::class, 'village_id');
    }
    
    public function district()
    {
        return $this->hasOneThrough(District::class, Village::class, 'id', 'id', 'village_id', 'district_id');
    }
    
    public function regency()
    {
        return $this->hasOneThrough(
            Regency::class,
            Village::class,
            'id',
            'id',
            'village_id',
            'district_id'
        )->join('districts', 'villages.district_id', '=', 'districts.id')
         ->select('regencies.*');
    }
    
    public function province()
    {
        return $this->village ? $this->village->district->regency->province : null;
    }
    
    // Helper untuk mendapatkan alamat lengkap
    public function getFullAddressAttribute()
    {
        if (!$this->village) return $this->alamat;
        
        return $this->alamat . ', ' . 
               $this->village->name . ', ' . 
               $this->village->district->name . ', ' . 
               $this->village->district->regency->name . ', ' . 
               $this->village->district->regency->province->name;
    }
}