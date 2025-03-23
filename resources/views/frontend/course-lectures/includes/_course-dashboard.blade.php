<section class="course-dashboard">
    <div class="course-dashboard-wrap">
        <div class="course-dashboard-container d-flex">
            <div class="course-dashboard-column">
                <div class="lecture-viewer-container">
                    <div class="lecture-video-item">
                        <video controls crossorigin playsinline id="player">
                            <!-- Video files -->
                            <source src="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-576p.mp4"
                                type="video/mp4" />
                            {{-- <source src="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-720p.mp4"
                                type="video/mp4" />
                            <source src="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-1080p.mp4"
                                type="video/mp4" /> --}}

                            <!-- Caption files -->
                            <track kind="captions" label="English" srclang="en"
                                src="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-HD.en.vtt" default />
                            <track kind="captions" label="Français" srclang="fr"
                                src="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-HD.fr.vtt" />

                            <!-- Fallback for browsers that don't support the <video> element -->
                            <a href="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-576p.mp4"
                                download>Download</a>
                        </video>
                    </div>
                    <div class="lecture-viewer-text-wrap">
                        <div class="lecture-viewer-text-content custom-scrollbar-styled">
                            <div class="lecture-viewer-text-body">
                                <h2 class="fs-24 font-weight-semi-bold pb-4">Download your Footage for your Quick
                                    Start</h2>
                                <div class="lecture-viewer-content-detail">
                                    <ul class="generic-list-item pb-4">
                                        <li>Hi</li>
                                        <li>Welcome to Motion Graphics in After Effects. </li>
                                        <li>In the next lectures you will start creating your first animation and
                                            animate imported footage.</li>
                                        <li>But I must explain to you how all this mistaken idea of denouncing
                                            pleasure and praising pain was born and I will give you a complete
                                            account of the system, and expound the actual teachings of the great
                                            explorer of the truth, the master-builder of human happiness. No one
                                            rejects, dislikes,</li>
                                        <li>At vero eos et accusamus et iusto odio dignissimos ducimus qui
                                            blanditiis praesentium voluptatum deleniti atque corrupti quos dolores
                                            et quas molestias excepturi sint occaecati cupiditate non provident,
                                            similique sunt in culpa qui officia deserunt mollitia animi, id est
                                            laborum et dolorum fuga. </li>
                                        <li>Occaecati cupiditate non provident, similique sunt in culpa qui officia
                                            deserunt mollitia animi, id est laborum et dolorum fuga. </li>
                                        <li>Et harum quidem rerum facilis est et expedita distinctio. Nam libero
                                            tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo
                                            minus id quod maxime placeat facere possimus,</li>
                                        <li>On the other hand, we denounce with righteous indignation and dislike
                                            men who are so beguiled and demoralized by the charms of pleasure of the
                                            moment, so blinded by desire, that they cannot foresee the pain and
                                            trouble that are bound to ensue; and equal blame belongs to those who
                                            fail in their duty through weakness of will, which is the same as saying
                                            through shrinking from toil and pain. These cases are perfectly simple
                                            and easy to distinguish. </li>
                                        <li><strong class="font-weight-semi-bold">Download your footage Now, Click
                                                on the Link Below.</strong></li>
                                    </ul>
                                    <div class="btn-box">
                                        <h3 class="fs-18 font-weight-semi-bold pb-3">Resources for this lecture
                                        </h3>
                                        <a href="#" class="btn theme-btn theme-btn-transparent"><i
                                                class="la la-file-zip-o mr-1"></i>Quick-start.zip</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- end lecture-viewer-container -->

                <div class="lecture-video-detail">
                    <div class="lecture-tab-body bg-gray p-4">
                        <ul class="nav nav-tabs generic-tab" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link" id="search-tab" data-toggle="tab" href="#search" role="tab"
                                    aria-controls="search" aria-selected="false">
                                    <i class="la la-search"></i>
                                </a>
                            </li>
                            <li class="nav-item mobile-menu-nav-item">
                                <a class="nav-link" id="course-content-tab" data-toggle="tab" href="#course-content"
                                    role="tab" aria-controls="course-content" aria-selected="false">
                                    Course Content
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" id="overview-tab" data-toggle="tab" href="#overview"
                                    role="tab" aria-controls="overview" aria-selected="true">
                                    Overview
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="question-and-ans-tab" data-toggle="tab" href="#question-and-ans"
                                    role="tab" aria-controls="question-and-ans" aria-selected="false">
                                    Question & Ans
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="announcements-tab" data-toggle="tab" href="#announcements"
                                    role="tab" aria-controls="announcements" aria-selected="false">
                                    Announcements
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="lecture-video-detail-body">
                        <div class="tab-content" id="myTabContent">

                            {{-- ##################### course content ################### --}}

                            <div class="tab-pane fade" id="search" role="tabpanel" aria-labelledby="search-tab">
                                <div class="search-course-wrap pt-40px">
                                    <form action="#" class="pb-5">
                                        <div class="input-group">
                                            <input class="form-control form--control form--control-gray pl-3"
                                                type="text" name="search" placeholder="Search course content">
                                            <div class="input-group-append">
                                                <button class="btn theme-btn"><span
                                                        class="la la-search"></span></button>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="search-results-message text-center">
                                        <h3 class="fs-24 font-weight-semi-bold pb-1">Start a new search</h3>
                                        <p>To find captions, lectures or resources</p>
                                    </div>
                                </div><!-- end search-course-wrap -->
                            </div><!-- end tab-pane -->
                            <div class="tab-pane " id="course-content" role="tabpanel"
                                aria-labelledby="course-content-tab">
                                <div class="mobile-course-menu pt-4">
                                    <div class="accordion generic-accordion generic--accordion"
                                        id="mobileCourseAccordionCourseExample">
                                        @foreach ($course->sections as $section)
                                            <div class="card">
                                                <div class="card-header"
                                                    id="mobileCourseHeadingOne{{ $section->id }}">
                                                    <button class="btn btn-link" type="button"
                                                        data-toggle="collapse"
                                                        data-target="#mobileCourseCollapseOne{{ $section->id }}"
                                                        aria-expanded="true"
                                                        aria-controls="mobileCourseCollapseOne{{ $section->id }}">
                                                        <i class="la la-angle-down"></i>
                                                        <i class="la la-angle-up"></i>
                                                        <span class="fs-15"> Section {{ $loop->iteration }}:
                                                            {{ $section->title }}</span>
                                                        <span class="course-duration">
                                                            <span>1/{{ $section->lectures->count() }}</span>
                                                            <span>21min</span>
                                                        </span>
                                                    </button>
                                                </div><!-- end card-header -->
                                                <div id="mobileCourseCollapseOne{{ $section->id }}"
                                                    class="collapse {{ $loop->iteration == 1 ? 'show' : '' }}"
                                                    aria-labelledby="mobileCourseHeadingOne{{ $section->id }}"
                                                    data-parent="#mobileCourseAccordionCourseExample">
                                                    <div class="card-body p-0">
                                                        <ul class="curriculum-sidebar-list">
                                                            @foreach ($section->lectures as $lecture)
                                                                <li class="course-item-link active-resource section-lecture"
                                                                    data-id="{{ $lecture->id }}">
                                                                    <div class="course-item-content-wrap">
                                                                        <div class="custom-control custom-checkbox">
                                                                            <input type="checkbox"
                                                                                class="custom-control-input"
                                                                                id="mobileCourseCheckbox{{ $lecture->id }}"
                                                                                required>
                                                                            <label
                                                                                class="custom-control-label custom--control-label"
                                                                                for="mobileCourseCheckbox{{ $lecture->id }}"></label>
                                                                        </div><!-- end custom-control -->
                                                                        <div class="course-item-content">
                                                                            <h4 class="fs-15">{{ $loop->iteration }}.
                                                                                {{ $lecture->title }}</h4>
                                                                            <div class="courser-item-meta-wrap">
                                                                                <p class="course-item-meta"><i
                                                                                        class="la la-file"></i>2min
                                                                                    <i class="la la-play-circle"></i>
                                                                                </p>
                                                                                <div class="generic-action-wrap">
                                                                                    <div class="dropdown">
                                                                                        <a class="btn theme-btn theme-btn-sm theme-btn-transparent mt-1 fs-14 font-weight-medium"
                                                                                            href="#"
                                                                                            data-toggle="dropdown"
                                                                                            aria-haspopup="true"
                                                                                            aria-expanded="false">
                                                                                            <i
                                                                                                class="la la-folder-open mr-1"></i>
                                                                                            Resources<i
                                                                                                class="la la-angle-down ml-1"></i>
                                                                                        </a>
                                                                                        <div
                                                                                            class="dropdown-menu dropdown-menu-right">
                                                                                            <a class="dropdown-item"
                                                                                                href="javascript:void(0)">
                                                                                                Section-Footage.zip
                                                                                            </a>
                                                                                        </div>
                                                                                    </div>
                                                                                </div><!-- end generic-action-wrap -->
                                                                            </div>
                                                                        </div><!-- end course-item-content -->
                                                                    </div><!-- end course-item-content-wrap -->
                                                                </li>
                                                            @endforeach

                                                        </ul>
                                                    </div><!-- end card-body -->
                                                </div><!-- end collapse -->
                                            </div><!-- end card -->
                                        @endforeach

                                    </div><!-- end accordion-->
                                </div><!-- end mobile-course-menu -->
                            </div><!-- end tab-pane -->
                            {{-- ##################### end course content ##################### --}}


                            {{-- ##################### course Overview ################### --}}

                            <div class="tab-pane fade show active" id="overview" role="tabpanel"
                                aria-labelledby="overview-tab">
                                <div class="lecture-overview-wrap">
                                    <div class="lecture-overview-item">
                                        <h3 class="fs-24 font-weight-semi-bold pb-2">About this course</h3>
                                        <p>{{ $course->short_description }}
                                        </p>
                                    </div><!-- end lecture-overview-item -->
                                    <div class="section-block"></div>
                                    <div class="lecture-overview-item">
                                        <div class="lecture-overview-stats-wrap d-flex">
                                            <div class="lecture-overview-stats-item">
                                                <h3 class="fs-16 font-weight-semi-bold pb-2">By the numbers</h3>
                                            </div><!-- end lecture-overview-stats-item -->
                                            <div class="lecture-overview-stats-item">
                                                <ul class="generic-list-item">
                                                    <li><span>Skill level:</span>{{ $course->level }}</li>
                                                    <li><span>Students:</span>83950</li>
                                                    <li><span>Languages:</span>{{ $course->language }}</li>
                                                    <li><span>Captions:</span>Yes</li>
                                                </ul>
                                            </div><!-- end lecture-overview-stats-item -->
                                            <div class="lecture-overview-stats-item">
                                                <ul class="generic-list-item">
                                                    <li><span>Lectures:</span>{{ $course->lectures->count() }}</li>
                                                    <li><span>Video length:</span>3.5 total hours</li>
                                                    <li><span>Certificate:</span>{{ $course->has_certificate ? 'Yes' : 'No' }}
                                                    </li>
                                                </ul>
                                            </div><!-- end lecture-overview-stats-item -->
                                        </div><!-- end lecture-overview-stats-wrap -->
                                    </div><!-- end lecture-overview-item -->
                                    <div class="section-block"></div>
                                    <div class="lecture-overview-item">
                                        <div class="lecture-overview-stats-wrap d-flex">
                                            <div class="lecture-overview-stats-item">
                                                <h3 class="fs-16 font-weight-semi-bold pb-2">Certificates</h3>
                                            </div><!-- end lecture-overview-stats-item -->
                                            <div class="lecture-overview-stats-item lecture-overview-stats-wide-item">
                                                <p class="pb-3">Get Aduca certificate by completing entire course
                                                </p>
                                                <a href="#" class="btn theme-btn theme-btn-transparent">Aduca
                                                    Certificate</a>
                                            </div><!-- end lecture-overview-stats-item -->
                                        </div><!-- end lecture-overview-stats-wrap -->
                                    </div><!-- end lecture-overview-item -->
                                    <div class="section-block"></div>
                                    <div class="lecture-overview-item">
                                        <div class="lecture-overview-stats-wrap d-flex">
                                            <div class="lecture-overview-stats-item">
                                                <h3 class="fs-16 font-weight-semi-bold pb-2">Features</h3>
                                            </div><!-- end lecture-overview-stats-item -->
                                            <div class="lecture-overview-stats-item">
                                                <p>Available on <a href="#"
                                                        class="text-color hover-underline">IOS</a> and <a
                                                        href="#" class="text-color hover-underline">Android</a>
                                                </p>
                                            </div><!-- end lecture-overview-stats-item -->
                                        </div><!-- end lecture-overview-stats-wrap -->
                                    </div><!-- end lecture-overview-item -->
                                    <div class="section-block"></div>
                                    <div class="lecture-overview-item">
                                        <div class="lecture-overview-stats-wrap d-flex">
                                            <div class="lecture-overview-stats-item">
                                                <h3 class="fs-16 font-weight-semi-bold pb-2">Description</h3>
                                            </div><!-- end lecture-overview-stats-item -->
                                            <div
                                                class="lecture-overview-stats-item lecture-overview-stats-wide-item lecture-description">
                                                {!! $course->description !!}
                                            </div><!-- end lecture-overview-stats-item -->
                                        </div><!-- end lecture-overview-stats-wrap -->
                                    </div><!-- end lecture-overview-item -->
                                    <div class="section-block"></div>
                                    <div class="lecture-overview-item">
                                        <div class="lecture-overview-stats-wrap d-flex ">
                                            <div class="lecture-overview-stats-item">
                                                <h3 class="fs-16 font-weight-semi-bold pb-2">Instructor</h3>
                                            </div><!-- end lecture-overview-stats-item -->
                                            <div class="lecture-overview-stats-item lecture-overview-stats-wide-item">
                                                <div class="media media-card align-items-center">
                                                    <a href="teacher-detail.html"
                                                        class="media-img d-block rounded-full avatar-md">
                                                        <img src="{{ $course->instructor->image }}"
                                                            alt="{{ $course->instructor->name }}"
                                                            class="rounded-full">
                                                    </a>
                                                    <div class="media-body">
                                                        <h5><a
                                                                href="teacher-detail.html">{{ $course->instructor->name }}</a>
                                                        </h5>
                                                        <span class="d-block lh-18 pt-2">Java Python Android and C#
                                                            Expert Developer</span>
                                                    </div>
                                                </div>
                                                <div class="lecture-owner-profile pt-4">
                                                    <ul class="social-icons social-icons-styled">
                                                        @if ($course->instructor->facebook)
                                                            <li><a href="{{ $course->instructor->facebook }}"
                                                                    class="facebook-bg"><i
                                                                        class="la la-facebook"></i></a></li>
                                                        @endif

                                                        @if ($course->instructor->x)
                                                            <li><a href="{{ $course->instructor->x }}"
                                                                    class="twitter-bg"><i
                                                                        class="la la-twitter"></i></a></li>
                                                        @endif

                                                        @if ($course->instructor->instagram)
                                                            <li><a href="{{ $course->instructor->instagram }}"
                                                                    class="instagram-bg"><i
                                                                        class="la la-instagram"></i></a></li>
                                                        @endif

                                                        @if ($course->instructor->linkedin)
                                                            <li><a href="{{ $course->instructor->linkedin }}"
                                                                    class="linkedin-bg"><i
                                                                        class="la la-linkedin"></i></a></li>
                                                        @endif
                                                    </ul>
                                                </div>
                                                <div class="lecture-owner-decription pt-4">
                                                    {!! $course->instructor->instructor_description !!}
                                                </div>
                                            </div><!-- end lecture-overview-stats-item -->
                                        </div><!-- end lecture-overview-stats-wrap -->
                                    </div><!-- end lecture-overview-item -->
                                </div><!-- end lecture-overview-wrap -->
                            </div><!-- end tab-pane -->

                            {{-- ##################### end course Overview ################### --}}


                            {{-- ##################### questions and answers ################### --}}

                            <div class="tab-pane fade" id="question-and-ans" role="tabpanel"
                                aria-labelledby="question-and-ans-tab">
                                <div class="lecture-overview-wrap lecture-quest-wrap">

                                    {{-- new question form --}}
                                    <div class="new-question-wrap">
                                        <button class="btn theme-btn theme-btn-transparent back-to-question-btn"><i
                                                class="la la-reply mr-1"></i> Back to all questions
                                        </button>
                                        <div class="new-question-body pt-40px">
                                            <h3 class="fs-20 font-weight-semi-bold">My question relates to</h3>


                                            <form method="post" class="pt-4 question-form">
                                                @csrf
                                                <input type="hidden" name="course_id" id="course-id"
                                                    value="{{ $course->id }}">

                                                <input type="hidden" name="lecture_id" class="lecture-id"
                                                    value="">

                                                <div class="custom-control-wrap">
                                                    <div class="custom-control custom-radio mb-3 pl-0">
                                                        <input type="text" name="subject"
                                                            class="form-control form--control pl-3">

                                                    </div>

                                                    <div class="custom-control custom-radio mb-3 pl-0">
                                                        <textarea class="form-control form--control pl-3" name="question" rows="4"
                                                            placeholder="Write your response..."></textarea>
                                                    </div>
                                                </div>
                                                <div class="btn-box text-center">
                                                    <button type="submit" class="btn theme-btn w-100 ">Submit
                                                        Question <i class="la la-arrow-right icon ml-1"></i></button>
                                                </div>
                                            </form>
                                        </div>
                                    </div><!-- end new-question-wrap -->
                                    {{-- end new question form --}}

                                    {{-- the question with its replies --}}
                                    <div class="question-replies">
                                        @include('frontend.course-lectures.includes._question-with-replies')
                                    </div>
                                    {{-- end the question with its replies --}}

                                    {{--  course questions with filters --}}
                                    <div class="question-overview-result-wrap">
                                        {{-- questions filter --}}
                                        <div class="lecture-overview-item">
                                            <form method="post">
                                                <div class="input-group mb-3">
                                                    <input class="form-control form--control form--control-gray pl-3"
                                                        type="text" name="search" id="question-search"
                                                        placeholder="Search all course questions">
                                                    <div class="input-group-append">
                                                        <button class="btn theme-btn"><i
                                                                class="la la-search search-icon"></i></button>
                                                    </div>
                                                </div>
                                            </form>
                                            <div class="question-overview-filter-wrap d-flex align-items-center">
                                                <div class="question-overview-filter-item">
                                                    <div class="select-container w-100 questions-filter">
                                                        <select class="select-container-select">
                                                            <option value="{{ $course->id }}"> All lectures
                                                            </option>
                                                            <option value=""> Current lecture </option>
                                                        </select>
                                                    </div>
                                                </div><!-- end question-overview-filter-item -->

                                                <div class="question-overview-filter-item">
                                                    <div class="generic-action-wrap">
                                                        <div class="dropdown">
                                                            <a class="btn theme-btn theme-btn-transparent w-100"
                                                                href="#" data-toggle="dropdown"
                                                                aria-haspopup="true" aria-expanded="false">
                                                                Filter questions
                                                            </a>
                                                            <div class="dropdown-menu">

                                                                <div class="dropdown-item">
                                                                    <div class="custom-control custom-checkbox fs-15">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input"
                                                                            id="questionsIAsked" required>
                                                                        <label
                                                                            class="custom-control-label custom--control-label"
                                                                            for="questionsIAsked">
                                                                            Questions I asked
                                                                        </label>
                                                                    </div><!-- end custom-control -->
                                                                </div>
                                                                <div class="dropdown-item">
                                                                    <div class="custom-control custom-checkbox fs-15">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input"
                                                                            id="questionsWithNoResponses" required>
                                                                        <label
                                                                            class="custom-control-label custom--control-label"
                                                                            for="questionsWithNoResponses">
                                                                            Questions without responses
                                                                        </label>
                                                                    </div><!-- end custom-control -->
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div><!-- end generic-action-wrap -->
                                                </div><!-- end question-overview-filter-item -->
                                            </div>
                                        </div><!-- end lecture-overview-item -->
                                        {{-- end search filter --}}


                                        <div class="lecture-overview-item">
                                            <div
                                                class="question-overview-result-header d-flex align-items-center justify-content-between">
                                                <h3 class="fs-17 font-weight-semi-bold" id="number-of-questions">
                                                    {{ $course->questions->count() }} questions in this course
                                                </h3>
                                                <button
                                                    class="btn theme-btn theme-btn-sm theme-btn-transparent ask-new-question-btn">Ask
                                                    a new question</button>
                                            </div>
                                        </div><!-- end lecture-overview-item -->
                                        <div class="section-block"></div>
                                        <div class="lecture-overview-item mt-0">
                                            <div class="question-list-item">
                                                @if ($course->questions->count() > 0)
                                                    @include('frontend.course-lectures.includes._questions')
                                                @endif
                                            </div>

                                            <div class="question-btn-box pt-35px text-center" id="no-questions-box"
                                                @if ($course->questions->count() > 0) style="display: none;" @endif>
                                                <button class="btn theme-btn theme-btn-transparent w-100"
                                                    type="button">No Questions</button>
                                            </div>

                                            @if ($course->questions->count() > $questions->count())
                                                <div class="question-btn-box pt-35px text-center">
                                                    <button
                                                        class="btn theme-btn theme-btn-transparent w-100 see-more-questions-btn"
                                                        type="button">See More</button>
                                                </div>
                                            @endif
                                        </div><!-- end lecture-overview-item -->

                                    </div>
                                    {{--  end course questions with filters --}}
                                </div>
                            </div><!-- end tab-pane -->

                            {{-- ##################### end questions and answers ################### --}}


                            {{-- ##################### announcements ################### --}}

                            <div class="tab-pane fade" id="announcements" role="tabpanel"
                                aria-labelledby="announcements-tab">
                                <div class="lecture-overview-wrap lecture-announcement-wrap">
                                    <div class="lecture-overview-item">
                                        <div class="media media-card align-items-center">
                                            <a href="teacher-detail.html"
                                                class="media-img d-block rounded-full avatar-md">
                                                <img src="images/small-avatar-1.jpg" alt="Instructor avatar"
                                                    class="rounded-full">
                                            </a>
                                            <div class="media-body">
                                                <h5 class="pb-1"><a href="teacher-detail.html">Alex Smith</a>
                                                </h5>
                                                <div class="announcement-meta fs-15">
                                                    <span>Posted an announcement</span>
                                                    <span> · 3 years ago ·</span>
                                                    <a href="#" class="btn-text" data-toggle="modal"
                                                        data-target="#reportModal" title="Report abuse"><i
                                                            class="la la-flag"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="lecture-owner-decription pt-4">
                                            <h3 class="fs-19 font-weight-semi-bold pb-3">Important Q&A support</h3>
                                            <p>Happy 2019 to everyone, thank you for being a student and all of your
                                                support.</p>
                                            <p><strong>Great job on enrolling and your current course progress. I
                                                    encourage you keep in pursuit of your dreams :)</strong></p>
                                            <p>The whole lot. In my course After Effects Complete Course packed with
                                                all Techniques and Methods (No Tricks and gimmicks).</p>
                                            <p class="font-italic"><strong>Unfortunately this will result in
                                                    delayed responses by me in the Q&A section and to direct
                                                    messages. This is only for the next week and once back I will be
                                                    back to 100% .</strong></p>
                                            <p>I will continue to do my best to respond to as many questions as
                                                possible but only one person, regularly I spend 4-5 hours daily on
                                                this and with over 440000 students as you can image that its a lot
                                                of work.</p>
                                            <p class="font-italic">Thank you once again for your understanding and
                                                for all of the wonderful students who I have had an opportunity to
                                                communicate with regularly and all of your encouragement.</p>
                                            <p>Have an awesome day</p>
                                            <p>Alex</p>
                                        </div>
                                        <div class="lecture-announcement-comment-wrap pt-4">
                                            <div class="media media-card align-items-center">
                                                <div class="media-img rounded-full avatar-sm flex-shrink-0">
                                                    <img src="images/small-avatar-1.jpg" alt="Instructor avatar"
                                                        class="rounded-full">
                                                </div><!-- end media-img -->
                                                <div class="media-body">
                                                    <form action="#">
                                                        <div class="input-group">
                                                            <input
                                                                class="form-control form--control form--control-gray pl-3"
                                                                type="text" name="search"
                                                                placeholder="Enter your comment">
                                                            <div class="input-group-append">
                                                                <button class="btn theme-btn" type="button"><i
                                                                        class="la la-arrow-right"></i></button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div><!-- end media-body -->
                                            </div><!-- end media -->
                                            <div class="comments pt-40px">
                                                <div
                                                    class="media media-card mb-3 border-bottom border-bottom-gray pb-3">
                                                    <div class="media-img rounded-full avatar-sm flex-shrink-0">
                                                        <img src="images/small-avatar-2.jpg" alt="Instructor avatar"
                                                            class="rounded-full">
                                                    </div><!-- end media-img -->
                                                    <div class="media-body">
                                                        <div class="announcement-meta fs-15 lh-20">
                                                            <a href="#" class="text-color">Tony Olsson</a>
                                                            <span> · 3 years ago ·</span>
                                                            <a href="#" class="btn-text" data-toggle="modal"
                                                                data-target="#reportModal" title="Report abuse"><i
                                                                    class="la la-flag"></i></a>
                                                        </div>
                                                        <p class="pt-1">Occaecati cupiditate non provident,
                                                            similique sunt in culpa fuga.</p>
                                                    </div><!-- end media-body -->
                                                </div><!-- end media -->
                                                <div
                                                    class="media media-card mb-3 border-bottom border-bottom-gray pb-3">
                                                    <div class="media-img rounded-full avatar-sm flex-shrink-0">
                                                        <img src="images/small-avatar-3.jpg" alt="Instructor avatar"
                                                            class="rounded-full">
                                                    </div><!-- end media-img -->
                                                    <div class="media-body">
                                                        <div class="announcement-meta fs-15 lh-20">
                                                            <a href="#" class="text-color">Eduard-Dan</a>
                                                            <span> · 2 years ago ·</span>
                                                            <a href="#" class="btn-text" data-toggle="modal"
                                                                data-target="#reportModal" title="Report abuse"><i
                                                                    class="la la-flag"></i></a>
                                                        </div>
                                                        <p class="pt-1">Occaecati cupiditate non provident,
                                                            similique sunt in culpa fuga.</p>
                                                    </div><!-- end media-body -->
                                                </div><!-- end media -->
                                            </div><!-- end comments -->
                                        </div><!-- end lecture-announcement-comment-wrap -->
                                    </div><!-- end lecture-overview-item -->
                                </div>
                            </div><!-- end tab-pane -->

                            {{-- ##################### end announcements ################### --}}

                        </div><!-- end tab-content -->
                    </div><!-- end lecture-video-detail-body -->
                </div><!-- end lecture-video-detail -->

                {{-- ##################### Top companies choose ################### --}}

                <div class="cta-area py-4 bg-gray">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <div class="col-lg-6">
                                <div class="cta-content-wrap">
                                    <h3 class="fs-18 font-weight-semi-bold">Top companies choose <a
                                            href="for-business.html" class="text-color hover-underline">Aduca
                                            for Business</a> to build in-demand career skills.</h3>
                                </div>
                            </div><!-- end col-lg-6 -->
                            <div class="col-lg-6">
                                <div class="client-logo-wrap text-right">
                                    <a href="#" class="client-logo-item client--logo-item-2 pr-3"><img
                                            src="images/sponsor-img.png" alt="brand image"></a>
                                    <a href="#" class="client-logo-item client--logo-item-2 pr-3"><img
                                            src="images/sponsor-img2.png" alt="brand image"></a>
                                    <a href="#" class="client-logo-item client--logo-item-2 pr-3"><img
                                            src="images/sponsor-img3.png" alt="brand image"></a>
                                </div><!-- end client-logo-wrap -->
                            </div><!-- end col-lg-6 -->
                        </div><!-- end row -->
                    </div><!-- end container-fluid -->
                </div><!-- end cta-area -->

                {{-- ##################### end Top companies choose ################### --}}

                {{-- ##################### footer-area ################### --}}

                <div class="footer-area pt-50px">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-3 responsive-column-half">
                                <div class="footer-item">
                                    <a href="index.html">
                                        <img src="images/logo.png" alt="footer logo" class="footer__logo">
                                    </a>
                                    <ul class="generic-list-item pt-4">
                                        <li><a href="tel:+1631237884">+163 123 7884</a></li>
                                        <li><a href="mailto:support@wbsite.com">support@website.com</a></li>
                                        <li>Melbourne, Australia, 105 South Park Avenue</li>
                                    </ul>
                                </div><!-- end footer-item -->
                            </div><!-- end col-lg-3 -->
                            <div class="col-lg-3 responsive-column-half">
                                <div class="footer-item">
                                    <h3 class="fs-20 font-weight-semi-bold pb-3">Company</h3>
                                    <ul class="generic-list-item">
                                        <li><a href="#">About us</a></li>
                                        <li><a href="#">Contact us</a></li>
                                        <li><a href="#">Become a Teacher</a></li>
                                        <li><a href="#">Support</a></li>
                                        <li><a href="#">FAQs</a></li>
                                        <li><a href="#">Blog</a></li>
                                    </ul>
                                </div><!-- end footer-item -->
                            </div><!-- end col-lg-3 -->
                            <div class="col-lg-3 responsive-column-half">
                                <div class="footer-item">
                                    <h3 class="fs-20 font-weight-semi-bold pb-3">Courses</h3>
                                    <ul class="generic-list-item">
                                        <li><a href="#">Web Development</a></li>
                                        <li><a href="#">Hacking</a></li>
                                        <li><a href="#">PHP Learning</a></li>
                                        <li><a href="#">Spoken English</a></li>
                                        <li><a href="#">Self-Driving Car</a></li>
                                        <li><a href="#">Garbage Collectors</a></li>
                                    </ul>
                                </div><!-- end footer-item -->
                            </div><!-- end col-lg-3 -->
                            <div class="col-lg-3 responsive-column-half">
                                <div class="footer-item">
                                    <h3 class="fs-20 font-weight-semi-bold pb-3">Download App</h3>
                                    <div class="mobile-app">
                                        <p class="pb-3 lh-24">Download our mobile app and learn on the go.</p>
                                        <a href="#" class="d-block mb-2 hover-s"><img src="images/appstore.png"
                                                alt="App store" class="img-fluid"></a>
                                        <a href="#" class="d-block hover-s"><img src="images/googleplay.png"
                                                alt="Google play store" class="img-fluid"></a>
                                    </div>
                                </div><!-- end footer-item -->
                            </div><!-- end col-lg-3 -->
                        </div><!-- end row -->
                    </div><!-- end container-fluid -->
                    <div class="section-block"></div>
                    <div class="copyright-content py-4">
                        <div class="container-fluid">
                            <div class="row align-items-center">
                                <div class="col-lg-6">
                                    <p class="copy-desc">&copy; 2021 Aduca. All Rights Reserved. by <a
                                            href="https://techydevs.com/">TechyDevs</a></p>
                                </div><!-- end col-lg-6 -->
                                <div class="col-lg-6">
                                    <div class="d-flex flex-wrap align-items-center justify-content-end">
                                        <ul class="generic-list-item d-flex flex-wrap align-items-center fs-14">
                                            <li class="mr-3"><a href="terms-and-conditions.html">Terms &
                                                    Conditions</a></li>
                                            <li class="mr-3"><a href="privacy-policy.html">Privacy Policy</a>
                                            </li>
                                        </ul>
                                        <div class="select-container select-container-sm">
                                            <select class="select-container-select">
                                                <option value="1">English</option>
                                                <option value="2">Deutsch</option>
                                                <option value="3">Español</option>
                                                <option value="4">Français</option>
                                                <option value="5">Bahasa Indonesia</option>
                                                <option value="6">Bangla</option>
                                                <option value="7">日本語</option>
                                                <option value="8">한국어</option>
                                                <option value="9">Nederlands</option>
                                                <option value="10">Polski</option>
                                                <option value="11">Português</option>
                                                <option value="12">Română</option>
                                                <option value="13">Русский</option>
                                                <option value="14">ภาษาไทย</option>
                                                <option value="15">Türkçe</option>
                                                <option value="16">中文(简体)</option>
                                                <option value="17">中文(繁體)</option>
                                                <option value="17">Hindi</option>
                                            </select>
                                        </div>
                                    </div>
                                </div><!-- end col-lg-6 -->
                            </div><!-- end row -->
                        </div><!-- end container-fluid -->
                    </div><!-- end copyright-content -->
                </div><!-- end footer-area -->

                {{-- ##################### end footer-area ################### --}}


            </div><!-- end course-dashboard-column -->

            {{-- ##################### course-dashboard-sidebar ################### --}}

            <div class="course-dashboard-sidebar-column">
                <button class="sidebar-open" type="button"><i class="la la-angle-left"></i> Course
                    content</button>
                <div class="course-dashboard-sidebar-wrap custom-scrollbar-styled">
                    <div class="course-dashboard-side-heading d-flex align-items-center justify-content-between">
                        <h3 class="fs-18 font-weight-semi-bold">Course content</h3>
                        <button class="sidebar-close" type="button"><i class="la la-times"></i></button>
                    </div><!-- end course-dashboard-side-heading -->
                    <div class="course-dashboard-side-content">
                        <div class="accordion generic-accordion generic--accordion" id="accordionCourseExample">
                            @foreach ($course->sections as $section)
                                <div class="card">
                                    <div class="card-header" id="headingOne{{ $section->id }}">
                                        <button class="btn btn-link" type="button" data-toggle="collapse"
                                            data-target="#collapseOne{{ $section->id }}" aria-expanded="true"
                                            aria-controls="collapseOne{{ $section->id }}">
                                            <i class="la la-angle-down"></i>
                                            <i class="la la-angle-up"></i>
                                            <span class="fs-15"> Section {{ $loop->iteration }}:
                                                {{ $section->title }}</span>
                                            <span class="course-duration">
                                                <span>1/{{ $section->lectures->count() }}</span>
                                                <span>21min</span>
                                            </span>
                                        </button>
                                    </div><!-- end card-header -->
                                    <div id="collapseOne{{ $section->id }}"
                                        class="collapse {{ $loop->iteration == 1 ? 'show' : '' }}"
                                        aria-labelledby="headingOne{{ $section->id }}"
                                        data-parent="#accordionCourseExample">
                                        <div class="card-body p-0">
                                            <ul class="curriculum-sidebar-list">
                                                @foreach ($section->lectures as $lecture)
                                                    <li class="course-item-link active-resource section-lecture"
                                                        data-id="{{ $lecture->id }}">
                                                        <div class="course-item-content-wrap">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input"
                                                                    id="courseCheckbox{{ $lecture->id }}" required>
                                                                <label
                                                                    class="custom-control-label custom--control-label"
                                                                    for="courseCheckbox{{ $lecture->id }}"></label>
                                                            </div><!-- end custom-control -->
                                                            <div class="course-item-content">
                                                                <h4 class="fs-15">{{ $loop->iteration }}.
                                                                    {{ $lecture->title }}</h4>
                                                                <div class="courser-item-meta-wrap">
                                                                    <p class="course-item-meta"><i
                                                                            class="la la-file"></i>2min</p>
                                                                    {{-- <p class="course-item-meta"><i
                                                                            class="la la-play-circle"></i>2min</p> --}}
                                                                    <div class="generic-action-wrap">
                                                                        <div class="dropdown">
                                                                            <a class="btn theme-btn theme-btn-sm theme-btn-transparent mt-1 fs-14 font-weight-medium"
                                                                                href="#" data-toggle="dropdown"
                                                                                aria-haspopup="true"
                                                                                aria-expanded="false">
                                                                                <i class="la la-folder-open mr-1"></i>
                                                                                Resources<i
                                                                                    class="la la-angle-down ml-1"></i>
                                                                            </a>
                                                                            <div
                                                                                class="dropdown-menu dropdown-menu-right">
                                                                                <a class="dropdown-item"
                                                                                    href="javascript:void(0)">
                                                                                    Section-Footage.zip
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div><!-- end generic-action-wrap -->
                                                                </div>
                                                            </div><!-- end course-item-content -->
                                                        </div><!-- end course-item-content-wrap -->
                                                    </li>
                                                @endforeach

                                            </ul>
                                        </div><!-- end card-body -->
                                    </div><!-- end collapse -->
                                </div><!-- end card -->
                            @endforeach


                        </div><!-- end accordion-->
                    </div><!-- end course-dashboard-side-content -->
                </div><!-- end course-dashboard-sidebar-wrap -->
            </div><!-- end course-dashboard-sidebar-column -->

            {{-- ##################### end course-dashboard-sidebar ################### --}}


        </div><!-- end course-dashboard-container -->
    </div><!-- end course-dashboard-wrap -->
</section><!-- end course-dashboard -->
