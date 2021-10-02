@extends('layouts.user_layout')

@section('title' , 'Profile Job Details')

@section('content')
    <!-- <div class="mm-subheader"><h1>Personal Job Details</h1></div> -->

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
                <!-- @include('user.include.candidate_side_bar') -->
                    <div class="col-md-12">
                        <div class="mm-motivz-jobdetail-content details-tabswrapper">
                            <div class="motivz-details-tabs">
                                <ul>
                                    <li class="active"><span class="fa fa-id-card-o"></span><br><small>Personal
                                            Details</small></li>
                                    <li class="active active-page"><span class="fa fa-briefcase"></span><br><small>Job
                                            Details</small></li>
                                    <li><span class="fa fa-bar-chart"></span><br><small>Qualifications</small></li>
                                    <li><span class="fa fa-money"></span><br><small>Compensation</small></li>
                                    <li><span class="fa fa-handshake-o"></span><br><small>Interests</small></li>
                                </ul>
                            </div>

                            <!-- <h2 class="form-title">Job Details</h2> -->
                            <form action="{{route('candidate.save.personal.job.details')}}" name="profile_form"
                                  id="form_profile" enctype="multipart/form-data" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-title-wrap">
                                            <h2>CAREER PURSUIT</h2>
                                            <h3>Please identify your next big move</h3>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Enter desired job title (s)</label>
                                            <input type="text" name="job_title" id="job_title_tags"
                                                   data-role="tagsinput"
                                                   class="tags_1 tags form-control" placeholder=""
                                                   value="@if(!is_null($Candidate['job_title'])){{$Candidate->job_title}}@else{{old('job_title')}}@endif">
                                            <label id="job_title_tags-error" class="error" for="job_title_tags"
                                                   style="display: none"></label>
                                            @error('job_title')
                                            <label class="error">{{$message}}</label>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <select name="sel_job_type" id="" class="form-control">
                                                <option style="display: none;" value="">Select your job type</option>
                                                <option
                                                    value="Full-time" {{ $Candidate->job_type == 'Full-time' ? 'selected' : '' }}>
                                                    Full-time
                                                </option>
                                                <option
                                                    value="Part-time" {{ $Candidate->job_type == 'Part-time' ? 'selected' : '' }}>
                                                    Part-time
                                                </option>
                                                <option
                                                    value="Contract" {{ $Candidate->job_type == 'Contract' ? 'selected' : '' }}>
                                                    Contract
                                                </option>
                                                <option
                                                    value="Contract to Hire" {{ $Candidate->job_type == 'Contract to Hire' ? 'selected' : '' }}>
                                                    Contract to Hire
                                                </option>
                                                <option
                                                    value="Seasonal" {{ $Candidate->job_type == 'Seasonal' ? 'selected' : '' }}>
                                                    Seasonal
                                                </option>
                                                <option
                                                    value="Internship" {{ $Candidate->job_type == 'Internship' ? 'selected' : '' }}>
                                                    Internship
                                                </option>
                                            </select>
                                            @error('sel_job_type')
                                            <label class="error">{{$message}}</label>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <select name="industry" id="" class="form-control">
                                                <option style="display: none;" value="">Select your industry</option>
                                                @foreach($industries as $industry)
                                                    <option
                                                        value="{{$industry->id}}" {{ $industry->id == $Candidate->industry_id ? 'selected' : '' }}>{{$industry->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('industry')
                                            <label class="error">{{$message}}</label>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <select name="sel_experience" id="" class="form-control">
                                                <option style="display: none;" value="">Select your experienced level
                                                </option>

                                                <option
                                                    value="Intern" {{ $Candidate->experience == 'Intern' ? 'selected' : '' }}>
                                                    Intern
                                                </option>
                                                <option
                                                    value="Entry Level" {{ $Candidate->experience == 'Entry Level' ? 'selected' : '' }}>
                                                    Entry Level
                                                </option>
                                                <option
                                                    value="Intermediate" {{ $Candidate->experience == 'Intermediate' ? 'selected' : '' }}>
                                                    Intermediate
                                                </option>
                                                <option
                                                    value="Experienced" {{ $Candidate->experience == 'Experienced' ? 'selected' : '' }}>
                                                    Experienced
                                                </option>
                                                <option
                                                    value="Managerial" {{ $Candidate->experience == 'Managerial' ? 'selected' : '' }}>
                                                    Managerial
                                                </option>
                                                <option
                                                    value="Directorship" {{ $Candidate->experience == 'Directorship' ? 'selected' : '' }}>
                                                    Directorship
                                                </option>
                                                <option
                                                    value="Executive" {{ $Candidate->experience == 'Executive' ? 'selected' : '' }}>
                                                    Executive
                                                </option>
                                                <option
                                                    value="Senior Executive" {{ $Candidate->experience == 'Senior Executive' ? 'selected' : '' }}>
                                                    Senior Executive
                                                </option>
                                            </select>
                                            @error('sel_experience')
                                            <label class="error">{{$message}}</label>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <br>
                                        <a href="{{route('candidate.view.personal.details')}}" class="form-submit">
                                            Back
                                        </a>
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



        $('#form_profile').submit(function () {
            if ($(document.activeElement).attr('type') == 'submit')
                return true;
            else
                return false;
        });
        $(document).ready(function () {
            // function initialize() {
            //     var input = document.getElementById('location');
            //     var options = {
            //         types: ['(regions)'] //this should work !
            //     };
            //
            //     var autocomplete = new google.maps.places.Autocomplete(input, options);
            //     autocomplete.setComponentRestrictions(
            //         {'country': ['us']});
            // }
            //
            // google.maps.event.addDomListener(window, 'load', initialize);

            $(function () {
                // $('#location').tagsInput({
                //     width: 'auto',
                //     defaultText: 'Use comma or enter to separate locations'
                // });
                $('#job_title_tags').tagsInput({
                    width: 'auto',
                    defaultText: 'Use comma or enter to separate job title'
                });
            });

            $("#file-upload-demo").fileinput({
                'theme': 'explorer',
                'uploadUrl': '#',
                overwriteInitial: false,
            });
            $("#form_profile").validate({
                ignore:"",
                rules: {
                    sel_job_type: {
                        required: true,
                    },
                    industry: {
                        required: true,
                    },
                    job_title: {
                        required: true,
                        // lettersonly: true,
                        maxlength: 255,
                    },
                    sel_experience: {
                        required: true,
                    },
                },
                // Specify validation error messages
                messages: {
                    sel_job_type: {
                        required: "Job type is required.",
                    },
                    industry: {
                        required: "Industry is required.",
                    },
                    job_title: {
                        required: "Job title is required.",
                        // lettersonly: "Job title format is invalid.",
                        // lettersonly: "Letters only.",
                        maxlength: "Job title must be less than 255 characters."
                    },
                    sel_experience: {
                        required: "Experience is required.",
                    },
                },

                submitHandler: function (form) {
                    form.submit();
                }

            });
            $(function () {
                $('#job_title').tagsInput({
                    width: 'auto',
                    defaultText: 'Use comma or enter to separate'
                });

            })

        });


    </script>

@endsection
