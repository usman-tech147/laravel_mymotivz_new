@extends('layouts.user_layout')

@section('title' , 'About Us')

@section('content')
    <!--// Main Banner \\-->
    <div class="mm-subheader"><h1>About Us</h1></div>
    <!--// Main Banner \\-->
    <!--// Main Content \\-->
    <div class="motivz-main-content">

        <!--// Main Section \\-->
        <div class="motivz-main-section about-textfull">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <figure class="about-img"><img src="{{ asset('user/images/about-img1.jpg') }}" alt=""><img class="secnd-img" src="{{ asset('user/images/about-img.jpg') }}" alt=""></figure>
                    </div>
                    <div class="col-md-6">
                        <div class="about-text">
                            <p>In today’s competitive business landscape, getting the right people for the right job is crucial to a company’s success. We recognize that it’s not enough to just connect job seekers with companies and hope for the best. We wanted to be certain that the candidates we select are qualified for the job and their values align with the company’s culture. It’s a huge undertaking but we are equipped to rise to the challenge.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--// Main Section \\-->

        <!--// Main Section \\-->
        <div class="motivz-main-section mm-approachfull">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="mm-approach">
                            <h2>Our Approach</h2>
                            <ul>
                                <li>Our innovative approach has resulted in successful matches and solid partnerships. In the process, we have expanded our database and our networks across different sectors and industries. Top companies and brands trust us to carry out their recruitment tasks because they know that we have access to top professionals and highly-skilled potential hires.</li>
                                <li>We extend the same commitment and dedication to job seekers who use our platform. We give them the guidance and  the tools that they need to keep them on track to achieving their career aspirations. Sometimes all it takes is a gentle push to motivate them to pursue their dreams.</li>
                                <li>We continue to innovate our process to keep up with the ever-changing global workforce and staffing demand. Part of our commitment to serving you better is to upgrade the skills of our recruiters and career development specialists. They undergo training and development so that they are constantly improving and contributing to success. This ensures that we are always two steps ahead of our competitors.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--// Main Section \\-->

        <!--// Main Section \\-->
        <div class="motivz-main-section image-slide-full">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="mm-image-slide">
                            <div class="slide-layer" style="background-image: url('{{ asset('user/images/img-slide1.jpg') }}');"></div>
                            <div class="slide-layer" style="background-image: url('{{ asset('user/images/img-slide2.jpg') }}');"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--// Main Section \\-->

        <!--// Main Section \\-->
        <div class="motivz-main-section mm-core-valuefull">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="mm-core-value">
                            <h2>Our Core Values</h2>
                            <ul>
                                <li>
                                    <h3>Passion</h3>
                                    <p>Our clients are the lifeblood of our business. We understand that they are the focal point for us, and we strive daily to ensure that we develop the right skills and relationships to help them get the best talent to work with them.</p>
                                </li>
                                <li>
                                    <h3>Integrity</h3>
                                    <p>We believe in getting results. However, we also hold it in high regard to get results the right way. Our commitment to integrity includes being open and transparent with our clients and ensuring that we’re able to provide them with a clear picture of their project as we make progress.</p>
                                </li>
                                <li>
                                    <h3>Excellence</h3>
                                    <p>Excellence has always been a part of our DNA from the beginning. We strongly believe in having a hunger to get results and we are committed to doing just that regardless of the obstacles that could be before us.</p>
                                </li>
                                <li>
                                    <h3>Leadership</h3>
                                    <p>Company competence begins from the top, and it is important for a firm’s leadership to be strong in order to drive success and get the right results. As leaders, we are committed to tackling challenges with a positive and effective outlook, thus inspiring others to be better versions of themselves.</p>
                                </li>
                                <li>
                                    <h3>Teamwork</h3>
                                    <p>Every successful company is built on the collaborative effort of people who are committed to a common goal and are willing to give their all to achieve it. At MyMotivz, we have come to find that teamwork is the most significant factor that can make or break a company, and we are dedicated to enhancing that.</p>
                                </li>
                                <li>
                                    <h3>Innovation</h3>
                                    <p>Through innovation, we can find effective means of communication, networking, and recruitment. Our innovation includes finding the right talent for a company, sifting the wheat from the chaff, and providing companies with people who are the right fit for their operations.</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--// Main Section \\-->

        <!--// Main Section \\-->
        <div class="motivz-main-section caltoactionfull">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="caltoaction-wrap">
                            <div class="caltoaction-text">
                                <h2>What’s your Motivz?</h2>
                                <a href="{{route('user.recruiting.services')}}">Find Talent</a>
                                <a href="{{route('user.find.jobs')}}" style="background: transparent; color: #4d9a10;">Find Jobs</a>
                            </div>
                            <div class="caltoaction-img" style="background-image: url('{{ asset('user/images/caltoaction.jpg') }}');"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--// Main Section \\-->

    </div>
    <!--// Main Content \\-->
@endsection
