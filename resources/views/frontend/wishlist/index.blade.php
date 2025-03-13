@extends('layouts.frontend.master')

@section('title', 'Wishlist')

@section('content')

    <!-- ================================
                START BREADCRUMB AREA
            ================================= -->
    <section class="breadcrumb-area py-5 bg-white pattern-bg">
        <div class="container">
            <div class="breadcrumb-content">
                <div class="section-heading">
                    <h2 class="section__title">My Courses</h2>
                </div><!-- end section-heading -->
                <ul class="nav nav-tabs generic-tab pt-30px" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="all-course-tab" data-toggle="tab" href="#all-course" role="tab"
                            aria-controls="all-course" aria-selected="false">
                            All Courses
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="collections-tab" data-toggle="tab" href="#collections" role="tab"
                            aria-controls="collections" aria-selected="true">
                            Collections
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="wishlist-tab" data-toggle="tab" href="#wishlist" role="tab"
                            aria-controls="wishlist" aria-selected="false">
                            Wishlist
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="archived-tab" data-toggle="tab" href="#archived" role="tab"
                            aria-controls="archived" aria-selected="false">
                            Archived
                        </a>
                    </li>
                </ul>
            </div><!-- end breadcrumb-content -->
        </div><!-- end container -->
    </section><!-- end breadcrumb-area -->
    <!-- ================================
                    END BREADCRUMB AREA
                ================================= -->

    <!-- ================================
                       START MY COURSES
                ================================= -->
    <section class="my-courses-area pt-30px pb-90px">
        <div class="container">
            <div class="my-course-content-wrap">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="all-course" role="tabpanel" aria-labelledby="all-course-tab">
                        <div class="my-course-body">
                            {{-- <div class="alert alert-info alert-dismissible fade show course-alert-info" role="alert">
                                <div class="d-flex align-items-center">
                                    <i class="la la-users fs-40"></i> <a href="invite.html"
                                        class="alert-link font-weight-medium pl-4">Share Aduca with friends</a>
                                </div>
                                <button type="button" class="close fs-20" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true" class="la la-times"></span>
                                </button>
                            </div><!-- end alert --> --}}
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
                                                <option value="3">All Categories</option>
                                                <option value="4">Development</option>
                                                <option value="5">Design</option>
                                                <option value="6">Business</option>
                                                <option value="7">Marketing</option>
                                                <option value="8">IT & Software</option>
                                                <option value="9">Finance & Accounting</option>
                                                <option value="10">Personal Development</option>
                                                <option value="11">Office Productivity</option>
                                                <option value="12">Teaching & Academics</option>
                                                <option value="13">Lifestyle</option>
                                                <option value="14">Aduca Free Resource Center</option>
                                            </select>
                                        </div>
                                        <div class="select-container">
                                            <select class="select-container-select">
                                                <option value="0" selected="">Progress</option>
                                                <option value="1">Not Started</option>
                                                <option value="2">In Progress</option>
                                                <option value="3">Completed</option>
                                            </select>
                                        </div>
                                        <div class="select-container">
                                            <select class="select-container-select">
                                                <option selected>All Instructor</option>
                                                <option value="1">Aduca Instructor Team</option>
                                                <option value="1">Aatef Jaberi</option>
                                                <option value="2">Abdul Wali</option>
                                                <option value="3">Abhay Talreja</option>
                                                <option value="4">Akshay Goel</option>
                                                <option value="5">Al Sweigart</option>
                                                <option value="6">Alagappan K</option>
                                                <option value="7">Bluelime Learning Solutions</option>
                                                <option value="8">Boris Paskhaver</option>
                                                <option value="9">Brent Dalley</option>
                                                <option value="10">Brian Jackson</option>
                                                <option value="11">Bruce Chamoff</option>
                                                <option value="12">Carl Heaton</option>
                                                <option value="13">Chad Tennant</option>
                                                <option value="14">Chris Lele</option>
                                                <option value="15">Daniel Kalish</option>
                                                <option value="16">Daniel White</option>
                                                <option value="17">Darrel Wilson</option>
                                                <option value="18">EDUmobile Academy</option>
                                                <option value="19">Eduonix Learning Solutions</option>
                                                <option value="20">Eduonix-Tech</option>
                                                <option value="21">Ermin Kreponic</option>
                                                <option value="22">Fahad Chaudhry</option>
                                                <option value="23">Federico Fort</option>
                                                <option value="24">Frahaan Hussain</option>
                                                <option value="25">Gabriel Both</option>
                                                <option value="26">Gandhi Kumarasamy Sezhian</option>
                                                <option value="27">Hayley - Creative Mind Ch</option>
                                                <option value="28">Hussein Al Rubaye</option>
                                                <option value="29">Infinite Skills</option>
                                                <option value="30">Irfan Dayan</option>
                                                <option value="31">James Canzanella</option>
                                                <option value="32">James G</option>
                                                <option value="33">Kawser Ahmed</option>
                                                <option value="34">Kraig Mathias</option>
                                                <option value="35">Krisztina Rudnay</option>
                                                <option value="36">Laurence Svekis</option>
                                                <option value="37">Lawrence Kim</option>
                                                <option value="17">M Darwish</option>
                                                <option value="38">Maggie Osama</option>
                                                <option value="39">Nader Hantash</option>
                                                <option value="40">Naeem Hussain</option>
                                                <option value="41">Phil Ebiner</option>
                                                <option value="42">Rufeena Jones S</option>
                                                <option value="43">Richard Miles</option>
                                                <option value="44">Sandor Kiss</option>
                                                <option value="45">Saranya Srinidhi</option>
                                                <option value="46">Think Forward Online Training</option>
                                                <option value="47">Tim Sharp</option>
                                                <option value="48">Usman Raoof</option>
                                                <option value="49">Victoria White</option>
                                                <option value="50">Wayne Walker</option>
                                                <option value="51">Yohann Taieb</option>
                                                <option value="52">Zac Johnson</option>
                                                <option value="53">Zach Miller</option>
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
                            <div class="my-course-cards pt-40px">
                                <div class="row">
                                    <div class="col-lg-4 responsive-column-half">
                                        <div class="card card-item">
                                            <div class="card-image">
                                                <a href="lesson-details.html" class="d-block">
                                                    <img class="card-img-top lazy" src="images/img-loading.png"
                                                        data-src="images/img8.jpg" alt="Card image cap">
                                                    <div class="play-button">
                                                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" x="0px"
                                                            y="0px" viewBox="-307.4 338.8 91.8 91.8" xml:space="preserve">
                                                            <style type="text/css">
                                                                .st0 {
                                                                    opacity: 0.6;
                                                                    fill: #000000;
                                                                    border-radius: 100px;
                                                                }

                                                                .st1 {
                                                                    fill: #FFFFFF;
                                                                }
                                                            </style>
                                                            <g>
                                                                <circle class="st0" cx="-261.5" cy="384.7"
                                                                    r="45.9"></circle>
                                                                <path class="st1"
                                                                    d="M-272.9,363.2l35.8,20.7c0.7,0.4,0.7,1.3,0,1.7l-35.8,20.7c-0.7,0.4-1.5-0.1-1.5-0.9V364C-274.4,363.3-273.5,362.8-272.9,363.2z">
                                                                </path>
                                                            </g>
                                                        </svg>
                                                    </div>
                                                </a>
                                                <div class="course-badge-labels course--badge-labels">
                                                    <div
                                                        class="generic-action-wrap generic--action-wrap generic--action-wrap-2">
                                                        <div class="dropdown">
                                                            <a class="action-btn bg-white text-gray dropdown-btn"
                                                                href="#" role="button" id="allCourseMenuLink"
                                                                data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                                <i class="la la-ellipsis-v"></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-wrap"
                                                                aria-labelledby="allCourseMenuLink">
                                                                <h6 class="dropdown-header text-black">Collections</h6>
                                                                <a href="javascript:void(0)"
                                                                    class="dropdown-item collection-link d-flex align-items-center justify-content-between">
                                                                    <span>Javascript</span>
                                                                    <span class="la la-check collection-icon"></span>
                                                                </a>
                                                                <a href="javascript:void(0)"
                                                                    class="dropdown-item collection-link d-flex align-items-center justify-content-between">
                                                                    <span>Business</span>
                                                                    <span class="la la-check collection-icon"></span>
                                                                </a>
                                                                <div class="section-block my-2"></div>
                                                                <a href="javascript:void(0)"
                                                                    class="dropdown-item d-flex align-items-center justify-content-between"
                                                                    data-toggle="modal" data-target="#shareModal">
                                                                    <span>Share</span> <i class="ml-auto la la-share"></i>
                                                                </a>
                                                                <a href="javascript:void(0)"
                                                                    class="dropdown-item d-flex align-items-center justify-content-between"
                                                                    data-toggle="modal"
                                                                    data-target="#createNewCollectionModal">
                                                                    <span>Create New Collection</span> <i
                                                                        class="ml-auto la la-plus"></i>
                                                                </a>
                                                                <a href="javascript:void(0)"
                                                                    class="dropdown-item d-flex align-items-center justify-content-between">
                                                                    <span class="swapping-btn w-100"
                                                                        data-text-swap="Unfavorite"
                                                                        data-text-original="Favorite">Favorite</span>
                                                                    <i class="ml-auto la la-star"></i>
                                                                </a>
                                                                <a href="javascript:void(0)"
                                                                    class="dropdown-item d-flex align-items-center justify-content-between">
                                                                    <span class="swapping-btn w-100"
                                                                        data-text-swap="Archived"
                                                                        data-text-original="Archive">Archive</span>
                                                                    <i class="la la-archive"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- end card-image -->
                                            <div class="card-body">
                                                <h5 class="card-title"><a href="lesson-details.html">The Complete
                                                        Full-Stack JavaScript Course!</a></h5>
                                                <p class="card-text lh-22 pt-2"><a href="teacher-detail.html">Jose
                                                        Portilla</a><span>, Software Engineer and Developer</span></p>
                                                <div
                                                    class="my-course-progress-bar-wrap d-flex flex-wrap align-items-center mt-3 position-relative">
                                                    <p class="skillbar-title">Complete:</p>
                                                    <div class="skillbar-box">
                                                        <div class="skillbar skillbar-skillbar-2" data-percent="70%">
                                                            <div class="skillbar-bar skillbar--bar-2 bg-1"></div>
                                                        </div><!-- End Skill Bar -->
                                                    </div>
                                                    <div class="skill-bar-percent">70%</div>
                                                </div><!-- end my-course-progress-bar-wrap -->
                                                <div
                                                    class="rating-wrap d-flex align-items-center justify-content-between pt-3">
                                                    <div class="review-stars">
                                                        <span class="la la-star"></span>
                                                        <span class="la la-star"></span>
                                                        <span class="la la-star"></span>
                                                        <span class="la la-star"></span>
                                                        <span class="la la-star-o"></span>
                                                    </div>
                                                    <a href="#"
                                                        class="btn theme-btn theme-btn-sm theme-btn-transparent"
                                                        data-toggle="modal" data-target="#ratingModal">Leave a rating</a>
                                                </div><!-- end rating-wrap -->
                                            </div><!-- end card-body -->
                                        </div><!-- end card -->
                                    </div><!-- end col-lg-4 -->
                                    <div class="col-lg-4 responsive-column-half">
                                        <div class="card card-item">
                                            <div class="card-image">
                                                <a href="lesson-details.html" class="d-block">
                                                    <img class="card-img-top lazy" src="images/img-loading.png"
                                                        data-src="images/img9.jpg" alt="Card image cap">
                                                    <div class="play-button">
                                                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" x="0px"
                                                            y="0px" viewBox="-307.4 338.8 91.8 91.8" xml:space="preserve">
                                                            <style type="text/css">
                                                                .st0 {
                                                                    opacity: 0.6;
                                                                    fill: #000000;
                                                                    border-radius: 100px;
                                                                }

                                                                .st1 {
                                                                    fill: #FFFFFF;
                                                                }
                                                            </style>
                                                            <g>
                                                                <circle class="st0" cx="-261.5" cy="384.7"
                                                                    r="45.9"></circle>
                                                                <path class="st1"
                                                                    d="M-272.9,363.2l35.8,20.7c0.7,0.4,0.7,1.3,0,1.7l-35.8,20.7c-0.7,0.4-1.5-0.1-1.5-0.9V364C-274.4,363.3-273.5,362.8-272.9,363.2z">
                                                                </path>
                                                            </g>
                                                        </svg>
                                                    </div>
                                                </a>
                                                <div class="course-badge-labels course--badge-labels">
                                                    <div
                                                        class="generic-action-wrap generic--action-wrap generic--action-wrap-2">
                                                        <div class="dropdown">
                                                            <a class="action-btn bg-white text-gray dropdown-btn"
                                                                href="#" role="button" id="allCourseMenuLinkTwo"
                                                                data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                                <i class="la la-ellipsis-v"></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-wrap"
                                                                aria-labelledby="allCourseMenuLinkTwo">
                                                                <h6 class="dropdown-header text-black">Collections</h6>
                                                                <p class="dropdown-header">You have no collections</p>
                                                                <div class="section-block my-2"></div>
                                                                <a href="javascript:void(0)"
                                                                    class="dropdown-item d-flex align-items-center justify-content-between"
                                                                    data-toggle="modal" data-target="#shareModal">
                                                                    <span>Share</span> <i class="ml-auto la la-share"></i>
                                                                </a>
                                                                <a href="javascript:void(0)"
                                                                    class="dropdown-item d-flex align-items-center justify-content-between"
                                                                    data-toggle="modal"
                                                                    data-target="#createNewCollectionModal">
                                                                    <span>Create New Collection</span> <i
                                                                        class="ml-auto la la-plus"></i>
                                                                </a>
                                                                <a href="javascript:void(0)"
                                                                    class="dropdown-item d-flex align-items-center justify-content-between">
                                                                    <span class="swapping-btn w-100"
                                                                        data-text-swap="Unfavorite"
                                                                        data-text-original="Favorite">Favorite</span>
                                                                    <i class="ml-auto la la-star"></i>
                                                                </a>
                                                                <a href="javascript:void(0)"
                                                                    class="dropdown-item d-flex align-items-center justify-content-between">
                                                                    <span class="swapping-btn w-100"
                                                                        data-text-swap="Archived"
                                                                        data-text-original="Archive">Archive</span>
                                                                    <i class="la la-archive"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- end card-image -->
                                            <div class="card-body">
                                                <h5 class="card-title"><a href="lesson-details.html">Microsoft SQL Server
                                                        2019 for Everyone</a></h5>
                                                <p class="card-text lh-22 pt-2"><a href="teacher-detail.html">Jose
                                                        Portilla</a><span>, Software Engineer and Developer</span></p>
                                                <div
                                                    class="my-course-progress-bar-wrap d-flex flex-wrap align-items-center mt-3 position-relative">
                                                    <p class="skillbar-title">Complete:</p>
                                                    <div class="skillbar-box">
                                                        <div class="skillbar skillbar-skillbar-2" data-percent="0%">
                                                            <div class="skillbar-bar skillbar--bar-2 bg-1"></div>
                                                        </div><!-- End Skill Bar -->
                                                    </div>
                                                    <div class="skill-bar-percent">0%</div>
                                                </div><!-- end my-course-progress-bar-wrap -->
                                                <div
                                                    class="rating-wrap d-flex align-items-center justify-content-between pt-3">
                                                    <div class="review-stars">
                                                        <span class="la la-star-o"></span>
                                                        <span class="la la-star-o"></span>
                                                        <span class="la la-star-o"></span>
                                                        <span class="la la-star-o"></span>
                                                        <span class="la la-star-o"></span>
                                                    </div>
                                                    <a href="#"
                                                        class="btn theme-btn theme-btn-sm theme-btn-transparent"
                                                        data-toggle="modal" data-target="#ratingModal">Leave a rating</a>
                                                </div><!-- end rating-wrap -->
                                            </div><!-- end card-body -->
                                        </div><!-- end card -->
                                    </div><!-- end col-lg-4 -->
                                    <div class="col-lg-4 responsive-column-half">
                                        <div class="card card-item">
                                            <div class="card-image">
                                                <a href="lesson-details.html" class="d-block">
                                                    <img class="card-img-top lazy" src="images/img-loading.png"
                                                        data-src="images/img10.jpg" alt="Card image cap">
                                                    <div class="play-button">
                                                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" x="0px"
                                                            y="0px" viewBox="-307.4 338.8 91.8 91.8" xml:space="preserve">
                                                            <style type="text/css">
                                                                .st0 {
                                                                    opacity: 0.6;
                                                                    fill: #000000;
                                                                    border-radius: 100px;
                                                                }

                                                                .st1 {
                                                                    fill: #FFFFFF;
                                                                }
                                                            </style>
                                                            <g>
                                                                <circle class="st0" cx="-261.5" cy="384.7"
                                                                    r="45.9"></circle>
                                                                <path class="st1"
                                                                    d="M-272.9,363.2l35.8,20.7c0.7,0.4,0.7,1.3,0,1.7l-35.8,20.7c-0.7,0.4-1.5-0.1-1.5-0.9V364C-274.4,363.3-273.5,362.8-272.9,363.2z">
                                                                </path>
                                                            </g>
                                                        </svg>
                                                    </div>
                                                </a>
                                                <div class="course-badge-labels course--badge-labels">
                                                    <div
                                                        class="generic-action-wrap generic--action-wrap generic--action-wrap-2">
                                                        <div class="dropdown">
                                                            <a class="action-btn bg-white text-gray dropdown-btn"
                                                                href="#" role="button" id="allCourseMenuLinkThree"
                                                                data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                                <i class="la la-ellipsis-v"></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-wrap"
                                                                aria-labelledby="allCourseMenuLinkThree">
                                                                <h6 class="dropdown-header text-black">Collections</h6>
                                                                <a href="javascript:void(0)"
                                                                    class="dropdown-item collection-link d-flex align-items-center justify-content-between">
                                                                    <span>Javascript</span>
                                                                    <span class="la la-check collection-icon"></span>
                                                                </a>
                                                                <a href="javascript:void(0)"
                                                                    class="dropdown-item collection-link d-flex align-items-center justify-content-between">
                                                                    <span>Business</span>
                                                                    <span class="la la-check collection-icon"></span>
                                                                </a>
                                                                <div class="section-block my-2"></div>
                                                                <a href="javascript:void(0)"
                                                                    class="dropdown-item d-flex align-items-center justify-content-between"
                                                                    data-toggle="modal" data-target="#shareModal">
                                                                    <span>Share</span> <i class="ml-auto la la-share"></i>
                                                                </a>
                                                                <a href="javascript:void(0)"
                                                                    class="dropdown-item d-flex align-items-center justify-content-between"
                                                                    data-toggle="modal"
                                                                    data-target="#createNewCollectionModal">
                                                                    <span>Create New Collection</span> <i
                                                                        class="ml-auto la la-plus"></i>
                                                                </a>
                                                                <a href="javascript:void(0)"
                                                                    class="dropdown-item d-flex align-items-center justify-content-between">
                                                                    <span class="swapping-btn w-100"
                                                                        data-text-swap="Unfavorite"
                                                                        data-text-original="Favorite">Favorite</span>
                                                                    <i class="ml-auto la la-star"></i>
                                                                </a>
                                                                <a href="javascript:void(0)"
                                                                    class="dropdown-item d-flex align-items-center justify-content-between">
                                                                    <span class="swapping-btn w-100"
                                                                        data-text-swap="Archived"
                                                                        data-text-original="Archive">Archive</span>
                                                                    <i class="la la-archive"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- end card-image -->
                                            <div class="card-body">
                                                <h5 class="card-title"><a href="lesson-details.html">WordPress for
                                                        Beginners – Master WordPress</a></h5>
                                                <p class="card-text lh-22 pt-2"><a href="teacher-detail.html">Jose
                                                        Portilla</a><span>, Software Engineer and Developer</span></p>
                                                <div
                                                    class="my-course-progress-bar-wrap d-flex flex-wrap align-items-center mt-3 position-relative">
                                                    <p class="skillbar-title">Complete:</p>
                                                    <div class="skillbar-box">
                                                        <div class="skillbar skillbar-skillbar-2" data-percent="0%">
                                                            <div class="skillbar-bar skillbar--bar-2 bg-1"></div>
                                                        </div><!-- End Skill Bar -->
                                                    </div>
                                                    <div class="skill-bar-percent">0%</div>
                                                </div><!-- end my-course-progress-bar-wrap -->
                                                <div
                                                    class="rating-wrap d-flex align-items-center justify-content-between pt-3">
                                                    <div class="review-stars">
                                                        <span class="la la-star-o"></span>
                                                        <span class="la la-star-o"></span>
                                                        <span class="la la-star-o"></span>
                                                        <span class="la la-star-o"></span>
                                                        <span class="la la-star-o"></span>
                                                    </div>
                                                    <a href="#"
                                                        class="btn theme-btn theme-btn-sm theme-btn-transparent"
                                                        data-toggle="modal" data-target="#ratingModal">Leave a rating</a>
                                                </div><!-- end rating-wrap -->
                                            </div><!-- end card-body -->
                                        </div><!-- end card -->
                                    </div><!-- end col-lg-4 -->
                                    <div class="col-lg-4 responsive-column-half">
                                        <div class="card card-item">
                                            <div class="card-image">
                                                <a href="lesson-details.html" class="d-block">
                                                    <img class="card-img-top lazy" src="images/img-loading.png"
                                                        data-src="images/img11.jpg" alt="Card image cap">
                                                    <div class="play-button">
                                                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" x="0px"
                                                            y="0px" viewBox="-307.4 338.8 91.8 91.8" xml:space="preserve">
                                                            <style type="text/css">
                                                                .st0 {
                                                                    opacity: 0.6;
                                                                    fill: #000000;
                                                                    border-radius: 100px;
                                                                }

                                                                .st1 {
                                                                    fill: #FFFFFF;
                                                                }
                                                            </style>
                                                            <g>
                                                                <circle class="st0" cx="-261.5" cy="384.7"
                                                                    r="45.9"></circle>
                                                                <path class="st1"
                                                                    d="M-272.9,363.2l35.8,20.7c0.7,0.4,0.7,1.3,0,1.7l-35.8,20.7c-0.7,0.4-1.5-0.1-1.5-0.9V364C-274.4,363.3-273.5,362.8-272.9,363.2z">
                                                                </path>
                                                            </g>
                                                        </svg>
                                                    </div>
                                                </a>
                                                <div class="course-badge-labels course--badge-labels">
                                                    <div
                                                        class="generic-action-wrap generic--action-wrap generic--action-wrap-2">
                                                        <div class="dropdown">
                                                            <a class="action-btn bg-white text-gray dropdown-btn"
                                                                href="#" role="button" id="allCourseMenuLinkFour"
                                                                data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                                <i class="la la-ellipsis-v"></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-wrap"
                                                                aria-labelledby="allCourseMenuLinkFour">
                                                                <h6 class="dropdown-header text-black">Collections</h6>
                                                                <a href="javascript:void(0)"
                                                                    class="dropdown-item collection-link d-flex align-items-center justify-content-between">
                                                                    <span>Javascript</span>
                                                                    <span class="la la-check collection-icon"></span>
                                                                </a>
                                                                <a href="javascript:void(0)"
                                                                    class="dropdown-item collection-link d-flex align-items-center justify-content-between">
                                                                    <span>Business</span>
                                                                    <span class="la la-check collection-icon"></span>
                                                                </a>
                                                                <div class="section-block my-2"></div>
                                                                <a href="javascript:void(0)"
                                                                    class="dropdown-item d-flex align-items-center justify-content-between"
                                                                    data-toggle="modal" data-target="#shareModal">
                                                                    <span>Share</span> <i class="ml-auto la la-share"></i>
                                                                </a>
                                                                <a href="javascript:void(0)"
                                                                    class="dropdown-item d-flex align-items-center justify-content-between"
                                                                    data-toggle="modal"
                                                                    data-target="#createNewCollectionModal">
                                                                    <span>Create New Collection</span> <i
                                                                        class="ml-auto la la-plus"></i>
                                                                </a>
                                                                <a href="javascript:void(0)"
                                                                    class="dropdown-item d-flex align-items-center justify-content-between">
                                                                    <span class="swapping-btn w-100"
                                                                        data-text-swap="Unfavorite"
                                                                        data-text-original="Favorite">Favorite</span>
                                                                    <i class="ml-auto la la-star"></i>
                                                                </a>
                                                                <a href="javascript:void(0)"
                                                                    class="dropdown-item d-flex align-items-center justify-content-between">
                                                                    <span class="swapping-btn w-100"
                                                                        data-text-swap="Archived"
                                                                        data-text-original="Archive">Archive</span>
                                                                    <i class="la la-archive"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- end card-image -->
                                            <div class="card-body">
                                                <h5 class="card-title"><a href="lesson-details.html">The Complete
                                                        Full-Stack JavaScript Course!</a></h5>
                                                <p class="card-text lh-22 pt-2"><a href="teacher-detail.html">Jose
                                                        Portilla</a><span>, Software Engineer and Developer</span></p>
                                                <div
                                                    class="my-course-progress-bar-wrap d-flex flex-wrap align-items-center mt-3 position-relative">
                                                    <p class="skillbar-title">Complete:</p>
                                                    <div class="skillbar-box">
                                                        <div class="skillbar skillbar-skillbar-2" data-percent="70%">
                                                            <div class="skillbar-bar skillbar--bar-2 bg-1"></div>
                                                        </div><!-- End Skill Bar -->
                                                    </div>
                                                    <div class="skill-bar-percent">70%</div>
                                                </div><!-- end my-course-progress-bar-wrap -->
                                                <div
                                                    class="rating-wrap d-flex align-items-center justify-content-between pt-3">
                                                    <div class="review-stars">
                                                        <span class="la la-star-o"></span>
                                                        <span class="la la-star-o"></span>
                                                        <span class="la la-star-o"></span>
                                                        <span class="la la-star-o"></span>
                                                        <span class="la la-star-o"></span>
                                                    </div>
                                                    <a href="#"
                                                        class="btn theme-btn theme-btn-sm theme-btn-transparent"
                                                        data-toggle="modal" data-target="#ratingModal">Leave a rating</a>
                                                </div><!-- end rating-wrap -->
                                            </div><!-- end card-body -->
                                        </div><!-- end card -->
                                    </div><!-- end col-lg-4 -->
                                    <div class="col-lg-4 responsive-column-half">
                                        <div class="card card-item">
                                            <div class="card-image">
                                                <a href="lesson-details.html" class="d-block">
                                                    <img class="card-img-top lazy" src="images/img-loading.png"
                                                        data-src="images/img12.jpg" alt="Card image cap">
                                                    <div class="play-button">
                                                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" x="0px"
                                                            y="0px" viewBox="-307.4 338.8 91.8 91.8" xml:space="preserve">
                                                            <style type="text/css">
                                                                .st0 {
                                                                    opacity: 0.6;
                                                                    fill: #000000;
                                                                    border-radius: 100px;
                                                                }

                                                                .st1 {
                                                                    fill: #FFFFFF;
                                                                }
                                                            </style>
                                                            <g>
                                                                <circle class="st0" cx="-261.5" cy="384.7"
                                                                    r="45.9"></circle>
                                                                <path class="st1"
                                                                    d="M-272.9,363.2l35.8,20.7c0.7,0.4,0.7,1.3,0,1.7l-35.8,20.7c-0.7,0.4-1.5-0.1-1.5-0.9V364C-274.4,363.3-273.5,362.8-272.9,363.2z">
                                                                </path>
                                                            </g>
                                                        </svg>
                                                    </div>
                                                </a>
                                                <div class="course-badge-labels course--badge-labels">
                                                    <div
                                                        class="generic-action-wrap generic--action-wrap generic--action-wrap-2">
                                                        <div class="dropdown">
                                                            <a class="action-btn bg-white text-gray dropdown-btn"
                                                                href="#" role="button" id="allCourseMenuLinkFive"
                                                                data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                                <i class="la la-ellipsis-v"></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-wrap"
                                                                aria-labelledby="allCourseMenuLinkFive">
                                                                <h6 class="dropdown-header text-black">Collections</h6>
                                                                <p class="dropdown-header">You have no collections</p>
                                                                <div class="section-block my-2"></div>
                                                                <a href="javascript:void(0)"
                                                                    class="dropdown-item d-flex align-items-center justify-content-between"
                                                                    data-toggle="modal" data-target="#shareModal">
                                                                    <span>Share</span> <i class="ml-auto la la-share"></i>
                                                                </a>
                                                                <a href="javascript:void(0)"
                                                                    class="dropdown-item d-flex align-items-center justify-content-between"
                                                                    data-toggle="modal"
                                                                    data-target="#createNewCollectionModal">
                                                                    <span>Create New Collection</span> <i
                                                                        class="ml-auto la la-plus"></i>
                                                                </a>
                                                                <a href="javascript:void(0)"
                                                                    class="dropdown-item d-flex align-items-center justify-content-between">
                                                                    <span class="swapping-btn w-100"
                                                                        data-text-swap="Unfavorite"
                                                                        data-text-original="Favorite">Favorite</span>
                                                                    <i class="ml-auto la la-star"></i>
                                                                </a>
                                                                <a href="javascript:void(0)"
                                                                    class="dropdown-item d-flex align-items-center justify-content-between">
                                                                    <span class="swapping-btn w-100"
                                                                        data-text-swap="Archived"
                                                                        data-text-original="Archive">Archive</span>
                                                                    <i class="la la-archive"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- end card-image -->
                                            <div class="card-body">
                                                <h5 class="card-title"><a href="lesson-details.html">Microsoft SQL Server
                                                        2019 for Everyone</a></h5>
                                                <p class="card-text lh-22 pt-2"><a href="teacher-detail.html">Jose
                                                        Portilla</a><span>, Software Engineer and Developer</span></p>
                                                <div
                                                    class="my-course-progress-bar-wrap d-flex flex-wrap align-items-center mt-3 position-relative">
                                                    <p class="skillbar-title">Complete:</p>
                                                    <div class="skillbar-box">
                                                        <div class="skillbar skillbar-skillbar-2" data-percent="0%">
                                                            <div class="skillbar-bar skillbar--bar-2 bg-1"></div>
                                                        </div><!-- End Skill Bar -->
                                                    </div>
                                                    <div class="skill-bar-percent">0%</div>
                                                </div><!-- end my-course-progress-bar-wrap -->
                                                <div
                                                    class="rating-wrap d-flex align-items-center justify-content-between pt-3">
                                                    <div class="review-stars">
                                                        <span class="la la-star-o"></span>
                                                        <span class="la la-star-o"></span>
                                                        <span class="la la-star-o"></span>
                                                        <span class="la la-star-o"></span>
                                                        <span class="la la-star-o"></span>
                                                    </div>
                                                    <a href="#"
                                                        class="btn theme-btn theme-btn-sm theme-btn-transparent"
                                                        data-toggle="modal" data-target="#ratingModal">Leave a rating</a>
                                                </div><!-- end rating-wrap -->
                                            </div><!-- end card-body -->
                                        </div><!-- end card -->
                                    </div><!-- end col-lg-4 -->
                                    <div class="col-lg-4 responsive-column-half">
                                        <div class="card card-item">
                                            <div class="card-image">
                                                <a href="lesson-details.html" class="d-block">
                                                    <img class="card-img-top lazy" src="images/img-loading.png"
                                                        data-src="images/img13.jpg" alt="Card image cap">
                                                    <div class="play-button">
                                                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" x="0px"
                                                            y="0px" viewBox="-307.4 338.8 91.8 91.8" xml:space="preserve">
                                                            <style type="text/css">
                                                                .st0 {
                                                                    opacity: 0.6;
                                                                    fill: #000000;
                                                                    border-radius: 100px;
                                                                }

                                                                .st1 {
                                                                    fill: #FFFFFF;
                                                                }
                                                            </style>
                                                            <g>
                                                                <circle class="st0" cx="-261.5" cy="384.7"
                                                                    r="45.9"></circle>
                                                                <path class="st1"
                                                                    d="M-272.9,363.2l35.8,20.7c0.7,0.4,0.7,1.3,0,1.7l-35.8,20.7c-0.7,0.4-1.5-0.1-1.5-0.9V364C-274.4,363.3-273.5,362.8-272.9,363.2z">
                                                                </path>
                                                            </g>
                                                        </svg>
                                                    </div>
                                                </a>
                                                <div class="course-badge-labels course--badge-labels">
                                                    <div
                                                        class="generic-action-wrap generic--action-wrap generic--action-wrap-2">
                                                        <div class="dropdown">
                                                            <a class="action-btn bg-white text-gray dropdown-btn"
                                                                href="#" role="button" id="allCourseMenuLinkSix"
                                                                data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                                <i class="la la-ellipsis-v"></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-wrap"
                                                                aria-labelledby="allCourseMenuLinkSix">
                                                                <h6 class="dropdown-header text-black">Collections</h6>
                                                                <a href="javascript:void(0)"
                                                                    class="dropdown-item collection-link d-flex align-items-center justify-content-between">
                                                                    <span>Javascript</span>
                                                                    <span class="la la-check collection-icon"></span>
                                                                </a>
                                                                <a href="javascript:void(0)"
                                                                    class="dropdown-item collection-link d-flex align-items-center justify-content-between">
                                                                    <span>Business</span>
                                                                    <span class="la la-check collection-icon"></span>
                                                                </a>
                                                                <div class="section-block my-2"></div>
                                                                <a href="javascript:void(0)"
                                                                    class="dropdown-item d-flex align-items-center justify-content-between"
                                                                    data-toggle="modal" data-target="#shareModal">
                                                                    <span>Share</span> <i class="ml-auto la la-share"></i>
                                                                </a>
                                                                <a href="javascript:void(0)"
                                                                    class="dropdown-item d-flex align-items-center justify-content-between"
                                                                    data-toggle="modal"
                                                                    data-target="#createNewCollectionModal">
                                                                    <span>Create New Collection</span> <i
                                                                        class="ml-auto la la-plus"></i>
                                                                </a>
                                                                <a href="javascript:void(0)"
                                                                    class="dropdown-item d-flex align-items-center justify-content-between">
                                                                    <span class="swapping-btn w-100"
                                                                        data-text-swap="Unfavorite"
                                                                        data-text-original="Favorite">Favorite</span>
                                                                    <i class="ml-auto la la-star"></i>
                                                                </a>
                                                                <a href="javascript:void(0)"
                                                                    class="dropdown-item d-flex align-items-center justify-content-between">
                                                                    <span class="swapping-btn w-100"
                                                                        data-text-swap="Archived"
                                                                        data-text-original="Archive">Archive</span>
                                                                    <i class="la la-archive"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- end card-image -->
                                            <div class="card-body">
                                                <h5 class="card-title"><a href="lesson-details.html">WordPress for
                                                        Beginners – Master WordPress</a></h5>
                                                <p class="card-text lh-22 pt-2"><a href="teacher-detail.html">Jose
                                                        Portilla</a><span>, Software Engineer and Developer</span></p>
                                                <div
                                                    class="my-course-progress-bar-wrap d-flex flex-wrap align-items-center mt-3 position-relative">
                                                    <p class="skillbar-title">Complete:</p>
                                                    <div class="skillbar-box">
                                                        <div class="skillbar skillbar-skillbar-2" data-percent="0%">
                                                            <div class="skillbar-bar skillbar--bar-2 bg-1"></div>
                                                        </div><!-- End Skill Bar -->
                                                    </div>
                                                    <div class="skill-bar-percent">0%</div>
                                                </div><!-- end my-course-progress-bar-wrap -->
                                                <div
                                                    class="rating-wrap d-flex align-items-center justify-content-between pt-3">
                                                    <div class="review-stars">
                                                        <span class="la la-star-o"></span>
                                                        <span class="la la-star-o"></span>
                                                        <span class="la la-star-o"></span>
                                                        <span class="la la-star-o"></span>
                                                        <span class="la la-star-o"></span>
                                                    </div>
                                                    <a href="#"
                                                        class="btn theme-btn theme-btn-sm theme-btn-transparent"
                                                        data-toggle="modal" data-target="#ratingModal">Leave a rating</a>
                                                </div><!-- end rating-wrap -->
                                            </div><!-- end card-body -->
                                        </div><!-- end card -->
                                    </div><!-- end col-lg-4 -->
                                </div><!-- end row -->
                                <div class="text-center pt-3">
                                    <nav aria-label="Page navigation example" class="pagination-box">
                                        <ul class="pagination justify-content-center">
                                            <li class="page-item">
                                                <a class="page-link" href="#" aria-label="Previous">
                                                    <span aria-hidden="true"><i class="la la-arrow-left"></i></span>
                                                    <span class="sr-only">Previous</span>
                                                </a>
                                            </li>
                                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                                            <li class="page-item">
                                                <a class="page-link" href="#" aria-label="Next">
                                                    <span aria-hidden="true"><i class="la la-arrow-right"></i></span>
                                                    <span class="sr-only">Next</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </nav>
                                    <p class="fs-14 pt-2">Showing 1-6 of 56 results</p>
                                </div>
                            </div><!-- end my-course-cards -->
                        </div><!-- end my-course-body -->
                    </div><!-- end tab-pane -->
                    <div class="tab-pane fade" id="collections" role="tabpanel" aria-labelledby="collections-tab">
                        <div class="my-course-body">
                            <div class="my-collection-item">
                                <div class="my-course-info pb-40px">
                                    <div class="d-flex align-items-center pb-2">
                                        <h3 class="fs-22 font-weight-semi-bold">Javascript</h3>
                                        <div class="my-course-info-action ml-2">
                                            <span class="la la-edit icon-element icon-element-xs cursor-pointer shadow-sm"
                                                data-toggle="modal" data-target="#editCollectionModal"
                                                title="Edit"></span>
                                            <span class="la la-trash icon-element icon-element-xs cursor-pointer shadow-sm"
                                                data-toggle="modal" data-target="#deleteModal" title="Delete"></span>
                                        </div>
                                    </div>
                                    <p>Leading the basics fundamentals</p>
                                </div><!-- end my-course-info -->
                                <div class="my-course-cards">
                                    <div class="row">
                                        <div class="col-lg-4 responsive-column-half">
                                            <div class="card card-item">
                                                <div class="card-image">
                                                    <a href="lesson-details.html" class="d-block">
                                                        <img class="card-img-top lazy" src="images/img-loading.png"
                                                            data-src="images/img8.jpg" alt="Card image cap">
                                                        <div class="play-button">
                                                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" x="0px"
                                                                y="0px" viewBox="-307.4 338.8 91.8 91.8"
                                                                xml:space="preserve">
                                                                <style type="text/css">
                                                                    .st0 {
                                                                        opacity: 0.6;
                                                                        fill: #000000;
                                                                        border-radius: 100px;
                                                                    }

                                                                    .st1 {
                                                                        fill: #FFFFFF;
                                                                    }
                                                                </style>
                                                                <g>
                                                                    <circle class="st0" cx="-261.5" cy="384.7"
                                                                        r="45.9"></circle>
                                                                    <path class="st1"
                                                                        d="M-272.9,363.2l35.8,20.7c0.7,0.4,0.7,1.3,0,1.7l-35.8,20.7c-0.7,0.4-1.5-0.1-1.5-0.9V364C-274.4,363.3-273.5,362.8-272.9,363.2z">
                                                                    </path>
                                                                </g>
                                                            </svg>
                                                        </div>
                                                    </a>
                                                    <div class="course-badge-labels course--badge-labels">
                                                        <div
                                                            class="generic-action-wrap generic--action-wrap generic--action-wrap-2">
                                                            <div class="dropdown">
                                                                <a class="action-btn bg-white text-gray dropdown-btn"
                                                                    href="#" role="button" id="collectionMenuLink"
                                                                    data-toggle="dropdown" aria-haspopup="true"
                                                                    aria-expanded="false">
                                                                    <i class="la la-ellipsis-v"></i>
                                                                </a>
                                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-wrap"
                                                                    aria-labelledby="collectionMenuLink">
                                                                    <a href="javascript:void(0)" class="dropdown-item">
                                                                        Remove from Collection
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- end card-image -->
                                                <div class="card-body">
                                                    <h5 class="card-title"><a href="lesson-details.html">The Complete
                                                            Full-Stack JavaScript Course!</a></h5>
                                                    <p class="card-text lh-22 pt-2"><a href="teacher-detail.html">Jose
                                                            Portilla</a><span>, Software Engineer and Developer</span></p>
                                                    <div
                                                        class="my-course-progress-bar-wrap d-flex flex-wrap align-items-center mt-3 position-relative">
                                                        <p class="skillbar-title">Complete:</p>
                                                        <div class="skillbar-box">
                                                            <div class="skillbar skillbar-skillbar-2" data-percent="70%">
                                                                <div class="skillbar-bar skillbar--bar-2 bg-1"></div>
                                                            </div><!-- End Skill Bar -->
                                                        </div>
                                                        <div class="skill-bar-percent">70%</div>
                                                    </div><!-- end my-course-progress-bar-wrap -->
                                                    <div
                                                        class="rating-wrap d-flex align-items-center justify-content-between pt-3">
                                                        <div class="review-stars">
                                                            <span class="la la-star-o"></span>
                                                            <span class="la la-star-o"></span>
                                                            <span class="la la-star-o"></span>
                                                            <span class="la la-star-o"></span>
                                                            <span class="la la-star-o"></span>
                                                        </div>
                                                        <a href="#"
                                                            class="btn theme-btn theme-btn-sm theme-btn-transparent"
                                                            data-toggle="modal" data-target="#ratingModal">Leave a
                                                            rating</a>
                                                    </div><!-- end rating-wrap -->
                                                </div><!-- end card-body -->
                                            </div><!-- end card -->
                                        </div><!-- end col-lg-4 -->
                                        <div class="col-lg-4 responsive-column-half">
                                            <div class="card card-item">
                                                <div class="card-image">
                                                    <a href="lesson-details.html" class="d-block">
                                                        <img class="card-img-top lazy" src="images/img-loading.png"
                                                            data-src="images/img9.jpg" alt="Card image cap">
                                                        <div class="play-button">
                                                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" x="0px"
                                                                y="0px" viewBox="-307.4 338.8 91.8 91.8"
                                                                xml:space="preserve">
                                                                <style type="text/css">
                                                                    .st0 {
                                                                        opacity: 0.6;
                                                                        fill: #000000;
                                                                        border-radius: 100px;
                                                                    }

                                                                    .st1 {
                                                                        fill: #FFFFFF;
                                                                    }
                                                                </style>
                                                                <g>
                                                                    <circle class="st0" cx="-261.5" cy="384.7"
                                                                        r="45.9"></circle>
                                                                    <path class="st1"
                                                                        d="M-272.9,363.2l35.8,20.7c0.7,0.4,0.7,1.3,0,1.7l-35.8,20.7c-0.7,0.4-1.5-0.1-1.5-0.9V364C-274.4,363.3-273.5,362.8-272.9,363.2z">
                                                                    </path>
                                                                </g>
                                                            </svg>
                                                        </div>
                                                    </a>
                                                    <div class="course-badge-labels course--badge-labels">
                                                        <div
                                                            class="generic-action-wrap generic--action-wrap generic--action-wrap-2">
                                                            <div class="dropdown">
                                                                <a class="action-btn bg-white text-gray dropdown-btn"
                                                                    href="#" role="button"
                                                                    id="collectionMenuLinkTwo" data-toggle="dropdown"
                                                                    aria-haspopup="true" aria-expanded="false">
                                                                    <i class="la la-ellipsis-v"></i>
                                                                </a>
                                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-wrap"
                                                                    aria-labelledby="collectionMenuLinkTwo">
                                                                    <a href="javascript:void(0)" class="dropdown-item">
                                                                        Remove from Collection
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- end card-image -->
                                                <div class="card-body">
                                                    <h5 class="card-title"><a href="lesson-details.html">Modern JavaScript
                                                            From The Beginning</a></h5>
                                                    <p class="card-text lh-22 pt-2"><a href="teacher-detail.html">Jose
                                                            Portilla</a><span>, Software Engineer and Developer</span></p>
                                                    <div
                                                        class="my-course-progress-bar-wrap d-flex flex-wrap align-items-center mt-3 position-relative">
                                                        <p class="skillbar-title">Complete:</p>
                                                        <div class="skillbar-box">
                                                            <div class="skillbar skillbar-skillbar-2" data-percent="0%">
                                                                <div class="skillbar-bar skillbar--bar-2 bg-1"></div>
                                                            </div><!-- End Skill Bar -->
                                                        </div>
                                                        <div class="skill-bar-percent">0%</div>
                                                    </div><!-- end my-course-progress-bar-wrap -->
                                                    <div
                                                        class="rating-wrap d-flex align-items-center justify-content-between pt-3">
                                                        <div class="review-stars">
                                                            <span class="la la-star-o"></span>
                                                            <span class="la la-star-o"></span>
                                                            <span class="la la-star-o"></span>
                                                            <span class="la la-star-o"></span>
                                                            <span class="la la-star-o"></span>
                                                        </div>
                                                        <a href="#"
                                                            class="btn theme-btn theme-btn-sm theme-btn-transparent"
                                                            data-toggle="modal" data-target="#ratingModal">Leave a
                                                            rating</a>
                                                    </div><!-- end rating-wrap -->
                                                </div><!-- end card-body -->
                                            </div><!-- end card -->
                                        </div><!-- end col-lg-4 -->
                                        <div class="col-lg-4 responsive-column-half">
                                            <div class="card card-item">
                                                <div class="card-image">
                                                    <a href="lesson-details.html" class="d-block">
                                                        <img class="card-img-top lazy" src="images/img-loading.png"
                                                            data-src="images/img10.jpg" alt="Card image cap">
                                                        <div class="play-button">
                                                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" x="0px"
                                                                y="0px" viewBox="-307.4 338.8 91.8 91.8"
                                                                xml:space="preserve">
                                                                <style type="text/css">
                                                                    .st0 {
                                                                        opacity: 0.6;
                                                                        fill: #000000;
                                                                        border-radius: 100px;
                                                                    }

                                                                    .st1 {
                                                                        fill: #FFFFFF;
                                                                    }
                                                                </style>
                                                                <g>
                                                                    <circle class="st0" cx="-261.5" cy="384.7"
                                                                        r="45.9"></circle>
                                                                    <path class="st1"
                                                                        d="M-272.9,363.2l35.8,20.7c0.7,0.4,0.7,1.3,0,1.7l-35.8,20.7c-0.7,0.4-1.5-0.1-1.5-0.9V364C-274.4,363.3-273.5,362.8-272.9,363.2z">
                                                                    </path>
                                                                </g>
                                                            </svg>
                                                        </div>
                                                    </a>
                                                    <div class="course-badge-labels course--badge-labels">
                                                        <div
                                                            class="generic-action-wrap generic--action-wrap generic--action-wrap-2">
                                                            <div class="dropdown">
                                                                <a class="action-btn bg-white text-gray dropdown-btn"
                                                                    href="#" role="button"
                                                                    id="collectionMenuLinkThree" data-toggle="dropdown"
                                                                    aria-haspopup="true" aria-expanded="false">
                                                                    <i class="la la-ellipsis-v"></i>
                                                                </a>
                                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-wrap"
                                                                    aria-labelledby="collectionMenuLinkThree">
                                                                    <a href="javascript:void(0)" class="dropdown-item">
                                                                        Remove from Collection
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- end card-image -->
                                                <div class="card-body">
                                                    <h5 class="card-title"><a href="lesson-details.html">The Complete
                                                            JavaScript Course 2020: Build Real Projects!</a></h5>
                                                    <p class="card-text lh-22 pt-2"><a href="teacher-detail.html">Jose
                                                            Portilla</a><span>, Software Engineer and Developer</span></p>
                                                    <div
                                                        class="my-course-progress-bar-wrap d-flex flex-wrap align-items-center mt-3 position-relative">
                                                        <p class="skillbar-title">Complete:</p>
                                                        <div class="skillbar-box">
                                                            <div class="skillbar skillbar-skillbar-2" data-percent="0%">
                                                                <div class="skillbar-bar skillbar--bar-2 bg-1"></div>
                                                            </div><!-- End Skill Bar -->
                                                        </div>
                                                        <div class="skill-bar-percent">0%</div>
                                                    </div><!-- end my-course-progress-bar-wrap -->
                                                    <div
                                                        class="rating-wrap d-flex align-items-center justify-content-between pt-3">
                                                        <div class="review-stars">
                                                            <span class="la la-star-o"></span>
                                                            <span class="la la-star-o"></span>
                                                            <span class="la la-star-o"></span>
                                                            <span class="la la-star-o"></span>
                                                            <span class="la la-star-o"></span>
                                                        </div>
                                                        <a href="#"
                                                            class="btn theme-btn theme-btn-sm theme-btn-transparent"
                                                            data-toggle="modal" data-target="#ratingModal">Leave a
                                                            rating</a>
                                                    </div><!-- end rating-wrap -->
                                                </div><!-- end card-body -->
                                            </div><!-- end card -->
                                        </div><!-- end col-lg-4 -->
                                    </div><!-- end row -->
                                </div><!-- end my-course-cards -->
                            </div><!-- end my-collection-item -->
                            <div class="my-collection-item">
                                <div class="my-course-info pb-40px">
                                    <div class="d-flex align-items-center pb-2">
                                        <h3 class="fs-22 font-weight-semi-bold">Business</h3>
                                        <div class="my-course-info-action ml-2">
                                            <span class="la la-edit icon-element icon-element-xs cursor-pointer shadow-sm"
                                                data-toggle="modal" data-target="#editCollectionModal"
                                                title="Edit"></span>
                                            <span class="la la-trash icon-element icon-element-xs cursor-pointer shadow-sm"
                                                data-toggle="modal" data-target="#deleteModal" title="Delete"></span>
                                        </div>
                                    </div>
                                    <p>Leading the basics fundamentals</p>
                                </div><!-- end my-course-info -->
                                <div class="my-course-cards">
                                    <div class="row">
                                        <div class="col-lg-4 responsive-column-half">
                                            <div class="card card-item">
                                                <div class="card-image">
                                                    <a href="lesson-details.html" class="d-block">
                                                        <img class="card-img-top lazy" src="images/img-loading.png"
                                                            data-src="images/img11.jpg" alt="Card image cap">
                                                        <div class="play-button">
                                                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" x="0px"
                                                                y="0px" viewBox="-307.4 338.8 91.8 91.8"
                                                                xml:space="preserve">
                                                                <style type="text/css">
                                                                    .st0 {
                                                                        opacity: 0.6;
                                                                        fill: #000000;
                                                                        border-radius: 100px;
                                                                    }

                                                                    .st1 {
                                                                        fill: #FFFFFF;
                                                                    }
                                                                </style>
                                                                <g>
                                                                    <circle class="st0" cx="-261.5" cy="384.7"
                                                                        r="45.9"></circle>
                                                                    <path class="st1"
                                                                        d="M-272.9,363.2l35.8,20.7c0.7,0.4,0.7,1.3,0,1.7l-35.8,20.7c-0.7,0.4-1.5-0.1-1.5-0.9V364C-274.4,363.3-273.5,362.8-272.9,363.2z">
                                                                    </path>
                                                                </g>
                                                            </svg>
                                                        </div>
                                                    </a>
                                                    <div class="course-badge-labels course--badge-labels">
                                                        <div
                                                            class="generic-action-wrap generic--action-wrap generic--action-wrap-2">
                                                            <div class="dropdown">
                                                                <a class="action-btn bg-white text-gray dropdown-btn"
                                                                    href="#" role="button"
                                                                    id="collectionMenuLinkFour" data-toggle="dropdown"
                                                                    aria-haspopup="true" aria-expanded="false">
                                                                    <i class="la la-ellipsis-v"></i>
                                                                </a>
                                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-wrap"
                                                                    aria-labelledby="collectionMenuLinkFour">
                                                                    <a href="javascript:void(0)" class="dropdown-item">
                                                                        Remove from Collection
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- end card-image -->
                                                <div class="card-body">
                                                    <h5 class="card-title"><a href="lesson-details.html">An Entire MBA in
                                                            1 Course:Award Winning Business School Prof</a></h5>
                                                    <p class="card-text lh-22 pt-2"><a href="teacher-detail.html">Jose
                                                            Portilla</a><span>, Software Engineer and Developer</span></p>
                                                    <div
                                                        class="my-course-progress-bar-wrap d-flex flex-wrap align-items-center mt-3 position-relative">
                                                        <p class="skillbar-title">Complete:</p>
                                                        <div class="skillbar-box">
                                                            <div class="skillbar skillbar-skillbar-2" data-percent="70%">
                                                                <div class="skillbar-bar skillbar--bar-2 bg-1"></div>
                                                            </div><!-- End Skill Bar -->
                                                        </div>
                                                        <div class="skill-bar-percent">70%</div>
                                                    </div><!-- end my-course-progress-bar-wrap -->
                                                    <div
                                                        class="rating-wrap d-flex align-items-center justify-content-between pt-3">
                                                        <div class="review-stars">
                                                            <span class="la la-star-o"></span>
                                                            <span class="la la-star-o"></span>
                                                            <span class="la la-star-o"></span>
                                                            <span class="la la-star-o"></span>
                                                            <span class="la la-star-o"></span>
                                                        </div>
                                                        <a href="#"
                                                            class="btn theme-btn theme-btn-sm theme-btn-transparent"
                                                            data-toggle="modal" data-target="#ratingModal">Leave a
                                                            rating</a>
                                                    </div><!-- end rating-wrap -->
                                                </div><!-- end card-body -->
                                            </div><!-- end card -->
                                        </div><!-- end col-lg-4 -->
                                        <div class="col-lg-4 responsive-column-half">
                                            <div class="card card-item">
                                                <div class="card-image">
                                                    <a href="lesson-details.html" class="d-block">
                                                        <img class="card-img-top lazy" src="images/img-loading.png"
                                                            data-src="images/img12.jpg" alt="Card image cap">
                                                        <div class="play-button">
                                                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" x="0px"
                                                                y="0px" viewBox="-307.4 338.8 91.8 91.8"
                                                                xml:space="preserve">
                                                                <style type="text/css">
                                                                    .st0 {
                                                                        opacity: 0.6;
                                                                        fill: #000000;
                                                                        border-radius: 100px;
                                                                    }

                                                                    .st1 {
                                                                        fill: #FFFFFF;
                                                                    }
                                                                </style>
                                                                <g>
                                                                    <circle class="st0" cx="-261.5" cy="384.7"
                                                                        r="45.9"></circle>
                                                                    <path class="st1"
                                                                        d="M-272.9,363.2l35.8,20.7c0.7,0.4,0.7,1.3,0,1.7l-35.8,20.7c-0.7,0.4-1.5-0.1-1.5-0.9V364C-274.4,363.3-273.5,362.8-272.9,363.2z">
                                                                    </path>
                                                                </g>
                                                            </svg>
                                                        </div>
                                                    </a>
                                                    <div class="course-badge-labels course--badge-labels">
                                                        <div
                                                            class="generic-action-wrap generic--action-wrap generic--action-wrap-2">
                                                            <div class="dropdown">
                                                                <a class="action-btn bg-white text-gray dropdown-btn"
                                                                    href="#" role="button"
                                                                    id="collectionMenuLinkFive" data-toggle="dropdown"
                                                                    aria-haspopup="true" aria-expanded="false">
                                                                    <i class="la la-ellipsis-v"></i>
                                                                </a>
                                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-wrap"
                                                                    aria-labelledby="collectionMenuLinkFive">
                                                                    <a href="javascript:void(0)" class="dropdown-item">
                                                                        Remove from Collection
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- end card-image -->
                                                <div class="card-body">
                                                    <h5 class="card-title"><a href="lesson-details.html">The Complete
                                                            Financial Analyst Course 2020</a></h5>
                                                    <p class="card-text lh-22 pt-2"><a href="teacher-detail.html">Jose
                                                            Portilla</a><span>, Software Engineer and Developer</span></p>
                                                    <div
                                                        class="my-course-progress-bar-wrap d-flex flex-wrap align-items-center mt-3 position-relative">
                                                        <p class="skillbar-title">Complete:</p>
                                                        <div class="skillbar-box">
                                                            <div class="skillbar skillbar-skillbar-2" data-percent="0%">
                                                                <div class="skillbar-bar skillbar--bar-2 bg-1"></div>
                                                            </div><!-- End Skill Bar -->
                                                        </div>
                                                        <div class="skill-bar-percent">0%</div>
                                                    </div><!-- end my-course-progress-bar-wrap -->
                                                    <div
                                                        class="rating-wrap d-flex align-items-center justify-content-between pt-3">
                                                        <div class="review-stars">
                                                            <span class="la la-star-o"></span>
                                                            <span class="la la-star-o"></span>
                                                            <span class="la la-star-o"></span>
                                                            <span class="la la-star-o"></span>
                                                            <span class="la la-star-o"></span>
                                                        </div>
                                                        <a href="#"
                                                            class="btn theme-btn theme-btn-sm theme-btn-transparent"
                                                            data-toggle="modal" data-target="#ratingModal">Leave a
                                                            rating</a>
                                                    </div><!-- end rating-wrap -->
                                                </div><!-- end card-body -->
                                            </div><!-- end card -->
                                        </div><!-- end col-lg-4 -->
                                        <div class="col-lg-4 responsive-column-half">
                                            <div class="card card-item">
                                                <div class="card-image">
                                                    <a href="lesson-details.html" class="d-block">
                                                        <img class="card-img-top lazy" src="images/img-loading.png"
                                                            data-src="images/img13.jpg" alt="Card image cap">
                                                        <div class="play-button">
                                                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                                                x="0px" y="0px" viewBox="-307.4 338.8 91.8 91.8"
                                                                xml:space="preserve">
                                                                <style type="text/css">
                                                                    .st0 {
                                                                        opacity: 0.6;
                                                                        fill: #000000;
                                                                        border-radius: 100px;
                                                                    }

                                                                    .st1 {
                                                                        fill: #FFFFFF;
                                                                    }
                                                                </style>
                                                                <g>
                                                                    <circle class="st0" cx="-261.5"
                                                                        cy="384.7" r="45.9"></circle>
                                                                    <path class="st1"
                                                                        d="M-272.9,363.2l35.8,20.7c0.7,0.4,0.7,1.3,0,1.7l-35.8,20.7c-0.7,0.4-1.5-0.1-1.5-0.9V364C-274.4,363.3-273.5,362.8-272.9,363.2z">
                                                                    </path>
                                                                </g>
                                                            </svg>
                                                        </div>
                                                    </a>
                                                    <div class="course-badge-labels course--badge-labels">
                                                        <div
                                                            class="generic-action-wrap generic--action-wrap generic--action-wrap-2">
                                                            <div class="dropdown">
                                                                <a class="action-btn bg-white text-gray dropdown-btn"
                                                                    href="#" role="button"
                                                                    id="collectionMenuLinkSix" data-toggle="dropdown"
                                                                    aria-haspopup="true" aria-expanded="false">
                                                                    <i class="la la-ellipsis-v"></i>
                                                                </a>
                                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-wrap"
                                                                    aria-labelledby="collectionMenuLinkSix">
                                                                    <a href="javascript:void(0)" class="dropdown-item">
                                                                        Remove from Collection
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- end card-image -->
                                                <div class="card-body">
                                                    <h5 class="card-title"><a href="lesson-details.html">Ninja Writing:
                                                            The Four Levels Of Writing Mastery</a></h5>
                                                    <p class="card-text lh-22 pt-2"><a href="teacher-detail.html">Jose
                                                            Portilla</a><span>, Software Engineer and Developer</span></p>
                                                    <div
                                                        class="my-course-progress-bar-wrap d-flex flex-wrap align-items-center mt-3 position-relative">
                                                        <p class="skillbar-title">Complete:</p>
                                                        <div class="skillbar-box">
                                                            <div class="skillbar skillbar-skillbar-2" data-percent="0%">
                                                                <div class="skillbar-bar skillbar--bar-2 bg-1"></div>
                                                            </div><!-- End Skill Bar -->
                                                        </div>
                                                        <div class="skill-bar-percent">0%</div>
                                                    </div><!-- end my-course-progress-bar-wrap -->
                                                    <div
                                                        class="rating-wrap d-flex align-items-center justify-content-between pt-3">
                                                        <div class="review-stars">
                                                            <span class="la la-star-o"></span>
                                                            <span class="la la-star-o"></span>
                                                            <span class="la la-star-o"></span>
                                                            <span class="la la-star-o"></span>
                                                            <span class="la la-star-o"></span>
                                                        </div>
                                                        <a href="#"
                                                            class="btn theme-btn theme-btn-sm theme-btn-transparent"
                                                            data-toggle="modal" data-target="#ratingModal">Leave a
                                                            rating</a>
                                                    </div><!-- end rating-wrap -->
                                                </div><!-- end card-body -->
                                            </div><!-- end card -->
                                        </div><!-- end col-lg-4 -->
                                    </div><!-- end row -->
                                </div><!-- end my-course-cards -->
                            </div><!-- end my-collection-item -->
                        </div><!-- end my-course-body -->
                    </div><!-- end tab-pane -->


                    <div class="tab-pane fade" id="wishlist" role="tabpanel" aria-labelledby="wishlist-tab">
                        <div class="my-course-body">
                            <div
                                class="my-course-info pb-40px d-flex flex-wrap align-items-center justify-content-between">
                                <h3 class="fs-22 font-weight-semi-bold">My wishlist</h3>
                                <form method="post">
                                    <div class="input-group">
                                        <input class="form-control form--control form--control-gray pl-3" type="text"
                                            name="search" placeholder="Search courses">
                                        <div class="input-group-append">
                                            <button class="btn theme-btn shadow-none"><i
                                                    class="la la-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div><!-- end my-course-info -->
                            <div class="my-course-cards">
                                <div class="row">
                                    @foreach ($wishlistedCourses as $course)
                                        <div class="col-lg-4 responsive-column-half">
                                            <div class="card card-item">
                                                <div class="card-image">
                                                    <a href="course-details.html" class="d-block">
                                                        <img class="card-img-top lazy" src="{{ asset($course->image) }}"
                                                            data-src="images/img8.jpg" alt="Card image cap">
                                                    </a>
                                                    <div class="course-badge-labels">
                                                        @if ($course->bestseller)
                                                            <div class="course-badge">Bestseller</div>
                                                        @endif
                                                        @if ($course->discount)
                                                            <div class="course-badge blue">-{{ $course->discount_percentage }}%</div>
                                                        @endif
                                                    </div>
                                                </div><!-- end card-image -->
                                                <div class="card-body">
                                                    <h6 class="ribbon ribbon-blue-bg fs-14 mb-3">{{ $course->level }}</h6>
                                                    <h5 class="card-title"><a href="course-details.html">{{ $course->title }}</a></h5>
                                                    <p class="card-text"><a href="teacher-detail.html">{{ $course->instructor->name }}</a>
                                                    </p>
                                                    <div class="rating-wrap d-flex align-items-center py-2">
                                                        <div class="review-stars">
                                                            <span class="rating-number">4.4</span>
                                                            <span class="la la-star"></span>
                                                            <span class="la la-star"></span>
                                                            <span class="la la-star"></span>
                                                            <span class="la la-star"></span>
                                                            <span class="la la-star-o"></span>
                                                        </div>
                                                        <span class="rating-total pl-1">(20,230)</span>
                                                    </div><!-- end rating-wrap -->
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        @if ($course->discount)
                                                            <p class="card-price text-black font-weight-bold">{{ $course->discount }}<span
                                                                    class="before-price font-weight-medium">{{ $course->price }}</span></p>
                                                        @else
                                                            <p class="card-price text-black font-weight-bold">12.99</p>
                                                        @endif
                                                        <div class="icon-element icon-element-sm shadow-sm cursor-pointer"
                                                            title="Remove from Wishlist"><i class="la la-heart"></i>
                                                        </div>
                                                    </div>
                                                </div><!-- end card-body -->
                                            </div><!-- end card -->
                                        </div><!-- end col-lg-4 -->
                                    @endforeach

                                </div><!-- end row -->
                            </div><!-- end my-course-cards -->
                        </div><!-- end my-course-body -->
                    </div><!-- end tab-pane -->

                    <div class="tab-pane fade" id="archived" role="tabpanel" aria-labelledby="archived-tab">
                        <div class="my-course-body">
                            <div class="my-course-info pb-40px">
                                <h3 class="fs-22 font-weight-semi-bold">My archives</h3>
                            </div><!-- end my-course-info -->
                            <div class="my-course-cards">
                                <div class="row">
                                    <div class="col-lg-4 responsive-column-half">
                                        <div class="card card-item">
                                            <div class="card-image">
                                                <a href="lesson-details.html" class="d-block">
                                                    <img class="card-img-top lazy" src="images/img-loading.png"
                                                        data-src="images/img8.jpg" alt="Card image cap">
                                                    <div class="play-button">
                                                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" x="0px"
                                                            y="0px" viewBox="-307.4 338.8 91.8 91.8"
                                                            xml:space="preserve">
                                                            <style type="text/css">
                                                                .st0 {
                                                                    opacity: 0.6;
                                                                    fill: #000000;
                                                                    border-radius: 100px;
                                                                }

                                                                .st1 {
                                                                    fill: #FFFFFF;
                                                                }
                                                            </style>
                                                            <g>
                                                                <circle class="st0" cx="-261.5" cy="384.7"
                                                                    r="45.9"></circle>
                                                                <path class="st1"
                                                                    d="M-272.9,363.2l35.8,20.7c0.7,0.4,0.7,1.3,0,1.7l-35.8,20.7c-0.7,0.4-1.5-0.1-1.5-0.9V364C-274.4,363.3-273.5,362.8-272.9,363.2z">
                                                                </path>
                                                            </g>
                                                        </svg>
                                                    </div>
                                                </a>
                                                <div class="course-badge-labels course--badge-labels">
                                                    <div
                                                        class="generic-action-wrap generic--action-wrap generic--action-wrap-2">
                                                        <div class="dropdown">
                                                            <a class="action-btn bg-white text-gray dropdown-btn"
                                                                href="#" role="button" id="archiveMenuLink"
                                                                data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                                <i class="la la-ellipsis-v"></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-wrap"
                                                                aria-labelledby="archiveMenuLink">
                                                                <a href="javascript:void(0)"
                                                                    class="dropdown-item d-flex align-items-center justify-content-between">
                                                                    <span>Unarchive</span>
                                                                    <i class="la la-archive"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- end card-image -->
                                            <div class="card-body">
                                                <h5 class="card-title"><a href="lesson-details.html">The Complete
                                                        Full-Stack JavaScript Course!</a></h5>
                                                <p class="card-text lh-22 pt-2"><a href="teacher-detail.html">Jose
                                                        Portilla</a><span>, Software Engineer and Developer</span></p>
                                                <div
                                                    class="my-course-progress-bar-wrap d-flex flex-wrap align-items-center mt-3 position-relative">
                                                    <p class="skillbar-title">Complete:</p>
                                                    <div class="skillbar-box">
                                                        <div class="skillbar skillbar-skillbar-2" data-percent="70%">
                                                            <div class="skillbar-bar skillbar--bar-2 bg-1"></div>
                                                        </div><!-- End Skill Bar -->
                                                    </div>
                                                    <div class="skill-bar-percent">70%</div>
                                                </div><!-- end my-course-progress-bar-wrap -->
                                                <div
                                                    class="rating-wrap d-flex align-items-center justify-content-between pt-3">
                                                    <div class="review-stars">
                                                        <span class="la la-star-o"></span>
                                                        <span class="la la-star-o"></span>
                                                        <span class="la la-star-o"></span>
                                                        <span class="la la-star-o"></span>
                                                        <span class="la la-star-o"></span>
                                                    </div>
                                                    <a href="#"
                                                        class="btn theme-btn theme-btn-sm theme-btn-transparent"
                                                        data-toggle="modal" data-target="#ratingModal">Leave a
                                                        rating</a>
                                                </div><!-- end rating-wrap -->
                                            </div><!-- end card-body -->
                                        </div><!-- end card -->
                                    </div><!-- end col-lg-4 -->
                                    <div class="col-lg-4 responsive-column-half">
                                        <div class="card card-item">
                                            <div class="card-image">
                                                <a href="lesson-details.html" class="d-block">
                                                    <img class="card-img-top lazy" src="images/img-loading.png"
                                                        data-src="images/img9.jpg" alt="Card image cap">
                                                    <div class="play-button">
                                                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" x="0px"
                                                            y="0px" viewBox="-307.4 338.8 91.8 91.8"
                                                            xml:space="preserve">
                                                            <style type="text/css">
                                                                .st0 {
                                                                    opacity: 0.6;
                                                                    fill: #000000;
                                                                    border-radius: 100px;
                                                                }

                                                                .st1 {
                                                                    fill: #FFFFFF;
                                                                }
                                                            </style>
                                                            <g>
                                                                <circle class="st0" cx="-261.5" cy="384.7"
                                                                    r="45.9"></circle>
                                                                <path class="st1"
                                                                    d="M-272.9,363.2l35.8,20.7c0.7,0.4,0.7,1.3,0,1.7l-35.8,20.7c-0.7,0.4-1.5-0.1-1.5-0.9V364C-274.4,363.3-273.5,362.8-272.9,363.2z">
                                                                </path>
                                                            </g>
                                                        </svg>
                                                    </div>
                                                </a>
                                                <div class="course-badge-labels course--badge-labels">
                                                    <div
                                                        class="generic-action-wrap generic--action-wrap generic--action-wrap-2">
                                                        <div class="dropdown">
                                                            <a class="action-btn bg-white text-gray dropdown-btn"
                                                                href="#" role="button" id="archiveMenuLinkTwo"
                                                                data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                                <i class="la la-ellipsis-v"></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-wrap"
                                                                aria-labelledby="archiveMenuLinkTwo">
                                                                <a href="javascript:void(0)"
                                                                    class="dropdown-item d-flex align-items-center justify-content-between">
                                                                    <span>Unarchive</span>
                                                                    <i class="la la-archive"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- end card-image -->
                                            <div class="card-body">
                                                <h5 class="card-title"><a href="lesson-details.html">Modern JavaScript
                                                        From The Beginning</a></h5>
                                                <p class="card-text lh-22 pt-2"><a href="teacher-detail.html">Jose
                                                        Portilla</a><span>, Software Engineer and Developer</span></p>
                                                <div
                                                    class="my-course-progress-bar-wrap d-flex flex-wrap align-items-center mt-3 position-relative">
                                                    <p class="skillbar-title">Complete:</p>
                                                    <div class="skillbar-box">
                                                        <div class="skillbar skillbar-skillbar-2" data-percent="0%">
                                                            <div class="skillbar-bar skillbar--bar-2 bg-1"></div>
                                                        </div><!-- End Skill Bar -->
                                                    </div>
                                                    <div class="skill-bar-percent">0%</div>
                                                </div><!-- end my-course-progress-bar-wrap -->
                                                <div
                                                    class="rating-wrap d-flex align-items-center justify-content-between pt-3">
                                                    <div class="review-stars">
                                                        <span class="la la-star-o"></span>
                                                        <span class="la la-star-o"></span>
                                                        <span class="la la-star-o"></span>
                                                        <span class="la la-star-o"></span>
                                                        <span class="la la-star-o"></span>
                                                    </div>
                                                    <a href="#"
                                                        class="btn theme-btn theme-btn-sm theme-btn-transparent"
                                                        data-toggle="modal" data-target="#ratingModal">Leave a
                                                        rating</a>
                                                </div><!-- end rating-wrap -->
                                            </div><!-- end card-body -->
                                        </div><!-- end card -->
                                    </div><!-- end col-lg-4 -->
                                    <div class="col-lg-4 responsive-column-half">
                                        <div class="card card-item">
                                            <div class="card-image">
                                                <a href="lesson-details.html" class="d-block">
                                                    <img class="card-img-top lazy" src="images/img-loading.png"
                                                        data-src="images/img10.jpg" alt="Card image cap">
                                                    <div class="play-button">
                                                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" x="0px"
                                                            y="0px" viewBox="-307.4 338.8 91.8 91.8"
                                                            xml:space="preserve">
                                                            <style type="text/css">
                                                                .st0 {
                                                                    opacity: 0.6;
                                                                    fill: #000000;
                                                                    border-radius: 100px;
                                                                }

                                                                .st1 {
                                                                    fill: #FFFFFF;
                                                                }
                                                            </style>
                                                            <g>
                                                                <circle class="st0" cx="-261.5" cy="384.7"
                                                                    r="45.9"></circle>
                                                                <path class="st1"
                                                                    d="M-272.9,363.2l35.8,20.7c0.7,0.4,0.7,1.3,0,1.7l-35.8,20.7c-0.7,0.4-1.5-0.1-1.5-0.9V364C-274.4,363.3-273.5,362.8-272.9,363.2z">
                                                                </path>
                                                            </g>
                                                        </svg>
                                                    </div>
                                                </a>
                                                <div class="course-badge-labels course--badge-labels">
                                                    <div
                                                        class="generic-action-wrap generic--action-wrap generic--action-wrap-2">
                                                        <div class="dropdown">
                                                            <a class="action-btn bg-white text-gray dropdown-btn"
                                                                href="#" role="button"
                                                                id="archiveMenuLinkThree" data-toggle="dropdown"
                                                                aria-haspopup="true" aria-expanded="false">
                                                                <i class="la la-ellipsis-v"></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-wrap"
                                                                aria-labelledby="archiveMenuLinkThree">
                                                                <a href="javascript:void(0)"
                                                                    class="dropdown-item d-flex align-items-center justify-content-between">
                                                                    <span>Unarchive</span>
                                                                    <i class="la la-archive"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- end card-image -->
                                            <div class="card-body">
                                                <h5 class="card-title"><a href="lesson-details.html">The Complete
                                                        JavaScript Course 2020: Build Real Projects!</a></h5>
                                                <p class="card-text lh-22 pt-2"><a href="teacher-detail.html">Jose
                                                        Portilla</a><span>, Software Engineer and Developer</span></p>
                                                <div
                                                    class="my-course-progress-bar-wrap d-flex flex-wrap align-items-center mt-3 position-relative">
                                                    <p class="skillbar-title">Complete:</p>
                                                    <div class="skillbar-box">
                                                        <div class="skillbar skillbar-skillbar-2" data-percent="0%">
                                                            <div class="skillbar-bar skillbar--bar-2 bg-1"></div>
                                                        </div><!-- End Skill Bar -->
                                                    </div>
                                                    <div class="skill-bar-percent">0%</div>
                                                </div><!-- end my-course-progress-bar-wrap -->
                                                <div
                                                    class="rating-wrap d-flex align-items-center justify-content-between pt-3">
                                                    <div class="review-stars">
                                                        <span class="la la-star-o"></span>
                                                        <span class="la la-star-o"></span>
                                                        <span class="la la-star-o"></span>
                                                        <span class="la la-star-o"></span>
                                                        <span class="la la-star-o"></span>
                                                    </div>
                                                    <a href="#"
                                                        class="btn theme-btn theme-btn-sm theme-btn-transparent"
                                                        data-toggle="modal" data-target="#ratingModal">Leave a
                                                        rating</a>
                                                </div><!-- end rating-wrap -->
                                            </div><!-- end card-body -->
                                        </div><!-- end card -->
                                    </div><!-- end col-lg-4 -->
                                </div><!-- end row -->
                            </div><!-- end my-course-cards -->
                        </div><!-- end my-course-body -->
                    </div><!-- end tab-pane -->
                </div><!-- end tab-content -->
            </div>
        </div><!-- end container -->
    </section><!-- end my-courses-area -->
    <!-- ================================
                       START MY COURSES
                ================================= -->

    <!--======================================
                        START CTA AREA
                ======================================-->
    <section class="cta-area py-5 bg-gray position-relative overflow-hidden">
        <span class="stroke-shape stroke-shape-1"></span>
        <span class="stroke-shape stroke-shape-2"></span>
        <span class="stroke-shape stroke-shape-3"></span>
        <span class="stroke-shape stroke-shape-4"></span>
        <span class="stroke-shape stroke-shape-5"></span>
        <span class="stroke-shape stroke-shape-6"></span>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="cta-content-wrap">
                        <h3 class="fs-20 font-weight-semi-bold lh-28">Top companies choose <a href="for-business.html"
                                class="text-color hover-underline">Aduca for Business</a> to build in-demand career
                            skills.</h3>
                    </div>
                </div><!-- end col-lg-6 -->
                <div class="col-lg-6">
                    <div class="client-logo-wrap text-right">
                        <a href="#" class="client-logo-item client--logo-item-2 pr-3"><img
                                src="images/sponsor-img.png" alt="brand image"></a>
                        <a href="#" class="client-logo-item client--logo-item-2 pr-3"><img
                                src="images/sponsor-img2.png" alt="brand image"></a>
                        <a href="#" class="client-logo-item client--logo-item-2 pr-3"><img
                                src="images/sponsor-img3.png" alt="brand image"></a>
                    </div><!-- end client-logo-wrap -->
                </div><!-- end col-lg-6 -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section><!-- end cta-area -->
    <!--======================================
                        END CTA AREA
                ======================================-->

@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('a[href="#wishlist"]').trigger('click');
            // $('#wishlist').addClass('active');
        });
    </script>
@endpush
