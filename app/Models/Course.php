<?php

namespace App\Models;

use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory, Sluggable;

    protected $casts = [
        'videos' => 'array',
    ];

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
        return $this->hasMany(CourseSection::class)->with('lectures.files');
    }

    public function lectures()
    {
        return $this->hasMany(Lecture::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
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
                Storage::disk('s3')->delete($course->video);
            }
        });
    }

    public function getDiscountPercentageAttribute()
    {
        return $this->discount ? round((($this->price - $this->discount) / $this->price) * 100, 0) : null;
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function averageRating()
    {
        return $this->reviews()->where('status', 1)->avg('rate') ?? 0;
    }

    public function doesRateHaveFraction()
    {
        return ceil($this->averageRating()) - $this->averageRating() > 0 ? true : false;
    }

    public function getFiveStarPercentage()
    {
        $total = $this->reviews()->count();
        return $total ? (int) ($this->reviews()->where('rate', '5')->count() / $total * 100) : 0;
    }

    public function getFourStarPercentage()
    {
        $total = $this->reviews()->count();
        return $total ? (int) ($this->reviews()->where('rate', '4')->count() / $total * 100) : 0;
    }

    public function getThreeStarPercentage()
    {
        $total = $this->reviews()->count();
        return $total ? (int) ($this->reviews()->where('rate', '3')->count() / $total * 100) : 0;
    }

    public function getTwoStarPercentage()
    {
        $total = $this->reviews()->count();
        return $total ? (int) ($this->reviews()->where('rate', '2')->count() / $total * 100) : 0;
    }

    public function getOneStarPercentage()
    {
        $total = $this->reviews()->count();
        return $total ? (int) ($this->reviews()->where('rate', '1')->count() / $total * 100) : 0;
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
}
