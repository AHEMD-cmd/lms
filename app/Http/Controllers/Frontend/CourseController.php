<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CourseController extends Controller
{
    public function __construct()
    {
        $this->middleware('reset.reviews')->only('show');
    }

    public function show(Course $course)
    {
        $course->load('category', 'instructor.courses', 'courseGoals', 'sections', 'reviews');
        $reviews = $course->reviews()->active()->latest()->limit(session('reviewsCount'))->get();

        $relatedCourses = Course::where('id', '!=', $course->id)
            ->where('category_id', $course->category_id)
            ->with('instructor')
            ->limit(3)
            ->get();

        return view('frontend.courses.show', compact('course', 'relatedCourses', 'reviews'));
    }
}
