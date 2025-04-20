<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class UserFavoriteCourseController extends Controller
{
    public function update(Request $request, $courseId)
    {

        auth()->user()->studentCourses()->syncWithoutDetaching([
            $courseId => [
                'is_favorite' => DB::raw('NOT is_favorite'),
                'favorited_at' => now()
            ]
        ]);

        return response()->json([
            'success' => true,
        ]);
    }
}
