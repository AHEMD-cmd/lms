<?php

namespace App\Http\Controllers\Instructor;

use App\Models\Quiz;
use App\Models\QuizQuestion;
use App\Http\Controllers\Controller;
use App\Services\Instructor\QuizQuestion\QuizQuestionService;
use App\Http\Requests\Instructor\QuizQuestion\StoreQuizQuestionRequest;

class QuizQuestionController extends Controller
{
    public $quizQuestionService;

    public function __construct(QuizQuestionService $quizQuestionService)
    {
        $this->quizQuestionService = $quizQuestionService;
    }
    public function index(Quiz $quiz)
    {
        $quiz->load('questions');
        return view('instructor.quiz-questions.index', compact('quiz'));
    }


    public function store(StoreQuizQuestionRequest $request, Quiz $quiz)
    {
        $result = $this->quizQuestionService->createQuestion($quiz, $request->validated());

        return response()->json([
            'quizQuestions' => view('instructor.quiz-questions.includes.questions-body', ['quiz' => $result])->render(),
            'success' => true,
            'message' => 'Question added successfully!',
        ]);
    }

    public function update(StoreQuizQuestionRequest $request, Quiz $quiz, $questionId)
    {
        $result = $this->quizQuestionService->updateQuestion($quiz, $questionId, $request->validated());

        return response()->json([
            'quizQuestions' => view('instructor.quiz-questions.includes.questions-body', ['quiz' => $result])->render(),
            'success' => true,
            'message' => 'Question updated successfully!',
        ]);
    }

    public function destroy(Quiz $quiz, QuizQuestion $question)
    {
        $question->delete();

        return response()->json([
            'quizQuestions' => view('instructor.quiz-questions.includes.questions-body', ['quiz' => $quiz->load('questions.options')])->render(),
            'success' => true,
            'message' => 'Question deleted successfully!',
        ]);
    }
}
