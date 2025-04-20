<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Course;
use App\Models\Slider;
use App\Models\Feature;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function __invoke(Request $request)
    {
        $sliders = Slider::all();
        $features = Feature::all();
        $courses = Course::inRandomOrder()->take(6)->get();

        return view('frontend.home.index', compact('sliders', 'features', 'courses'));
    }
}
