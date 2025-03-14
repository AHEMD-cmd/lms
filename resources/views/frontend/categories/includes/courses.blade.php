<div class="col-lg-8">
    <div class="row">
        @foreach ($courses as $course)
            <div class="col-lg-6 responsive-column-half">
                <div class="card card-item card-preview" data-tooltip-content="#tooltip_content_{{ $course->id }}">
                    <div class="card-image">
                        <a href="{{ route('courses.show', $course->slug) }}" class="d-block">
                            <img class="card-img-top lazy" src="{{ asset($course->image) }}"
                                data-src="{{ asset($course->image) }}" alt="{{ $course->title }}">
                        </a>

                        <div class="course-badge-labels">
                            @if ($course->bestseller)
                                <div class="course-badge">Bestseller</div>
                            @endif

                            @if ($course->discount)
                                <div class="course-badge blue">-{{ $course->discount_percentage }}%</div>
                            @endif
                        </div>
                    </div><!-- end card-image -->
                    <div class="card-body">
                        <h6 class="ribbon ribbon-blue-bg fs-14 mb-3">{{ $course->level }}</h6>
                        <h5 class="card-title"><a
                                href="{{ route('categories.show', $course->slug) }}">{{ $course->name }}</a>
                        </h5>
                        <p class="card-text"><a
                                href="{{ route('instructors.show', $course->instructor->slug) }}">{{ $course->instructor->name }}</a>
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
                            @if (!$course->discount)
                                <p class="card-price text-black font-weight-bold">
                                    ${{ $course->price }} </p>
                            @else
                                <p class="card-price text-black font-weight-bold">
                                    ${{ $course->discount }} <span
                                        class="before-price font-weight-medium">${{ $course->price }}</span>
                                </p>
                            @endif

                            @auth
                                <div class="icon-element icon-element-sm shadow-sm cursor-pointer wishlist"
                                    data-id="{{ $course->id }}" title="Add to Wishlist">
                                    <i
                                        class="la la-heart{{ auth()->user()->wishList->contains($course->id) ? '' : '-o' }}"></i>
                                </div>
                            @endauth
                        </div>
                    </div><!-- end card-body -->
                </div><!-- end card -->
            </div><!-- end col-lg-6 -->
        @endforeach
    </div><!-- end row -->


    <div class="text-center pt-3">
        {{ $courses->links() }}
        <p class="fs-14 pt-2">Showing {{ $courses->firstItem() }}-{{ $courses->lastItem() }} of {{ $courses->total() }} results</p>
    </div>
</div><!-- end col-lg-8 -->