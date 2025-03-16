<?php

namespace App\Console\Commands;

use App\Models\Coupon;
use Illuminate\Console\Command;
use App\Services\Coupon\CouponService;


class ApplyAutoCoupons extends Command
{
    protected $signature = 'coupons:apply-auto';
    protected $description = 'Automatically apply or remove coupons every minute';

    public function handle()
    {
        $coupons = Coupon::where('auto_applied', true)->get();

        foreach ($coupons as $coupon) {
            if ($coupon->isValid()) {
                CouponService::applyCoupon($coupon);
            } else {
                CouponService::removeDiscount($coupon);
            }
        }

        $this->info('Auto-applied coupons processed.');
    }
}
