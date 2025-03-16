<?php

namespace App\Http\Controllers\Admin;

use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Coupon\StoreCouponRequest;
use App\Http\Requests\Admin\Coupon\UpdateCouponRequest;

class CouponController extends Controller
{
    public function __construct()
    {
        $this->middleware('check.auto.coupon')->only('store', 'update');
    }

    public function index()
    {
        $coupons = Coupon::paginate(10);
        return view('admin.coupons.index', compact('coupons'));
    }

    public function create()
    {
        $instructors = User::where('role', 'instructor')->get();
        return view('admin.coupons.create', compact('instructors'));
    }

    public function store(StoreCouponRequest $request)
    {
        Coupon::create($request->validated());
        return redirect()->route('admin.coupons.index')->withMessage('Coupon created successfully');
    }
    public function edit(Coupon $coupon)
    {
        $instructors = User::where('role', 'instructor')->get();
        $courses = $coupon->course_id ? Course::all() : [];
        return view('admin.coupons.edit', compact('coupon', 'instructors', 'courses'));
    }

    public function update(UpdateCouponRequest $request, Coupon $coupon)
    {
        $coupon->update($request->validated());
        return redirect()->route('admin.coupons.index')->withMessage('Coupon updated successfully');
    }

    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
        return redirect()->route('admin.coupons.index')->withMessage('Coupon deleted successfully');
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
