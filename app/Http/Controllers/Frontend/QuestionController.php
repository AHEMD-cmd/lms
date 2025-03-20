<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\Question\StoreQuestionRequest;
use App\Models\Course;
use App\Models\Question;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('increment.questions')->only('index');
    }
    public function index(Request $request)
    {
        $questions = Question::topLevel();

        if ($request->filled('search')) {
            $questions->where(function ($query) use ($request) {
                $query->where('subject', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('question', 'LIKE', '%' . $request->search . '%');
            });
        }

        if ($request->filled('course_id')) {
            $questions->where('course_id', $request->course_id);
        }

        if ($request->filled('lecture_id')) {
            $questions->where('lecture_id', $request->lecture_id);
        }

        if ($request->boolean('only_my_questions')) {
            $questions->where('user_id', auth()->id());
        }

        if ($request->boolean('no_responses')) {
            $questions->whereDoesntHave('replies');
        }

        $questions = $questions->latest()->take(session('questionsCount'))->get();

        return view('frontend.course-lectures.includes._questions', compact('questions'))->render();
    }

    public function store(StoreQuestionRequest $request)
    {
        auth()->user()->questions()->create($request->validated());

        return response([
            'message' => 'question created successfully',
            'questionsNumber' => Question::where('course_id', $request->course_id)->count()
        ], 201);
    }

    public function show(Question $question)
    {
        $question->load('replies.user');
        
        return view('frontend.course-lectures.includes._question-with-replies', compact('question'))->render();
    }
}
