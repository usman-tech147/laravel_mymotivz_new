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
                                    <li class="active active-page"><span class="fa fa-bar-chart"></span><br><small>Qualifications</small></li>
                                    <li><span class="fa fa-money"></span><br><small>Job Pay & Benefits</small></li>
                                </ul>
                            </div>

                            <!-- <h2 class="form-title">Personal Details</h2> -->
                            <form action="#" name="profile_form" id="form_profile" enctype="multipart/form-data">
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
                                                <option value="1">Aerospace & Defense</option>
                                                <option value="2">Agriculture </option>
                                                <option value="3">Arts, Entertainment & Recreation</option>
                                                <option value="4">Automotive </option>
                                                <option value="5">Construction</option>
                                                <option value="6">Education </option>
                                                <option value="7">Energy, Mining & Utilities</option>
                                                <option value="8">Financial Services </option>
                                                <option value="9">Government & Public Administration </option>
                                                <option value="10">Health Care </option>
                                                <option value="11">Hotels & Travel Accommodation</option>
                                                <option value="12">Human Resources & Staffing</option>
                                                <option value="13">Information Technology </option>
                                                <option value="14">Insurance </option>
                                                <option value="15">Legal</option>
                                                <option value="16">Management & Consulting</option>
                                                <option value="17">Manufacturing </option>
                                                <option value="18">Media & Communication </option>
                                                <option value="19">Non-Profit & NGO</option>
                                                <option value="20">Personal Consumer Services </option>
                                                <option value="21">Pharmaceuticals & Biotechnology</option>
                                                <option value="22">Real Estate</option>
                                                <option value="23">Restaurants & Food Service</option>
                                                <option value="24">Retail & Wholesale</option>
                                                <option value="25">Telecommunications </option>
                                                <option value="26">Transportation & Logistics</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <select name="required_experience" id="" class="form-control">
                                                <option value="" selected="" disabled="">Experience Level</option>
                                                <option value="Intern">Intern</option>
                                                <option value="Entry Level">Entry Level</option>
                                                <option value="Intermediate">Intermediate</option>
                                                <option value="Experienced">Experienced</option>
                                                <option value="Managerial">Managerial</option>
                                                <option value="Directorship">Directorship</option>
                                                <option value="Executive">Executive</option>
                                                <option value="Senior Executive">Senior Executive</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <select name="education" class="form-control">
                                                <option value="" selected="" disabled="">Select Education</option>
                                                <option value="1">High School Diploma</option>
                                                <option value="2">GED or Equivalent</option>
                                                <option value="3">Some College</option>
                                                <option value="4">Associate’s Degree</option>
                                                <option value="5">Bachelor’s Degree</option>
                                                <option value="6">Master’s Degree</option>
                                                <option value="7">Doctorate’s Degree</option>
                                                <option value="14">PhD</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Required Skills (Optional)</label>
                                            <input name="required_skills" id="required_skills" type="text" class="tags_1 tags form-control"placeholder="Use comma or enter to separate skills"value="{{old('required_skills')}}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group"><label>Licensure/Certification (Optional)</label>
                                            <input type="text" name="required_certification" id="required_certification" class="tags_1 tags form-control" placeholder="Use comma or enter to separate certification" value="{{old('required_certification')}}">
                                        </div>
                                    </div>
                                    <div class="col-md-12"><br><a href="/employeer/job-benefits" class="pull-right form-submit">Next</a></div>
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
