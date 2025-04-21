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
            <div class="breadcrumb-content text-center">
                <div class="section-heading">
                    <p class="section__desc text-white-50">Submitted on {{ $attempt->created_at->format('d M Y') }}</p>
                    <h2 class="section__title text-white pt-2">Your Score is: {{ $attempt->score }}</h2>
                </div>
                <div class="breadcrumb-btn-box pt-30px">
                    <a href="{{ route('courses.lectures.quizzes.show', [$course->slug, $quiz->lecture->id, $quiz->id]) }}"
                        class="btn theme-btn theme-btn-transparent text-white-50 mr-2 mb-2">Restart Quiz</a>
                    <a href="{{ route('courses.quizzes.attempts.index', [$course->slug, $quiz->id]) }}"
                        class="btn theme-btn theme-btn-transparent text-white-50 mb-2">View Attended Quiz</a>
                </div>
            </div>
        </div><!-- end container -->
    </div>
    <div class="quiz-action-nav bg-white py-3 shadow-sm">
        <div class="container">
            <div class="quiz-action-content d-flex flex-wrap align-items-center justify-content-between">
                <ul class="quiz-nav d-flex flex-wrap align-items-center">
                    <li><i
                            class="la la-check-circle fs-17 mr-2"></i>{{ $attempt->score }}/{{ $quiz->questions->count() }}
                        Score</li>
                    <li><i class="la la-clock fs-17 mr-2"></i>{{ $attempt->duration }}</li>
                    {{-- <li><i class="la la-bar-chart fs-17 mr-2"></i>Intermediate</li> --}}
                </ul>


                <a href="javascript:void(0);"
                    class="btn theme-btn {{ $quiz->questions->first()->id === $question->id ? 'd-none' : '' }}"
                    id="prevQuestionBtn">
                    Previous Question <i class="la la-angle-left icon ml-1"></i>
                </a>

                <a href="javascript:void(0);"
                    class="btn theme-btn {{ $quiz->questions->last()->id === $question->id ? 'd-none' : '' }}"
                    id="nextQuestionBtn">
                    Next Question <i class="la la-angle-right icon ml-1"></i>
                </a>

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
            <div class="d-flex align-items-center">
                {{-- <span class="icon-element icon-element-sm mr-2 bg-1 text-white">2</span> --}}
                <h3 class="fs-22 font-weight-semi-bold">Question
                    {{ $quiz->questions->search(fn($q) => $q->id === $question->id) + 1 }} of
                    {{ $quiz->questions->count() }}</h3>
            </div>
            <p class="pt-2">{{ $question->question_text }}</p>
            <input type="hidden" value="{{ $question->id }}" id="questionId">
            <ul class="quiz-result-list pt-4 pl-3">
                @php
                    // Get all selected options for the question
                    $userAnswers = $attempt->answers
                        ->where('question_id', $question->id)
                        ->pluck('option_id')
                        ->toArray();
                @endphp

                @foreach ($question->options as $option)
                    <li class="text-black mb-2">
                        @if (in_array($option->id, $userAnswers))
                            @if ($option->is_correct)
                                <span
                                    class="icon-element icon-element-xs bg-success text-white mr-2 border border-gray">
                                    <i class="la la-check"></i>
                                </span>
                            @else
                                <span class="icon-element icon-element-xs bg-danger text-white mr-2 border border-gray">
                                    <i class="la la-times"></i>
                                </span>
                            @endif
                            {{ $option->option_text }}
                        @elseif ($option->is_correct)
                            <span class="icon-element icon-element-xs bg-success text-white mr-2 border border-gray">
                                 <i class="la la-check"></i> 
                            </span>
                            {{ $option->option_text }} <span class="text-danger"> ( not selected )</span>
                        @else
                            <span class="icon-element icon-element-xs bg-secondary text-white mr-2 border border-gray">
                                {{ chr(64 + $loop->iteration) }} {{-- Converts 1 -> A, 2 -> B, etc. --}}
                            </span>
                            {{ $option->option_text }}
                        @endif
                    </li>
                @endforeach
            </ul>



        </div>
    </div><!-- end container -->
</section>
<!-- ================================
       START QUIZ ANS AREA
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
                    <h3 class="fs-20 font-weight-semi-bold lh-28">Top companies choose <a href="for-business.html"
                            class="text-color hover-underline">Aduca for Business</a> to build in-demand career skills.
                    </h3>
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
    </div><!-- end container -->
</section><!-- end cta-area -->
<!--======================================
        END CTA AREA
======================================-->
