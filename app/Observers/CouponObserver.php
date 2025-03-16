<?php

namespace App\Observers;

use App\Models\Coupon;
use Illuminate\Support\Facades\DB;
use App\Services\Coupon\CouponService;

class CouponObserver
{
    public function created(Coupon $coupon)
    {
        if ($coupon->auto_applied) {
            if ($coupon->isValid()) {
                CouponService::applyCoupon($coupon);
            }
        }
    }

    public function updating(Coupon $coupon)
    {
        $coupon = Coupon::find($coupon->id); // to get the values in the database instead of the current values in the request
        CouponService::removeDiscount($coupon);
    }

    public function updated(Coupon $coupon)
    {
        if ($coupon->auto_applied) {
            if ($coupon->wasChanged(['discount_percentage', 'start_date', 'end_date', 'type', 'course_id', 'instructor_id'])) {
                if ($coupon->isValid()) {
                    CouponService::applyCoupon($coupon); // apply new discount
                }
            }
        }
    }

    public function deleted(Coupon $coupon)
    {
        CouponService::removeDiscount($coupon);
    }
}
