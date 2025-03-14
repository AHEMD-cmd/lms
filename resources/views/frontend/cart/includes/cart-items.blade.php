<section class="cart-area section-padding">
    <div class="container">
        <div class="table-responsive">
            <table class="table generic-table">
                <thead>
                    <tr>
                        <th scope="col">Image</th>
                        <th scope="col">Course Details</th>
                        <th scope="col">Price</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($cartItems as $item)
                        <tr>
                            <th scope="row">
                                <div class="media media-card">
                                    <a href="{{ route('courses.show', $item->course->slug) }}" class="media-img mr-0">
                                        <img src="{{ asset($item->course->image) }}" alt="{{ $item->course->title }}">
                                    </a>
                                </div>
                            </th>
                            <td>
                                <a href="{{ route('courses.show', $item->course->slug) }}"
                                    class="text-black font-weight-semi-bold">{{ $item->course->title }}</a>
                                <p class="fs-14 text-gray lh-20">By <a href="teacher-detail.html"
                                        class="text-color hover-underline">{{ $item->course->instructor->name }}</a>,
                                    {{ $item->course->category->name }}:
                                    {{ Str::limit($item->course->short_description, 100, '...') }}
                                </p>
                            </td>
                            <td>
                                <ul class="generic-list-item font-weight-semi-bold">
                                    @if ($item->course->discount)
                                        <li class="text-black lh-18">${{ $item->course->discount }}</li>
                                        <li class="before-price lh-18">${{ $item->course->price }}</li>
                                    @else
                                        <li class="text-black lh-18">${{ $item->course->price }}</li>
                                    @endif
                                </ul>
                            </td>

                            <td>
                                <button type="button" class="icon-element icon-element-xs shadow-sm border-0"
                                    data-toggle="tooltip" data-placement="top"
                                    data-cart-id="{{ $item->id }}">
                                    <i class="la la-times"></i>
                                </button>


                            </td>
                        </tr>

                    @empty

                        <tr>
                            <td colspan="4" class="text-center">
                                <i class="la la-frown-o fs-30 text-gray mb-3"></i>
                                <p class="text-gray mb-0">Empty Cart Explore Our Courses</p>
                            </td>
                        </tr>
                    @endforelse
                    <tr style="display: none;" class="empty-cart">
                        <td colspan="4" class="text-center">
                            <i class="la la-frown-o fs-30 text-gray mb-3"></i>
                            <p class="text-gray mb-0">Empty Cart Explore Our Courses</p>
                        </td>
                    </tr>


                </tbody>
            </table>
            @if (count($cartItems) > 0)
                <div class="d-flex flex-wrap align-items-center justify-content-between pt-4 hide-empty-cart">
                    <form method="post">
                        <div class="input-group mb-2">
                            <input class="form-control form--control pl-3" type="text" name="search"
                                placeholder="Coupon code">
                            <div class="input-group-append">
                                <button class="btn theme-btn">Apply Code</button>
                            </div>
                        </div>
                    </form>
                    <a href="#" class="btn theme-btn mb-2">Update Cart</a>
                </div>
            @endif

        </div>

        @if (count($cartItems) > 0)
            <div class="col-lg-4 ml-auto hide-empty-cart">
                <div class="bg-gray p-4 rounded-rounded mt-40px">
                    <h3 class="fs-18 font-weight-bold pb-3">Cart Totals</h3>
                    <div class="divider"><span></span></div>
                    <ul class="generic-list-item pb-4">
                        <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                            <span class="text-black">Subtotal:</span>
                            <span>$44.99</span>
                        </li>
                        <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                            <span class="text-black">Total:</span>
                            <span>$44.99</span>
                        </li>
                    </ul>
                    <a href="checkout.html" class="btn theme-btn w-100">Checkout <i
                            class="la la-arrow-right icon ml-1"></i></a>
                </div>
            </div>
        @endif
    </div><!-- end container -->
</section>
