<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LectureFile extends Model
{
    use HasFactory;
    
    public function lecture()
    {
        return $this->belongsTo(Lecture::class);
    }

    protected $appends = ['full_path'];

    public function getFilePathAttribute()
    {
        return public_path('lectrues/' . $this->file);
    }
}
