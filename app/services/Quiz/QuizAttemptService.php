<?php

namespace App\Services\Quiz;

use App\Models\QuizAnswer;
use App\Models\QuizAttempt;
use App\Models\QuestionOption;
use Illuminate\Support\Facades\Auth;

class QuizAttemptService
{
    public function startAttempt($courseId, $quizId)
    {
        return QuizAttempt::updateOrCreate(
            ['user_id' => Auth::id(), 'course_id' => $courseId, 'quiz_id' => $quizId],
            ['started_at' => now()]
        );
    }

    public function updateAttempt(QuizAttempt $attempt)
    {
        $questions = $attempt->quiz->questions; // Get all questions in the quiz
        $score = 0;

        foreach ($questions as $question) {
            $correctOptionIds = $question->options()->where('is_correct', true)->pluck('id')->toArray();
            $userOptionIds = QuizAnswer::where('attempt_id', $attempt->id)
                ->where('question_id', $question->id)
                ->pluck('option_id')
                ->toArray();

            // If user selects any incorrect option, mark the whole question as wrong
            $incorrectOptionSelected = QuestionOption::whereIn('id', $userOptionIds)
                ->where('is_correct', false)
                ->exists();

            if (!$incorrectOptionSelected && !array_diff($correctOptionIds, $userOptionIds)) {
                // Only award points if the user selected all correct options and no incorrect ones
                $score++;
            }
        }

        return $score;
    }
}
