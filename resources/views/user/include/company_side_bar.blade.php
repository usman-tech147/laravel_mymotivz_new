<div class="scrollbar-sidebar">
    <div class="app-sidebar__inner">
        <ul class="vertical-nav-menu">
            <li>
                <a class="@if(Route::currentRouteName()=='company.dashboard')  @endif" href="{{route('employer.welcome')}}">
                    <i class="metismenu-icon pe-7s-home"></i>
                    Homepage
                </a>
            </li>
            <li>
                <a class="@if(Route::currentRouteName()=='company.dashboard') mm-active  @endif" href="{{route('company.dashboard')}}">
                    <i class="metismenu-icon pe-7s-map"></i>
                    Dashboard
                </a>
            </li>
            <li>
                <a class="@if(Route::currentRouteName()=='user.client.dashboard') mm-active  @endif" href="{{route('user.client.dashboard')}}">
                    <i class="metismenu-icon pe-7s-com icon-company-profile"></i>
                    Company Profile
                </a>
            </li>
            <li>
                <a class="@if(Route::currentRouteName()=='user.client.job.post') mm-active  @endif" href="{{route('user.client.job.post')}}">
                    <i class="metismenu-icon icon-post-jobs"></i>
                    Post a Job
                </a>
            </li>
            <li>
                <a class="@if(Route::currentRouteName()=='user.client.job.create') mm-active  @endif" href="{{route('user.client.job.create')}}">
                    <i class="metismenu-icon icon-recruiting-services"></i>
                    Recruiting Services
                </a>
            </li>
            <li>
                <a class="@if(Route::currentRouteName()=='company.recruitment') mm-active  @endif" href="{{route('company.recruitment')}}">
                    <i class="metismenu-icon pe-7s-id">
                    </i>Active Recruitments
                </a>
            </li>
            <li>
                <a class="@if(Route::currentRouteName()=='user.client.view.job.active') mm-active  @endif" href="{{route('user.client.view.job.active')}}">
                    <i class="metismenu-icon icon-active-jobs"></i>Active Jobs
                </a>
            </li>
            <li>
                {{--                <a class="@if(Route::currentRouteName()=='user.client.view.job.expired') mm-active  @endif" href="{{route('user.client.view.job.expired')}}">--}}
                {{--                    <i class="metismenu-icon pe-7s-shield">--}}
                {{--                    </i>Inactive Jobs--}}
                {{--                </a>--}}

                <a href="#">
                    <i class="metismenu-icon pe-7s-shield"></i>
                    Inactive Jobs
                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                </a>
                <ul>
                    <li>
                        <a class="@if(Route::currentRouteName()=='user.client.job.pending') mm-active  @endif" href="{{route('user.client.job.pending')}}">
                            Pending Jobs
                        </a>
                    </li>
                    <li>
                        <a class="@if(Route::currentRouteName()=='user.client.job.rejected') mm-active  @endif" href="{{route('user.client.job.rejected')}}">
                            Rejected Jobs
                        </a>
                    </li>
                    <li>
                        <a class="@if(Route::currentRouteName()=='user.client.view.job.expired') mm-active  @endif" href="{{route('user.client.view.job.expired')}}">
                            Expired Jobs
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a  href="/employeer/view-billing-information">
                    <i class="metismenu-icon pe-7s-cash">
                    </i>Billing Information
                </a>
            </li>
            <li>
                <a  href="/employeer/orders-history">
                    <i class="metismenu-icon pe-7s-cash">
                    </i>Orders History
                </a>
            </li>
            <li>
                <a  href="javascript:void(0)">
                    <i class="metismenu-icon pe-7s-cash">
                    </i>Subscriptions & Payments
                </a>
            </li>
            <li>
                <a class="@if(Route::currentRouteName()=='user.client.change-password') mm-active  @endif" href="{{route('user.client.change-password')}}">
                    <i class="metismenu-icon pe-7s-lock"></i>
                    Change Password
                </a>
            </li>
        </ul>
    </div>
</div>
