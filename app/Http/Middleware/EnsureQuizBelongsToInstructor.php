<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Quiz;
use Illuminate\Support\Facades\Auth;

class EnsureQuizBelongsToInstructor
{
    public function handle(Request $request, Closure $next): Response
    {
        $quiz = $request->route('quiz');
        $quiz->load('lecture.course');

        if ($quiz->lecture->course->instructor_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}
