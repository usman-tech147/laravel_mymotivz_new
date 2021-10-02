@extends('layouts.user_layout')

@section('title' , 'Profile Settings')

@section('content')
    <div class="mm-subheader"><h1>Change Password</h1></div>

    <div class="motivz-main-content">

        <!--// Main Section \\-->
        <div class="motivz-main-section">
            <div class="container">

                <div class="row">
                    @include('user.include.candidate_side_bar')


                    <div class="col-md-9">
                        @if(Session::has('pass_changed'))
                            <div class="alert alert-success" role="alert">
                                {{Session::get('pass_changed')}}
                            </div>
                        @endif
                        @if(Session::has('old_pass_not_match'))
                            <div class="alert alert-danger" role="alert">
                                {{Session::get('old_pass_not_match')}}
                            </div>
                        @endif
                        <div class="mm-motivz-jobdetail-content">
                            <h2 class="form-title">Update Your Password</h2>
                            <div class="password-change">
                                <form action="{{route('candidate.change.password')}}" method="POST" enctype="multipart/form-data" name="change_pass_form" id="change_pass_form" autocomplete="off">
                                    @csrf
                                    <ul>
                                        <li>
                                            <label>Old Password</label>
                                            <input type="password" name="old_pass" class="form-control" placeholder="Old Password">
                                            @error('old_pass')
                                            <label class="text-danger">{{$message}}</label>
                                            @enderror
                                        </li>
                                        <li>
                                            <label>New Password</label>
                                            <input type="password" name="new_pass" id="new_pass" class="form-control" placeholder="New Password">
                                            @error('new_pass')
                                            <label class="text-danger">{{$message}}</label>
                                            @enderror
                                        </li>
                                        <li>
                                            <label>Confirm New Password</label>
                                            <input type="password" name="new_pass_confirm" class="form-control" placeholder="Confirm New Password">
                                            @error('new_pass_confirm')
                                            <label class="text-danger">{{$message}}</label>
                                            @enderror
                                        </li>
                                        <li class="full"> <input type="submit" value="Change Password" class="form-submit"></li>
                                    </ul>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--// Main Section \\-->

    </div>
@stop

@section('script')
    <link href="{{asset('css/bootstrap-tagsinput.css')}}" rel="stylesheet">
    <script src="{{asset('js/bootstrap-tagsinput.js')}}"></script>
    <script src="{{asset('assets/scripts/notify.min.js')}}"></script>
    <script>

        $( document ).ready(function() {
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


            $("#change_pass_form").validate({
                rules: {
                    old_pass:{
                        required:true,
                    },
                    new_pass:{
                        required: true,
                        minlength:6,
                        maxlength : 20,
                        checkSpecialchar:true,
                        checkupper: true,
                        checkdigit: true,
                    },
                    new_pass_confirm: {
                        required: true,
                        equalTo: "#new_pass",
                    },
                },
                messages: {
                    old_pass:{
                        required:"Old Password is required.",
                    },
                    new_pass: {
                        required: "Please Enter Password.",
                        minlength: "Password must be minimum 6 characters long.",
                        maxlength: "Password must be less than 20 characters.",
                        checkSpecialchar : "Password must contain at least 1 special character.",
                        checkupper: 'Password must contain at least one upper case character.',
                        checkdigit: 'Password must contain at least one digit.',

                    },
                    new_pass_confirm: {
                        required: "Please Enter Confirm Password.",
                        equalTo: "Password did not match.",
                    },
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
            var value = $("#new_pass").val();
            $.validator.addMethod("checkSpecialchar", function(value) {
                return /[^\w\s]/gi.test(value);
            });
            $.validator.addMethod("checkupper", function(value) {
                return /[A-Z]/.test(value);
            });
            $.validator.addMethod("checkdigit", function(value) {
                return /[0-9]/.test(value);
            });
        });
    </script>
    @yield('script_cand_sidebar')
@endsection
