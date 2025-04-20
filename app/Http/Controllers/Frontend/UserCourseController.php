<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Filters\Frontend\UserCoursesFilter;

class UserCourseController extends Controller
{
    public function index()
    {
        $courses = Auth::user()->studentCourses()->with('collections')->paginate(6);
        $wishlistCourses = Auth::user()->wishList()->paginate(6);
        $archivedCourses = Auth::user()->studentCourses()->where('is_archived', true)->paginate(6);
        $collections = Auth::user()->collections()->with('courses')->get();
        
        // Get unique instructors for enrolled courses
        $enrolledInstructors = Auth::user()->studentCourses()
            ->with('instructor')
            ->get()
            ->pluck('instructor')
            ->unique('id');
            
        // Get unique categories for enrolled courses
        $enrolledCategories = Auth::user()->studentCourses()
            ->with('category')
            ->get()
            ->pluck('category')
            ->unique('id');
        
        return view('frontend.user-courses.index', compact(
            'courses', 
            'wishlistCourses', 
            'archivedCourses', 
            'collections',
            'enrolledInstructors',
            'enrolledCategories'
        ));
    }
    
    public function filter(Request $request, UserCoursesFilter $filter)
    {
        $user = Auth::user();
        
        // Apply the filter to the user's enrolled courses
        $courses = $user->studentCourses()
            ->with(['instructor', 'category', 'collections'])
            ->filter($filter)
            ->paginate(6);
        
        if ($request->ajax()) {
            return view('frontend.user-courses.includes.all-courses', compact('courses'))->render();
        }
        
        return view('frontend.user-courses.includes.all-courses', compact('courses'));
    }
}