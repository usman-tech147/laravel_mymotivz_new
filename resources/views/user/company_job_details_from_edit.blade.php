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
                                    <li class="active active-page"><span class="fa fa-briefcase"></span><br><small>Job Details</small></li>
                                    <li><span class="fa fa-bar-chart"></span><br><small>Qualifications</small></li>
                                    <li><span class="fa fa-money"></span><br><small>Job Pay & Benefits</small></li>
                                </ul>
                            </div>

                            <!-- <h2 class="form-title">Personal Details</h2> -->
                            <form action="{{route('update.job.details.form')}}" method="post" id="job_details_form">
                                @csrf
                                <input type="hidden" name="id" value="{{$job->id}}">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-title-wrap">
                                            <h2>THE JOB</h2>
                                            <h3>Tell us about this position</h3>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Job Title"
                                                   value="{{$job->job_title}}" name="job_title">
                                            @error('full_name')
                                            <label class="error">{{$message}}</label>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <select name="service" class="form-control">
                                                <option value="" selected="" disabled="">Job Type</option>
                                                <option value="Full-Time" @if($job->service == "Full-Time") selected @endif>Full-Time</option>
                                                <option value="Part-Time" @if($job->service == "Part-Time") selected @endif>Part-Time</option>
                                                <option value="Contract" @if($job->service == "Contract") selected @endif>Contract</option>
                                                <option value="Contract to Hire" @if($job->service == "Contract to Hire") selected @endif>Contract to Hire</option>
                                                <option value="Seasonal" @if($job->service == "Seasonal") selected @endif>Seasonal</option>
                                                <option value="Internship" @if($job->service == "Internship") selected @endif>Internship</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="text" name="location" id="location" data-role="tagsinput"
                                                   class="tags_1 tags form-control" placeholder="Job Location" value="{{$job->location}}">
                                            <label id="location-error" class="error" for="location" style="display: none"></label>
                                            @error('location')
                                            <label class="error">{{$message}}</label>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <textarea placeholder="Job Description" name="job_description" class="form-control"> {{$job->job_description}} </textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Number of hires</label>
                                            <select name="num_of_hires" id="num_of_hires" class="form-control">
                                                <option value="" style="display: none">Select Option</option>
                                                <option value="1" @if($job->job_opening == "1") selected @endif>1</option>
                                                <option value="2" @if($job->job_opening == "2") selected @endif>2</option>
                                                <option value="3" @if($job->job_opening == "3") selected @endif>3</option>
                                                <option value="4" @if($job->job_opening == "4") selected @endif>4</option>
                                                <option value="5" @if($job->job_opening == "5") selected @endif>5</option>
                                                <option value="6" @if($job->job_opening == "6") selected @endif>6</option>
                                                <option value="7" @if($job->job_opening == "7") selected @endif>7</option>
                                                <option value="8" @if($job->job_opening == "8") selected @endif>8</option>
                                                <option value="9" @if($job->job_opening == "9") selected @endif>9</option>
                                                <option value="10+" @if($job->job_opening == "10+") selected @endif>10+</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Apply Before</label>
                                            <input type="date" placeholder="" name="apply_before" id="apply_before"
                                                   value="{{$job->applied_before}}"
                                                   class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12"><br><button type="submit" class="pull-right form-submit">Next</button></div>
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
        $( document ).ready(function() {
            $("#job_details_form").validate({
                rules: {
                    job_title: {
                        required: true,
                        alphanumericspace: true,
                        minlength: 2,
                        maxlength: 255
                    },
                    service: {
                        required: true,
                    },
                    location: {
                        required: true,
                        locationvalidation: true,
                        maxlength: 255
                    },
                    job_description: {
                        required: true,
                    },
                    num_of_hires: {
                        required: true,
                    },
                    apply_before: {
                        required: true,
                        date: true,
                        greaterThanToday: "#apply_before"
                    },
                },
                messages: {
                    job_title: {
                        required: "Job title is required.",
                        minlength: "Job title  must be at least 2 characters long.",
                        maxlength: "Job title  must be less than 255 characters long.",
                    },
                    service: {
                        required: "Please select service from dropdown."
                    },
                    location:{
                        required: "Job location is required.",
                        locationvalidation: "Job location must be in valid format.",
                        maxlength: "Job location must be less than 255 characters long."
                    },
                    job_description: {
                        required: "Job Description is required.",
                    },
                    num_of_hires: {
                        required: "Select the Number of Hires.",
                    },
                    apply_before:{
                        required: "Select the apply before date.",
                        date: "Select valid date.",
                        greaterThanToday: "Apply before date should must be a date after today."
                    },
                },
                submitHandler: function(form) {
                    form.submit()
                }

            });
        });
    </script>

@endsection
