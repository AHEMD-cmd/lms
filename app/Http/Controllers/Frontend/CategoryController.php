<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
    }

    public function show(Category $category)
    {
        $category->load('courses');
        return view('frontend.categories.show', compact('category'));
    }
}
