<div class="filter-bar mb-4">
    <div class="filter-bar-inner d-flex flex-wrap align-items-center justify-content-between">
        <p class="fs-14">We found <span class="text-black">{{ count($courses) }}</span> courses
            available for you</p>
        <div class="d-flex flex-wrap align-items-center">
            {{-- <ul class="filter-nav mr-3">
                <li><a href="course-grid.html" data-toggle="tooltip" data-placement="top" title="Grid View"
                        class="active"><span class="la la-th-large"></span></a></li>
                <li><a href="course-list.html" data-toggle="tooltip" data-placement="top"
                        title="List View"><span class="la la-list"></span></a></li>
            </ul> --}}
            {{-- <div class="select-container select--container">
                <select class="select-container-select">
                    <option value="all-category">All Category</option>
                    <option value="newest">Newest courses</option>
                    <option value="oldest">Oldest courses</option>
                    <option value="high-rated">Highest rated</option>
                    <option value="popular-courses">Popular courses</option>
                    <option value="high-to-low">Price: high to low</option>
                    <option value="low-to-high">Price: low to high</option>
                </select>
            </div> --}}
        </div>
    </div><!-- end filter-bar-inner -->
</div><!-- end filter-bar -->