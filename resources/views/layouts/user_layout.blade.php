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
    <link rel="shortcut icon" href="{{ asset('user/images/favicon.png') }}" type="image/png"/>
    <link href="{{ asset('user/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('user/css/slick-slider.css') }}" rel="stylesheet">
    <link href="{{ asset('user/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('user/css/t-scroll.min.css') }}" rel="stylesheet">
    <link href="{{asset('user/css/file-input/fileinput.css')}}" media="all" rel="stylesheet" type="text/css"/>
    <link href="{{asset('user/css/file-input/theme.css')}}" media="all" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('user/style.css') }}" rel="stylesheet">
    <link href="{{ asset('user/css/responsive.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('/css/bootstrap-tagsinput.css')}}">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css">
    <script type="text/javascript" src="{{ asset('user/script/jquery.js') }}"></script>
    <script type="text/javascript"
            src="https://maps.googleapis.com/maps/api/js?key={{env("GOOGLE_API")}}&libraries=places"></script>
    <script async src="{{asset('google-map.js')}}"></script>


</head>
<body>


<!--// Main Wrapper \\-->
<div class="motivz-main-wrapper">

    <!--// Header \\-->
    <header id="motivz-header" class="motivz-header-one">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-9">
                    <a href="{{ route('welcome') }}" class="logo"><img src="{{ asset('user/images/logo.png') }}" alt=""></a>
                    <div class="mymotivz-nav">
                        <nav class="navbar navbar-expand-lg">
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav mr-auto">

                                    @if(Session::get('status') == 1 || Session::has('c_email'))
                                        <li class="nav-item"><a href="{{ route('user.recruiting.services') }}"
                                                                class="nav-link @if(Route::currentRouteName()=='user.recruiting.services') active @endif">Recruiting
                                                Services </a></li>
                                        <li class="nav-item"><a href="{{ route('user.direct.placement') }}"
                                                                class="nav-link @if(Route::currentRouteName()=='user.direct.placement') active @endif">Direct
                                                Placement </a></li>
                                        <li class="nav-item"><a href="{{ route('user.temporary.staffing') }}"
                                                                class="nav-link @if(Route::currentRouteName()=='user.temporary.staffing') active @endif">Temporary
                                                Staffing </a></li>
                                        <li class="nav-item"><a href="http://www.mymotivz2.development-env.com/public/blog/"
                                                                class="nav-link @if(Route::currentRouteName()=='user.industry.insights') active @endif">Industry
                                                Insights </a></li>
                                        <!-- <li class="nav-item"><a href="{{ route('user.industry.insights') }}"
                                                                class="nav-link @if(Route::currentRouteName()=='user.industry.insights') active @endif">Industry
                                                Insights </a></li> -->
                                        @if(session()->has('c_email'))
                                        @else
                                            <li class="nav-item"><a href="{{route('user.signUp.company')}}"
                                                                    class="nav-link @if(Route::currentRouteName()=='user.signUp.company') active @endif">Create
                                                    Company Profile </a></li>
                                        @endif


                                    @elseif(!Session::has('status') || Session::has('candidate_id'))


                                        <li class="nav-item"><a href="{{ route('user.find.jobs') }}"
                                                                class="nav-link @if(Route::currentRouteName()=='user.find.jobs') active @endif">Find
                                                Jobs </a></li>
                                        <li class="nav-item"><a href="{{route('view.career.develop')}}"
                                                                class="nav-link @if(Route::currentRouteName()=='view.career.develop') active @endif">Career
                                                Development </a></li>
                                        <li class="nav-item"><a href="http://www.mymotivz2.development-env.com/public/blog/"
                                                                class="nav-link @if(Route::currentRouteName()=='user.career.resources') active @endif">Career
                                                Resources </a></li>
                                                <!-- <li class="nav-item"><a href="{{route('user.career.resources')}}"
                                                                class="nav-link @if(Route::currentRouteName()=='user.career.resources') active @endif">Career
                                                Resources </a></li> -->


                                        @if(session()->has('email'))
                                            <li class="nav-item"><a class="nav-link"
                                                                    href="{{route('candidate.dashboard')}}">
                                                    Resume & Cover Letters
                                                </a>
                                            </li>
                                        @else
                                            <li class="nav-item"><a class="nav-link" href="{{route('user.signUp')}}">Resume
                                                    & Cover Letters</a></li>
                                            {{--<li ><a href="{{route('user.signUp')}}" class="@if(Route::currentRouteName()=='user.signUp') active @endif">Create User Profile </a></li>--}}
                                        @endif                                    @endif


                                    <li class="nav-item "><a
                                            class="nav-link @if(Route::currentRouteName()=='about.us') active @endif"
                                            href="{{ route('about.us') }}">About Us</a></li>
                                    <li class="nav-item "><a
                                            class="nav-link @if(Route::currentRouteName()=='contact') active @endif"
                                            href="{{ route('contact') }}">Contacts</a></li>

                                    @if( session()->has('email') || session()->has('c_email') )
                                        <li class="nav-item dropdown userdshoard dis-none">
                                            <a class="nav-link dropdown-toggle" href="javascript:void(0)"
                                               id="navbarDropdown" role="button" data-toggle="dropdown"
                                               aria-haspopup="true" aria-expanded="false">
                                                @if(Session::has('candidate_id'))
                                                    <img class="cand_prof_img"
                                                         src="@if(Session::get('cand_prof_img')!=''){{ asset('/uploads/Candidate_Profile_Images/'.Session('cand_prof_img')) }} @else {{ asset('/user/images/avatar1.png') }} @endif"
                                                         alt=""> @if (Session::get('candidate_name')!=''){{session()->get('candidate_name')}} @else
                                                        User @endif
                                                @elseif(Session::has('c_email'))
                                                    <img class="company_prof_logo"
                                                         src="@if(Session::get('c_email.logo')!=''){{ asset('user/company_logo/'.Session('c_email.logo') )  }} @else {{ asset('/user/images/avatar1.png') }} @endif"
                                                         alt=""> @if (Session::get('c_email.name')!=''){{session()->get('company_name')}} @else
                                                        Company @endif

                                                @endif
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                @if(Session::has('candidate_id'))
                                                    <a class="dropdown-item"
                                                       href="{{route('new.candidate.dashboard')}}">Dashboard</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item" href="javascript:void(0)"
                                                       onclick="candidateAccDel()">Delete Account</a>
                                                @elseif(Session::has('c_email'))
                                                    <a class="dropdown-item" href="{{route('company.dashboard')}}">Dashboard</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item" href="javascript:void(0)"
                                                       onclick="companyAccDel()">Delete Account</a>
                                                @endif

                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="{{ route('user.logout') }}">Logout</a>
                                            </div>
                                        </li>
                                    @else
                                        <li class="nav-item dis-none">
                                            <a class="nav-link" href="{{ route('user.login') }}">Sign In</a>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mymotivz-navbar">
                        <nav class="navbar navbar-expand-lg">
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav mr-auto">
                                    <li>
                                        @if( session()->has('email') || session()->has('c_email') )
                                            <div class="nav-item dropdown userdshoard dis-block">
                                                <a class="nav-link dropdown-toggle" href="javascript:void(0)"
                                                   id="navbarDropdown" role="button" data-toggle="dropdown"
                                                   aria-haspopup="true" aria-expanded="false">
                                                    @if(Session::has('candidate_id'))
                                                        <img class="cand_prof_img"
                                                             src="@if(Session::get('cand_prof_img')!=''){{ asset('/uploads/Candidate_Profile_Images/'.Session('cand_prof_img')) }} @else {{ asset('/user/images/avatar1.png') }} @endif"
                                                             alt=""> @if (Session::get('candidate_name')!=''){{session()->get('candidate_name')}} @else
                                                            User @endif

                                                    @elseif(Session::has('c_email'))
                                                        <img class="company_prof_logo"
                                                             src="@if(Session::get('c_email.logo')!=''){{ asset('user/company_logo/'.Session('c_email.logo') )  }} @else {{ asset('/user/images/avatar1.png') }} @endif"
                                                             alt=""> @if (Session::get('c_email.name')!=''){{session()->get('company_name')}} @else
                                                            Company @endif

                                                    @endif                            </a>
                                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                                                    @if(Session::has('candidate_id'))
                                                        <a class="dropdown-item"
                                                           href="{{route('new.candidate.dashboard')}}">Dashboard</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="javascript:void(0)"
                                                           onclick="candidateAccDel()">Delete Account</a>
                                                    @elseif(Session::has('c_email'))
                                                        <a class="dropdown-item" href="{{route('company.dashboard')}}">Dashboard</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="javascript:void(0)"
                                                           onclick="companyAccDel()">Delete Account</a>

                                                    @endif
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item"
                                                       href="{{ route('user.logout') }}">Logout</a>
                                                </div>
                                            </div>
                                        @else
                                            <a href="{{ route('user.login') }}" class="nav-link">Sign In</a>
                                        @endif
                                    </li>
                                    @if(!Session::has('candidate_id') && !Session::has('c_email'))
                                        <li class="nav-item">
                                            @if(Session::get('status') == 1)
                                                <a class="nav-link" href="{{route('change',['slug'=>'Job Seekers'])}}">For
                                                    Job Seekers</a>
                                            @else
                                                <a class="nav-link" href="{{route('change',['slug'=>'Employers'])}}">For Employers</a>
{{--                                                <a class="nav-link" href="{{route('employer-front',['slug'=>'Employers'])}}">For Employers</a>--}}
                                            @endif
                                            {{--                                        <a class="nav-link" href="javascript:void(0)">For Job Seekers</a>--}}
                                        </li>
                                    @endif
                                    {{--                                        @if(Session::has('status'))--}}
                                    @if(Session::has('c_email') || (!Session::has('candidate_id') && !Session::has('c_email')))
{{--                                        <li>--}}
{{--                                            <a href="{{route('user.client.job.post')}}" class="header-btn">--}}
{{--                                                Post a Job--}}
{{--                                            </a>--}}
{{--                                        </li>--}}
                                        <li>
                                            <a href="{{route('package.details')}}" class="header-btn">
                                                Post a Job
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <header class="motivz-header-two" style="display: none;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3"><a href="{{ route('welcome') }}" class="logo"><img
                            src="{{ asset('user/images/logo.png') }}" alt=""></a></div>
                <div class="col-md-9">
                    <div class="mymotivz-nav">
                        <nav class="navbar navbar-expand-lg">
                            <button class="navbar-toggler" type="button" data-toggle="collapse"
                                    data-target="#navbarSupported" aria-controls="navbarSupported" aria-expanded="false"
                                    aria-label="Toggle navigation">
                                <span class="fa fa-bars"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarSupported">
                                <ul class="navbar-nav mr-auto">
                                    @if(Session::get('status') == 1 || Session::has('c_email'))
                                        <li class="nav-item"><a href="{{ route('user.recruiting.services') }}"
                                                                class="nav-link @if(Route::currentRouteName()=='user.recruiting.services') active @endif">Recruiting
                                                Services </a></li>
                                        <li class="nav-item"><a href="{{ route('user.direct.placement') }}"
                                                                class="nav-link @if(Route::currentRouteName()=='user.direct.placement') active @endif">Direct
                                                Placement </a></li>
                                        <li class="nav-item"><a href="{{ route('user.temporary.staffing') }}"
                                                                class="nav-link @if(Route::currentRouteName()=='user.temporary.staffing') active @endif">Temporary
                                                Staffing </a></li>
                                        <li class="nav-item"><a href="http://www.mymotivz2.development-env.com/public/blog/"
                                                                class="nav-link @if(Route::currentRouteName()=='user.industry.insights') active @endif">Industry
                                                Insights </a></li>
                                                <!-- <li class="nav-item"><a href="{{ route('user.industry.insights') }}"
                                                                class="nav-link @if(Route::currentRouteName()=='user.industry.insights') active @endif">Industry
                                                Insights </a></li> -->
                                        @if(session()->has('c_email'))
                                        @else
                                            <li class="nav-item"><a href="{{route('user.signUp.company')}}"
                                                                    class="nav-link @if(Route::currentRouteName()=='user.signUp.company') active @endif">Create
                                                    Company Profile </a></li>
                                        @endif


                                    @elseif(!Session::has('status') || Session::has('candidate_id'))


                                        <li class="nav-item"><a href="{{ route('user.find.jobs') }}"
                                                                class="nav-link @if(Route::currentRouteName()=='user.find.jobs') active @endif">Find
                                                Jobs </a></li>
                                        <li class="nav-item"><a href="{{route('view.career.develop')}}"
                                                                class="nav-link @if(Route::currentRouteName()=='view.career.develop') active @endif">Career
                                                Development </a></li>
                                        <li class="nav-item"><a href="http://www.mymotivz2.development-env.com/public/blog/"
                                                                class="nav-link @if(Route::currentRouteName()=='user.career.resources') active @endif">Career
                                                Resources </a></li>


                                        @if(session()->has('email'))
                                            <li class="nav-item"><a class="nav-link"
                                                                    href="{{route('candidate.dashboard')}}">Resume &
                                                    Cover
                                                    Letter</a></li>
                                        @else
                                            <li class="nav-item"><a class="nav-link" href="{{route('user.signUp')}}">Resume
                                                    & Cover Letter</a></li>
                                            {{--<li ><a href="{{route('user.signUp')}}" class="@if(Route::currentRouteName()=='user.signUp') active @endif">Create User Profile </a></li>--}}
                                        @endif                                    @endif


                                    <li class="nav-item "><a
                                            class="nav-link @if(Route::currentRouteName()=='about.us') active @endif"
                                            href="{{ route('about.us') }}">About Us</a></li>
                                    <li class="nav-item "><a
                                            class="nav-link @if(Route::currentRouteName()=='contact') active @endif"
                                            href="{{ route('contact') }}">Contact</a></li>

                                    @if( !session()->has('email') && !session()->has('c_email') )
                                        <li class="nav-item dis-none">
                                            <a class="nav-link" href="{{ route('user.login') }}">Sign In</a>
                                        </li>
                                    @endif
                                <!-- <li>
                                        @if( session()->has('email') || session()->has('c_email') )
                                        @if(Session::has('candidate_id'))
                                        <img class="cand_prof_img"
                                             src="@if(Session::get('cand_prof_img')!=''){{ asset('/uploads/Candidate_Profile_Images/'.Session('cand_prof_img')) }} @else {{ asset('/user/images/avatar1.png') }} @endif"
                                                         alt=""> @if (Session::get('candidate_name')!=''){{session()->get('candidate_name')}} @else
                                            User @endif

                                        @elseif(Session::has('c_email'))
                                        <img class="company_prof_logo"
                                             src="@if(Session::get('c_email.logo')!=''){{ asset('user/company_logo/'.Session('c_email.logo') )  }} @else {{ asset('/user/images/avatar1.png') }} @endif"
                                                         alt=""> @if (Session::get('c_email.name')!=''){{session()->get('company_name')}} @else
                                            Company @endif

                                        @endif                            </a>
                                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                                                @if(Session::has('candidate_id'))
                                        <a class="dropdown-item"
                                           href="{{route('new.candidate.dashboard')}}">Dashboard</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item" href="javascript:void(0)"
                                                       onclick="candidateAccDel()">Delete Account</a>
                                                @elseif(Session::has('c_email'))
                                        <a class="dropdown-item" href="{{route('company.dashboard')}}">Dashboard</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item" href="javascript:void(0)"
                                                       onclick="companyAccDel()">Delete Account</a>

                                                @endif
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item"
                                           href="{{ route('user.logout') }}">Logout</a>
                                            </div>
                                        </div>
                                        @else
                                    <a href="{{ route('user.login') }}" class="nav-link">Sign In</a>
                                        @endif
                                    </li> -->
                                    @if(!Session::has('candidate_id') && !Session::has('c_email'))
                                        <li class="nav-item">
                                            @if(Session::get('status') == 1)
                                                <a class="nav-link" href="{{route('change',['slug'=>'Job Seekers'])}}">For
                                                    Job Seekers</a>
                                            @else
                                                <a class="nav-link" href="{{route('change',['slug'=>'Employers'])}}">For
                                                    Employers</a>
                                            @endif
                                        </li>
                                    @endif
                                    @if(Session::has('c_email') || (!Session::has('candidate_id') && !Session::has('c_email')))
{{--                                        <li>--}}
                                            {{--                                            <a href="{{route('user.client.job.post')}}" class="header-btn">--}}
                                            {{--                                                Post a Job--}}
                                            {{--                                            </a>--}}
                                            {{--                                        </li>--}}

                                            <li>
                                                <a href="{{route('package.details')}}" class="header-btn">
                                                    Post a Job
                                                </a>
                                            </li>
                                    @endif
                                </ul>
                            </div>
                        </nav>
                    </div>

                    @if( session()->has('email') || session()->has('c_email') )
                        <div class="dropdown userdshoard">
                            <a class="nav-link dropdown-toggle" href="javascript:void(0)"
                               id="navbarDropdown" role="button" data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false">
                                @if(Session::has('candidate_id'))
                                    <img class="cand_prof_img"
                                         src="@if(Session::get('cand_prof_img')!=''){{ asset('/uploads/Candidate_Profile_Images/'.Session('cand_prof_img')) }} @else {{ asset('/user/images/avatar1.png') }} @endif"
                                         alt=""> @if (Session::get('candidate_name')!='')
                                        <span>{{session()->get('candidate_name')}}</span> @else <span>User</span> @endif
                                @elseif(Session::has('c_email'))
                                    <img class="company_prof_logo"
                                         src="@if(Session::get('c_email.logo')!=''){{ asset('user/company_logo/'.Session('c_email.logo') )  }} @else {{ asset('/user/images/avatar1.png') }} @endif"
                                         alt=""> @if (Session::get('c_email.name')!='')
                                        <span>{{session()->get('company_name')}}</span> @else
                                        <span>Company</span> @endif

                                @endif
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                @if(Session::has('candidate_id'))
                                    <a class="dropdown-item"
                                       href="{{route('new.candidate.dashboard')}}">Dashboard</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="javascript:void(0)"
                                       onclick="candidateAccDel()">Delete Account</a>
                                @elseif(Session::has('c_email'))
                                    <a class="dropdown-item" href="{{route('company.dashboard')}}">Dashboard</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="javascript:void(0)"
                                       onclick="companyAccDel()">Delete Account</a>
                                @endif

                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('user.logout') }}">Logout</a>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </header>
    <!--// Header \\-->

    @yield('content')
    <div class="modal fade apply-popup-wrapper" id="exampleModal-notify" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true" style="overflow-y: auto">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{route('submit.job.notify')}}" method="POST" enctype="multipart/form-data"
                      name="form-notify" id="form-notify">
                    @csrf
                    <div class="modal-header">
                        <h5>
                            <strong id="company_name_popup">Job Alerts</strong>
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body modal-form">
                        <ul>
                            <li>
                                <label>Full Name</label>
                                <input type="text" name="full_name_notify" id="full_name_notify" class="form-control"
                                       placeholder="Full Name" value="">
                                @error('full_name_notify')
                                <label class="error">{{$message}}</label>
                                @enderror
                            </li>
                            <li>
                                <label>Email</label>
                                <input type="text" name="email_notify" id="email_notify" class="form-control"
                                       placeholder="Email" value="">
                                <label class="error" id="err-email" style="display: none;"></label>
                                @error('email_notify')
                                <label class="error">{{$message}}</label>
                                @enderror
                            </li>
                            <li>
                                <label>Industry</label>
                                <select name="industry_notify" id="industry_notify" class="form-control">

                                </select>
                                @error('industry_notify')
                                <label class="error">{{$message}}</label>
                                @enderror
                            </li>
                            <li>
                                <label>Desired Job (s)</label>
                                <input type="text" id="desired_job_notify" name="desired_job_notify"
                                       data-role="tagsinput" class="tags_1 tags form-control"
                                       placeholder="" value="">
                                @error('desired_job_notify')
                                <label class="text-danger">{{$message}}</label>
                                @enderror
                                <label id="desired_job_notify-error" class="error" for="desired_job_notify"
                                       style="display: none;"></label>
                            </li>
                            <li>
                                <label>Desired Location</label>
                                <input type="text" id="desired_location_notify" name="desired_location_notify"
                                       class="tags_1 tags form-control" placeholder="Desired Location" value="">
                                @error('desired_location_notify')
                                <label class="text-danger">{{$message}}</label>
                                @enderror
                                <label id="desired_location_notify-error" class="error" for="desired_location_notify"
                                       style="display: none;"></label>
                            </li>
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="submit" style="margin: 0px 0px;">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--// Footer \\-->
    <footer id="motivz-footer" class="motivz-footer-one">

        <!--// Footer Widget \\-->
        <div class="motivz-footer-widget">
            <div class="container">
                <div class="row">
                    <aside class="col-md-4">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="widget widget-links">
                                    <h2 class="foot-title">Company</h2>
                                    <ul>
                                        <li><a href="{{route('about.us')}}">About Us</a></li>
                                        <li><a href="{{route('contact')}}">Contact Us</a></li>
                                        <li><a href="/contact/terms-of-use">Terms of Use</a></li>
                                        <li><a href="/contact/privacy-policy">Privacy Policy</a></li>
                                        {{--                                        <li><a href="{{route('login.post')}}">Employee Login</a></li>--}}
                                        <li><a href="{{route('user.login')}}">Employee Login</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="widget widget-links">
                                    <h2 class="foot-title">For Job Seekers</h2>
                                    <ul>
                                        <li><a href="{{route('user.find.jobs')}}">Find Jobs </a></li>
                                        <li><a href="javascript:void(0)">Resume + Cover Letter </a></li>
                                        <li><a href="{{route('view.career.develop')}}">Career Development </a></li>
                                        @if(Session::has('candidate_id'))
                                            <li><a href="{{route('candidate.dashboard')}}">Upload Resume </a></li>
                                            <li><a href="{{route('candidate.dashboard')}}">Create Profile </a></li>
                                        @else
                                            <li><a href="{{route('user.signUp')}}">Upload Resume </a></li>
                                            <li><a href="{{route('user.signUp')}}">Create Profile </a></li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </aside>
                    <aside class="col-md-4">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="widget widget-links">
                                    <h2 class="foot-title">For Employers</h2>
                                    <ul>
                                        <li><a href="{{route('package.details')}}">Post a Job </a></li>
{{--                                        <li><a href="{{route('user.client.job.post')}}">Post a Job </a></li>--}}
                                        <li><a href="{{route('user.recruiting.services')}}">Recruiting Services </a>
                                        </li>
                                        <li><a href="{{route('user.direct.placement')}}">Direct Placement </a></li>
                                        <li><a href="{{route('user.temporary.staffing')}}">Temporary Staffing </a></li>
                                        @if(Session::has('c_email'))
                                        @else
                                            <li><a href="{{route('user.signUp.company')}}">Create Company Profile </a>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="widget widget-links">
                                    <h2 class="foot-title">Blogs</h2>
                                    <ul>
                                        <li><a href="http://www.mymotivz2.development-env.com/public/blog/">Industry Insights </a></li>
                                        <!-- <li><a href="{{route('user.industry.insights')}}">Industry Insights </a></li> -->
                                        <li><a href="http://www.mymotivz2.development-env.com/public/blog/">Career Resources </a></li>
                                        <!-- <li><a href="{{route('user.career.resources')}}">Career Resources </a></li> -->
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </aside>
                    <aside class="col-md-4">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="widget widget-links">
                                    <h2 class="foot-title">Mobile App</h2>
                                    <a class="left-icn" href="https://www.apple.com/app-store/" target="_blank"><img
                                            src="{{ asset('user/images/apple.png') }}" alt=""></a>
                                    <a class="right-icn" href="https://play.google.com/store/apps" target="_blank"><img
                                            src="{{ asset('user/images/google-play.png') }}" alt="lorem ipsum"></a>
                                    <div class="social-x">
                                        <a href="https://www.facebook.com/" target="_blank" class="fa fa-facebook"></a>
                                        <a href="https://www.instagram.com/" target="_blank"
                                           class="fa fa-instagram"></a>
                                        <a href="https://www.twitter.com/" target="_blank" class="fa fa-twitter"></a>
                                        <a href="https://www.youtube.com/" target="_blank" class="fa fa-youtube"></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="news">
                                    <h2 class="foot-title">Sign up for job alerts </h2>
                                    <form action="javascript:void(0)" id="form-job-notify">
                                        <input type="text" name="email_form" id="email_form"
                                               placeholder="Enter your email">
                                        <input type="submit" data-toggle="modal" href="#exampleModal-notify"
                                               value="Subscribe">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>

    </footer>
    <!--// Footer \\-->

    <div class="clearfix"></div>
</div>
<!--// Main Wrapper \\-->


<!-- jQuery (necessary for JavaScript plugins) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script type="text/javascript" src="{{ asset('assets/scripts/jquery.validate.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/scripts/additional-methods.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('user/script/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('user/script/slick.slider.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('user/script/t-scroll.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('user/script/functions.js') }}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript" src="{{asset('new-panel\user-panel\assets\scripts\jquery.tagsinput.min.js')}}"></script>
<script src="{{asset('easy-number-separator.js')}}"></script>


@if( session()->has('success_notify') )
    <script type="text/javascript">
        sweetAlert({
            title: "Subscription confirmed!",
            text: "You have successfully subscribed.",
            icon: "success",
        })
    </script>
@endif
@include('partials.additional_validator')
<script>


    $(function () {
        $('#desired_job_notify').tagsInput({
            width: 'auto',
            defaultText: 'Use comma or enter to separate jobs',
        });
    });

    /* function initialize() {
         var input = document.getElementById('desired-location');
         var options = {
             types: ['(regions)'] //this should work !
         };

         var autocomplete = new google.maps.places.Autocomplete(input, options);
         autocomplete.setComponentRestrictions(
             {'country': ['us']});
     }
     google.maps.event.addDomListener(window, 'load', initialize);*/

    function candidateAccDel() {
        var text = document.createElement('div')
        text.innerHTML = "Once your account is deleted, all of your saved information will be permanently deleted as well. This means you’ll lose access to your profile and account information.<br><ul class='list-style-two'><li><span>Saved resumes</span></li><li><span>Professional Summary</span></li><li><span>Apply history</span></li><li><span>Saved jobs</span></li></ul>"
        sweetAlert({
            title: "Are you sure you want to delete your account?",
            content: text,
            icon: "warning",
            buttons: ["Cancel", "Confirm"],
            dangerMode: true,
        })

            .then((willDelete) => {
                if (willDelete) {

                    window.location.href = "{{ route('delete.candidate.account')}}";
                }

            });

    }

    function companyAccDel() {
        var text = document.createElement('div')
        text.innerHTML = "This will delete everything including: <br><ul class='list-style-two'> <li><span>Company profile</span></li> <li><span>All associated jobs</span></li> <li><span>Applicants and resumes</span></li><li><span>Team members</span></li></ul> <br> If you just need to cancel your subscription, please navigate to the <a href='javascript:void(0)' style='color:#4d9a10; font-weight:bold;'>Subscriptions & Payments page</a>. Once your account is deleted, you will not be able to receive or view any applicants from your job listing."
        sweetAlert({
            title: "Are you sure?",
            content: text,
            icon: "warning",
            confirmButtonText: 'Confirm',
            buttons: ["Cancel", "Confirm"],
            dangerMode: true,
        })

            .then((willDelete) => {
                if (willDelete) {

                    window.location.href = "{{ route('delete.company.account')}}";
                }

            });

    }

    /* function ShowJobNotifyPopup(){
         $("#exampleModal").modal("show");
     }*/
    $("#form-job-notify").validate({
        ignore: "",
        rules: {},
        // Specify validation error messages
        messages: {},

        submitHandler: function (form) {

            $("#email_notify").val('');
            var email = $("#email_form").val();
            $("#email_notify").val(email);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('get.industries') }}",
                type: "POST",
                async: false,
                data: {},
                success: function (response) {
                    var html = '';
                    var industries = JSON.parse(response);
                    html += '<option value="" selected disabled>Select Industry</option>';
                    for (i = 0; i < industries.length; i++) {
                        html += '<option value="' + industries[i]['id'] + '">' + industries[i]['name'] + '</option>';
                    }
                    document.getElementById('industry_notify').innerHTML = html;
                }

            });
        }

    });

    $("#form-notify").validate({
        ignore: "",
        rules: {
            email_notify: {
                required: true,
                email: true,
            },
            full_name_notify: {
                required: true,
                namevalidation: true,

                maxlength: 255,
            },
            industry_notify: {
                required: true,
            },
            desired_job_notify: {
                required: true,
                maxlength: 500,
            },
            desired_location_notify: {
                required: true,
                locationvalidation: true,
                maxlength: 255
            },
        },
        // Specify validation error messages
        messages: {
            email_notify: {
                required: "Email is required",
                email: "Email must be in valid format.",
            },
            full_name_notify: {
                required: "Full name is required.",
                namevalidation: "Only letters are allowed in Full Name.",
                maxlength: "Full Name must be less than 255 characters."
            },
            industry_notify: {
                required: "Industry is required.",
            },
            desired_job_notify: {
                required: "Jobs Title are required.",
                maxlength: "Jobs Title must be less than 500 characters long."
            },
            desired_location_notify: {
                required: "Job location is required.",
                locationvalidation: "Job location must be in valid format.",
                minlength: "Job location must be at least 2 characters long.",
                maxlength: "Job location must be less than 255 characters long."
            },

        },

        submitHandler: function (form) {

            form.submit();
        }

    });

    $('#exampleModal-notify').on('hidden.bs.modal', function () {
        $('#form-notify')[0].reset();
        $("#form-notify").validate().resetForm();
        $('.tag').remove();
    });

    $(document).ready(function () {
        // function initialize() {
        //     var input = document.getElementById('location');
        //     var options = {
        //         types: ['(regions)'] //this should work !
        //     };
        //     var autocomplete = new google.maps.places.Autocomplete(input, options);
        // }
        // google.maps.event.addDomListener(window, 'load', initialize);
        // function initialization() {
        //     var input = document.getElementById('desired_location_notify');
        //     var options = {
        //         types: ['(regions)'] //this should work !
        //     };
        //     var autocomplete = new google.maps.places.Autocomplete(input, options);
        // }
        // google.maps.event.addDomListener(window, 'load', initialization);
        $("#desired_location_notify").on('keydown keypress keyup', function (event) {
            if (event.keyCode === 13) {
                event.preventDefault();
                return false;
            }
        })
        $("#location").on('keydown keyup keypress', function (event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        })
    })
</script>
@yield('script')
@yield('script_sidebar')
</body>
</html>
