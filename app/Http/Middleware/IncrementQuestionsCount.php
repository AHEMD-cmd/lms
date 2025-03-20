<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IncrementQuestionsCount
{
    public function handle(Request $request, Closure $next)
    {
        if (!request()->isFilter) {
            $currentCount = session('questionsCount', 1);
            session(['questionsCount' => $currentCount + 1]);
        }

        return $next($request);
    }
}
