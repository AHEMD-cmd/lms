<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{
    use HasFactory;

    protected $casts = [
        'files' => 'array',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

}
