<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admin\Setting\UpdateSettingRequest;

class SettingController extends Controller
{
    public function edit()
    {
        $settings = Setting::firstOrCreate([]);
        return view('admin.settings.edit', compact('settings'));
    }

    public function update(UpdateSettingRequest $request)
    {
        $settings = Setting::firstOrCreate([]);

        $data = $request->validated();

        if ($request->hasFile('logo')) {
            $data['logo'] = UpdateEditedPhoto($request->file('logo'), 'logos', $settings->logo, [120, 120]);
        }

        if ($request->hasFile('footer_logo')) {
            $data['footer_logo'] = UpdateEditedPhoto($request->file('footer_logo'), 'logos', $settings->footer_logo, [120, 120]);
        }

        if ($request->hasFile('about_us_big_image')) {
            $data['about_us_big_image'] = UpdateEditedPhoto($request->file('about_us_big_image'), 'about_us', $settings->about_us_big_image, [510, 340]);
        }

        if ($request->hasFile('about_us_small_image')) {
            $data['about_us_small_image'] = UpdateEditedPhoto($request->file('about_us_small_image'), 'about_us', $settings->about_us_small_image, [510, 340]);
        }
        $settings->update($data);

        return redirect()->route('admin.settings.edit')->with('success', 'Settings updated successfully.');
    }
}