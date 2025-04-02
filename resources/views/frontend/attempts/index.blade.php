@extends('layouts.frontend.master')

@section('title', 'Quiz Attempt')

@section('content')

    <!-- ================================
    START BREADCRUMB AREA
================================= -->
<section class="breadcrumb-area pt-5 bg-white pattern-bg">
    <div class="container">
        <div class="breadcrumb-content">
            <div class="media media-card align-items-center">
                <div class="media-img media--img media-img-md rounded-full">
                    <img class="rounded-full lazy" src="{{ auth()->user()->image }}" alt="{{ auth()->user()->name }}">
                </div>
                <div class="media-body">    
                    <h2 class="section__title fs-30">{{ auth()->user()->name }}</h2>
                    <span class="d-block lh-18 pt-1">Student</span>
                </div>
            </div><!-- end media -->
        </div><!-- end breadcrumb-content -->
    </div><!-- end container -->
    <div class="quiz-action-nav bg-white py-3 shadow-sm mt-50px">
        <div class="container">
            <div class="quiz-action-content d-flex flex-wrap align-items-center justify-content-between">
                <ul class="quiz-nav d-flex align-items-center">
                    <li><a href="dashboard.html">Dashboard</a></li>
                    <li><a href="my-courses.html">Courses</a></li>
                    <li><a href="student-detail.html">Profile</a></li>
                </ul>
                <div class="quiz-nav-btns">
                    <a href="dashboard-settings.html" class="btn theme-btn theme-btn-transparent mr-2">Setting</a>
                    <a href="dashboard-profile.html" class="btn theme-btn theme-btn-transparent">Edit Account</a>
                </div>
            </div>
        </div><!-- end container -->
    </div><!-- end quiz-action-nav -->
</section><!-- end breadcrumb-area -->
<!-- ================================
    END BREADCRUMB AREA
================================= -->

<!-- ================================
       START QUIZ RESULT AREA
================================= -->
<section class="quiz-result-area pt-60px pb-60px">
    <div class="container">
        <ul class="quiz-nav pb-4">
            <li>
                <div class="d-flex align-items-center">
                    <a href="course-details.html">
                        <img src="{{ $course->image }}" alt="{{ $course->title }} thumbnail" class="w-50px">
                    </a>
                    <p>
                        <a href="{{ route('courses.lectures.index', $course->slug) }}" class="fs-22 font-weight-semi-bold">{{ $course->title }}</a><span class="d-block pt-1">View Course</span>
                    </p>
                </div>
            </li>
        </ul>
        @foreach ($course->sections as $section)
            @if ($section->lectures->count())
                <div class="quiz-result-item mb-5">
                    <ul class="quiz-nav pb-4">
                        <li>
                            <div class="d-flex align-items-center">
                                <p>
                                    <h4>{{ $section->title }}</h4>
                                </p>
                            </div>
                        </li>
                    </ul>
                    <div class="list-group">
                        @foreach ($section->lectures as $lecture)
                            <a href="#" class="list-group-item list-group-item-action d-flex">
                                <div class="flex-grow-1">
                                    <h5 class="fs-16">{{ $lecture->title }}</h5>
                                    <small class="text-muted">{{ $lecture->duration }} min</small>
                                </div>
                                <div class="text-center">
                                    @if ($lecture->quiz)
                                        <span class="d-block lh-20 font-weight-semi-bold mb-n1">{{ $lecture->quiz->user_score ?? 'Not Attempted' }}</span>
                                        <small class="text-uppercase text-muted take-quiz" data-lecture-id="{{ $lecture->id }}" data-quiz-id="{{ $quiz->id }}" data-course-slug="{{ $course->slug }}">
                                            {{ $lecture->quiz->user_score ? 'Score' : 'Take Quiz' }}
                                        </small>
                                    @else
                                        <span class="d-block lh-20 font-weight-semi-bold mb-n1"> No quiz for this lecture </span>
                                    @endif
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div><!-- end quiz-result-item -->
            @endif
        @endforeach
    </div><!-- end container -->
</section><!-- end quiz-result-area -->
<!-- ================================
       START QUIZ RESULT AREA
================================= -->

<!--======================================
        START CTA AREA
======================================-->
<section class="cta-area py-5 position-relative overflow-hidden bg-gray">
    <span class="stroke-shape stroke-shape-1"></span>
    <span class="stroke-shape stroke-shape-2"></span>
    <span class="stroke-shape stroke-shape-3"></span>
    <span class="stroke-shape stroke-shape-4"></span>
    <span class="stroke-shape stroke-shape-5"></span>
    <span class="stroke-shape stroke-shape-6"></span>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="cta-content-wrap">
                    <h3 class="fs-20 font-weight-semi-bold lh-28">Top companies choose <a href="for-business.html" class="text-color hover-underline">Aduca for Business</a> to build in-demand career skills.</h3>
                </div>
            </div><!-- end col-lg-6 -->
            <div class="col-lg-6">
                <div class="client-logo-wrap text-right">
                    <a href="#" class="client-logo-item client--logo-item-2 pr-3"><img src="images/sponsor-img.png" alt="brand image"></a>
                    <a href="#" class="client-logo-item client--logo-item-2 pr-3"><img src="images/sponsor-img2.png" alt="brand image"></a>
                    <a href="#" class="client-logo-item client--logo-item-2 pr-3"><img src="images/sponsor-img3.png" alt="brand image"></a>
                </div><!-- end client-logo-wrap -->
            </div><!-- end col-lg-6 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end cta-area -->
<!--======================================
        END CTA AREA
======================================-->


@endsection



@push('scripts')
    <script>
        $(document).ready(function() {
            
            $('.take-quiz').on('click', function() {
                let lectureId = $(this).data('lecture-id');
                let quizId = $(this).data('quiz-id');
                let courseSlug = $(this).data('course-slug');
                window.location.href = `/courses/${courseSlug}/lectures/${lectureId}/quizzes/${quizId}`;
            });
        });
    </script>
@endpush
