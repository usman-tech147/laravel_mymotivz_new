@extends('layouts.user_layout')

@section('title' , 'Direct Placement')

@section('content')
    <!--// Main Banner \\-->
    <div class="mm-subheader"><h1>Direct Placement</h1></div>
    <!--// Main Banner \\-->

    <!--// Main Content \\-->
    <div class="motivz-main-content">

        <!--// Main Section \\-->
        <div class="motivz-main-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="motivz-placement-text">
                            <h2>What is Direct Placement?</h2>
                            <p>Direct Placement service covers the entire recruitment process from start to finish—job posting, reviewing resumes, filtering applications, pre-screening candidates, skills testing, preliminary interviews, and other recruiting tasks you may require.</p>
                            <p>If your company needs permanent and full-time employees, we’ll make sure that we find candidates with the right skills, work experience, cultural fit, and attitude to take the company to the next level. We not only focus on matching qualifications with job requirements, but we also look for qualified people who’ll stay for the long haul and help the company achieve its goals.</p>
                            <p>When you submit a job order, you will receive a list of candidates whose qualifications align precisely with your job requirements. This service is 100% free and you will not be charged to review applications and interview candidates.</p>
                            <p>We're committed to giving you the best recruitment solution to fit your hiring needs. We are confident that our recruitment process and hiring recommendations will exceed your expectations.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--// Main Section \\-->

        <!--// Main Section \\-->
        <div class="motivz-main-section motivz-liststylefull">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="motivz-liststyle">
                            <ul>
                                <li><i class="icon-cancel"></i>100% Free to Interview Candidates</li>
                                <li><i class="icon-recruitment"></i>100% Free to Review Resumes and Applications</li>
                                <li><i class="icon-a1"></i>Get Quality Resumes within 72 hours or less</li>
                                <li><i class="icon-clock"></i>Get Fast and Unparalleled Results</li>
                                <li><i class="icon-budget-c"></i>Cost-Efficient and Flexible Rates</li>
                                <li><i class="icon-deal"></i>Stress-Free and Hassle-Free Hiring Process</li>
                            </ul>
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
        <div class="motivz-main-section satisfaction-textfull">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="motivz-table">
                            <div class="motivz-table-cell">
                                <div class="satisfaction-text">
                                    <h2>Perfection Meets Satisfaction</h2>
                                    <p>We take recruitment seriously and our professionalism, discretion, and thoroughness are unmatched. Your satisfaction is our number one priority so we strive to perfect our hiring process so that we can deliver your desired outcomes every single time.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <figure class="satisfaction-img"><img src="{{ asset('user/images/direct-img.jpg') }}" alt=""><img class="secnd-img" src="{{ asset('user/images/direct-img1.jpg') }}" alt=""></figure>
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
                            <h3>Networks, Tools, and Strategic Approach</h3>
                            <p>Our national network of candidates is one of the most comprehensive in the industry. With the sophisticated technology, market intelligence, and deep industry knowledge, we are able to access potential hires who are best suited to take on the challenge.</p>
                            <p>We are equipped with smart tools and advanced technology to sift through resumes and evaluate candidates based on key factors that align with your company’s needs. We follow a strategic approach that enables us to select the most suitable candidates for the job. Our unparalleled communications system allows us to expeditiously pre-screen and pre-qualify applicants for a faster and more efficient hiring process.</p>
                            <p>With our proven track record as a direct-hire recruiter, we can confidently bring you highly-prized candidates whose talents can deliver economic value to the company and contribute immensely to the company’s growth.</p>
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