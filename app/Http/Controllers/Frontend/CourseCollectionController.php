<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Collection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Frontend\CourseCollection\UpdateCourseCollectionRequest;

class CourseCollectionController extends Controller
{
    public function update(UpdateCourseCollectionRequest $request, Collection $collection)
    {
        $attached = $collection->courses()->toggle($request->course_id);

        return response()->json([
            'success' => true,
            'attached' => !empty($attached['attached']),
            'collections' => view('frontend.user-courses.includes.collections', ['collections' => Auth::user()->collections()->with('courses')->get()])->render(),
            'courses' => view('frontend.user-courses.includes.all-courses', ['courses' => Auth::user()->studentCourses()->with('collections')->paginate(2)])->render(),
        ]);
    }
}
