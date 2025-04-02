<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    public function lecture()
    {
        return $this->belongsTo(Lecture::class);
    }

    public function questions()
    {
        return $this->hasMany(QuizQuestion::class);
    }
    
    public function attempts()
    {
        return $this->hasMany(QuizAttempt::class);
    }

    
    public function getUserScoreAttribute()
    {
        if ($attempt = auth()->user()->attempts()->where('quiz_id', $this->id)->first()) {
            return $attempt->score;
        }
        return null;
    }
}
