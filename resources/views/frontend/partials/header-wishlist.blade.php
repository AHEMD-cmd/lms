
    @foreach ($wishlistedCourses as $course)
        <li>
            <div class="media media-card">
                <a href="course-details.html" class="media-img">
                    <img class="mr-3" src="{{ asset($course->image) }}"
                        alt="Cart image">
                </a>
                <div class="media-body">
                    <h5><a
                            href="course-details.html">{{ $course->name }}</a>
                    </h5>
                    <span
                        class="d-block lh-18 py-1">{{ $course->instructor->name }}</span>
                    @if ($course->discount)
                        <p class="text-black font-weight-semi-bold lh-18">
                            {{ $course->discount }}
                            <span
                                class="before-price fs-14">{{ $course->price }}</span>
                        </p>
                    @else
                        <span
                            class="before-price fs-14">{{ $course->price }}</span>
                    @endif
                </div>
            </div>
            <a href="#"
                class="btn theme-btn theme-btn-sm theme-btn-transparent lh-28 w-100 mt-3">Add
                to cart <i class="la la-arrow-right icon ml-1"></i></a>
        </li>
    @endforeach
    <li>
        <a href="{{ route('wish.list.index') }}"
            class="btn theme-btn w-100">Got to wishlist <i
                class="la la-arrow-right icon ml-1"></i></a>
    </li>
