<div class="my-course-filter-wrap d-flex align-items-center pt-2">
    <div class="my-course-filter-item my-course-sort-by-content">
        <span class="fs-14 font-weight-semi-bold">Sort by</span>
        <div class="select-container w-100 pt-2">
            <select class="select-container-select">
                <option value="0" selected="">Recently Accessed</option>
                <option value="1">Recently Enrolled</option>
                <option value="2">Title: A-to-Z</option>
                <option value="3">Title: Z-to-A</option>
                <option value="4">Completion: 0% to 100%</option>
                <option value="5">Completion: 100% to 0%</option>
            </select>
        </div>
    </div><!-- end my-course-filter-item -->

    <div class="my-course-filter-item my-course-filter-by-content">
        <span class="fs-14 font-weight-semi-bold">Filter by</span>
        <div class="my-course-filter-by-content-inner d-flex align-items-center pt-2">
            <div class="select-container">
                <select class="select-container-select">
                    <option value="0" selected="">Categories</option>
                    <option value="1">Favorites</option>
                    <option value="2">Archived</option>
                    @foreach($enrolledCategories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="select-container">
                <select class="select-container-select">
                    <option value="0" selected>All Instructors</option>
                    @foreach($enrolledInstructors as $instructor)
                        <option value="{{ $instructor->id }}">{{ $instructor->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="reset-btn-box">
                <button class="btn text-gray" type="button">Reset</button>
            </div>
        </div>
    </div><!-- end my-course-filter-item -->

    <div class="my-course-filter-item my-course-search-content">
        <span class="fs-14 font-weight-semi-bold">Search</span>
        <form method="post" class="pt-2">
            <div class="input-group mb-0">
                <input class="form-control form--control form--control-gray pl-3"
                    type="text" name="search" placeholder="Search courses">
                <div class="input-group-append">
                    <button class="btn theme-btn shadow-none"><i
                            class="la la-search"></i></button>
                </div>
            </div>
        </form>
    </div><!-- end my-course-filter-item -->
</div>