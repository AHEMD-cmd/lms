<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Section;

class EnsureSectionOwner
{
    public function handle(Request $request, Closure $next)
    {
        $section = $request->route('section');

        if (auth()->user()->id !== $section->course->instructor_id) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}
