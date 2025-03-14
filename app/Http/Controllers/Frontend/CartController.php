<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Services\Cart\CartService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\Cart\StoreCartRequest;

class CartController extends Controller
{

    public function __construct(CartService $cart)
    {
        $this->middleware('PreventDuplicateCartItem')->only('store');
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
            'cartItems' => view('frontend.partials.header-cart')->with('cartItems', CartService::getCartData())->render(),
        ], 201);
    }

    public function destroy(Request $request, Cart $cart)
    {
        $cart->delete();

        return response([
            'status' => 'success',
            'message' => 'Course removed from cart successfully',
            'cartItemsNumber' => CartService::getCartData()->count(),
            'cartItems' => view('frontend.partials.header-cart')->with('cartItems', CartService::getCartData())->render(),
        ], 200);
    }
}
