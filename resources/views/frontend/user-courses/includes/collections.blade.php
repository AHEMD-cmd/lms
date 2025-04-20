
    <div class="my-course-body" id="collection-content">
        @forelse ($collections as $collection)
            <div class="my-collection-item">
                <div class="my-course-info pb-40px">
                    <div class="d-flex align-items-center pb-2">
                        <h3 class="fs-22 font-weight-semi-bold">{{ $collection->name }}</h3>
                        <div class="my-course-info-action ml-2">
                            <!--edit collection-->
                            <span 
                                class="la la-edit icon-element icon-element-xs cursor-pointer shadow-sm edit-collection-btn"
                                data-id="{{ $collection->id }}"
                                data-name="{{ $collection->name }}"
                                data-description="{{ $collection->description }}"
                                data-toggle="modal" 
                                data-target="#editCollectionModal"
                                title="Edit">
                            </span>

                            <span 
                                class="la la-trash icon-element icon-element-xs cursor-pointer shadow-sm delete-collection-btn"
                                data-id="{{ $collection->id }}"
                                data-toggle="modal" 
                                data-target="#deleteModal" 
                                title="Delete">
                            </span>
                        </div>
                    </div>
                    <p>{{ $collection->description }}</p>
                </div><!-- end my-course-info -->
                <div class="my-course-cards">
                    <div class="row">
                        @foreach ($collection->courses as $course)
                            <div class="col-lg-4 responsive-column-half">
                                <div class="card card-item">
                                    <div class="card-image">
                                        <a href="lesson-details.html" class="d-block">
                                            <img class="card-img-top lazy" src="{{ asset($course->image) }}"
                                                data-src="{{ asset($course->image) }}" alt="{{ $course->title }}">
                                            <div class="play-button">
                                                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                                    viewBox="-307.4 338.8 91.8 91.8" xml:space="preserve">
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
                                                        <circle class="st0" cx="-261.5" cy="384.7" r="45.9">
                                                        </circle>
                                                        <path class="st1"
                                                            d="M-272.9,363.2l35.8,20.7c0.7,0.4,0.7,1.3,0,1.7l-35.8,20.7c-0.7,0.4-1.5-0.1-1.5-0.9V364C-274.4,363.3-273.5,362.8-272.9,363.2z">
                                                        </path>
                                                    </g>
                                                </svg>
                                            </div>
                                        </a>
                                        <div class="course-badge-labels course--badge-labels">
                                            <div class="generic-action-wrap generic--action-wrap generic--action-wrap-2">
                                                <div class="dropdown">
                                                    <a class="action-btn bg-white text-gray dropdown-btn" href="#"
                                                        role="button" id="collectionMenuLink" data-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false">
                                                        <i class="la la-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-wrap"
                                                        aria-labelledby="collectionMenuLink" data-course-id="{{ $course->id }}">
                                                        <a href="javascript:void(0)" class="dropdown-item collection-link" data-collection-id="{{ $collection->id }}">
                                                            Remove from Collection
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- end card-image -->
                                    <div class="card-body">
                                        <h5 class="card-title"><a href="lesson-details.html">{{ $course->title }}</a>
                                        </h5>
                                        <p class="card-text lh-22 pt-2"><a
                                                href="teacher-detail.html">{{ $course->instructor->name }}</a></p>
                                        <div class="my-course-progress-bar-wrap d-flex flex-wrap align-items-center mt-3 position-relative">
                                            <p class="skillbar-title">Complete:</p>
                                            <div class="skillbar-box">
                                                <div class="skillbar skillbar-skillbar-2"
                                                    data-percent="{{ $course->completionPercentage }}%">
                                                    <div class="skillbar-bar skillbar--bar-2 bg-1"></div>
                                                </div><!-- End Skill Bar -->
                                            </div>
                                            <div class="skill-bar-percent">{{ $course->completionPercentage }}%</div>
                                        </div><!-- end my-course-progress-bar-wrap -->
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
                                    </div><!-- end card-body -->
                                </div><!-- end card -->
                            </div><!-- end col-lg-4 -->
                        @endforeach
                    </div><!-- end row -->
                </div><!-- end my-course-cards -->
            </div><!-- end my-collection-item -->

        @empty
            <div class="my-collection-item">
                <div class="my-course-info pb-40px">
                    <div class="d-flex align-items-center pb-2">
                        <h3 class="fs-22 font-weight-semi-bold">No Collections</h3>
                    </div>
                </div><!-- end my-course-info -->
            </div><!-- end my-collection-item -->
        @endforelse

    </div><!-- end my-course-body -->

