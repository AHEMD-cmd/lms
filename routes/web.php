<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\QuizController;
use App\Http\Controllers\Frontend\ReplyController;
use App\Http\Controllers\Frontend\CourseController;
use App\Http\Controllers\Frontend\ReportController;
use App\Http\Controllers\Frontend\ReviewController;
use App\Http\Controllers\Frontend\CategoryController;
use App\Http\Controllers\Frontend\QuestionController;
use App\Http\Controllers\Frontend\WishListController;
use App\Http\Controllers\Frontend\InstructorController;
use App\Http\Controllers\Frontend\QuizAnswerController;
use App\Http\Controllers\Frontend\SocialAuthController;
use App\Http\Controllers\Frontend\QuizAttemptController;
use App\Http\Controllers\Frontend\QuizQuestionController;
use App\Http\Controllers\Frontend\UserProgressController;
use App\Http\Controllers\Frontend\CourseLectureController;
use App\Http\Controllers\Frontend\StripeWebhookController;
use App\Http\Controllers\Frontend\QuestionUpvoteController;
use App\Http\Controllers\Frontend\GetTempVideoUrlController;
use App\Http\Controllers\Frontend\LectureCompletedController;
use App\Http\Controllers\Frontend\AttemptNextQuestionController;
use App\Http\Controllers\Frontend\PaymentMethodCheckoutController;
use App\Http\Controllers\Frontend\AttemptPreviousQuestionController;


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

require __DIR__ . '/auth.php';

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

    ############################### Course Lectures Routes ###########################
    Route::resource('courses.lectures', CourseLectureController::class)->only(['index']);
    Route::patch('lecture-completed/update', LectureCompletedController::class)->name('lecture.completed.update');
    Route::post('save-watched-progress', [UserProgressController::class, 'store']);
    Route::post('get-temp-video-url', GetTempVideoUrlController::class)->name('get-temp-video-url');

    ############################### Course Questions Routes ###########################
    Route::resource('questions', QuestionController::class)->only(['index', 'store', 'show', 'update', 'destroy']);

    ############################### Question Replies Routes ###########################
    Route::resource('replies', ReplyController::class)->only(['store']);

    ############################### Review Routes ###########################
    Route::resource('courses.reviews', ReviewController::class)->only(['index', 'store', 'update', 'delete']);

    ############################### Question Upvote Routes ###########################
    Route::resource('questions.upvotes', QuestionUpvoteController::class)->only(['store']);

    ############################### Course OR Review Reports Routes ###########################
    Route::resource('courses.reports', ReportController::class)->only('store');

    ############################### Course Quizzes Routes ####################################
    Route::resource('courses.lectures.quizzes', QuizController::class)->only(['show']);

    ############################### Quizzes Questions Routes ####################################
    Route::resource('quizzes.questions', QuizQuestionController::class)->only(['show']);

    ############################### Quizzes Answers Routes ####################################
    Route::resource('quizzes.answers', QuizAnswerController::class)->only(['store']);

    ############################### Quizzes Attempts Routes ####################################
    Route::resource('courses.quizzes.attempts', QuizAttemptController::class)->only(['index', 'show', 'update']);

    ############################### Attempts Questions Routes ####################################
    Route::resource('quizzes.attempts.next-questions', AttemptNextQuestionController::class)->only(['show']);
    Route::resource('quizzes.attempts.previous-questions', AttemptPreviousQuestionController::class)->only(['show']);

    // Direct Integration - Payment Method
    Route::controller(PaymentMethodCheckoutController::class)->group(function () {
        Route::get('/direct/paymentMethod', 'index')->middleware('auth')->name('direct.paymentMethod')->middleware('checkout.access');
        Route::post('/direct/paymentMethod/post', 'post')->middleware('auth')->name('direct.paymentMethod.post');
    });
});


Route::any('/stripe/webhook', [StripeWebhookController::class, 'handleWebhook'])->name('stripe.webhook');
