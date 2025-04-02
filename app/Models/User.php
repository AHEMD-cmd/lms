<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Sluggable;


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

    public function averageRating()
    {
        return $this->instructorReviews()->avg('rate') ?? 0;
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
}
