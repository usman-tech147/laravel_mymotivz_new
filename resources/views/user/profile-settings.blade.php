@extends('layouts.user_layout')

@section('title' , 'Profile Settings')

@section('content')
 <div class="mm-subheader"><h1>Profile Settings</h1></div>

<div class="motivz-main-content">

            <!--// Main Section \\-->
            <div class="motivz-main-section">
                <div class="container">
                    @if(Session::has('updated'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{Session::get('updated')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                        @if(Session::has('deleted'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{Session::get('deleted')}}
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
                    <div class="row">
                        @include('user.include.candidate_side_bar')
                        <div class="col-md-9">
                            <div class="mm-motivz-jobdetail-content">

                                <h2 class="form-title">Update your Profile</h2>
                                <form action="{{route('candidate.saveProfile')}}" name="profile_form" id="form_profile" enctype="multipart/form-data" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Full Name</label>
                                                <input type="text" name="full_name" class="form-control" placeholder="" value="@if(!is_null($Candidate['name'])){{$Candidate->name}}@else{{old('full_name')}}@endif">
                                                @error('full_name')
                                                <label class="error">{{$message}}</label>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Job Title(s)</label>
                                                <input type="text" name="job_title" id="job_title" data-role="tagsinput" class="tags_1 tags form-control" placeholder="" value="@if(!is_null($Candidate['job_title'])){{$Candidate->job_title}}@else{{old('job_title')}}@endif">
                                                <label id="job_title-error" class="error" for="job_title" style="display: none"></label>
                                                @error('job_title')
                                                <label class="error">{{$message}}</label>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Phone Number</label>
                                                <input type="text" name="phone_no" id="phone_no" class="form-control" placeholder="" value="@if(!is_null($Candidate['phone'])){{$Candidate->phone}}@else{{old('phone_no')}}@endif">
                                                @error('phone_no')
                                                <label class="error">{{$message}}</label>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="email" name="email" class="form-control" placeholder="" value="@if(!is_null($Candidate['email'])){{$Candidate->email}}@else{{old('email')}}@endif" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Compensation</label>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text currecny_sign" id="inputGroup-sizing-default">{{$Candidate->salary_sign}}</span>
                                                            </div>
                                                            <input name="package" id="package" type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" placeholder="" value="{{$Candidate->salary}}" >
                                                        </div>
                                                    </div>
                                                    @error('package')
                                                    <label id="package-error" class="error" for="package">{{$message}}</label>
                                                    @enderror
                                                    <div class="col-md-4">
                                                        <span id="add_range" style=" @if(empty($Candidate['salary_to'])) display: block; @else display: none;  @endif text-align: center;margin: 12px 0px 0px;font-size: 17px;font-weight: 600;cursor: pointer;">+ Add Range</span>
                                                        <div class="input-group mb-3 div_package_to" @if(empty($Candidate['salary_to'])) style="display: none" @endif>
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text currecny_sign" id="inputGroup-sizing-default">{{$Candidate->salary_sign}}</span>
                                                                <input type="hidden" id="hidd_curr_sign" name="hidd_curr_sign" value="{{$Candidate->salary_sign}}">
                                                            </div>
                                                            <input name="package_to" id="package_to" type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" placeholder="To" value="{{$Candidate->salary_to}}" >
                                                        </div>
                                                    </div>
                                                    @error('package_to')
                                                    <label id="package_to-error" class="error" for="package_to">{{$message}}</label>
                                                    @enderror
                                                    <div class="col-md-2">
                                                        <div class="input-group mb-3 div_package_to" >
                                                            <select style="font-size: 12px;" name="curr_sign" id="curr_sign" class="form-control">
                                                                <option value="USD" {{ ( $Candidate->salary_sign == '$') ? 'selected' : '' }} >USD</option>
                                                                <option value="CAD" {{ ( $Candidate->salary_sign == 'C$') ? 'selected' : '' }}>CAD</option>
                                                                <option value="GBP" {{ ( $Candidate->salary_sign == '£') ? 'selected' : '' }}>GBP</option>
                                                                <option value="EUR" {{ ( $Candidate->salary_sign == '€') ? 'selected' : '' }}>EUR</option>
                                                                <option value="AUD" {{ ( $Candidate->salary_sign == 'A$') ? 'selected' : '' }}>AUD</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="input-group mb-3 div_package_to">
                                                            <select style="font-size: 12px;" name="salary_duration" id="salary_duration" class="form-control">
                                                                <option value="Per Hour" {{ ( $Candidate->salary_type == 'Per Hour') ? 'selected' : '' }}>Per Hour</option>
                                                                <option value="Per Day" {{ ( $Candidate->salary_type == 'Per Day') ? 'selected' : '' }}>Per Day</option>
                                                                <option value="Per Week" {{ ( $Candidate->salary_type == 'Per Week') ? 'selected' : '' }}>Per Week</option>
                                                                <option value="Per Month" {{ ( $Candidate->salary_type == 'Per Month') ? 'selected' : '' }}>Per Month</option>
                                                                <option value="Per Year" {{ ( $Candidate->salary_type == 'Per Year') ? 'selected' : '' }}>Per Year</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{--<div class="col-md-6">
                                            <div class="form-group">
                                                <label>Location</label>
                                                <input type="text" name="location" id="location" class="form-control" placeholder="" value="@if(!is_null($Candidate['location'])){{$Candidate->location}}@else{{old('location')}}@endif">
                                                @error('location')
                                                <label class="error">{{$message}}</label>
                                                @enderror
                                            </div>
                                        </div>--}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Job Location</label>
                                                <input type="text" name="location" id="location" data-role="tagsinput" class="tags_1 tags form-control" placeholder="" value="@if(!is_null($Candidate['location'])){{$Candidate->location}}@else{{old('location')}}@endif">
                                                <label id="location-error" class="error" for="location" style="display: none"></label>
                                                @error('location')
                                                <label class="error">{{$message}}</label>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>LinkedIn Profile (optional)</label>
                                                <input type="text" name="linkedin_url" id="linkedin_url" class="form-control" placeholder="" value="@if(!is_null($Candidate['linkedin_url'])){{$Candidate->linkedin_url}}@else{{old('linkedin_url')}}@endif">
                                                @error('linkedin_url')
                                                <label class="error">{{$message}}</label>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Interest</label>
                                                <input type="text" name="interest" id="interest" data-role="tagsinput" class="tags_1 tags form-control" placeholder="" value="@if(!is_null($Candidate['interest'])){{$Candidate->interest}}@else{{old('interest')}}@endif">
                                                <label id="interest-error" class="error" for="interest" style="display: none"></label>
                                                @error('interest')
                                                <label class="error">{{$message}}</label>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Experience</label>
                                                <select name="sel_experience" id="" class="form-control">
                                                  <option value="" selected disabled>Select Experience</option>

                                                    <option value="Intern" {{ $Candidate->experience == 'Intern' ? 'selected' : '' }}>Intern</option>
                                                    <option value="Entry Level" {{ $Candidate->experience == 'Entry Level' ? 'selected' : '' }}>Entry Level</option>
                                                    <option value="Intermediate" {{ $Candidate->experience == 'Intermediate' ? 'selected' : '' }}>Intermediate</option>
                                                    <option value="Experienced" {{ $Candidate->experience == 'Experienced' ? 'selected' : '' }}>Experienced</option>
                                                    <option value="Managerial" {{ $Candidate->experience == 'Managerial' ? 'selected' : '' }}>Managerial</option>
                                                    <option value="Directorship" {{ $Candidate->experience == 'Directorship' ? 'selected' : '' }}>Directorship</option>
                                                    <option value="Executive" {{ $Candidate->experience == 'Executive' ? 'selected' : '' }}>Executive</option>
                                                    <option value="Senior Executive" {{ $Candidate->experience == 'Senior Executive' ? 'selected' : '' }}>Senior Executive</option>
                                                </select>
                                                @error('sel_experience')
                                                <label class="error">{{$message}}</label>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Education</label>
                                                <select name="sel_education" id="" class="form-control">
                                                    <option value="" selected disabled>Select Education</option>
                                                    @foreach($Education as $education)
                                                    <option value="{{$education->id}}" {{ $education->id == $Candidate->education_id ? 'selected' : '' }}>{{$education->name}}</option>
                                                    @endforeach
                                                </select>
                                                @error('sel_education')
                                                <label class="error">{{$message}}</label>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Industry</label>
                                                    <select name="industry" id="" class="form-control">
                                                        <option value="" selected disabled>Select Industry</option>
                                                        @foreach($industries as $industry)
                                                            <option value="{{$industry->id}}" {{ $industry->id == $Candidate->industry_id ? 'selected' : '' }}>{{$industry->name}}</option>
                                                        @endforeach
                                                    </select>
                                                @error('industry')
                                                <label class="error">{{$message}}</label>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Job Type</label>
                                                <select name="sel_job_type" id="" class="form-control">
                                                  <option value="" selected disabled>Select Job Type</option>
                                                  <option value="Full-time"  {{ $Candidate->job_type == 'Full-time' ? 'selected' : '' }}>Full-time</option>
                                                  <option value="Part-time"  {{ $Candidate->job_type == 'Part-time' ? 'selected' : '' }}>Part-time</option>
                                                  <option value="Contract"   {{ $Candidate->job_type == 'Contract' ? 'selected' : '' }}>Contract</option>
                                                  <option value="Contract to Hire"   {{ $Candidate->job_type == 'Contract to Hire' ? 'selected' : '' }}>Contract to Hire</option>
                                                  <option value="Seasonal" {{ $Candidate->job_type == 'Seasonal' ? 'selected' : '' }}>Seasonal</option>
                                                  <option value="Internship" {{ $Candidate->job_type == 'Internship' ? 'selected' : '' }}>Internship</option>
                                                </select>
                                                @error('sel_job_type')
                                                <label class="error">{{$message}}</label>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Upload Resume</label>
                                                <div enctype="multipart/form-data">
                                                    <input id="file-upload-demo" name="resume" type="file">

                                                    @if(!is_null($candidate_resume))
                                                        <br>
                                                        @foreach($candidate_resume as $cand_resume)
                                                            @if (pathinfo($cand_resume->resume, PATHINFO_EXTENSION) == 'docx')
                                                                @php $class= 'fa fa-file-word-o'; @endphp
                                                            @else  @php $class= 'fa fa-file-pdf-o'; @endphp
                                                            @endif
                                                            <a href="/files/{{$cand_resume->resume}}"  download class="resume_{{$cand_resume->id}}">
                                                                <i class="{{$class}}" style="font-size: 38px;"></i>
                                                            </a>
                                                            <a href="javascript:void(0)" onclick="resume_del({{$cand_resume->id}})" class="icon_{{$cand_resume->id}}">
                                                                <i  class="fa fa-trash" style="font-size: 17px"></i>
                                                            </a>
                                                        @endforeach
                                                    @endif
                                                </div>
                                                @error('resume')
                                                <label class="error">{{$message}}</label>
                                                @enderror
                                            </div>
                                            <label id="file-upload-demo-error" style="display: none;" class="error" for="file-upload-demo">Only docx and pdf files are allowed for resume.</label>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Skills</label>
                                                <input type="text" id="skills" name="skills" data-role="tagsinput" class="tags_1 tags form-control" placeholder="" value="@if(!is_null($Candidate['skills'])){{$Candidate->skills}}@else{{old('skills')}}@endif">
                                                <label id="skills-error" class="error" for="skills" style="display: none"></label>
                                                @error('skills')
                                                <label class="error">{{$message}}</label>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Licensure/Certification</label>
                                                <input name="required_certification" data-role="tagsinput" id="required_certification" type="text" class="tags_1 tags form-control" placeholder="Use comma to separate certification" value="@if(!is_null($Candidate['certifications'])){{$Candidate->certifications}}@else{{old('required_certification')}}@endif">
                                            </div>
                                            <label id="required_certification-error" class="error" for="required_certification" style="display: none" ></label>
                                            @error('required_certification')
                                            <label id="required_certification-error" class="error" for="required_certification">{{$message}}</label>
                                            @enderror
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>What is your work authorization status?</label>
                                                <ul class="status-wrapper">
                                                    <li><label><input type="radio" name="auth_status" class="auth_status" id="auth_any_emp" value="I am authorized to work in the U.S for any employer" {{ $Candidate->auth_status == 'I am authorized to work in the U.S for any employer' ? 'checked' : '' }}> I am authorized to work in the U.S for any employer</label></li>
                                                    <li><label><input type="radio" name="auth_status" class="auth_status" id="auth_present_emp" value="I am authorized to work in the U.S for my present employer only" {{ $Candidate->auth_status == 'I am authorized to work in the U.S for my present employer only' ? 'checked' : '' }}> I am authorized to work in the U.S for my present employer only</label></li>
                                                    <li><label><input type="radio" name="auth_status" class="auth_status" id="auth_req_sponsor" value="I require sponsorship to work in the U.S" {{ $Candidate->auth_status == 'I require sponsorship to work in the U.S' ? 'checked' : '' }}> I require sponsorship to work in the U.S</label></li>
                                                </ul>
                                                <label id="auth_status-error" class="error" for="auth_status" style="display: none"></label>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                          <div class="form-group">
                                            <label>Professional Summary</label>
                                            <textarea class="form-control" name="prof_summary" id="prof_summary" placeholder="">@if(!is_null($Candidate['prof_summary'])){{$Candidate->prof_summary}}@else{{old('prof_summary')}}@endif</textarea>
                                              @error('prof_summary')
                                              <label class="error">{{$message}}</label>
                                              @enderror
                                          </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="form-submit">UPDATE PROFILE</button>
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
{{--    <link href="{{asset('css/bootstrap-tagsinput.css')}}" rel="stylesheet">--}}
{{--    <script src="{{asset('user/script/jquery.tagsinput.min.js')}}"></script>--}}
    <script src="{{asset('user/script/file-input/sortable.js')}}" type="text/javascript"></script>
    <script src="{{asset('user/script/file-input/fileinput.js')}}" type="text/javascript"></script>
    <script src="{{asset('user/script/file-input/theme.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/scripts/notify.min.js')}}"></script>

<script>
    $(function () {
        $('#interest').tagsInput({
            width: 'auto',
            defaultText: 'Use comma to separate interests'
        });
        $('#skills').tagsInput({
            width: 'auto',
            defaultText: 'Use comma to separate skills'
        });
        $('#required_certification').tagsInput({
            width: 'auto',
            defaultText: 'Use comma to separate certifications'
        });
        // $('#location').tagsInput({
        //     width: 'auto',
        //     defaultText: 'Use comma to separate locations'
        // });
        $('#job_title').tagsInput({
            width: 'auto',
            defaultText: 'Use comma to separate job title'
        });
    });
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
        $("#file-upload-demo").fileinput({
            'theme': 'explorer',
            'uploadUrl': '#',
            overwriteInitial: false,
        });
        /*Bcz in textarea space did'nt working */
        $('#prof_summary').keypress(function(e) {
            if (e.keyCode == 13) {
                e.preventDefault();
                this.value = this.value.substring(0, this.selectionStart) + "" + "\n" + this.value.substring(this.selectionEnd, this.value.length);
            }
        });
        var invalid= 0;
                $.each($("input,select,textarea","#form_profile"),function () {

                   if(!$(this).val())
                   {
                       invalid++;
                   }

                });
                if(invalid > 3){
                    $("#connect_popup").html('The profile must be completed prior to connecting with a career developer.');
                }
                else
                {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{ route('prof_completed') }}",
                        type:"POST",
                        async : false,
                        data:{},
                        success:function(response){
                            $("#connect_popup").html('Thank You for submitting your profile. One of our Career Developers will be reaching out to you shortly');

                        },
                    });

                }



    });
    function resume_del(id) {
        sweetAlert({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })

            .then((willDelete) => {
                if (willDelete) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "/candidate/delete-resume",
                        type:"POST",
                        async : false,
                        data:{ id : id },
                        success:function(response){
                            if(response == 'deleted')
                            {
                                $(".resume_"+id).hide();
                                $(".icon_"+id).hide();
                                $.notify("Resume Deleted Successfully",{
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
                        },
                    });
                }

            });

    }
    $(document).ready(function () {


         $("#form_profile").validate({
            ignore:[],
            rules: {

                full_name: {
                    required: true,
                    lettersonly: true,
                    maxlength: 255,
                },
                job_title: {
                    required: true,
                    maxlength: 255,
                },
                phone_no: {
                    required: true,
                    phonenumber:true,
                    minlength: 14,
                    maxlength: 14,
                },
                location:{
                    required: true,
                    locationvalidation: true,
                    minlength: 2,
                    maxlength:255
                } ,
                linkedin_url: {
                    url: true
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
                    greaterThan:true,
                    maxlength: 20
                    // positivedigit:true,
                } ,
                salary_duration:{
                    required: true,
                },
                skills: {
                    required: true,
                    maxlength: 500,
                },
                required_certification: {
                    required: true,
                    maxlength: 500,
                },
                interest: {
                   /* required: true,*/
                    maxlength: 255,
                },
                sel_experience: {
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
                resume: {
                    extension : 'doc|docx|pdf',
                },
                prof_summary: {
                    maxlength: 500
                },
                auth_status: {
                    required: true,
                }
            },
            // Specify validation error messages
            messages: {
                full_name: {
                    required: "Full name is required.",
                    // lettersonly: "Only letters are allowed in Full Name.",
                    maxlength: "Full Name must be less than 255 characters."
                },
                job_title: {
                    required: "Job title is required.",
                    // lettersonly: "Only letters are allowed in Job Title.",
                    maxlength: "Job Title must be less than 255 characters."
                },
                phone_no: {
                    required: "Phone number is required.",
                    phonenumber: "Phone number must be in valid format.",
                    minlength: "Phone number must be equal to 14 characters.",
                    maxlength: "Phone number must be equal to 14 characters.",
                },
                location:{
                    required: "Job location is required.",
                    locationvalidation: "Job location must be in valid format.",
                    minlength: "Job location must be at least 2 characters long.",
                    maxlength: "Job location must be less than 255 characters long."
                } ,
                linkedin_url:{
                    url: "LinkedIn url is invalid."
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
                    greaterThan: "Maximum salary range must be greater than minimum salary.",
                    maxlength: "Salary must be less than 20 characters long."
                    // positivedigit:"Salary must be positive.",
                } ,
                salary_duration:{
                    required: "Salary duration is required",
                },
                skills: {
                    required: "Skills are required.",
                    maxlength: "Skills must be less than 500 characters long."
                },
                required_certification: {
                    required: "Certification are required.",
                    maxlength: "Certification must be less than 500 characters long."
                },
                interest: {
                    /*required: "Interest is required.",*/
                    maxlength: "Interest must be at least 255 characters long.",
                },
                sel_experience: {
                    required: "Experience is required.",
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
                resume: {
                    extension: "Only pdf, doc and docx files are allowed.",
                },
                prof_summary: {
                    maxlength: "Professional summary must be less than 500 characters long.",
                },
                auth_status: {
                    required: "Authorization status is required",
                }

            },

            submitHandler: function(form) {
                form.submit();
            }

        });
        jQuery.validator.addMethod("lettersonly", function(value, element) {
            return this.optional(element) || /^[a-zA-Z ]+$/i.test(value);
        });
        jQuery.validator.addMethod("currencyvalidation", function(value, element) {
            return this.optional(element) || /^[,.?0-9]+$/i.test(value);
        });
        jQuery.validator.addMethod("phonenumber", function(value, element) {
            return this.optional(element) || /^[0-9\-\(\)\s]+$/i.test(value);
        });
        jQuery.validator.addMethod("locationvalidation", function(value, element) {
            return this.optional(element) || /^[a-zA-Z, ]+$/i.test(value);
        });
        jQuery.validator.addMethod("greaterThan", function (value, element) {
            var salary_to = value;
            var salary_from = $("#package").val();

            if (value.indexOf(',') > -1){
                salary_to = value.replace(',','');
            }
            if(salary_from.indexOf(',') > -1)
            {
                salary_from = salary_from.replace(',','');
            }
            salary_from = parseInt(salary_from);
            salary_to = parseInt(salary_to);
            if(salary_from >= salary_to)
            {
                return false;
            }
            else
            {
                return true;
            }
        });
    });

    $('#form_profile').on('keyup keypress', function(e) {
        var keyCode = e.keyCode || e.which;
        if (keyCode === 13) {
            e.preventDefault();
            return false;
        }
    });

</script>
<style>
    .error {
        color: #F00;
    }
</style>

@endsection
