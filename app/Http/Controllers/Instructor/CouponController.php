<?php

namespace App\Http\Controllers\Instructor;


use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;
use App\Http\Controllers\Controller;
use App\Http\Requests\Instructor\Coupon\StoreCouponRequest;
use App\Http\Requests\Instructor\Coupon\UpdateCouponRequest;

class CouponController extends Controller
{
    public function __construct()
    {
        $this->middleware('check.auto.coupon')->only('store', 'update');
    }

    public function index()
    {
        $coupons = Coupon::byInstructor()->paginate(10);
        return view('instructor.coupons.index', compact('coupons'));
    }

    public function create()
    {
        $courses = auth()->user()->courses;
        return view('instructor.coupons.create', compact('courses'));
    }
    
    public function store(StoreCouponRequest $request)
    {
        Coupon::create($request->validated());
        return redirect()->route('instructor.coupons.index')->withMessage('Coupon created successfully');
    }
    
    public function edit(Coupon $coupon)
    {
        $courses = auth()->user()->courses;
        return view('instructor.coupons.edit', compact('coupon', 'courses'));
    }

    public function update(UpdateCouponRequest $request, Coupon $coupon)
    {
        $coupon->update($request->validated());
        return redirect()->route('instructor.coupons.index')->withMessage('Coupon updated successfully');
    }

    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
        return redirect()->route('instructor.coupons.index')->withMessage('Coupon deleted successfully');
    }

    public function updateStatus(Request $request, Coupon $coupon)
    {
        $request->validate([
            'is_active' => 'required|in:1,0',
        ]);

        $coupon->update(['is_active' => $request->is_active]);

        return response([
            'status' => 'success',
            'message' => 'Coupon updated successfully'
        ], 201);
    }
}
