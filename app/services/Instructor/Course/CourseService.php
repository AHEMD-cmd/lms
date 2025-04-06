<?php

namespace App\Services\Instructor\Course;

use App\Models\Course;
use App\Models\CourseGoal;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class CourseService {
    /**
     * Create a new course with optional image and video path
     */
    public function createCourse($request, array $data)
    {
        // Handle image upload synchronously (assuming images are smaller)
        if ($request->file('image')) {
            $data['image'] = uploadEditedPhoto($request->file('image'), 'courses');
        }
        
        if (isset($data['video_path'])) {
            $data['video'] = null; // Clear the video URL since we're using S3 now
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
            $data['image'] = updateEditedPhoto($request->file('image'), 'courses', $course->image);
        }
        
        if (isset($data['video_path'])) {
            if($course->video) {
                Storage::disk('s3')->delete($course->video_path);
            }
            $data['video'] = null; // Clear the video URL since we're using S3 
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