<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Prestasi extends Model
{
    protected $table = 'prestasi';

    protected $fillable = [
        'title',
        'slug',
        'category',
        'student_name',
        'class',
        'achievement_date',
        'organizer',
        'level',
        'description',
        'full_description',
        'image',
        'is_active'
    ];

    protected $casts = [
        'achievement_date' => 'date',
        'is_active' => 'boolean'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($prestasi) {
            if (empty($prestasi->slug)) {
                $prestasi->slug = Str::slug($prestasi->title);
            }
        });
    }

    public function getFormattedDateAttribute()
    {
        return $this->achievement_date ? $this->achievement_date->format('d F Y') : '-';
    }

}
