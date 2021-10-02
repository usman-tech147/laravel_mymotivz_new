@extends('layouts.user_layout')
@section('title' , 'Home Page')
@section('content')
<!--// Main Banner \\-->
<div class="motivz-banner" style="background-image: url('{{ asset('user/images/banner-img.png') }}');">
    <div class="motivz-table">
        <div class="motivz-table-cell">
            <div class="container">
                <div class="row">
                    <div class="col-md-7">
                        <div class="motivz-banner-text">
                            <h1>Your <span>Career</span> <br>Starts Here</h1>
                            <p>We use advanced technology and industry insights to deliver innovative employment solutions for all.</p>
                            <form action="{{route('main.search.job')}}" method="POST" name="search_job" class="banner-form">
                                @csrf
                                <ul>
                                    <li>
                                        <input type="text" name="search_job_title" placeholder="Job tilte or keyword">
                                    </li>
                                    <li>
                                        <i class="icon-placeholder"></i>
                                        <input class="scnd-input" id="location"  name="search_place" type="text" placeholder="City or area">
                                    </li>
                                    <li><label><i class="icon-search"></i><input type="submit" value="Search Job"></label></li>
                                </ul>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--// Main Banner \\-->

<!--// Main Content \\-->
<div class="motivz-main-content motivz-content-wrap">

    <!--// Main Section \\-->
    <div class="motivz-main-section description-full fadeUp" data-t-show="2">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="description-title">
                        <h2>Whether you’re <br>an employer or job seeker </h2>
                    </div>
                    <div class="mm-description">
                        <p>We always strive to perfect our system and make your job search or hiring process as seamless and as intuitive as possible.</p>
                        <p>Our uncanny ability to match the right people to the right job is a result of combining human intelligence, big data, and sophisticated technology.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--// Main Section \\-->

    <!--// Main Section \\-->
    <div class="motivz-main-section connect-full">
        <div class="container">
            <div class="row">
                <div class="col-md-7 fadeLeft" data-t-show="3">
                    <figure class="connect-img"><figcaption><img src="{{ asset('user/images/connect-1.png') }}" alt=""> <img src="{{ asset('user/images/connect.png') }}" alt="" class="scond-img"></figcaption><span class="animation-dots"></span></figure>
                </div>
                <div class="col-md-5 fadeRight" data-t-show="3">
                    <div class="connect-text">
                        <h2>Connect with a Career Developer</h2>
                        <p>Waiting weeks for a response to a job application is a thing of the past. Our Career Developers understand that finding a job has a sense of urgency so they work expeditiously to help you find the right job that meets your requirements. Talk to our career developer to start your new career.</p>

                            <a class="simple-btn" href="{{route('view.career.develop')}}">Connect </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--// Main Section \\-->

    <!--// Main Section \\-->
    <div class="motivz-main-section industries-full">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="mm-main-title fadeIn" data-t-show="3">
                        <h2>The Industries We Serve</h2>
                        <p>Through the years, we have formed alliances with companies across the U.S. We always make good on our promise by finding the right candidate with the skill sets that align with the needs of specific industries. Using our innovative approach and technology, we can cast a wider net of candidates and present you with the best and the brightest talent. Fast! This process has fueled our success and operation across the following industries and more:</p>
                    </div>
                    <div class="mm-industries">
                        <ul>
                            <li class="zoomOut" data-t-show="3">
                                <section>
                                    <span class="hover1"><i class="icon-doctor"></i></span>
                                    <h2><a href="javascript:void(0)">Healthcare</a></h2>
                                </section>
                            </li>
                            <li class="zoomOut" data-t-show="3">
                                <section>
                                    <span><i class="icon-hoist"></i></span>
                                    <h2><a href="javascript:void(0)">Construction</a></h2>
                                </section>
                            </li>
                            <li class="zoomOut" data-t-show="3">
                                <section>
                                    <span><i class="icon-manufacturing"></i></span>
                                    <h2><a href="javascript:void(0)">Manufacturing</a></h2>
                                </section>
                            </li>
                            <li class="zoomOut" data-t-show="3">
                                <section>
                                    <span><i class="icon-budget"></i></span>
                                    <h2><a href="javascript:void(0)">Accounting & Finance</a></h2>
                                </section>
                            </li>
                            <li class="zoomOut" data-t-show="3">
                                <section>
                                    <span class="hover2"><i class="icon-growth"></i></span>
                                    <h2><a href="javascript:void(0)">Marketing</a></h2>
                                </section>
                            </li>
                            <li class="zoomOut" data-t-show="3">
                                <section>
                                    <span><i class="icon-manufacturing-a"></i></span>
                                    <h2><a href="javascript:void(0)">Supply Chain</a></h2>
                                </section>
                            </li>
                            <li class="zoomOut" data-t-show="3">
                                <section>
                                    <span><i class="icon-pharmaceutical"></i></span>
                                    <h2><a href="javascript:void(0)">Pharmaceutical & Biotech</a></h2>
                                </section>
                            </li>
                            <li class="zoomOut" data-t-show="3">
                                <section>
                                    <span><i class="icon-helmet"></i></span>
                                    <h2><a href="javascript:void(0)">Engineering</a></h2>
                                </section>
                            </li>
                            <li class="zoomOut" data-t-show="3">
                                <section>
                                    <span><i class="icon-patient"></i></span>
                                    <h2><a href="javascript:void(0)">Hospitality</a></h2>
                                </section>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--// Main Section \\-->

    <!--// Main Section \\-->
    <div class="motivz-main-section">
        <div class="fluid-container">
            <div class="row">
                <div class="col-md-12">
                    <div class="slide-wrapper">
                        <div class="images-slide"  style="border-radius: 0px 0px 0px 15px; overflow: hidden;">
                            <div class="layer" style="background-image: url('{{ asset('user/images/slide-images1.jpg') }}');"></div>
                            <div class="layer" style="background-image: url('{{ asset('user/images/slide-image1.jpg') }}');"></div>
                        </div>
                        <div class="images-slide2">
                            <div class="layer" style="background-image: url('{{ asset('user/images/slide-images2.jpg') }}');"></div>
                            <div class="layer" style="background-image: url('{{ asset('user/images/slide-image2.jpg') }}');"></div>
                        </div>
                        <div class="images-slide3">
                            <div class="layer" style="background-image: url('{{ asset('user/images/slide-images3.jpg') }}');"></div>
                            <div class="layer" style="background-image: url('{{ asset('user/images/slide-image3.jpg') }}');"></div>
                        </div>
                        <div class="images-slide4" style="border-radius: 0px 0px 15px 0px; overflow: hidden;">
                            <div class="layer" style="background-image: url('{{ asset('user/images/slide-images4.jpg') }}');"></div>
                            <div class="layer" style="background-image: url('{{ asset('user/images/slide-image4.jpg') }}');"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12 fadeUp" data-t-show="3">
                    <div class="mm-thriving">
                        <h2>Thriving By Transparency</h2>
                        <p>We maintain open communication with companies and qualified candidates. This kind of relationship allows us to build an extensive network of people from both sides of the business. Our platform is a friendly environment where partnerships can thrive. We have always been transparent about our hiring process. You can trust us to provide you with the best employment solution your company needs.</p>
                        <a href="{{route('user.recruiting.services')}}" class="simple-btn">Find Talent</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--// Main Section \\-->

</div>
<!--// Main Content \\-->
@endsection

@section('js')
    <script>




    </script>
@endsection
