<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Lecture;

class EnsureLectureOwner
{
    public function handle(Request $request, Closure $next)
    {
        $lecture = $request->route('lecture');

        if (auth()->id() !== $lecture->course->instructor_id) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}
