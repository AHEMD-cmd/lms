<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class UserArchiveCourseController extends Controller
{
    public function update(Request $request, $courseId)
    {

        auth()->user()->studentCourses()->syncWithoutDetaching([
            $courseId => [
                'is_archived' => DB::raw('NOT is_archived'),
                'archived_at' => now()
            ]
        ]);

        $archivedCourses = auth()->user()->studentCourses()->where('is_archived', true)->get();

        return response()->json([
            'success' => true,
            'archivedCourses' => view('frontend.user-courses.includes.archived', compact('archivedCourses'))->render()
        ]);
    }
}
