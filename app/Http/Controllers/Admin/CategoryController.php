<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\StoreCategoryRequest;
use App\Http\Requests\Admin\Category\UpdateCategoryRequest;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::tree()->get();
        return view('admin.category.index', compact('categories'));
    }

    public function create()
    {
        $categories = Category::tree()->get();
        return view('admin.category.create', compact('categories'));
    }

    public function store(StoreCategoryRequest $request)
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
        $categories = Category::tree()->where('id', '!=', $category->id)->get();
        return view('admin.category.edit', compact('category', 'categories'));
    }

    public function update(UpdateCategoryRequest $request, Category $category)
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
