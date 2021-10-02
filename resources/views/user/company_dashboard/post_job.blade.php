@extends('layouts.user_layout')

@section('title' , 'Submit Job Order')

@section('content')
    <!--// Main Banner \\-->
    <div class="mm-subheader"><h1>POST A JOB </h1></div>
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
                            <h2 class="form-title">POST A JOB </h2>
                            <form id="user-create-job-form" action="{{ route('user.client.job.created') }}" method="post">
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
                                    {{--<div class="col-md-6">
                                        <div class="form-group">
                                            <label>State</label>
                                            <input name="state" type="text" class="form-control" placeholder="" value="{{old('state')}}">
                                        </div>
                                        @error('state')
                                        <label id="state-error" class="error" for="state">{{$message}}</label>
                                        @enderror
                                    </div>--}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Website Address <small>(http://www.example.com)</small></label>
                                            <input name="web_url" type="text" class="form-control" placeholder="" value="{{old('web_url')}}">
                                        </div>
                                        @error('web_url')
                                        <label id="web_url-error" class="error" for="web_url">{{$message}}</label>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Industry</label>
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
                                            <label>Job Type</label>
                                            <select name="service" id="" class="form-control">
                                                <option value="" selected disabled>Select Job Type</option>
                                                <option value="Full-Time" @if(old('service')=='Full-Time') selected @endif>Full-Time</option>
                                                <option value="Part-Time" @if(old('service')=='Part-Time') selected @endif>Part-Time</option>
                                                <option value="Contract" @if(old('service')=='Contract') selected @endif>Contract</option>
                                                <option value="Contract to Hire" @if(old('service')=='Contract to Hire') selected @endif>Contract to Hire</option>
                                                <option value="Seasonal" @if(old('service')=='Seasonal') selected @endif>Seasonal</option>
                                                <option value="Internship" @if(old('service')=='Internship') selected @endif>Internship</option>
                                            </select>
                                        </div>
                                        @error('service')
                                        <label id="service-error" class="error" for="service">{{$message}}</label>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Compensation</label>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text currecny_sign" id="inputGroup-sizing-default">$</span>
                                                        </div>
                                                        <input name="package" id="package" type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" placeholder="" value="{{old('package')}}" >
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <span id="add_range" style="display: block;text-align: center;margin: 12px 0px 0px;font-size: 17px;font-weight: 600;cursor: pointer;">+ Add Range</span>
                                                    <div class="input-group mb-3 div_package_to" style="display: none" >
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text currecny_sign" id="inputGroup-sizing-default">$</span>
                                                            <input type="hidden" id="hidd_curr_sign" name="hidd_curr_sign" value="$">
                                                        </div>
                                                        <input name="package_to" id="package_to" type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" placeholder="To" value="{{old('package_to')}}" >
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="input-group mb-3 div_package_to" >
                                                        <select style="font-size: 13px;" name="curr_sign" id="curr_sign" class="form-control">
                                                            <option value="USD" @if(old('curr_sign')=='USD') selected @endif>USD</option>
                                                            <option value="CAD" @if(old('curr_sign')=='CAD') selected @endif>CAD</option>
                                                            <option value="GBP" @if(old('curr_sign')=='GBP') selected @endif>GBP</option>
                                                            <option value="EUR" @if(old('curr_sign')=='EUR') selected @endif>EUR</option>
                                                            <option value="AUD" @if(old('curr_sign')=='AUD') selected @endif>AUD</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="input-group mb-3 div_package_to">
                                                        <select style="font-size: 13px;" name="salary_duration" id="salary_duration" class="form-control">
                                                            <option value="Per Hour">Per Hour</option>
                                                            <option value="Per Day">Per Day</option>
                                                            <option value="Per Week">Per Week</option>
                                                            <option value="Per Month">Per Month</option>
                                                            <option value="Per Year">Per Year</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        @error('package')
                                        <label id="package-error" class="error" for="package">{{$message}}</label>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Job Descriptions</label>
                                            <textarea name="job_discription" id="job_discription" class="form-control" placeholder="Briefly summarize this position..."></textarea>
                                        </div>
                                        <label id="job_discription-error" class="error" for="job_discription" style="display: none" ></label>
                                        @error('job_discription')
                                        <label id="job_discription-error" class="error" for="job_discription">{{$message}}</label>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Job Benefits</label>
                                            <input type="text" name="job_benefits" id="job_benefits" data-role="tagsinput" class="tags_1 form-control" placeholder="Use comma to separate benefits" value="{{old('job_benefits')}}">
                                        </div>
                                        <label id="job_benefits-error" class="error" for="job_benefits" style="display: none" ></label>
                                        @error('job_benefits')
                                        <label id="job_benefits-error" class="error" for="job_benefits">{{$message}}</label>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Required Skills</label>
                                            <input name="required_skills" data-role="tagsinput" id="required_skills" type="text" class="tags_1 tags form-control" placeholder="Use comma to separate skills" value="{{old('required_skills')}}">
                                        </div>
                                        <label id="required_skills-error" class="error" for="required_skills" style="display: none" ></label>
                                        @error('required_skills')
                                        <label id="required_skills-error" class="error" for="required_skills">{{$message}}</label>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Licensure/Certification</label>
                                            <input name="required_certification" data-role="tagsinput" id="required_certification" type="text" class="tags_1 tags form-control" placeholder="Use comma to separate certification" value="{{old('required_certification')}}">
                                        </div>
                                        <label id="required_certification-error" class="error" for="required_certification" style="display: none" ></label>
                                        @error('required_certification')
                                        <label id="required_certification-error" class="error" for="required_certification">{{$message}}</label>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Experience Level</label>
                                            <select name="required_experience" id="" class="form-control">
                                                <option value="" selected disabled>Select Experience</option>
                                                <option value="Intern" @if(old('required_experience')=='Intern') selected @endif>Intern</option>
                                                <option value="Entry Level" @if(old('required_experience')=='Entry Level') selected @endif>Entry Level</option>
                                                <option value="Intermediate" @if(old('required_experience')=='Intermediate') selected @endif>Intermediate</option>
                                                <option value="Experienced" @if(old('required_experience')=='Experienced') selected @endif>Experienced</option>
                                                <option value="Managerial" @if(old('required_experience')=='Managerial') selected @endif>Managerial</option>
                                                <option value="Directorship" @if(old('required_experience')=='Directorship') selected @endif>Directorship</option>
                                                <option value="Executive" @if(old('required_experience')=='Executive') selected @endif>Executive</option>
                                                <option value="Senior Executive" @if(old('required_experience')=='Senior Executive') selected @endif>Senior Executive</option>
                                            </select>
                                        </div>
                                        @error('required_experience')
                                        <label id="required_experience-error" class="error" for="required_experience">{{$message}}</label>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Number of Hires</label>
                                                <select name="num_hires" id="" class="form-control">
                                                <option value="" selected disabled>Select Number of Hires</option>
                                                <option value="1" @if(old('num_hires')=='1') selected @endif>1</option>
                                                <option value="2" @if(old('num_hires')=='2') selected @endif>2</option>
                                                <option value="3" @if(old('num_hires')=='3') selected @endif>3</option>
                                                <option value="4" @if(old('num_hires')=='4') selected @endif>4</option>
                                                <option value="5" @if(old('num_hires')=='5') selected @endif>5</option>
                                                <option value="6" @if(old('num_hires')=='6') selected @endif>6</option>
                                                <option value="7" @if(old('num_hires')=='7') selected @endif>7</option>
                                                <option value="8" @if(old('num_hires')=='8') selected @endif>8</option>
                                                <option value="9" @if(old('num_hires')=='9') selected @endif>9</option>
                                                <option value="10+" @if(old('num_hires')=='10+') selected @endif>10+</option>
                                            </select>
                                        </div>
                                        @error('num_hires')
                                        <label id="num_hires-error" class="error" for="num_hires">{{$message}}</label>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Apply Before</label>
                                            <input name="applied_before" type="date" class="form-control" placeholder="DD-MM-YYYY" value="{{old('applied_before')}}">
                                        </div>
                                        @error('applied_before')
                                        <label id="applied_before-error" class="error" for="applied_before">{{$message}}</label>
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
    <script src="https://cdn.ckeditor.com/ckeditor5/11.2.0/classic/ckeditor.js"></script>
    <script src="https://ckeditor.com/apps/ckfinder/3.5.0/ckfinder.js"></script>
    <script type="text/javascript" src="{{ asset('user/script/company/postJob.js') }}"></script>
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

        var editor = null;
        ClassicEditor.create(document.querySelector("#job_discription"), {
            toolbar: [
                "heading",
                "fontFamily",
                "|",
                "bold",
                "italic",
                "link",
                "bulletedList",
                "numberedList",
                "imageUpload",
                "blockQuote",
                "undo",
                "redo",
                "imageStyle:full",
                "imageStyle:side",
                "|",
                "imageTextAlternative",
                "contenteditable",
                // "tableColumn",
            ],
        });
        $('#required_skills').tagsInput({
            width: 'auto',
            defaultText: 'Use comma to separate skills',
        });
        $('#required_certification').tagsInput({
            width: 'auto',
            defaultText: 'Use comma to separate Certifications',
        });
        $('#job_benefits').tagsInput({
            width: 'auto',
            defaultText: 'Use comma to separate benefits',
        });

        $("#add_range").click(function () {
            $("#add_range").hide();
            $(".div_package_to").show();
        });
    </script>

@endsection
