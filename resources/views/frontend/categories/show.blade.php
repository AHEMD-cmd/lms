@extends('layouts.frontend.master')

@section('title', $category->name)

@section('content')


    <!-- ================================
                        START BREADCRUMB AREA
                    ================================= -->

    @include('frontend.categories.includes.breadcrumb')

    <!-- ================================
                        END BREADCRUMB AREA
                    ================================= -->

    <!--======================================
                            START COURSE AREA
                    ======================================-->
    <section class="course-area section--padding">
        <div class="container">

            @include('frontend.categories.includes.filter-bar')

            <div class="row">

                @include('frontend.categories.includes.side-bar-filter')

               @include('frontend.categories.includes.courses')

            </div><!-- end row -->
        </div><!-- end container -->
    </section><!-- end courses-area -->
    <!--======================================
                            END COURSE AREA
                    ======================================-->




@endsection


@push('scripts')
    <script>
        $(document).ready(function() {
            $('.wishlist').on('click', function() {
                var courseId = $(this).data('id'); // Get course ID from data-id
                var $icon = $(this).find('i'); // Target the icon inside

                $.ajax({
                    url: '/wish-list/' + courseId, // Route URL
                    method: 'POST',
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
        });
    </script>
@endpush
