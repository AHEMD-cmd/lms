<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    public function replies()
    {
        return $this->hasMany(Question::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lecture()
    {
        return $this->belongsTo(Lecture::class);
    }

    public function upvotedUsers()
    {
        return $this->belongsToMany(User::class, 'question_upvotes')->withTimestamps();
    }
    
    public function upvoteCount()
    {
        return $this->upvotedUsers()->count();
    }
    
    public function scopeTopLevel($query)
    {
        return $query->whereNull('question_id');
    }
}
