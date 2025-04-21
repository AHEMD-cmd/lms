<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Cashier\Billable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Sluggable, Billable;


    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Get the courses of the auth instructor
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function courses()
    {
        return $this->hasMany(Course::class, 'instructor_id', 'id');
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
    /**
     * Get the reviews of the auth student
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    /**
     * Get the number of reviews an instructor has 
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function instructorReviews()
    {
        return $this->hasManyThrough(
            Review::class,
            Course::class,
            'instructor_id',
            'course_id',
            'id',
            'id'
        )->where('reviews.status', 1);
    }

    /**
     * Get the number of students for the instructor
     *
     * @return int
     */
    public function instructorStudentsCount()
    {
        return DB::table('course_users')
            ->join('courses', 'course_users.course_id', '=', 'courses.id')
            ->where('courses.instructor_id', $this->id)
            ->distinct('course_users.user_id')
            ->count('course_users.user_id');
    }

    public function averageRating()
    {
        return number_format($this->instructorReviews()->avg('rate'), 1) ?? 0;
    }

    public function wishList()
    {
        return $this->belongsToMany(Course::class, 'wish_lists', 'user_id', 'course_id');
    }

    public function upvotedQuestions()
    {
        return $this->belongsToMany(Question::class, 'question_upvotes')->withTimestamps();
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function attempts()
    {
        return $this->hasMany(QuizAttempt::class);
    }

    public function getPhotoAttribute()
    {
        return str_starts_with($this->attributes['photo'], 'http')
            ? $this->attributes['photo']
            : asset($this->attributes['photo']);
    }

    public function studentCourses()
    {
        return $this->belongsToMany(Course::class, 'course_users', 'user_id', 'course_id')
            ->withPivot([
                'is_archived',
                'archived_at',
                'is_favorite',
                'favorited_at'
            ])
            ->withTimestamps();
    }

    public function collections()
    {
        return $this->hasMany(Collection::class);
    }

    public function favoriteCourses()
    {
        return $this->studentCourses()->wherePivot('is_favorite', true);
    }

    public function archivedCourses()
    {
        return $this->studentCourses()->wherePivot('is_archived', true);
    }

    public function isFavoritedCourse(Course $course): bool
    {
        return $this->studentCourses()
            ->where('course_id', $course->id)
            ->wherePivot('is_favorite', true)
            ->exists();
    }

    public function isArchivedCourse(Course $course): bool
    {
        return $this->studentCourses()
            ->where('course_id', $course->id)
            ->wherePivot('is_archived', true)
            ->exists();
    }

    public function toggleFavoriteCourse(Course $course)
    {
        $course = $this->studentCourses()->where('course_id', $course->id)->first();

        if ($course) {
            $isFavorite = !$course->pivot->is_favorite;
            $this->studentCourses()->updateExistingPivot($course->id, [
                'is_favorite' => $isFavorite,
                'favorited_at' => $isFavorite ? now() : null
            ]);

            return $isFavorite;
        }

        $this->studentCourses()->attach($course->id, [
            'is_favorite' => true,
            'favorited_at' => now()
        ]);

        return true;
    }

    public function toggleArchiveCourse(Course $course)
    {
        $course = $this->courses()->where('course_id', $course->id)->first();

        if ($course) {
            $isArchived = !$course->pivot->is_archived;
            $this->courses()->updateExistingPivot($course->id, [
                'is_archived' => $isArchived,
                'archived_at' => $isArchived ? now() : null
            ]);

            return $isArchived;
        }

        $this->courses()->attach($course->id, [
            'is_archived' => true,
            'archived_at' => now()
        ]);

        return true;
    }

    public function toggleCourseInCollection(Course $course, Collection $collection)
    {
        // Verify user owns the collection
        if ($this->collections()->where('id', $collection->id)->exists()) {
            $collection->courses()->toggle($course->id);

            return true;
        }

        return false;
    }
}
