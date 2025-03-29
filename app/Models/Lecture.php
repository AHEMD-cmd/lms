<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{
    use HasFactory;

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function section()
    {
        return $this->belongsTo(CourseSection::class, 'course_section_id');
    }

    public function nextLecture()
    {
        return $this->where('course_id', $this->course_id)
            ->where('number', '>', $this->number)
            ->orderBy('number', 'asc')
            ->first();
    }

    public function files()
    {
        return $this->hasMany(LectureFile::class);
    }

    public function getDurationFormattedAttribute()
    {
        $hours = floor($this->duration / 60);
        $minutes = $this->duration % 60;

        if ($hours > 0) {
            return $hours . ' hr ' . ($minutes > 0 ? $minutes . ' min' : '');
        }

        return $minutes . ' min';
    }

    public function progress()
    {
        return $this->hasMany(LectureProgress::class);
    }

    public function getIsCompletedAttribute()
    {
        return $this->progress()->where(['user_id' => auth()->id(), 'is_completed' => true])->exists();
    }

    public function quiz()
    {
        return $this->hasOne(Quiz::class);
    }
}
