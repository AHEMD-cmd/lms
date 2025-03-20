<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\Reply\StoreReplyRequest;
use App\Models\Question;

class ReplyController extends Controller
{
    public function store(StoreReplyRequest $request)
    {
        auth()->user()->questions()->create($request->validated());

        $question = Question::with('replies.user')->findOrFail($request->question_id);

        return view('frontend.course-lectures.includes._question-with-replies', compact('question'))->render();
    }
}
