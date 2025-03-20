<!DOCTYPE html>
<html lang="en">

<head>
    @include('frontend.course-lectures.includes._head')
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
    @include('frontend.course-lectures.includes._header')
    <!--======================================
        END HEADER AREA
======================================-->

    <!--======================================
        START COURSE-DASHBOARD
======================================-->

   @include('frontend.course-lectures.includes._course-dashboard')

    <!--======================================
        END COURSE-DASHBOARD
======================================-->

    <!-- start scroll top -->
    <div id="scroll-top">
        <i class="la la-arrow-up" title="Go top"></i>
    </div>
    <!-- end scroll top -->

    <!-- Rate Modal -->
    @include('frontend.course-lectures.modals.rate-modal')
    <!-- end modal -->

    <!-- Share Modal -->
    @include('frontend.course-lectures.modals.share-modal')
    <!-- end modal -->

    <!-- Report Modal -->
   @include('frontend.course-lectures.modals.report-modal')
    <!-- end modal -->

    <!-- Insert Link Modal -->
    @include('frontend.course-lectures.modals.insert-link-modal')
    <!-- end modal -->

    <!-- Upload Photo Modal -->
    
    <!-- end modal -->

    @include('frontend.course-lectures.includes._scripts')

   
</body>

</html>
