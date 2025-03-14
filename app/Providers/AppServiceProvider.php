<?php

namespace App\Providers;

use App\Models\Cart;
use App\Models\Course;
use App\Models\Category;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::unguard();

        // Use Bootstrap pagination
        Paginator::useBootstrap();

        $coursesCount = Course::all()->count();
        $categories = Category::with('courses.courseGoals')->withCount('courses')->get();
        $categoriesTree = Category::tree()->get()->toTree();

        
        view()->share('coursesCount', $coursesCount);
        view()->share('categories', $categories);
        view()->share('categoriesTree', $categoriesTree);


        View::composer('*', function ($view) {
            $wishlistedCourses = Auth::check() ? auth()->user()->wishList : [];
            $view->with('wishlistedCourses', $wishlistedCourses);
        });

        View::composer('*', function ($view) {
            $cartItems = Cart::bySessionId()->get();
            $view->with('cartItems', $cartItems);
        });
    }
}
