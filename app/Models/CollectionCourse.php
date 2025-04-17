<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CollectionCourse extends Model
{
    protected $table = 'collection_course';
    
    protected $primaryKey = ['collection_id', 'course_id'];

    public function collection()
    {
        return $this->belongsTo(Collection::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}