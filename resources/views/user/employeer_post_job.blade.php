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
                            <form action="#" name="profile_form" id="form_profile" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-title-wrap">
                                            <h2>THE JOB</h2>
                                            <h3>Tell us about this position</h3>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Job Title" value="">
                                            @error('full_name')
                                            <label class="error">{{$message}}</label>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <select name="service" class="form-control">
                                                <option value="" selected="" disabled="">Job Type</option>
                                                <option value="Full-Time">Full-Time</option>
                                                <option value="Part-Time">Part-Time</option>
                                                <option value="Contract">Contract</option>
                                                <option value="Contract to Hire">Contract to Hire</option>
                                                <option value="Seasonal">Seasonal</option>
                                                <option value="Internship">Internship</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="text" name="location" id="location" data-role="tagsinput" class="tags_1 tags form-control" placeholder="Job Location" value="">
                                            <label id="location-error" class="error" for="location" style="display: none"></label>
                                            @error('location')
                                            <label class="error">{{$message}}</label>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <textarea placeholder="Job Description" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Number of hires</label>
                                            <select name="" id="" class="form-control">
                                                <option value="" style="display: none"></option>
                                                <option value="">1</option>
                                                <option value="">2</option>
                                                <option value="">3</option>
                                                <option value="">4</option>
                                                <option value="">5</option>
                                                <option value="">6</option>
                                                <option value="">7</option>
                                                <option value="">8</option>
                                                <option value="">9</option>
                                                <option value="">10+</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Apply Before</label>
                                            <input type="date" placeholder="" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12"><br><a href="/employeer/job-qualification" class="pull-right form-submit">Next</a></div>
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

    </script>

@endsection
