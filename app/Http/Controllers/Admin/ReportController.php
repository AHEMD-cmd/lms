<?php

namespace App\Http\Controllers\Admin;

use App\Models\Course;
use App\Models\Report;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    public function index(Course $course)
    {
        $course->load('reports', 'reports.user', 'reports.review');
        return view('admin.reports.index', compact('course'));
    }

    public function show(Course $course, Report $report)
    {
        $report->load('user', 'review');
        return view('admin.reports.show', compact('report', 'course'));
    }

    public function destroy(Course $course, Report $report)
    {
        $report->delete();
        return redirect()->route('admin.courses.reports.index', $course->slug)->with('success', 'Report deleted successfully');
    }
}
