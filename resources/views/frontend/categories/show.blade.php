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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            var categorySlug = '{{ $category->slug }}';
            var timer;

            // Function to fetch filtered courses
            function filterCourses() {
                var search = $('#searchInput').val();
                var rating = $('input[name="rating"]:checked').val();
                var languages = $('input[name="language[]"]:checked').map(function() { return this.value; }).get();
                var levels = $('input[name="level[]"]:checked').map(function() { return this.value; }).get();
                var cost = $('input[name="cost"]:checked').val();

                $.ajax({
                    url: '/categories/' + categorySlug,
                    method: 'GET',
                    data: {
                        search: search,
                        rating: rating,
                        language: languages,
                        level: levels,
                        cost: cost
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
            $('input[name="rating"], input[name="language[]"], input[name="level[]"], input[name="cost"]').on('change', filterCourses);

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