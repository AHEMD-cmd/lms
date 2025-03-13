<div class="col-lg-4">
    <div class="sidebar mb-5">
        <div class="card card-item">
            <div class="card-body">
                <h3 class="card-title fs-18 pb-2">Search Field</h3>
                <div class="divider"><span></span></div>
                <form method="post">
                    <div class="form-group mb-0">
                        <input class="form-control form--control pl-3" type="text" name="search"
                            placeholder="Search courses">
                        <span class="la la-search search-icon"></span>
                    </div>
                </form>
            </div>
        </div><!-- end card -->

        <div class="card card-item">
            <div class="card-body">
                <h3 class="card-title fs-18 pb-2">Course Categories</h3>
                <div class="divider"><span></span></div>
                <ul class="generic-list-item">
                    @foreach ($categories as $cat)
                        <li><a href="{{ route('categories.show', $cat->id) }}">{{ $cat->name }}</a>
                        </li>
                    @endforeach

                </ul>
            </div>
        </div><!-- end card -->

        <div class="card card-item">
            <div class="card-body">
                <h3 class="card-title fs-18 pb-2">Ratings</h3>
                <div class="divider"><span></span></div>
                <div class="custom-control custom-radio mb-1 fs-15">
                    <input type="radio" class="custom-control-input" id="fiveStarRating"
                        name="radio-stacked" required>
                    <label class="custom-control-label custom--control-label" for="fiveStarRating">
                        <span class="rating-wrap d-flex align-items-center">
                            <span class="review-stars">
                                <span class="la la-star"></span>
                                <span class="la la-star"></span>
                                <span class="la la-star"></span>
                                <span class="la la-star"></span>
                                <span class="la la-star"></span>
                            </span>
                            <span class="rating-total pl-1"><span
                                    class="mr-1 text-black">5.0</span>(20,230)</span>
                        </span>
                    </label>
                </div>
                <div class="custom-control custom-radio mb-1 fs-15">
                    <input type="radio" class="custom-control-input" id="fourStarRating"
                        name="radio-stacked" required>
                    <label class="custom-control-label custom--control-label" for="fourStarRating">
                        <span class="rating-wrap d-flex align-items-center">
                            <span class="review-stars">
                                <span class="la la-star"></span>
                                <span class="la la-star"></span>
                                <span class="la la-star"></span>
                                <span class="la la-star"></span>
                                <span class="la la-star"></span>
                            </span>
                            <span class="rating-total pl-1"><span class="mr-1 text-black">4.5 &
                                    up</span>(10,230)</span>
                        </span>
                    </label>
                </div>
                <div class="custom-control custom-radio mb-1 fs-15">
                    <input type="radio" class="custom-control-input" id="threeStarRating"
                        name="radio-stacked" required>
                    <label class="custom-control-label custom--control-label" for="threeStarRating">
                        <span class="rating-wrap d-flex align-items-center">
                            <span class="review-stars">
                                <span class="la la-star"></span>
                                <span class="la la-star"></span>
                                <span class="la la-star"></span>
                                <span class="la la-star"></span>
                                <span class="la la-star"></span>
                            </span>
                            <span class="rating-total pl-1"><span class="mr-1 text-black">3.0 &
                                    up</span>(7,230)</span>
                        </span>
                    </label>
                </div>
                <div class="custom-control custom-radio mb-1 fs-15">
                    <input type="radio" class="custom-control-input" id="twoStarRating"
                        name="radio-stacked" required>
                    <label class="custom-control-label custom--control-label" for="twoStarRating">
                        <span class="rating-wrap d-flex align-items-center">
                            <span class="review-stars">
                                <span class="la la-star"></span>
                                <span class="la la-star"></span>
                                <span class="la la-star"></span>
                                <span class="la la-star"></span>
                                <span class="la la-star"></span>
                            </span>
                            <span class="rating-total pl-1"><span class="mr-1 text-black">2.0 &
                                    up</span>(5,230)</span>
                        </span>
                    </label>
                </div>
                <div class="custom-control custom-radio mb-1 fs-15">
                    <input type="radio" class="custom-control-input" id="oneStarRating"
                        name="radio-stacked" required>
                    <label class="custom-control-label custom--control-label" for="oneStarRating">
                        <span class="rating-wrap d-flex align-items-center">
                            <span class="review-stars">
                                <span class="la la-star"></span>
                                <span class="la la-star"></span>
                                <span class="la la-star"></span>
                                <span class="la la-star"></span>
                                <span class="la la-star"></span>
                            </span>
                            <span class="rating-total pl-1"><span class="mr-1 text-black">1.0 &
                                    up</span>(3,230)</span>
                        </span>
                    </label>
                </div>
            </div>
        </div><!-- end card -->
        <div class="card card-item">
            <div class="card-body">
                <h3 class="card-title fs-18 pb-2">Categories</h3>
                <div class="divider"><span></span></div>
                <div class="custom-control custom-checkbox mb-1 fs-15">
                    <input type="checkbox" class="custom-control-input" id="catCheckbox" required>
                    <label class="custom-control-label custom--control-label text-black"
                        for="catCheckbox">
                        Business<span class="ml-1 text-gray">(12,300)</span>
                    </label>
                </div><!-- end custom-control -->
                <div class="custom-control custom-checkbox mb-1 fs-15">
                    <input type="checkbox" class="custom-control-input" id="catCheckbox2" required>
                    <label class="custom-control-label custom--control-label text-black"
                        for="catCheckbox2">
                        UI & UX<span class="ml-1 text-gray">(12,300)</span>
                    </label>
                </div><!-- end custom-control -->
                <div class="custom-control custom-checkbox mb-1 fs-15">
                    <input type="checkbox" class="custom-control-input" id="catCheckbox3" required>
                    <label class="custom-control-label custom--control-label text-black"
                        for="catCheckbox3">
                        Animation<span class="ml-1 text-gray">(12,300)</span>
                    </label>
                </div><!-- end custom-control -->
                <div class="custom-control custom-checkbox mb-1 fs-15">
                    <input type="checkbox" class="custom-control-input" id="catCheckbox4" required>
                    <label class="custom-control-label custom--control-label text-black"
                        for="catCheckbox4">
                        Game Design<span class="ml-1 text-gray">(12,300)</span>
                    </label>
                </div><!-- end custom-control -->
                <div class="collapse" id="collapseMore">
                    <div class="custom-control custom-checkbox mb-1 fs-15">
                        <input type="checkbox" class="custom-control-input" id="catCheckbox5" required>
                        <label class="custom-control-label custom--control-label text-black"
                            for="catCheckbox5">
                            Graphic Design<span class="ml-1 text-gray">(12,300)</span>
                        </label>
                    </div><!-- end custom-control -->
                    <div class="custom-control custom-checkbox mb-1 fs-15">
                        <input type="checkbox" class="custom-control-input" id="catCheckbox6" required>
                        <label class="custom-control-label custom--control-label text-black"
                            for="catCheckbox6">
                            Typography<span class="ml-1 text-gray">(12,300)</span>
                        </label>
                    </div><!-- end custom-control -->
                    <div class="custom-control custom-checkbox mb-1 fs-15">
                        <input type="checkbox" class="custom-control-input" id="catCheckbox7" required>
                        <label class="custom-control-label custom--control-label text-black"
                            for="catCheckbox7">
                            Web Development<span class="ml-1 text-gray">(12,300)</span>
                        </label>
                    </div><!-- end custom-control -->
                    <div class="custom-control custom-checkbox mb-1 fs-15">
                        <input type="checkbox" class="custom-control-input" id="catCheckbox8" required>
                        <label class="custom-control-label custom--control-label text-black"
                            for="catCheckbox8">
                            Photography<span class="ml-1 text-gray">(12,300)</span>
                        </label>
                    </div><!-- end custom-control -->
                    <div class="custom-control custom-checkbox mb-1 fs-15">
                        <input type="checkbox" class="custom-control-input" id="catCheckbox9" required>
                        <label class="custom-control-label custom--control-label text-black"
                            for="catCheckbox9">
                            Finance<span class="ml-1 text-gray">(12,300)</span>
                        </label>
                    </div><!-- end custom-control -->
                </div><!-- end collapse -->
                <a class="collapse-btn collapse--btn fs-15" data-toggle="collapse" href="#collapseMore"
                    role="button" aria-expanded="false" aria-controls="collapseMore">
                    <span class="collapse-btn-hide">Show more<i
                            class="la la-angle-down ml-1 fs-14"></i></span>
                    <span class="collapse-btn-show">Show less<i
                            class="la la-angle-up ml-1 fs-14"></i></span>
                </a>
            </div>
        </div><!-- end card -->

        <div class="card card-item">
            <div class="card-body">
                <h3 class="card-title fs-18 pb-2">Level</h3>
                <div class="divider"><span></span></div>
                <div class="custom-control custom-checkbox mb-1 fs-15">
                    <input type="checkbox" class="custom-control-input" id="levelCheckbox" required>
                    <label class="custom-control-label custom--control-label text-black"
                        for="levelCheckbox">
                        All Levels<span class="ml-1 text-gray">(20,300)</span>
                    </label>
                </div><!-- end custom-control -->
                <div class="custom-control custom-checkbox mb-1 fs-15">
                    <input type="checkbox" class="custom-control-input" id="levelCheckbox2" required>
                    <label class="custom-control-label custom--control-label text-black"
                        for="levelCheckbox2">
                        Beginner<span class="ml-1 text-gray">(5,300)</span>
                    </label>
                </div><!-- end custom-control -->
                <div class="custom-control custom-checkbox mb-1 fs-15">
                    <input type="checkbox" class="custom-control-input" id="levelCheckbox3" required>
                    <label class="custom-control-label custom--control-label text-black"
                        for="levelCheckbox3">
                        Intermediate<span class="ml-1 text-gray">(3,300)</span>
                    </label>
                </div><!-- end custom-control -->
                <div class="custom-control custom-checkbox mb-1 fs-15">
                    <input type="checkbox" class="custom-control-input" id="levelCheckbox4" required>
                    <label class="custom-control-label custom--control-label text-black"
                        for="levelCheckbox4">
                        Expert<span class="ml-1 text-gray">(1,300)</span>
                    </label>
                </div><!-- end custom-control -->
            </div>
        </div><!-- end card -->

        <div class="card card-item">
            <div class="card-body">
                <h3 class="card-title fs-18 pb-2">By Cost</h3>
                <div class="divider"><span></span></div>
                <div class="custom-control custom-checkbox mb-1 fs-15">
                    <input type="checkbox" class="custom-control-input" id="priceCheckbox" required>
                    <label class="custom-control-label custom--control-label text-black"
                        for="priceCheckbox">
                        Paid<span class="ml-1 text-gray">(19,300)</span>
                    </label>
                </div><!-- end custom-control -->
                <div class="custom-control custom-checkbox mb-1 fs-15">
                    <input type="checkbox" class="custom-control-input" id="priceCheckbox2" required>
                    <label class="custom-control-label custom--control-label text-black"
                        for="priceCheckbox2">
                        Free<span class="ml-1 text-gray">(1,300)</span>
                    </label>
                </div><!-- end custom-control -->
                <div class="custom-control custom-checkbox mb-1 fs-15">
                    <input type="checkbox" class="custom-control-input" id="priceCheckbox3" required>
                    <label class="custom-control-label custom--control-label text-black"
                        for="priceCheckbox3">
                        All<span class="ml-1 text-gray">(20,300)</span>
                    </label>
                </div><!-- end custom-control -->
            </div>
        </div><!-- end card -->


    </div><!-- end sidebar -->
</div><!-- end col-lg-4 -->