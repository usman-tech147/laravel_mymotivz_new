@extends('layouts.user_layout')
@section('title' , 'Job Details')

@section('content')
    <!--// Main Banner \\-->
    <div class="mm-subheader" style="height: 230px;"><h1></h1></div>
    <!--// Main Banner \\-->
    <div class="motivz-main-section motivz-typo-wrapfull">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @if(Session::has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{Session::get('success')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if(Session::has('already_applied'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{Session::get('already_applied')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if(Session::has('last_date'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{Session::get('last_date')}}
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
                    <div class="motivz-typo-wrap">
                        <figure class="motivz-jobdetail-list" style="padding:15px 15px 0 15px !important;">
                            <span class="motivz-jobdetail-listthumb">
                                <small
                                    @if($job['admin'])
                                        style="background-image: url('{{asset($job['mymotivz_logo'])}}');">
                                    @else
                                        style="background-image: url(' @if($job['client']['logo']) {{asset('user/company_logo/'.$job['client']['logo'])}}  @else {{ asset('/user/images/avatar1.png') }} @endif');">
                                    @endif
                                </small>
                            </span>
                            <figcaption>
                                <h2>{{$job->job_title}}</h2>
                                <span><small class="motivz-jobdetail-type">{{$job['service']}}</small>
                                    <a
                                        href="{{$job->web_url}}"
                                        target="_blank">
                                        @if($job['admin'])
                                            {{$job['mymotivz_title']}}
                                        @else
                                            {{$job['client']['company_name']}}
                                        @endif
                                    </a>
                                    @php
                                        $prev_time = Carbon\Carbon::now()->subDays(1);
                                        $prev_time = $prev_time->format('Y-m-d');
                                        $created_time = date('Y-m-d',strtotime($job['applied_before']));


                                        $duration = getHumanDate($job['posted_at']);
                                    @endphp
                                    @if($created_time > $prev_time)
                                        {{--                                        <small class="motivz-jobdetail-postinfo">Posted now</small>--}}
                                    @endif
                                </span>
                                <ul class="motivz-jobdetail-options">
                                    <li><i class="fa fa-map-marker"></i> {{$job['location']}}</li>
                                    <li><i class="fa fa-calendar"></i> Post
                                        Date: {{$job['created_at']->format('M d, Y')}}</li>
                                    <li><i class="fa fa-calendar"></i> Apply
                                        Before: {{date('M d, Y',strtotime($job['applied_before']))}}</li>
                                    <li><i class="fa fa-eye"></i>
                                        Published {{$duration}} {{--{{$job['created_at']->diffForHumans()}}--}}</li>
                                </ul>
                            </figcaption>
                        </figure>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade apply-popup-wrapper" id="exampleModal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{route('job.apply')}}" method="POST" enctype="multipart/form-data" name="form-job-apply"
                      id="form-job-apply">
                    @csrf
                    <div class="modal-header">
                        <h5>
                            <strong id="company_name_popup">{{$job['job_title']}}</strong>
                            <ul id="location_popup" class="motivz-jobdetail-options">
                                @if($job['admin'])
                                    <li><i class="fa fa-building-o"></i> {{$job['mymotivz_title']}} </li>
                                @else
                                    <li><i class="fa fa-building-o"></i> {{$job['Client']['company_name']}}</li>
                                @endif

                                <li><i class="fa fa-globe"></i> {{$job['location']}}</li>
                            </ul>
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body modal-form">
                        <ul>
                            <li>
                                <label>Full Name</label>
                                <input type="text" name="full_name" class="form-control" placeholder=""
                                       value="@if(session::has('candidate_id')){{$candidate->name}}@endif">

                            </li>
                            <li>
                                <label>Phone Number</label>
                                <input type="text" name="phone_no" id="phone_no" class="form-control" placeholder=""
                                       value="@if(session::has('candidate_id')){{$candidate->phone}}@endif">
                            </li>
                            <li>
                                <label>Email</label>
                                <input type="text" name="email" class="form-control" placeholder=""
                                       @if(session::has('candidate_id')) value="{{$candidate->email}}" readonly
                                       @else value="" @endif>
                            </li>
                            <li>
                                {{--<label>City</label>
                                <input type="text" name="city" class="form-control" placeholder="" value="@if(session::has('candidate_id')){{$candidate->city}}@endif">
                                @error('city')
                                <label class="text-danger">{{$message}}</label>
                                @enderror--}}
                                <label>Location</label>
                                <input type="text" name="location" id="location" class="form-control"
                                       placeholder="Location"
                                       value="@if(session::has('candidate_id')){{$candidate->location}}@endif">
                                @error('location')
                                <label class="text-danger">{{$message}}</label>
                                @enderror
                            </li>
                            @if(session::has('candidate_id'))
                            @else
                                <li>
                                    <label>Password</label>
                                    <input type="password" name="password" id="password" class="form-control"
                                           placeholder="" value="">
                                    @error('password')
                                    <label class="text-danger">{{$message}}</label>
                                    @enderror
                                </li>
                                <li>
                                    <label>Confirm Password</label>
                                    <input type="password" name="password_confirmation" class="form-control"
                                           placeholder="" value="">
                                    @error('password_confirmation')
                                    <label class="text-danger">{{$message}}</label>
                                    @enderror
                                </li>
                                <li>
                                    <label>Resume</label>
                                    <input id="file-upload-demo" name="resume" type="file">
                                    <label id="file-upload-demo-error" class="error" for="file-upload-demo"
                                           style="display: none"></label>
                                </li>
                            @endif
                            <li>
                                @if(session::has('candidate_id'))
                                    @if(count($candidate_resumes))
                                    @else
                                        <label>Resume</label>
                                        <input id="file-upload-demo" name="resume" type="file">
                                        <label id="file-upload-demo-error" class="error" for="file-upload-demo"
                                               style="display: none"></label>
                                    @endif
                                @endif
                                @error('sel_resume')
                                <label class="text-danger">{{$message}}</label>
                                @enderror
                            </li>
                            <input type="hidden" name="id" id="id" value="{{$job->id}}"/>
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="submit" style="margin: 0px;">Apply</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--// Main Content \\-->
    <div class="motivz-main-content" style="padding-top: 0px;">

        <!--// Main Section \\-->
        <div class="motivz-main-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="mm-motivz-jobdetail-content">
                            @if(session::has('candidate_id'))
                                @if(!is_null($job_check))
                                    <h3 class="pull-right" style="color: green"><i class="fa fa-star"></i> Already
                                        applied to this job</h3>
                                @else
                                    {{--                                    <a href="javascript:void(0)" class="like-wrap" onclick="save_fav_job({!! $job['id'] !!})"><i style="" class="fa fa-heart icon_{!! $job['id'] !!}"></i></a>--}}
                                    <a href="javascript:void(0)" class="like-wrap"
                                       onclick="save_fav_job({!! $job['id'] !!})"><i @if(is_null($fav_check)) style=""
                                                                                     @else style="color:tomato"
                                                                                     @endif class="fa fa-heart icon_{!! $job['id'] !!}"></i></a>
                                    <a data-toggle="modal" href="#exampleModal" class="apply-btn">Apply Now</a>
                                @endif
                            @else
                                <a data-toggle="modal" href="#exampleModal" class="apply-btn">Apply Now</a>
                            @endif

                            @if(!empty($job['package_to']))
                                @php $package_to = ' - '.$job['package_sign'].$job['package_to']; @endphp
                            @else
                                @php $package_to = ''; @endphp
                            @endif
                            <div class="mm-motivz-content-title"><h2>Job Detail</h2></div>
                            <div class="mm-motivz-jobdetail-services">
                                <ul class="row">
                                    <li class="col-md-4">
                                        <i class="fa fa-money"></i>
                                        <div class="mm-motivz-services-text">Compensation
                                            <small>{{$job['package_sign'].$job['package'].$package_to.'/'.$job['package_type']}}</small>
                                        </div>
                                    </li>
                                    <li class="col-md-4">
                                        <i class="fa fa-bar-chart"></i>
                                        <div class="mm-motivz-services-text">Experience
                                            <small>{{$job['required_experience']}} </small></div>
                                    </li>
                                    <li class="col-md-4">
                                        <i class="fa fa-book"></i>
                                        <div class="mm-motivz-services-text">Job Type
                                            <small>{{$job['service']}} </small></div>
                                    </li>
                                    <li class="col-md-4">
                                        <i class="fa fa-graduation-cap"></i>
                                        <div class="mm-motivz-services-text">Education
                                            <small>{{$job['education']['name']}}</small></div>
                                    </li>
                                    <li class="col-md-4">
                                        <i class="fa fa-filter"></i>
                                        <div class="mm-motivz-services-text">Industry
                                            <small>{{$job['industry']['name']}}</small></div>
                                    </li>
                                    <li class="col-md-4">
                                        <i class="fa fa-id-card-o"></i>
                                        <div class="mm-motivz-services-text">Job Openings
                                            <small>{{$job['job_opening']}} </small></div>
                                    </li>
                                </ul>
                            </div>
                            <div class="mm-motivz-content-title"><h2>Job Description</h2></div>
                            <div class="mm-motivz-description">
                                {{--                                <p>{!! $job['job_description'] !!}</p>--}}
                                @if(htmlentities($job->job_description) == '&lt;p&gt;&amp;nbsp;&lt;/p&gt;' ||
                                    htmlentities($job->job_description) == '&lt;p&gt; &lt;/p&gt;' ||
                                    htmlentities($job->job_description) == '&lt;p&gt; &lt;/p&gt;&lt;p&gt; &lt;/p&gt;&lt;p&gt; &lt;/p&gt;')
                                    <p> N/A </p>
                                @else
                                    <p>{!! $job->job_description !!}</p>
                                @endif
                            </div>
                            {{--<div class="mm-motivz-content-title"><h2>What You Will Do</h2></div>
                            <div class="mm-motivz-description">
                                <p>{{$job['job_responsibilities']}}</p>
                            </div>--}}
                            <div class="mm-motivz-content-title"><h2>Job Benefits:</h2></div>
                            {{--<div class="mm-motivz-description">
                                <p>{{$job['job_benefits']}}</p>
                            </div>--}}
                            <div class="mm-motivz-jobdetail-tags">
                                @if ($job['job_benefits'] != "")
                                    @foreach(explode(',', $job['job_benefits']) as $benefits)
                                        <a href="javascript:void(0)">{{$benefits}}</a>
                                    @endforeach
                                @else
                                    <p> N/A </p>
                                @endif
                            </div>
                            <div class="mm-motivz-content-title"><h2>Required Skills:</h2></div>
                            <div class="mm-motivz-jobdetail-tags">
                                @if ($job['required_skills'] != "")
                                    @foreach(explode(',', $job['required_skills']) as $skills)
                                        <a href="javascript:void(0)">{{$skills}}</a>
                                    @endforeach
                                @else
                                    <p> N/A </p>
                                @endif
                            </div>
                            <div class="mm-motivz-content-title"><h2>Licensure/Certification:</h2></div>
                            <div class="mm-motivz-jobdetail-tags">
                                @if ($job['certifications'] != "")
                                    @foreach(explode(',', $job['certifications']) as $certification)
                                        <a href="javascript:void(0)">{{$certification}}</a>
                                    @endforeach
                                @else
                                    <p> N/A </p>
                                @endif
                            </div>
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
    <script src="{{asset('assets/scripts/moment.min.js')}}"></script>
    <script src="{{asset('assets/scripts/notify.min.js')}}"></script>
    <script src="{{asset('user/script/blockUI.js')}}"></script>
    <script src="{{asset('js/pagination.js')}}"></script>
    <script src="{{asset('user/script/file-input/fileinput.js')}}" type="text/javascript"></script>
    <script src="{{asset('user/script/file-input/theme.js')}}" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            $("#file-upload-demo").fileinput({
                'theme': 'explorer',
                'uploadUrl': '#',
                overwriteInitial: false,
            });

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

            $("#form-job-apply").validate({
                rules: {
                    full_name: {
                        required: true,
                        lettersonly: true,
                        maxlength: 255,
                    },

                    /*city: {
                        required: true,
                        lettersonly:true,
                        minlength: 5,
                        maxlength: 30,
                    },*/
                    location: {
                        required: true,
                        locationvalidation: true,
                        // minlength: 2,
                        maxlength: 255
                    },
                    password: {
                        required: true,
                        checkSpecialchar: true,
                        checkupper: true,
                        checkdigit: true,
                        minlength: 6,
                        maxlength: 20,
                    },
                    password_confirmation: {
                        required: true,
                        equalTo: "#password",
                    },
                    email: {
                        required: true,
                        email: true,
                    },
                    phone_no: {
                        required: true,
                        phonenumber: true,
                        minlength: 14,
                        maxlength: 14
                    },
                    resume: {
                        required: true,
                        extension: 'docx|doc|pdf',
                    }
                },
                messages: {
                    full_name: {
                        required: "Full name is required.",
                        // lettersonly: "Only letters are allowed in Full Name.",
                        maxlength: "Full Name must be less than 255 characters."
                    },
                    /*city: {
                        required: "City is required.",
                        lettersonly : "Only Alphabets are allowed in city name.",
                        minlength: "City Name must be at least 5 characters long.",
                        maxlength: "City Name must be less than 30 characters long."
                    },*/
                    location: {
                        required: "Job location is required.",
                        locationvalidation: "Job location must be in valid format.",
                        // minlength: "Job location must be at least 2 characters long.",
                        maxlength: "Job location must be less than 255 characters long."
                    },
                    password: {
                        required: "Please Enter Password.",
                        checkSpecialchar: "*Minimum 6 characters long.<br/>*Must contain at least 1 special character (@,!,#,.).<br/>*Must contain at least 1 uppercase letter.<br/>*Must contain at least 1 digit number.",
                        checkupper: "*Minimum 6 characters long.<br/>*Must contain at least 1 special character (@,!,#,.).<br/>*Must contain at least 1 uppercase letter.<br/>*Must contain at least 1 digit number.",
                        checkdigit: "*Minimum 6 characters long.<br/>*Must contain at least 1 special character (@,!,#,.).<br/>*Must contain at least 1 uppercase letter.<br/>*Must contain at least 1 digit number.",
                        minlength: "*Minimum 6 characters long.<br/>*Must contain at least 1 special character (@,!,#,.).<br/>*Must contain at least 1 uppercase letter.<br/>*Must contain at least 1 digit number.",
                        maxlength: "Password must be less than 255 characters long.",

                    },
                    password_confirmation: {
                        required: "Please Enter Confirm Password.",
                        equalTo: "Password did not match.",
                    },
                    email: {
                        required: "Email is required.",
                        email: "Email must be in valid format.",
                    },
                    phone_no: {
                        required: "Phone number is required.",
                        phonenumber: "Phone number must be in valid format.",
                        minlength: "Phone number must be equal to 14 characters.",
                        maxlength: "Phone number must be equal to 14 characters.",
                    },
                    resume: {
                        required: "Resume is Required.",
                        extension: 'Only pdf, doc and docx files are allowed.',
                    }
                },
                submitHandler: function (form) {
                    form.submit();
                }

            });

            $('#exampleModal').on('hidden.bs.modal', function () {
                $('#form-job-apply')[0].reset();
                $("#form-job-apply").validate().resetForm();
                // $('.tag').remove();
            });

            var value = $("#password").val();
            $.validator.addMethod("checkSpecialchar", function (value) {
                return /[^\w\s]/gi.test(value);
            });
            $.validator.addMethod("checkupper", function (value) {
                return /[A-Z]/.test(value);
            });
            $.validator.addMethod("checkdigit", function (value) {
                return /[0-9]/.test(value);
            });
            // jQuery.validator.addMethod("lettersonly", function (value, element) {
            //     return this.optional(element) || /^[a-zA-Z ]+$/i.test(value);
            // });
            // jQuery.validator.addMethod("phonenumber", function (value, element) {
            //     return this.optional(element) || /^[0-9\-\(\)\s]+$/i.test(value);
            // });
            // jQuery.validator.addMethod("locationvalidation", function (value, element) {
            //     return this.optional(element) || /^[a-zA-Z, ]+$/i.test(value);
            // });
        });

        function save_fav_job(id) {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('Ajax.save.job') }}",
                type: "POST",
                async: false,
                data: {id: id},
                success: function (response) {
                    // alert(response);
                    // console.log(response);
                    if (response == 'saved') {
                        $(".icon_" + id).css('color', 'tomato');
                        $.notify("Job Saved Successfully", {
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

                    } else if (response == 'deleted') {
                        $(".icon_" + id).css('color', '');
                        $.notify("Removed from Saved Job Successfully", {
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

                    } else if (response == 'notloggedin') {
                        window.location.href = "{{route('user.login')}}";
                    }

                },
            });
        }
    </script>
@endsection
