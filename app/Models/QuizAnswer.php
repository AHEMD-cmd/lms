<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Records the selected answers of a user during a quiz attempt
 */

class QuizAnswer extends Model
{
    use HasFactory;

    public function attempt()
    {
        return $this->belongsTo(QuizAttempt::class);
    }

    public function question()
    {
        return $this->belongsTo(QuizQuestion::class);
    }

    public function option()
    {
        return $this->belongsTo(QuestionOption::class);
    }
}
