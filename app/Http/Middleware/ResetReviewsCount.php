<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ResetReviewsCount
{
    public function handle(Request $request, Closure $next)
    {
        // Reset the session count when the user opens a course page
        session()->forget('reviewsCount');
        session(['reviewsCount' => 1]);

        return $next($request);
    }
}
