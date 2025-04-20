@foreach ($wishlistedCourses->take(2) as $course)
    <li>
        <div class="media media-card">
            <a href="/courses/{{ $course->slug }}" class="media-img">
                <img class="mr-3" src="{{ asset($course->image) }}" alt="{{ $course->title }}">
            </a>
            <div class="media-body">
                <h5><a href="course-details.html">{{ $course->title }}</a></h5>
                <span class="d-block lh-18 py-1">{{ $course->instructor->name }}</span>
                @if ($course->discount)
                    <p class="text-black font-weight-semi-bold lh-18">
                        {{ $course->discount }}
                        <span class="before-price fs-14">{{ $course->price }}</span>
                    </p>
                @else
                    <p class="text-black font-weight-semi-bold lh-18">
                        {{ $course->price }}
                    </p>
                @endif
            </div>
        </div>
        {{-- <a href="#"
                class="btn theme-btn theme-btn-sm theme-btn-transparent lh-28 w-100 mt-3">Add
                to cart <i class="la la-arrow-right icon ml-1"></i></a> --}}

        {{-- <button    
            href="{{ in_array($course->id, $cartItems->pluck('course_id')->toArray()) ? route('carts.index') : '' }}"
            class="btn theme-btn theme-btn-sm theme-btn-transparent lh-28 w-100 mt-3 {{ !in_array($course->id, $cartItems->pluck('course_id')->toArray()) ? 'add-to-cart' : '' }}"
            data-course-id="{{ $course->id }}"><i class="la la-shopping-cart mr-1 fs-18"></i>
            {{ in_array($course->id, $cartItems->pluck('course_id')->toArray()) ? 'Go to Cart' : 'Add to Cart' }}</button> --}}


    </li>
@endforeach
@if ($wishlistedCourses->count() > 0)
    <li class="header-go-to-wishlist">
        <a href="{{ route('users.courses.index', auth()->user()->id) }}#wishlist" class="btn theme-btn w-100">Got to wishlist <i
                class="la la-arrow-right icon ml-1"></i></a>
    </li>
@else
    <li class="explore-courses" style="{{ $wishlistedCourses->count() > 0 ? 'display: none;' : '' }}">
        <div style="text-align: center;">your wishlist is empty</div>
        <a href="/" class="btn theme-btn w-100">Explore Courses <i
                class="la la-arrow-right icon ml-1"></i></a>
    </li>
@endif
