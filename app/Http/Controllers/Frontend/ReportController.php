<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Course;
use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\Report\StoreReportRequest;

class ReportController extends Controller
{
    public function store(StoreReportRequest $request, Course $course)
    {
        $course->reports()->create($request->validated());

        return response([
            'message' => 'Report created successfully',
        ], 201);
    }
}
