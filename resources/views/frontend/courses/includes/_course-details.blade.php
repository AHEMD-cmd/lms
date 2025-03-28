<section class="course-details-area pb-20px">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 pb-5">
                <div class="course-details-content-wrap pt-90px">
                    <div class="course-overview-card bg-gray p-4 rounded">
                        <h3 class="fs-24 font-weight-semi-bold pb-3">What you'll learn?</h3>
                        <ul class="generic-list-item overview-list-item">
                            @foreach ($course->courseGoals as $goal)
                                <li><i class="la la-check mr-1 text-black"></i> {{ $goal->goal }} </li>
                            @endforeach

                        </ul>
                    </div><!-- end course-overview-card -->
                    <div class="course-overview-card bg-gray p-4 rounded">
                        <h3 class="fs-16 font-weight-semi-bold">Curated for the <a href="for-business.html"
                                class="text-color hover-underline">Aduca for Business</a> collection</h3>
                    </div><!-- end course-overview-card -->
                    <div class="course-overview-card">
                        <h3 class="fs-24 font-weight-semi-bold pb-3">Requirements</h3>
                        <ul class="generic-list-item generic-list-item-bullet fs-15">
                            <li> {{ $course->prerequisites }} </li>

                        </ul>
                    </div><!-- end course-overview-card -->
                    <div class="course-overview-card border border-gray p-4 rounded">
                        <h3 class="fs-20 font-weight-semi-bold">Top companies trust Aduca</h3>
                        <p class="fs-15 pb-1">Get your team access to Aduca's top {{ $coursesCount }}+ courses</p>
                        <div class="pb-3">
                            <img width="85" class="mr-3"
                                src="{{ asset('assets/frontend/images/sponsor-img.png') }}" alt="company logo">
                            <img width="80" class="mr-3"
                                src="{{ asset('assets/frontend/images/sponsor-img2.png') }}" alt="company logo">
                            <img width="80" class="mr-3"
                                src="{{ asset('assets/frontend/images/sponsor-img3.png') }}" alt="company logo">
                            <img width="70" class="mr-3"
                                src="{{ asset('assets/frontend/images/sponsor-img4.png') }}" alt="company logo">
                        </div>
                        <a href="for-business.html" class="btn theme-btn theme-btn-sm">Try Aduca for Business</a>
                    </div><!-- end course-overview-card -->
                    <div class="course-overview-card">
                        <h3 class="fs-24 font-weight-semi-bold pb-3">Description</h3>
                        <p class="fs-15 pb-2"> {!! $course->description !!} </p>


                        {{-- <div class="collapse" id="collapseMore">

                            <h4 class="fs-20 font-weight-semi-bold py-2">Who this course is for:</h4>
                            <p class="fs-15 pb-2"> {{ $course->prerequisites }} </p>


                        </div> --}}
                        {{-- <a class="collapse-btn collapse--btn fs-15" data-toggle="collapse" href="#collapseMore"
                            role="button" aria-expanded="false" aria-controls="collapseMore">
                            <span class="collapse-btn-hide">Show more<i class="la la-angle-down ml-1 fs-14"></i></span>
                            <span class="collapse-btn-show">Show less<i class="la la-angle-up ml-1 fs-14"></i></span>
                        </a> --}}
                    </div><!-- end course-overview-card -->


                    <div class="course-overview-card">
                        <div class="curriculum-header d-flex align-items-center justify-content-between pb-4">
                            <h3 class="fs-24 font-weight-semi-bold">Course content</h3>
                            <div class="curriculum-duration fs-15">
                                <span class="curriculum-total__text mr-2"><strong
                                        class="text-black font-weight-semi-bold">Total:</strong>
                                    {{ $course->lectures->count() }}
                                    lectures</span>
                                <span class="curriculum-total__hours"><strong
                                        class="text-black font-weight-semi-bold">Total hours:</strong>
                                    {{ $course->duration_formatted }}</span>
                            </div>
                        </div>



                        <div class="curriculum-content">
                            <div id="accordion" class="generic-accordion">

                                @foreach ($course->sections as $section)
                                    @if ($section->lectures->count() > 0) 
                                        <div class="card">
                                            <div class="card-header" id="heading{{ $section->id }}">
                                                <button
                                                    class="btn btn-link d-flex align-items-center justify-content-between"
                                                    data-toggle="collapse" data-target="#collapse{{ $section->id }}"
                                                    aria-expanded="true" aria-controls="collapse{{ $section->id }}">
                                                    <i class="la la-plus"></i>
                                                    <i class="la la-minus"></i>
                                                    {{ $section->title }}
                                                    <span class="fs-15 text-gray font-weight-medium">
                                                        {{ count($section->lectures) }} lectures</span>
                                                </button>
                                            </div><!-- end card-header -->
                                            <div id="collapse{{ $section->id }}" class="collapse "
                                                aria-labelledby="heading{{ $section->id }}" data-parent="#accordion">
                                                <div class="card-body">
                                                    <ul class="generic-list-item">
                                                        @foreach ($section->lectures as $lecture)
                                                            <li>
                                                                <div
                                                                    class="d-flex align-items-center justify-content-between">
                                                                    <span>
                                                                        @if ($lecture->url)
                                                                            <i class="la la-play-circle mr-1"></i>
                                                                        @else
                                                                            <i class="la la-file mr-1"></i>
                                                                        @endif
                                                                        {{ $lecture->title }}
                                                                    </span>
                                                                    <span>{{ $lecture->duration }}</span>
                                                                </div>
                                                            </li>
                                                        @endforeach

                                                    </ul>
                                                </div><!-- end card-body -->
                                            </div><!-- end collapse -->
                                        </div><!-- end card -->
                                    @endif
                                @endforeach



                            </div><!-- end generic-accordion -->
                        </div><!-- end curriculum-content -->
                    </div><!-- end course-overview-card -->


                    <div class="course-overview-card pt-4">
                        <h3 class="fs-24 font-weight-semi-bold pb-4">About the instructor</h3>
                        <div class="instructor-wrap">
                            <div class="media media-card">
                                <div class="instructor-img">
                                    <a href="teacher-detail.html" class="media-img d-block">
                                        <img class="lazy"
                                            src="{{ asset($course->instructor->photo) ?? asset('assets/frontend/images/instructor-fallback-image.jpg') }}"
                                            alt="{{ $course->instructor->name }}">
                                    </a>
                                    <ul class="generic-list-item pt-3">
                                        <li><i class="la la-star mr-2 text-color-3"></i>
                                            {{ $course->instructor->averageRating() }} Instructor Rating</li>
                                        <li><i class="la la-user mr-2 text-color-3"></i> 45,786 Students</li>
                                        <li><i class="la la-comment-o mr-2 text-color-3"></i>
                                            {{ $course->instructor->instructorReviews->count() }} Reviews</li>
                                        <li><i class="la la-play-circle-o mr-2 text-color-3"></i>
                                            {{ count($course->instructor->courses) }} Courses</li>
                                        <li><a href="teacher-detail.html">View all Courses</a></li>
                                    </ul>
                                </div><!-- end instructor-img -->
                                <div class="media-body">
                                    <h5><a href="teacher-detail.html">{{ $course->instructor->name }}</a></h5>
                                    <span class="d-block lh-18 pt-2 pb-3">Joined
                                        {{ $course->instructor->created_at->diffForHumans() }}</span>
                                    <p class="text-black lh-18 pb-3">{{ $course->instructor->email }}</p>

                                    {!! $course->instructor->instructor_description !!}

                                    {{-- <a class="collapse-btn collapse--btn fs-15" data-toggle="collapse"
                                        href="#collapseMoreTwo" role="button" aria-expanded="false"
                                        aria-controls="collapseMoreTwo">
                                        <span class="collapse-btn-hide">Show more<i
                                                class="la la-angle-down ml-1 fs-14"></i></span>
                                        <span class="collapse-btn-show">Show less<i
                                                class="la la-angle-up ml-1 fs-14"></i></span>
                                    </a> --}}
                                </div>
                            </div>
                        </div><!-- end instructor-wrap -->
                    </div><!-- end course-overview-card -->




                    <div class="course-overview-card pt-4">
                        <h3 class="fs-24 font-weight-semi-bold pb-40px">Student feedback</h3>
                        <div class="feedback-wrap">
                            <div class="media media-card align-items-center">
                                <div class="review-rating-summary">
                                    <span class="stats-average__count">{{ $course->averageRating() }}</span>
                                    <div class="rating-wrap pt-1">
                                        <div class="review-stars">

                                            @for ($i = 1; $i <= $course->averageRating(); $i++)
                                                <span class="la la-star"></span>
                                            @endfor

                                            @if ($course->doesRateHaveFraction())
                                                <span class="la la-star-half-alt"></span>
                                            @endif

                                        </div>
                                        <span class="rating-total d-block">({{ $course->reviews->count() }})</span>
                                        <span>Course Rating</span>
                                    </div><!-- end rating-wrap -->
                                </div><!-- end review-rating-summary -->
                                <div class="media-body">
                                    <div class="review-bars d-flex align-items-center mb-2">
                                        <div class="review-bars__text">5 stars</div>
                                        <div class="review-bars__fill">
                                            <div class="skillbar-box">
                                                <div class="skillbar"
                                                    data-percent="{{ $course->getFiveStarPercentage() }}%">
                                                    <div class="skillbar-bar bg-3"></div>
                                                </div> <!-- End Skill Bar -->
                                            </div>
                                        </div><!-- end review-bars__fill -->
                                        <div class="review-bars__percent">{{ $course->getFiveStarPercentage() }}%
                                        </div>
                                    </div><!-- end review-bars -->

                                    <div class="review-bars d-flex align-items-center mb-2">
                                        <div class="review-bars__text">4 stars</div>
                                        <div class="review-bars__fill">
                                            <div class="skillbar-box">
                                                <div class="skillbar"
                                                    data-percent="{{ $course->getFourStarPercentage() }}%">
                                                    <div class="skillbar-bar bg-3"></div>
                                                </div> <!-- End Skill Bar -->
                                            </div>
                                        </div><!-- end review-bars__fill -->
                                        <div class="review-bars__percent">{{ $course->getFourStarPercentage() }}%
                                        </div>
                                    </div><!-- end review-bars -->

                                    <div class="review-bars d-flex align-items-center mb-2">
                                        <div class="review-bars__text">3 stars</div>
                                        <div class="review-bars__fill">
                                            <div class="skillbar-box">
                                                <div class="skillbar"
                                                    data-percent="{{ $course->getThreeStarPercentage() }}%">
                                                    <div class="skillbar-bar bg-3"></div>
                                                </div> <!-- End Skill Bar -->
                                            </div>
                                        </div><!-- end review-bars__fill -->
                                        <div class="review-bars__percent">{{ $course->getThreeStarPercentage() }}%
                                        </div>
                                    </div><!-- end review-bars -->

                                    <div class="review-bars d-flex align-items-center mb-2">
                                        <div class="review-bars__text">2 stars</div>
                                        <div class="review-bars__fill">
                                            <div class="skillbar-box">
                                                <div class="skillbar"
                                                    data-percent="{{ $course->getTwoStarPercentage() }}%">
                                                    <div class="skillbar-bar bg-3"></div>
                                                </div> <!-- End Skill Bar -->
                                            </div>
                                        </div><!-- end review-bars__fill -->
                                        <div class="review-bars__percent">{{ $course->getTwoStarPercentage() }}%</div>
                                    </div><!-- end review-bars -->

                                    <div class="review-bars d-flex align-items-center mb-2">
                                        <div class="review-bars__text">1 stars</div>
                                        <div class="review-bars__fill">
                                            <div class="skillbar-box">
                                                <div class="skillbar"
                                                    data-percent="{{ $course->getOneStarPercentage() }}%">
                                                    <div class="skillbar-bar bg-3"></div>
                                                </div> <!-- End Skill Bar -->
                                            </div>
                                        </div><!-- end review-bars__fill -->
                                        <div class="review-bars__percent">{{ $course->getOneStarPercentage() }}%</div>
                                    </div><!-- end review-bars -->

                                </div><!-- end media-body -->
                            </div>
                        </div><!-- end feedback-wrap -->
                    </div><!-- end course-overview-card -->

                    <div class="course-overview-card pt-4" style="{{ $reviews->isEmpty() ? 'display: none;' : '' }}">
                        <h3 class="fs-24 font-weight-semi-bold pb-4">Reviews</h3>
                        <div class="review-wrap">
                            <div class="d-flex flex-wrap align-items-center pb-4">
                                <form method="post" class="mr-3 flex-grow-1">
                                    <div class="form-group">
                                        <input class="form-control form--control pl-3" type="text" name="search"
                                            id="review-search" placeholder="Search reviews">
                                        <span class="la la-search search-icon"></span>
                                    </div>
                                </form>
                                <div class="select-container mb-3">
                                    <select class="select-container-select" id="rating-filter">
                                        <option value="">All ratings</option>
                                        <option value="5">Five stars</option>
                                        <option value="4">Four stars</option>
                                        <option value="3">Three stars</option>
                                        <option value="2">Two stars</option>
                                        <option value="1">One star</option>
                                    </select>
                                </div>
                            </div>
                            <div id="course-reviews-container">
                                @include('frontend.courses.includes._reviews')
                            </div>
                        </div><!-- end review-wrap -->
                        <div class="see-more-review-btn text-center"
                            style="{{ $course->reviews->count() == $reviews->count() ? 'display: none;' : '' }}">
                            <button type="button" class="btn theme-btn theme-btn-transparent"
                                id="load-more-reviews">Load more reviews</button>
                        </div>
                    </div><!-- end course-overview-card -->
                    @auth
                        @if (!in_array($course->id, auth()->user()->reviews()->pluck('course_id')->toArray()))
                            <div class="course-overview-card pt-4">
                                <h3 class="fs-24 font-weight-semi-bold pb-4">Add a Review</h3>

                                <form method="post" class="row"
                                    action="{{ route('courses.reviews.store', $course->slug) }}">
                                    @csrf
                                    <!-- Rating Section -->
                                    <div class="input-box col-lg-12 leave-rating-wrap pb-4">
                                        <label class="label-text d-block mb-2">Rate the Course</label>
                                        <div
                                            class="leave-rating leave--rating d-flex flex-row-reverse justify-content-center">
                                            <input type="radio" name='rate' id="star5" value="5" />
                                            <label for="star5"></label>
                                            <input type="radio" name='rate' id="star4" value="4" />
                                            <label for="star4"></label>
                                            <input type="radio" name='rate' id="star3" value="3" />
                                            <label for="star3"></label>
                                            <input type="radio" name='rate' id="star2" value="2" />
                                            <label for="star2"></label>
                                            <input type="radio" name='rate' id="star1" value="1" />
                                            <label for="star1"></label>
                                        </div>
                                    </div>

                                    <input name='course_id' type="hidden" value="{{ $course->id }}" />
                                    <!-- Comment Section -->
                                    <div class="input-box col-lg-12">
                                        <label class="label-text">Message</label>
                                        <div class="form-group">
                                            <textarea class="form-control form--control pl-3" name="comment" placeholder="Write Message" rows="5"></textarea>
                                        </div>
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="btn-box col-lg-12 text-center">
                                        <button class="btn theme-btn" type="submit">Submit Review</button>
                                    </div>
                                </form>
                            </div>
                        @endif
                    @endauth

                </div><!-- end course-details-content-wrap -->
            </div><!-- end col-lg-8 -->

            <div class="col-lg-4">
                <div class="sidebar sidebar-negative">
                    <div class="card card-item">
                        <div class="card-body">
                            <div class="preview-course-video">
                                <a href="javascript:void(0)" data-toggle="modal" data-target="#previewModal">
                                    <img src="{{ asset($course->image) }}" data-src="{{ asset($course->image) }}"
                                        alt="course-img" class="w-100 rounded lazy">
                                    <div class="preview-course-video-content">
                                        <div class="overlay"></div>
                                        <div class="play-button">
                                            <svg versi on="1.1" xmlns="http://www.w3.org/2000/svg" x="0px"
                                                y="0px" viewBox="-307.4 338.8 91.8 91.8"
                                                style=" enable-background:new -307.4 338.8 91.8 91.8;"
                                                xml:space="preserve">
                                                <style type="text/css">
                                                    .st0 {
                                                        fill: #ffffff;
                                                        border-radius: 100px;
                                                    }

                                                    .st1 {
                                                        fill: #000000;
                                                    }
                                                </style>
                                                <g>
                                                    <circle class="st0" cx="-261.5" cy="384.7" r="45.9">
                                                    </circle>
                                                    <path class="st1"
                                                        d="M-272.9,363.2l35.8,20.7c0.7,0.4,0.7,1.3,0,1.7l-35.8,20.7c-0.7,0.4-1.5-0.1-1.5-0.9V364C-274.4,363.3-273.5,362.8-272.9,363.2z">
                                                    </path>
                                                </g>
                                            </svg>
                                        </div>
                                        <p class="fs-15 font-weight-bold text-white pt-3">Preview this course</p>
                                    </div>
                                </a>
                            </div><!-- end preview-course-video -->
                            <div class="preview-course-feature-content pt-40px">
                                <p class="d-flex align-items-center pb-2">
                                    @if ($course->discount)
                                        <span
                                            class="fs-35 font-weight-semi-bold text-black">${{ $course->discount }}</span>
                                        <span class="before-price mx-1">${{ $course->price }}</span>
                                        <span class="price-discount">{{ $course->discount_percentage }}% off</span>
                                    @else
                                        <span class="fs-35 font-weight-semi-bold text-black">$76.99</span>
                                    @endif
                                </p>
                                <p class="preview-price-discount-text pb-35px">
                                    <span class="text-color-3">4 days</span> left at this price!
                                </p>
                                <div class="buy-course-btn-box">
                                    <button
                                        href="{{ in_array($course->id, $cartItems->pluck('course_id')->toArray()) ? route('carts.index') : '' }}"
                                        class="btn theme-btn w-100 mb-2 {{ !in_array($course->id, $cartItems->pluck('course_id')->toArray()) ? 'add-to-cart' : '' }}"
                                        data-course-id="{{ $course->id }}"><i
                                            class="la la-shopping-cart mr-1 fs-18"></i>
                                        {{ in_array($course->id, $cartItems->pluck('course_id')->toArray()) ? 'Go to Cart' : 'Add to Cart' }}</button>
                                    <button type="button" class="btn theme-btn w-100 theme-btn-white mb-2"><i
                                            class="la la-shopping-bag mr-1"></i> Buy this course</button>
                                </div>
                                <p class="fs-14 text-center pb-4">30-Day Money-Back Guarantee</p>
                                <div class="preview-course-incentives">
                                    <h3 class="card-title fs-18 pb-2">This course includes</h3>
                                    <ul class="generic-list-item pb-3">
                                        <li><i class="la la-play-circle-o mr-2 text-color"></i>{{ $course->duration }}
                                            on-demand video</li>
                                        <li><i class="la la-file mr-2 text-color"></i>{{ $course->resources }}
                                            articles</li>
                                        <li><i class="la la-file-text mr-2 text-color"></i>12 downloadable resources
                                        </li>
                                        <li><i class="la la-key mr-2 text-color"></i>Full lifetime access</li>
                                        <li><i class="la la-television mr-2 text-color"></i>Access on mobile and TV
                                        </li>
                                        @if ($course->has_certificate)
                                            <li><i class="la la-certificate mr-2 text-color"></i>Certificate of
                                                Completion</li>
                                        @endif
                                    </ul>
                                    <div class="section-block"></div>
                                    <div class="buy-for-team-container pt-4">
                                        <h3 class="fs-18 font-weight-semi-bold pb-2">Training 5 or more people?</h3>
                                        <p class="lh-24 pb-3">Get your team access to 3,000+ top Aduca courses anytime,
                                            anywhere.</p>
                                        <a href="for-business.html"
                                            class="btn theme-btn theme-btn-sm theme-btn-transparent lh-30 w-100">Try
                                            Aduca for Business</a>
                                    </div>
                                </div><!-- end preview-course-incentives -->
                            </div><!-- end preview-course-content -->
                        </div>
                    </div><!-- end card -->
                    <div class="card card-item">
                        <div class="card-body">
                            <h3 class="card-title fs-18 pb-2">Course Features</h3>
                            <div class="divider"><span></span></div>
                            <ul class="generic-list-item generic-list-item-flash">
                                <li class="d-flex align-items-center justify-content-between"><span><i
                                            class="la la-clock mr-2 text-color"></i>Duration</span>
                                    {{ $course->duration }} hours</li>

                                <li class="d-flex align-items-center justify-content-between"><span><i
                                            class="la la-file-text-o mr-2 text-color"></i>Resources</span>
                                    {{ $course->resources }}</li>
                                <li class="d-flex align-items-center justify-content-between"><span><i
                                            class="la la-bolt mr-2 text-color"></i>Quizzes</span> 26</li>
                                <li class="d-flex align-items-center justify-content-between"><span><i
                                            class="la la-eye mr-2 text-color"></i>Preview Lessons</span> 4</li>
                                <li class="d-flex align-items-center justify-content-between"><span><i
                                            class="la la-language mr-2 text-color"></i>Language</span> English</li>
                                <li class="d-flex align-items-center justify-content-between"><span><i
                                            class="la la-lightbulb mr-2 text-color"></i>Skill level</span>
                                    {{ $course->level }}</li>
                                <li class="d-flex align-items-center justify-content-between"><span><i
                                            class="la la-users mr-2 text-color"></i>Students</span> 30,506</li>
                                @if ($course->has_certificate)
                                    <li class="d-flex align-items-center justify-content-between"><span><i
                                                class="la la-certificate mr-2 text-color"></i>Certificate</span>
                                        {{ $course->certificate }}</li>
                                @endif
                            </ul>
                        </div>
                    </div><!-- end card -->

                    <div class="card card-item">
                        <div class="card-body">
                            <h3 class="card-title fs-18 pb-2">Related Courses</h3>
                            <div class="divider"><span></span></div>

                            @foreach ($relatedCourses as $relatedCourse)
                                <div class="media media-card border-bottom border-bottom-gray pb-4 mb-4">
                                    <a href="course-details.html" class="media-img">
                                        <img class="mr-3 lazy" src="{{ asset($relatedCourse->image) }}"
                                            data-src="{{ asset($relatedCourse->image) }}" alt="Related course image">
                                    </a>
                                    <div class="media-body">
                                        <h5 class="fs-15"><a href="course-details.html">
                                                {{ $relatedCourse->name }}</a></h5>
                                        <span
                                            class="d-block lh-18 py-1 fs-14">{{ $relatedCourse->instructor->name }}</span>

                                        @if (!$relatedCourse->discount)
                                            <p class="text-black font-weight-semi-bold lh-18 fs-15">
                                                ${{ $relatedCourse->price }} </p>
                                        @else
                                            <p class="text-black font-weight-semi-bold lh-18 fs-15">
                                                ${{ $relatedCourse->price }} <span
                                                    class="before-price fs-14">${{ $relatedCourse->discount }}</span>
                                            </p>
                                        @endif

                                    </div>
                                </div><!-- end media -->
                            @endforeach
                            <div class="view-all-course-btn-box">
                                <a href="course-grid.html" class="btn theme-btn w-100">View All Courses <i
                                        class="la la-arrow-right icon ml-1"></i></a>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->
                </div><!-- end sidebar -->
            </div><!-- end col-lg-4 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section>
