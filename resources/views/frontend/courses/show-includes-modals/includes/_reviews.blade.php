@foreach ($reviews as $review)
    <div class="media media-card border-bottom border-bottom-gray pb-4 mb-4">
        <div class="media-img mr-4 rounded-full">
            <img class="rounded-full lazy" src="{{ $review->user->photo }}" data-src="images/small-avatar-1.jpg"
                alt="User image">
        </div>
        <div class="media-body">
            <div class="d-flex flex-wrap align-items-center justify-content-between pb-1">
                <h5>{{ $review->user->name }}</h5>
                <div class="review-stars">
                    @for ($i = 1; $i <= $review->rate; $i++)
                        <span class="la la-star"></span>
                    @endfor
                </div>
            </div>
            <span class="d-block lh-18 pb-2">{{ $review->created_at->diffForHumans() }}</span>
            <p class="pb-2">
                {{ $review->comment }}
            </p>
            <div class="helpful-action">
                {{-- <span class="d-block fs-13">Was this review helpful?</span>
            <button class="btn">Yes</button>
            <button class="btn">No</button> --}}
                <span class="btn-text fs-14 cursor-pointer pl-1 report-review" data-toggle="modal" data-target="#reportModal"
                    data-id="{{ $review->id }}">Report</span>
            </div>
        </div>
    </div><!-- end media -->
@endforeach
