<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Quiz;
use App\Models\Course;
use App\Models\Lecture;
use App\Http\Controllers\Controller;
use App\Services\Quiz\QuizAttemptService;

class QuizController extends Controller
{

    protected $quizAttemptService;

    public function __construct(QuizAttemptService $quizAttemptService)
    {
        $this->quizAttemptService = $quizAttemptService;
    }

    public function show(Course $course, Lecture $lecture, Quiz $quiz)
    {
        $attempt = $this->quizAttemptService->startAttempt($course->id, $quiz->id);

        $course->load('instructor');
        $quiz->load('questions');
        $firstQuestion = $quiz->questions()->first();
        return view('frontend.quizzes.show', [
            'course' => $course,
            'attempt' => $attempt,
            'lecture' => $lecture,
            'quiz' => $quiz,
            'question' => $firstQuestion->load('options'),
        ]);
    }
}
