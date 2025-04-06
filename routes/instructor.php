<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Instructor\QuizController;
use App\Http\Controllers\Instructor\CouponController;
use App\Http\Controllers\Instructor\CourseController;
use App\Http\Controllers\Instructor\ProfileController;
use App\Http\Controllers\Instructor\DashboardController;
use App\Http\Controllers\Instructor\QuizAnswerController;
use App\Http\Controllers\Instructor\QuizAttemptController;
use App\Http\Controllers\Instructor\CouponStatusController;
use App\Http\Controllers\Instructor\LectureVideoController;
use App\Http\Controllers\Instructor\QuizQuestionController;
use App\Http\Controllers\Instructor\CourseLectureController;
use App\Http\Controllers\Instructor\CourseSectionController;
use App\Http\Controllers\Instructor\QuizPublishedController;
use App\Http\Controllers\Instructor\S3ChunkUploadController;
use App\Http\Controllers\Instructor\QuestionOptionController;
use App\Http\Controllers\Instructor\GetTempVideoUrlController;
use App\Http\Controllers\Instructor\LecturePublishedController;

############### Instructor Dashboard Routes ###############
Route::get('instructor/dashboard', DashboardController::class)->name('instructor.dashboard');

Route::middleware(['auth', 'role:instructor', 'check.instructor.status'])
    ->prefix('instructor')
    ->as('instructor.')
    ->group(function () {

        ############### Instructor Profile Routes ###############
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::get('/profile/change-password', [ProfileController::class, 'changePassword'])->name('profile.change-password');
        Route::patch('/profile/change-password', [ProfileController::class, 'changePasswordUpdate'])->name('profile.change-password.update');

        ############### Instructor Course Routes ###############
        Route::resource('courses', CourseController::class);

        ############### Video Upload Routes ###############
        Route::post('/video-upload/presigned-url', [S3ChunkUploadController::class, 'getPresignedUrl'])
            ->name('video-upload.presigned-url');
        Route::post('/video-upload/complete', [S3ChunkUploadController::class, 'completeUpload'])
            ->name('video-upload.complete');

        ############### Instructor Course Sections Routes ###############
        Route::resource('courses.sections', CourseSectionController::class);

        ############### Instructor Course Lectures Routes ###############
        Route::resource('courses.sections.lectures', CourseLectureController::class);
        Route::patch('courses/{course}/sections/{section}/lectures/{lecture}/update-published-status', LecturePublishedController::class)->name('courses.sections.lectures.update-published-status');
        Route::post('get-temp-video-url', GetTempVideoUrlController::class)->name('get-temp-video-url');

        ############################# Instructor Coupon Routes #############################
        Route::resource('coupons', CouponController::class);
        Route::patch('coupons/{coupon}/update-status', CouponStatusController::class)->name('coupons.update-status');

        ############################# Instructor quizzes Routes #######################################
        Route::resource('courses.quizzes', QuizController::class);
        Route::patch('courses/{course}/quizzes/{quiz}/update-published-status', QuizPublishedController::class)->name('courses.quizzes.update-published-status');

        ############################# Instructor quizzes questions Routes #############################
        Route::resource('quizzes.questions', QuizQuestionController::class);

        ############################# Instructor questions options Routes #############################
        Route::resource('questions.options', QuestionOptionController::class);

        ############################# Instructor quizzes attempts Routes #############################
        Route::resource('quizzes.attempts', QuizAttemptController::class);

        ############################# Instructor quizzes answers Routes #############################
        Route::resource('quizzes.answers', QuizAnswerController::class);
    });
