<?php

namespace App\Jobs;

use App\Models\Coupon;
use Illuminate\Bus\Queueable;
use App\Services\Coupon\CouponService;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class CheckAutoAppliedCoupons implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $coupons = Coupon::where('auto_applied', true)->get();

        foreach ($coupons as $coupon) {
            if ($coupon->isValid()) {
                CouponService::applyCoupon($coupon);
            } else {
                CouponService::removeDiscount($coupon);
            }
        }
    }
}
