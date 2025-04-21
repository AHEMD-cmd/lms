<section class="course-area pb-120px">
    <div class="container">
        <div class="section-heading text-center">
            <h5 class="ribbon ribbon-lg mb-2">Choose your desired courses</h5>
            <h2 class="section__title">The world's largest selection of courses</h2>
            <span class="section-divider"></span>
        </div><!-- end section-heading -->
        <ul class="nav nav-tabs generic-tab justify-content-center pb-4" id="myTab" role="tablist">
            @foreach ($categories as $category)
                <li class="nav-item">
                    <a class="nav-link @if ($loop->first) active @endif" id="{{ $category->id }}-tab"
                        data-toggle="tab" href="#course-{{ $category->id }}" role="tab"
                        aria-controls="{{ $category->id }}"
                        aria-selected="{{ $loop->first ? 'true' : 'false' }}">{{ $category->name }}</a>
                </li>
            @endforeach
        </ul>
    </div><!-- end container -->
    <div class="card-content-wrapper bg-gray pt-50px pb-120px">
        <div class="container">
            <div class="tab-content" id="myTabContent">
                @foreach ($categories as $category)
                    <div class="tab-pane fade @if ($loop->first) show active @endif"
                        id="course-{{ $category->id }}" role="tabpanel" aria-labelledby="{{ $category->id }}-tab">
                        <div class="row">
                            @forelse ($category->courses->take(6)->shuffle() as $course)
                                <div class="col-lg-4 responsive-column-half">
                                    <div class="card card-item card-preview"
                                        data-tooltip-content="#tooltip_content_{{ $course->id }}">
                                        <div class="card-image">
                                            <a href="{{ route('courses.show', $course->slug) }}" class="d-block">
                                                <img class="card-img-top lazy" src="images/img-loading.png"
                                                    data-src="{{ $course->image }}" alt="Card image cap">
                                            </a>
                                            <div class="course-badge-labels">
                                                @if ($course->bestseller)
                                                    <div class="course-badge">
                                                        Bestseller
                                                    </div>
                                                @endif
                                                @if ($course->discount)
                                                    <div class="course-badge blue">-{{ $course->discount_percentage }}%
                                                    </div>
                                                @endif
                                            </div>
                                        </div><!-- end card-image -->
                                        <div class="card-body">
                                            <h6 class="ribbon ribbon-blue-bg fs-14 mb-3">{{ $course->level }}</h6>
                                            <h5 class="card-title"><a
                                                    href="course-details.html">{{ $course->name }}</a>
                                            </h5>
                                            <p class="card-text"><a
                                                    href="{{ route('instructors.show', $course->instructor->slug) }}">{{ $course->instructor->name }}</a>
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
                                                <span class="rating-total pl-1">({{ $course->reviews()->count() }}
                                                    ratings)</span>
                                            </div><!-- end rating-wrap -->
                                            <div class="d-flex justify-content-between align-items-center">
                                                @if ($course->discount)
                                                    <p class="card-price text-black font-weight-bold">
                                                        <span class="before-price font-weight-medium">
                                                            {{ $course->price }}
                                                        </span>
                                                        {{ $course->discount }}
                                                    </p>
                                                @else
                                                    <p class="card-price text-black font-weight-bold">
                                                        {{ $course->price }}
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
                                </div><!-- end col-lg-4 -->
                            @empty
                                <div class="col-12">
                                    <div class="card card-item card-preview">
                                        <div class="card-body">
                                            <h5 class="card-title text-center text-danger">No Courses Found</h5>
                                        </div>
                                    </div>
                                </div>
                            @endforelse
                        </div><!-- end row -->
                    </div><!-- end tab-pane -->
                @endforeach
            </div><!-- end tab-content -->
            <div class="more-btn-box mt-4 text-center">
                <a href="{{route('courses.index')}}" class="btn theme-btn">Browse all Courses <i
                        class="la la-arrow-right icon ml-1"></i></a>
            </div><!-- end more-btn-box -->
        </div><!-- end container -->
    </div><!-- end card-content-wrapper -->
</section>


<!-- end courses-area -->
<!--======================================
END COURSE AREA
======================================-->

<!--======================================
START COURSE AREA
======================================-->
<section class="course-area pb-90px">
    <div class="course-wrapper">
        <div class="container">
            <div class="section-heading text-center">
                <h5 class="ribbon ribbon-lg mb-2">Learn on your schedule</h5>
                <h2 class="section__title">Students are viewing</h2>
                <span class="section-divider"></span>
            </div><!-- end section-heading -->
            <div class="course-carousel owl-action-styled owl--action-styled mt-30px">
                @foreach ($courses as $course)
                    <div class="card card-item card-preview" data-tooltip-content="#tooltip_content_3">
                        <div class="card-image">
                            <a href="{{ route('courses.show', $course->slug) }}" class="d-block">
                                <img class="card-img-top" src="{{ asset($course->image) }}"
                                    alt="{{ $course->title }}">
                            </a>
                            <div class="course-badge-labels">
                                @if ($course->bestseller)
                                    <div class="course-badge">Bestseller</div>
                                @endif
                                @if ($course->discount)
                                    <div class="course-badge blue">-{{ $course->discount }}%</div>
                                @endif
                            </div>
                        </div><!-- end card-image -->
                        <div class="card-body">
                            <h6 class="ribbon ribbon-blue-bg fs-14 mb-3">{{ $course->level }}</h6>
                            <h5 class="card-title"><a href="{{ route('courses.show', $course->slug) }}">{{ $course->title }}</a></h5>
                            <p class="card-text"><a href="{{ route('instructors.show', $course->instructor->slug) }}">{{ $course->instructor->name }}</a></p>
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
                                <span class="rating-total pl-1">({{ $course->reviews()->count() }}
                                    ratings)</span>
                            </div><!-- end rating-wrap -->
                            <div class="d-flex justify-content-between align-items-center">
                                @if ($course->discount > 0)
                                    <p class="card-price text-black font-weight-bold">{{ $course->price }} <span
                                            class="before-price font-weight-medium">{{ $course->original_price }}</span>
                                    </p>
                                @else
                                    <p class="card-price text-black font-weight-bold">{{ $course->price }}</p>
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
                @endforeach
            </div><!-- end tab-content -->
        </div><!-- end container -->
    </div><!-- end course-wrapper -->
</section>
