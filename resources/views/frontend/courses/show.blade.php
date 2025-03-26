@extends('layouts.frontend.master')

@section('title', $course->title)

@section('content')

    <!-- ================================
                                    START BREADCRUMB AREA
                            ================================= -->
    @include('frontend.courses.includes._breadcrumb')
    <!-- end breadcrumb-area -->
    <!-- ================================
                    END BREADCRUMB AREA
                    ================================= -->

    <!--======================================
                         START COURSE DETAILS AREA
                        ======================================-->
    @include('frontend.courses.includes._course-details')
    <!-- end course-details-area -->
    <!--======================================
                                                                                                                                                    END COURSE DETAILS AREA
                                                                                                                                            ======================================-->

    <!--======================================
                START RELATED COURSE AREA
                ======================================-->
    @include('frontend.courses.includes._related-courses')
    <!-- end related-course-area -->
    <!--======================================
                                                                                                                                                    END RELATED COURSE AREA
                                                                                                                                            ======================================-->

    <!--======================================
            START CTA AREA
            ======================================-->
    @include('frontend.courses.includes._cta')
    <!-- end cta-area -->
    <!--======================================
                                                                                                                                                    END CTA AREA
                                                                                                                                            ======================================-->


    <!-- Share Modal -->
    @include('frontend.courses.modals.share-modal')
    <!-- end modal -->

    <!-- Course Preview Modal -->
    @include('frontend.courses.modals.course-preview-modal')
    <!-- end modal -->

    <!-- Report Modal -->
    @include('frontend.courses.modals.report-modal')
    <!-- end modal -->

@endsection



@push('scripts')
    <script>
        // Initialize Plyr video player with quality options
        var player = new Plyr('#player', {
            quality: {
                default: 360,
                options: [360, 480, 720],
                forced: true,
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            // ################## add course to wishlist ###################
            $('.wishlist').on('click', function() {
                var courseId = $(this).data('id'); // Get course ID from data-id
                var icon = $(this).find('i'); // Target the icon inside

                $.ajax({
                    url: '/wish-list/' + courseId, // Route URL
                    method: $icon.hasClass('la-heart-o') ? 'POST' : 'DELETE',
                    data: {
                        course_id: courseId, // Send course_id in request body
                        _token: '{{ csrf_token() }}' // CSRF token for Laravel
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            // Toggle icon class based on current state
                            if ($icon.hasClass('la-heart-o')) {
                                $icon.removeClass('la-heart-o').addClass('la-heart');
                            } else {
                                $icon.removeClass('la-heart').addClass('la-heart-o');
                            }
                            $('.header-wishlist').html(response.wishlistedCourses);

                            if (response.wishlistedCoursesNumber === 0) {
                                $('.header-go-to-wishlist').hide();
                                $('.explore-courses').show();
                            } else {
                                $('.explore-courses').hide();
                                $('.header-go-to-wishlist').show();
                            }

                        }
                    },
                    error: function(xhr) {
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'error',
                            title: xhr.responseJSON.message,
                            showConfirmButton: false,
                            timer: 3000
                        });
                    }
                });
            });

            // ###################### seach or load more reviews #######################
            function fetchReviews(search = '', rating = '', loadMore = false) {

                $.ajax({
                    url: '{{ route('courses.reviews.index', $course->slug) }}',
                    method: 'GET',
                    data: {
                        search: search,
                        rating: rating,
                        loadMore: loadMore == true ? 1 : 0
                    },
                    success: function(response) {
                        if (response.allReviewsCount == response.reviewsCount) {
                            $('#load-more-reviews').hide();
                        }
                        $('#course-reviews-container').html(response.reviews);

                    },
                    error: function(xhr) {
                        console.log('Error:', xhr);
                    }
                });
            }

            // Search input event (trigger on keyup)
            $('#review-search').on('keyup', function() {
                let search = $(this).val();
                let rating = $('#rating-filter').val();
                fetchReviews(search, rating, false);
            });

            // Rating filter event (trigger on change)
            $('#rating-filter').on('change', function() {
                let search = $('#review-search').val();
                let rating = $(this).val();
                fetchReviews(search, rating, false);

            });

            // Load more button event (trigger on click)
            $('#load-more-reviews').on('click', function() {
                let search = $('#review-search').val();
                let rating = $(this).val();
                fetchReviews(search, rating, true);
            });

            // ###################### Report course or review ######################
            $(document).on('submit', '#reportForm', function(e) {
                e.preventDefault(); // Prevent default form submission

                $.ajax({
                    url: '{{ route('courses.reports.store', $course->slug) }}',
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            title: response.message,
                            showConfirmButton: false,
                            timer: 3000,
                            customClass: {
                                popup: 'black-toast'
                            }
                        });
                        $('#reportModal').modal('hide'); // Close the modal
                        $('#reportForm')[0].reset(); // Reset the form
                    },
                    error: function(xhr) {
                        $('.error-message').text(''); // Reset all error spans to empty

                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            let errors = xhr.responseJSON.errors;
                            // Loop through errors and display them under respective inputs
                            $.each(errors, function(field, messages) {
                                let $errorSpan = $('#' + field).closest('.form-group')
                                    .find('.error-message');
                                if ($errorSpan.length) {
                                    $errorSpan.text(messages[0]);
                                }
                            });
                        } else {
                            Swal.fire({
                                toast: true,
                                position: 'top-end',
                                icon: 'error',
                                title: 'Failed to submit report',
                                showConfirmButton: false,
                                timer: 3000,
                                customClass: {
                                    popup: 'black-toast'
                                }
                            });
                        }
                    }
                });
            });

            // When the "Report" span is clicked
            $('.report-review').on('click', function() {
                let reviewId = $(this).data('id');
                $('#review_id').val(reviewId);
            });

        });
    </script>
@endpush
