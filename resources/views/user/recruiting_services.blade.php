@extends('layouts.user_layout')
@section('title' , 'Recruiting Services')

@section('content')

    <!--// Main Banner \\-->
    <div class="mm-subheader"><h1>Recruiting Services</h1></div>
    <!--// Main Banner \\-->

    <!--// Main Content \\-->
    <div class="motivz-main-content">

        <!--// Main Section \\-->
        <div class="motivz-main-section service-textfull">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="service-heading">Recruiting Services <br> – Putting the Right People in the Right Jobs</h2>
                    </div>
                    <div class="col-md-6">
                        <figure class="service-img"><img src="{{ asset('user/images/serviceimg1.jpg') }}" alt=""><img class="secnd-img" src="{{ asset('user/images/serviceimg.jpg') }}" alt=""></figure>
                    </div>
                    <div class="col-md-6">
                        <div class="service-text">
                            <p>Behind every successful company is a team of competent people who have the right skills to get the job done. But the reality is that companies don’t always get the right talent that they need because of poor job matching. When individuals are not suitable for the job, it can hamper a company’s growth and development down the road.</p>
                            <p>If your company’s recruitment process is simply sifting through countless resumes from expensive job boards, you are just wasting time and money. With our recruitment services, you have a better chance of recruiting not just the best and the brightest, but the most suitable candidates for the job. Spend less time on applicants who are a poor fit and focus on candidates that tick all the right boxes.</p>
                            <p>Our stringent screening process and our large network of candidates from various industries put us in the best position to recruit the most suitable applicants that meet your specific qualification criteria.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--// Main Section \\-->

        <!--// Main Section \\-->
        <div class="motivz-main-section mm-workfull">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="work-text">
                            <h2>A Recruitment Technology That Works</h2>
                            <p>Technology has made it possible to improve our recruiting and talent acquisition process. Through the use of artificial intelligence (AI), we are able to process more data and gain better insight into the suitability of candidates. We are also able to automate functions to speed up the screening process.</p>
                            <p>Combining human analytical skills and sophisticated algorithms enables us to tap into multiple data sources to deliver results. Our advanced AI technology empowers us to provide effective recruiting solutions that defy the norm:</p>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="work-list">
                            <ul>
                                <li><i class="icon-search1"></i> We deliver faster results than our competitors</li>
                                <li><i class="icon-reach"></i> We can reach candidates beyond our database which includes all social media platforms</li>
                                <li><i class="icon-location1"></i> We can track our candidates movement and match them with your job openings</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--// Main Section \\-->

        <!--// Main Section \\-->
        <div class="motivz-main-section areas-expertisefull">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="areas-expertise">
                            <h2>Our Areas of Expertise</h2>
                            <ul>
                                <li>Healthcare</li>
                                <li>Manufacturing </li>
                                <li>Construction</li>
                                <li>Accounting & Finance </li>
                                <li>Sales & Marketing </li>
                                <li>Supply Chain</li>
                                <li>Pharmaceutical & Biotech </li>
                                <li>Hospitality</li>
                                <li>Engineering</li>
                            </ul>
                        </div>
                        <div class="talent-list-form talent-list-formmargin">
                            @include('user.include.company_register_form')
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