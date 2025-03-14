<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Cart;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PreventDuplicateCartItem
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $cartItem = Cart::where(['course_id' => $request->course_id, 'session_id' => session()->getId()])->first();

        if ($cartItem) {
            return response([
                'status' => 'error',
                'message' => 'Course already added to cart',
            ], 400);
        }

        return $next($request);
    }
}
