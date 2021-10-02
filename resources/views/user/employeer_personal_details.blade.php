@extends('layouts.user_layout')

@section('title' , 'Profile Details')

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
                                    <li class="active active-page"><span class="fa fa-id-card-o"></span><br><small>Personal Details</small></li>
                                    <li><span class="fa fa-briefcase"></span><br><small>Company Details</small></li>
                                </ul>
                            </div>

                            <!-- <h2 class="form-title">Personal Details</h2> -->
                            <form action="#" name="profile_form" id="form_profile" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-title-wrap">
                                            <h2>YOUR PROFILE</h2>
                                            <h3>Please fill in your details below</h3>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="text" name="full_name" class="form-control" placeholder="Your Full Name" value="">
                                            @error('full_name')
                                            <label class="error">{{$message}}</label>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="text" name="your_title" class="form-control" placeholder="Your Title">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="text" name="phone_no" id="phone_no" class="form-control" placeholder="Phone Number" value="">
                                            @error('phone_no')
                                            <label class="error">{{$message}}</label>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control" placeholder="Email Address" value="" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-12"><br><a href="/employeer/update-company-profile" class="pull-right form-submit">Next</a></div>
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
