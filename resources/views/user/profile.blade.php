@extends('layouts.user_layout')

@section('title' , 'Candidate Profile')

@section('content')
    <div class="mm-subheader"><h1>Candidate Profile</h1></div>

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
                @if(Session::has('deleted'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{Session::get('deleted')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="row">
                    @include('user.include.candidate_side_bar')
                    <div class="col-md-9">
                        <div class="mm-motivz-jobdetail-content">

                            <h2 class="form-title">Candidate Profile</h2>
                            <form action="{{route('candidate.saveProfile')}}" name="profile_form" id="form_profile" enctype="multipart/form-data" method="POST" class="detail_page">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Full Name</label>
                                            <span>@if(!is_null($Candidate['name'])){{$Candidate->name}}@else No Name Added @endif</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mm-motivz-jobdetail-tags">
                                            <label>Job Title</label>
{{--                                            <span>@if(!is_null($Candidate['job_title'])){{$Candidate->job_title}}@else{{old('job_title')}}@endif</span>--}}
                                            @if ($Candidate['job_title'] != "")
                                                @foreach(explode(',', $Candidate['job_title']) as $job_title)
                                                    <a href="javascript:void(0)">{{$job_title}}</a>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Phone Number</label>
                                            <span>@if(!is_null($Candidate['phone'])){{$Candidate->phone}}@else{{old('phone_no')}}@endif</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <span>@if(!is_null($Candidate['email'])){{$Candidate->email}}@else{{old('email')}}@endif</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mm-motivz-jobdetail-tags">
                                            <label>Job Location</label>
                                           {{-- <span>@if(!is_null($Candidate['location'])){{$Candidate->location}}@else{{old('location')}}@endif</span>--}}
                                            @if ($Candidate['location'] != "")

                                                    <span href="javascript:void(0)">{{$Candidate['location']}}</span>

                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Linkedin Profile (optional)</label>
                                            <span><a href="{{$Candidate->linkedin_url}}" target="_blank">@if(!is_null($Candidate['linkedin_url'])){{$Candidate->linkedin_url}}@else{{old('linkedin_url')}}@endif</a></span>
                                        </div>
                                    </div>
                                    @if(!empty($Candidate->salary_to))
                                        @php $salary_to = ' - '.$Candidate->salary_sign.$Candidate->salary_to; @endphp
                                    @else
                                        @php $salary_to = ''; @endphp
                                    @endif
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Compesation</label>
                                            <span>@if(!is_null($Candidate['salary'])){{$Candidate->salary_sign.$Candidate->salary.$salary_to.'/'.$Candidate->salary_type}}@endif</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Experience</label>
                                            <span>{{$Candidate['experience']}}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Education</label>
                                            <span>@if(!is_null($Candidate['education_id'])){{$Candidate['education']['name']}}@else @endif</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Industry</label>
                                            <span>@if(!is_null($Candidate['industry_id'])){{$Candidate['industry']['name']}}@else @endif</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Job Type</label>
                                            <span>{{ $Candidate->job_type}}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group mm-motivz-jobdetail-tags">
                                            <label>Interest</label>
                                            @if ($Candidate['interest'] != "")
                                                @foreach(explode(',', $Candidate['interest']) as $interest)
                                                    <a href="javascript:void(0)">{{$interest}}</a>
                                                @endforeach
                                            @endif
                                            <label id="interest-error" class="error" for="interest" style="display: none"></label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group mm-motivz-jobdetail-tags">
                                            <label>Skills</label>
                                            @if ($Candidate['skills'] != "")
                                                @foreach(explode(',', $Candidate['skills']) as $skills)
                                                    <a href="javascript:void(0)">{{$skills}}</a>
                                                @endforeach
                                            @endif
                                            <label id="skills-error" class="error" for="skills" style="display: none"></label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group mm-motivz-jobdetail-tags">
                                            <label>Licensure/Certification</label>
                                            @if ($Candidate['certifications'] != "")
                                                @foreach(explode(',', $Candidate['certifications']) as $certifications)
                                                    <a href="javascript:void(0)">{{$certifications}}</a>
                                                @endforeach
                                            @endif
                                            <label id="skills-error" class="error" for="skills" style="display: none"></label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Professional Summary</label>
                                            <span>@if(!is_null($Candidate['prof_summary'])){{$Candidate->prof_summary}} @endif </span>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Authorization Status</label>
                                            <span>@if(!is_null($Candidate['auth_status'])){{$Candidate->auth_status}} @endif </span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group" style="border-bottom: none;">
                                            <label>Resume</label>
                                            <div enctype="multipart/form-data">


                                                @if(count($candidate_resume))
                                                    <br>
                                                    @foreach($candidate_resume as $cand_resume)
                                                        @if (pathinfo($cand_resume->resume, PATHINFO_EXTENSION) == 'docx')
                                                            @php $class= 'fa fa-file-word-o'; @endphp
                                                        @else  @php $class= 'fa fa-file-pdf-o'; @endphp
                                                        @endif
                                                        <a href="/files/{{$cand_resume->resume}}"  download class="resume_{{$cand_resume->id}}">
                                                            <i class="{{$class}}" style="font-size: 38px;"></i>
                                                        </a>
                                                    @endforeach
                                                @else
                                                    <span>No Resume Uploaded</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a href="{{route('temp.candidate.dashboard')}}" class="form-submit pull-right">Edit Profile</a>

                                <div class="clearfix"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--// Main Section \\-->

    </div>
    {{--         <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">--}}
    {{--             <div class="modal-dialog" role="document">--}}
    {{--                 <div class="modal-content">--}}
    {{--                     <div class="modal-header">--}}
    {{--                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
    {{--                             <span aria-hidden="true">×</span>--}}
    {{--                         </button>--}}
    {{--                     </div>--}}
    {{--                     <div class="modal-body">--}}
    {{--                         <p style="font-size: 18px;">The profile must be completed prior to connecting with a career developer.</p>--}}
    {{--                     </div>--}}
    {{--                     <div class="modal-footer">--}}
    {{--                         <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
    {{--                     </div>--}}
    {{--                 </div>--}}
    {{--             </div>--}}
    {{--         </div>--}}
@stop

@section('script')
    {{--    <link href="{{asset('css/bootstrap-tagsinput.css')}}" rel="stylesheet">--}}
    {{--    <script src="{{asset('user/script/jquery.tagsinput.min.js')}}"></script>--}}
    <script src="{{asset('user/script/file-input/sortable.js')}}" type="text/javascript"></script>
    <script src="{{asset('user/script/file-input/fileinput.js')}}" type="text/javascript"></script>
    <script src="{{asset('user/script/file-input/theme.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/scripts/notify.min.js')}}"></script>
    <script>

        $(document).ready(function () {
            $("#file-upload-demo").fileinput({
                'theme': 'explorer',
                'uploadUrl': '#',
                overwriteInitial: false,
            });
            /*Bcz in textarea space did'nt working */
            $('#prof_summary').keypress(function(e) {
                if (e.keyCode == 13) {
                    e.preventDefault();
                    this.value = this.value.substring(0, this.selectionStart) + "" + "\n" + this.value.substring(this.selectionEnd, this.value.length);
                }
            });
            var invalid= 0;
            $.each($("input,select,textarea","#form_profile"),function () {

                if(!$(this).val())
                {
                    invalid++;
                }

            });
            if(invalid > 3){
                $("#connect_popup").html('The profile must be completed prior to connecting with a career developer.');
            }
            else
            {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ route('prof_completed') }}",
                    type:"POST",
                    async : false,
                    data:{},
                    success:function(response){
                        $("#connect_popup").html('Thank You for submitting your profile. One of our Career Developers will be reaching out to you shortly');

                    },
                });
                {{--var formData = $('#form_profile').serialize();--}}

                {{--$.ajaxSetup({--}}
                {{--    headers: {--}}
                {{--        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
                {{--    }--}}
                {{--});--}}
                {{--$.ajax({--}}
                {{--    url: "{{ route('career.develop.mail') }}",--}}
                {{--    type:"POST",--}}
                {{--    async : false,--}}
                {{--    data:{formData : formData},--}}
                {{--    success:function(response){--}}
                {{--    },--}}
                {{--});--}}

            }



        });
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
                            type:"POST",
                            async : false,
                            data:{ id : id },
                            success:function(response){
                                if(response == 'deleted')
                                {
                                    $(".resume_"+id).hide();
                                    $(".icon_"+id).hide();
                                    $.notify("Resume Deleted Successfully",{
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
                            },
                        });
                    }

                });

        }
        $(document).ready(function () {


            $("#form_profile").validate({
                ignore:[],
                rules: {

                    full_name: {
                        required: true,
                        lettersonly: true,
                        maxlength: 255,
                    },
                    job_title: {
                        required: true,
                        lettersonly: true,
                        maxlength: 255,
                    },
                    phone_no: {
                        required: true,
                        phonenumber:true,
                        minlength: 8,
                        maxlength: 20
                    },
                    city: {
                        required: true,
                        lettersonly: true,
                        maxlength: 255,
                    },
                    state: {
                        required: true,
                        lettersonly: true,
                        maxlength: 255,
                    },
                    salary_req: {
                        required: true,
                        currencyvalidation: true,
                        minlength: 3,
                        maxlength: 20
                    },
                    skills: {
                        required: true,
                        maxlength: 255,
                    },
                    interest: {
                        required: true,
                        maxlength: 255,
                    },
                    sel_experience: {
                        required: true,
                    },
                    sel_education: {
                        required: true,
                    },
                    industry: {
                        required: true,
                    },
                    sel_job_type: {
                        required: true,
                    },
                    resume: {
                        extension : 'docx|pdf',
                    },
                    prof_summary: {
                        maxlength: 500
                    },
                },
                // Specify validation error messages
                messages: {
                    full_name: {
                        required: "Full name is required.",
                        // lettersonly: "Only letters are allowed in Full Name.",
                        maxlength: "Full Name must be less than 255 characters."
                    },
                    job_title: {
                        required: "Job title is required.",
                        // lettersonly: "Only letters are allowed in Job Title.",
                        maxlength: "Job Title must be less than 255 characters."
                    },
                    phone_no: {
                        required: "Phone number is required.",
                        phonenumber: "Phone number must be in valid format.",
                        minlength: "Phone number must be at least 8 characters long.",
                        maxlength: "Phone number must be less than 20 characters long."
                    },
                    city: {
                        required: "City is required.",
                        // lettersonly: "City must contains letters only.",
                        maxlength: "City must be less than 255 characters long."
                    },
                    state: {
                        required: "State is required.",
                        // lettersonly:"State must contain letters only.",
                        maxlength: "State must be less than 255 characters long."
                    },
                    salary_req: {
                        required: "Salary is required.",
                        /*digits : "Salary must be in digits.",*/
                        currencyvalidation:"Salary must be in valid format.",
                        minlength: "Salary must be at least 3 characters long.",
                        maxlength: "Salary must be less than 20 characters long."
                    },
                    skills: {
                        required: "Skills are required.",
                        maxlength: "Skills must be less than 255 characters long."
                    },
                    interest: {
                        required: "Interest is required.",
                        maxlength: "Interest must be at least 255 characters long.",
                    },
                    sel_experience: {
                        required: "Experience is required.",
                    },
                    sel_education: {
                        required: "Education is required.",
                    },
                    industry: {
                        required: "Industry is required.",
                    },
                    sel_job_type: {
                        required: "Job type is required.",
                    },
                    resume: {
                        extension: "Only docx and pdf files are allowed for resume.",
                    },
                    prof_summary: {
                        maxlength: "Professional summary must be less than 500 characters long.",
                    },

                },

                submitHandler: function(form) {
                    form.submit();
                }

            });
            jQuery.validator.addMethod("lettersonly", function(value, element) {
                return this.optional(element) || /^[a-zA-Z ]+$/i.test(value);
            });
            jQuery.validator.addMethod("currencyvalidation", function(value, element) {
                return this.optional(element) || /^[,?0-9$€£]+$/i.test(value);
            });
            jQuery.validator.addMethod("phonenumber", function(value, element) {
                return this.optional(element) || /^[+()-?0-9\-\(\)\s]+$/i.test(value);
            });
        });

        $('#form_profile').on('keyup keypress', function(e) {
            var keyCode = e.keyCode || e.which;
            if (keyCode === 13) {
                e.preventDefault();
                return false;
            }
        });

    </script>
    <style>
        .error {
            color: #F00;
        }
        span.tag{
            background: #2b935e;
        }
    </style>
@endsection
