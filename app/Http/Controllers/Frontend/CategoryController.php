<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Filters\Frontend\CourseFilter;

class CategoryController extends Controller
{
    public function show(Request $request, Category $category, CourseFilter $filter)
    {
        // Start with the courses relationship query
        $coursesQuery = $category->courses();

        // Apply filters using CourseFilter
        $courses = $coursesQuery->filter($filter)->paginate(1);

        // Fetch sidebar data
        $languages = $category->courses()
            ->select('language', DB::raw('count(*) as count'))
            ->groupBy('language')
            ->get();

        $levels = $category->courses()
            ->select('level', DB::raw('count(*) as count'))
            ->groupBy('level')
            ->get();

        $ratings = $category->courses()
            ->get()
            ->filter(function ($course) {
                return $course->averageRating() > 0;
            })
            ->groupBy(function ($course) {
                $avg = $course->averageRating();
                return number_format(round($avg * 2) / 2, 1);
            })
            ->mapWithKeys(function ($group, $key) {
                return [$key => count($group)];
            })
            ->all();

        $cost = $category->courses()
            ->select(DB::raw('IF(price > 0, "Paid", "Free") as cost_type'), DB::raw('count(*) as count'))
            ->groupBy('cost_type')
            ->get();

        // Handle AJAX requests
        if ($request->ajax()) {
            return view('frontend.categories.includes.courses', compact('courses'))->render();
        }

        return view('frontend.categories.show', compact('category', 'courses', 'languages', 'levels', 'ratings', 'cost'));
    }
}