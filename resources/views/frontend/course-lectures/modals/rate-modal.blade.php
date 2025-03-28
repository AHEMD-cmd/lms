<div class="modal fade modal-container" id="ratingModal" tabindex="-1" role="dialog" aria-labelledby="ratingModalTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-gray">
                <div class="pr-2">
                    <h5 class="modal-title fs-19 font-weight-semi-bold lh-24" id="ratingModalTitle">
                        How would you rate this course?
                    </h5>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="la la-times"></span>
                </button>
            </div><!-- end modal-header -->
            <form action="" id="review-form">
                @csrf
                <input type="hidden" name="course_id" value="{{ $course->id }}" id="course-id" data-course-slug="{{$course->slug}}">
                <div class="modal-body text-center py-5">
                    <div class="leave-rating mt-5">
                        <input type="radio" name='rate' id="star5" value="5" />
                        <label for="star5" class="fs-45"></label>
                        <input type="radio" name='rate' id="star4" value="4" />
                        <label for="star4" class="fs-45"></label>
                        <input type="radio" name='rate' id="star3" value="3" />
                        <label for="star3" class="fs-45"></label>
                        <input type="radio" name='rate' id="star2" value="2" />
                        <label for="star2" class="fs-45"></label>
                        <input type="radio" name='rate' id="star1" value="1" />
                        <label for="star1" class="fs-45"></label>
                        <div class="rating-result-text fs-20 pb-4"></div>
                    </div><!-- end leave-rating -->
                    <div class="form-group mt-4 d-none course-review">
                        <textarea class="form-control" id="review-text" name="comment" rows="4"
                            placeholder="Write your review about this course..."></textarea>
                    </div>
                    <div class="form-group mt-4 d-none submit-review text-right">
                            <button type="submit" class="btn theme-btn theme-btn-sm">Submit</button>
                    </div>
                </div><!-- end modal-body -->
            </form>
        </div><!-- end modal-content -->
    </div><!-- end modal-dialog -->
</div>
