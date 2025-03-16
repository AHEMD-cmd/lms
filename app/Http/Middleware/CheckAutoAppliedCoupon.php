<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Coupon;

class CheckAutoAppliedCoupon
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->auto_applied) {
            $query = Coupon::where('auto_applied', true);

            // Exclude current coupon when updating
            if ($request->route('coupon')) {
                $query->where('id', '!=', $request->route('coupon')->id);
            }

            if ($request->type === 'platform') {
                $exists = $query->where('type', 'platform')->exists();
            } elseif ($request->type === 'instructor' && $request->instructor_id) {
                $exists = $query->where('type', 'instructor')->where('instructor_id', $request->instructor_id)->exists();
            } elseif ($request->type === 'course' && $request->course_id) {
                $exists = $query->where('type', 'course')->where('course_id', $request->course_id)->exists();
            } else {
                $exists = false;
            }

            if ($exists) {
                return redirect()->back()->with('error', 'Only one auto-applied coupon is allowed for this type.');
            }
        }

        return $next($request);
    }
}
