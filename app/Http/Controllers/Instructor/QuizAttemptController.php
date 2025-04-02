<?php

namespace App\Http\Controllers\Instructor;

use App\Models\Quiz;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuizAttemptController extends Controller
{
    public function index(Quiz $quiz)
    {
        $quiz->load('attempts');
        return view('instructor.quiz-attempts.index', compact('quiz'));
    }
}
