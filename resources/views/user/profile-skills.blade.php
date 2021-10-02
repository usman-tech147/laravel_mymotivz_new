@extends('layouts.user_layout')

@section('title' , 'Profile Skills')

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

                <div class="row">
                    <div class="col-md-12">
                        <div class="mm-motivz-jobdetail-content details-tabswrapper">
                            <div class="motivz-details-tabs">
                                <ul>
                                    <li class="active"><span class="fa fa-id-card-o"></span><br><small>Personal
                                            Details</small></li>
                                    <li class="active"><span class="fa fa-briefcase"></span><br><small>Job
                                            Details</small></li>
                                    <li class="active active-page"><span class="fa fa-bar-chart"></span><br><small>Qualifications</small>
                                    </li>
                                    <li><span class="fa fa-money"></span><br><small>Compensation</small></li>
                                    <li><span class="fa fa-handshake-o"></span><br><small>Interests</small></li>
                                </ul>
                            </div>

                            <!-- <h2 class="form-title">Skills</h2> -->
                            <form action="{{route('candidate.save.skills.details')}}" name="profile_form"
                                  id="form_profile" enctype="multipart/form-data" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-title-wrap">
                                            <h2>TIME TO SHINE</h2>
                                            <h3>Identify your education, skills, and credentials.</h3>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <select name="sel_education" id="" class="form-control">
                                                <option style="display: none;" value="">Select your highest level of
                                                    education
                                                </option>
                                                @foreach($Education as $education)
                                                    <option
                                                        value="{{$education->id}}" {{ $education->id == $Candidate->education_id ? 'selected' : '' }}>{{$education->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('sel_education')
                                            <label class="error">{{$message}}</label>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Add your skills (Optional)</label>
                                            @php $default_skills = 'Leadership,Customer Service' @endphp
                                            <input type="text" id="skills" name="skills" data-role="tagsinput"
                                                   class="tags_1 tags form-control" placeholder=""
                                                   value="@if(!is_null($Candidate['skills'])){{$Candidate->skills}}@else{{$default_skills}}@endif">
{{--                                            <label id="skills-error" class="error" for="skills"--}}
{{--                                                   style="display: none">--}}
{{--                                            </label>--}}
{{--                                            @error('skills')--}}
{{--                                                <label class="error">{{$message}}</label>--}}
{{--                                            @enderror--}}
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>
                                                Add any certificates or licenses that you have achieved (Optional)
                                            </label>
                                            @php $default_certificates = 'CPR , PE ,American Board of Dermatology' @endphp
                                            <input type="hidden" id="temp"
                                                   value="{{is_null($Candidate['certifications'])}}">
                                            <input name="required_certification" data-role="tagsinput"
                                                   id="required_certification" type="text"
                                                   class="tags_1 tags form-control"
                                                   placeholder="Use comma or enter to separate certification"
                                                   value="@if(!is_null($Candidate['certifications']) && !empty($Candidate['certifications'])){{$Candidate->certifications}}@else{{$default_certificates}}@endif">

                                        </div>
{{--                                        <label id="required_certification-error" class="error"--}}
{{--                                               for="required_certification" style="display: none"></label>--}}
{{--                                        @error('required_certification')--}}
{{--                                        <label id="required_certification-error" class="error"--}}
{{--                                               for="required_certification">{{$message}}</label>--}}
{{--                                        @enderror--}}
                                    </div>
                                    <div class="col-md-12">
                                        <br>
                                        <a href="{{route('candidate.view.personal.job.details')}}" class="form-submit">Back</a>
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
    <input type="hidden" id="location">

@stop

@section('script')
    <script src="{{asset('user/script/file-input/sortable.js')}}" type="text/javascript"></script>
    <script src="{{asset('user/script/file-input/fileinput.js')}}" type="text/javascript"></script>
    <script src="{{asset('user/script/file-input/theme.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/scripts/notify.min.js')}}"></script>
    <script>


        $(function () {


            $('#skills').tagsInput({
                width: '100%',
                defaultText: 'Use comma or enter to separate',
                confirmKeys: [13, 44],
            });

            $('#required_certification').tagsInput({
                width: '100%',
                defaultText: 'Use comma or enter to separate',

            });


        });

        $("#form_profile").validate({
            ignore: [],
            rules: {
                // skills: {
                //     required: true,
                //     maxlength: 500,
                // },
                sel_education: {
                    required: true,
                },
                // required_certification: {
                //     required: true,
                //     maxlength: 500,
                // }

            },
            // Specify validation error messages
            messages: {
                // skills: {
                //     required: "Skills are required.",
                //     maxlength: "Skills must be less than 500 characters long."
                // },
                sel_education: {
                    required: "Education is required.",
                },
                // required_certification: {
                //     required: "Certification is required.",
                //     maxlength: "Certification must be less than 500 characters long.",
                // }
            },

            submitHandler: function (form) {
                form.submit();
            }

        });
    </script>

@endsection
