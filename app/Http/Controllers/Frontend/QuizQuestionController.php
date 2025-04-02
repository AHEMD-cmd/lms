<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\QuizQuestion;

class QuizQuestionController extends Controller
{
    /**
     * Fetch the next question if available.
     *
     * @param Quiz $quiz The quiz instance containing the question.
     * @param QuizQuestion $question The current quiz question.
     * @return \Illuminate\Http\JsonResponse JSON response containing the rendered question view or a message indicating no more questions.
     */
    public function show(Quiz $quiz, QuizQuestion $question)
    {
        $quiz->load('lecture.course');
        $course = $quiz->lecture->course;
        $nextQuestion = $quiz->questions()->where('id', '>', $question->id)->orderBy('id')->first();
        if (!$nextQuestion) {
            return response()->json(['message' => 'No more questions'], 404);
        }

        return response()->json([
            'question' => view('frontend.quizzes.includes._question-answers', [
                'course' => $course,
                'question' => $nextQuestion->load('options'),
                'quiz' => $quiz
            ])->render()
        ]);
    }
}
