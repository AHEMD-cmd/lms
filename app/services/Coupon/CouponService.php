<?php

namespace App\Services\Coupon;

use App\Models\Coupon;
use App\Models\Course;
use Illuminate\Support\Facades\DB;

/**
 * Class CouponService
 * @package App\Services\Cart
 *
 * This class is responsible for applying and removing discounts from courses based on auto_applied coupon.
 */
class CouponService
{
    /**
     * Apply discount to courses based on auto_applied coupon 
     *
     * @param Coupon $coupon
     */
    public static function applyCoupon(Coupon $coupon)
    {
        $discountQuery = DB::raw("price - (price * {$coupon->discount_percentage} / 100)");

        if ($coupon->type === 'course' && $coupon->course_id) {
            $course = Course::find($coupon->course_id);
            if ($course) {
                $course->discount = self::calculateDiscountedPrice($course->price, $coupon->discount_percentage);
                $course->save();
            }
        } elseif ($coupon->type === 'instructor' && $coupon->instructor_id) {
            Course::where('instructor_id', $coupon->instructor_id)
                ->update(['discount' => $discountQuery]);
        } elseif ($coupon->type === 'platform') {
            Course::whereNotNull('id')
                ->update(['discount' => $discountQuery]);
        }
    }


    /**
     * Remove discount from courses based on auto_applied coupon 
     *
     * @param Coupon $coupon
     */
    public static function removeDiscount(Coupon $coupon)
    {
        if ($coupon->type === 'course' && $coupon->course_id) {
            Course::where('id', $coupon->course_id)->update(['discount' => null]);
        } elseif ($coupon->type === 'instructor' && $coupon->instructor_id) {
            Course::where('instructor_id', $coupon->instructor_id)->update(['discount' => null]);
        } elseif ($coupon->type === 'platform') {
            Course::whereNotNull('id')->update(['discount' => null]);
        }
    }


    /**
     * Calculate discounted price based on given price and discount percentage
     *
     * @param $price
     * @param $discount
     * @return float
     */
    private static function calculateDiscountedPrice($price, $discount)
    {
        return $price - ($price * $discount / 100);
    }
}
