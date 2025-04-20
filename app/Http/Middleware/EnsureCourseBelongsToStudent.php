<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureCourseBelongsToStudent
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('message', 'Please login to access this course');
        }


        $courseId = $request->input('course_id') ? $request->input('course_id') : request()->route('course')->id;

        if (!$courseId || !is_numeric($courseId)) {
            return redirect()->back()
                ->with('message', 'Invalid course ID');
        }

        $user = Auth::user();
        $hasCourse = $user->studentCourses()->where('courses.id', $courseId)->exists();

        if (!$hasCourse) {
            return redirect()->back()
                ->with('message', 'You do not have access to this course');
        }

        return $next($request);
    }
}
