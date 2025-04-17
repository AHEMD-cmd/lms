<?php

namespace App\Http\Controllers\Frontend;

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
        return view('frontend.home.index', compact('sliders', 'features'));
    }
}
