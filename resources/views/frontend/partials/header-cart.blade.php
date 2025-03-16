<li>
    <p class="shop-cart-btn d-flex align-items-center">
        <i class="la la-shopping-cart fs-22"></i>
        <span class="product-count">{{ $cartItems->count() }}</span>
    </p>
    <ul class="cart-dropdown-menu after-none">
        @foreach ($cartItems->take(2) as $cartItem)
            <li class="media media-card">
                <a href="{{ route('courses.show', $cartItem->course->slug) }}" class="media-img">
                    <img class="mr-3" src="{{ asset($cartItem->course->image) }}" alt="{{ $cartItem->course->title }}">
                </a>
                <div class="media-body">
                    <h5><a href="shopping-cart.html">{{ $cartItem->course->title }}</a></h5>
                    <span class="d-block lh-18 py-1">{{ $cartItem->course->instructor->name }}</span>
                    @if ($cartItem->course->discount)
                        <p class="text-black font-weight-semi-bold lh-18">{{ $cartItem->course->discount }} <span
                                class="before-price fs-14">{{ $cartItem->course->price }}</span>
                        </p>
                    @else
                        <p class="text-black font-weight-semi-bold lh-18">{{ $cartItem->course->price }}</p>
                    @endif
                </div>
            </li>
        @endforeach

        <li>
            <a href="{{ route('carts.index') }}" class="btn theme-btn w-100">Got to cart
                <i class="la la-arrow-right icon ml-1"></i></a>
        </li>

        <li class="media media-card">
            <div class="media-body fs-16">
                @if ($cartItems->sum('discounted_price') < $cartItems->sum('price'))
                    <p class="text-black font-weight-semi-bold lh-18">Total: <span
                            class="cart-total">${{ $cartItems->sum('discounted_price') }}</span> <span
                            class="before-price fs-14">${{ $cartItems->sum('price') }}</span></p>
                @else
                    <p class="text-black font-weight-semi-bold lh-18">Total: <span
                            class="cart-total">${{ $cartItems->sum('price') }}</span></p>
                @endif
            </div>
        </li>
    </ul>
</li>
