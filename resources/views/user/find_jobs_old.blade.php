@extends('layouts.user_layout')
@section('title' , 'Find Jobs')

@section('content')
    <!--// Main Banner \\-->
    <div class="findjob-subheader"><h1>Success Starts With You.</h1></div>
    <!--// Main Banner \\-->

    <!--// Main Content \\-->
    <div class="motivz-main-content">

        <!--// Main Section \\-->
        <div class="motivz-main-section mm-motivz-findjob">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="job-search-wrapper">
                            <div class="job-search">
                                <ul>
                                    <li class="title">
                                        <input type="text" id="search_job_title" name="job_title" placeholder="Job title or keyword" value="@if(!empty(Session::get('search_job_title'))){{trim(Session::get('search_job_title'))}}@endif">
                                    </li>
                                    <li class="location"><i class="icon-placeholder"></i>
                                        <input type="text" id="search_place" name="place" placeholder="City or area" value="@if(!empty(Session::get('search_location'))){!! Session::get('search_location') !!}@endif">
                                    </li>
                                    <li>
                                        <label>
                                            <i class="icon-search"></i>
                                            <input type="submit" onclick="Fun(1000,0)" value="Search Job">
                                        </label>
                                    </li>
                                </ul>
                            </div>
                            <div class="job-filters-top">
                                <ul>
                                    <li>
                                        <select class="form-control jobtype_filter" id="jobtype_filter" multiple="multiple" name="jobtype_filter">
                                            <option value="Full-Time">Full-Time</option>
                                            <option value="Part-Time">Part-Time</option>
                                            <option value="Contract">Contract</option>
                                            <option value="Contract to Hire">Contract to Hire</option>
                                            <option value="Seasonal">Seasonal</option>
                                            <option value="Internship">Internship</option>
                                        </select>
                                    </li>
                                    <li>
                                        <select class="form-control date_filter" name="date_filter" id="date_filter">
                                            <option value="" selected >Select Date</option>
                                            <option value="1 hour">Last Hour</option>
                                            <option value="24 hour">Last 24 hours</option>
                                            <option value="7 days">Last 7 days</option>
                                            <option value="14 days">Last 14 days</option>
                                            <option value="30 days">Last 30 days</option>
                                            <option value="All">All</option>
                                        </select>
                                    </li>
                                    <li>
                                        <select class="form-control industry_select" multiple="multiple" name="industry_select" id="industry_select">
                                            @foreach($industries as $industry)
                                                <option value="{{$industry->id}}">{{$industry->name}}</option>
                                            @endforeach
                                        </select>
                                    </li>
                                    <li>
                                        <select class="form-control experience_select" multiple="multiple" name="experience_select" id="experience_select">
                                            <option value="Intern">Intern</option>
                                            <option value="Entry Level" >Entry Level</option>
                                            <option value="Intermediate">Intermediate</option>
                                            <option value="Experienced">Experienced</option>
                                            <option value="Managerial" >Managerial</option>
                                            <option value="Directorship" >Directorship</option>
                                            <option value="Executive" >Executive</option>
                                            <option value="Senior Executive">Senior Executive</option>
                                        </select>
                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-5">
                        <div class="side-featured-jobs">
                            <h2><span id="total_results"></span></h2>
                            <div class="clearfix"></div>
                            <ul class="row" id="searched-jobslist">
                            </ul>
                        </div>
                        <div class="pagination-wrap" style="display: none;">
                            <div class="box">
                                <ul id="example-2" class="pagination"></ul>
                                <div class="show"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        @if(Session::has('already_applied'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{Session::get('already_applied')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        @if(Session::has('last_date'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{Session::get('last_date')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        @if(Session::has('resume_err'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{Session::get('resume_err')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        @if(Session::has('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{Session::get('success')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <div class="motivz-jobdetails-wrapper find-jobs-wrapper" id="motivz-jobdetails-wrapper">
                            <div class="alert alert-secondary" style="width: 100%; text-align: center;" role="alert">Click on a Job to view Job Details</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--// Main Section \\-->

    </div>
    <div class="modal fade apply-popup-wrapper" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false" style="overflow-x: hidden;overflow-y: auto;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{route('job.apply')}}" method="POST" enctype="multipart/form-data" name="form-job-apply" id="form-job-apply">
                    @csrf
                    <div class="modal-header">
                        <h5>
                            <strong id="company_name_popup"></strong>
                            <ul id="location_popup" class="motivz-jobdetail-options"></ul>
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body modal-form">
                        <ul>
                            <li>
                                <label>Full Name</label>
                                <input type="text" name="full_name" id="full_name" class="form-control" placeholder="Full Name" value="@if(session::has('candidate_id')){{$candidate->name}}@endif" >
                                @error('full_name')
                                <label class="error">{{$message}}</label>
                                @enderror
                            </li>
                            <li>
                                <label>Phone Number</label>
                                <input type="text" name="phone_no" id="phone_no" class="form-control" placeholder="Phone Number" value="@if(session::has('candidate_id')){{$candidate->phone}}@endif" >
                                @error('phone_no')
                                <label class="error">{{$message}}</label>
                                @enderror
                            </li>
                            <li>
                                <label>Email</label>
                                <input type="text" name="email" id="email" class="form-control" placeholder="Email" @if(session::has('candidate_id'))  value="{{$candidate->email}}" readonly @endif>
                                <label class="error" id="err-email" style="display: none;"></label>
                                @error('email')
                                <label class="error">{{$message}}</label>
                                @enderror
                            </li>
                            <li>
                                <label>Location</label>
                                <input type="text" name="location" id="location" class="form-control" placeholder="Location" value="@if(session::has('candidate_id')){{$candidate->location}}@endif">
                                @error('location')
                                <label class="text-danger">{{$message}}</label>
                                @enderror
                            </li>
                            @if(session::has('candidate_id'))
                            @else
                                <li>
                                    <label>Resume</label>
                                    <input id="file-upload-demo" class="resume" name="resume" type="file">
                                    <label id="file-upload-demo-error" class="error" for="file-upload-demo" style="display: none"></label>
                                    @error('resume')
                                    <label class="error">{{$message}}</label>
                                    @enderror
                                </li>
                            @endif
                            <li>
                                @if(session::has('candidate_id'))
                                    @if(count($candidate_resumes))
                                    @else
                                        <label>Resume</label>
                                        <input id="file-upload-demo" name="resume" type="file">
                                        <label id="file-upload-demo-error" class="error" for="file-upload-demo" style="display: none"></label>
                                    @endif
                                @endif
                                @error('sel_resume')
                                <label class="text-danger">{{$message}}</label>
                                @enderror
                            </li>
                            @if(session()->has('candidate_id'))
                            @else
                                <li>
                                    <label style="text-align: center;">If you have an account, please <a href="{{ route('user.login') }}" style="color: #4d9a10;
                                    font-weight: bold;">sign in</a> for one-click apply</label>
                                </li>
                            @endif
                            <input type="hidden" name="id" id="id" value=""/>
                        </ul>
                    </div>
                    <div class="modal-footer">
                        @if(session()->has('candidate_id'))
                            <button type="submit" class="submit" style="margin: 0px 0px;">Apply</button>
                        @else
                            <button type="submit" class="submit">Continue</button>
                            <button type="button" style="display:none;" id="btn_modalpopup2" data-toggle="modal" href="#exampleModal2" class="simple-btn">Hiden</button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade apply-popup-wrapper" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false" style="overflow-x: hidden;overflow-y: auto;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="javascript:void(0)" method="POST" enctype="multipart/form-data" id="form-job-apply-code">
                    @csrf
                    <div class="modal-header">
                        <h5>
                            <strong id="company_name_popup2"></strong>
                            <ul id="location_popup2" class="motivz-jobdetail-options"></ul>
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body modal-form">
                        <ul>
                            <li class="center">
                                <label style="font-size: 18px;margin: 0 0 11px;">Email Verification</label>
                                <label style=" font-size: 16px; margin: 0 0 20px;" >We sent a verification code to
                                    <span id="verify_code_to" style="font-weight: 900;">

                                    </span>
                                </label>
                            </li>
                            <li>
                                <label>Enter Code</label>
                                <input type="text" name="code" id="code" class="form-control" placeholder="" value="" >
                                <label class="error" id="err-code" style="display: none;"></label>
                            </li>
                            <li>
                                <label>Resend email <a href="javascript:void(0)" style="color: #4d9a10;font-weight: bold;" onclick="resendcode()">here</a>. If you have an account, please <a href="{{ route('user.login') }}" style="color: #4d9a10;font-weight: bold;">sign in</a></label>
                            </li>
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="submit" onclick="chkVerifyEmailCode()">Continue</button>
                        <button type="button" style="display:none;" id="btn_modalpopup3" data-toggle="modal" href="#exampleModal3" class="simple-btn">Hidden</button>
                        {{--<button type="submit" class="submit" style="margin: 0px 0px;">Apply</button>--}}
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade apply-popup-wrapper" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false" style="overflow-x: hidden;overflow-y: auto;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="javascript:void(0)" method="POST" enctype="multipart/form-data" id="form-job-apply-review">
                    @csrf
                    <div class="modal-header">
                        <h5>
                            <span id="company_name_popup3"></span>
                            <ul id="location_popup3" class="motivz-jobdetail-options"></ul>
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body modal-form">
                        <ul>
                            <li>
                                <h3>Review Application</h3>

                            </li>
                            <li>
                                <label>Full Name</label>
                                <span id="review-name"></span>
                            </li>
                            <li>
                                <label>Phone Number</label>
                                <span id="review-phone"></span>
                            </li>
                            <li>
                                <label>Email</label>
                                <span id="review-email"></span>
                            </li>
                            <li>
                                <label>Location</label>
                                <span id="review-location"></span>
                            </li>
                            <li>
                                <label>Resume</label>
                                <span id="review-resume"></span>
                            </li>
                            <li >
                                <label for="terms_policy_checkbox" class="terms_policy_job_apply"><input name="terms_policy_checkbox" type="checkbox" class="terms_policy_checkbox" style="height: unset !important;" id="terms_policy_checkbox"> I have read, and I accept, MyMotivz's <a href="/contact/terms-of-use" style="color: #4d9a10">Terms of Use</a> and <a href="/contact/privacy-policy" style="color: #4d9a10">Privacy Policy</a>.</label>
                                <label id="terms_policy_checkbox-error" class="error" for="terms_policy_checkbox" style="display: none">Kindly accept the Terms of Use and Privacy Policy.</label>
                            </li>
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="submit" onclick="hidemodal()">Edit</button>
                        <button type="submit" class="submit" onclick="submitJobApplyForm()">Apply</button>
                        <button type="button" style="display:none;" id="btn_modalpopup" data-toggle="modal" href="#exampleModal" class="simple-btn">Hiden</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--// Main Content \\-->
@endsection

@section('script')
    {{--    Old--}}
    {{--    <script src="{{asset('assets/scripts/moment.min.js')}}"></script>--}}
    {{--    New--}}
    <script src="{{asset('js/moment.min.js')}}"></script>
    <script src="{{asset('js/moment_timezone.min.js')}}"></script>
<script src="{{asset('assets/scripts/notify.min.js')}}"></script>
<script src="{{asset('user/script/blockUI.js')}}"></script>
<script src="{{asset('js/pagination.js')}}"></script>
<script src="{{asset('user/script/file-input/fileinput.js')}}" type="text/javascript"></script>
<script src="{{asset('user/script/file-input/theme.js')}}" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script>
    var formTest;
    $('#form-job-apply').submit(function () {
        if($(document.activeElement).attr('type') == 'submit')
            return true;
        else return false;
    });

    // function initialize() {
    //     var input = document.getElementById('search_place');
    //     var options = {
    //         types: ['(regions)'] //this should work !
    //     };
    //
    //     var autocomplete = new google.maps.places.Autocomplete(input, options);
    //     // autocomplete.setComponentRestrictions(
    //     //     {'country': ['us']});
    // }
    // google.maps.event.addDomListener(window, 'load', initialize);

    function initialize1() {
        var input = document.getElementById('location');
        var options = {
            types: ['(regions)'] //this should work !
        };

        var autocomplete = new google.maps.places.Autocomplete(input, options);
        // autocomplete.setComponentRestrictions(
        //     {'country': ['us']});
    }
    google.maps.event.addDomListener(window, 'load', initialize1);

    $("#phone_no").each(function(){
        $(this).on("change keyup paste", function (e) {
            var output,
                $this = $(this),
                input = $this.val();

            if(e.keyCode != 8) {
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

    $(document).ready(function () {

        $("#form-job-apply").validate({
            // focusCleanup: true,
            rules: {
                full_name: {
                    required: true,
                    alpha_space: true,
                    maxlength: 255,
                },
                phone_no: {
                    required: true,
                    phonenumber:true,
                    minlength: 14,
                    maxlength: 14,
                },
                email: {
                  required: true,
                  email: true,
                },
                location:{
                    required: true,
                    locationvalidation: true,
                    // minlength: 2,
                    maxlength:255
                } ,
                resume:{
                    required:true,
                    extension : 'docx|doc|pdf',
                    // extension : 'docx|pdf',
                }
            },
            messages: {
                full_name: {
                    required: "Full name is required.",
                    // alpha_space: "Only alphabets are allowed in full name.",
                    maxlength: "Full name must be less than 255 characters."
                },
                phone_no: {
                    required: "Phone number is required.",
                    phonenumber: "Phone number must be in valid format.",
                    minlength: "Phone number must be equal to 14 characters.",
                    maxlength: "Phone number must be equal to 14 characters.",
                },
                email: {
                    required: "Email is required.",
                    email: "Email must be in valid format.",
                },
                location:{
                    required: "Job location is required.",
                    locationvalidation: "Job location must be in valid format.",
                    // minlength: "Job Location must be at least 2 characters long.",
                    maxlength: "Job location must be less than 255 characters long."
                } ,
                resume: {
                    required: "Resume is required.",
                    extension : 'Only pdf, doc and docx files are allowed.',
                }
            },
            submitHandler: function(form) {
                var candidate_session = '{{ Session::get('candidate_id')}}';
                if(candidate_session =='')
                {
                    $("#verify_code_to").text('');
                    var email = $("#email").val();
                    $("#verify_code_to").text(''+email);

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{ route('user.job.apply.verify.mail') }}",
                        type:"POST",
                        async : false,
                        data:$(form).serialize(),
                        success:function(response){
                            if(response=='success')
                            {
                                $("#exampleModal").modal("hide");
                                $("#btn_modalpopup2").click();
                            }
                            else if(response=='email_exist')
                            {
                                $("#err-email").text('Email already exists.');
                                $("#err-email").show();
                            }
                            else if(response=='already_apply_same_mail')
                            {
                                $("#err-email").text('Already applied to this job with same email.');
                                $("#err-email").show();
                            }
                        },
                        error:function(response){

                        },
                    });
                }
                else
                {
                    form.submit();
                }

            }
        });

        $('#exampleModal').on('hidden.bs.modal', function () {
            // $('#form-job-apply')[0].reset();
            $("#form-job-apply").validate().resetForm()
        });

        var value = $("#password").val();
        $.validator.addMethod("checkSpecialchar", function(value) {
            return /[^\w\s]/gi.test(value);
        });
        $.validator.addMethod("checkupper", function(value) {
            return /[A-Z]/.test(value);
        });
        $.validator.addMethod("checkdigit", function(value) {
            return /[0-9]/.test(value);
        });
        // jQuery.validator.addMethod("lettersonly", function(value, element) {
        //     return this.optional(element) || /^[a-zA-Z ]+$/i.test(value);
        // });
        // jQuery.validator.addMethod("phonenumber", function(value, element) {
        //     return this.optional(element) || /^[0-9\-\(\)\s]+$/i.test(value);
        // });
        // jQuery.validator.addMethod("locationvalidation", function(value, element) {
        //     return this.optional(element) || /^[a-zA-Z, ]+$/i.test(value);
        // });
        $("#file-upload-demo").fileinput({
            'theme': 'explorer',
            'uploadUrl': '#',
            overwriteInitial: false,
        });

        $('.jobtype_filter').multiselect({
            nonSelectedText: 'Select Job Type',
        });
        $('.industry_select').multiselect({
            nonSelectedText: 'Select Industry',
        });
        $('.experience_select').multiselect({
            nonSelectedText: 'Select Experience',
        });

        $("#form_job_alert").validate({
            ignore:"",
            rules: {

                location:{
                  required:true,
                  minlength: 5,
                  maxlength: 255,
                },
                job_title: {
                    required: true,
                    lettersonly: true,
                    minlength: 5,
                    maxlength: 255,
                },
            },
            // Specify validation error messages
            messages: {
                location:{
                    required: "Location is required",
                    minlength: "Location must be at least 5 characters long",
                    maxlength: "Location must be at less than 255 characters long",
                },
                job_title: {
                    required: "Job title is required",
                    // lettersonly: "Only letters are allowed in Job Title",
                    minlength: "Job Title must be at least 5 characters long",
                    maxlength: "Job Title must be less than 255 characters",
                },


            },

            submitHandler: function(form) {
                form.submit();
            }

        });
        // jQuery.validator.addMethod("lettersonly", function(value, element) {
        //     return this.optional(element) || /^[a-zA-Z]+$/i.test(value);
        // });

    });




    $('#form_job_alert').on('keyup keypress', function(e) {
        var keyCode = e.keyCode || e.which;
        if (keyCode === 13) {
            e.preventDefault();
            return false;
        }
    });


    $(document).ready(function () {
        $('#form-job-apply')[0].reset();
        $('.industry').click(function () {
            $(this).siblings('input:checkbox').prop('checked','false');
        });
        /*0 is for Best Match Sorting by default*/
        Fun(1000,0);
    });

    $("#sel_sort_jobs").change(function () {
        var sel_option =$( "#sel_sort_jobs option:selected" ).val();
        Fun(1000,sel_option);
    });

    $('select').on('change', function() {
        Fun(1000,0);
    });

    function Fun(length,sel_option) {

        var date_filter = '';
        /*Date Filters*/
        date_filter = $('#date_filter option:selected').val();
        /*Industry filters*/
        var industry_select = $('#industry_select').val();
        /*Location Filter*/
        var experience_select = $('#experience_select').val();
        var jobtype_select = $('#jobtype_filter').val();



            var job_title=$('#search_job_title').val();
            var place=$('#search_place').val();


        $('#example-2').pagination({
            total: 1,
            current: 1,
            length: length,
            size: 1,

            ajax: function(options, refresh){

                var html='';

                $.ajax({

                    url: "{{route('ajax.searched.jobs')}}",
                    type: 'post',

                    data:{
                        current: options.current,
                        length: options.length,
                        "_token": "{{ csrf_token() }}",
                        "job_title":job_title,
                        "place":place,
                        "sel_option": sel_option,
                        date_filter : date_filter,
                        jobtype_select      : jobtype_select,
                        industry_select      : industry_select,
                        experience_select   : experience_select,
                    },
                    beforeSend: function(){
                        $.blockUI({ message: '<div class="spinner-grow text-success"></div><div class="spinner-grow text-success"></div><div class="spinner-grow text-success"></div>', css: {border:'none',
                                backgroundColor:'transparent'} });
                    },
                    complete:function(data){

                    }
                }).done(function(res) {
                    $.unblockUI();
                    var json = JSON.parse(res);

                    var myJSON = json[1];
                    var totalRe = json[0];
                    var fav_job = json[2];
                    var id=0;
                    if (totalRe > 0) {
                        var id = myJSON[0]['id']

                        // if(Number.isInteger(id)){
                        // job_details(id)
                        // }

                        document.getElementById('motivz-jobdetails-wrapper').innerHTML = '<div class="alert alert-secondary" style="width: 100%; text-align: center;" role="alert">Click on a Job to view Job Details</div>';

                        for (var i = 0; i < myJSON.length; i++) {

                            {{url("/find/Searched-jobs")}}
                            @php
                                $d=new \Carbon\Carbon();
                            @endphp
                                moment.tz.setDefault('{{$d->timezoneName}}')
                                time_ago = moment(myJSON[i]['created_at']).fromNow();
                            job_created_at = new Date(myJSON[i]['created_at']);
                            /*Change it to last 12 days for testing original condition is last 2(48 hours) days*/
                            prev_date = new Date(Date.now() - 48 * 60 * 60 * 1000);
                            if (job_created_at > prev_date) {
                                tag = "<small>NEW</small>";
                            } else {
                                tag = "";
                            }
                            for (var b = 0; b < fav_job.length; b++) {
                                var style = '';
                                if (fav_job[b]['job_id'] == myJSON[i]['id']) {
                                    style = 'color:tomato';
                                    break;
                                }
                            }
                            var package_to = '';
                            if ($.trim(myJSON[i]['package_to'])) {
                                package_to = ' - ' + myJSON[i]['package_sign'] + myJSON[i]['package_to'];
                            } else {
                                package_to = '';
                            }
                            var job_desc = myJSON[i]['job_description'];
                            // if (myJSON[i]['job_description'].length > 255) {
                            //     job_desc = myJSON[i]['job_description'].substring(0, 255) + '...';
                            //
                            // }

                            html += '<li class="col-md-12 side-jobs li_' + myJSON[i]['id'] + '" id="searched-jobslist" onclick=job_details(' + myJSON[i]['id'] + ')>' +
                                '<div class="featured-jobslist-text">' +
                                /*Put dummy image due to change in alignment*/
                                '<a href="javascript:void(0)">' +
                                '<section>' +
                                '<h2>' + myJSON[i]['job_title'] + '</h2>' +
                                '<small><a href="' + myJSON[i]['web_url'] + '" target="_blank">' + myJSON[i]['client']['company_name'] + '</a></small>' +
                                '<span class="publish"><span>' + time_ago + '</span></span>' +
                                '<div class="sidedis">' + job_desc + '</div>' +
                                '<ul class="job-location">' +
                                '<li><i class="fa fa-globe"></i> ' + myJSON[i]['location'] + '</li>' +
                                '<li><i class="fa fa-money"></i> ' + myJSON[i]['package_sign'] + myJSON[i]['package'] + package_to + '/' + setPackageType(myJSON[i]['package_type']) + '</li>' +
                                '</ul>' +
                                '</section>' +
                                '</a>' +
                                '</div>' +
                                '</li>';

                        }
                    }
                    if (html == "") {
                        document.getElementById('searched-jobslist').innerHTML = '<div class="alert alert-secondary" style="width: 100%; text-align: center;" role="alert">' + 'No results found' + '</div>';

                    } else {
                        document.getElementById('searched-jobslist').innerHTML = html;
                    }
                    job_details(id)
                    if (totalRe > 1) {
                        html = 'jobs';
                    } else {
                        html = 'job';
                    }
                    document.getElementById('total_results').innerHTML = 'Total ' + totalRe + ' ' + html + ' found';


                    refresh({
                        total: totalRe,
                        length: length
                    });
                }).fail(function(error){
                });
            }
        });
    }
    function save_fav_job(id) {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ route('Ajax.save.job') }}",
            type:"POST",
            async : false,
            data:{id : id},
            success:function(response){
                // alert(response);
                // console.log(response);
                if(response == 'saved')
                {
                    $(".icon_"+id).css('color','tomato');
                    $.notify("Job Saved Successfully",{
                        clickToHide: true,
                        autoHide: true,
                        autoHideDelay: 2000,
                        arrowShow: true,
                        arrowSize: 5,
                        breakNewLines: true,
                        elementPosition: "bottom",
                        globalPosition: "top center",
                        style: "bootstrap",
                        className: "success",
                        show: "slideDown",
                        showDuration: 200,
                        hideAnimation: "slideUp",
                        hideDuration: 200,
                        gap: 5,
                    });

                }
                else if(response=='deleted')
                {
                    $(".icon_"+id).css('color','');
                    $.notify("Removed from Saved Job Successfully",{
                        clickToHide: true,
                        autoHide: true,
                        autoHideDelay: 2000,
                        arrowShow: true,
                        arrowSize: 5,
                        breakNewLines: true,
                        elementPosition: "bottom",
                        globalPosition: "top center",
                        style: "bootstrap",
                        className: "success",
                        show: "slideDown",
                        showDuration: 200,
                        hideAnimation: "slideUp",
                        hideDuration: 200,
                        gap: 5,
                    });

                }
                else if(response=='notloggedin')
                {
                    window.location.href = "{{route('user.login')}}";
                }

            },
        });
    }

    function job_details(id) {


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ route('ajax.job.details') }}",
            type:"POST",
            async : false,
            data:{id : id},
            success:function(response){
                $(".side-jobs").removeClass('active');
                $(".li_"+id).addClass('active');
                var html='';
                var job_fav='Save Job';
                var candidate_session = '{{ Session::get('candidate_id')}}';
                var json = JSON.parse(response);

                var job = json[0];
                console.log(job);
                var candidate = json[1];
                var candidate_resumes = json[2];
                var job_check = json[3];
                var fav_job = json[4];
                if(job!=null){

                for (var b=0 ; b<fav_job.length; b++)
                {
                    var style= '';
                    if(fav_job[b]['job_id'] == job['id']){
                        style = 'color:tomato';
                        break;
                    }
                }
                var post_date= job['created_at'];
                var time_ago = moment(job['created_at']).fromNow();

                var monthShortNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
                    "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
                ];
                var d = new Date(job['created_at']);
                var created_at = d.getDate() + "-" + monthShortNames[d.getMonth()] + "-" + d.getFullYear();

                var b = new Date(job['applied_before']);
                var apply_before = b.getDate() + "-" + monthShortNames[b.getMonth()] + "-" + b.getFullYear();

                html+='<figure class="motivz-jobdetail-list">';
                if(job['client']['logo'])
                {
                    html+= '<span class="motivz-jobdetail-listthumb"><small style=""><img src="'+window.location.origin+'/user/company_logo/'+job['client']['logo']+'" alt="Company Logo"></small></span>';
                }
                html+='<figcaption>'+
                '<h2>'+job['job_title']+'</h2>'+
                '<a href="'+job['web_url']+'" target="_blank"><span>'+job['client']['company_name']+' </span></a>'+
                '<ul class="motivz-jobdetail-options">'+
                    '<li><i class="fa fa-globe"></i> '+job['location']+'</li>'+
                '<li><i class="fa fa-calendar"></i> Post Date: '+created_at+'</li>'+
                '<li><i class="fa fa-calendar"></i> Apply Before: '+apply_before+'</li>'+
                /*'<li><i class="fa fa-eye"></i> Published '+time_ago+'</li>'+*/
                '</ul>'+
                    '<a href="javascript:void(0)" class="close-job-detail" onclick="removeJobdetailClass()"><i class="fa fa-times"></i></a>';

<<<<<<< HEAD
=======
                // console.log("candidate session: "+candidate_session);
>>>>>>> new mymotivz
                if(job_check==null || job_check=='')
                {
                    /*if(candidate_session != '')
                    {*/
                        html+= '<a data-toggle="modal" id="apply_now" href="#exampleModal" class="simple-btn">Apply Now</a>';
                    /*}
                    else
                    {
                        html+= '<a href="/login" class="simple-btn">Apply Now</a>';
                    }*/
                }
                else {
                   html+='<i class="fa fa-star"></i><span>Already applied to this job</span>';
                }
<<<<<<< HEAD
                html+='<a href="javascript:void(0)" class="like-wrap" onclick="save_fav_job('+job['id']+')"><i style="'+style+'"  class="fa fa-heart icon_'+job['id']+'"></i></a>';
=======
                if(candidate_session){
                    html+='<a href="javascript:void(0)" class="like-wrap" onclick="save_fav_job('+job['id']+')"><i style="'+style+'"  class="fa fa-heart icon_'+job['id']+'"></i></a>';
                }
                else{
                    html+='<a href="#" class="like-wrap""><i style="'+style+'"  class="fa fa-heart icon_'+job['id']+'"></i></a>';
                }
>>>>>>> new mymotivz
                var package_to = '';
                if($.trim(job['package_to']))
                {
                    package_to = ' - '+job['package_sign']+job['package_to'];
                }
                else
                {
                    package_to = '';
                }


                html+='</figcaption>'+
                '</figure>'+
                '<div class="mm-motivz-jobdetail-content">'+
                    '<div class="mm-motivz-content-title"></div>'+
                '<div class="mm-motivz-jobdetail-services">'+
                    '<ul class="row">'+
                    '<li class="col-md-4">'+
                    '<i class="fa fa-money"></i>'+
                    '<div class="mm-motivz-services-text">Compensation <small>'+job['package_sign']+job['package']+package_to+'/'+setPackageType(job['package_type'])+'</small></div>'+
                '</li>'+
                '<li class="col-md-4">'+
                    '<i class="fa fa-bar-chart"></i>'+
                    '<div class="mm-motivz-services-text">Experience <small>'+job['required_experience']+' </small></div>'+
                '</li>'+
                '<li class="col-md-4">'+
                    '<i class="fa fa-book"></i>'+
                    '<div class="mm-motivz-services-text">Job Type <small>'+job['service']+' </small></div>'+
                    '</li>'+
                    '<li class="col-md-4">'+
                    '<i class="fa fa-graduation-cap"></i>'+
                   '<div class="mm-motivz-services-text">Education <small>'+job['education']['name']+'</small></div>'+
                '</li>'+
                '<li class="col-md-4">'+
                    '<i class="fa fa-filter"></i>'+
                    '<div class="mm-motivz-services-text">Industry <small>'+job['industry']['name']+'</small></div>'+
                '</li>'+
                '<li class="col-md-4">'+
                '<i class="fa fa-id-card-o"></i>'+
                '<div class="mm-motivz-services-text">Job Openings <small>'+job['job_opening']+'</small></div>'+
                '</li>'+
                '</ul>'+
                '</div>'+
                '<div class="mm-motivz-content-title"><h2>Job Description:</h2></div>'+
                '<div class="mm-motivz-description">';
                    if(job['job_description'] === '<p>&nbsp;</p>'){
                        html+='<p>N/A</p>';
                    }
                    else{
                        html+= '<p>'+job['job_description']+'</p>';
                    }


                    html+=  '</div>';



                var job_benefits =  job['job_benefits']

                if(job_benefits != null){

                    html += '<div class="mm-motivz-content-title"><h2>Job Benefits:</h2></div>'+
                        '<div class="mm-motivz-jobdetail-tags">';

                    job_benefits = job_benefits.split(",");
                    console.log("job benefits :"+job_benefits)

                    for(var c=0 ; c<job_benefits.length; c++)
                    {
                        html+='<a href="javascript:void(0)">'+job_benefits[c]+'</a>';
                    }

                }

                var certification =  job['certifications']

                if(certification != null){

                    html+='</div>'+
                        '<div class="mm-motivz-content-title"><h2>Licensure/Certification:</h2></div>'+
                        '<div class="mm-motivz-jobdetail-tags">';

                       certification = certification.split(",");

                        for(var d=0 ; d<certification.length; d++)
                        {
                            html+='<a href="javascript:void(0)">'+certification[d]+'</a>';
                        }
                    }

                var skill =  job['required_skills']
                if(skill != null){
                    html+='</div>'+
                        '<div class="mm-motivz-content-title"><h2>Required Skills:</h2></div>'+
                        '<div class="mm-motivz-jobdetail-tags">';
                    skill = skill.split(",");
                    for(var d=0 ; d<skill.length; d++){
                        html+='<a href="javascript:void(0)">'+skill[d]+'</a>';
                    }

                }



                    html+='</div>'+
                            '</div>';

                 document.getElementById('motivz-jobdetails-wrapper').innerHTML=html;
                 $("#id").val(job['id']);
                $("#company_name_popup").text(job['job_title']);
                // $("#location_popup").text(job['client']['company_name']+'-'+job['city']+','+job['state']);
                var html_popup = '';
                html_popup+= '<li><i class="fa fa-building-o"></i> '+job['client']['company_name']+'</li>'+
                            '<li><i class="fa fa-globe"></i> '+job['location']+'</li>';
                document.getElementById('location_popup').innerHTML=html_popup;
                document.getElementById('location_popup2').innerHTML=html_popup;
                $("#company_name_popup2").text(job['job_title']);
                document.getElementById('location_popup3').innerHTML=html_popup;
                $("#company_name_popup3").text(job['job_title']);
                $(".motivz-jobdetails-wrapper").addClass('active-popup');
                }else{
                    document.getElementById('motivz-jobdetails-wrapper').innerHTML='<div class="alert alert-secondary" style="width: 100%; text-align: center;" role="alert">' + 'No results found' + '</div>';

                }

            },

        });
    }
    function removeJobdetailClass()
    {
        $(".motivz-jobdetails-wrapper").removeClass('active-popup');
    }

    function chkVerifyEmailCode() {

        /*$("#verify_code_to").text('We send a verification code to '+email);*/
         $.blockUI({ message: '<div class="spinner-grow text-success"></div><div class="spinner-grow text-success"></div><div class="spinner-grow text-success"></div>', css: {border:'none',
            backgroundColor:'transparent'} });
        var email = $("#email").val();
        var code = $("#code").val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ route('job.apply.verify.mail.code') }}",
            type:"POST",
            async : false,
            data:{email : email,
                  code  : code,
                 },
            complete: function() {
                    $.unblockUI();
                },
            success:function(response){
                if(response=='success')
                {
                    $("#exampleModal2").modal("hide");
                    $("#btn_modalpopup3").click();
                    $(".terms-error").hide();
                    var filename = $('.resume').val().replace(/C:\\fakepath\\/i, '');

                    $("#review-name").text('');
                    $("#review-phone").text('');
                    $("#review-email").text('');
                    $("#review-location").text('');
                    $("#review-resume").text('');

                    $("#review-name").text($('#full_name').val());
                    $("#review-phone").text($('#phone_no').val());
                    $("#review-email").text($('#email').val());
                    $("#review-location").text($('#location').val());
                    $("#review-resume").text(filename);


                }
                else if(response=='empty')
                {
                    $("#err-code").text('Code is required.');
                    $("#err-code").show();
                }
                else if(response=='error')
                {
                    $("#err-code").text('Code is incorrect.');
                    $("#err-code").show();
                }


            },
            error: function (response) {
                $.unblockUI();
                alert('some error has occurred.')
            }
        });
    }

    function submitJobApplyForm()
    {
        if($('#terms_policy_checkbox').is(':checked')==false)
        {
            $("#terms_policy_checkbox-error").show();
            return true;
        }
        // debugger
         $.blockUI();
        var formData = new FormData($("#form-job-apply")[0]);
        $.ajax({
            url: "{{ route('job.apply.non.verify') }}",
            type:"POST",
            async : false,
            data: formData,
            dataType: "json",
            processData: false, //important to include when uploading file
            contentType: false, //important to include when uploading file
            complete: function() {
                    $.unblockUI();
                },
            success:function(response){
                if(response=='success')
                {
                    var job_title = $("#company_name_popup3").text();
                    $("#exampleModal3").modal("hide");
                    var text = document.createElement('div')
                    text.innerHTML = "Your application for the <b>"+job_title+"</b> job was successfully submitted. An email has been sent to you to confirm your job application.<br>Don’t have an account? <a href='{{route('user.signUp')}}' style='color:#4d9a10; font-weight:bold;'>Sign up</a> to experience our one-click apply feature."
                    sweetAlert({
                        title: "Complete!",
                        content: text,
                        icon: "success",
                    });

                }
                else
                {
                    sweetAlert({
                        title: "Error",
                        text: "Something went wrong,Please try again later.",
                        icon: "error",
                    });
                }


            },
        });
    }


    function hidemodal()
    {
        $('#code').val('')
        $('#err-code').css('display' , 'none')
        $("#btn_modalpopup").click();
        $("#exampleModal3").modal("hide");
    }
    function resendcode()
    {

       $.blockUI();
          var email = $("#email").val();
          var id = $("#id").val();
           $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ route('user.job.apply.verify.mail') }}",
                type:"POST",
                async : false,
                data:$("#form-job-apply").serialize(),
                success:function(response){
                    if(response=='success')
                    {
                        $.unblockUI();
                        sweetAlert({
                        title: "Success",
                        text: "Email sent successfully.",
                        icon: "success",
                    });
                    }else{
                        $.unblockUI();
                        sweetAlert({
                            title: "Error",
                            text: "Some error has occurred.",
                            icon: "error",
                        });
                    }
                },
            });
    }

    function setPackageType(package){

        return package;
    	// if(package == 'Per Year'){
    	// 	return 'annually'
    	// }
    	// else if(package == 'Per Day'){
    	// 	return 'daily'
    	// }
    	// else if(package == 'Per Month'){
    	// 	return 'monthly'
    	// }
    	// else if(package == 'Per Week'){
    	// 	return 'weekly'
    	// }
    	// else if(package == 'Per Hour'){
    	// 	return 'hourly'
    	// }
    }

</script>
    <style>
        .notifyjs-corner{
            width: 60%;
            text-align: center;
        }
    </style>
@endsection
