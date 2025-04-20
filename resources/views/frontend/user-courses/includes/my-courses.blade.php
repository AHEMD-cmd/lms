<section class="my-courses-area pt-30px pb-90px">
    <div class="container">
        <div class="my-course-content-wrap">
            <div class="tab-content" id="myTabContent">

                <div class="tab-pane fade show active" id="all-course" role="tabpanel" aria-labelledby="all-course-tab">
                    <div class="my-course-body">

                        <!-- My Courses Filter -->
                        @include('frontend.user-courses.includes.filters')
                        <!-- end My Courses Filter -->
                        
                        @include('frontend.user-courses.includes.all-courses')
                    </div><!-- end my-course-body -->
                </div><!-- end tab-pane -->

                <div class="tab-pane fade" id="collections" role="tabpanel" aria-labelledby="collections-tab">
                    @include('frontend.user-courses.includes.collections')
                </div><!-- end tab-pane -->

                @include('frontend.user-courses.includes.wishlist')

                @include('frontend.user-courses.includes.archived')

            </div><!-- end tab-content -->
        </div>
    </div><!-- end container -->
</section><!-- end my-courses-area -->
