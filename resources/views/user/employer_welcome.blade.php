@extends('layouts.user_layout')
@section('title' , 'Home Page')
@section('content')
    <!--// Main Banner \\-->
    <div class="motivz-banner employers-banner" style="background-image: url('{{ asset('user/images/employer-banner-img.png') }}');">
        <div class="motivz-table">
            <div class="motivz-table-cell">
                <div class="container">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="motivz-banner-text">
                                <h1>You’ve come to <br>the <span>right place</span>.</h1>
                                <h2>Now it’s time to hire the right people!</h2>
                                <a href="#" class="simple-btn">Pricing Plans</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--// Main Banner \\-->

    <!--// Main Content \\-->
    <div class="motivz-main-content motivz-content-wrap" style="padding-bottom: 0px;">

        <!--// Main Section \\-->
        <div class="motivz-main-section motivz-pricing-contentfull">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="motivz-pricing-content">
                            <ul>
                                <li>
                                    <section class="price-section1">
                                        <span><i class="icon-Simplicity-is-key"></i></span>
                                        <h3>Simplicity is key</h3>
                                        <p>Experience a smooth hiring process starting with a user-friendly dashboard that is easy on the eyes, simple to navigate, and has all of the tools you need in one place.</p>
                                    </section>
                                </li>
                                <li class="right-sec">
                                    <section>
                                        <span><i class="icon-Maximum-exposure"></i></span>
                                        <h3>Maximum exposure</h3>
                                        <p>We go beyond our platform to reach candidates from all angles including our partnered job boards and various social media channels. Expect nothing less!</p>
                                    </section>
                                </li>
                                <li>
                                    <section class="price-section2">
                                        <span><i class="icon-Extra-Knowledge"></i></span>
                                        <h3>Extra knowledge helps!</h3>
                                        <p>Don’t just look at the resume. At MyMotivz, you can view pictures of applicants and learn more about their skills, interests, and everything in between.</p>
                                    </section>
                                </li>
                                <li class="right-sec">
                                    <section class="price-section3">
                                        <span><i class="icon-Start-the-dailog"></i></span>
                                        <h3>Start the dialog right away</h3>
                                        <p>Exchange messages with applicants using our instant chat technology just like any social media platforms. Schedule interviews or pre-screen your applicants on the spot!</p>
                                    </section>
                                </li>
                                <li class="left-sec">
                                    <section>
                                        <span><i class="icon-Bang-for-the-buck"></i></span>
                                        <h3>Bang for the buck</h3>
                                        <p>Posting a job should not cost you an arm and a leg. Expect competitive pricing with full transparency. Cancel or upgrade anytime!</p>
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
        <div class="motivz-main-section call-to-actionsfull">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="call-to-actions">
                            <h4>Need professional recruiting services? <br>We’ve got you covered.</h4>
                            <a href="#" class="call-to-action-btn">Learn More</a>
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
