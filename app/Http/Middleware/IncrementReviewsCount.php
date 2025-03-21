<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IncrementReviewsCount
{
    public function handle(Request $request, Closure $next)
    {
        if (request()->loadMore) {
            $currentCount = session('reviewsCount', 1);
            session(['reviewsCount' => $currentCount + 1]);
        }

        return $next($request);
    }
}
