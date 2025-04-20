<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Quiz;
use App\Models\Course;
use App\Models\QuizAttempt;
use App\Http\Controllers\Controller;
use App\Services\Quiz\QuizAttemptService;

class QuizAttemptController extends Controller
{

    protected $quizAttemptService;

    public function __construct(QuizAttemptService $quizAttemptService)
    {
        $this->quizAttemptService = $quizAttemptService;
    }

    public function index(Course $course, Quiz $quiz)
    {
        return view('frontend.attempts.index', [
            'course' => $course->load('sections'),
            'quiz' => $quiz,
            'attempts' => $course->attempts()->where('user_id', auth()->id())->get()
        ]);
    }

    public function update(Course $course, Quiz $quiz, QuizAttempt $attempt)
    {
        $score = $this->quizAttemptService->updateAttempt($attempt);

        $attempt->update([
            'score' => $score,
            'ended_at' => now(),
        ]);
        
        $attempt->save();

        return response()->json([
            'score' => $score,
            'redirect' => route('courses.quizzes.attempts.show', [$course, $quiz, $attempt])
        ]);
    }

    public function show(Course $course, Quiz $quiz, QuizAttempt $attempt)
    {
        $firstQuestion = $quiz->questions()->first();
        return view('frontend.attempts.show', [
            'quiz' => $quiz,
            'course' => $course,
            'attempt' => $attempt,
            'question' => $firstQuestion->load('options'),
        ]);
    }
}
