<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Student\ProfileController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Student\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', HomeController::class);


Route::middleware(['auth', 'role:user'])->group(function () {
    ############################# Student Dashboard Routes #############################
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    ############################# Student Profile Routes #############################
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/change-password', [ProfileController::class, 'changePassword'])->name('profile.change-password');
    Route::patch('/profile/change-password', [ProfileController::class, 'changePasswordUpdate'])->name('profile.change-password.update');
});


require __DIR__.'/auth.php';
