<?php

namespace App\Http\Controllers\Admin;

use App\Models\Feature;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Feature\StoreFeatureRequest;
use App\Http\Requests\Admin\Feature\UpdateFeatureRequest;

class FeatureController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $features = Feature::all();
        return view('admin.features.index', compact('features'));
    }

    public function create()
    {   
        return view('admin.features.create');
    }

    public function store(StoreFeatureRequest $request)
    {
        Feature::create($request->validated());

        return redirect()->route('admin.features.index')->with('message', 'Feature created successfully.');
    }

    public function show(Feature $feature)
    {
        return view('admin.features.show', compact('feature'));
    }

    public function edit(Feature $feature)
    {
        return view('admin.features.edit', compact('feature'));
    }

    public function update(UpdateFeatureRequest $request, Feature $feature)
    {
        $feature->update($request->validated());

        return redirect()->route('admin.features.index')->with('message', 'Feature updated successfully.');
    }

    public function destroy(Feature $feature)
    {
        $feature->delete();
        return redirect()->route('admin.features.index')->with('message', 'Feature deleted successfully.');
    }
}