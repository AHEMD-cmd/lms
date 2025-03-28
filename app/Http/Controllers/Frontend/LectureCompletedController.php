<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Models\CourseSection;
use App\Models\LectureProgress;
use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\Lecture\LectureCompletedUpdateRequest;

class LectureCompletedController extends Controller
{
    public function __invoke(LectureCompletedUpdateRequest $request)
    {
        LectureProgress::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'lecture_id' => $request->lecture_id,
                'section_id' => $request->section_id,
                'course_id' => $request->course_id,
            ],
            [
                'is_completed' => $request->is_completed
            ]
        );

        $completedCount = CourseSection::find($request->section_id)
            ->completed_lectures
            ->count();

        return response()->json([
            'success' => true,
            'message' => 'Lecture status updated successfully',
            'completed_count' => $completedCount
        ]);
    }
}
