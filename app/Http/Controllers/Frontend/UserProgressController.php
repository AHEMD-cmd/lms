<?php

namespace App\Http\Controllers\Frontend;


use App\Models\LastWatchedLecture;
use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\Lecture\UserProgressRequest;

class UserProgressController extends Controller
{
    public function store(UserProgressRequest $request)
    {
        LastWatchedLecture::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'course_id' => $request->course_id
            ],
            [
                'lecture_id' => $request->lecture_id,
                'progress_in_seconds' => $request->progress
            ]
        );

        return response()->json(['status' => 'success']);
    }
}
