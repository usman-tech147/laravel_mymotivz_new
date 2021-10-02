@extends('layouts.user_layout')
@section('title' , 'Pricing Plan')
@section('content')
    <div class="mm-subheader"><h1>Pricing Plans</h1></div>

    <!--// Main Content \\-->
    <div class="motivz-main-content">

        <!--// Main Section \\-->
        <div class="motivz-main-section pricing-table-full">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="pricing-title">
                            <h2>Your New Hire is Just Around the Corner</h2>
                            <h4>Select a package that works best for your hiring needs</h4>
                        </div>
                        <div class="price-plans">
                            <ul class="row">
                                <li class="col-md-4">
                                    <div class="price-plan-text">
                                        <section>
                                            <h3>One N Done</h3>
                                            <h4>$170<small>/mo</small></h4>
                                            <ul class="pricing-list">
                                                <li>1 Active Job</li>
                                                <li>Unlimited Applicants</li>
                                                <li>“MM” Traffic Booster</li>
                                                <li>Instant Email Alerts</li>
                                                <li>Dashboard Access & Hiring Tools</li>
                                                <li>Customer Support</li>
                                            </ul>
                                            <a href="#" class="priicing-btn">PURCHASE</a>
                                        </section>
                                    </div>
                                </li>
                                <li class="col-md-4">
                                    <div class="price-plan-text active">
                                        <section>
                                            <h3>Team Essential <span>(MOST POPULAR)</span></h3>
                                            <h4>$330<small>/mo</small></h4>
                                            <ul class="pricing-list">
                                                <li>4 Active Jobs</li>
                                                <li>Unlimited Applicants</li>
                                                <li>“MM” Traffic Booster</li>
                                                <li>Instant Email Alerts</li>
                                                <li>Dashboard Access & Hiring Tools</li>
                                                <li>+Add Team Members</li>
                                                <li>Customer Support</li>
                                            </ul>
                                            <a href="#" class="priicing-btn">PURCHASE</a>
                                        </section>
                                    </div>
                                </li>
                                <li class="col-md-4">
                                    <div class="price-plan-text">
                                        <section>
                                            <h3>The Department</h3>
                                            <h4>$600<small>/mo</small></h4>
                                            <ul class="pricing-list">
                                                <li>10 Active Jobs</li>
                                                <li>Unlimited Applicants</li>
                                                <li>“MM” Traffic Booster</li>
                                                <li>Instant Email Alerts</li>
                                                <li>Dashboard Access & Hiring Tools</li>
                                                <li>+Add Team Members</li>
                                                <li>Customer Support</li>
                                            </ul>
                                            <a href="#" class="priicing-btn">PURCHASE</a>
                                        </section>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--// Main Section \\-->

        <!--// Main Section \\-->
        <div class="motivz-main-section pricing-aboutfull">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <figure class="about-img"><img src="{{ asset('user/images/about-img1.jpg') }}" alt=""><img class="secnd-img" src="{{ asset('user/images/about-img.jpg') }}" alt=""></figure>
                    </div>
                    <div class="col-md-6">
                        <div class="about-text pricing-about">
                            <h2>NEED TO POST MORE THAN 10 JOBS? WE’VE GOT YOU COVERED</h2>
                            <p>Our Next Level package is tailored to your company needs which includes all feature for a unique low cost.</p>
                            <a href="/contact" class="simple-btn">CONTACT US FOR PRICING</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--// Main Section \\-->

        <!--// Main Section \\-->
        <div class="motivz-main-section call-to-actionfull">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="call-to-action">
                            <h4>NO COMMITMENT</h4>
                            <p>Cancel anytime with absolutely no strings attached. All jobs will remain active until the end of the 30-day period.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--// Main Section \\-->

        <!--// Main Section \\-->
        <div class="motivz-main-section notsure-section-full">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="motivz-table">
                            <div class="motivz-table-cell">
                                <div class="about-text pricing-about">
                                    <h2>STILL NOT SURE?</h2>
                                    <p>No problem. You have questions and we have answers. Contact us today for further assistance.</p>
                                    <a href="/contact" class="simple-btn">LET’S TALK</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <figure class="career-development-img" style="margin: 0px;"><img
                                src="{{asset('user/images/career-development-img1.jpg')}}" alt=""><img
                                class="secnd-img" src="{{asset('user/images/career-development-img.jpg')}}" alt="">
                        </figure>
                    </div>
                </div>
            </div>
        </div>
        <!--// Main Section \\-->

    </div>
    <!--// Main Content \\-->
@endsection

@section('js')

@endsection
