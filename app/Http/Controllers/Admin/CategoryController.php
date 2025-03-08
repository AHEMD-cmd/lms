<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\StoreRequest;
use App\Http\Requests\Admin\Category\UpdateRequest;
use Illuminate\Http\Request;
use App\Models\Category;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    public function index()
    {

        $categories = Category::tree()->get();
        return view('admin.category.index', compact('categories'));
    } // End Method 

    public function create()
    {
        $categories = Category::tree()->get();
        return view('admin.category.create', compact('categories'));
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        if ($request->file('image')) {
            $data['image'] = uploadEditedPhoto($request->file('image'), 'categories');
        }

        Category::create($data);

        return redirect()->back()->with('message', 'Category created successfully');
    }


    public function edit(Category $category)
    {
        $categories = Category::tree()->where('id', '!=', $category->id)->get()->toTree();
        return view('admin.category.edit', compact('category', 'categories'));
    }

    public function update(UpdateRequest $request, Category $category)
    {
        $data = $request->validated();

        if ($request->file('image')) {
            $data['image'] = updateEditedPhoto($request->file('image'), 'categories', $category->image);
        }

        $category->update($data);

        return redirect()->back()->with('message', 'Category updated successfully');
    } 
    
    
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->back()->with('message', 'Category deleted successfully');
    }
}
