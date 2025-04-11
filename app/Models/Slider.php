<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Slider extends Model
{
    use HasFactory;

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($slider) {
            if ($slider->image) {
                File::delete(public_path($slider->image));
            }

            if ($slider->video) {
                Storage::disk('s3')->delete($slider->video);
            }
        });
    }
}
