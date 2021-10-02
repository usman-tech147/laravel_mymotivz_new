<div class="app-header__content header-shadow">
    <div class="app-header-right">
        <div class="header-btn-lg pr-0">
            <div class="widget-content p-0">
                <div class="widget-content-wrapper">
                    <div class="widget-content-left">
                        <div class="btn-group">
                            <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
                                <img width="42" id="company_logo1" class="rounded-circle" src="@if(Session('c_email.logo')!=''){{ asset('user/company_logo/'.Session('c_email.logo') )}} @else {{ asset('/user/images/avatar1.png') }} @endif" alt="no img">
                                <i class="fa fa-angle-down ml-2 opacity-8"></i>
                            </a>
                            <div tabindex="-1" role="menu" aria-hidden="true" class="rm-pointers dropdown-menu-lg dropdown-menu dropdown-menu-right">
                                <div class="dropdown-menu-header">
                                    <div class="dropdown-menu-header-inner bg-info">
                                        <div class="menu-header-image opacity-2"></div>
                                        <div class="menu-header-content text-left">
                                            <div class="widget-content p-0">
                                                <div class="widget-content-wrapper">
                                                    <div class="widget-content-left mr-3">
                                                        <img width="42" id="company_logo" class="rounded-circle" src="@if(Session('c_email.logo')!=''){{ asset('user/company_logo/'.Session('c_email.logo') )  }} @else {{ asset('/user/images/avatar1.png') }} @endif" alt="">
                                                    </div>
                                                    <div class="widget-content-left">
                                                        <div class="widget-heading">
                                                            {{session()->get('company_name')}}
                                                        </div>

                                                    </div>
                                                    <div class="widget-content-right mr-2">
                                                        <a class="btn-pill btn-shadow btn-shine btn btn-focus" href="{{route('user.logout')}}">Logout
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="scroll-area-xs" style="height: auto;">
                                    <div class="scrollbar-container ps">
                                        <ul class="nav flex-column">
                                            <li class="nav-item">
                                                <a href="javascript:void(0)" class="nav-link" onclick="companyAccDel()">Delete Account
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content-left  ml-3 header-user-info">
                        <div class="widget-heading">
                            {{session()->get('company_name')}}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
