<?php

namespace App\Providers;

use App\Models\Course;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::unguard();
        $coursesCount = Course::all()->count();
        $categories = Category::with('courses.courseGoals')->withCount('courses')->get();
        $categoriesTree = Category::tree()->get()->toTree();

        view()->share('coursesCount', $coursesCount);
        view()->share('categories', $categories);
        view()->share('categoriesTree', $categoriesTree);

    }
}
