<?php

namespace App\Http\Controllers\Admin;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::latest()->paginate(10);
        return view('admin.courses.index', compact('courses'));
    }

    public function show(Course $course)
    {
        return view('admin.courses.show', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        $request->validate([
            'status' => 'required|in:1,0',
        ]);

        $course->update(['status' => $request->status]);

        return response([
            'status' => 'success',
            'message' => 'Course updated successfully'
        ], 201);
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('admin.courses.index');
    }
}
