<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Cart;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Services\Cart\CartService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\Cart\ApplyCouponService;
use App\Http\Requests\Frontend\Cart\StoreCartRequest;
use App\Http\Requests\Frontend\Cart\UpdateCartRequest;

class CartController extends Controller
{
    public function index()
    {
        // Recommended courses (in same categories as course_users)
        $userCategoryIds = Auth::user()->studentCourses()
            ->distinct()
            ->pluck('category_id');

        $recommendedCourses = Course::whereIn('category_id', $userCategoryIds)
            ->whereNotIn('id', Auth::user()->studentCourses()->pluck('courses.id'))
            ->take(3)
            ->get();
        return view('frontend.cart.index', compact('recommendedCourses'));
    }

    public function store(StoreCartRequest $request)
    {
        Cart::create($request->validated());

        return response([
            'status' => 'success',
            'message' => 'Course added to cart successfully',
            'cartItemsNumber' => CartService::getCartData()->count(),
            'cartItems' => view('frontend.partials.header-cart')->with('cartItems', CartService::getCartData()->take(2))->render(),
        ], 201);
    }

    /**
     * Update the cart items by using the coupon and chnage the value of discounted_price for the items that the coupon can be applied on.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCartRequest $request)
    {
        $usedTimes = ApplyCouponService::applyCoupon($request);

        return response([
            'status' => 'success',
            'message' => 'Coupon applied successfully',
            'usedTimes' => $usedTimes,
            'headerCartItems' => view('frontend.partials.header-cart')->with('cartItems', CartService::getCartData()->take(2))->render(),
            'cartItems' => view('frontend.cart.includes.cart-area')->with('cartItems', CartService::getCartData())->render(),
        ], 201);
    }

    public function destroy(Request $request, Cart $cart)
    {
        $cart->delete();
        return response([
            'status' => 'success',
            'message' => 'Course removed from cart successfully',
            'cartItemsNumber' => CartService::getCartData()->count(),
            'cartItems' => view('frontend.cart.includes.cart-area')->with('cartItems', CartService::getCartData()->take(2))->render(),
            'headerCartItems' => view('frontend.partials.header-cart')->with('cartItems', CartService::getCartData())->render(),
        ], 200);
    }
}
