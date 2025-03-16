<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InstructorCourseController extends Controller
{
    public function index(User $instructor)
    {
        $courses = $instructor->courses;
        return response([
            'courses' => $courses
        ], 200);
    }
}
