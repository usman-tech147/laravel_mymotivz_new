<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>MyMotivz | @yield('title')</title>

    <!-- Css Files -->
    <link rel="shortcut icon" href="{{ asset('user/images/favicon.png') }}" type="image/png" />
    <link href="{{ asset('user/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('user/css/slick-slider.css') }}" rel="stylesheet">
    <link href="{{ asset('user/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('user/css/t-scroll.min.css') }}" rel="stylesheet">
    <link href="{{asset('user/css/file-input/fileinput.css')}}" media="all" rel="stylesheet" type="text/css"/>
    <link href="{{asset('user/css/file-input/theme.css')}}" media="all" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('user/style.css') }}" rel="stylesheet">
    <link href="{{ asset('user/css/responsive.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('/css/bootstrap-tagsinput.css')}}">

</head>
<body>

<!--// Main Wrapper \\-->
<div class="motivz-main-wrapper">

    <!--// Header \\-->
    <header id="motivz-header" class="motivz-header-one">
        <div class="container">
            <div class="row">
                <div class="col-md-2"><a href="{{ route('welcome') }}" class="logo"><img src="{{ asset('user/images/logo.png') }}" alt=""></a></div>
                <div class="col-md-10">
                    <div class="mymotivz-nav">
                        <nav class="navbar navbar-expand-lg">
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="fa fa-bars"></span>
                            </button>

                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav mr-auto">
                                    @if(session()->has('c_email'))
                                        <li class="nav-item">
                                            <a class="nav-link drop1" href="javascript:void(0)">Employers</a>
                                            <ul class="mm-dropdown" id="drop1">
                                                <li><a href="{{ route('user.recruiting.services') }}">Recruiting Services </a></li>
                                                <li><a href="{{ route('user.direct.placement') }}">Direct Placement </a></li>
                                                <li><a href="{{ route('user.temporary.staffing') }}">Temporary Staffing </a></li>
                                                <li><a href="{{ route('user.industry.insights') }}">Industry Insights </a></li>
                                                <li><a href="{{ route('user.client.dashboard') }}">Create Company Profile </a></li>
                                            </ul>
                                        </li>
                                    @elseif(session()->has('candidate_id'))
{{--                                    @if( !session()->has('c_email') && !session()->has('email'))--}}
                                        <li class="nav-item">
                                            <a class="nav-link drop2" href="javascript:void(0)">Job Seekers</a>
                                            <ul class="mm-dropdown" id="drop2">
                                                <li><a href="{{ route('user.find.jobs') }}">Find Jobs </a></li>
                                                <li><a href="{{route('view.career.develop')}}">Career Development </a></li>
                                                <li><a href="{{route('user.career.resources')}}">Career Resources </a></li>
                                                <li><a href="{{route('candidate.dashboard')}}">Upload Resume </a></li>
                                                @if(session()->has('c_email'))
                                                    <li><a href="{{route('user.client.dashboard')}}">Create Profile </a></li>
                                                @elseif(session()->has('email'))
                                                    <li><a href="{{route('candidate.dashboard')}}">Create Profile </a></li>
                                                @else
                                                    <li><a href="{{route('user.login')}}">Create Profile </a></li>
                                                @endif
                                            </ul>
                                        </li>
                                    @else
                                        <li class="nav-item">
                                            <a class="nav-link drop1" href="javascript:void(0)">Employers</a>
                                            <ul class="mm-dropdown" id="drop1">
                                                <li><a href="{{ route('user.recruiting.services') }}">Recruiting Services </a></li>
                                                <li><a href="{{ route('user.direct.placement') }}">Direct Placement </a></li>
                                                <li><a href="{{ route('user.temporary.staffing') }}">Temporary Staffing </a></li>
                                                <li><a href="{{ route('user.industry.insights') }}">Industry Insights </a></li>
                                                <li><a href="{{ route('user.signUp.company') }}">Create Company Profile </a></li>
                                            </ul>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link drop2" href="javascript:void(0)">Job Seekers</a>
                                            <ul class="mm-dropdown" id="drop2">
                                                <li><a href="{{ route('user.find.jobs') }}">Find Jobs </a></li>
                                                <li><a href="{{route('view.career.develop')}}">Career Development </a></li>
                                                <li><a href="{{route('user.career.resources')}}">Career Resources </a></li>
                                                <li><a href="{{route('candidate.dashboard')}}">Upload Resume </a></li>
                                                <li><a href="{{route('user.register')}}">Create Profile </a></li>
                                            </ul>
                                        </li>
                                    @endif
{{--                                    @endif--}}
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('about.us') }}">About Us</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('contact') }}">Contact</a>
                                    </li>

                                    @if( session()->has('email') || session()->has('c_email') )
                                    <li class="nav-item dropdown userdshoard dis-none">
                                        <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            @if(Session::has('cand_prof_img'))
                                                <img id="header_prof_img" src="@if(Session::has('cand_prof_img')){{ asset('/uploads/Candidate_Profile_Images/'.Session('cand_prof_img')) }} @else {{ asset('/user/images/avatar.png') }} @endif" alt=""> @if (Session::has('candidate_name')){{session()->get('candidate_name')}} @else User @endif
                                            @elseif(Session::has('c_email.logo'))
                                                <img id="header_prof_img" src="@if(Session::has('c_email.logo')){{ asset('user/company_logo/'.Session('c_email.logo') )  }} @else {{ asset('/user/images/avatar.png') }} @endif" alt=""> @if (Session::has('c_email.name')){{session()->get('c_email.name')}} @else Company @endif

                                            @endif
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                          <a class="dropdown-item" href="{{route('candidate.dashboard')}}">Dashboard</a>
                                          <div class="dropdown-divider"></div>
                                          <a class="dropdown-item" href="{{ route('user.logout') }}">Logout</a>
                                        </div>
                                      </li>
                                        @else
                                        <li class="nav-item dis-none">
                                            <a class="nav-link" href="{{ route('user.login') }}">Login</a>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </nav>
                    </div>

                    @if( session()->has('email') || session()->has('c_email') )
                        <div class="nav-item dropdown userdshoard dis-block">
                            <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                @if(Session::has('cand_prof_img'))
                                    <img id="header_prof_img" src="@if(Session::has('cand_prof_img')){{ asset('/uploads/Candidate_Profile_Images/'.Session('cand_prof_img')) }} @else {{ asset('/user/images/avatar.png') }} @endif" alt=""> @if (Session::has('candidate_name')){{session()->get('candidate_name')}} @else User @endif
                                @elseif(Session::has('c_email.logo'))
                                    <img id="header_prof_img" src="@if(Session::has('c_email.logo')){{ asset('user/company_logo/'.Session('c_email.logo') )  }} @else {{ asset('/user/images/avatar.png') }} @endif" alt=""> @if (Session::has('c_email.name')){{session()->get('c_email.name')}} @else Company @endif

                                @endif                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                                @if(Session::has('candidate_id'))
                                    <a class="dropdown-item" href="{{route('candidate.dashboard')}}">Dashboard</a>
                                @elseif(Session::has('c_email'))
                                    <a class="dropdown-item" href="{{route('user.client.dashboard')}}">Dashboard</a>

                                @endif
                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item" href="{{ route('user.logout') }}">Logout</a>
                            </div>
                          </div>
                     @else
                        <a href="{{ route('user.login') }}" class="header-btn dis-block">Login</a>
                    @endif
                </div>
            </div>
        </div>
    </header>
    <!--// Header \\-->
    <!--// Main Section \\-->
    <div class="mm-subheader"><h1>Profile Settings</h1></div>
    <div class="motivz-main-content">
        <div class="motivz-main-section">
        <div class="container">
            @if(Session::has('updated'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{Session::get('updated')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if(Session::has('deleted'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{Session::get('deleted')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="row">
               <div class="col-md-3">
    <div class="job-typo-wrap">
        <div class="job-employer-dashboard-nav">
            <figure>
                 <a href="#" class="employer-dashboard-thumb"><img src="@if(Session::has('c_email.logo')){{ asset('user/company_logo/'.Session('c_email.logo') )  }} @else {{ asset('/user/images/featured-img1.jpg') }} @endif" alt=""></a>
                <figcaption>

                    <form id="company-logo-form" method="post" action="{{ route('user.client.logo.ajax') }}" enctype="multipart/form-data">
                        @csrf
                        <input name="companyId" type="hidden" value="{{ session('c_email.id') }}">
                        <div class="job-fileUpload">
                            <span><i class="fa fa-plus"></i> Upload Company Logo</span>
                            <input id="logo-company" name="company_logo" type="file" class="job-upload">
                        </div>
                    </form>

                    <h2>Company Name</h2>
                </figcaption>
            </figure>
            <ul>
                <li class="@if(Route::currentRouteName()=='user.client.dashboard') active @endif"><a href="{{ route('user.client.dashboard') }}"><i class="fa fa-user"></i> Company Profile</a></li>
                <li class="{{--@if(Route::currentRouteName()=='user.client.job.create') active @endif--}}"><a href="javascript:void(0)"><i class="fa fa-briefcase"></i> Post a Job</a></li>
                <li class="@if(Route::currentRouteName()=='user.client.job.create') active @endif"><a href="{{ route('user.client.job.create') }}"><i class="fa fa-briefcase"></i> Recruiting Services</a></li>
                <li class="@if(Route::currentRouteName()=='user.client.view.job.active') active @endif"><a href="{{ route('user.client.view.job.active') }}"><i class="fa fa-suitcase"></i> Active Jobs</a></li>
                <li class="@if(Route::currentRouteName()=='user.client.view.job.expired') active @endif"><a href="{{ route('user.client.view.job.expired') }}"><i class="fa fa-briefcase"></i> Republish</a></li>
{{--                <li class="@if(Route::currentRouteName()=='user.client.candidates')  active @endif"><a href="{{ route('user.client.candidates') }}"><i class="fa fa-users"></i> Candidates</a></li>--}}
                <li class="@if(Route::currentRouteName()=='user.client.change-password') active @endif"><a href="{{route('user.client.change-password')}}"><i class="fa fa-lock"></i> Change Password</a></li>
                <li class="@if(Route::currentRouteName()=='') @endif"><a href="{{ route('user.logout') }}"><i class="fa fa-share"></i> Logout</a></li>
            </ul>
        </div>
    </div>
</div>

            </div>
        </div>
    </div>
    </div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p style="font-size: 18px;" id="connect_popup"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

    <!--// Footer \\-->
    <footer id="motivz-footer" class="motivz-footer-one">

        <!--// Footer Widget \\-->
        <div class="motivz-footer-widget">
            <div class="container">
                <div class="row">
                    <aside class="col-md-3">
                        <div class="widget widget-info">
                            <a class="foot-logo"><img src="{{ asset('user/images/foot-logo.png') }}" alt=""></a>
                            <div class="clearfix"></div>

                        </div>
                    </aside>
                    <aside class="col-md-3">
                        <div class="widget widget-links">
                            <h2 class="foot-title">Company</h2>
                            <ul>
                                <li><a href="{{route('about.us')}}">About Us</a></li>
                                <li><a href="{{route('contact')}}">Contact Us</a></li>
                                <li><a href="/contact/terms-of-use">Terms of Use</a></li>
                                <li><a href="/contact/privacy-policy">Privacy Policy</a></li>
                                <li><a href="{{route('login.post')}}">Employee Login</a></li>
                            </ul>
                        </div>
                    </aside>
                    <aside class="col-md-3">
                        <div class="widget widget-links" style="padding-left: 20px;">
                            <h2 class="foot-title">For Job seekers</h2>
                            <ul>
                                <li><a href="{{route('user.find.jobs')}}">Find Jobs </a></li>
                                <li><a href="{{route('view.career.develop')}}">Career Development </a></li>
                                <li><a href="{{route('user.career.resources')}}">Career Resources </a></li>
                                @if(Session::has('candidate_id'))
                                    <li><a href="{{route('candidate.dashboard')}}">Upload Resume </a></li>
                                @else
                                    <li><a href="{{route('user.signUp')}}">Upload Resume </a></li>
                                @endif
                                <li><a href="{{route('candidate.dashboard')}}">Create Profile </a></li>


                            </ul>
                        </div>
                    </aside>
                    <aside class="col-md-3">
                        <div class="widget widget-links" style="padding-left: 70px;">
                            <h2 class="foot-title">For Employers</h2>
                            <ul>
                                <li><a href="{{route('user.recruiting.services')}}">Recruiting Services </a></li>
                                <li><a href="{{route('user.direct.placement')}}">Direct Placement </a></li>
                                <li><a href="{{route('user.temporary.staffing')}}">Temporary Staffing </a></li>
                                <li><a href="{{route('user.industry.insights')}}">Industry Insights </a></li>
                                <li><a href="{{route('user.client.dashboard')}}">Create Company Profile </a></li>
                            </ul>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="footer-form">
            <div class="container">
                <div class="row">
                    <div class="col-md-5">
                        <h2>Get alert for your favorite job now!</h2>
                    </div>
                    <div class="col-md-7">
                        <form action="javascript:void(0)">
                            <input type="text" placeholder="Enter your email">
                            <label><i class="fa fa-bell"></i><input type="submit" value="Get Notified"></label>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--// Footer Widget \\-->

    </footer>
    <!--// Footer \\-->

    <div class="clearfix"></div>
</div>
<!--// Main Wrapper \\-->


<!-- jQuery (necessary for JavaScript plugins) -->
<script type="text/javascript" src="{{ asset('user/script/jquery.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script type="text/javascript" src="{{ asset('assets\scripts\jquery.validate.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets\scripts\additional-methods.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('user/script/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('user/script/slick.slider.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('user/script/t-scroll.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('user/script/functions.js') }}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="{{asset('/user/script/jquery.tagsinput.min.js')}}"></script>

    <script src="{{asset('user/script/file-input/sortable.js')}}" type="text/javascript"></script>
    <script src="{{asset('user/script/file-input/fileinput.js')}}" type="text/javascript"></script>
    <script src="{{asset('user/script/file-input/theme.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/scripts/notify.min.js')}}"></script>
<script>
    jQuery.validator.addMethod("alpha_space", function(value, element) {
        return this.optional(element) ||  /^[a-zA-Z ]*$/.test(value);
    }, "Letters only.");
    jQuery.validator.addMethod("currency", function(value, element) {
        return this.optional(element) ||  /^[$£€]*$/.test(value);
    }, "Letters only.");
    jQuery.validator.addMethod("greaterThanToday", function(value, element) {
        return this.optional(element) ||  new Date(value)>new Date();
    }, "Selected date should be greater than today.");
</script>
@yield('script')

</body>
</html>
