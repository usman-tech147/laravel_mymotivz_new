<div class="col-md-3">
    <div class="job-typo-wrap">
        <div class="job-employer-dashboard-nav">
            <form action="javascript:void(0)" method="POST" enctype="multipart/form-data" id="logo_form" name="logo_form">
                @csrf
                <figure>
                     <a href="javascript:void(0)" class="employer-dashboard-thumb" ><img id="changed_logo" src="@if(Session::has('c_email.logo')){{ asset('user/company_logo/'.Session('c_email.logo') )  }} @else {{ asset('/user/images/featured-img1.jpg') }} @endif" alt=""></a>
                    <figcaption>

                        {{--<form id="company-logo-form" method="post" action="{{ route('user.client.logo.ajax') }}" enctype="multipart/form-data">
                            @csrf
                            <input name="companyId" type="hidden" value="{{ session('c_email.id') }}">--}}
                            <div class="job-fileUpload">
                                <span><i class="fa fa-plus"></i> Upload Company Logo</span>
                                <input id="company_logo" name="company_logo" type="file" class="job-upload" onChange="form.submit()">
                                @error('company_logo')
                                <label for="" class="error">{{$message}}</label>
                                @enderror
                            </div>
    {{--                    </form>--}}

                        <h2>{{\App\NewClient::find(session('c_email.id'))->company_name}}</h2>
                    </figcaption>
                </figure>
            </form>
            <ul>

                <li class="@if(Route::currentRouteName()=='user.client.dashboard') active @endif"><a href="{{ route('user.client.dashboard') }}"><i class="fa fa-user"></i> Company Profile</a></li>
                <li class="@if(Route::currentRouteName()=='user.client.job.post') active @endif"><a href="{{ route('user.client.job.post') }}"><i class="fa fa-briefcase"></i> Post a Job</a></li>
                <li class="@if(Route::currentRouteName()=='user.client.job.create') active @endif"><a href="{{ route('user.client.job.create') }}"><i class="fa fa-briefcase"></i> Recruiting Services</a></li>
                <li class="@if(Route::currentRouteName()=='company.recruitment') active @endif"><a href="{{ route('company.recruitment') }}"><i class="fa fa-suitcase"></i> Active Recruitments</a></li>
                <li class="@if(Route::currentRouteName()=='user.client.view.job.active') active @endif"><a href="{{ route('user.client.view.job.active') }}"><i class="fa fa-suitcase"></i> Active Jobs</a></li>
                <li class="@if(Route::currentRouteName()=='user.client.view.job.expired') active @endif"><a href="{{ route('user.client.view.job.expired') }}"><i class="fa fa-briefcase"></i> Inactive Jobs</a></li>
                <li {{--class="@if(Route::currentRouteName()=='user.client.view.job.expired') active @endif"--}}><a href="javascript:void(0)"><i class="fa fa-briefcase"></i> Subscriptions & Payments</a></li>
{{--                <li class="@if(Route::currentRouteName()=='user.client.candidates')  active @endif"><a href="{{ route('user.client.candidates') }}"><i class="fa fa-users"></i> Candidates</a></li>--}}
                <li class="@if(Route::currentRouteName()=='user.client.change-password') active @endif"><a href="{{route('user.client.change-password')}}"><i class="fa fa-lock"></i> Change Password</a></li>
                <li class="@if(Route::currentRouteName()=='') @endif"><a href="{{ route('user.logout') }}"><i class="fa fa-share"></i> Logout</a></li>
            </ul>
        </div>
    </div>
</div>

@section('script_sidebar')
    <script src="{{asset('assets/scripts/notify.min.js')}}"></script>
    <script src="{{asset('user/script/blockUI.js')}}"></script>
    {{--@if( session()->has('success') )
        <script type="text/javascript">
            $.notify("Profile Image Changed successfully",{
                clickToHide: true,
                autoHide: true,
                autoHideDelay: 2000,
                arrowShow: true,
                arrowSize: 5,
                breakNewLines: true,
                elementPosition: "bottom",
                globalPosition: "top center",
                style: "bootstrap",
                className: "success",
                show: "slideDown",
                showDuration: 200,
                hideAnimation: "slideUp",
                hideDuration: 200,
                gap: 5,
            });
        </script>
        <style>
            .notifyjs-bootstrap-base span{
                font-size: 15px;
            }
        </style>
    @endif--}}

    <script>
        $(document).ready(function(){

            $(document).on('change', '#company_logo', function (e) {
                e.preventDefault();
                var form = $('#logo_form')[0];
                var formData = new FormData(form);
                $.ajaxSetup({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
                });
                if ($('#logo_form').valid()){
                    $.blockUI({ message: '<div class="spinner-grow text-success"></div><div class="spinner-grow text-success"></div><div class="spinner-grow text-success"></div>', css: {border:     'none',
                            backgroundColor:'transparent'} });
                    $.ajax({
                        type: "post",
                        url: '{{route('user.client.logo.ajax')}}',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function (data) {
                            data=JSON.parse(data);
                            if(data['success']){
                                $('#changed_logo').attr('src', window.location.origin+'/user/company_logo/'+data['success']);
                                $('.company_prof_logo').attr('src', window.location.origin+'/user/company_logo/'+data['success']);
                                $.unblockUI();
                                $.notify("Logo Changed successfully",{
                                    clickToHide: true,
                                    autoHide: true,
                                    autoHideDelay: 2000,
                                    arrowShow: true,
                                    arrowSize: 5,
                                    breakNewLines: true,
                                    elementPosition: "bottom",
                                    globalPosition: "top center",
                                    style: "bootstrap",
                                    className: "success",
                                    show: "slideDown",
                                    showDuration: 200,
                                    hideAnimation: "slideUp",
                                    hideDuration: 200,
                                    gap: 5,
                                });
                            }
                            else{
                                $.unblockUI();
                                $.notify("Something went wrong",{
                                    clickToHide: true,
                                    autoHide: true,
                                    autoHideDelay: 2000,
                                    arrowShow: true,
                                    arrowSize: 5,
                                    breakNewLines: true,
                                    elementPosition: "bottom",
                                    globalPosition: "top center",
                                    style: "bootstrap",
                                    className: "error",
                                    show: "slideDown",
                                    showDuration: 200,
                                    hideAnimation: "slideUp",
                                    hideDuration: 200,
                                    gap: 5,
                                });
                            }
                        },
                        error: function () {
                            $.unblockUI();
                            $.notify("Only file types JPEG, PNG and JPG are allowed.",{
                                clickToHide: true,
                                autoHide: true,
                                autoHideDelay: 2000,
                                arrowShow: true,
                                arrowSize: 5,
                                breakNewLines: true,
                                elementPosition: "bottom",
                                globalPosition: "top center",
                                style: "bootstrap",
                                className: "error",
                                show: "slideDown",
                                showDuration: 200,
                                hideAnimation: "slideUp",
                                hideDuration: 200,
                                gap: 5,
                            });
                        }
                    });
                }
            });
        });
    </script>
@endsection


