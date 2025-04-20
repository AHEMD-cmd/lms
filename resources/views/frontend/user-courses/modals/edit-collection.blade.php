<div class="modal fade modal-container" id="editCollectionModal" tabindex="-1" role="dialog" aria-labelledby="editCollectionModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-gray">
                <h5 class="modal-title fs-19 font-weight-semi-bold lh-24" id="editCollectionModalTitle">Edit your collection</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="la la-times"></span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editCollectionForm">
                    <input type="hidden" id="editCollectionId">
                    <div class="input-box">
                        <label class="label-text">Collection Title</label>
                        <div class="form-group">
                            <input class="form-control form--control pl-3" type="text" id="editCollectionName">
                        </div>
                    </div>
                    <div class="input-box">
                        <label class="label-text">Description</label>
                        <div class="form-group">
                            <textarea class="form-control form--control pl-3" id="editCollectionDescription" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="btn-box text-right pt-2">
                        <button type="button" class="btn font-weight-medium mr-3" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn theme-btn theme-btn-sm lh-30">Save Changes <i class="la la-arrow-right icon ml-1"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
