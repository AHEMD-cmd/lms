<?php

namespace App\Http\Controllers\Instructor;

use App\Models\Course;
use App\Models\Lecture;
use Illuminate\Support\Arr;
use App\Models\CourseSection;
use App\Http\Controllers\Controller;
use App\Http\Requests\Instructor\Lecture\StoreLectureRequest;
use App\Http\Requests\Instructor\Lecture\UpdateLectureRequest;

class CourseLectureController extends Controller
{
    public function __construct()
    {
        $this->middleware('ensure.lecture.owner')->except('index', 'create', 'store');
    }

    public function store(StoreLectureRequest $request, Course $course, CourseSection $section)
    {
        $dataWithoutFiles = Arr::except($request->validated(), ['files']);

        $lecture = $section->lectures()->create(array_merge($dataWithoutFiles, ['course_id' => $course->id]));

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $path = $file->store('lectures', 'public');
                $fileName = $file->getClientOriginalName(); 
                $lecture->files()->create([
                    'file' => $path,
                    'name' => $fileName,
                ]);
            }
        }

        return response()->json([
            'message' => 'Lecture created successfully',
            'lectures' => view('instructor.course-sections.includes._lectures', [
                'section' => $section->load('lectures'),
                'course' => $course
            ])->render(),
        ], 201);
    }

    public function edit(Course $course, CourseSection $section, Lecture $lecture)
    {
        return view('instructor.lectures.edit', compact('course', 'section', 'lecture'));
    }

    public function update(UpdateLectureRequest $request, Course $course, CourseSection $section, Lecture $lecture)
    {
        $dataWithoutFiles = Arr::except($request->validated(), ['files']);

        $lecture->update($dataWithoutFiles);

        if ($request->hasFile('files')) {
            $lecture->files()->delete();
            foreach ($request->file('files') as $file) {
                $fileName = $file->getClientOriginalName(); 
                $path = $file->store('lectures', 'public');
                $lecture->files()->create([
                    'file' => $path,
                    'name' => $fileName,
                ]);
            }
        }
        return redirect()->route('instructor.courses.sections.index', [$course->slug, $section->id])
        ->with('message', 'Lecture updated successfully');
    }

    public function destroy(Course $course, CourseSection $section, Lecture $lecture)
    {
        $lecture->delete();
        return redirect()->route('instructor.courses.sections.index', [$course->slug, $section->id])
        ->with('message', 'Lecture deleted successfully');
    }
}
