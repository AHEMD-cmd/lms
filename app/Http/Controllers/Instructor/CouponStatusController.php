<?php

namespace App\Http\Controllers\Instructor;

use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CouponStatusController extends Controller
{
    public function __invoke(Request $request, Coupon $coupon)
    {
        $request->validate([
            'is_active' => 'required|in:1,0',
        ]);

        $coupon->update(['is_active' => $request->is_active]);

        return response([
            'status' => 'success',
            'message' => 'Coupon updated successfully'
        ], 204);
    }
}
