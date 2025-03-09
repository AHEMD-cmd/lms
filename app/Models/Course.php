<?php

namespace App\Models;

use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory, Sluggable;

    public function instructor()
    {
        return $this->belongsTo(User::class, 'instructor_id', 'id')->withDefault([
            'name' => 'Unknown',
        ]);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function courseGoals()
    {
        return $this->hasMany(CourseGoal::class);
    }

    public function sections()
    {
        return $this->hasMany(CourseSection::class)->with('lectures');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    
    public static function boot()
    {
        parent::boot();

        static::deleting(function ($course) {
            if ($course->image) {
                File::delete(public_path($course->image));
            }

            if ($course->video) {
                File::delete(public_path($course->video));
            }
        });
    }

}
