<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Student\ProfileController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\InstructorController;
use App\Http\Controllers\Student\DashboardController;
use App\Http\Controllers\Frontend\SocialLoginController;

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

Route::get('become-instructor', [InstructorController::class, 'create'])->name('become.instructor');
Route::post('become-instructor', [InstructorController::class, 'store'])->name('become.instructor.store');


Route::get('/auth/{provider}/redirect', [SocialLoginController::class, 'redirectToProvider'])->name('auth.redirect');
Route::get('/auth/{provider}/callback', [SocialLoginController::class, 'handleProviderCallback'])->name('auth.callback');

require __DIR__.'/auth.php';
