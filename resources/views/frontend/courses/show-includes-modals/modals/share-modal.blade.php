<div class="modal fade modal-container" id="shareModal" tabindex="-1" role="dialog" aria-labelledby="shareModalTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-gray">
                <h5 class="modal-title fs-19 font-weight-semi-bold" id="shareModalTitle">Share this course</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="la la-times"></span>
                </button>
            </div><!-- end modal-header -->
            <div class="modal-body">
                <div class="copy-to-clipboard">
                    <span class="success-message">Copied!</span>
                    <div class="input-group">
                        <input type="text" class="form-control form--control copy-input pl-3"
                            value="http://127.0.0.1:8000/{{ Request::path() }}" readonly>
                        <div class="input-group-append">
                            <button class="btn theme-btn theme-btn-sm copy-btn shadow-none"><i
                                    class="la la-copy mr-1"></i> Copy</button>
                        </div>
                    </div>
                </div><!-- end copy-to-clipboard -->
            </div><!-- end modal-body -->
            <div class="modal-footer justify-content-center border-top-gray">
                <ul class="social-icons social-icons-styled">
                    <li><a href="#" class="facebook-bg" data-share="facebook"><i class="la la-facebook"></i></a>
                    </li>
                    <li><a href="#" class="twitter-bg" data-share="twitter"><i class="la la-twitter"></i></a></li>
                    <li><a href="#" class="whatsapp-bg" data-share="whatsapp"><i class="la la-whatsapp"></i></a>
                    </li>
                    {{-- <li><a href="#" class="instagram-bg" data-share="instagram"><i class="la la-instagram"></i></a></li> --}}
                </ul>
            </div><!-- end modal-footer -->
        </div><!-- end modal-content-->
    </div><!-- end modal-dialog -->
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            // Get the URL from the input field
            const pageUrl = encodeURIComponent($('.copy-input').val());

            // Function to open share link in a new window
            function openShareWindow(url) {
                window.open(url, '_blank', 'width=600,height=400');
            }

            // Social media share handlers
            $('.social-icons a').on('click', function(e) {
                e.preventDefault(); // Prevent default anchor behavior

                const platform = $(this).data('share'); // Get the platform from data-share attribute

                let shareUrl = '';
                switch (platform) {
                    case 'facebook':
                        shareUrl = `https://www.facebook.com/sharer/sharer.php?u=${pageUrl}`;
                        break;
                    case 'twitter':
                        shareUrl =
                            `https://twitter.com/intent/tweet?url=${pageUrl}&text=Check out this course!`;
                        break;
                    case 'whatsapp':
                        shareUrl = `https://api.whatsapp.com/send?text=Check out this course! ${pageUrl}`;
                        break;
                    default:
                        return;
                }

                if (shareUrl) {
                    openShareWindow(shareUrl);
                }
            });

            // Existing copy-to-clipboard functionality
            $('.copy-btn').on('click', function() {
                const $input = $('.copy-input');
                $input.select();
                document.execCommand('copy');
                $('.success-message').fadeIn().delay(2000).fadeOut();
            });
        });
    </script>
@endpush
