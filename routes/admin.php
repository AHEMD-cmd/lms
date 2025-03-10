<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\InstructorController;



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
    });
