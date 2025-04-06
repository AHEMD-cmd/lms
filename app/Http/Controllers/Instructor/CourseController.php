<?php

namespace App\Http\Controllers\Instructor;


use App\Models\Course;
use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Services\Instructor\Course\CourseService;
use App\Http\Requests\Instructor\Course\StoreCourseRequest;
use App\Http\Requests\Instructor\Course\UpdateCourseRequest;

class CourseController extends Controller
{
    private $courseService;

    public function __construct(CourseService $courseService)
    {
        $this->middleware('ensure.course.owner')->except('index', 'create', 'store');
        $this->courseService = $courseService;
    }

    public function index()
    {
        $courses = Course::where('instructor_id', auth()->user()->id)->paginate(10);
        return view('instructor.courses.index', compact('courses'));
    }

    public function create()
    {
        $categories = Category::tree()->get();
        // Load languages from the umpirsky package - English language names
        $languagesPath = base_path('vendor/umpirsky/language-list/data/en/language.php');
        $languages = file_exists($languagesPath) ? require $languagesPath : [];

        asort($languages);
        return view('instructor.courses.create', compact('categories', 'languages'));
    }


    public function store(StoreCourseRequest $request)
    {
        $this->courseService->createCourse($request, $request->validated());

        return redirect()->route('instructor.courses.index')->with('success', 'Course created successfully');
    }

    public function edit(Course $course)
    {
        $course->load('courseGoals');
        $categories = Category::tree()->get();
        // Load languages from the umpirsky package - English language names
        $languagesPath = base_path('vendor/umpirsky/language-list/data/en/language.php');
        $languages = file_exists($languagesPath) ? require $languagesPath : [];

        asort($languages);
        return view('instructor.courses.edit', compact('categories', 'course', 'languages'));
    }

    public function update(UpdateCourseRequest $request, Course $course)
    {
        $this->courseService->updateCourse($request, $course, $request->validated());

        return redirect()->route('instructor.courses.index')->with('success', 'Course updated successfully');
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('instructor.courses.index')->with('success', 'Course deleted successfully');
    }
}
