<?php

namespace App\Services\Cart;

use App\Models\Cart;
use App\Models\Coupon;
use Illuminate\Http\Request;

class ApplyCouponService    
{
    public static function applyCoupon(Request $request)
    {
        $coupon = Coupon::where('code', $request->code)->first();

        $cartItems = CartService::getCartData();
        $usedTimes = 0; // the number of times the coupon is used
        foreach ($cartItems as $course) {
            if (
                $coupon->type == 'platform' ||
                ($coupon->type == 'instructor' && $course->instructor_id == $coupon->instructor_id) ||
                ($coupon->type == 'course' && $course->id == $coupon->course_id)
            ) {
                $usedTimes++;
                $course->update([
                    'discounted_price' => $course->price - ($course->price * ($coupon->discount_percentage / 100))
                ]);
            }
        }
        return $usedTimes;
    }
}
