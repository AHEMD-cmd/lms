<?php

namespace App\Services\Instructor\Course;

use App\Models\Course;
use App\Models\CourseGoal;
use Illuminate\Support\Arr;

class CourseService
{
    /**
     * Create a new course with optional image and video
     */
    public function createCourse($request, array $data)
    {
        // Handle image upload synchronously (assuming images are smaller)
        if ($request->file('image')) {
            $data['image'] = uploadEditedPhotoToS3($request->file('image'), 'courses');
        }

        $course = Course::create(Arr::except($data, ['course_goals']));

        // Handle course goals (assuming this method exists)
        $this->createCourseGoals($data['course_goals'] ?? [], $course->id);

        return $course;
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

    /**
     * Update an existing course
     */
    public function updateCourse($request, $course, array $data)
    {
        // Handle image update
        if ($request->file('image')) {
            $data['image'] = updateEditedPhotoToS3($request->file('image'), 'courses', $course->image);
        }

        $course->update(Arr::except($data, ['course_goals']));

        // Update course goals (assuming this method exists)
        $this->updateCourseGoals($data['course_goals'] ?? [], $course);

        return $course;
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
