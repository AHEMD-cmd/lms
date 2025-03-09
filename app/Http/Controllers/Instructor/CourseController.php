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
        return view('instructor.courses.create', compact('categories'));
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
        return view('instructor.courses.edit', compact('categories', 'course'));
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
