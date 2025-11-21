<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kontak extends Model
{
    protected $table = 'kontaks';
    
    protected $fillable = [
        'nama',
        'email', 
        'hp',
        'subjek',
        'pesan',
        'status',
        'ip_address'
    ];
    
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];
    
    // Scope untuk filter berdasarkan status
    public function scopeBaru($query)
    {
        return $query->where('status', 'baru');
    }
    
    public function scopeDibaca($query)
    {
        return $query->where('status', 'dibaca');
    }
    
    public function scopeDibalas($query)
    {
        return $query->where('status', 'dibalas');
    }
    
    // Accessor untuk format tanggal
    public function getFormattedDateAttribute()
    {
        return $this->created_at->format('d M Y, H:i');
    }
}
