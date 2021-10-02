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
            <div class="card-header-title font-size-lg font-weight-normal" style="text-transform: none"><i
                    class="pe-7s-next-2 mr-3 text-muted opacity-6"
                    style="font-size: 35px; color: #4d9a10 !important;"> </i>Post a Job
            </div>
        </div>
        <div class="tabs-animation">
            <div class="row">
                <div class="col-md-12">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <form id="user-create-job-form" action="{{ route('user.client.job.created') }}"
                                  method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="company_name" value="{{ session('c_email.id') }}">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Job Title</label>
                                            <input name="jobtitle" type="text" class="form-control" placeholder="Title"
                                                   value="{{old('jobtitle')}}">
                                        </div>
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
                                                    <option value="{{$education->id}}">{{$education->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('education')
                                        <label id="education-error" class="error" for="education">{{$message}}</label>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Job Location</label>
                                            <input name="location" id="location" value="{{old('location')}}" type="text"
                                                   class="form-control" placeholder="Location">
                                        </div>
                                        @error('location')
                                        <label id="location-error" class="error" for="location">{{$message}}</label>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Website Address <small>(http://www.example.com)</small></label>
                                            <input name="web_url" value="{{old('web_url')}}" type="text"
                                                   class="form-control" placeholder="Website Address">
                                        </div>
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
                                                    <option value="{{$industry->id}}">{{$industry->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('industry')
                                        <label id="industry-error" class="error" for="industry">{{$message}}</label>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Job Type</label>
                                            <select name="service" class="form-control">
                                                <option value="" selected disabled>Select Job Type</option>
                                                <option value="Full-Time"
                                                        @if(old('service')=='Full-Time') selected @endif>Full-Time
                                                </option>
                                                <option value="Part-Time"
                                                        @if(old('service')=='Part-Time') selected @endif>Part-Time
                                                </option>
                                                <option value="Contract"
                                                        @if(old('service')=='Contract') selected @endif>Contract
                                                </option>
                                                <option value="Contract to Hire"
                                                        @if(old('service')=='Contract to Hire') selected @endif>Contract
                                                    to Hire
                                                </option>
                                                <option value="Seasonal"
                                                        @if(old('service')=='Seasonal') selected @endif>Seasonal
                                                </option>
                                                <option value="Internship"
                                                        @if(old('service')=='Internship') selected @endif>Internship
                                                </option>
                                            </select>
                                        </div>
                                        @error('service')
                                        <label id="service-error" class="error" for="service">{{$message}}</label>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Experience Level</label>
                                            <select name="required_experience" id="" class="form-control">
                                                <option value="" selected disabled>Select Experience</option>
                                                <option value="Intern"
                                                        @if(old('required_experience')=='Intern') selected @endif>Intern
                                                </option>
                                                <option value="Entry Level"
                                                        @if(old('required_experience')=='Entry Level') selected @endif>
                                                    Entry Level
                                                </option>
                                                <option value="Intermediate"
                                                        @if(old('required_experience')=='Intermediate') selected @endif>
                                                    Intermediate
                                                </option>
                                                <option value="Experienced"
                                                        @if(old('required_experience')=='Experienced') selected @endif>
                                                    Experienced
                                                </option>
                                                <option value="Managerial"
                                                        @if(old('required_experience')=='Managerial') selected @endif>
                                                    Managerial
                                                </option>
                                                <option value="Directorship"
                                                        @if(old('required_experience')=='Directorship') selected @endif>
                                                    Directorship
                                                </option>
                                                <option value="Executive"
                                                        @if(old('required_experience')=='Executive') selected @endif>
                                                    Executive
                                                </option>
                                                <option value="Senior Executive"
                                                        @if(old('required_experience')=='Senior Executive') selected @endif>
                                                    Senior Executive
                                                </option>
                                            </select>
                                        </div>
                                        @error('required_experience')
                                        <label id="required_experience-error" class="error"
                                               for="required_experience">{{$message}}</label>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
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
                                                <option value="10+" @if(old('num_hires')=='10+') selected @endif>10+
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Apply Before</label>
                                            <input name="applied_before" type="date" class="form-control"
                                                   value="{{old('applied_before')}}">
                                        </div>
                                        @error('applied_before')
                                        <label id="applied_before-error" class="error"
                                               for="applied_before">{{$message}}</label>
                                        @enderror
                                    </div>
                                    <div class="col-md-8">
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
                                            <input type="text" name="job_benefits" id="job_benefits"
                                                   class="tags_1 tags form-control"
                                                   placeholder="Use comma or enter to separate benefits"
                                                   value="{{old('job_benefits')}}">
                                        </div>
                                        <label id="job_benefits-error" class="error" for="job_benefits"
                                               style="display: none"></label>
                                        @error('job_benefits')
                                        <label id="job_benefits-error" class="error"
                                               for="job_benefits">{{$message}}</label>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Required Skills (Optional)</label>
                                            <input name="required_skills" id="required_skills" type="text"
                                                   class="tags_1 tags form-control"
                                                   placeholder="Use comma or enter to separate skills"
                                                   value="{{old('required_skills')}}">
                                        </div>
                                        <label id="required_skills-error" class="error" for="required_skills"
                                               style="display: none"></label>
                                        @error('required_skills')
                                        <label id="required_skills-error" class="error"
                                               for="required_skills">{{$message}}</label>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Licensure/Certification (Optional)</label>
                                            <input type="text" name="required_certification" id="required_certification"
                                                   class="tags_1 tags form-control"
                                                   placeholder="Use comma or enter to separate certification"
                                                   value="{{old('required_certification')}}">
                                        </div>
                                        <label id="required_certification-error" class="error"
                                               for="required_certification" style="display: none"></label>
                                        @error('required_certification')
                                        <label id="required_certification-error" class="error"
                                               for="required_certification">{{$message}}</label>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Job Description (Optional)</label>
                                            {{--                                            <div id="job_discription"></div>--}}
                                            <textarea name="job_discription" id="job_discription"
                                                      class="form-control tinymce"
                                                      placeholder="Briefly summarize this position..."></textarea>
                                        </div>
                                        <label id="job_discription-error" class="error" for="job_discription"
                                               style="display: none"></label>
                                        @error('job_discription')
                                        <label id="job_discription-error" class="error"
                                               for="job_discription">{{$message}}</label>
                                        @enderror
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary pull-right">Post Now</button>
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
                    {model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph'},
                    {model: 'heading3', view: 'h3', title: 'Heading', class: 'ck-heading_heading3'},
                ]
            },
            toolbar: {
                items: [
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

        }).catch(error => {
            console.error(error);
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

        // $('#package').simpleMoneyFormat();
        // $('#package_to').simpleMoneyFormat();

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

        // function initialize() {
        //     var input = document.getElementById('location');
        //     var options = {
        //         types: ['(regions)'] //this should work !
        //     };
        //
        //     var autocomplete = new google.maps.places.Autocomplete(input, options);
        //     // autocomplete.setComponentRestrictions(
        //     //     {'country': ['us']});
        // }
        //
        // google.maps.event.addDomListener(window, 'load', initialize);

        // var editor = null;
        // ClassicEditor.create(document.querySelector("#job_discription"), {
        //     toolbar: [
        //         "heading",
        //         "fontFamily",
        //         "|",
        //         "bold",
        //         "italic",
        //         "link",
        //         "bulletedList",
        //         "numberedList",
        //         "imageUpload",
        //         "blockQuote",
        //         "undo",
        //         "redo",
        //         "imageStyle:full",
        //         "imageStyle:side",
        //         "|",
        //         "imageTextAlternative",
        //         "contenteditable",
        //         // "tableColumn",
        //     ],
        // });
        // $('#required_skills').tagsInput({
        //     width: 'auto',
        //     defaultText: 'Use comma or enter to separate skills',
        // });
        // $('#required_certification').tagsInput({
        //     width: 'auto',
        //     defaultText: 'Use comma or enter to separate Certifications',
        // });
        // $('#job_benefits').tagsInput({
        //     width: 'auto',
        //     defaultText: 'Use comma or enter to separate benefits',
        // });

        $("#add_range").click(function () {
            $("#add_range").hide();
            $(".div_package_to").show();
        });

        $(document).ready(function () {

            // $("#user-create-job-form").validate({
            //     ignore: [],
            //     rules: {
            //         jobtitle: {
            //             required: true,
            //             minlength: 2,
            //             maxlength: 255
            //         },
            //         education: {
            //             required: true,
            //         },
            //         location: {
            //             required: true,
            //             locationvalidation: true,
            //             // minlength: 2,
            //             maxlength: 255
            //         },
            //         /*state:{
            //             required: true,
            //             alpha_space: true,
            //             minlength: 2,
            //             maxlength:255
            //         } ,*/
            //         web_url: {
            //             required: true,
            //             validUrl: true
            //         },
            //         package: {
            //             required: true,
            //             currencyvalidation: true,
            //             minlength: 1,
            //             maxlength: 20
            //             // positivedigit:true,
            //         },
            //         package_to: {
            //             currencyvalidation: true,
            //             // greaterThan:true,
            //             greaterThanPackage: '#package',
            //             maxlength: 20
            //             // positivedigit:true,
            //         },
            //         salary_duration: {
            //             required: true,
            //         },
            //         industry: {
            //             required: true,
            //         },
            //         service: {
            //             required: true,
            //
            //         },
            //         job_discription: {
            //             ckrequired: false,
            //             // maxlength:1000
            //         },
            //         job_benefits: {
            //             required: false,
            //             minlength: 2,
            //             maxlength: 1000
            //         },
            //         required_skills: {
            //             // required: true,
            //             minlength: 2,
            //             maxlength: 1000
            //         },
            //         required_certification: {
            //             // required: true,
            //             minlength: 2,
            //             maxlength: 1000
            //         },
            //         required_experience: {
            //             required: true,
            //         },
            //         num_hires: {
            //             required: true,
            //         },
            //         applied_before: {
            //             required: true,
            //             date: true,
            //             greaterThanToday: true
            //         },
            //         currency: {
            //             required: true,
            //             currency: true
            //         },
            //
            //     },
            //     messages: {
            //
            //         jobtitle: {
            //             required: "Job title is required.",
            //             minlength: "Job title  must be at least 2 characters long.",
            //             maxlength: "Job title  must be less than 255 characters long.",
            //         },
            //         education: {
            //             required: "Education is required.",
            //         },
            //         location: {
            //             required: "Job location is required.",
            //             locationvalidation: "Job location must be in valid format.",
            //             // minlength: "Job location must be at least 2 characters long.",
            //             maxlength: "Job location must be less than 255 characters long."
            //         },
            //         web_url: {
            //             required: "Website url is required.",
            //             url: "Please enter valid url."
            //         },
            //         package: {
            //             required: "Salary is required.",
            //             currencyvalidation: "Salary should be in valid format.",
            //             minlength: "Salary must be at least 1 characters long.",
            //             maxlength: "Salary must be less than 20 characters long.",
            //             // lessThanPackageTo: 'Maximum salary range must be greater than minimum salary.'
            //             // positivedigit:"Salary must be positive.",
            //         },
            //         package_to: {
            //             currencyvalidation: "Salary should be in valid format.",
            //             // greaterThan: "Maximum salary range must be greater than minimum salary updated.",
            //             greaterThanPackage: "Maximum salary range must be greater than minimum salary.",
            //             maxlength: "Salary must be less than 20 characters long."
            //             // positivedigit:"Salary must be positive.",
            //         },
            //         salary_duration: {
            //             required: "Salary duration is required",
            //         },
            //         industry: {
            //             required: "Type of industry is required.",
            //
            //         },
            //         service: {
            //             required: "Please select service from dropdown."
            //         },
            //         job_discription: {
            //             ckrequired: "Job description is required.",
            //             // maxlength: "Job description must be less than 1000 characters long."
            //         },
            //         job_benefits: {
            //             // required: "Job benefits are required.",
            //             minlength: "Job benefits must be at least 2 characters long.",
            //             maxlength: "Job benefits must be less than 1000 characters long."
            //         },
            //         required_skills: {
            //             // required: "Skills are required.",
            //             minlength: "Skills must be at least 2 characters long.",
            //             maxlength: "Skills must be less than 1000 characters long."
            //         },
            //         required_certification: {
            //             // required: "Licensure/Certification are required.",
            //             minlength: "Licensure/Certification must be at least 2 characters long.",
            //             maxlength: "Licensure/Certification must be less than 1000 characters long."
            //         },
            //         required_experience: {
            //             required: "Select the required experience.",
            //         },
            //         num_hires: {
            //             required: "Select the Number of Hires.",
            //         },
            //         applied_before: {
            //             required: "Select the Apply Before date.",
            //             date: "Select valid date.",
            //             greaterThanToday: "Apply before date should must be a date after today."
            //         },
            //         currency: {
            //             required: "Currency is required.",
            //             currency: "A valid currency sign is required."
            //         },
            //     },
            //     submitHandler: function (form) {
            //         // event.preventDefault();
            //         form.submit();
            //     }
            // });

            $("#user-create-job-form").validate({
                ignore: [],
                rules: {
                    jobtitle: {
                        required: true,
                        alphanumericspace: true,
                        minlength: 2,
                        maxlength: 255
                    },
                    education: {
                        required: true,
                    },
                    location: {
                        required: true,
                        locationvalidation: true,
                        // minlength: 2,
                        maxlength: 255
                    },
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
                    package: {
                        required: true,
                        currencyvalidation: true,
                        minlength: 1,
                        maxlength: 20
                        // positivedigit:true,
                    },
                    package_to: {
                        currencyvalidation: true,
                        // greaterThan:true,
                        greaterThanPackage: '#package',
                        maxlength: 20
                        // positivedigit:true,
                    },
                    salary_duration: {
                        required: true,
                    },
                    industry: {
                        required: true,
                    },
                    service: {
                        required: true,

                    },
                    job_discription: {
                        ckrequired: false,
                        // maxlength:1000
                    },
                    job_benefits: {
                        // required: true,
                        minlength: 2,
                        maxlength: 1000
                    },
                    required_skills: {
                        // required: true,
                        minlength: 2,
                        maxlength: 1000
                    },
                    required_certification: {
                        // required: true,
                        minlength: 2,
                        maxlength: 1000
                    },
                    required_experience: {
                        required: true,
                    },
                    num_hires: {
                        required: true,
                    },
                    applied_before: {
                        required: true,
                        date: true,
                        greaterThanToday: "#apply_before"
                    },
                    currency: {
                        required: true,
                        currency: true
                    },

                },
                messages: {
                    jobtitle: {
                        required: "Job title is required.",
                        minlength: "Job title  must be at least 2 characters long.",
                        maxlength: "Job title  must be less than 255 characters long.",
                        // alpha_space:"Letters only."
                    },
                    education: {
                        required: "Education is required.",
                    },
                    location: {
                        required: "Job location is required.",
                        locationvalidation: "Job location must be in valid format.",
                        // minlength: "Job location must be at least 2 characters long.",
                        maxlength: "Job location must be less than 255 characters long."
                    },
                    web_url: {
                        required: "Website url is required.",
                        url: "Please enter valid url."
                    },
                    package: {
                        required: "Salary is required.",
                        currencyvalidation: "Salary should be in valid format.",
                        minlength: "Salary must be at least 1 characters long.",
                        maxlength: "Salary must be less than 20 characters long."
                        // positivedigit:"Salary must be positive.",
                    },
                    package_to: {
                        currencyvalidation: "Salary should be in valid format.",
                        // greaterThan: "Maximum salary range must be greater than minimum salary.",
                        greaterThanPackage: "Maximum salary range must be greater than minimum salary.",
                        maxlength: "Salary must be less than 20 characters long."
                        // positivedigit:"Salary must be positive.",
                    },
                    salary_duration: {
                        required: "Salary duration is required",
                    },
                    industry: {
                        required: "Type of industry is required.",

                    },
                    service: {
                        required: "Please select service from dropdown."
                    },
                    job_discription: {
                        ckrequired: "Job description is required.",
                        // maxlength: "Job description must be less than 1000 characters long."
                    },
                    job_benefits: {
                        // required: "Job benefits are required.",
                        minlength: "Job benefits must be at least 2 characters long.",
                        maxlength: "Job benefits must be less than 1000 characters long."
                    },
                    required_skills: {
                        // required: "Skills are required.",
                        minlength: "Skills must be at least 2 characters long.",
                        maxlength: "Skills must be less than 1000 characters long."
                    },
                    required_certification: {
                        // required: "Licensure/Certification are required.",
                        minlength: "Licensure/Certification must be at least 2 characters long.",
                        maxlength: "Licensure/Certification must be less than 1000 characters long."
                    },
                    required_experience: {
                        required: "Select the required experience.",
                    },
                    num_hires: {
                        required: "Select the Number of Hires.",
                    },
                    applied_before: {
                        required: "Select the apply before date.",
                        date: "Select valid date.",
                        greaterThanToday: "Apply before date should must be a date after today."
                    },
                    currency: {
                        required: "Currency is required.",
                        currency: "A valid currency sign is required."
                    },
                },
                submitHandler: function (form) {
                    form.submit();
                }
            });

            // jQuery.validator.addMethod("greaterThanPackage",
            //     function (value, element, params) {
            //
            //         if (value === "" || (parseFloat(value) > parseFloat($(params).val()))) {
            //             return true;
            //         }
            //         return false;
            //     });

            // jQuery.validator.addMethod("lessThanPackageTo",
            //     function (value, element, params) {
            //         console.log("package 2: " + value + ' > ' + "package: " + $(params).val());
            //         if ( $(params).val() > value) {
            //             return true;
            //         } else {
            //             return false;
            //         }
            //         // return value > $(params).val();
            //     });
            $('#user-create-job-form').find('#location').keypress(function (e) {
                if (e.which == 13) // Enter key = keycode 13
                {
                    $(this).next().focus();  //Use whatever selector necessary to focus the 'next' input
                    return false;
                }
            });
        });

    </script>
@endsection
