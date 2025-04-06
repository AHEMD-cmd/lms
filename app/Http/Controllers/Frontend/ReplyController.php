<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Question;
use App\Mail\QuestionReplied;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\Frontend\Reply\StoreReplyRequest;

class ReplyController extends Controller
{
    public function store(StoreReplyRequest $request)
    {
        $question = Question::with('user')->findOrFail($request->question_id);

        auth()->user()->questions()->create($request->validated());

        $questionOwner = $question->user;
        $replier = auth()->user();

        if ($questionOwner->id !== $replier->id) {
            Mail::to($questionOwner->email)->queue(new QuestionReplied($questionOwner, $replier, $question));
        }
        return view('frontend.course-lectures.includes._question-with-replies', compact('question'))->render();
    }
}
