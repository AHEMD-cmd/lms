<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Quiz;
use App\Models\QuizAttempt;
use App\Models\QuizQuestion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AttemptPreviousQuestionController extends Controller
{
     /**
     * Fetch the next attempt question if available.
     *
     * @param Quiz $quiz The quiz instance containing the question.
     * @param QuizQuestion $question The current quiz question.
     * @return \Illuminate\Http\JsonResponse JSON response containing the rendered question view or a message indicating no more questions.
     */
    public function show(Quiz $quiz, QuizAttempt $attempt, QuizQuestion $previous_question)
    {
        $quiz->load('lecture.course');
        $course = $quiz->lecture->course;
        $previousQuestion = $quiz->questions()->where('id', '<' , $previous_question->id)->orderBy('id', 'desc')->first();
        if (!$previousQuestion) {
            return response()->json(['message' => 'No more questions'], 404);
        }

        return response()->json([
            'question' => view('frontend.attempts.includes._quiz-answers', [
                'course' => $course,
                'question' => $previousQuestion->load('options'),
                'quiz' => $quiz,
                'attempt' => $attempt
            ])->render()
        ]);
    }
}
