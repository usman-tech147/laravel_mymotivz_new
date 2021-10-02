<div class="app-sidebar sidebar-shadow">
    <div class="app-header__logo">
        <div class="logo-src"></div>
        <div class="header__pane ml-auto">
            <div>
                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                </button>
            </div>
        </div>
    </div>
    <div class="app-header__mobile-menu">
        <div>
            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
            </button>
        </div>
    </div>
    <div class="app-header__menu">
                    <span>
                        <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                            <span class="btn-icon-wrapper">
                                <i class="fa fa-ellipsis-v fa-w-6"></i>
                            </span>
                        </button>
                    </span>
    </div>
    <div class="scrollbar-sidebar">
        <div class="app-sidebar__inner">
            <ul class="vertical-nav-menu">
                <li>
                    <a class="@if(Route::currentRouteName()=='company.dashboard')  @endif" href="{{route('welcome')}}">
                        <i class="metismenu-icon pe-7s-home"></i>
                        Homepage
                    </a>
                </li>
                <li>
                    <a class="@if(Route::currentRouteName()=='new.candidate.dashboard') mm-active  @endif" href="{{route('new.candidate.dashboard')}}">
                        <i class="metismenu-icon pe-7s-map"></i>
                        Dashboard
                    </a>
                </li>
                <li>
                    <a class="@if(Route::currentRouteName()=='candidate.dashboard') mm-active  @endif"  href="{{route('candidate.dashboard')}}">
                        <i class="metismenu-icon pe-7s-user"></i>
                        Profile
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)">
                        <i class="metismenu-icon pe-7s-news-paper"></i>
                        Resume & Cover Letter
                    </a>
                </li>
                <li>
                    <a class="@if(Route::currentRouteName()=='saved.jobs') mm-active  @endif" href="{{route('saved.jobs')}}">
                        <i class="metismenu-icon pe-7s-portfolio">
                        </i>Saved Jobs
                    </a>
                </li>
                <li>
                    <a class="@if(Route::currentRouteName()=='view.applied.jobs') mm-active  @endif" href="{{route('view.applied.jobs')}}">
                        <i class="metismenu-icon pe-7s-albums">
                        </i>Applied Jobs
                    </a>
                </li>
                <li>
                    <a class="@if(Route::currentRouteName()=='view.change.password') mm-active  @endif" href="{{route('view.change.password')}}">
                        <i class="metismenu-icon pe-7s-lock"></i>
                        Change Password
                    </a>
                </li>
                <li>
                    <a class="nav-button" href="#exampleModal" data-toggle="modal">Connect With A Career Developer</a>
                </li>
            </ul>
        </div>
    </div>
</div>
