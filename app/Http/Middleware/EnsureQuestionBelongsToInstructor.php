<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;

class EnsureQuestionBelongsToInstructor
{
    public function handle(Request $request, Closure $next): Response
    {
        $question = $request->route('question');
        $quiz = $request->route('quiz');

        if ($quiz->lecture->course->instructor_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        if (!in_array($question->id, $quiz->questions->pluck('id')->toArray())) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}
