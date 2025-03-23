<?php

namespace App\Rules;

use Closure;
use App\Models\Coupon;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidCoupon implements ValidationRule
{
    protected $errorMessage = 'Invalid coupon code';

    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $coupon = Coupon::where('code', $value)->first();

        if (!$coupon) {
            $fail($this->errorMessage);
            return;
        }

        if (!$coupon->is_active || now()->lt($coupon->start_date) || now()->gt($coupon->end_date)) {
            $this->errorMessage = 'Coupon expired or inactive';
            $fail($this->errorMessage);
            return;
        }

        if ($coupon->limit && $coupon->time_used >= $coupon->limit) {
            $this->errorMessage = 'Coupon usage limit reached';
            $fail($this->errorMessage);
            return;
        }
    }
}