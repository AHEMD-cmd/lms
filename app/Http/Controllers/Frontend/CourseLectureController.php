<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CourseLectureController extends Controller
{
    public function __construct()
    {
        $this->middleware('reset.questions')->only('index');
    }
    public function index(Course $course)
    {
        $course->load('sections', 'questions');
        $questions = $course->questions()->topLevel()->latest()->limit(session('questionsCount'))->get();

        return view('frontend.course-lectures.index', compact('course', 'questions'));
    }
}
