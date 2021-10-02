@extends('layouts.user_layout')

@section('title' , 'Submit Job Order')

@section('content')
    <!--// Main Banner \\-->
    <div class="mm-subheader"><h1>Submit Job Order</h1></div>
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
                            <h2 class="form-title">Submit Job Order</h2>
                            <form id="user-create-job-form" action="{{route('user.edit.job.details',[$job->id])}}" method="post">
                                @csrf
                                @method('put')
                                <input type="hidden" name="company_name" value="{{ session('c_email.id') }}">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Job Title</label>
                                            <input name="jobtitle" type="text" class="form-control" placeholder="" value="{{$job->job_title}}">
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
                                                    <option value="{{$education->id}}" @if($job->education_id==$education->id) selected @endif>{{$education->name}}</option>
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
                                            <input name="location" id="location" type="text" class="form-control" placeholder="" value="{{$job->location}}">
                                        </div>
                                        @error('city')
                                        <label id="city-error" class="error" for="city">{{$message}}</label>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Website address <small>(http://www.example.com)</small></label>
                                            <input name="web_url" type="text" class="form-control" placeholder="" value="{{$job->web_url}}">
                                        </div>
                                        @error('web_url')
                                        <label id="web_url-error" class="error" for="web_url">{{$message}}</label>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Compensation</label>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text currecny_sign" id="inputGroup-sizing-default">{{$job->package_sign}}</span>
                                                        </div>
                                                        <input name="package" id="package" type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" placeholder="" value="{{$job->package}}" >
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <span id="add_range" style=" @if(empty($job['package_to'])) display: block; @else display: none;  @endif text-align: center;margin: 12px 0px 0px;font-size: 17px;font-weight: 600;cursor: pointer;">+ Add Range</span>
                                                    <div class="input-group mb-3 div_package_to" @if(empty($job['package_to'])) style="display: none" @endif>
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text currecny_sign" id="inputGroup-sizing-default">{{$job->package_sign}}</span>
                                                            <input type="hidden" id="hidd_curr_sign" name="hidd_curr_sign" value="{{$job->package_sign}}">
                                                        </div>
                                                        <input name="package_to" id="package_to" type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" placeholder="To" value="{{$job->package_to}}" >
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="input-group mb-3 div_package_to" >
                                                        <select style="font-size: 13px;" name="curr_sign" id="curr_sign" class="form-control">
                                                            <option value="USD" {{ ( $job->package_sign == '$') ? 'selected' : '' }} >USD</option>
                                                            <option value="CAD" {{ ( $job->package_sign == 'C$') ? 'selected' : '' }}>CAD</option>
                                                            <option value="GBP" {{ ( $job->package_sign == '£') ? 'selected' : '' }}>GBP</option>
                                                            <option value="EUR" {{ ( $job->package_sign == '€') ? 'selected' : '' }}>EUR</option>
                                                            <option value="AUD" {{ ( $job->package_sign == 'A$') ? 'selected' : '' }}>AUD</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="input-group mb-3 div_package_to">
                                                        <select style="font-size: 13px;" name="salary_duration" id="salary_duration" class="form-control">
                                                            <option value="Per Hour" {{ ( $job->package_type == 'Per Hour') ? 'selected' : '' }}>Per Hour</option>
                                                            <option value="Per Day" {{ ( $job->package_type == 'Per Day') ? 'selected' : '' }}>Per Day</option>
                                                            <option value="Per Week" {{ ( $job->package_type == 'Per Week') ? 'selected' : '' }}>Per Week</option>
                                                            <option value="Per Month" {{ ( $job->package_type == 'Per Month') ? 'selected' : '' }}>Per Month</option>
                                                            <option value="Per Year" {{ ( $job->package_type == 'Per Year') ? 'selected' : '' }}>Per Year</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @error('education')
                                        <label id="education-error" class="error" for="education">{{$message}}</label>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Industry</label>
                                            <select name="industry" id="" class="form-control">
                                                <option value="" selected disabled>Select Industry</option>
                                                @foreach($industries as $industry)
                                                    <option value="{{$industry->id}}" @if($job->industry_id==$industry->id) selected @endif>{{$industry->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('package')
                                        <label id="industry-error" class="error" for="industry">{{$message}}</label>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Job Type</label>
                                            <select name="service" id="" class="form-control">
                                                <option value="" selected disabled>Select Job Type</option>
                                                <option value="Full-Time" {{ ( $job->service == 'Full-Time') ? 'selected' : '' }}>Full-Time</option>
                                                <option value="Part-Time" {{ ( $job->service == 'Part-Time') ? 'selected' : '' }}>Part-Time</option>
                                                <option value="Contract" {{ ( $job->service == 'Contract') ? 'selected' : '' }}>Contract</option>
                                                <option value="Contract to Hire" {{ ( $job->service == 'Contract to Hire') ? 'selected' : '' }}>Contract</option>
                                                <option value="Seasonal"{{ ( $job->service == 'Seasonal') ? 'selected' : '' }}>Seasonal</option>
                                                <option value="Internship" {{ ( $job->service == 'Internship') ? 'selected' : '' }}>Internship</option>
                                            </select>
                                        </div>
                                        @error('service')
                                        <label id="service-error" class="error" for="service">{{$message}}</label>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Job Descriptions</label>
                                            <textarea name="job_discription" id="job_discription" class="form-control">{{$job->job_description}}</textarea>
                                        </div>
                                        <label id="job_discription-error" class="error" for="job_discription" style="display: none" ></label>
                                        @error('job_discription')
                                        <label id="job_discription-error" class="error" for="job_discription">{{$message}}</label>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Job Benefits</label>
                                            <input type="text" name="job_benefits" id="job_benefits" data-role="tagsinput" class="tags_1 form-control" value="{{$job->job_benefits}}">
                                        </div>
                                        @error('job_benefits')
                                        <label id="job_benefits-error" class="error" for="job_benefits">{{$message}}</label>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Required Skills</label>
                                            <input name="required_skills" data-role="tagsinput" id="required_skills" type="text" class="tags_1 tags form-control" placeholder="" value="{{$job->required_skills}}">
                                        </div>
                                        <label id="required_skills-error" class="error" for="required_skills" style="display: none"></label>
                                        @error('required_skills')
                                        <label id="required_skills-error" class="error" for="required_skills">{{$message}}</label>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Licensure/Certification</label>
                                            <input name="required_certification" data-role="tagsinput" id="required_certification" type="text" class="tags_1 tags form-control" value="{{$job->certifications}}">
                                        </div>
                                        <label id="required_certification-error" class="error" for="required_certification" style="display: none"></label>
                                        @error('required_certification')
                                            <label id="required_certification-error" class="error" for="required_certification" >{{$message}}</label>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Experience Level</label>
                                            <select name="required_experience" id="" class="form-control">
                                                <option value="" style="display: none;"></option>
                                                <option value="Intern" {{ ( $job->required_experience == 'Intern') ? 'selected' : '' }}>Intern</option>
                                                <option value="Entry Level" {{ ( $job->required_experience == 'Entry Level') ? 'selected' : '' }}>Entry Level</option>
                                                <option value="Intermediate" {{ ( $job->required_experience == 'Intermediate') ? 'selected' : '' }}>Intermediate</option>
                                                <option value="Experienced" {{ ( $job->required_experience == 'Experienced') ? 'selected' : '' }}>Experienced</option>
                                                <option value="Managerial" {{ ( $job->required_experience == 'Managerial') ? 'selected' : '' }}>Managerial</option>
                                                <option value="Directorship" {{ ( $job->required_experience == 'Directorship') ? 'selected' : '' }}>Directorship</option>
                                                <option value="Executive" {{ ( $job->required_experience == 'Executive') ? 'selected' : '' }}>Executive</option>
                                                <option value="Senior Executive" {{ ( $job->required_experience == 'Senior Executive') ? 'selected' : '' }}>Senior Executive</option>
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
                                                <option value="1" {{ ( $job->job_opening == '1') ? 'selected' : '' }}>1</option>
                                                <option value="2" {{ ( $job->job_opening == '2') ? 'selected' : '' }}>2</option>
                                                <option value="3" {{ ( $job->job_opening == '3') ? 'selected' : '' }}>3</option>
                                                <option value="4" {{ ( $job->job_opening == '4') ? 'selected' : '' }}>4</option>
                                                <option value="5" {{ ( $job->job_opening == '5') ? 'selected' : '' }}>5</option>
                                                <option value="6" {{ ( $job->job_opening == '6') ? 'selected' : '' }}>6</option>
                                                <option value="7" {{ ( $job->job_opening == '7') ? 'selected' : '' }}>7</option>
                                                <option value="8" {{ ( $job->job_opening == '8') ? 'selected' : '' }}>8</option>
                                                <option value="9" {{ ( $job->job_opening == '9') ? 'selected' : '' }}>9</option>
                                                <option value="10+" {{ ( $job->job_opening == '10+') ? 'selected' : '' }}>10+</option>
                                            </select>
                                        </div>
                                        @error('num_hires')
                                        <label id="num_hires-error" class="error" for="num_hires">{{$message}}</label>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Apply Before</label>
                                            <input name="applied_before" type="date" class="form-control" placeholder="" value="{{$job->applied_before}}">
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
    <script type="text/javascript" src="{{ asset('user/script/company/postJob.js') }}"></script>
    <script>
        $('#job_benefits').tagsInput({
            width: 'auto',
        });
        $('#required_skills').tagsInput({
            width: 'auto',

        });
        $('#required_certification').tagsInput({
            width: 'auto',
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
    <script type="text/javascript" src="{{ asset('user/script/company/companyProfile.js') }}"></script>

@endsection
