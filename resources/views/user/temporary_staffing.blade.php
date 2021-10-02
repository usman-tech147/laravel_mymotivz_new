@extends('layouts.user_layout')
@section('title' , 'Temporary Staffing')

@section('content')
    <!--// Main Banner \\-->
    <div class="mm-subheader"><h1>Temporary Staffing</h1></div>
    <!--// Main Banner \\-->

    <!--// Main Content \\-->
    <div class="motivz-main-content">

        <!--// Main Section \\-->
        <div class="motivz-main-section temporary-staffingfull">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="temporary-staffing-text">
                            <h2>Temporary Staffing Services: <br> Short-term & Long-term Employment</h2>
                            <p>With our temporary staffing services, you have the flexibility to  increase your staff to meet the workforce requirements of your short-term and long-term projects. Temporary staffing is a great option if you’re working with one-off projects and don’t want to increase your overhead costs. You gain unlimited access to talents who can fulfill the required workload at any given time. Our fast turnaround ensures that you can fill job vacancies quicker and have more time for orientation and training. <a href="{{route('contact')}}">Contact us today!</a></p>
                            <p>If your company needs permanent and full-time employees, we’ll make sure that we find candidates with the right skills, work experience, cultural fit, and attitude to take the company to the next level. We not only focus on matching qualifications with job requirements, but we also look for qualified people who’ll stay for the long haul and help the company achieve its goals.</p>
                            <p>When you submit a job order, you will receive a list of candidates whose qualifications align precisely with your job requirements. This service is 100% free and you will not be charged to review applications and interview candidates.</p>
                            <p>We're committed to giving you the best recruitment solution to fit your hiring needs. We are confident that our recruitment process and hiring recommendations will exceed your expectations.</p>
                        </div>
                        <div class="talent-list-form">
                            @include('user.include.company_register_form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--// Main Section \\-->

        <!--// Main Section \\-->
        <div class="motivz-main-section free-hiringfull">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="motivz-placement-text">
                            <h3>Worry-Free Hiring</h3>
                            <p>Leave the heavy lifting to us. We take the stress of the whole recruitment and onboarding process away from you so that you can focus on your core activities. Sit back and relax as we do the work in the following areas:</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <figure class="free-hiring"><img src="{{ asset('user/images/free-hiring-img.jpg') }}" alt=""><img class="secnd-img" src="{{ asset('user/images/free-hiring-img1.jpg') }}" alt=""></figure>
                    </div>
                    <div class="col-md-6">
                        <div class="free-hiring-list">
                            <ul>
                                <li>
                                    <i class="icon-briefcase"></i>
                                    <h2>Recruitment</h2>
                                    <p>From sourcing to screening to interviewing to hiring, we got it covered.</p>
                                </li>
                                <li>
                                    <i class="icon-search2"></i>
                                    <h2>Background Check </h2>
                                    <p>Your safety and security matter to us. We implement extensive background checks on shortlisted candidates and those who come in contact with your company through our agency. This is to ensure that you’re aware of any criminal records of potential hires.</p>
                                </li>
                                <li>
                                    <i class="icon-injection"></i>
                                    <h2>Drug Screen</h2>
                                    <p>We follow strict professional standards. All staff undergoes a thorough drug screening process before they can perform any service. This is to prevent irresponsible behavior or conduct unbecoming of a professional.</p>
                                </li>
                                <li>
                                    <i class="icon-payroll"></i>
                                    <h2>Payroll </h2>
                                    <p>We partnered with a leading payroll service provider to ensure that staffing professionals are paid accurately and timely.</p>
                                </li>
                                <li>
                                    <i class="icon-insurance"></i>
                                    <h2>Insurance</h2>
                                    <p>We cover 100% of Workers Compensation & Comprehensive General Liability to ensure that all staff is protected from risks.</p>
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
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="motivz-placement-text">
                            <h3>Same Commitment and Dedication</h3>
                            <p>Whether our recruiters are fulfilling direct placement services or working on filling temporary staffing needs of our clients, they extend the same focus, commitment, and dedication. Our excellent work ethic remains strong no matter what stage of the recruitment process we’re in.</p>
                            <p>We are committed to selecting the best candidates to match your staffing requirements. Our unrivaled local network of professionals guarantees that we can find the right person who can handle the position with integrity and expertise. It doesn’t matter if you’re looking for project-based hires, time-sensitive recruitment, seasonal and transitional hiring, staff augmentation, or long-term employees, we can handle it! Contact us today!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--// Main Section \\-->

    </div>
    <!--// Main Content \\-->
@endsection

@section('script')
    <script src='https://www.google.com/recaptcha/api.js' async defer></script>
    <script type="text/javascript" src="{{ asset('user/script/company/companyRegister.js') }}"></script>
@endsection