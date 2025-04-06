<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseSection extends Model
{
    use HasFactory;

    public function lectures()
    {
        return $this->hasMany(Lecture::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

    public function progress()
    {
        return $this->hasMany(LectureProgress::class, 'section_id');
    }

    public function getCompletedLecturesAttribute()
    {
        return $this->hasMany(LectureProgress::class, 'section_id')
            ->where('user_id', auth()->id())
            ->where('is_completed', true);
    }

    public function getDurationFormattedAttribute()
    {
        $hours = floor($this->lectures()->sum('duration') / 60);
        $minutes = $this->lectures()->sum('duration') % 60;

        if ($hours > 0) {
            return $hours . ' hr ' . ($minutes > 0 ? $minutes . ' min' : '');
        }

        return $minutes . ' min';
    }

    public function lecturesWithoutQuiz()
    {
        return $this->lectures()->whereDoesntHave('quiz')->get();
    }
}
