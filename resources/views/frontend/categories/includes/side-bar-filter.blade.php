<div class="col-lg-4">
    <div class="sidebar mb-5">

        {{-- Search Field --}}
        <div class="card card-item">
            <div class="card-body">
                <h3 class="card-title fs-18 pb-2">Search Field</h3>
                <div class="divider"><span></span></div>
                <form method="get"> <!-- Changed to GET for AJAX compatibility -->
                    <div class="form-group mb-0">
                        <input class="form-control form--control pl-3" type="text" name="search" id="searchInput"
                            placeholder="Search courses">
                        <span class="la la-search search-icon"></span>
                    </div>
                </form>
            </div>
        </div><!-- end card -->

        {{-- Ratings --}}
        @if ($ratings)
            <div class="card card-item">
                <div class="card-body">
                    <h3 class="card-title fs-18 pb-2">Ratings</h3>
                    <div class="divider"><span></span></div>
                    @foreach ($ratings as $avg_rating => $count)
                        <div class="custom-control custom-radio mb-1 fs-15">
                            <input type="radio" class="custom-control-input" id="rating{{ $avg_rating }}"
                                name="rating" value="{{ $avg_rating }}">
                            <label class="custom-control-label custom--control-label" for="rating{{ $avg_rating }}">
                                <span class="rating-wrap d-flex align-items-center">
                                    <span class="review-stars">
                                        @for ($i = 0; $i < floor($avg_rating); $i++)
                                            <span class="la la-star"></span>
                                        @endfor
                                        @if ($avg_rating - floor($avg_rating) >= 0.5 && $avg_rating < 5)
                                            <span class="la la-star-half-alt"></span>
                                        @endif
                                        @for ($i = ceil($avg_rating); $i < 5; $i++)
                                            <span class="la la-star-o"></span>
                                        @endfor
                                    </span>
                                    <span class="rating-total pl-1">
                                        <span class="mr-1 text-black">{{ $avg_rating }} & up</span>({{ $count }})
                                    </span>
                                </span>
                            </label>
                        </div>
                    @endforeach
                </div>
            </div><!-- end card -->
        @endif

        {{-- Language --}}
        @if ($languages->isNotEmpty())     
        <div class="card card-item">
            <div class="card-body">
                <h3 class="card-title fs-18 pb-2">Language</h3>
                <div class="divider"><span></span></div>
                
                @foreach ($languages->take(4) as $index => $language)
                    <div class="custom-control custom-checkbox mb-1 fs-15">
                        <input type="checkbox" class="custom-control-input" id="lang{{ $index }}"
                            name="language[]" value="{{ $language->language }}">
                        <label class="custom-control-label custom--control-label text-black" for="lang{{ $index }}">
                            {{ $language->language }}<span class="ml-1 text-gray">({{ $language->count }})</span>
                        </label>
                    </div>
                @endforeach
    
                <div class="collapse" id="collapseMore">
                    @foreach ($languages->skip(4) as $index => $language)
                        @php $collapseIndex = $index + 4; @endphp
                        <div class="custom-control custom-checkbox mb-1 fs-15">
                            <input type="checkbox" class="custom-control-input" id="lang{{ $collapseIndex }}"
                                name="language[]" value="{{ $language->language }}">
                            <label class="custom-control-label custom--control-label text-black" for="lang{{ $collapseIndex }}">
                                {{ $language->language }}<span class="ml-1 text-gray">({{ $language->count }})</span>
                            </label>
                        </div>
                    @endforeach
                </div>
    
                @if ($languages->count() > 4)
                    <a class="collapse-btn collapse--btn fs-15" data-toggle="collapse" href="#collapseMore"
                        role="button" aria-expanded="false" aria-controls="collapseMore">
                        <span class="collapse-btn-hide">Show more<i class="la la-angle-down ml-1 fs-14"></i></span>
                        <span class="collapse-btn-show">Show less<i class="la la-angle-up ml-1 fs-14"></i></span>
                    </a>
                @endif
            </div>
        </div>
    @endif
    
    {{-- Level --}}
    @if ($levels->isNotEmpty())
        <div class="card card-item">
            <div class="card-body">
                <h3 class="card-title fs-18 pb-2">Level</h3>
                    <div class="divider"><span></span></div>
                    <div class="custom-control custom-checkbox mb-1 fs-15">
                        <input type="checkbox" class="custom-control-input" id="levelAll" name="level[]"
                            value="all">
                        <label class="custom-control-label custom--control-label text-black" for="levelAll">
                            All Levels<span class="ml-1 text-gray"></span>
                        </label>
                    </div><!-- end custom-control -->
                    @foreach ($levels as $level)
                        <div class="custom-control custom-checkbox mb-1 fs-15">
                            <input type="checkbox" class="custom-control-input" id="level{{ $loop->index }}"
                                name="level[]" value="{{ $level->level }}">
                            <label class="custom-control-label custom--control-label text-black" for="level{{ $loop->index }}">
                                {{ $level->level }}<span class="ml-1 text-gray">({{ $level->count }})</span>
                            </label>
                        </div><!-- end custom-control -->
                    @endforeach
                </div>
            </div><!-- end card -->
        @endif

        {{-- Cost --}}
        @if ($cost->isNotEmpty())
            <div class="card card-item">
                <div class="card-body">
                    <h3 class="card-title fs-18 pb-2">By Cost</h3>
                    <div class="divider"><span></span></div>
                    @foreach ($cost as $c)
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" id="cost{{ $c->cost_type }}" name="cost"
                                value="{{ strtolower($c->cost_type) }}">
                            <label class="form-check-label" for="cost{{ $c->cost_type }}">
                                {{ $c->cost_type }} <span class="text-muted">({{ $c->count }})</span>
                            </label>
                        </div>
                    @endforeach
                </div>
            </div><!-- end card -->
        @endif

    </div><!-- end sidebar -->
</div><!-- end col-lg-4 -->