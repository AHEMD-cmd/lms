<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Question;
use App\Http\Controllers\Controller;

class QuestionUpvoteController extends Controller
{
    public function store(Question $question)
    {
         // Attach or detach the upvote
        $question->upvotedUsers()->toggle(auth()->id());

        return response()->json([
            'message' => 'Upvoted successfully',
            'upvotes' => $question->upvoteCount()
        ], 201);
    }
}
