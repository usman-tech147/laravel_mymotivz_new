@extends('admin.layouts.layouts')
@section('title', 'Create New Job')
@section('content')
    <div class="app-main__inner">
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
                                <form id="admin-user-side-job" action="{{ route('user_side.post.job') }}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Job Title</label>
                                                <input name="jobtitle" type="text" class="form-control"
                                                       placeholder="Title" value="">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Education</label>
                                                <select name="education" class="form-control">
                                                    <option value="" selected disabled>Select Education</option>
                                                    @foreach($educations as $education)
                                                        <option value="{{$education->id}}">{{$education->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Job Location</label>
                                                <input name="location" id="location" value="" type="text"
                                                       class="form-control pac-target-input" placeholder="Location"
                                                       autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Website Address <small>(http://www.example.com)</small></label>
                                                <input name="web_url" value="" type="text" class="form-control"
                                                       placeholder="Website Address">
                                            </div>
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
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Job Type</label>
                                                <select name="service" class="form-control">
                                                    <option value="" selected="" disabled="">Select Job Type</option>
                                                    <option value="Full-Time">Full-Time
                                                    </option>
                                                    <option value="Part-Time">Part-Time
                                                    </option>
                                                    <option value="Contract">Contract
                                                    </option>
                                                    <option value="Contract to Hire">Contract
                                                        to Hire
                                                    </option>
                                                    <option value="Seasonal">Seasonal
                                                    </option>
                                                    <option value="Internship">Internship
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Experience Level</label>
                                                <select name="required_experience" id="" class="form-control">
                                                    <option value="" selected="" disabled="">Select Experience</option>
                                                    <option value="Intern">Intern
                                                    </option>
                                                    <option value="Entry Level">
                                                        Entry Level
                                                    </option>
                                                    <option value="Intermediate">
                                                        Intermediate
                                                    </option>
                                                    <option value="Experienced">
                                                        Experienced
                                                    </option>
                                                    <option value="Managerial">
                                                        Managerial
                                                    </option>
                                                    <option value="Directorship">
                                                        Directorship
                                                    </option>
                                                    <option value="Executive">
                                                        Executive
                                                    </option>
                                                    <option value="Senior Executive">
                                                        Senior Executive
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Number of Hires</label>
                                                <select name="num_hires" id="" class="form-control">
                                                    <option value="" selected="" disabled="">Select Number of Hires
                                                    </option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                    <option value="6">6</option>
                                                    <option value="7">7</option>
                                                    <option value="8">8</option>
                                                    <option value="9">9</option>
                                                    <option value="10+">10+
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Apply Before</label>
                                                <input name="applied_before" type="date" class="form-control" value="">
                                            </div>
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
                                                                   class="form-control number-separator"
                                                                   aria-label="Default"
                                                                   aria-describedby="inputGroup-sizing-default"
                                                                   placeholder="From" value="">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                    <span id="add_range"
                                                          style="  display: block;   text-align: center;margin: 12px 0px 0px;font-size: 17px;font-weight: 600;cursor: pointer;">+ Add Range</span>
                                                        <div class="input-group mb-3 div_package_to"
                                                             style="display: none">
                                                            <div class="input-group-prepend">
                                                            <span class="input-group-text currecny_sign"
                                                                  id="inputGroup-sizing-default">$</span>
                                                                <input type="hidden" id="hidd_curr_sign"
                                                                       name="hidd_curr_sign" value="$">
                                                            </div>
                                                            <input name="package_to" id="package_to" type="text"
                                                                   class="form-control number-separator" aria-label="Default"
                                                                   aria-describedby="inputGroup-sizing-default"
                                                                   placeholder="To" value="{{old('package_to')}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="input-group mb-3 div_package_to">
                                                            <select style="font-size: 12px;" name="curr_sign"
                                                                    id="curr_sign" class="form-control">
                                                                <option value="USD">USD
                                                                </option>
                                                                <option value="CAD">CAD
                                                                </option>
                                                                <option value="GBP">GBP
                                                                </option>
                                                                <option value="EUR">EUR
                                                                </option>
                                                                <option value="AUD">AUD
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
                                                <label class="optional">Job Benefits (Optional)</label>
                                                <input type="text" name="job_benefits" id="job_benefits"
                                                       class="tags_1 tags form-control"
                                                       placeholder="Use comma or enter to separate benefits">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="optional">Required Skills (Optional)</label>
                                                <input name="required_skills" id="required_skills" type="text"
                                                       class="tags_1 tags form-control"
                                                       placeholder="Use comma or enter to separate skills">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="optional">Licensure/Certification (Optional)</label>
                                                <input type="text" name="required_certification"
                                                       id="required_certification" class="tags_1 tags form-control"
                                                       placeholder="Use comma or enter to separate certification">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="optional">Job Description (Optional)</label>
                                                <textarea name="job_discription" id="editor"
                                                          class="form-control tinymce"
                                                          placeholder="Briefly summarize this position..."></textarea>
                                            </div>
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
    </div>
    <script>
        $("#add_range").click(function () {
            $("#add_range").hide();
            $(".div_package_to").show();
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

        $(document).ready(function (e) {
            console.log("form submit");
            $("#admin-user-side-job").validate({
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
                        maxlength: 255
                    },
                    web_url: {
                        required: true,
                        // validUrl: true
                    },
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
                        // ckrequired: false,
                    },
                    job_benefits: {
                        minlength: 2,
                        maxlength: 1000
                    },
                    required_skills: {
                        minlength: 2,
                        maxlength: 1000
                    },
                    required_certification: {
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
                    },
                    education: {
                        required: "Education is required.",
                    },
                    location: {
                        required: "Job location is required.",
                        locationvalidation: "Job location must be in valid format.",
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
                    },
                    package_to: {
                        currencyvalidation: "Salary should be in valid format.",
                        greaterThanPackage: "Maximum salary range must be greater than minimum salary.",
                        maxlength: "Salary must be less than 20 characters long."
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
                    },
                    job_benefits: {
                        minlength: "Job benefits must be at least 2 characters long.",
                        maxlength: "Job benefits must be less than 1000 characters long."
                    },
                    required_skills: {
                        minlength: "Skills must be at least 2 characters long.",
                        maxlength: "Skills must be less than 1000 characters long."
                    },
                    required_certification: {
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
            jQuery.validator.addMethod("locationvalidation", function(value, element) {
                return this.optional(element) || /^[^\~!@#$%\^*+{};"'|<>`]+$/i.test(value);
            });
            jQuery.validator.addMethod("currencyvalidation", function(value, element) {
                return this.optional(element) || /^[,.?0-9]+$/i.test(value);
            });
            // $('#admin-user-side-job').find('#location').keypress(function (e) {
            //     if (e.which == 13) // Enter key = keycode 13
            //     {
            //         $(this).next().focus();  //Use whatever selector necessary to focus the 'next' input
            //         return false;
            //     }
            // });
        });

    </script>
@endsection




