<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\review\StoreReviewRequest;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('increment.reviews')->only('index');
    }

    public function index(Request $request, Course $course)
    {
        $allReviews = $course->reviews();

        // Apply search filter if provided
        if ($request->has('search') && !empty($request->search)) {
            $allReviews->where('comment', 'like', '%' . $request->search . '%');
        }

        // Apply rating filter if provided
        if ($request->has('rating') && !empty($request->rating)) {
            $allReviews->where('rate', $request->rating);
        }

        $reviews = $allReviews->take(session('reviewsCount'))->get();
        return response([
            'reviewsCount' => $reviews->count(),
            'allReviewsCount' => $allReviews->count(),
            'reviews' => view('frontend.courses.includes._reviews', compact('reviews'))->render()
        ]);
    }

    public function store(StoreReviewRequest $request, Course $course)
    {
        auth()->user()->reviews()->create($request->validated());

        return back()->with('message', 'Review created successfully!');
    }
}
