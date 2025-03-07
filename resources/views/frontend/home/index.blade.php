@extends('layouts.frontend.master')

@section('title', 'Home')

@section('content')
    <!--================================
                     START HERO AREA
            =================================-->
    @include('frontend.home.includes.hero')
    <!-- end hero-area -->
    <!--================================
                END HERO AREA
            =================================-->

    <!--======================================
                START FEATURE AREA
            ======================================-->
    @include('frontend.home.includes.feature')
    <!-- end feature-area -->
    <!--======================================
               END FEATURE AREA
            ======================================-->

    <!--======================================
                START CATEGORY AREA
            ======================================-->
    @include('frontend.home.includes.categories')
    <!-- end category-area -->
    <!--======================================
                END CATEGORY AREA
            ======================================-->

    <!--======================================
                START COURSE AREA
            ======================================-->
    @include('frontend.home.includes.courses')
    <!-- end courses-area -->
    <!--======================================
                END COURSE AREA
            ======================================-->

    <!-- ================================
               START FUNFACT AREA
            ================================= -->
    @include('frontend.home.includes.funfact')
    <!-- end funfact-area -->
    <!-- ================================
               START FUNFACT AREA
            ================================= -->

    <!--======================================
                START CTA AREA
            ======================================-->
    @include('frontend.home.includes.cta')
    <!-- end cta-area -->
    <!--======================================
                END CTA AREA
            ======================================-->

    <!--================================
                 START TESTIMONIAL AREA
            =================================-->
    @include('frontend.home.includes.testimonial')
    <!-- end testimonial-area -->
    <!--================================
                END TESTIMONIAL AREA
            =================================-->

    <div class="section-block"></div>

    <!--======================================
                START ABOUT AREA
            ======================================-->
    @include('frontend.home.includes.about')
    <!--======================================
                END ABOUT AREA
            ======================================-->

    <div class="section-block"></div>

    <!--======================================
                START REGISTER AREA
            ======================================-->
    @include('frontend.home.includes.register-area')
    
    <!-- end register-area -->
    <!--======================================
                END REGISTER AREA
            ======================================-->

    <div class="section-block"></div>

    <!-- ================================
               START CLIENT-LOGO AREA
            ================================= -->
    @include('frontend.home.includes.client-logo')
    <!-- end client-logo-area -->
    <!-- ================================
               START CLIENT-LOGO AREA
            ================================= -->

    <!-- ================================
               START BLOG AREA
            ================================= -->
    @include('frontend.home.includes.blog-area')
    <!-- end blog-area -->
    <!-- ================================
               START BLOG AREA
            ================================= -->

    <!--======================================
                START GET STARTED AREA
            ======================================-->
    @include('frontend.home.includes.get-started')
    <!-- end get-started-area -->
    <!-- ================================
               START GET STARTED AREA
            ================================= -->

    <!--======================================
                START SUBSCRIBER AREA
            ======================================-->
    @include('frontend.home.includes.subscriber-area')
    <!-- end subscriber-area -->
    <!--======================================
                END SUBSCRIBER AREA
            ======================================-->
@endsection
