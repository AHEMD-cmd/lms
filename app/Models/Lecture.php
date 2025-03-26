<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{
    use HasFactory;

    protected $casts = [
        'files' => 'array',
    ];

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

    public function progress()
    {
        return $this->hasMany(LectureUserProgress::class);
    }

    public function files()
    {
        return $this->hasMany(LectureFile::class);
    }
}
