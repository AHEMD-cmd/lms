<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use App\Http\Requests\Admin\ProfileRequest;

class ProfileController extends Controller
{


    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        return view('admin.profile.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProfileRequest $request)
    {
        $data = $request->validated();

        if ($request->file('photo')) {
            $data['photo'] = updatePhoto($request->file('photo'), 'admin', Auth::user()->photo);
        }

        Auth::user()->update($data);

        return redirect()->back()->with('success', 'Profile updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function changePassword()
    {
        return view('admin.profile.change-password');
    }

    public function changePasswordUpdate(Request $request)
    {

        /// Validation 
        $request->validate([
            'current_password' => 'required|current_password',
            'password' => 'required|string|min:8|confirmed',
        ]);

        /// Update The new Password 
        User::whereId(auth::user()->id)->update([
            'password' => Hash::make($request->password)
        ]);

        return back()->with('success', 'Password updated successfully');
    } 
}
