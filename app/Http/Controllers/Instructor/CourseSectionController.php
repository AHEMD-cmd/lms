<?php

namespace App\Http\Controllers\Instructor;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\CourseSection;
use App\Http\Controllers\Controller;
use App\Http\Requests\Instructor\CourseSection\StoreSectionRequest;
use App\Http\Requests\Instructor\CourseSection\UpdateSectionRequest;

class CourseSectionController extends Controller
{
    public function index(Course $course)
    {
        $course->load('sections');
        return view('instructor.course-sections.index', compact('course'));
    }

    public function store(StoreSectionRequest $request, Course $course)
    {
        $course->sections()->create($request->validated());

        return redirect()->back()->with('message', 'Section created successfully');
    }

    public function update(UpdateSectionRequest $request, Course $course, CourseSection $section)
    {
        $section->update($request->validated());

        return redirect()->back()->with('message', 'Section updated successfully');
    }

    public function destroy(Course $course, CourseSection $section)
    {
        $section->delete();
        return redirect()->back()->with('message', 'Section deleted successfully');
    }
}
