<?php

namespace App\Http\Controllers\Instructor;

use App\Models\Quiz;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuizPublishedController extends Controller
{
    public function __invoke(Course $course, Quiz $quiz)
    {
        $quiz->update(['is_published' => !$quiz->is_published]);

        return response([
            'status' => 'success',
            'message' => 'Quiz updated successfully'
        ], 200);
    }
}
