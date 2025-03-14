<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    
    public function scopeBySessionId($query)
    {
        return $query->where('session_id', session()->getId());
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    
}
