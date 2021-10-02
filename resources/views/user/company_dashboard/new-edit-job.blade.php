@extends('layouts.company')

@section('content')
    <div class="app-main__inner">
        @if( session()->has('success') )
            <div style="text-align: center" class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->get('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="card-header-tab card-header">
            <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><i class="pe-7s-next-2 mr-3 text-muted opacity-6" style="font-size: 35px; color: #4d9a10 !important;"> </i>Edit Job Details</div>
        </div>
        <div class="tabs-animation">
            <div class="row">
                <div class="col-md-12">

                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <form id="user-create-job-form" action="{{route('user.edit.job.details',[$job->id])}}" method="post">
                                @csrf
                                @method('put')
                                <input type="hidden" name="company_name" value="{{ session('c_email.id') }}">

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Job Title</label>
                                            <input name="jobtitle" type="text" class="form-control" placeholder="" value="{{$job->job_title}}">
                                        </div>
                                        <label id="jobtitle-error" style="display: none" class="error" for="jobtitle"></label>
                                        @error('jobtitle')
                                        <label id="jobtitle-error" class="error" for="jobtitle">{{$message}}</label>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Education</label>
                                            <select name="education" class="form-control">
                                                <option value="" selected disabled>Select Education</option>
                                                @foreach($Education as $education)
                                                    <option value="{{$education->id}}" @if($job->education_id==$education->id) selected @endif>{{$education->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <label id="education-error" style="display: none" class="error" for="education"></label>
                                        @error('education')
                                        <label id="education-error" class="error" for="education">{{$message}}</label>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Job Location</label>
                                            <input name="location" id="location" type="text" class="form-control" placeholder="" value="{{$job->location}}">


                                        </div>
                                        <label id="location-error" style="display: none" class="error" for="location"></label>
                                        @error('city')
                                        <label id="location-error" class="error" for="location">{{$message}}</label>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Website Address <small>(http://www.example.com)</small></label>
                                            <input name="web_url" type="text" class="form-control" placeholder="" value="{{$job->web_url}}">
                                        </div>
                                        <label id="web_url-error" style="display: none" class="error" for="web_url"></label>
                                        @error('web_url')
                                        <label id="web_url-error" class="error" for="web_url">{{$message}}</label>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Industry</label>
                                            <select name="industry" class="form-control">
                                                <option value="" selected disabled>Select Industry</option>
                                                @foreach($industries as $industry)
                                                    <option value="{{$industry->id}}" @if($job->industry_id==$industry->id) selected @endif>{{$industry->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <label id="industry-error" style="display: none" class="error" for="industry"></label>
                                        @error('package')
                                        <label id="industry-error" class="error" for="industry">{{$message}}</label>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Job Type</label>
                                            <select name="service" class="form-control">
                                                <option value="" selected disabled>Select Job Type</option>
                                                <option value="Full-Time" {{ ( $job->service == 'Full-Time') ? 'selected' : '' }}>Full-Time</option>
                                                <option value="Part-Time" {{ ( $job->service == 'Part-Time') ? 'selected' : '' }}>Part-Time</option>
                                                <option value="Contract" {{ ( $job->service == 'Contract') ? 'selected' : '' }}>Contract</option>
                                                <option value="Contract to Hire" {{ ( $job->service == 'Contract to Hire') ? 'selected' : '' }}>Contract</option>
                                                <option value="Seasonal"{{ ( $job->service == 'Seasonal') ? 'selected' : '' }}>Seasonal</option>
                                                <option value="Internship" {{ ( $job->service == 'Internship') ? 'selected' : '' }}>Internship</option>
                                            </select>
                                        </div>
                                        <label id="service-error" class="error" style="display: none" for="service"></label>
                                        @error('service')
                                        <label id="service-error" class="error" for="service">{{$message}}</label>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
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
                                        <label id="required_experience-error" style="display: none" class="error" for="required_experience"></label>
                                        @error('required_experience')
                                        <label id="required_experience-error" class="error" for="required_experience">{{$message}}</label>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
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
                                        <label id="num_hires-error" style="display: none" class="error" for="num_hires"></label>
                                        @error('num_hires')
                                        <label id="num_hires-error" class="error" for="num_hires">{{$message}}</label>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Apply Before</label>
                                            <input name="applied_before" type="date"  class="form-control" value="{{$job->applied_before}}">
                                        </div>
                                        <label id="applied_before-error" class="error" style="display: none" for="applied_before"></label>
                                        @error('applied_before')
                                        <label id="applied_before-error" class="error" for="applied_before">{{$message}}</label>
                                        @enderror
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label>Compesation</label>
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
                                                    <span id="add_range" style="  @if(empty($job['package_to'])) display: block ;@else display: none @endif ;  text-align: center;margin: 12px 0px 0px;font-size: 17px;font-weight: 600;cursor: pointer;">+ Add Range</span>
                                                    <div class="input-group mb-3 div_package_to" @if(empty($job['package_to'])) style="display: none" @endif >
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text currecny_sign" id="inputGroup-sizing-default">{{$job->package_sign}}</span>
                                                            <input type="hidden" id="hidd_curr_sign" name="hidd_curr_sign" value="{{$job->package_sign}}">
                                                        </div>
                                                        <input name="package_to" id="package_to" type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" placeholder="To" value="{{$job->package_to}}" >
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="input-group mb-3 div_package_to" >
                                                        <select style="font-size: 12px;" name="curr_sign" id="curr_sign" class="form-control">
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
                                                        <select style="font-size: 12px;" name="salary_duration" id="salary_duration" class="form-control">
                                                            <option value="hourly" {{ ( $job->package_type == 'hourly') ? 'selected' : '' }}>hourly</option>
                                                            <option value="daily" {{ ( $job->package_type == 'daily') ? 'selected' : '' }}>daily</option>
                                                            <option value="weekly" {{ ( $job->package_type == 'weekly') ? 'selected' : '' }}>weekly</option>
                                                            <option value="monthly" {{ ( $job->package_type == 'monthly') ? 'selected' : '' }}>monthly</option>
                                                            <option value="annually" {{ ( $job->package_type == 'annually') ? 'selected' : '' }}>annually</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Job Benefits (Optional)</label>
                                            <input type="text" name="job_benefits" id="job_benefits" data-role="tagsinput" class="tags_1 form-control" value="{{$job->job_benefits}}">
                                        </div>
                                        <label id="job_benefits-error" class="error" for="job_benefits" style="display: none"></label>
                                        @error('job_benefits')
                                        <label id="job_benefits-error" class="error" for="job_benefits">{{$message}}</label>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Required Skills (Optional)</label>
                                            <input type="text" name="required_skills" id="required_skills" class="tags_1 tags form-control" value="{{$job->required_skills}}">
                                        </div>
                                        <label id="required_skills-error" class="error" for="required_skills" style="display: none"></label>
                                        @error('required_skills')
                                        <label id="required_skills-error" class="error" for="required_skills">{{$message}}</label>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Licensure/Certification (Optional)</label>
                                            <input name="required_certification" type="text"  id="required_certification" class="tags_1 tags form-control" value="{{$job->certifications}}">
                                        </div>
                                        <label id="required_certification-error" class="error" for="required_certification" style="display: none"></label>
                                        @error('required_certification')
                                        <label id="required_certification-error" class="error" for="required_certification" >{{$message}}</label>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Job Descriptions (Optional)</label>
                                            <textarea name="job_discription" id="job_discription" class="form-control" placeholder="Briefly summarize this position...">{{$job->job_description}}</textarea>
                                        </div>
                                        <label id="job_discription-error" class="error" for="job_discription" style="display: none" ></label>
                                        @error('job_discription')
                                        <label id="job_discription-error" class="error" for="job_discription">{{$message}}</label>
                                        @enderror
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary pull-right">Update</button>
                                <div class="clearfix"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')

    <script>
        var editor = null;
        ClassicEditor.create(document.querySelector("#job_discription"), {
            heading: {
                options: [
                    { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                    { model: 'heading3', view: 'h3', title: 'Heading', class: 'ck-heading_heading3' },
                ]
            },
            toolbar: {
                items:[
                    "heading",
                    "fontFamily",
                    "|",
                    "bold",
                    "italic",
                    "link",
                    "bulletedList",
                    "numberedList",
                    "blockQuote",
                    "undo",
                    "redo",
                    "|",
                    "contenteditable",
                    // "tableColumn",
                ],
            },
        });
    </script>
    <script>
        $(document).ready(function () {
            $("#file-upload-demo,#file-upload").fileinput({
                'theme': 'explorer',
                // 'uploadUrl': '#',
                overwriteInitial: false,
            });
        });
        $(function () {
            $('#interest').tagsInput({
                width: '100%',
                defaultText: 'Use comma or enter to separate'
            });
            $('#required_skills').tagsInput({
                width: '100%',
                defaultText: 'Use comma or enter to separate'

            });
            $('#required_certification').tagsInput({
                width: '100%',
                defaultText: 'Use comma or enter to separate'

            });
            // $('#location').tagsInput({
            //     width: 'auto',
            //     defaultText: 'Use comma or enter to separate locations'
            // });
            $('#job_benefits').tagsInput({
                width: '100%',
                defaultText: 'Use comma or enter to separate'

            });
        });
    </script>
    <script>

//        function initialize() {
//            var input = document.getElementById('location');
//            var options = {
//                types: ['(regions)'] //this should work !
//            };
//
//            var autocomplete = new google.maps.places.Autocomplete(input, options);
//            autocomplete.setComponentRestrictions(
//                {'country': ['us']});
//        }
//        google.maps.event.addDomListener(window, 'load', initialize);

        var editor = null;

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


        $( document ).ready(function() {
            $('#apply_before').datepicker({
                dateFormat: "yy-mm-dd",
                minDate: new Date()
            });
            $("#user-create-job-form").validate({
                ignore: [],
                rules: {
                    jobtitle: {
                        required: true,
                        alphanumericspace: true,
                        minlength: 2,
                        maxlength:255
                    } ,
                    education:{
                        required: true,
                    } ,
                    location:{
                        required: true,
                        locationvalidation: true,
                        // minlength: 2,
                        maxlength:255
                    } ,
                    /*state:{
                        required: true,
                        alpha_space: true,
                        minlength: 2,
                        maxlength:255
                    } ,*/
                    web_url: {
                        required: true,
                        validUrl: true
                    },
                    package:{
                        required: true,
                        currencyvalidation: true,
                        minlength: 1,
                        maxlength: 20
                        // positivedigit:true,
                    } ,
                    package_to:{
                        currencyvalidation: true,
                        // greaterThan:true,
                        greaterThanPackage: '#package',
                        maxlength: 20
                        // positivedigit:true,
                    } ,
                    salary_duration:{
                        required: true,
                    },
                    industry:{
                        required: true,
                    } ,
                    service:{
                        required: true,

                    },
                    job_discription:{
                        ckrequired: false,
                        // maxlength:1000
                    } ,
                    job_benefits: {
                        // required: true,
                        minlength: 2,
                        maxlength:1000
                    } ,
                    required_skills: {
                        // required: true,
                        minlength: 2,
                        maxlength:1000
                    } ,
                    required_certification: {
                        // required: true,
                        minlength: 2,
                        maxlength:1000
                    },
                    required_experience: {
                        required: true,
                    } ,
                    num_hires: {
                        required: true,
                    } ,
                    applied_before: {
                        required: true,
                        date: true,
                        greaterThanToday:  "#apply_before"
                    },
                    currency: {
                        required: true,
                        currency: true
                    } ,

                },
                messages: {
                    jobtitle: {
                        required: "Job title is required.",
                        minlength: "Job title  must be at least 2 characters long.",
                        maxlength: "Job title  must be less than 255 characters long.",
                        // alpha_space:"Letters only."
                    } ,
                    education:{
                        required: "Education is required.",
                    } ,
                    location:{
                        required: "Job location is required.",
                        locationvalidation: "Job location must be in valid format.",
                        // minlength: "Job location must be at least 2 characters long.",
                        maxlength: "Job location must be less than 255 characters long."
                    } ,
                    web_url: {
                        required: "Website url is required.",
                        url: "Please enter valid url."
                    },
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
                    salary_duration:{
                        required: "Salary duration is required",
                    },
                    industry:{
                        required: "Type of industry is required.",

                    } ,
                    service:{
                        required: "Please select service from dropdown."
                    },
                    job_discription:{
                        ckrequired: "Job description is required.",
                        // maxlength: "Job description must be less than 1000 characters long."
                    } ,
                    job_benefits: {
                        // required: "Job benefits are required.",
                        minlength: "Job benefits must be at least 2 characters long.",
                        maxlength: "Job benefits must be less than 1000 characters long."
                    } ,
                    required_skills: {
                        // required: "Skills are required.",
                        minlength: "Skills must be at least 2 characters long.",
                        maxlength: "Skills must be less than 1000 characters long."
                    } ,
                    required_certification: {
                        // required: "Licensure/Certification are required.",
                        minlength: "Licensure/Certification must be at least 2 characters long.",
                        maxlength: "Licensure/Certification must be less than 1000 characters long."
                    } ,
                    required_experience: {
                        required: "Select the required experience.",
                    } ,
                    num_hires: {
                        required: "Select the Number of Hires.",
                    } ,
                    applied_before: {
                        required: "Select the Apply Before date.",
                        date: "Select valid date.",
                        greaterThanToday: "Apply before date should must be a date after today."
                    },
                    currency: {
                        required: "Currency is required.",
                        currency: "A valid currency sign is required."
                    } ,
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });

            // jQuery.validator.addMethod("greaterThanToday",
            //     function(value, element, params) {
            //         var date1 = new Date(value)
            //         var date2 = new Date()
            //         return date1.getTime() > date2.getTime();
            //
            //     });

            // jQuery.validator.addMethod("greaterThanPackage",
            //     function (value, element, params) {
            //         if (value === "" || (parseFloat(value) > parseFloat($(params).val()))) {
            //             return true;
            //         }
            //         return false;
            //     });


            $('#user-create-job-form').find('#location').keypress(function(e){
                if ( e.which == 13 ) // Enter key = keycode 13
                {
                    $(this).next().focus();  //Use whatever selector necessary to focus the 'next' input
                    return false;
                }
            });

        });

    </script>
    <script type="text/javascript" src="{{ asset('user/script/company/companyProfile.js') }}"></script>
@endsection
