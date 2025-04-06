<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Course;

class EnsureCourseOwner
{
    public function handle(Request $request, Closure $next)
    {
        $course = $request->route('course');

        if (auth()->user()->id !== $course->instructor_id) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}
