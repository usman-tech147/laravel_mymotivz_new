@extends('layouts.user_layout')

@section('title' , 'Career Development')

@section('content')
    <div class="mm-subheader"><h1>Career Development</h1></div>

    <div class="motivz-main-content" style="padding-bottom: 0px;">

        <!--// Main Section \\-->
        <div class="motivz-main-section career-developmentfull">
            <div class="container">
                {{--@if(Session::has('success'))
                    <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                        {{Session::get('success')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif--}}
                <div class="row">
                    <div class="col-md-6">
                        <div class="career-development">
                            <h2>Do you need help taking that important step?</h2>
                            <p>Making important decisions, especially career choice is one of the most challenging tasks
                                in a person’s life. Many need someone to hold their hand and lead them in the right
                                direction. This has been our focus for several years. Our team of Professional Career
                                Developers will help you maximize your core values and strengths, enabling you to reach
                                your career goals. We work on a personal level with each individual, creating detailed
                                career plans specifically tailored to help the individual reach their goals.</p>

                            @if(Session::has('candidate_id'))
                                <a href="{{route('candidate.dashboard')}}" class="lazy-btn transparent">Connect with a
                                    Career Developer</a>
                            @else
                                <a href="/sign-up" class="lazy-btn transparent">Connect with a Career Developer</a>
                            @endif
                            <a href="{{route('user.find.jobs')}}" class="lazy-btn">Find Jobs</a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <figure class="career-development-img"><img
                                src="{{asset('user/images/career-development-img1.jpg')}}" alt=""><img
                                class="secnd-img" src="{{asset('user/images/career-development-img.jpg')}}" alt="">
                        </figure>
                    </div>
                </div>
            </div>
        </div>
        <!--// Main Section \\-->

        <!--// Main Section \\-->
        <div class="motivz-main-section career-activelyfull">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <figure class="career-development-img career-development-scnd"><img
                                src="{{asset('user/images/career-development-img1.jpg')}}" alt=""><img
                                class="secnd-img" src="{{asset('user/images/career-development-img2.jpg')}}" alt="">
                        </figure>
                    </div>
                    <div class="col-md-6">
                        <div class="career-development">
                            <h2>Are you actively looking for a job?</h2>
                            <p>Whether you have just graduated from school, resigned from your current job, or for
                                whatever reason you are not working right now; we will help you get back on track as
                                soon as possible. Upload your resume today and let thousands of our employers in your
                                area find you.</p>
                            <form action="javascript:void(0)" method="POST" enctype="multipart/form-data"
                                  name="upload_resume" id="upload_resume">
                                @csrf
                                {{--@method('get')--}}
                                {{--                                <span id="resumename"></span>--}}
                                {{--                                <label><i class="fa fa-upload"></i>Upload Resume<input id="resume" name="resume" type="file" onchange="this.form.submit()"></label>--}}
                                <a href="{{route('candidate.dashboard')}}"><label style="cursor: pointer;"><i
                                            class="fa fa-upload"></i>Upload
                                        Resume{{--<input id="resume" name="resume" type="submit" >--}}</label></a>
                                @error('resume')
                                <label class="error">{{$message}}</label>
                                @enderror
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="extra-space"></div>
                </div>

                <div class="row revers">
                    <div class="col-md-6">
                        <div class="career-development actively-looking">
                            <h2>I’m not actively looking but I’m keeping my options open</h2>
                            <p>Everyone dreams of getting an ideal job. Many times, however, you may end up with what
                                you didn’t expect. Well, you are not alone, but that does not mean you stop there. You
                                may not be an active job seeker, but we understand your need to grow and achieve your
                                career objectives. Perhaps you want to move to another city or seeking a better
                                work-life balance. Or maybe you want something that pays a bit higher and with advanced
                                responsibilities that help you utilize your skills. Regardless, we can help you realize
                                this dream and it’s just a matter of getting out of your shadows and take on bigger
                                challenges. </p>
                            <p>Our team will connect you to different employers in areas of your choice. Submit your
                                requirements below and we will notify you of any future job openings that meet your
                                criteria.</p>
                            <a href="#submitjobModal" id="job-modal" data-toggle="modal" class="lazy-btn"
                               style="font-weight:bold;">
                                Submit Job Requirements
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <figure class="career-development-img actively-looking-img"><img
                                src="{{asset('user/images/career-development-img4.jpg')}}" alt=""><img
                                class="secnd-img" src="{{asset('user/images/career-development-img3.jpg')}}" alt="">
                        </figure>
                    </div>
                </div>
            </div>
        </div>
        <!--// Main Section \\-->

    </div>

    <div class="modal fade submitjobform" id="submitjobModal" tabindex="-1" role="dialog"
         aria-labelledby="submitjobModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title example-title" id="submitjobModalLabel">Submit Job Requirements <span>Submit your requirements below and we will notify you of any future job openings that meet your criteria.</span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('job.notify')}}" enctype="multipart/form-data" method="POST"
                          name="job_notify_form" id="job_notify_form">
                        @csrf
                        <ul>
                            <li>
                                <input type="text" placeholder="Your Name" name="full_name" class="form-control"
                                       value="">
                                @error('full_name')
                                <label class="error">{{$message}}</label>
                                @enderror
                            </li>
                            <li>
                                <input type="text" placeholder="Your Email" name="email" class="form-control" value="">
                                @error('email')
                                <label class="error">{{$message}}</label>
                                @enderror
                            </li>
                            <li>
                                <input type="text" placeholder="Your Phone Number" name="phone_no" id="phone_no"
                                       class="form-control" value="">
                                @error('phone_no')
                                <label class="error">{{$message}}</label>
                                @enderror
                            </li>
                            <li>
                                <input type="text" class="tags_1 tags form-control" name="location" id="location"
                                       value="" placeholder="Desired Location">
{{--                                <label id="location-error" class="error" for="location" style="display: none"></label>--}}
                                @error('location')
                                <label class="error">{{$message}}</label>
                                @enderror
                            </li>
                            <li>
                                <select name="industry" id="" class="form-control">
                                    <option value="" selected disabled>Your Industry</option>
                                    @foreach($industries as $industry)
                                        <option value="{{$industry->id}}">{{$industry->name}}</option>
                                    @endforeach
                                </select>
                                @error('industry')
                                <label class="error">{{$message}}</label>
                                @enderror
                            </li>
                            <li>
                                <input type="text" data-role="tagsinput" class="tags_1 tags form-control"
                                       name="job_title" id="job_title_tags" placeholder=""
                                       value="">
                                <label id="job_title_tags-error" class="error" for="job_title_tags"
                                       style="display: none"></label>
                                @error('job_title')
                                <label class="error">{{$message}}</label>
                                @enderror
                            </li>
                            <li>
                                <select name="sel_education" id="" class="form-control">
                                    <option value="" style="display: none;">Select your highest level of education
                                    </option>
                                    @foreach($Education as $education)
                                        <option value="{{$education->id}}">{{$education->name}}</option>
                                    @endforeach
                                </select>
                                @error('sel_education')
                                <label class="error">{{$message}}</label>
                                @enderror
                            </li>
                            <li>
                                <select name="sel_job_type" id="" class="form-control">
                                    <option value="" style="display: none;">Job Type</option>
                                    <option value="Full-time">Full-time</option>
                                    <option value="Part-time">Part-time</option>
                                    <option value="Contract">Contract</option>
                                    <option value="Contract to Hire">Contract to Hire</option>
                                    <option value="Seasonal">Seasonal</option>
                                    <option value="Internship">Internship</option>
                                </select>
                                @error('sel_job_type')
                                <label class="error">{{$message}}</label>
                                @enderror
                            </li>
                            <li style="width: 100%">
                                <label>Desired Pay</label>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text currecny_sign"
                                                      id="inputGroup-sizing-default"
                                                      style="width: auto; margin: 0px;">$</span>
                                            </div>
                                            <input name="package" id="package" type="text" class="form-control"
                                                   aria-label="Default" aria-describedby="inputGroup-sizing-default"
                                                   placeholder="From" value="">
                                        </div>
                                    </div>
                                    @error('package')
                                    <label id="package-error" class="error" for="package">{{$message}}</label>
                                    @enderror
                                    <div class="col-md-4">
                                        <span id="add_range"
                                              style="  display: block; text-align: center;margin: 12px 0px 0px;font-size: 17px;font-weight: 600;cursor: pointer; width: 85%;">+ Add Range</span>
                                        <div class="input-group mb-3 div_package_to" style="display:none">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text currecny_sign"
                                                      id="inputGroup-sizing-default"
                                                      style="width: auto; margin: 0px;">$</span>
                                                <input type="hidden" id="hidd_curr_sign" name="hidd_curr_sign"
                                                       value="$">
                                            </div>
                                            <input name="package_to" id="package_to" type="text" class="form-control"
                                                   aria-label="Default" aria-describedby="inputGroup-sizing-default"
                                                   placeholder="To" value="">
                                        </div>
                                    </div>
                                    @error('package_to')
                                    <label id="package_to-error" class="error" for="package_to">{{$message}}</label>
                                    @enderror
                                    <div class="col-md-2">
                                        <div class="input-group mb-3 div_package_to">
                                            <select style="font-size: 12px;" name="curr_sign" id="curr_sign"
                                                    class="form-control">
                                                <option value="USD">USD</option>
                                                <option value="CAD">CAD</option>
                                                <option value="GBP">GBP</option>
                                                <option value="EUR">EUR</option>
                                                <option value="AUD">AUD</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="input-group mb-3 div_package_to">
                                            <select style="font-size: 12px;" name="salary_duration" id="salary_duration"
                                                    class="form-control">
                                                <option value="hourly">hourly</option>
                                                <option value="daily">daily</option>
                                                <option value="weekly">weekly</option>
                                                <option value="monthly">monthly</option>
                                                <option value="annually">annually</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                @error('salary_req')
                                <label class="error">{{$message}}</label>
                                @enderror
                            </li>
                            <li class="full">
                                <textarea class="form-control"
                                          placeholder="Please describe what you are looking for in your next move"
                                          name="description" id="description" cols="30" rows="10"></textarea>
                                @error('description')
                                <label class="error">{{$message}}</label>
                                @enderror
                            </li>
                        </ul>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" style="background-color: black">Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@stop

@section('script')
    <script src="{{asset('assets/scripts/moment.min.js')}}"></script>
    <script src="{{asset('assets/scripts/notify.min.js')}}"></script>
    <script src="{{asset('user/script/blockUI.js')}}"></script>
    <script src="{{asset('js/pagination.js')}}"></script>

    @if( Session::has('success') )
        <script type="text/javascript">
            sweetAlert({
                title: "Success",
                text: "Thank you for submitting your profile. We will reach out should there be a match based on your job requirements",
                icon: "success",
            })
        </script>
        <style>
            .notifyjs-bootstrap-base span {
                font-size: 15px;
            }
        </style>
    @endif
    <script>

        $(document).ready(function () {

            $(function () {
                $('#job_title_tags').tagsInput({
                    width: '100%',
                    defaultText: 'Use comma or enter to separate desired Job Titles'
                });
                // $('#location').tagsInput({
                //     width: 'auto',
                //     defaultText: 'Desired Work Location (s)'
                // });
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
            $("#add_range").click(function () {
                $("#add_range").hide();
                $(".div_package_to").show();
            });

            $('#description').keypress(function (e) {
                if (e.keyCode == 13) {
                    e.preventDefault();
                    this.value = this.value.substring(0, this.selectionStart) + "" + "\n" + this.value.substring(this.selectionEnd, this.value.length);
                }
            });

            $("#phone_no").each(function () {
                $(this).on("change keyup paste", function (e) {
                    var output,
                        $this = $(this),
                        input = $this.val();

                    if (e.keyCode != 8) {
                        input = input.replace(/[^0-9]/g, '');
                        var area = input.substr(0, 3);
                        var pre = input.substr(3, 3);
                        var tel = input.substr(6, 4);
                        if (area.length < 3) {
                            output = "(" + area;
                        } else if (area.length == 3 && pre.length < 3) {
                            output = "(" + area + ")" + " " + pre;
                        } else if (area.length == 3 && pre.length == 3) {
                            output = "(" + area + ")" + " " + pre + "-" + tel;
                        }
                        $this.val(output);
                    }
                });
            });

            $("#upload_resume").validate({
                rules: {

                    resume: {
                        required: true,
                        extension: 'docx|pdf',
                    },
                },
                messages: {
                    resume: {
                        required: "Resume is Required",
                        extension: "Only PDF and Docx file types are allowed",
                    },
                },
                submitHandler: function (form) {
                    form.submit();
                }
            });
            $.validator.addMethod("checkTags", function(value) { //add custom method
                //Tags input plugin converts input into div having id #YOURINPUTID_tagsinput
                //now you can count no of tags
                console.log($("#job_title_tags_tagsinput").find(".tag").length > 0)
                return ($("#job_title_tags_tagsinput").find(".tag").length > 0);
            },"test");


            $("#job_notify_form").validate({
                ignore: ".ignore",
                rules: {

                    full_name: {
                        required: true,
                        lettersonly: true,
                        minlength: 3,
                        maxlength: 255,
                    },
                    // job_title: "checkTags",
                    job_title: {
                        required: true,
                        maxlength: 255,
                    },
                    phone_no: {
                        required: true,
                        phonevalidation: true,
                        minlength: 14,
                        maxlength: 14,
                    },
                    email: {
                        required: true,
                        email: true,
                        maxlength: 255,
                    },
                    location: {
                        required: true,
                        locationvalidation: true,
                        // minlength: 2,
                        maxlength: 255
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
                    sel_education: {
                        required: true,
                    },
                    industry: {
                        required: true,
                    },
                    sel_job_type: {
                        required: true,
                    },
                    description: {
                        required: true,
                        maxlength: 500
                    },
                },
                // Specify validation error messages
                messages: {
                    full_name: {
                        required: "Full name is required.",
                        // lettersonly: "Only alphabets are allowed in full name.",
                        minlength: "Full name must be greater than 3 characters long.",
                        maxlength: "Full name must be less than 255 characters long."
                    },
                    job_title: {

                        required: "Job title is required.",
                        maxlength: "Job title must be less than 255 characters long."
                    },
                    phone_no: {
                        required: "Phone number is required.",
                        phonevalidation: "Phone number must be in valid format.",
                        minlength: "Phone number must be equal to 14 characters.",
                        maxlength: "Phone number must be equal to 14 characters.",
                    },
                    email: {
                        required: "Email is required.",
                        email: "Email must be in valid format.",
                        maxlength: "Email must be less than 255 characters long."
                    },
                    location: {
                        required: "Job location is required.",
                        locationvalidation: "Job location must be in valid format.",
                        // minlength: "Job Location must be at least 2 characters long.",
                        maxlength: "Job location must be less than 255 characters long."
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
                    sel_education: {
                        required: "Education is required.",
                    },
                    industry: {
                        required: "Industry is required.",
                    },
                    sel_job_type: {
                        required: "Job type is required.",
                    },
                    description: {
                        required: "Description is required.",
                        maxlength: "Description must be less than 500 characters long.",
                    },

                },

                submitHandler: function (form) {
                    form.submit();
                }

            });
            $("#job_title_tags_tag").rules("add", {required:true});
            $('#submitjobModal').on('hidden.bs.modal', function () {
                // $('#job_notify_form')[0].reset();
                $("#job_notify_form").validate().resetForm();
                // $('.tag').remove();
            });

            $('#job_notify_form').on('keyup keypress', function (e) {
                var keyCode = e.keyCode || e.which;
                if (keyCode === 13) {
                    e.preventDefault();
                    return false;
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
            // jQuery.validator.addMethod("lettersonly", function (value, element) {
            //     return this.optional(element) || /^[a-zA-Z ]+$/i.test(value);
            // });
            // jQuery.validator.addMethod("currencyvalidation", function (value, element) {
            //     return this.optional(element) || /^[,.?0-9]+$/i.test(value);
            // });
            // jQuery.validator.addMethod("phonevalidation", function (value, element) {
            //     return this.optional(element) || /^[0-9\-\(\)\s]+$/i.test(value);
            // });
            // jQuery.validator.addMethod("locationvalidation", function (value, element) {
            //     return this.optional(element) || /^[a-zA-Z, ]+$/i.test(value);
            // });
            // jQuery.validator.addMethod("greaterThan", function (value, element) {
            //     var salary_to = value;
            //     var salary_from = $("#package").val();
            //
            //     if (value.indexOf(',') > -1) {
            //         salary_to = value.replace(',', '');
            //     }
            //     if (salary_from.indexOf(',') > -1) {
            //         salary_from = salary_from.replace(',', '');
            //     }
            //     salary_from = parseInt(salary_from);
            //     salary_to = parseInt(salary_to);
            //     if (salary_from >= salary_to) {
            //         return false;
            //     } else {
            //         return true;
            //     }
            // });


        });

    </script>
@endsection
