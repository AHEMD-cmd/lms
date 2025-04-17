<?php

namespace App\Services\payment;

use App\Models\Cart;
use Illuminate\Support\Str;
use App\Services\Cart\CartService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class BuyCourseService
{
    public static function purchase(Request $request)
    {
        $cartItems = CartService::getCartData();
        $amount = $cartItems->sum('discounted_price');

        $payment = Auth::user()->charge($amount, $request->payment_method_id, [
            'return_url' => route('home', ['message' => 'Payment successful!']),
            'metadata' => [
                'cart_session_id' => $cartItems->first()->session_id,
                'user_id' => Auth::user()->id
            ]
        ]);

        foreach ($cartItems as $item) {
            $course = $item->course;
            $userId = Auth::user()->id;

            // Attach course to user (give access)
            $course->users()->syncWithoutDetaching([$userId]);
        }

        // Clear the cart
        Cart::where('session_id', $cartItems->first()->session_id)->delete();
    }
}
