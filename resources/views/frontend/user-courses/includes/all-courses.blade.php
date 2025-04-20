<div class="my-course-cards pt-40px" id="all-courses">
    <div class="row">
        @foreach ($courses as $course)
            @include('frontend.user-courses.modals.new-collection')

            <div class="col-lg-4 responsive-column-half">
                <div class="card card-item">
                    <div class="card-image">
                        <a href="lesson-details.html" class="d-block">
                            <img class="card-img-top lazy" src="{{ asset($course->image) }}"
                                data-src="{{ asset($course->image) }}"
                                alt="{{ $course->title }}">
                            <div class="play-button">
                                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" x="0px"
                                    y="0px" viewBox="-307.4 338.8 91.8 91.8"
                                    xml:space="preserve">
                                    <style type="text/css">
                                        .st0 {
                                            opacity: 0.6;
                                            fill: #000000;
                                            border-radius: 100px;
                                        }

                                        .st1 {
                                            fill: #FFFFFF;
                                        }
                                    </style>
                                    <g>
                                        <circle class="st0" cx="-261.5" cy="384.7"
                                            r="45.9"></circle>
                                        <path class="st1"
                                            d="M-272.9,363.2l35.8,20.7c0.7,0.4,0.7,1.3,0,1.7l-35.8,20.7c-0.7,0.4-1.5-0.1-1.5-0.9V364C-274.4,363.3-273.5,362.8-272.9,363.2z">
                                        </path>
                                    </g>
                                </svg>
                            </div>
                        </a>

                        @include('frontend.user-courses.includes.collection-dropdown')

                    </div><!-- end card-image -->

                    <div class="card-body">
                        <h5 class="card-title"><a
                                href="lesson-details.html">{{ $course->title }}</a></h5>
                        <p class="card-text lh-22 pt-2"><a
                                href="teacher-detail.html">{{ $course->instructor->name }}</a>
                        </p>
                        <div
                            class="my-course-progress-bar-wrap d-flex flex-wrap align-items-center mt-3 position-relative">
                            <p class="skillbar-title">Complete:</p>
                            <div class="skillbar-box">
                                <div class="skillbar skillbar-skillbar-2"
                                    data-percent="{{ $course->completionPercentage }}%">
                                    <div class="skillbar-bar skillbar--bar-2 bg-1"></div>
                                </div><!-- End Skill Bar -->
                            </div>
                            <div class="skill-bar-percent">{{ $course->completionPercentage }}%
                            </div>
                        </div><!-- end my-course-progress-bar-wrap -->
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
                    </div><!-- end card-body -->
                </div><!-- end card -->
            </div><!-- end col-lg-4 -->
        @endforeach
    </div><!-- end row -->

    <div class="text-center pt-3" id="pagination-container">
        {{ $courses->links() }}
    </div>
</div><!-- end my-course-cards -->