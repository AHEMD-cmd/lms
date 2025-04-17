<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseUser extends Model
{
    protected $table = 'course_user';

    protected $casts = [
        'is_archived' => 'boolean',
        'archived_at' => 'datetime',
        'is_favorite' => 'boolean',
        'favorited_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}