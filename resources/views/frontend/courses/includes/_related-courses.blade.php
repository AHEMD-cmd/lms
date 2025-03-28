@if ($relatedCourses->count() > 0)
    <section class="related-course-area bg-gray pt-60px pb-60px">
        <div class="container">
            <div class="related-course-wrap">
                <h3 class="fs-28 font-weight-semi-bold pb-35px">More Courses by <a
                        href="{{ route('instructors.show', $course->instructor->slug) }}"
                        class="text-color hover-underline">{{ $course->instructor->name }}</a></h3>
                <div class="view-more-carousel-2 owl-action-styled">

                    @foreach ($relatedCourses->take(6) as $instructorCourse)
                    @if ($loop->iteration == 2)
                            @break
                    @endif
                        <div class="card card-item">
                            <div class="card-image">
                                <a href="{{ route('courses.show', $course->slug) }}" class="d-block">
                                    <img class="card-img-top" src="{{ asset($instructorCourse->image) }}"
                                        alt="{{ $instructorCourse->title }}">
                                </a>
                                <div class="course-badge-labels">
                                    @if ($instructorCourse->bestseller)
                                        <div class="course-badge">Bestseller</div>
                                    @endif
                                    @if ($instructorCourse->discount)
                                        <div class="course-badge blue">-{{ $instructorCourse->discount_percentage }}%
                                        </div>
                                    @endif
                                </div>
                            </div><!-- end card-image -->

                            <div class="card-body">
                                <h6 class="ribbon ribbon-blue-bg fs-14 mb-3">{{ $instructorCourse->level }}</h6>
                                <h5 class="card-title"><a
                                        href="{{ route('categories.show', $instructorCourse->slug) }}">{{ $instructorCourse->name }}</a>
                                </h5>
                                <p class="card-text"><a
                                        href="{{ route('instructors.show', $instructorCourse->instructor->slug) }}">{{ $instructorCourse->instructor->name }}</a>
                                </p>
                                <div class="rating-wrap d-flex align-items-center py-2">
                                    <div class="review-stars">
                                        <span class="rating-number">4.4</span>
                                        <span class="la la-star"></span>
                                        <span class="la la-star"></span>
                                        <span class="la la-star"></span>
                                        <span class="la la-star"></span>
                                        <span class="la la-star-o"></span>
                                    </div>
                                    <span class="rating-total pl-1">(20,230)</span>
                                </div><!-- end rating-wrap -->
                                <div class="d-flex justify-content-between align-items-center">
                                    @if (!$instructorCourse->discount)
                                        <p class="card-price text-black font-weight-bold">
                                            ${{ $instructorCourse->price }} </p>
                                    @else
                                        <p class="card-price text-black font-weight-bold">
                                            ${{ $instructorCourse->discount }} <span
                                                class="before-price font-weight-medium">${{ $instructorCourse->price }}</span>
                                        </p>
                                    @endif

                                    @auth
                                        <div class="icon-element icon-element-sm shadow-sm cursor-pointer wishlist"
                                            data-id="{{ $instructorCourse->id }}" title="Add to Wishlist">
                                            <i
                                                class="la la-heart{{ auth()->user()->wishList->contains($instructorCourse->id) ? '' : '-o' }}"></i>
                                        </div>
                                    @endauth
                                </div>
                            </div><!-- end card-body -->
                        </div><!-- end card -->
                    @endforeach

                </div><!-- end view-more-carousel -->
            </div><!-- end related-course-wrap -->
        </div><!-- end container -->
    </section>
@endif
