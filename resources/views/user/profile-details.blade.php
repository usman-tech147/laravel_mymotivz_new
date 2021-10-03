@extends('layouts.user_layout')

@section('title' , 'Profile Details')

@section('content')
    <!-- <div class="mm-subheader"><h1>Personal Details</h1></div> -->

    <div class="motivz-main-content">

        <!--// Main Section \\-->
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
                @if(Session::has('resume_err'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{Session::get('resume_err')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="row">
                <!-- @include('user.include.candidate_side_bar') -->
                    <div class="col-md-12">
                        <div class="mm-motivz-jobdetail-content details-tabswrapper">
                            <div class="motivz-details-tabs">
                                <ul>
                                    <li class="active active-page"><span class="fa fa-id-card-o"></span><br>
                                        <small>Personal Details</small>
                                    </li>
                                    <li><span class="fa fa-briefcase"></span><br>
                                        <small>Job Details</small>
                                    </li>
                                    <li><span class="fa fa-bar-chart"></span><br>
                                        <small>Qualifications</small>
                                    </li>
                                    <li><span class="fa fa-money"></span><br>
                                        <small>Compensation</small>
                                    </li>
                                    <li><span class="fa fa-handshake-o"></span><br>
                                        <small>Interests</small>
                                    </li>
                                </ul>
                            </div>

                            <!-- <h2 class="form-title">Personal Details</h2> -->
                            <form action="{{route('candidate.save.personal.details')}}" name="profile_form"
                                  id="form_profile" enctype="multipart/form-data" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-title-wrap">
                                            <h2>Time to get you hired.</h2>
                                            <h3>Complete the first step to success.</h3>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="text" name="full_name" class="form-control"
                                                   placeholder="Full Name"
                                                   value="@if(!empty($Candidate['name']))
                                                   {{$Candidate['name']}}@else{{old('full_name')}}@endif">
                                            @error('full_name')
                                            <label class="error">{{$message}}</label>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="text" name="phone_no" id="phone_no" class="form-control"
                                                   placeholder="Phone Number"
                                                   value="@if(!empty($Candidate['phone'])){{$Candidate->phone}}@else{{old('phone_no')}}@endif">
                                            @error('phone_no')
                                            <label class="error">{{$message}}</label>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control" placeholder="Email"
                                                   value="@if(!empty($Candidate['email'])){{$Candidate->email}}@else{{old('email')}}@endif"
                                                   readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Enter your location</label>
                                            <input type="text" name="location" id="location" data-role="tagsinput"
                                                   class="tags_1 tags form-control" placeholder="Enter Location"
                                                   value="@if(!empty($Candidate['location'])){{$Candidate->location}}@else{{old('location')}}@endif">
                                            <label id="location-error" class="error" for="location"
                                                   style="display: none"></label>
                                            @error('location')
                                            <label class="error">{{$message}}</label>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="text" name="linkedin_url" class="form-control"
                                                   placeholder="Add Linkedin Profile (Optional)"
                                                   value="@if(!empty($Candidate['linkedin_url'])){{$Candidate->linkedin_url}}@else{{old('linkedin_url')}}@endif">
                                            @error('linkedin_url')
                                            <label class="error">{{$message}}</label>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            @if(count($candidate_resume))
                                                <label>Resume</label>
                                                @foreach($candidate_resume as $cand_resume)
                                                    @if (pathinfo($cand_resume->resume, PATHINFO_EXTENSION) == 'docx')
                                                        @php $class= 'fa fa-file-word-o'; @endphp
                                                    @else  @php $class= 'fa fa-file-pdf-o'; @endphp
                                                    @endif
                                                    <a href="/files/{{$cand_resume->resume}}" download
                                                       class="resume_{{$cand_resume->id}}">
                                                        <i class="{{$class}}" style="font-size: 38px;"></i>
                                                    </a>
                                                    {{--<a href="javascript:void(0)" onclick="resume_del({{$cand_resume->id}})" class="icon_{{$cand_resume->id}}">
                                                        <i  class="fa fa-trash" style="font-size: 17px"></i>
                                                    </a>--}}
                                                @endforeach
                                            @else
                                                <label>Upload your Resume (Optional)</label>
                                                <div enctype="multipart/form-data">
                                                    <input id="file-upload-demo" name="resume" type="file">
                                                </div>
                                            @endif
                                            @error('resume')
                                            <label class="error">{{$message}}</label>
                                            @enderror
                                        </div>
                                        <label id="file-upload-demo-error" style="display: none;" class="error"
                                               for="file-upload-demo">Only docx and pdf files are allowed for
                                            resume.</label>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>What is your work authorization status?</label>
                                            <ul class="status-wrapper">
                                                <li><label><input type="radio" name="auth_status" class="auth_status"
                                                                  id="auth_any_emp"
                                                                  value="I am authorized to work in the U.S for any employer" {{ $Candidate->auth_status == 'I am authorized to work in the U.S for any employer' ? 'checked' : '' }}>
                                                        I am authorized to work in the U.S for any employer</label></li>
                                                <li><label><input type="radio" name="auth_status" class="auth_status"
                                                                  id="auth_present_emp"
                                                                  value="I am authorized to work in the U.S for my present employer only" {{ $Candidate->auth_status == 'I am authorized to work in the U.S for my present employer only' ? 'checked' : '' }}>
                                                        I am authorized to work in the U.S for my present employer only</label>
                                                </li>
                                                <li><label><input type="radio" name="auth_status" class="auth_status"
                                                                  id="auth_req_sponsor"
                                                                  value="I require sponsorship to work in the U.S" {{ $Candidate->auth_status == 'I require sponsorship to work in the U.S' ? 'checked' : '' }}>
                                                        I require sponsorship to work in the U.S</label></li>
                                            </ul>
                                            <label id="auth_status-error" class="error" for="auth_status"
                                                   style="display: none"></label>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12"><br>
                                        <button type="submit" class="pull-right form-submit">Next</button>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--// Main Section \\-->

    </div>

@stop

@section('script')
    <script src="{{asset('user/script/file-input/sortable.js')}}" type="text/javascript"></script>
    <script src="{{asset('user/script/file-input/fileinput.js')}}" type="text/javascript"></script>
    <script src="{{asset('user/script/file-input/theme.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/scripts/notify.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $("#phone_no").each(function () {
                $(this).on("change keyup paste", function (e) {
                    var output,
                        $this = $(this),
                        input = $this.val();

                    if (e.keyCode != 8) {
                        input = input.replace(/[^0-9]/g, '');
                        var area = input.substr(0, 3);
                        var pre = input.substr(3, 3);
                        var tel = input.substr(6, 4);
                        if (area.length < 3) {
                            output = "(" + area;
                        } else if (area.length == 3 && pre.length < 3) {
                            output = "(" + area + ")" + " " + pre;
                        } else if (area.length == 3 && pre.length == 3) {
                            output = "(" + area + ")" + " " + pre + "-" + tel;
                        }
                        $this.val(output);
                    }
                });
            });
            $("#file-upload-demo").fileinput({
                'theme': 'explorer',
                'uploadUrl': '#',
                overwriteInitial: false,
            });
            /*Bcz in textarea space did'nt working */
            $(document).ready(function () {

                $("#form_profile").validate({
                    // ignore:[],
                    rules: {

                        full_name: {
                            required: true,
                            alpha_space: true,
                            minlength: 3,
                            maxlength: 255,
                        },
                        phone_no: {
                            required: true,
                            phonenumber: true,
                            minlength: 14,
                            maxlength: 14,
                        },
                        email: {
                            required: true,
                            email: true,
                        },
                        location: {
                            required: true,
                            locationvalidation: true,
                            // minlength: 2,
                            maxlength: 255
                        },
                        linkedin_url: {
                            validUrl: true
                        },
                        resume: {
                            extension: 'doc|docx|pdf',
                        },
                        auth_status: {
                            required: true,
                        },
                    },
                    // Specify validation error messages
                    messages: {
                        full_name: {
                            required: "Full name is required.",
                            // alpha_space: "Only letters are allowed in Full Name.",
                            maxlength: "Full Name must be less than 255 characters."
                        },
                        phone_no: {
                            required: "Phone number is required.",
                            phonenumber: "Phone number must be in valid format.",
                            minlength: "Phone number must be equal to 14 characters.",
                            maxlength: "Phone number must be equal to 14 characters.",
                        },
                        email: {
                            required: "Email is required",
                            email: "Email must be in valid format",
                        },
                        location: {
                            required: "Location is required.",
                            locationvalidation: "Location must be in valid format.",
                            // minlength: "Job Location must be at least 2 characters long.",
                            maxlength: "Location must be less than 255 characters long."
                        },
                        linkedin_url: {
                            url: "LinkedIn url is invalid."
                        },
                        resume: {
                            extension: "Only pdf, doc and docx files are allowed.",
                        },
                        auth_status: {
                            required: "Authorization status is required.",
                        },

                    },

                    submitHandler: function (form) {
                        form.submit()
                    }

                });


            });

        });

        // function initialize() {
        //     alert('location')
        //     var input = document.getElementById('location');
        //     var options = {
        //         types: ['(regions)'] //this should work !
        //     };
        //     var autocomplete = new google.maps.places.Autocomplete(input, options);
        // }

        function resume_del(id) {
            sweetAlert({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })

                .then((willDelete) => {
                    if (willDelete) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url: "/candidate/delete-resume",
                            type: "POST",
                            async: false,
                            data: {id: id},
                            success: function (response) {
                                if (response == 'deleted') {
                                    sessionStorage.setItem('deleted', JSON.stringify(true));
                                    window.location.reload();
                                }
                            },
                        });
                    }

                });

        }

        $(function () {

                if (JSON.parse(sessionStorage.getItem('deleted'))) {
                    sessionStorage.removeItem('deleted');
                    $.notify("Resume Deleted Successfully", {
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
            }
        );
    </script>

@endsection
