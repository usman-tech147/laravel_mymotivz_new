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
                                    <li><span class="fa fa-bar-chart"></span><br><small>Qualifications</small></li>
                                    <li class="active active-page"><span class="fa fa-money"></span><br><small>Job Pay & Benefits</small></li>
                                </ul>
                            </div>

                            <!-- <h2 class="form-title">Personal Details</h2> -->
                            <form action="#" id="job_benefits_form" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-title-wrap">
                                            <h2>THE COMPENSATION</h2>
                                            <h3>Set pay ranges and job benefits</h3>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Compensation</label>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text currecny_sign"
                                                                  id="inputGroup-sizing-default">$</span>
                                                        </div>
                                                        <input name="package" id="package" type="text"
                                                               class="form-control" aria-label="Default"
                                                               aria-describedby="inputGroup-sizing-default"
                                                               placeholder="From" value="{{$job->package}}">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <span id="add_range"
                                                          style="  display: block;   text-align: center;margin: 12px 0px 0px;font-size: 17px;font-weight: 600;cursor: pointer;">+ Add Range</span>
                                                    <div class="input-group mb-3 div_package_to" style="display: none">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text currecny_sign"
                                                                  id="inputGroup-sizing-default">$</span>
                                                            <input type="hidden" id="hidd_curr_sign"
                                                                   name="hidd_curr_sign" value="$">
                                                        </div>
                                                        <input name="package_to" id="package_to" type="text"
                                                               class="form-control" aria-label="Default"
                                                               aria-describedby="inputGroup-sizing-default"
                                                               placeholder="To" value="{{old('package_to')}}">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="input-group mb-3 div_package_to">
                                                        <select style="font-size: 12px;" name="curr_sign" id="curr_sign"
                                                                class="form-control">
                                                            <option value="USD"
                                                                    @if(old('curr_sign')=='USD') selected @endif>USD
                                                            </option>
                                                            <option value="CAD"
                                                                    @if(old('curr_sign')=='CAD') selected @endif>CAD
                                                            </option>
                                                            <option value="GBP"
                                                                    @if(old('curr_sign')=='GBP') selected @endif>GBP
                                                            </option>
                                                            <option value="EUR"
                                                                    @if(old('curr_sign')=='EUR') selected @endif>EUR
                                                            </option>
                                                            <option value="AUD"
                                                                    @if(old('curr_sign')=='AUD') selected @endif>AUD
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="input-group mb-3 div_package_to">
                                                        <select style="font-size: 12px;" name="salary_duration"
                                                                id="salary_duration" class="form-control">
                                                            <option value="hourly" @if($job->package_type == "hourly") selected @endif>hourly</option>
                                                            <option value="daily" @if($job->package_type == "hourly") selected @endif>daily</option>
                                                            <option value="weekly" @if($job->package_type == "hourly") selected @endif>weekly</option>
                                                            <option value="monthly" @if($job->package_type == "hourly") selected @endif>monthly</option>
                                                            <option value="annually" @if($job->package_type == "hourly") selected @endif>annually</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Job Benefits (Optional)</label>
                                            <input type="text" name="job_benefits" id="job_benefits" class="tags_1 tags form-control"
                                                   placeholder="Use comma or enter to separate benefits" value="{{$job->job_benefits}}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <br>
                                        <button href="#" class="form-submit">Back</button>
                                        <button type="submit" class="pull-right form-submit">SUBMIT FOR REVIEW </button>
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
        $("#add_range").click(function () {
            $("#add_range").hide();
            $(".div_package_to").show();
        });
        $(function () {
            $('#job_benefits').tagsInput({
                width: '100%',
                defaultText: 'Use comma or enter to separate'
            });
        });
        $("#curr_sign").change(function () {
            if ($(this).val() == "USD") {
                $(".currecny_sign").text('$');
                $("#hidd_curr_sign").val('$');
            } else if ($(this).val() == "CAD") {
                $(".currecny_sign").text('C$');
                $("#hidd_curr_sign").val('C$');
            } else if ($(this).val() == "GBP") {
                $(".currecny_sign").text('£');
                $("#hidd_curr_sign").val('£');
            } else if ($(this).val() == "AUD") {
                $(".currecny_sign").text('A$');
                $("#hidd_curr_sign").val('A$');
            } else {
                $(".currecny_sign").text('€');
                $("#hidd_curr_sign").val('€');
            }
        });
        $( document ).ready(function() {
            $("#job_benefits_form").validate({
                rules: {
                    package: {
                        required: true,
                        currencyvalidation: true,
                        minlength: 1,
                        maxlength: 20
                    },
                    package_to: {
                        currencyvalidation: true,
                        greaterThanPackage: '#package',
                        maxlength: 20
                    },
                    job_benefits: {
                        minlength: 2,
                        maxlength: 1000
                    },
                },
                messages: {
                    package: {
                        required: "Salary is required.",
                        currencyvalidation: "Salary should be in valid format.",
                        minlength: "Salary must be at least 1 characters long.",
                        maxlength: "Salary must be less than 20 characters long."
                    },
                    package_to: {
                        currencyvalidation: "Salary should be in valid format.",
                        greaterThanPackage: "Maximum salary range must be greater than minimum salary.",
                        maxlength: "Salary must be less than 20 characters long."
                    },
                    job_benefits: {
                        minlength: "Job benefits must be at least 2 characters long.",
                        maxlength: "Job benefits must be less than 1000 characters long."
                    },
                },
                submitHandler: function(form) {
                    form.submit();
                }

            });
        });
    </script>

@endsection
