<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionOption extends Model
{
    use HasFactory;

    public function question()
    {
        return $this->belongsTo(QuizQuestion::class);
    }

    public function answers()
    {
        return $this->hasMany(QuizAnswer::class);
    }
}
