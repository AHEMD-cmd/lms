<?php

namespace App\Http\Controllers\Student;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Admin\ProfileRequest;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('student.profile.edit');
    }

    public function update(ProfileRequest $request)
    {
        $data = $request->validated();

        if ($request->file('photo')) {
            $data['photo'] = updatePhoto($request->file('photo'), 'students', Auth::user()->photo);
        }

        Auth::user()->update($data);

        return redirect()->back()->with('message', 'Profile updated successfully');
    }

    public function changePassword()
    {
        return view('student.profile.change-password');
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

        return back()->with('message', 'Password updated successfully');
    } 
}
