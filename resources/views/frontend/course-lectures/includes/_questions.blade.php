@foreach ($questions as $question)
    <div class="media media-card border-bottom border-bottom-gray py-4 px-3">
        <div class="media-img rounded-full flex-shrink-0 avatar-sm">
            <img class="rounded-full" src="{{ asset($question->user->image) }}" alt="User image">
        </div>
        <div class="media-body">
            <div class="d-flex align-items-center justify-content-between">
                <div class="question-meta-content">
                    <a href="javascript:void(0)" class="d-block">
                        <h5 class="fs-16 pb-1">
                            {{ $question->subject }}</h5>
                        <p class="text-truncate fs-15 text-gray">
                            {{ $question->question }}
                        </p>
                    </a>
                </div><!-- end question-meta-content -->
                <div class="question-upvote-action">
                    <div class="number-upvotes pb-2 d-flex align-items-center">
                        <span id="upvote-count-@isset($question){{ $question->id }}@endisset">
                            @isset($question)
                                {{ $question->upvoteCount() }}
                            @endisset
                        </span>
                        <button type="button" class="arrow-up" data-id="@isset($question){{ $question->id }}@endisset"><i class="la la-arrow-up"></i></button>
                    </div>
                    <div class="number-upvotes question-response d-flex align-items-center">
                        <span>{{ $question->replies->count() }}</span>
                        <button type="button" class="question-replay-btn" data-id="{{ $question->id }}"><i
                                class="la la-comments"></i></button>
                    </div>
                </div><!-- end question-upvote-action -->
            </div>
            <p class="meta-tags pt-1 fs-13">
                <a href="#">{{ $question->user->name }}</a>
                <a href="#">Lecture {{ $question->lecture->number }}</a>
                <span>{{ $question->created_at->diffForhumans() }}</span>
            </p>
        </div><!-- end media-body -->
    </div><!-- end media -->
@endforeach
