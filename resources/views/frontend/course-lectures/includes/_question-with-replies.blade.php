<div class="replay-question-wrap">
    <button class="btn theme-btn theme-btn-transparent back-to-question-btn"><i class="la la-reply mr-1"></i>Back to all
        questions</button>
    <div class="replay-question-body pt-30px">
        <div class="question-list-item">
            <div class="media media-card border-bottom border-bottom-gray py-4">
                <div class="media-img rounded-full flex-shrink-0 avatar-sm">
                    <img class="rounded-full" src="images/small-avatar-1.jpg" alt="User image">
                </div>

                <div class="media-body">
                    <div class="d-flex justify-content-between">
                        <div class="question-meta-content">
                            <h5 class="fs-16 pb-1">
                                @isset($question)
                                    {{ $question->subject }}

                                @endisset
                            </h5>
                            <p class="meta-tags fs-13">
                                <a href="#">
                                    @isset($question)
                                        {{ $question->user->name }}
                                    @endisset
                                </a>
                                <a href="#">Lecture
                                    @isset($question)
                                        {{ $question->lecture->number }}
                                    @endisset
                                </a>
                                <span>
                                    @isset($question)
                                        {{ $question->created_at->diffForhumans() }}
                                    @endisset
                                </span>
                            </p>
                            <p class="fs-15 text-gray">
                                @isset($question)
                                    {{ $question->question }}
                                @endisset
                            </p>
                        </div><!-- end question-meta-content -->
                        <div class="question-upvote-action">
                            <div class="number-upvotes pb-2 d-flex align-items-center generic-action-wrap">
                                <span id="upvote-count-@isset($question){{ $question->id }}@endisset">
                                    @isset($question)
                                        {{ $question->upvoteCount() }}
                                    @endisset
                                </span>
                                <button type="button" class="arrow-up" data-id="@isset($question){{ $question->id }}@endisset"><i class="la la-arrow-up"></i></button>
                                <div class="dropdown">
                                    <button class="ml-0" type="button" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        <i class="la la-ellipsis-v"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#" data-toggle="modal"
                                            data-target="#reportModal"><i class="la la-flag mr-1"></i>
                                            Report abuse</a>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end question-upvote-action -->
                    </div>
                </div><!-- end media-body -->
            </div><!-- end media -->
            <div class="question-replay-separator-wrap d-flex align-items-center justify-content-between py-3">
                <h4 class="fs-16 font-weight-semi-bold">
                    @isset($question)
                        {{ $question->replies->count() }} {{ $question->replies->count() == 1 ? 'Replay' : 'Replays' }}
                    @endisset </h4>
                <button class="btn swapping-btn text-gray font-weight-medium" data-text-swap="Following replies"
                    data-text-original="Follow replies">Follow replies</button>
            </div><!-- end question-replay-separator-wrap -->
            <div class="section-block"></div>
            <div class="question-answer-wrap">

                @isset($question)
                    @foreach ($question->replies as $reply)
                        <div class="media media-card mb-3 border-bottom border-bottom-gray py-4">
                            <div class="media-img rounded-full avatar-sm flex-shrink-0">
                                <img src="{{ asset($reply->user->image) }}" alt="Instructor avatar" class="rounded-full">
                            </div><!-- end media-img -->
                            <div class="media-body">
                                <h5 class="fs-16"><a href="#">{{ $reply->user->name }}</a>
                                </h5>
                                <span class="fs-14">{{ $reply->created_at->diffForhumans() }}</span>
                                <p class="pt-1 fs-15">{{ $reply->question }}</p>
                            </div><!-- end media-body -->
                        </div><!-- end media -->
                    @endforeach
                @endisset

                <div class="question-replay-input-wrap pt-20px">
                    <div class="question-replay-body">
                        <h3 class="fs-16 font-weight-semi-bold">Add Replay</h3>
                        <form method="post" class="pt-4 reply-form">
                            @csrf
                            <input type="hidden" name="question_id"
                                value="@isset($question){{ $question->id }}@endisset">
                            <input type="hidden" name="course_id"
                                value="@isset($question){{ $question->course_id }}@endisset">
                            <input type="hidden" name="lecture_id" class="lecture-id"
                                value="@isset($question){{ $question->lecture_id }}@endisset">
                            <div class="form-group">
                                <textarea class="form-control form--control pl-3" name="question" rows="4" placeholder="Write your response..."></textarea>
                            </div>
                            <div class="btn-box">
                                <button class="btn theme-btn" type="submit">Add
                                    an answer <i class="la la-arrow-right icon ml-1"></i></button>
                            </div>
                        </form>
                    </div>
                </div><!-- end question-replay-input-wrap -->
            </div><!-- end question-answer-wrap -->
        </div><!-- end question-list-item -->
    </div><!-- end replay-question-body -->
</div><!-- end replay-question-wrap -->
