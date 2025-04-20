<div class="tab-pane fade" id="wishlist" role="tabpanel" aria-labelledby="wishlist-tab">
    <div class="my-course-body">
        <div class="my-course-cards">
            <div class="row">
                @foreach ($wishlistCourses as $course)
                    <div class="col-lg-4 responsive-column-half">
                        <div class="card card-item">
                            <div class="card-image">
                                <a href="course-details.html" class="d-block">
                                    <img class="card-img-top lazy" src="{{ asset($course->image) }}"
                                        alt="{{ $course->title }}">
                                </a>
                                <div class="course-badge-labels">
                                    @if ($course->bestseller)
                                        <div class="course-badge">Bestseller</div>
                                    @endif
                                    @if ($course->discount > 0)
                                        <div class="course-badge blue">-{{ $course->discountPercentage }}%</div>
                                    @endif
                                </div>
                            </div><!-- end card-image -->
                            <div class="card-body">
                                <h6 class="ribbon ribbon-blue-bg fs-14 mb-3">{{ $course->category->name }}</h6>
                                <h5 class="card-title"><a href="course-details.html">{{ $course->title }}</a></h5>
                                <p class="card-text"><a href="teacher-detail.html">{{ $course->instructor->name }}</a>
                                </p>
                                <div class="rating-wrap d-flex align-items-center py-2">
                                    <div class="review-stars">
                                        <span class="rating-number">{{ $course->averageRating() }}</span>
                                        @for ($i = 1; $i <= $course->averageRating(); $i++)
                                            <span class="la la-star"></span>
                                        @endfor
                                        @if ($course->doesRateHaveFraction())
                                            <span class="la la-star-half-alt"></span>
                                        @endif
                                        @for ($i = 1; $i <= 5 - $course->averageRating(); $i++)
                                            <span class="la la-star-o"></span>
                                        @endfor
                                    </div>
                                    <span class="rating-total pl-1">({{ $course->reviews()->count() }} ratings)</span>
                                </div><!-- end rating-wrap -->
                                <div class="d-flex justify-content-between align-items-center">
                                    @if ($course->discount > 0)
                                        <p class="card-price text-black font-weight-bold">
                                            {{ $course->discount }}
                                            <span class="before-price font-weight-medium">{{ $course->price }}</span>
                                        </p>
                                    @else
                                        <p class="card-price text-black font-weight-bold">
                                            {{ $course->price }}
                                        </p>
                                    @endif
                                    <div class="icon-element icon-element-sm shadow-sm cursor-pointer wishlist"
                                        data-id="{{ $course->id }}" title="Add to Wishlist">
                                        <i class="la la-heart{{ auth()->user()->wishList->contains($course->id) ? '' : '-o' }}"></i>
                                    </div>
                                </div>
                            </div><!-- end card-body -->
                        </div><!-- end card -->
                    </div><!-- end col-lg-4 -->
                @endforeach

                {{ $wishlistCourses->links() }}

                @if ($wishlistCourses->isEmpty())
                    <div class="col-12">
                        <div class="empty-wishlist">
                            <h3 class="fs-22 font-weight-semi-bold">Your wishlist is empty</h3>
                            <p class="fs-14">You can add courses to your wishlist and come back to them when you're
                                ready to enroll.</p>
                        </div>
                    </div>
                @endif
            </div><!-- end row -->
        </div><!-- end my-course-cards -->
    </div><!-- end my-course-body -->
</div><!-- end tab-pane -->
