<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Instructor\CourseController;
use App\Http\Controllers\Instructor\ProfileController;
use App\Http\Controllers\Instructor\DashboardController;
use App\Http\Controllers\Instructor\CourseLectureController;
use App\Http\Controllers\Instructor\CourseSectionController;



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

        ############### Instructor Course Sections Routes ###############
        Route::resource('courses.sections', CourseSectionController::class);

        ############### Instructor Course Lectures Routes ###############
        Route::resource('courses.sections.lectures', CourseLectureController::class);
    });
