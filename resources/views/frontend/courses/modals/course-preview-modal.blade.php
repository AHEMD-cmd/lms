<div class="modal fade modal-container" id="previewModal" tabindex="-1" role="dialog" aria-labelledby="previewModalTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-gray">
                <div class="pr-2">
                    <p class="pb-2 font-weight-semi-bold">Course Preview</p>
                    <h5 class="modal-title fs-19 font-weight-semi-bold lh-24" id="previewModalTitle">
                        {{ $course->title }}</h5>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="la la-times"></span>
                </button>
            </div><!-- end modal-header -->
            <div class="modal-body">
                <video controls playsinline poster="{{ asset($course->image) }}" class="w-100"
                    id="player">
                    <!-- Video files -->
                    <source src="{{ $course->video_path }}" type="video/mp4">
                </video>
            </div><!-- end modal-body -->
        </div><!-- end modal-content -->
    </div><!-- end modal-dialog -->
</div>
