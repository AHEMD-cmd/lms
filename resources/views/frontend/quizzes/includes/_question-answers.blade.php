<!-- ================================
    START BREADCRUMB AREA
================================= -->
<section class="breadcrumb-area">
    <div class="bg-white py-3 pattern-bg">
        <div class="container">
            <div class="breadcrumb-content">
                <ul class="quiz-nav d-flex flex-wrap align-items-center">
                    <li><a href="course-details.html"><i class="la la-arrow-left mr-2"></i>Back to Course</a></li>
                    <li>
                        <div class="d-flex align-items-center">
                            <a href="{{ route('courses.lectures.index', $course->slug)}}">
                                <img src="{{ asset($course->image) }}" alt="{{ $course->title }} thumbnail">
                            </a>
                            <p>
                                <a href="{{ route('courses.lectures.index', $course->slug)}}">{{ $course->title }}</a><span
                                    class="d-block fs-13">{{ $course->instructor->name }}</span>
                            </p>
                        </div>
                    </li>
                </ul>
            </div><!-- end breadcrumb-content -->
        </div><!-- end container -->
    </div>
    <div class="bg-dark pt-60px pb-60px">
        <div class="container">
            <ul class="quiz-course-nav d-flex align-items-center justify-content-between">
                <li>
                    <a href="course-details.html" class="icon-element icon-element-sm" data-toggle="tooltip"
                        data-placement="top" title="Getting Started with Angular: Introduction">
                        <i class="la la-check"></i>
                    </a>
                </li>
                <li>
                    <a href="course-details.html" class="icon-element icon-element-sm" data-toggle="tooltip"
                        data-placement="top" title="Getting Started with Angular: Introduction to TypeScript">
                        <i class="la la-check"></i>
                    </a>
                </li>
                <li>
                    <a href="course-details.html" class="icon-element icon-element-sm" data-toggle="tooltip"
                        data-placement="top" title="Getting Started with Angular: Comparing Angular to AngularJS">
                        <i class="la la-check"></i>
                    </a>
                </li>
                <li>
                    <a href="student-quiz.html" class="icon-element icon-element-sm text-success" data-toggle="tooltip"
                        data-placement="top" title="Quiz: Getting Started with Angular">
                        <i class="la la-user"></i>
                    </a>
                </li>
            </ul>
            <div class="breadcrumb-content pt-40px">
                <div class="section-heading">
                    <h2 class="section__title text-white fs-30 pb-2">
                        Question {{ $quiz->questions->search(fn($q) => $q->id === $question->id) + 1 }}
                        of {{ $quiz->questions->count() }}
                    </h2>
                    <p class="section__desc text-white-50">{{ $question->question_text }}</p>
                    <input type="hidden" value="{{ $question->id }}" id="questionId">
                </div>
            </div>
        </div><!-- end container -->
    </div>
    <div class="quiz-action-nav bg-white py-3 shadow-sm">
        <div class="container">
            <div class="quiz-action-content d-flex flex-wrap align-items-center justify-content-between">
                <ul class="quiz-nav d-flex align-items-center">
                    <li><i class="la la-sliders fs-17 mr-2"></i>Choose the correct answer below</li>
                </ul>
                <div class="quiz-nav-btns">
                    <a href="student-quiz-result-details.html" class="btn theme-btn theme-btn-transparent mr-2">Skip
                        Quiz</a>
                    <a href="course-details.html" class="btn theme-btn theme-btn-transparent mr-2">Review Video</a>
                    <a href="javascript:void(0);" class="btn theme-btn" id="nextQuestionBtn">
                        Next Question <i class="la la-angle-right icon ml-1"></i>
                    </a>
                    <form method="POST" class="d-none" id="quizForm">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="question_id" id="questionId" value="{{ $question->id }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="button" id="submitQuizBtn" class="btn theme-btn">Submit</button>
                    </form>
                </div>
            </div>
        </div><!-- end container -->
    </div><!-- end quiz-action-nav -->
</section><!-- end breadcrumb-area -->
<!-- ================================
    END BREADCRUMB AREA
================================= -->

<!-- ================================
       START QUIZ ANS AREA
================================= -->
<section class="quiz-ans-wrap pt-60px pb-60px">
    <div class="container">
        <div class="quiz-ans-content">
            <h3 class="fs-22 font-weight-semi-bold">Your Answer:</h3>
            <div class="quiz-ans-list py-3">
                @foreach ($question->options as $option)
                    <div class="custom-control custom-checkbox mb-1">
                        <input type="{{ $question->is_multiple ? 'checkbox' : 'radio' }}" class="custom-control-input"
                            id="{{ $option->id }}" name="option_ids[]" value="{{ $option->id }}">
                        <label class="custom-control-label custom--control-label" for="{{ $option->id }}">
                            {{ $option->option_text }}
                        </label>
                    </div><!-- end custom-control -->
                @endforeach
            </div><!-- end quiz-ans-list -->
            @if ($question->is_multiple)
                <p class="fs-15"><strong class="font-weight-semi-bold text-black">Note:</strong> There can be multiple
                    correct answers to this question.</p>
            @endif
        </div>
    </div><!-- end container -->
</section>
<!-- ================================
       START QUIZ ANS AREA
================================= -->
