<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class InstructorController extends Controller
{
    public function index()
    {
        $instructors = User::where('role', 'instructor')->latest()->get();
        return view('admin.instructor.index', compact('instructors'));
    }

    public function update(Request $request, User $instructor)
    {
        $request->validate([
            'status' => 'required|in:1,0',
        ]);

        $instructor->update(['status' => $request->status]);

        return response([
            'status' => 'success',
            'message' => 'Instructor updated successfully'
        ], 201);
    }

    public function destroy(User $instructor)
    {
        $instructor->delete();
        return redirect()->back()->with('message', 'Instructor deleted successfully');
    }
}
