<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WishListController extends Controller
{

    public function index()
    {
        return view('frontend.wishlist.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
        ]);

        $request->user()->wishList()->toggle($request->course_id);

        return response([
            'status' => 'success',
            'message' => 'Course added to wish list successfully',
            'wishlistedCourses' => view('frontend.partials.header-wishlist')->with('wishlistedCourses', $request->user()->wishList)->render(),
        ], 200);
    }
}
