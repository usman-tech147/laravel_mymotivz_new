<div class="col-md-3">
    <div class="job-typo-wrap">
        <div class="job-employer-dashboard-nav">
            <form action="javascript:void(0)" method="POST" enctype="multipart/form-data" id="prof_img_form" name="prof_img_form">
                @csrf
                <figure>
                    <a href="javascript:void(0)" class="employer-dashboard-thumb"><img id="change_cover_photo" src="@if(Session::has('cand_prof_img')){{ asset('/uploads/Candidate_Profile_Images/'.Session('cand_prof_img')) }} @else {{ asset('/user/images/avatar.png') }} @endif" alt=""></a>
                    <figcaption>
                        <div class="job-fileUpload">
                            <span><i class="fa fa-plus"></i> Upload Photo</span>
                            <input type="file" class="job-upload" name="prof_img" id="prof_img" onchange="this.form.submit()">
                            @error('prof_img')
                            <label class="text-danger">{{$message}}</label>
                            @enderror
                        </div>
                        <h2>{{$Candidate->name}}</h2>
                        <span class="job-dashboard-subtitle">{{$Candidate->job_title}}</span>
                    </figcaption>
                </figure>
            </form>
            <ul>
                <li class="@if(Route::currentRouteName()=='candidate.dashboard') active @endif"><a href="{{route('candidate.dashboard')}}"><i class="fa fa-user"></i> My Profile</a></li>
                <li class=""><a href="javascript:void(0)"><i class="fa fa-file"></i> Resume & Cover Letter</a></li>
                <li class="@if(Route::currentRouteName()=='saved.jobs') active @endif"><a href="{{route('saved.jobs')}}"><i class="fa fa-heart"></i> Saved Jobs</a></li>
                <li class="@if(Route::currentRouteName()=='view.applied.jobs') active @endif"><a href="{{route('view.applied.jobs')}}"><i class="fa fa-briefcase"></i> Applied Jobs</a></li>
                <li class="@if(Route::currentRouteName()=='view.change.password') active @endif"><a href="{{route('view.change.password')}}"><i class="fa fa-lock"></i> Change Password</a></li>
                <li class="@if(Route::currentRouteName()=='') @endif"><a href="{{route('user.logout')}}"><i class="fa fa-share"></i> Logout</a></li>
                <li ><a href="#exampleModal" data-toggle="modal" class="bottom-btn conn-career-dev">Connect with a Career Developer</a></li>
            </ul>
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

@section('script_sidebar')
    <script src="{{asset('user/script/blockUI.js')}}"></script>
    <script src="{{asset('assets/scripts/notify.min.js')}}"></script>
    <script>

        $(document).ready(function(){

            $(document).on('change', '#prof_img', function (e) {
                e.preventDefault();
                var form = $('#prof_img_form')[0];
                var formData = new FormData(form);
                $.ajaxSetup({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
                });
                if ($('#prof_img_form').valid()){
                    $.blockUI({ message: '<div class="spinner-grow text-success"></div><div class="spinner-grow text-success"></div><div class="spinner-grow text-success"></div>', css: {border:     'none',
                            backgroundColor:'transparent'} });
                    $.ajax({
                        type: "post",
                        url: '{{route('profile.img.upload')}}',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function (data) {
                            data=JSON.parse(data);
                            if(data['success']){
                                $('#change_cover_photo').attr('src', window.location.origin+'/uploads/Candidate_Profile_Images/'+data['success']);
                                $('.cand_prof_img').attr('src', window.location.origin+'/uploads/Candidate_Profile_Images/'+data['success']);
                                // $('#change_cover_photo').val(data['success']);
                                $.unblockUI();
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