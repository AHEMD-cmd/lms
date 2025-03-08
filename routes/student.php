<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Instructor\ProfileController;
use App\Http\Controllers\Instructor\DashboardController;



Route::middleware(['auth', 'role:user'])->group(function () {
    ############################# Student Dashboard Routes #############################
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    ############################# Student Profile Routes #############################
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/change-password', [ProfileController::class, 'changePassword'])->name('profile.change-password');
    Route::patch('/profile/change-password', [ProfileController::class, 'changePasswordUpdate'])->name('profile.change-password.update');
});

