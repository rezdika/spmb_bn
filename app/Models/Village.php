<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Village extends Model
{
    protected $table = 'villages';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;
    
    protected $fillable = ['id', 'district_id', 'name'];
    
    public function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }
    
    public function pendaftarDataSiswa()
    {
        return $this->hasMany(PendaftarDataSiswa::class, 'village_id');
    }
}