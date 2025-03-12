<?php

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;


####################### for store methods #######################

if (!function_exists('uploadPhoto')) {
    function uploadPhoto(UploadedFile $photo, string $path = 'images'): string
    {
        return 'uploads/' . $photo->store($path, 'public');
    }
}

if (!function_exists('uploadVideo')) {
    function uploadVideo(UploadedFile $photo, string $path = 'videos'): string
    {
        return $photo->store($path, 's3');
    }
}

if (!function_exists('uploadEditedPhoto')) {
    function uploadEditedPhoto(UploadedFile $photo, string $path = 'images'): string
    {
        $photoName = hexdec(uniqid()) . '.' . $photo->getClientOriginalExtension();
        $image = Image::make($photo)->resize(370, 246)->save('uploads/' . $path . '/' . $photoName);
        $imageUrl = 'uploads/' . $path . '/' . $photoName;
        return $imageUrl;
    }
}

####################### for update methods #######################

if (!function_exists('updatePhoto')) {
    function updatePhoto(UploadedFile $photo, string $path = 'images', $oldPhoto = 'photo'): string
    {
        if ($oldPhoto && File::exists(public_path($oldPhoto))) {
            File::delete(public_path($oldPhoto));
        }
        return 'uploads/' . $photo->store($path, 'public');
    }
}

if (!function_exists('updateVideo')) {
    function updateVideo(UploadedFile $video, string $path = 'courses-video', $oldVideo = 'video')
    {
        if ($oldVideo && Storage::disk('s3')->exists($oldVideo)) {
            Storage::disk('s3')->delete($oldVideo);
        }

        return $video->store($path, 's3');
    }
}

if (!function_exists('updateEditedPhoto')) {
    function updateEditedPhoto(UploadedFile $photo, string $path = 'images', $oldPhoto = 'photo'): string
    {
        if ($oldPhoto && File::exists(public_path($oldPhoto))) {
            File::delete(public_path($oldPhoto));
        }
        $photoName = hexdec(uniqid()) . '.' . $photo->getClientOriginalExtension();
        $image = Image::make($photo)->resize(370, 246)->save('uploads/' . $path . '/' . $photoName);
        $imageUrl = 'uploads/' . $path . '/' . $photoName;
        return $imageUrl;
    }
}
