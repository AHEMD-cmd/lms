<?php

namespace App\Rules;

use Closure;
use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\ValidationRule;

class InstructorMonthlyCouponLimit implements ValidationRule
{
    protected $discountPercentage;
    protected $instructorId;
    
    public function __construct($discountPercentage, $instructorId = null) 
    {
        $this->discountPercentage = (int) $discountPercentage;
        $this->instructorId = $instructorId ?? auth()->id();
    }
    
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Define allowed totals per discount percentage
        $allowedTotals = [
            100 => 1000,
            90 => 2000,
            50 => 3000,
        ];
        
        // If not a valid discount percentage, let other validation handle it
        if (!isset($allowedTotals[$this->discountPercentage])) {
            return;
        }
        
        $limitNumber = (int) $value;
        
        // Determine the current month's start and end
        $currentMonthStart = Carbon::now()->startOfMonth();
        $currentMonthEnd = Carbon::now()->endOfMonth();
        
        // Calculate the sum of limit_number for existing coupons this month
        $existingSum = Coupon::where('instructor_id', $this->instructorId)
            ->where('discount_percentage', $this->discountPercentage)
            ->whereBetween('created_at', [$currentMonthStart, $currentMonthEnd])
            ->sum('limit_number');
        
        // Calculate the total limit_number if the new coupon is added
        $totalLimitNumber = $existingSum + $limitNumber;
        
        // Check if the total exceeds the allowed limit
        if ($totalLimitNumber > $allowedTotals[$this->discountPercentage]) {
            $fail("The total limit number for {$this->discountPercentage}% discount coupons exceeds the monthly limit of {$allowedTotals[$this->discountPercentage]}.");
        }
    }
}