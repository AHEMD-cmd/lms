<?php

namespace App\Http\Controllers\Instructor;

use App\Models\Course;
use App\Models\Lecture;
use Illuminate\Http\Request;
use App\Models\CourseSection;
use App\Http\Controllers\Controller;

class LecturePublishedController extends Controller
{
    public function __invoke(Course $course, CourseSection $section, Lecture $lecture)
    {
        $lecture->update(['is_published' => !$lecture->is_active]);

        return response([
            'status' => 'success',
            'message' => 'Lecture updated successfully'
        ], 200);
    }
}
