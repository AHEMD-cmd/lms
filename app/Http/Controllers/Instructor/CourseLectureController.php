<?php

namespace App\Http\Controllers\Instructor;

use App\Models\Course;
use App\Models\Lecture;
use Illuminate\Http\Request;
use App\Models\CourseSection;
use App\Http\Controllers\Controller;
use App\Http\Requests\Instructor\Lecture\StoreLectureRequest;
use App\Http\Requests\Instructor\Lecture\UpdateLectureRequest;

class CourseLectureController extends Controller
{

    public function store(StoreLectureRequest $request, Course $course, CourseSection $section)
    {
        $section->lectures()->create(array_merge($request->validated(), ['course_id' => $course->id]));
        return back()->with('message', 'Lecture created successfully');
    }

    public function edit(Course $course, CourseSection $section, Lecture $lecture)
    {
        return view('instructor.lectures.edit', compact('course', 'section', 'lecture'));
    }

    public function update(UpdateLectureRequest $request, Course $course, CourseSection $section, Lecture $lecture)
    {
        $lecture->update($request->validated());
        return redirect()->route('instructor.courses.sections.index', $course->id)->with('message', 'Lecture updated successfully');
    }

    public function destroy(Course $course, CourseSection $section, Lecture $lecture)
    {
        $lecture->delete();
        return back()->with('message', 'Lecture deleted successfully');
    }
}
