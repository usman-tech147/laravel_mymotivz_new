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
                            <form action="#" name="profile_form" id="form_profile" enctype="multipart/form-data">
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
                                                               placeholder="From" value="{{old('package')}}">
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
                                                            <option value="hourly">hourly</option>
                                                            <option value="daily">daily</option>
                                                            <option value="weekly">weekly</option>
                                                            <option value="monthly">monthly</option>
                                                            <option value="annually">annually</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Job Benefits (Optional)</label>
                                            <input type="text" name="job_benefits" id="job_benefits" class="tags_1 tags form-control" placeholder="Use comma or enter to separate benefits" value="{{old('job_benefits')}}">
                                        </div>
                                    </div>
                                    <div class="col-md-12"><br><a href="/employeer/view-job-details" class="pull-right form-submit">SUBMIT FOR REVIEW </a></div>
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
