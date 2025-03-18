<?php

namespace App\Http\Controllers\Admin;

use App\Models\SmtpSetting;
use Illuminate\Http\Request;
use App\Http\Requests\SmtpRequest;
use App\Http\Controllers\Controller;

class SmtpSettingController extends Controller
{
    public function edit()
    {
        $smtp = SmtpSetting::first();
        return view('admin.smtp-settings.edit', compact('smtp'));
    }

    public function update(SmtpRequest $request)
    {
        $smtpSetting = SmtpSetting::firstOrCreate();
        $smtpSetting->update($request->validated());
        return redirect()->back()->with('message', 'SMTP settings updated successfully');
    }
}
