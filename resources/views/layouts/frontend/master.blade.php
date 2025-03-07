<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.frontend.includes._head')
</head>

<body>

    <!-- start cssload-loader -->
    <div class="preloader">
        <div class="loader">
            <svg class="spinner" viewBox="0 0 50 50">
                <circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="5"></circle>
            </svg>
        </div>
    </div>
    <!-- end cssload-loader -->

    <!--======================================
        START HEADER AREA
    ======================================-->

    @include('layouts.frontend.includes._header')
    <!--======================================
        END HEADER AREA
======================================-->


    @yield('content')




    <!-- ================================
                 END FOOTER AREA
            ================================= -->
    @include('frontend.home.includes.footer-area')
    <!-- end footer-area -->
    <!-- ================================
                  END FOOTER AREA
            ================================= -->

    @include('layouts.frontend.includes._scripts')

    @yield('scripts')
</body>

</html>
