<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Filters\Frontend\CourseFilter;
use App\Services\Course\CourseService;

class CourseController extends Controller
{
    protected $courses;

    public function __construct(CourseService $courses)
    {
        $this->middleware('reset.reviews')->only('show');
        $this->courses = $courses;
    }

    public function index(Request $request, CourseFilter $filter)
    {
        // Get filtered courses with pagination
        $courses = $this->courses->getFilteredCourses($filter, 1);

        // Get sidebar statistics
        $languages = $this->courses->getLanguagesStats();
        $levels    = $this->courses->getLevelsStats();
        $ratings   = $this->courses->getRatingsStats();
        $durations = $this->courses->getDurationsStats();
        $cost      = $this->courses->getCostStats();

        if ($request->ajax()) {
            return view('frontend.courses.index-includes.courses', compact('courses'))->render();
        }

        return view('frontend.courses.index', compact('courses', 'languages', 'levels', 'ratings', 'cost', 'durations'));
    }

    public function show(Course $course)
    {
        $course->load('category', 'instructor.courses', 'courseGoals', 'sections', 'reviews');
        $reviews = $course->reviews()->active()->latest()->limit(session('reviewsCount'))->get();

        $relatedCourses = Course::where('id', '!=', $course->id)
            ->where('category_id', $course->category_id)
            ->with('instructor')
            ->limit(6)
            ->get();

        return view('frontend.courses.show', compact('course', 'relatedCourses', 'reviews'));
    }
}
