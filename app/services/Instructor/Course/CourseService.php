<?php

namespace App\Services\Instructor\Course;

use App\Models\Course;
use App\Models\CourseGoal;
use Illuminate\Support\Arr;

class CourseService
{
    #################### create course ####################
    public function createCourse($request, array $data)
    {
        if ($request->file('image')) {
            $data['image'] = uploadEditedPhoto($request->file('image'), 'courses');
        }

        if ($request->file('video')) {
            $data['video'] = uploadPhoto($request->file('video'), 'courses-video');
        }

        $course = Course::create(Arr::except($data, ['course_goals']));

        $this->createCourseGoals($data['course_goals'], $course->id);
    }

    private function createCourseGoals(array $data, $courseId)
    {
        foreach ($data as $goal) {
            CourseGoal::create([
                'course_id' => $courseId,
                'goal' => $goal
            ]);
        }
    }
    #################### end create course ####################

    #################### update course ####################
    public function updateCourse($request, $course, array $data)
    {
        if ($request->file('image')) {
            $data['image'] = updateEditedPhoto($request->file('image'), 'courses', $course->image);
        }

        if ($request->file('video')) {
            $data['video'] = updatePhoto($request->file('video'), 'courses-video', $course->video);
        }

        $course->update(Arr::except($data, ['course_goals']));

        $this->updateCourseGoals($data['course_goals'], $course);
    }

    private function updateCourseGoals(array $data, $course)
    {
        $course->courseGoals()->delete();

        foreach ($data as $goal) {
            CourseGoal::create([
                'course_id' => $course->id,
                'goal' => $goal
            ]);
        }
    }
    #################### end update course ####################
}