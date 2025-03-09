<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\Instructor\StoreInstructorRequest;

class InstructorController extends Controller
{
    public function create()
    {
        return view('frontend.instructor.create');
    }

    public function store(StoreInstructorRequest $request)
    {
        User::updateOrCreate(['email' => $request->email], $request->validated());

        return response([
            'status' => 'success',
            'message' => 'Instructor created successfully'
        ], 201);
    }
}
