@extends('layouts.frontend.master')

@section('title', 'Courses')

@section('content')


    <!-- ================================
                        START BREADCRUMB AREA
                    ================================= -->

    @include('frontend.courses.index-includes.breadcrumb')

    <!-- ================================
                        END BREADCRUMB AREA
                    ================================= -->

    <!--======================================
                            START COURSE AREA
                    ======================================-->
    <section class="course-area section--padding">
        <div class="container">

            @include('frontend.courses.index-includes.filter-bar')

            <div class="row">

                @include('frontend.courses.index-includes.side-bar-filter')

                @include('frontend.courses.index-includes.courses')
            </div><!-- end row -->
        </div><!-- end container -->
    </section><!-- end courses-area -->
    <!--======================================
                            END COURSE AREA
                    ======================================-->

@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            var timer;
            
            // Function to fetch filtered courses
            function filterCourses() {
                var search = $('#searchInput').val();
                var rating = $('input[name="rating"]:checked').val();
                var languages = $('input[name="language[]"]:checked').map(function() { return this.value; }).get();
                var levels = $('input[name="level[]"]:checked').map(function() { return this.value; }).get();
                var cost = $('input[name="cost"]:checked').val();
                var durations = $('input[name="duration[]"]:checked').map(function() { return this.value; }).get();
                
                $.ajax({
                    url: '/courses',
                    method: 'GET',
                    data: {
                        search: search,
                        rating: rating,
                        language: languages,
                        level: levels,
                        cost: cost,
                        duration: durations
                    },
                    success: function(data) {
                        $('#courses-container').replaceWith(data);
                    },
                    error: function(xhr) {
                        console.log('Error:', xhr);
                    }
                });
            }
            
            // Search input keyup with debounce
            $('#searchInput').on('keyup', function() {
                clearTimeout(timer);
                timer = setTimeout(filterCourses, 500);
            });
            
            // Filter changes (click events)
            $('input[name="rating"], input[name="language[]"], input[name="level[]"], input[name="cost"], input[name="duration[]"]').on('change', filterCourses);
            
            // Pagination clicks
            $(document).on('click', '#courses-container .pagination a', function(e) {
                e.preventDefault();
                var url = $(this).attr('href');
                $.get(url, function(data) {
                    $('#courses-container').replaceWith(data);
                });
            });
        });
    </script>
@endpush