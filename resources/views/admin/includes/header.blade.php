<div class="app-header header-shadow">
            <div class="app-header__logo">

                <a href="{{route('admin')}}" class="logo-src"></a>
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
            <div class="app-header__content">
                <div class="app-header-right">
                    @if(session()->has('original_user'))
                        <div class="switch-user alert-warning">
                            Viewing as {{auth()->user()->name}} <a href="{{route('switchback')}}">Switch back</a>
                        </div>
                    @endif
                    <?php
                    $pages = array(
                        route('admin'),
                        route('client.dashboard'),
                        route('scheduled-interviews'),
                        route('todo'),
                        route('calendar'),
                        route('allplacement'),
//                        route('admin_pipeline'),
                    );
                    $url = url()->current();
                    ?>
                    @if(auth()->user()->is_super_admin==1)
                        @if(in_array($url, $pages))
                    <select  id="view_as_pipeline" name="view_as_pipeline" onchange="changelogin()" class="form-control view-as">
                        <option value="" style="display: none">View as</option>
                    @foreach($employees as $employee)
                            <option value="{{$employee['id']}}"@if(isset($user_id)) @if($employee['id']==$user_id) selected @endif @endif>{{$employee['name']}}</option>
                        @endforeach
                    </select>
                            @endif
                    @endif
                    <a href="{{route('search')}}" class="btn btn-primary pull-left pe-7s-search" style="font-size: 25px; margin-right: 10px;margin-left: 10px;"></a>
                    <div class="header-dots">
                        <div class="dropdown">
                            <button type="button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" class="p-0 mr-2 btn btn-link">
                                <span id="mark_as_read" class="icon-wrapper icon-wrapper-alt rounded-circle">
                                    <span class="icon-wrapper-bg bg-danger"></span>
                                    <i class="icon text-danger icon-anim-pulse ion-android-notifications"></i>
                                    <span id="notification_dot" class="badge badge-dot badge-dot-sm badge-danger">@if(auth()->user()->unreadnotifications->count()>0){{auth()->user()->unreadnotifications->count()}}@endif</span>
                                </span>
                            </button>
                            <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu-xl rm-pointers dropdown-menu dropdown-menu-right">
                                <div class="dropdown-menu-header mb-0">
                                    <div class="dropdown-menu-header-inner bg-deep-blue">
                                        <div class="menu-header-image opacity-1" style="background-image: url('{{asset('assets')}}/images/dropdown-header/city3.jpg');"></div>
                                        <div class="menu-header-content text-dark">
                                            <h5 class="menu-header-title">Notifications</h5>
                                            <h6 class="menu-header-subtitle">You have <b id="notification_count">{{auth()->user()->unreadnotifications->count()}}</b> New Notifications</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="scroll-area-sm">
                                    <div class="scrollbar-container">
                                        <div class="p-3">
                                            <div id="notification_menu" class="vertical-without-time vertical-timeline vertical-timeline--animate vertical-timeline--one-column">
                                                @foreach(auth()->user()->unreadNotifications as $notification)
                                                    <div class="vertical-timeline-item vertical-timeline-element">
                                                        <div><span class="vertical-timeline-element-icon bounce-in"><i class="badge badge-dot badge-dot-xl badge-danger"> </i></span>
                                                            <div class="vertical-timeline-element-content bounce-in">
                                                                <h4 class="timeline-title">{!! $notification->data['info'] !!}</h4>

                                                                <p>
                                                                    {!! $notification->data['data'] !!}</p>
                                                                <span class="vertical-timeline-element-date"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                @foreach(auth()->user()->readNotifications as $notification)
                                                    <div class="vertical-timeline-item vertical-timeline-element">
                                                        <div><span class="vertical-timeline-element-icon bounce-in"><i class="badge badge-dot badge-dot-xl badge-success"> </i></span>
                                                            <div class="vertical-timeline-element-content bounce-in">
                                                                <h4 class="timeline-title">{!! $notification->data['info'] !!}</h4>
                                                                <p>
                                                                    {!! $notification->data['data'] !!}</p>
                                                                <span class="vertical-timeline-element-date"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
{{--                                                <div class="vertical-timeline-item vertical-timeline-element">--}}
{{--                                                    <div><span class="vertical-timeline-element-icon bounce-in"><i class="badge badge-dot badge-dot-xl badge-danger"> </i></span>--}}
{{--                                                        <div class="vertical-timeline-element-content bounce-in">--}}
{{--                                                            <h4 class="timeline-title">Build the production release</h4>--}}
{{--                                                            <p>Lorem ipsum dolor sit amit,consectetur eiusmdd tempor incididunt ut labore et dolore magna elit enim at minim veniam quis nostrud</p><span class="vertical-timeline-element-date"></span>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="vertical-timeline-item vertical-timeline-element">--}}
{{--                                                    <div><span class="vertical-timeline-element-icon bounce-in"><i class="badge badge-dot badge-dot-xl badge-primary"> </i></span>--}}
{{--                                                        <div class="vertical-timeline-element-content bounce-in">--}}
{{--                                                            <h4 class="timeline-title text-success">Something not important</h4>--}}
{{--                                                            <p>Lorem ipsum dolor sit amit,consectetur elit enim at minim veniam quis nostrud</p><span class="vertical-timeline-element-date"></span>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="vertical-timeline-item vertical-timeline-element">--}}
{{--                                                    <div><span class="vertical-timeline-element-icon bounce-in"><i class="badge badge-dot badge-dot-xl badge-success"> </i></span>--}}
{{--                                                        <div class="vertical-timeline-element-content bounce-in">--}}
{{--                                                            <h4 class="timeline-title">All Hands Meeting</h4>--}}
{{--                                                            <p>Lorem ipsum dolor sic amet, today at <a href="javascript:void(0);">12:00 PM</a></p><span class="vertical-timeline-element-date"></span>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="vertical-timeline-item vertical-timeline-element">--}}
{{--                                                    <div><span class="vertical-timeline-element-icon bounce-in"><i class="badge badge-dot badge-dot-xl badge-warning"> </i></span>--}}
{{--                                                        <div class="vertical-timeline-element-content bounce-in">--}}
{{--                                                            <p>Another meeting today, at <b class="text-danger">12:00 PM</b></p>--}}
{{--                                                            <p>Yet another one, at <span class="text-success">15:00 PM</span></p><span class="vertical-timeline-element-date"></span>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="vertical-timeline-item vertical-timeline-element">--}}
{{--                                                    <div><span class="vertical-timeline-element-icon bounce-in"><i class="badge badge-dot badge-dot-xl badge-danger"> </i></span>--}}
{{--                                                        <div class="vertical-timeline-element-content bounce-in">--}}
{{--                                                            <h4 class="timeline-title">Build the production release</h4>--}}
{{--                                                            <p>Lorem ipsum dolor sit amit,consectetur eiusmdd tempor incididunt ut labore et dolore magna elit enim at minim veniam quis nostrud</p><span class="vertical-timeline-element-date"></span>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="vertical-timeline-item vertical-timeline-element">--}}
{{--                                                    <div><span class="vertical-timeline-element-icon bounce-in"><i class="badge badge-dot badge-dot-xl badge-primary"> </i></span>--}}
{{--                                                        <div class="vertical-timeline-element-content bounce-in">--}}
{{--                                                            <h4 class="timeline-title text-success">Something not important</h4>--}}
{{--                                                            <p>Lorem ipsum dolor sit amit,consectetur elit enim at minim veniam quis nostrud</p><span class="vertical-timeline-element-date"></span>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="header-btn-lg pr-0">
                        <div class="widget-content p-0">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left">
                                    <div class="btn-group">
                                        <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
                                            <!-- <img width="42" class="rounded-circle" src="http://www.backend.development-env.com/mymotivz/public/assets/images/avatars/about-us.png" alt=""> -->
                                            <span class="img rounded-circle" @if(auth()->user()->profile_pic==null) style="background-image: url('{{asset('assets')}}/images/avatars/profile1.jpg');" @else style="background-image: url('{{asset('assets')}}/images/profile_pictures/{{auth()->user()->profile_pic}}')"  @endif></span>
                                            <i class="fa fa-angle-down ml-2 opacity-8"></i>
                                        </a>
                                        <div tabindex="-1" role="menu" aria-hidden="true" class="rm-pointers dropdown-menu-lg dropdown-menu dropdown-menu-right">
                                            <div class="dropdown-menu-header">
                                                <div class="dropdown-menu-header-inner bg-info">
                                                    <div class="menu-header-image opacity-2" style="background-image: url('{{asset('assets')}}/images/dropdown-header/city3.jpg');"></div>
                                                    <div class="menu-header-content text-left">
                                                        <div class="widget-content p-0">
                                                            <div class="widget-content-wrapper">
                                                                <div class="widget-content-left mr-3">
                                                                    <img width="42" class="rounded-circle" @if(auth()->user()->profile_pic==null) src="{{asset('assets')}}/images\avatars\profile1.jpg"  @else src="{{asset('assets')}}/images\profile_pictures\{{auth()->user()->profile_pic}}" @endif alt="">
                                                                </div>
                                                                <div class="widget-content-left">
                                                                    <div class="widget-heading">{{auth()->user()->name}}
                                                                    </div>
                                                                    <div class="widget-subheading opacity-8"> {{auth()->user()->job_title}}
                                                                    </div>
                                                                </div>
                                                                <div class="widget-content-right mr-2">

                                                                      <a style="color: #fff; font-weight: bold;" class="btn-pill btn-shadow btn-shine btn" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                     <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="scroll-area-xs" style="height: 150px;">
                                                <div class="scrollbar-container ps">
                                                    <ul class="nav flex-column">
                                                        <li class="nav-item-header nav-item">My Account
                                                        </li>
                                                        <li class="nav-item">
                                                            <!-- code by amir -->
                                                           <a href="{{route('change.password')}}" class="nav-link">Settings
                                                            </a>
                                                            <!-- end code by amir -->
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="widget-content-left  ml-3 header-user-info">
                                    <div class="widget-heading">
                                        {{auth()->user()->name}}
                                    </div>
                                    <div class="widget-subheading">
                                        {{auth()->user()->job_title}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

