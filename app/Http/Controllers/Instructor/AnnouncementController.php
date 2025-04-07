<?php

namespace App\Http\Controllers\Instructor;

use App\Models\Course;
use App\Models\Announcement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Instructor\Announcement\StoreAnnouncementRequest;
use App\Http\Requests\Instructor\Announcement\UpdateAnnouncementRequest;

class AnnouncementController extends Controller
{
    public function index(Course $course)
    {
        $course->load('announcements');
        return view('instructor.announcements.index', compact('course'));
    }

    public function create(Course $course)
    {
        return view('instructor.announcements.create', compact('course'));
    }

    public function store(StoreAnnouncementRequest $request, Course $course)
    {
        $course->announcements()->create($request->validated());

        return redirect()->route('instructor.courses.announcements.index', $course->slug)->with('message', 'Announcement created successfully');
    }

    public function edit(Course $course, Announcement $announcement)
    {
        return view('instructor.announcements.edit', compact('announcement', 'course'));
    }

    public function update(UpdateAnnouncementRequest $request, Course $course, Announcement $announcement)
    {
        $announcement->update($request->validated());

        return redirect()->route('instructor.courses.announcements.index', $course->slug)->with('message', 'Announcement updated successfully');
    }

    public function destroy(Course $course, Announcement $announcement)
    {
        $announcement->delete();

        return redirect()->route('instructor.courses.announcements.index', $course->slug)->with('message', 'Announcement deleted successfully');
    }
}
