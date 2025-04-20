<header class="header-menu-area bg-white">
    <div class="header-top pr-150px pl-150px border-bottom border-bottom-gray py-1">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="header-widget">
                        <ul class="generic-list-item d-flex flex-wrap align-items-center fs-14">
                            <li class="d-flex align-items-center pr-3 mr-3 border-right border-right-gray"><i
                                    class="la la-phone mr-1"></i><a href="tel:{{ $settings->phone }}"> {{ $settings->phone }}</a>
                            </li>
                            <li class="d-flex align-items-center"><i class="la la-envelope-o mr-1"></i><a
                                    href="mailto:{{ $settings->email }}"> {{ $settings->email }}</a></li>
                        </ul>
                    </div><!-- end header-widget -->
                </div><!-- end col-lg-6 -->
                <div class="col-lg-6">
                    <div class="header-widget d-flex flex-wrap align-items-center justify-content-end">
                        <div class="theme-picker d-flex align-items-center">
                            <button class="theme-picker-btn dark-mode-btn" title="Dark mode">
                                <svg id="moon" viewBox="0 0 24 24" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
                                </svg>
                            </button>
                            <button class="theme-picker-btn light-mode-btn" title="Light mode">
                                <svg id="sun" viewBox="0 0 24 24" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="5"></circle>
                                    <line x1="12" y1="1" x2="12" y2="3"></line>
                                    <line x1="12" y1="21" x2="12" y2="23"></line>
                                    <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
                                    <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
                                    <line x1="1" y1="12" x2="3" y2="12"></line>
                                    <line x1="21" y1="12" x2="23" y2="12"></line>
                                    <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
                                    <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
                                </svg>
                            </button>
                        </div>
                        <ul
                            class="generic-list-item d-flex flex-wrap align-items-center fs-14 border-left border-left-gray pl-3 ml-3">
                            @auth
                                <li class="d-flex align-items-center pr-3 mr-3 border-right border-right-gray"><i
                                        class="la la-dashboard mr-1"></i><a href="{{ route('dashboard') }}"> dashboard</a>
                                </li>
                                <li class="d-flex align-items-center">
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-link p-0">
                                            <i class="la la-sign-out mr-1"></i> Logout
                                        </button>
                                    </form>
                                </li>
                            @endauth
                            @guest
                                <li class="d-flex align-items-center pr-3 mr-3 border-right border-right-gray"><i
                                        class="la la-sign-in mr-1"></i><a href="{{ route('login') }}"> Login</a></li>
                                <li class="d-flex align-items-center"><i class="la la-user mr-1"></i><a
                                        href="{{ route('register') }}"> Register</a></li>
                            @endguest
                        </ul>
                    </div><!-- end header-widget -->
                </div><!-- end col-lg-6 -->
            </div><!-- end row -->
        </div><!-- end container-fluid -->
    </div><!-- end header-top -->
    <div class="header-menu-content pr-150px pl-150px bg-white">
        <div class="container-fluid">
            <div class="main-menu-content">
                <a href="#" class="down-button"><i class="la la-angle-down"></i></a>
                <div class="row align-items-center">
                    <div class="col-lg-2">
                        <div class="logo-box">
                            <a href="{{ route('home') }}" class="logo"><img
                                    src="{{ asset($settings->logo) }}" alt="logo"></a>
                            <div class="user-btn-action">
                                <div class="search-menu-toggle icon-element icon-element-sm shadow-sm mr-2"
                                    data-toggle="tooltip" data-placement="top" title="Search">
                                    <i class="la la-search"></i>
                                </div>
                                <div class="off-canvas-menu-toggle cat-menu-toggle icon-element icon-element-sm shadow-sm mr-2"
                                    data-toggle="tooltip" data-placement="top" title="Category menu">
                                    <i class="la la-th-large"></i>
                                </div>
                                <div class="off-canvas-menu-toggle main-menu-toggle icon-element icon-element-sm shadow-sm"
                                    data-toggle="tooltip" data-placement="top" title="Main menu">
                                    <i class="la la-bars"></i>
                                </div>
                            </div>
                        </div>
                    </div><!-- end col-lg-2 -->
                    <div class="col-lg-10">
                        <div class="menu-wrapper">
                            <div class="menu-category">
                                <ul>
                                    <li>
                                        <a href="#">Categories <i class="la la-angle-down fs-12"></i></a>
                                        <ul class="cat-dropdown-menu">
                                            @foreach ($categoriesTree as $category)
                                                <li>
                                                    <a href="{{ route('categories.show', $category->slug) }}">{{ $category->name }}
                                                        <i class="la la-angle-right"></i></a>
                                                    <ul class="sub-menu">
                                                        @foreach ($category->children as $child)
                                                            <li><a
                                                                    href="{{ route('categories.show', $child->slug) }}">{{ $child->name }}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            @endforeach

                                        </ul>
                                    </li>
                                </ul>
                            </div><!-- end menu-category -->
                            <form method="get" action="{{ route('courses.index') }}">
                                <div class="form-group mb-0">
                                    <input class="form-control form--control pl-3" type="text" name="search"
                                        placeholder="Search for anything">
                                    <span class="la la-search search-icon"></span>
                                </div>
                            </form>
                            
                            <nav class="main-menu" style="visibility: hidden">
                            </nav><!-- end main-menu -->

                            @auth    
                                <div class="shop-cart course-cart pr-3 mr-3 border-right border-right-gray">
                                    <ul>
                                        <li>
                                            <p class="shop-cart-btn d-flex align-items-center fs-16">
                                                My Courses
                                                <span class="la la-angle-down fs-13 ml-1"></span>
                                            </p>
                                            <ul class="cart-dropdown-menu after-none">
                                                @foreach (auth()->user()->studentCourses as $course) 
                                                    <li class="media media-card">
                                                        <a href="lesson-details.html" class="media-img">
                                                            <img class="mr-3" src="{{ asset($course->image) }}" alt="{{ $course->title }}">
                                                        </a>
                                                        <div class="media-body">
                                                            <h5><a href="lesson-details.html">{{ $course->title }}</a></h5>
                                                            <div class="skillbar-box pt-3">
                                                                <div class="skillbar skillbar-skillbar" data-percent="{{ $course->completionPercentage }}%">
                                                                    <div class="skillbar-bar skillbar--bar bg-1"></div>
                                                                </div><!-- End Skill Bar -->
                                                            </div><!-- End skillbar-box -->
                                                        </div>
                                                    </li>
                                                @endforeach
                                            
                                                <li>
                                                    <a href="{{ route('users.courses.index', auth()->user()->id) }}" class="btn theme-btn w-100">Got to my course <i class="la la-arrow-right icon ml-1"></i></a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div><!-- end course-cart -->
                            @endauth

                            <div class="shop-cart pr-3 mr-3 ">
                                <ul class="header-cart">
                                    @include('frontend.partials.header-cart')
                                </ul>
                            </div><!-- end shop-cart -->

                            @auth
                                <a href="{{ route('users.courses.index', auth()->user()->id) }}#wishlist">
                                    <div class="shop-cart wishlist-cart pr-3 mr-3 ">
                                        <ul>
                                            <li>
                                                <p class="shop-cart-btn">
                                                    <i class="la la-heart-o"></i>
                                                    @if ($wishlistedCourses->count() > 0)
                                                        <span class="dot-status bg-1"></span>
                                                    @endif
                                                </p>
                                                <ul class="cart-dropdown-menu after-none header-wishlist">
                                                    @include('frontend.partials.header-wishlist')
                                                </ul>
                                            </li>
                                        </ul>
                                    </div><!-- end shop-cart -->
                                </a>
                            @endauth

                            @auth      
                                {{-- user info --}}
                                <div class="shop-cart user-profile-cart">
                                    <ul>
                                        <li>
                                            <div class="shop-cart-btn">
                                                <div class="avatar-xs">
                                                    <img class="rounded-full img-fluid" src="{{ auth()->user()->photo }}"
                                                        alt="Avatar image">
                                                </div>
                                                <span class="dot-status bg-1"></span>
                                            </div>
                                            <ul class="cart-dropdown-menu after-none p-0 notification-dropdown-menu">
                                                <li class="menu-heading-block d-flex align-items-center">
                                                    <a href="teacher-detail.html" class="avatar-sm flex-shrink-0 d-block">
                                                        <img class="rounded-full img-fluid"
                                                            src="{{auth()->user()->photo}}" alt="{{auth()->user()->name}}">
                                                    </a>
                                                    <div class="ml-2">
                                                        <h4><a href="teacher-detail.html" class="text-black">{{
                                                                auth()->user()->name }}</a></h4>
                                                        <span class="d-block fs-14 lh-20">{{
                                                                auth()->user()->email }}</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div
                                                        class="theme-picker d-flex align-items-center justify-content-center lh-40">
                                                        <button
                                                            class="theme-picker-btn dark-mode-btn w-100 font-weight-semi-bold justify-content-center"
                                                            title="Dark mode">
                                                            <svg class="mr-1" viewBox="0 0 24 24" stroke-width="1.5"
                                                                stroke-linecap="round" stroke-linejoin="round">
                                                                <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z">
                                                                </path>
                                                            </svg>
                                                            Dark Mode
                                                        </button>
                                                        <button
                                                            class="theme-picker-btn light-mode-btn w-100 font-weight-semi-bold justify-content-center"
                                                            title="Light mode">
                                                            <svg class="mr-1" viewBox="0 0 24 24" stroke-width="1.5"
                                                                stroke-linecap="round" stroke-linejoin="round">
                                                                <circle cx="12" cy="12" r="5"></circle>
                                                                <line x1="12" y1="1" x2="12"
                                                                    y2="3"></line>
                                                                <line x1="12" y1="21" x2="12"
                                                                    y2="23"></line>
                                                                <line x1="4.22" y1="4.22" x2="5.64"
                                                                    y2="5.64"></line>
                                                                <line x1="18.36" y1="18.36" x2="19.78"
                                                                    y2="19.78"></line>
                                                                <line x1="1" y1="12" x2="3"
                                                                    y2="12"></line>
                                                                <line x1="21" y1="12" x2="23"
                                                                    y2="12"></line>
                                                                <line x1="4.22" y1="19.78" x2="5.64"
                                                                    y2="18.36"></line>
                                                                <line x1="18.36" y1="5.64" x2="19.78"
                                                                    y2="4.22"></line>
                                                            </svg>
                                                            Light Mode
                                                        </button>
                                                    </div>
                                                </li>
                                                <li>
                                                    <ul class="generic-list-item">
                                                        <li>
                                                            @auth
                                                                <a href="{{ route('users.courses.index', auth()->user()->id) }}">
                                                                    <i class="la la-file-video-o mr-1"></i> My courses
                                                                </a>
                                                            @endauth
                                                        </li>
                                                        <li>
                                                            <a href="{{ route('carts.index') }}">
                                                                <i class="la la-shopping-basket mr-1"></i> My cart
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="{{ route('users.courses.index', auth()->user()->id) }}#wishlist">
                                                                <i class="la la-heart-o mr-1"></i> My wishlist
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <div class="section-block"></div>
                                                        </li>
                                                        <li>
                                                            <a href="{{ route('profile.edit')}}">
                                                                <i class="la la-user mr-1"></i> Public profile
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="{{ route('profile.change-password')}}">
                                                                <i class="la la-edit mr-1"></i> Edit profile
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div><!-- user info -->
                            @endauth
                            
                        </div><!-- end menu-wrapper -->
                    </div><!-- end col-lg-10 -->
                </div><!-- end row -->
            </div>
        </div><!-- end container-fluid -->
    </div><!-- end header-menu-content -->
    <div class="off-canvas-menu custom-scrollbar-styled main-off-canvas-menu">
        <div class="off-canvas-menu-close main-menu-close icon-element icon-element-sm shadow-sm"
            data-toggle="tooltip" data-placement="left" title="Close menu">
            <i class="la la-times"></i>
        </div><!-- end off-canvas-menu-close -->
        <ul class="generic-list-item off-canvas-menu-list pt-90px">
            <li>
                <a href="#">Home</a>
                <ul class="sub-menu">
                    <li><a href="index.html">Home One</a></li>
                    <li><a href="home-2.html">Home Two</a></li>
                    <li><a href="home-3.html">Home Three</a></li>
                    <li><a href="home-4.html">Home four</a></li>
                </ul>
            </li>
            <li>
                <a href="#">courses</a>
                <ul class="sub-menu">
                    <li><a href="course-grid.html">course grid</a></li>
                    <li><a href="course-list.html">course list</a></li>
                    <li><a href="course-grid-left-sidebar.html">grid left sidebar</a></li>
                    <li><a href="course-grid-right-sidebar.html">grid right sidebar</a></li>
                    <li><a href="course-list-left-sidebar.html">list left sidebar <span
                                class="ribbon ribbon-blue-bg">New</span></a></li>
                    <li><a href="course-list-right-sidebar.html">list right sidebar <span
                                class="ribbon ribbon-blue-bg">New</span></a></li>
                    <li><a href="course-details.html">course details</a></li>
                    <li><a href="lesson-details.html">lesson details</a></li>
                    <li><a href="my-courses.html">My courses</a></li>
                </ul>
            </li>
            <li>
                <a href="#">Student</a>
                <ul class="sub-menu">
                    <li><a href="student-detail.html">student detail</a></li>
                    <li><a href="student-quiz.html">take quiz</a></li>
                    <li><a href="student-quiz-results.html">quiz results</a></li>
                    <li><a href="student-quiz-result-details.html">quiz details</a></li>
                    <li><a href="student-quiz-result-details-2.html">quiz details 2</a></li>
                    <li><a href="student-path.html">path details</a></li>
                    <li><a href="student-path-assessment.html">Skill Assessment</a></li>
                    <li><a href="student-path-assessment-result.html">Skill result</a></li>
                </ul>
            </li>
            <li>
                <a href="#">pages</a>
                <ul class="sub-menu">
                    <li><a href="dashboard.html">dashboard <span class="ribbon">Hot</span></a></li>
                    <li><a href="about.html">about</a></li>
                    <li><a href="teachers.html">Teachers</a></li>
                    <li><a href="teacher-detail.html">Teacher detail</a></li>
                    <li><a href="careers.html">careers</a></li>
                    <li><a href="career-details.html">career details</a></li>
                    <li><a href="categories.html">categories</a></li>
                    <li><a href="terms-and-conditions.html">Terms & conditions</a></li>
                    <li><a href="privacy-policy.html">privacy policy</a></li>
                    <li><a href="for-business.html">for business</a></li>
                    <li><a href="become-a-teacher.html">become an instructor</a></li>
                    <li><a href="faq.html">FAQs</a></li>
                    <li><a href="admission.html">admission</a></li>
                    <li><a href="gallery.html">gallery</a></li>
                    <li><a href="pricing-table.html">pricing tables</a></li>
                    <li><a href="contact.html">contact</a></li>
                    <li><a href="sign-up.html">sign-up</a></li>
                    <li><a href="login.html">login</a></li>
                    <li><a href="recover.html">recover</a></li>
                    <li><a href="shopping-cart.html">cart</a></li>
                    <li><a href="checkout.html">checkout</a></li>
                    <li><a href="error.html">page 404</a></li>
                </ul>
            </li>
            <li>
                <a href="#">blog</a>
                <ul class="sub-menu">
                    <li><a href="blog-full-width.html">blog full width </a></li>
                    <li><a href="blog-no-sidebar.html">blog no sidebar</a></li>
                    <li><a href="blog-left-sidebar.html">blog left sidebar</a></li>
                    <li><a href="blog-right-sidebar.html">blog right sidebar</a></li>
                    <li><a href="blog-single.html">blog detail</a></li>
                </ul>
            </li>
        </ul>
    </div><!-- end off-canvas-menu -->
    <div class="off-canvas-menu custom-scrollbar-styled category-off-canvas-menu">
        <div class="off-canvas-menu-close cat-menu-close icon-element icon-element-sm shadow-sm" data-toggle="tooltip"
            data-placement="left" title="Close menu">
            <i class="la la-times"></i>
        </div><!-- end off-canvas-menu-close -->
        <ul class="generic-list-item off-canvas-menu-list pt-90px">
            <li>
                <a href="course-grid.html">Development</a>
                <ul class="sub-menu">
                    <li><a href="#">All Development</a></li>
                    <li><a href="#">Web Development</a></li>
                    <li><a href="#">Mobile Apps</a></li>
                    <li><a href="#">Game Development</a></li>
                    <li><a href="#">Databases</a></li>
                    <li><a href="#">Programming Languages</a></li>
                    <li><a href="#">Software Testing</a></li>
                    <li><a href="#">Software Engineering</a></li>
                    <li><a href="#">E-Commerce</a></li>
                </ul>
            </li>
            <li>
                <a href="course-grid.html">business</a>
                <ul class="sub-menu">
                    <li><a href="#">All Business</a></li>
                    <li><a href="#">Finance</a></li>
                    <li><a href="#">Entrepreneurship</a></li>
                    <li><a href="#">Strategy</a></li>
                    <li><a href="#">Real Estate</a></li>
                    <li><a href="#">Home Business</a></li>
                    <li><a href="#">Communications</a></li>
                    <li><a href="#">Industry</a></li>
                    <li><a href="#">Other</a></li>
                </ul>
            </li>
            <li>
                <a href="course-grid.html">IT & Software</a>
                <ul class="sub-menu">
                    <li><a href="#">All IT & Software</a></li>
                    <li><a href="#">IT Certification</a></li>
                    <li><a href="#">Hardware</a></li>
                    <li><a href="#">Network & Security</a></li>
                    <li><a href="#">Operating Systems</a></li>
                    <li><a href="#">Other</a></li>
                </ul>
            </li>
            <li>
                <a href="course-grid.html">Finance & Accounting</a>
                <ul class="sub-menu">
                    <li><a href="#"> All Finance & Accounting</a></li>
                    <li><a href="#">Accounting & Bookkeeping</a></li>
                    <li><a href="#">Cryptocurrency & Blockchain</a></li>
                    <li><a href="#">Economics</a></li>
                    <li><a href="#">Investing & Trading</a></li>
                    <li><a href="#">Other Finance & Economics</a></li>
                </ul>
            </li>
            <li>
                <a href="course-grid.html">design</a>
                <ul class="sub-menu">
                    <li><a href="#">All Design</a></li>
                    <li><a href="#">Graphic Design</a></li>
                    <li><a href="#">Web Design</a></li>
                    <li><a href="#">Design Tools</a></li>
                    <li><a href="#">3D & Animation</a></li>
                    <li><a href="#">User Experience</a></li>
                    <li><a href="#">Other</a></li>
                </ul>
            </li>
            <li>
                <a href="course-grid.html">Personal Development</a>
                <ul class="sub-menu">
                    <li><a href="#">All Personal Development</a></li>
                    <li><a href="#">Personal Transformation</a></li>
                    <li><a href="#">Productivity</a></li>
                    <li><a href="#">Leadership</a></li>
                    <li><a href="#">Personal Finance</a></li>
                    <li><a href="#">Career Development</a></li>
                    <li><a href="#">Parenting & Relationships</a></li>
                    <li><a href="#">Happiness</a></li>
                </ul>
            </li>
            <li>
                <a href="course-grid.html">Marketing</a>
                <ul class="sub-menu">
                    <li><a href="#">All Marketing</a></li>
                    <li><a href="#">Digital Marketing</a></li>
                    <li><a href="#">Search Engine Optimization</a></li>
                    <li><a href="#">Social Media Marketing</a></li>
                    <li><a href="#">Branding</a></li>
                    <li><a href="#">Video & Mobile Marketing</a></li>
                    <li><a href="#">Affiliate Marketing</a></li>
                    <li><a href="#">Growth Hacking</a></li>
                    <li><a href="#">Other</a></li>
                </ul>
            </li>
            <li>
                <a href="course-grid.html">Health & Fitness</a>
                <ul class="sub-menu">
                    <li><a href="#">All Health & Fitness</a></li>
                    <li><a href="#">Fitness</a></li>
                    <li><a href="#">Sports</a></li>
                    <li><a href="#">Dieting</a></li>
                    <li><a href="#">Self Defense</a></li>
                    <li><a href="#">Meditation</a></li>
                    <li><a href="#">Mental Health</a></li>
                    <li><a href="#">Yoga</a></li>
                    <li><a href="#">Dance</a></li>
                    <li><a href="#">Other</a></li>
                </ul>
            </li>
            <li>
                <a href="course-grid.html">Photography</a>
                <ul class="sub-menu">
                    <li><a href="#">All Photography</a></li>
                    <li><a href="#">Digital Photography</a></li>
                    <li><a href="#">Photography Fundamentals</a></li>
                    <li><a href="#">Commercial Photography</a></li>
                    <li><a href="#">Video Design</a></li>
                    <li><a href="#">Photography Tools</a></li>
                    <li><a href="#">Other</a></li>
                </ul>
            </li>
        </ul>
    </div><!-- end off-canvas-menu -->
    <div class="mobile-search-form">
        <div class="d-flex align-items-center">
            <form method="post" class="flex-grow-1 mr-3">
                <div class="form-group mb-0">
                    <input class="form-control form--control pl-3" type="text" name="search"
                        placeholder="Search for anything">
                    <span class="la la-search search-icon"></span>
                </div>
            </form>
            <div class="search-bar-close icon-element icon-element-sm shadow-sm">
                <i class="la la-times"></i>
            </div><!-- end off-canvas-menu-close -->
        </div>
    </div><!-- end mobile-search-form -->
    <div class="body-overlay"></div>
</header><!-- end header-menu-area -->
