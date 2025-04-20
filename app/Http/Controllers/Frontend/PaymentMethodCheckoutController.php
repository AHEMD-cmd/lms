<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Services\Cart\CartService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\Payment\PaymentHandler;
use App\Services\payment\BuyCourseService;

class PaymentMethodCheckoutController extends Controller
{
    protected $buyCourseService;

    public function __construct(BuyCourseService $buyCourseService)
    {
        $this->buyCourseService = $buyCourseService;
    }

    public function index()
    {
        return view("frontend.checkout.show");
    }

    public function post(Request $request)
    {
        $this->buyCourseService->purchase($request);
        return redirect()->route('home')->with('message', 'Payment successful!');
    }
}
