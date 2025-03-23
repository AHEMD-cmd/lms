<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Services\Cart\CartService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\Cart\StoreCartRequest;
use App\Services\Cart\ApplyCouponService;

class CartController extends Controller
{

    public function __construct(CartService $cart)
    {
        // $this->middleware('PreventDuplicateCartItem')->only('store');
        $this->middleware('CheckValidaCoupon')->only('update');
    }

    public function index()
    {
        return view('frontend.cart.index');
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
     * Update the cart items by using the coupon and chnage the value of discounted_price.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $usedTimes = ApplyCouponService::applyCoupon($request);

        return response([
            'status' => 'success',
            'message' => 'Coupon applied successfully',
            'usedTimes' => $usedTimes,
            'headerCartItems' => view('frontend.partials.header-cart')->with('cartItems', CartService::getCartData()->take(2))->render(),
            'cartItems' => view('frontend.cart.includes.cart-items')->with('cartItems', CartService::getCartData())->render(),
        ], 201);
    }
    
    public function destroy(Request $request, Cart $cart)
    {
        $cart->delete();
        return response([
            'status' => 'success',
            'message' => 'Course removed from cart successfully',
            'cartItemsNumber' => CartService::getCartData()->count(),
            'cartItems' => view('frontend.cart.includes.cart-items')->with('cartItems', CartService::getCartData()->take(2))->render(),
            'headerCartItems' => view('frontend.partials.header-cart')->with('cartItems', CartService::getCartData())->render(),
        ], 200);
    }
}
