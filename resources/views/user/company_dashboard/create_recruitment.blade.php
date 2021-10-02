@extends('layouts.user_layout')

@section('title' , 'Recruitment Services')

@section('content')
    <!--// Main Banner \\-->
    <div class="mm-subheader"><h1>Recruitment Services</h1></div>
    <!--// Main Banner \\-->

    <!--// Main Content \\-->
    <div class="motivz-main-content">

        <!--// Main Section \\-->
        <div class="motivz-main-section">
            <div class="container">
                <div class="row">
                    @include('user.include.client_side_bar')
                    <div class="col-md-9">
                        <div class="mm-motivz-jobdetail-content">
                            @if( session()->has('success') )
                                <div style="text-align: center" class="alert alert-success">
                                    {{ session()->get('success') }}
                                </div>
                            @endif
                            <h2 class="form-title">Submit Recruitment Service</h2>
                            <form id="user-create-job-form" action="{{ route('user.client.recruitment.created') }}" method="post" enctype="multipart/form-data">
                                @csrf

                                <input type="hidden" name="company_name" value="{{ session('c_email.id') }}">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Job Title</label>
                                            <input name="jobtitle" type="text" class="form-control" placeholder="" value="{{old('jobtitle')}}">
                                        </div>
                                        @error('jobtitle')
                                        <label id="jobtitle-error" class="error" for="jobtitle">{{$message}}</label>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Education</label>
                                            <select name="education" id="" class="form-control">
                                                <option value="" selected disabled>Select Education</option>
                                                @foreach($Education as $education)
                                                    <option value="{{$education->id}}">{{$education->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('education')
                                        <label id="education-error" class="error" for="education">{{$message}}</label>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Job Location</label>
                                            <input name="location" id="location" type="text" class="form-control" placeholder="" value="{{old('location')}}">
                                        </div>
                                        @error('location')
                                        <label id="location-error" class="error" for="location">{{$message}}</label>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Website Address <small>(http://www.example.com)</small></label>
                                            <input name="web_url" type="text" class="form-control" placeholder="" value="{{old('web_url')}}">
                                        </div>
                                        @error('web_url')
                                        <label id="web_url-error" class="error" for="web_url">{{$message}}</label>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Enter your desired pay</label>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text currecny_sign" id="inputGroup-sizing-default" style="width: auto; margin: 0px;">$</span>
                                                        </div>
                                                        <input name="package" id="package" type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" placeholder="" value="" >
                                                    </div>
                                                </div>
                                                @error('package')
                                                <label id="package-error" class="error" for="package">{{$message}}</label>
                                                @enderror
                                                <div class="col-md-4">
                                                    <span id="add_range" style="  display: block; text-align: center;margin: 12px 0px 0px;font-size: 17px;font-weight: 600;cursor: pointer; width: 85%;">+ Add Range</span>
                                                    <div class="input-group mb-3 div_package_to" style="display:none">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text currecny_sign" id="inputGroup-sizing-default" style="width: auto; margin: 0px;">$</span>
                                                            <input type="hidden" id="hidd_curr_sign" name="hidd_curr_sign" value="$">
                                                        </div>
                                                        <input name="package_to" id="package_to" type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" placeholder="To" value="" >
                                                    </div>
                                                </div>
                                                @error('package_to')
                                                <label id="package_to-error" class="error" for="package_to">{{$message}}</label>
                                                @enderror
                                                <div class="col-md-2">
                                                    <div class="input-group mb-3 div_package_to" >
                                                        <select style="font-size: 12px;" name="curr_sign" id="curr_sign" class="form-control">
                                                            <option value="USD"  >USD</option>
                                                            <option value="CAD" >CAD</option>
                                                            <option value="GBP" >GBP</option>
                                                            <option value="EUR" >EUR</option>
                                                            <option value="AUD" >AUD</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="input-group mb-3 div_package_to">
                                                        <select style="font-size: 12px;" name="salary_duration" id="salary_duration" class="form-control">
                                                            <option value="Per Hour" >Per Hour</option>
                                                            <option value="Per Day" >Per Day</option>
                                                            <option value="Per Week" >Per Week</option>
                                                            <option value="Per Month" >Per Month</option>
                                                            <option value="Per Year" >Per Year</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Type of Industry</label>
                                            <select name="industry" id="" class="form-control">
                                                <option value="" selected disabled>Select Industry</option>
                                                @foreach($industries as $industry)
                                                    <option value="{{$industry->id}}">{{$industry->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('industry')
                                        <label id="industry-error" class="error" for="industry">{{$message}}</label>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Type of service needed</label>
                                            <select name="service" id="" class="form-control">
                                                <option value="" selected disabled>Select Service Type</option>
                                                <option value="Direct" @if(old('service')=='Direct') selected @endif>Direct Placement</option>
                                                <option value="Temporary" @if(old('service')=='Temporary') selected @endif>Temporary Staffing</option>
                                            </select>
                                        </div>
                                        @error('service')
                                        <label id="service-error" class="error" for="service">{{$message}}</label>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Job Description</label>
                                            <textarea name="job_discription" class="form-control">{{old('job_discription')}}</textarea>
                                        </div>
                                        @error('job_discription')
                                        <label id="job_discription-error" class="error" for="job_discription">{{$message}}</label>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Attach File</label>
                                            <div enctype="multipart/form-data">
                                                <input id="file-upload-demo" name="document" type="file">
                                            </div>
                                        </div>
                                        <label id="file-upload-demo-error" style="display: none;" class="error" for="file-upload-demo">Only docx and pdf files are allowed for document.</label>
                                        @error('document')
                                        <label id="document" class="error" for="document">{{$message}}</label>
                                        @enderror
                                    </div>



                                </div>
                                <button type="submit" class="form-submit">Submit</button>
                                <div class="clearfix"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--// Main Section \\-->

    </div>
    <!--// Main Content \\-->

@stop

@section('script')
    <script type="text/javascript" src="{{ asset('user/script/company/createJob.js') }}"></script>
    <script src="{{asset('user/script/file-input/fileinput.js')}}" type="text/javascript"></script>
    <script src="{{asset('user/script/file-input/theme.js')}}" type="text/javascript"></script>

    <script>
        $('#required_skills').tagsInput({
            width: 'auto',
        });
    </script>
    <script>
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
        // google.maps.event.addDomListener(window, 'load', initialize);
        $("#file-upload-demo").fileinput({
            'theme': 'explorer',
            'uploadUrl': '#',
            overwriteInitial: false,
        });
    });
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
    </script>
{{--    <script type="text/javascript" src="{{ asset('user/script/company/companyProfile.js') }}"></script>--}}

@endsection
