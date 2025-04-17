<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\FeatureController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\InstructorController;
use App\Http\Controllers\Admin\SmtpSettingController;
use App\Http\Controllers\Admin\InstructorCourseController;



Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->as('admin.')
    ->group(function () {
        ############### Admin Dashboard Routes ###############
        Route::get('/dashboard', DashboardController::class)->name('dashboard');

        ############### Admin Profile Routes ###############
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::get('/profile/change-password', [ProfileController::class, 'changePassword'])->name('profile.change-password');
        Route::patch('/profile/change-password', [ProfileController::class, 'changePasswordUpdate'])->name('profile.change-password.update');

        ############################# Admin Category Routes #############################
        Route::resource('categories', CategoryController::class);

        ############################# Admin Instructor Routes #############################
        Route::resource('instructors', InstructorController::class)->only(['index', 'update', 'destroy']);

        ############################# Admin Course Routes #############################
        Route::resource('courses', CourseController::class)->only(['index', 'show', 'update', 'destroy']);

        ############################# Admin Coupon Routes #############################
        Route::resource('coupons', CouponController::class);
        Route::patch('coupons/{coupon}/update-status', [CouponController::class, 'updateStatus'])->name('coupons.update-status');

        ############################# Admin Instructor Course Routes #############################
        Route::resource('instructors.courses', InstructorCourseController::class)->only(['index']);
        
        ############################# Admin Smtp Settings Routes #############################
        Route::resource('smtp-settings', SmtpSettingController::class)->only(['edit', 'update']);
        
        ############################# Admin Reports Routes #############################
        Route::resource('courses.reports', ReportController::class)->only(['index', 'show', 'destroy']);

        ############################# Admin Sliders Routes #############################
        Route::resource('sliders', SliderController::class);

        ############################# Admin Features Routes #############################
        Route::resource('features', FeatureController::class);

    });
