@extends('layouts.user_layout')

@section('title' , 'Profile Salary Details')

@section('content')
    <!-- <div class="mm-subheader"><h1>Personal Salary Details</h1></div> -->

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
                                    <li class="active"><span class="fa fa-id-card-o"></span><br><small>Personal Details</small></li>
                                    <li class="active"><span class="fa fa-briefcase"></span><br><small>Job Details</small></li>
                                    <li class="active"><span class="fa fa-bar-chart"></span><br><small>Qualifications</small></li>
                                    <li class="active active-page"><span class="fa fa-money"></span><br><small>Compensation</small></li>
                                    <li><span class="fa fa-handshake-o"></span><br><small>Interests</small></li>
                                </ul>
                            </div>

                            <!-- <h2 class="form-title">Personal Salary Details</h2> -->
                            <form action="{{route('candidate.save.salary.details')}}" name="profile_form" id="form_profile" enctype="multipart/form-data" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-title-wrap">
                                            <h2>THE MAKE OR BREAK</h2>
                                            <h3>Identify your pay requirements</h3>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Enter your desired pay</label>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text currecny_sign" id="inputGroup-sizing-default">@if(!empty($Candidate->salary_sign)){{$Candidate->salary_sign}}@else $ @endif</span>
                                                        </div>
                                                        <input name="package" id="package" type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" placeholder="From" value="{{$Candidate->salary}}" >
                                                    </div>
                                                </div>
                                                @error('package')
                                                <label id="package-error" class="error" for="package">{{$message}}</label>
                                                @enderror
                                                <div class="col-md-4">
                                                    <span id="add_range" style=" @if(empty($Candidate['salary_to'])) display: block; @else display: none;  @endif text-align: center;margin: 12px 0px 0px;font-size: 17px;font-weight: 600;cursor: pointer;">+ Add Range</span>
                                                    <div class="input-group mb-3 div_package_to" @if(empty($Candidate['salary_to'])) style="display: none" @endif>
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text currecny_sign" id="inputGroup-sizing-default">@if(!empty($Candidate->salary_sign)){{$Candidate->salary_sign}}@else $ @endif</span>
                                                            <input type="hidden" id="hidd_curr_sign" name="hidd_curr_sign" value="@if($Candidate->salary_sign == '')$@else {{$Candidate->salary_sign}}@endif">
                                                        </div>
                                                        <input name="package_to" id="package_to" type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" placeholder="To" value="{{$Candidate->salary_to}}" >
                                                    </div>
                                                </div>
                                                @error('package_to')
                                                <label id="package_to-error" class="error" for="package_to">{{$message}}</label>
                                                @enderror
                                                <div class="col-md-2">
                                                    <div class="input-group mb-3 div_package_to" >
                                                        <select style="font-size: 13px;" name="curr_sign" id="curr_sign" class="form-control">
                                                            <option value="USD" {{ ( $Candidate->salary_sign == '$') ? 'selected' : '' }} >USD</option>
                                                            <option value="CAD" {{ ( $Candidate->salary_sign == 'C$') ? 'selected' : '' }}>CAD</option>
                                                            <option value="GBP" {{ ( $Candidate->salary_sign == '£') ? 'selected' : '' }}>GBP</option>
                                                            <option value="EUR" {{ ( $Candidate->salary_sign == '€') ? 'selected' : '' }}>EUR</option>
                                                            <option value="AUD" {{ ( $Candidate->salary_sign == 'A$') ? 'selected' : '' }}>AUD</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="input-group mb-3 div_package_to">
                                                        <select style="font-size: 13px;" name="salary_duration" id="salary_duration" class="form-control">
                                                            <option value="hourly" {{ ( $Candidate->salary_type == 'hourly') ? 'selected' : '' }}>hourly</option>
                                                            <option value="daily" {{ ( $Candidate->salary_type == 'daily') ? 'selected' : '' }}>daily</option>
                                                            <option value="weekly" {{ ( $Candidate->salary_type == 'weekly') ? 'selected' : '' }}>weekly</option>
                                                            <option value="monthly" {{ ( $Candidate->salary_type == 'monthly') ? 'selected' : '' }}>monthly</option>
                                                            <option value="annually" {{ ( $Candidate->salary_type == 'annually') ? 'selected' : '' }}>annually</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <br>
                                        <a href="{{route('candidate.view.skills.details')}}"><button type="button" class="form-submit">Back</button></a>
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
    $("#curr_sign").change(function(){
        if($(this).val() == "USD")
        {
            $(".currecny_sign").text('$');
            $("#hidd_curr_sign").val('$');
        }
        else if($(this).val() == "CAD")
        {
            $(".currecny_sign").text('C$');
            $("#hidd_curr_sign").val('C$');
        }
        else if($(this).val() == "GBP")
        {
            $(".currecny_sign").text('£');
            $("#hidd_curr_sign").val('£');
        }
        else if($(this).val() == "AUD")
        {
            $(".currecny_sign").text('A$');
            $("#hidd_curr_sign").val('A$');
        }
        else
        {
            $(".currecny_sign").text('€');
            $("#hidd_curr_sign").val('€');
        }
    });
    $("#add_range").click(function () {
        $("#add_range").hide();
        $(".div_package_to").show();
    });
    $(document).ready(function () {
        /*Bcz in textarea space did'nt working */
            $("#form_profile").validate({
                // ignore:[],
                rules: {

                    package: {
                        required: true,
                        currencyvalidation: true,
                        minlength: 1,
                        maxlength: 20
                        // positivedigit:true,
                    },
                    package_to: {
                        currencyvalidation: true,
                        // greaterThan: true,
                        greaterThanPackage: '#package',
                        maxlength: 20
                        // positivedigit:true,
                    },
                },
                // Specify validation error messages
                messages: {
                    package:{
                        required: "Salary is required.",
                        currencyvalidation: "Salary should be in valid format.",
                        minlength: "Salary must be at least 1 characters long.",
                        maxlength: "Salary must be less than 20 characters long."
                        // positivedigit:"Salary must be positive.",
                    } ,
                    package_to:{
                        currencyvalidation: "Salary should be in valid format.",
                        // greaterThan: "Maximum salary range must be greater than minimum salary.",
                        greaterThanPackage: "Maximum salary range must be greater than minimum salary.",
                        maxlength: "Salary must be less than 20 characters long."
                        // positivedigit:"Salary must be positive.",
                    } ,

                },

                submitHandler: function(form) {
                    form.submit();
                }

            });

    });
</script>

@endsection
