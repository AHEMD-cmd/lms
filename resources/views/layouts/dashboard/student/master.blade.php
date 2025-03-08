<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.dashboard.student.includes._head')
    <!-- end inject -->
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
@include('layouts.dashboard.student.includes._header')
<!-- end header-menu-area -->

<!--======================================
        END HEADER AREA
======================================-->

<!-- ================================
    START DASHBOARD AREA
================================= -->
<section class="dashboard-area">

    @include('layouts.dashboard.student.includes._sidebar')
    
    <div class="dashboard-content-wrap">
        @yield('content')
    </div>

</section>
<!-- end dashboard-area -->
<!-- ================================
    END DASHBOARD AREA
================================= -->

<!-- start scroll top -->
<div id="scroll-top">
    <i class="la la-arrow-up" title="Go top"></i>
</div>
<!-- end scroll top -->

@include('layouts.dashboard.student.includes._scripts')

</body>
</html>