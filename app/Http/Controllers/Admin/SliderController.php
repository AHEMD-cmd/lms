<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Slider\StoreSliderRequest;
use App\Http\Requests\Admin\Slider\UpdateSliderRequest;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::all();
        return view('admin.sliders.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.sliders.create');
    }

    public function store(StoreSliderRequest $request)
    {
        $data = $request->validated();
        
        if ($request->file('image')) {
            $data['image'] = uploadEditedPhoto($request->file('image'), 'sliders', [1920, 1027]);
        }

        Slider::create($data);

        return redirect()->route('admin.sliders.index')->with('message', 'Slider created successfully');
    }

    public function edit(Slider $slider)
    {
        return view('admin.sliders.edit', compact('slider'));
    }

    public function update(UpdateSliderRequest $request, Slider $slider)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = updateEditedPhoto($request->file('image'), 'sliders', $slider->image, [1920, 1027]);
        }

        $slider->update($data);

        return redirect()->route('admin.sliders.index')->with('message', 'Slider updated successfully');
    }

    public function destroy(Slider $slider)
    {
        $slider->delete();
        return redirect()->route('admin.sliders.index')->with('message', 'Slider deleted successfully');
    }
}
