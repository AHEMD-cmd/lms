<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {

            if (Auth::user()->role == 'user') {
                return redirect('/');
            }
            if (Auth::user()->role == 'instructor') {
                return redirect('/instructor/dashboard');
            }
            if (Auth::user()->role == 'admin') {
                return redirect('/admin/dashboard');
            }
        }

        return $next($request);
    }
}
