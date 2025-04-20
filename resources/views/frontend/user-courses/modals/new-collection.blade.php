<!-- Modal -->
<div class="modal fade modal-container" id="createNewCollectionModal{{ $course->id }}" tabindex="-1" role="dialog" aria-labelledby="createNewCollectionModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-gray">
                <div class="pr-2">
                    <h5 class="modal-title fs-19 font-weight-semi-bold lh-24" id="createNewCollectionModalTitle">Create new collection</h5>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="la la-times"></span>
                </button>
            </div><!-- end modal-header -->
            <div class="modal-body">
                <form class="createCollectionForm" action="{{ route('collections.store') }}" method="POST" data-course-id="{{ $course->id }}">
                    @csrf
                    <div class="input-box">
                        <label class="label-text">Collection Title</label>
                        <div class="form-group">
                            <input class="form-control form--control pl-3" type="text" name="name" placeholder="Name your collection e.g. HTML skills" required>
                        </div>
                    </div>
                    <div class="input-box">
                        <label class="label-text">Description</label>
                        <div class="form-group">
                            <textarea class="form-control form--control pl-3" name="description" rows="5" placeholder="Why are you creating this collection? e.g. To start a new business, To get a new job, To become a web developer"></textarea>
                        </div>
                    </div>
                    <input type="hidden" name="course_id" value="{{ $course->id }}">
                    <div class="btn-box text-right pt-2">
                        <button type="button" class="btn font-weight-medium mr-3" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn theme-btn theme-btn-sm lh-30">Create <i class="la la-arrow-right icon ml-1"></i></button>
                    </div>
                </form>
            </div><!-- end modal-body -->
        </div><!-- end modal-content -->
    </div><!-- end modal-dialog -->
</div><!-- end modal -->