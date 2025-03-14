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