<?php

namespace App\Models;

use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;

class Category extends Model
{
    use HasFactory, HasRecursiveRelationships, Sluggable;

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
    
    protected static function boot()
    {
        parent::boot();

        static::deleting(function (Category $category) {
            if ($category->image) {
                File::delete(public_path($category->image));
            }
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

}
