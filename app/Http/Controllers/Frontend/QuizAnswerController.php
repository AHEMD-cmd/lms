<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Quiz;
use App\Models\QuizAnswer;
use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\QuizAnswer\StoreQuizAnswerRequest;

class QuizAnswerController extends Controller
{
    public function store(StoreQuizAnswerRequest $request)
    {
        foreach ($request->option_ids as $optionId) {
            QuizAnswer::updateOrCreate(
                ['attempt_id' => $request->attempt_id, 'question_id' => $request->question_id],
                ['option_id' => $optionId]
            );
        }

        return response()->json([
            'message' => 'Answers submitted successfully',
        ]);
    }
}
