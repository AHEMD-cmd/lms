<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\CourseController;
use App\Http\Controllers\Frontend\CategoryController;
use App\Http\Controllers\Frontend\WishListController;
use App\Http\Controllers\Frontend\InstructorController;
use App\Http\Controllers\Frontend\SocialAuthController;


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
require __DIR__.'/auth.php';

Route::get('/', HomeController::class)->name('home');

############################### Become Instructor Routes ################################
Route::get('become-instructor', [InstructorController::class, 'create'])->name('become.instructor');
Route::post('become-instructor', [InstructorController::class, 'store'])->name('become.instructor.store');

############################### Social Media Auth Routes ################################
Route::get('/auth/{provider}/redirect', [SocialAuthController::class, 'redirectToProvider'])->name('auth.redirect');
Route::get('/auth/{provider}/callback', [SocialAuthController::class, 'handleProviderCallback'])->name('auth.callback');

############################### Courses Routes ################################
Route::resource('courses', CourseController::class)->only(['index', 'show']);

############################### Categories Routes ################################
Route::resource('categories', CategoryController::class)->only(['index', 'show']);

############################### Instructor Page Routes ################################
Route::resource('instructors', InstructorController::class)->only(['show']);

############################### Cart Routes ################################
Route::resource('carts', CartController::class)->only(['index', 'update', 'store', 'destroy']);

Route::middleware('auth')->group(function () {
    ############################### Wish List Routes ################################
    Route::get('wish-list', [WishListController::class, 'index'])->name('wish.list.index');
    Route::post('wish-list/{course}', [WishListController::class, 'store'])->name('wish.list.store');
    Route::delete('wish-list/{course}', [WishListController::class, 'destroy'])->name('wish.list.destroy');
});

