@extends('layouts.user_layout')

@section('title' , 'Company Profile Details')

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
                                    <li><span class="fa fa-id-card-o"></span><br><small>Personal Details</small></li>
                                    <li class="active active-page"><span class="fa fa-briefcase"></span><br><small>Company Details</small></li>
                                </ul>
                            </div>

                            <!-- <h2 class="form-title">Personal Details</h2> -->
                            <form action="#" name="profile_form" id="form_profile" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-title-wrap">
                                            <h2>YOUR COMPANY PROFILE</h2>
                                            <h3>Please fill in your company details</h3>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <select class="form-control valid" name="industry" aria-invalid="false">
                                                <option value="" selected="" disabled="">Select your industry</option>
                                                <option value="1">Aerospace & Defense</option>
                                                <option value="2">Agriculture </option>
                                                <option value="3">Arts, Entertainment & Recreation</option>
                                                <option value="4">Automotive </option>
                                                <option value="5">Construction</option>
                                                <option value="6">Education </option>
                                                <option value="7">Energy, Mining & Utilities</option>
                                                <option value="8">Financial Services </option>
                                                <option value="9" selected="">Government & Public Administration </option>
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
                                            <input type="text" readonly="" name="" class="form-control" placeholder="Your Company Name">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="text" name="" class="form-control" placeholder="Address">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="" class="form-control" placeholder="City / State or Province">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="" class="form-control" placeholder="Zip Code">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <textarea placeholder="Company Description (optional)" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="text" name="" class="form-control" placeholder="Website Address">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Upload Company logo</label>
                                            <input type="file" name="" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12"><br><button class="pull-right form-submit">Submit</button></div>
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
