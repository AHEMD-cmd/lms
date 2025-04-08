<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Filters\Frontend\CourseFilter;
use App\Services\Course\CourseStatisticsService;

class CategoryController extends Controller
{
    protected $statsService;

    public function __construct(CourseStatisticsService $statsService)
    {
        $this->statsService = $statsService;
    }

    public function show(Request $request, Category $category, CourseFilter $filter)
    {
        // Use the category's courses as the base query
        $baseQuery = $category->courses();

        // Filter the courses and paginate
        $courses = $baseQuery->filter($filter)->paginate(1);

        // Use the service to retrieve sidebar statistics
        // (Pass separate instances or clones of the base query to avoid interference)
        $languages = $this->statsService->getLanguagesStats($category->courses());
        $levels    = $this->statsService->getLevelsStats($category->courses());
        $ratings   = $this->statsService->getRatingsStats($category->courses());
        $cost      = $this->statsService->getCostStats($category->courses());

        // Handle AJAX request separately
        if ($request->ajax()) {
            return view('frontend.categories.includes.courses', compact('courses'))->render();
        }

        return view('frontend.categories.show', compact('category', 'courses', 'languages', 'levels', 'ratings', 'cost'));
    }
}
