<?php

namespace App\Http\Middleware;

use Closure;
use App\Services\Cart\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutAccessMiddleware
{
    
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check()) {
            return redirect()->route('login')
                ->with('message', 'Please login to complete your checkout');
        }
        
        // Associate cart with user
        $cartItems = CartService::getCartData();
        $cartItems->each(function ($item) {
            $item->user_id = Auth::user()->id;
            $item->save();
        });
        return $next($request);
    }
}