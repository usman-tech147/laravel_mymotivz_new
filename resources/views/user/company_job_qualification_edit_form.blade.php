@extends('layouts.user_layout')

@section('title' , 'Job Post')

@section('content')
    <!-- <div class="mm-subheader"><h1>Personal Details</h1></div> -->

    <div class="motivz-main-content">

        <!--// Main Section \\-->
        <div class="motivz-main-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="mm-motivz-jobdetail-content details-tabswrapper">
                            <div class="motivz-details-tabs">
                                <ul>
                                    <li><span class="fa fa-briefcase"></span><br><small>Job Details</small></li>
                                    <li class="active active-page"><span class="fa fa-bar-chart"></span><br><small>Qualifications</small>
                                    </li>
                                    <li><span class="fa fa-money"></span><br><small>Job Pay & Benefits</small></li>
                                </ul>
                            </div>

                            <!-- <h2 class="form-title">Personal Details</h2> -->
                            <form action="{{route("submit.job.qualification.form")}}" id="job_qualification_form"
                                  method="post">
                                @csrf
                                <input type="hidden" name="jobId" value="{{$job->id}}">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-title-wrap">
                                            <h2>THE IDEAL CANDIDATE</h2>
                                            <h3>Identify the qualifications needed</h3>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <select name="industry" class="form-control">
                                                <option value="" selected="" disabled="">Industry</option>
                                                @foreach($industries as $industry)
                                                    <option value="{{$industry->id}}"
                                                            @if($job->industry->name == $industry->name)
                                                            selected
                                                        @endif>
                                                        {{$industry->name}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <select name="required_experience" id="" class="form-control">
                                                <option value="" selected="" disabled="">Experience Level</option>
                                                <option value="Intern"
                                                        @if($job->required_experience == "Intern") selected @endif>
                                                    Intern
                                                </option>
                                                <option value="Entry Level"
                                                        @if($job->required_experience == "Entry Level") selected @endif>
                                                    Entry Level
                                                </option>
                                                <option value="Intermediate"
                                                        @if($job->required_experience == "Intermediate") selected @endif>
                                                    Intermediate
                                                </option>
                                                <option value="Experienced"
                                                        @if($job->required_experience == "Experienced") selected @endif>
                                                    Experienced
                                                </option>
                                                <option value="Managerial"
                                                        @if($job->required_experience == "Managerial") selected @endif>
                                                    Managerial
                                                </option>
                                                <option value="Directorship"
                                                        @if($job->required_experience == "Directorship") selected @endif>
                                                    Directorship
                                                </option>
                                                <option value="Executive"
                                                        @if($job->required_experience == "Executive") selected @endif>
                                                    Executive
                                                </option>
                                                <option value="Senior Executive"
                                                        @if($job->required_experience == "Senior Executive") selected @endif>
                                                    Senior Executive
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <select name="education" class="form-control">
                                                <option value="" selected="" disabled="">Select Education</option>
                                                @foreach($educations as $education)
                                                    <option value="{{$education->id}}"
                                                            @if($job->education->name == $education->name)
                                                            selected
                                                        @endif>
                                                        {{$education->name}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Required Skills (Optional)</label>
                                            <input name="required_skills" id="required_skills" type="text"
                                                   class="tags_1 tags form-control"
                                                   placeholder="Use comma or enter to separate skills"
                                                   value="{{$job->required_skills}}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group"><label>Licensure/Certification (Optional)</label>
                                            <input type="text" name="required_certification" id="required_certification"
                                                   class="tags_1 tags form-control"
                                                   placeholder="Use comma or enter to separate certification"
                                                   value="{{$job->certifications}}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <br>
                                        <a href="{{route('job.details.edit.form',[$job->id])}}"
                                           class="form-submit">Back</a>
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
        $(function () {
            $('#required_skills').tagsInput({
                width: '100%',
                defaultText: 'Use comma or enter to separate'
            });
            $('#required_certification').tagsInput({
                width: '100%',
                defaultText: 'Use comma or enter to separate'
            });
        });
        $(document).ready(function () {
            $("#job_qualification_form").validate({
                rules: {
                    industry: {
                        required: true,
                    },
                    required_experience: {
                        required: true,
                    },
                    education: {
                        required: true,
                    },
                    // required_certification: {
                    //     required: true,
                    // }
                },
                messages: {
                    industry: {
                        required: "Industry is required.",
                    },
                    required_experience: {
                        required: "Experience is required.",
                    },
                    education: {
                        required: "Education is required.",
                    },
                    // required_certification: {
                    //     required: "Certification is required.",
                    // }
                },
                submitHandler: function (form) {
                    form.submit()
                }

            });
        });
    </script>

@endsection
