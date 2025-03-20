<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Coupon;
use Carbon\Carbon;

class CheckCouponLimits
{
    public function handle(Request $request, Closure $next)
    {
        // Ensure the user is authenticated
        $user = auth()->user();
        if (!$user) {
            abort(403, 'Unauthorized');
        }

        // Get discount_percentage and limit_number from the request
        $discountPercentage = $request->input('discount_percentage');
        $limitNumber = $request->input('limit_number');

        // If inputs are invalid, proceed to let validation handle it
        if (!in_array($discountPercentage, ['100', '90', '50']) || !is_numeric($limitNumber)) {
            return $next($request);
        }

        // Cast inputs to integers
        $discountPercentage = (int) $discountPercentage;
        $limitNumber = (int) $limitNumber;

        // Define allowed totals per discount percentage
        $allowedTotals = [
            100 => 1000,
            90 => 2000,
            50 => 3000,
        ];

        // Determine the current month's start and end
        $currentMonthStart = Carbon::now()->startOfMonth();
        $currentMonthEnd = Carbon::now()->endOfMonth();

        // Calculate the sum of limit_number for existing coupons this month
        $existingSum = Coupon::where('instructor_id', $user->id)
            ->where('discount_percentage', $discountPercentage)
            ->whereBetween('created_at', [$currentMonthStart, $currentMonthEnd])
            ->sum('limit_number');

        // Calculate the total limit_number if the new coupon is added
        $totalLimitNumber = $existingSum + $limitNumber;

        // Check if the total exceeds the allowed limit
        if ($totalLimitNumber > $allowedTotals[$discountPercentage]) {
            return redirect()->back()->withErrors([
                'limit_number' => "The total limit number for {$discountPercentage}% discount coupons exceeds the monthly limit of {$allowedTotals[$discountPercentage]}."
            ]);
        }

        // If within limits, proceed with the request
        return $next($request);
    }
}
