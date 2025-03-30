<?php

namespace App\Services\Instructor\QuizQuestion;

use App\Models\Quiz;
use Illuminate\Support\Facades\DB;

class QuizQuestionService
{
    public function createQuestion(Quiz $quiz, array $data)
    {
        DB::beginTransaction();

        try {
            $question = $this->createQuizQuestion($quiz, $data);
            $this->createQuestionOptions($question, $data);

            DB::commit();

            return $quiz->load('questions.options');
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    private function createQuizQuestion(Quiz $quiz, array $data)
    {
        return $quiz->questions()->create([
            'question_text' => $data['question'],
            'is_multiple' => $data['is_multiple'] ?? false,
        ]);
    }

    public function updateQuestion(Quiz $quiz, $questionId, array $data)
    {
        DB::beginTransaction();

        try {
            $question = $quiz->questions()->findOrFail($questionId);
            $question->update([
                'question_text' => $data['question'],
                'is_multiple' => $data['is_multiple'] ?? false,
            ]);

            // Delete old options and insert new ones
            $question->options()->delete();
            $this->createQuestionOptions($question, $data);

            DB::commit();

            return $quiz->load('questions.options');
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }


    private function createQuestionOptions($question, array $data)
    {
        foreach ($data['options'] as $index => $optionText) {
            $question->options()->create([
                'option_text' => $optionText,
                'is_correct' => isset($data['is_correct'][$index]) ? 1 : 0,
            ]);
        }
    }
}
