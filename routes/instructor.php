<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Instructor\CouponController;
use App\Http\Controllers\Instructor\CourseController;
use App\Http\Controllers\Instructor\UploadController;
use App\Http\Controllers\Instructor\ProfileController;
use App\Http\Controllers\Instructor\DashboardController;
use App\Http\Controllers\Instructor\CouponStatusController;
use App\Http\Controllers\Instructor\CourseLectureController;
use App\Http\Controllers\Instructor\CourseSectionController;
use App\Http\Controllers\Instructor\LectureActiveController;
use App\Http\Controllers\Instructor\LecturePublishedController;



Route::middleware(['auth', 'role:instructor'])
    ->prefix('instructor')
    ->as('instructor.')
    ->group(function () {
        ############### Instructor Dashboard Routes ###############
        Route::get('/dashboard', DashboardController::class)->name('dashboard');

        ############### Instructor Profile Routes ###############
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::get('/profile/change-password', [ProfileController::class, 'changePassword'])->name('profile.change-password');
        Route::patch('/profile/change-password', [ProfileController::class, 'changePasswordUpdate'])->name('profile.change-password.update');

        ############### Instructor Course Routes ###############
        Route::resource('courses', CourseController::class);
        Route::get('/get-video-url/{courseId}', [CourseController::class, 'getVideoUrl'])->name('get-video-url');

        ############### Instructor Course Sections Routes ###############
        Route::resource('courses.sections', CourseSectionController::class);

        ############### Instructor Course Lectures Routes ###############
        Route::resource('courses.sections.lectures', CourseLectureController::class);
        Route::patch('courses/{course}/sections/{section}/lectures/{lecture}/update-active-status', LectureActiveController::class)->name('courses.sections.lectures.update-active-status');
        Route::patch('courses/{course}/sections/{section}/lectures/{lecture}/update-published-status', LecturePublishedController::class)->name('courses.sections.lectures.update-published-status');

        ############################# Instructor Coupon Routes #############################
        Route::resource('coupons', CouponController::class);
        Route::patch('coupons/{coupon}/update-status', CouponStatusController::class)->name('coupons.update-status');
    });
