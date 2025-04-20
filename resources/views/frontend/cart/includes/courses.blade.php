@if ($recommendedCourses->count() > 0)    
    <section class="course-area section--padding bg-gray">
        <div class="course-wrapper">
            <div class="container">
                <div class="section-heading">
                    <h2 class="section__title">You may also like</h2>
                </div><!-- end section-heading -->
                <div class="course-carousel owl-action-styled owl--action-styled mt-30px">
                    @foreach ($recommendedCourses as $course)
                        <div class="card card-item">
                            <div class="card-image">
                                <a href="course-details.html" class="d-block">
                                    <img class="card-img-top" src="{{ asset($course->image) }}" alt="{{ $course->title }}">
                                </a>
                                <div class="course-badge-labels">
                                    @if ($course->discount_percentage > 0)
                                        <div class="course-badge blue">-{{ $course->discount_percentage }}%</div>
                                    @endif
                                    @if ($course->bestseller)
                                        <div class="course-badge">Bestseller</div>
                                    @endif
                                </div>
                            </div><!-- end card-image -->
                            <div class="card-body">
                                <h6 class="ribbon ribbon-blue-bg fs-14 mb-3">{{ $course->level }}</h6>
                                <h5 class="card-title"><a href="course-details.html">{{ $course->title }}</a></h5>
                                <p class="card-text"><a href="teacher-detail.html">{{ $course->instructor->name }}</a></p>
                                <div class="rating-wrap d-flex align-items-center py-2">
                                    <div class="review-stars">
                                        <span
                                            class="rating-number">{{ $course->averageRating() }}</span>
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
                                    <span class="rating-total pl-1">({{ $course->reviews()->count() }}
                                        ratings)</span>
                                </div><!-- end rating-wrap -->
                                <div class="d-flex justify-content-between align-items-center">
                                    @if ($course->discount > 0)
                                        <p class="card-price text-black font-weight-bold">{{ $course->price }} <span
                                                class="before-price font-weight-medium">{{ $course->original_price }}</span></p>
                                    @else
                                        <p class="card-price text-black font-weight-bold">{{ $course->price }}</p>
                                    @endif
                                    @auth
                                        <div class="icon-element icon-element-sm shadow-sm cursor-pointer wishlist"
                                            data-id="{{ $course->id }}" title="Add to Wishlist">
                                            <i class="la la-heart{{ auth()->user()->wishList->contains($course->id) ? '' : '-o' }}"></i>
                                        </div>
                                @endauth
                                </div>
                            </div><!-- end card-body -->
                        </div><!-- end card -->
                    @endforeach

                </div><!-- end tab-content -->
            </div><!-- end container -->
        </div><!-- end course-wrapper -->
    </section>
@endif
