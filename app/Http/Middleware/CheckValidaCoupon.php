<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckValidaCoupon
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $coupon = Coupon::where('code', $request->code)->first();

        if (!$coupon) {
            return response()->json(['error' => 'Invalid coupon code'], 400);
        }

        if (!$coupon->is_active || now()->lt($coupon->start_date) || now()->gt($coupon->end_date)) {
            return response()->json(['error' => 'Coupon expired or inactive'], 400);
        }

        if ($coupon->limit && $coupon->time_used >= $coupon->limit) {
            return response()->json(['error' => 'Coupon usage limit reached'], 400);
        }
        return $next($request);
    }
}
