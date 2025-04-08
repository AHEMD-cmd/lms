<div class="modal fade modal-container" id="reportModal" tabindex="-1" role="dialog"
        aria-labelledby="reportModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-bottom-gray">
                    <div class="pr-2">
                        <h5 class="modal-title fs-19 font-weight-semi-bold lh-24" id="reportModalTitle">Report Abuse</h5>
                        <p class="pt-1 fs-14 lh-24">Flagged content is reviewed by Aduca staff to determine whether it
                            violates Terms of Service or Community Guidelines. If you have a question or technical issue,
                            please contact our
                            <a href="contact.html" class="text-color hover-underline">Support team here</a>.
                        </p>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="la la-times"></span>
                    </button>
                </div><!-- end modal-header -->
                <div class="modal-body">
                    <form id="reportForm" method="post">
                        @csrf
                        <div class="input-box">
                            <label class="label-text">Select Report Type</label>
                            <div class="form-group">
                                <div class="select-container w-auto">
                                    <select class="select-container-select" name="report_type" id="report_type">
                                        <option value>-- Select One --</option>
                                        <option value="Inappropriate Course Content">Inappropriate Course Content</option>
                                        <option value="Inappropriate Behavior">Inappropriate Behavior</option>
                                        <option value="Aduca Policy Violation">Aduca Policy Violation</option>
                                        <option value="Spammy Content">Spammy Content</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                                <span class="error-message text-danger"> </span>
                            </div>
                        </div>
                        <input type="hidden" name="review_id" id="review_id">
                        <div class="input-box">
                            <label class="label-text">Write Message</label>
                            <div class="form-group">
                                <textarea class="form-control form--control pl-3" name="message" id="message"
                                    placeholder="Provide additional details here..." rows="5"></textarea>
                                    <span class="error-message text-danger"> </span>
                            </div>
                        </div>
                        <div class="btn-box text-right pt-2">
                            <button type="button" class="btn font-weight-medium mr-3"
                                data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn theme-btn theme-btn-sm lh-30">Submit <i
                                    class="la la-arrow-right icon ml-1"></i></button>
                        </div>
                    </form>
                </div><!-- end modal-body -->
            </div><!-- end modal-content -->
        </div><!-- end modal-dialog -->
    </div><!-- end modal -->