<div class="tab-pane fade" id="archived" role="tabpanel" aria-labelledby="archived-tab">
    <div class="my-course-body">
        <div class="my-course-info pb-40px">
            <h3 class="fs-22 font-weight-semi-bold">My archives</h3>
        </div><!-- end my-course-info -->
        <div class="my-course-cards">
            <div class="row">
                @foreach ($archivedCourses as $course)
                    <div class="col-lg-4 responsive-column-half">
                        <div class="card card-item">
                            <div class="card-image">
                                <a href="course-details.html" class="d-block">
                                    <img class="card-img-top lazy" src="{{ asset($course->image) }}"
                                        alt="{{ $course->title }}">
                                </a>
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
                            </div><!-- end card-body -->
                        </div><!-- end card -->
                    </div><!-- end col-lg-4 -->
                @endforeach
            </div><!-- end row -->
        </div><!-- end my-course-cards -->
    </div><!-- end my-course-body -->
</div><!-- end tab-pane -->