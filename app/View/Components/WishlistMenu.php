<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class WishlistMenu extends Component
{
    public $wishlistedCourses;

    public function __construct()
    {
        $this->wishlistedCourses = Auth::check() ? auth()->user()->wishList : [];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.wishlist-menu');
    }
}
