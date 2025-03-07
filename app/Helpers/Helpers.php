<?php

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;

if (!function_exists('uploadPhoto')) {
    function uploadPhoto(UploadedFile $photo, string $path = 'images'): string
    {
        return $photo->store($path, 'public');
    }
}

if (!function_exists('updatePhoto')) {
    function updatePhoto(UploadedFile $photo, string $path = 'images', $oldPhoto = 'photo'): string
    {
        if ($oldPhoto && File::exists(public_path($oldPhoto))) {
            File::delete(public_path($oldPhoto));
        }
        return $photo->store($path, 'public');
    }
}
