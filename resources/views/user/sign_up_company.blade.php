@extends('layouts.login-layout')

@section('title' , 'Company Sign Up')

@section('content')
    <!--// Main Content \\-->
    <div class="motivz-main-content motivz-loginlayout">

        <div class="motivz-table">
            <div class="motivz-table-cell">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="login-layout">
                                <div class="center"><img src="{{ asset('user/images/logo.png') }}" alt=""></div>
                                <h1>Signup as a Company</h1>
                                @if( session()->has('email_exists') )
                                    <div class="alert alert-danger">
                                        {{ session()->get('email_exists') }}
                                    </div>
                                @endif
                                <form id="company-registration-form" method="post" action="{{ route('company.register.verify') }}">
                                    @csrf
                                    <ul>
                                        <li>
                                            <i class="fa fa-envelope"></i>
                                            <input name="email" type="email" class="form-control" placeholder="Email">
                                            @error('email')
                                            <label id="password_confirmation-error" class="error" for="email">{{ $message }}</label>
                                            @enderror
                                        </li>
                                        <li>
                                            <i class="fa fa-briefcase"></i>
                                            <input name="compnay_name" type="text" class="form-control" placeholder="Company Name">
                                            @error('compnay_name')
                                            <label id="password_confirmation-error" class="error" for="email">{{ $message }}</label>
                                            @enderror
                                        </li>
                                        <li>
                                            <i class="fa fa-lock"></i>
                                            <input id="password" name="password" type="password" class="form-control" placeholder="Password">
                                            <label class="label_info"><i data-html="true" data-toggle="tooltip"  data-placement="top" title=" *Minimum 6 characters long&#013;*Must contain at least 1 special character (@,!,#,.)&#013;*Must contain at least 1 uppercase letter&#013;*Must contain at least 1 digit number" class="fa fa-question-circle"></i></label>
                                            @error('password')
                                            <label id="password_confirmation-error" class="error" for="email">{{ $message }}</label>
                                            @enderror
                                        </li>
                                        <li>
                                            <i class="fa fa-lock"></i>
                                            <input name="password_confirmation" type="password" class="form-control" placeholder="Confirm Password">
                                        </li>
                                        <li>
                                            <label for="terms_policy_checkbox"><input name="terms_policy_checkbox" type="checkbox" class="" id="terms_policy_checkbox"> I have read, and I accept, MyMotivz's <a href="/contact/terms-of-use" style="color: #4d9a10">Terms of Use</a> and <a href="/contact/privacy-policy" style="color: #4d9a10">Privacy Policy</a>.</label>
                                        </li>
                                        <li class="center"><input type="submit" value="Sign Up" class="submit"></li>
                                        <li class="center"><p>Return to <a href="{{ route('welcome') }}">Home</a></p><p>Already have an account? <a href="{{ route('user.login') }}">Sign In</a></p>Or<p><a href="{{ route('user.signUp') }}">Signup as a Job Seeker?</a></p></li>
                                    </ul>
                                </form>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!--// Main Content \\-->
@stop

@section('script')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="{{asset('assets/scripts/notify.min.js')}}"></script>
    @if( session()->has('verifyCompnay') )
        <script type="text/javascript">
            sweetAlert({
                title: "Verify your email address",
                text: "A verification link has been sent to your email address. Please activate your account by clicking on the link to continue the registration process",
                icon: "success",
            })
        </script>

        <style>
            .notifyjs-foo-base{
                font-size: 20px;
            }
        </style>
    @endif
    <script>
        $( document ).ready(function() {

            $("#company-registration-form").validate({
                rules: {
                    email:"required" ,
                    password: {
                        required: true,
                        checkSpecialchar:true,
                        checkupper: true,
                        checkdigit: true,
                        minlength:6,
                        maxlength : 20,
                    },
                    password_confirmation: {
                        required: true,
                        equalTo: "#password",
                    },
                    compnay_name: "required",
                    terms_policy_checkbox:{
                        required:true,
                    }

                },
                messages: {
                    password: {
                        required: "Please Enter Password.",
                        checkSpecialchar : "*Minimum 6 characters long.<br/>*Must contain at least 1 special character (@,!,#,.).<br/>*Must contain at least 1 uppercase letter.<br/>*Must contain at least 1 digit number.",
                        checkupper: "*Minimum 6 characters long.<br/>*Must contain at least 1 special character (@,!,#,.).<br/>*Must contain at least 1 uppercase letter.<br/>*Must contain at least 1 digit number.",
                        checkdigit: "*Minimum 6 characters long.<br/>*Must contain at least 1 special character (@,!,#,.).<br/>*Must contain at least 1 uppercase letter.<br/>*Must contain at least 1 digit number.",
                        minlength: "*Minimum 6 characters long.<br/>*Must contain at least 1 special character (@,!,#,.).<br/>*Must contain at least 1 uppercase letter.<br/>*Must contain at least 1 digit number.",
                        maxlength: "Password must be less than 255 characters long.",

                    },
                    password_confirmation: {
                        required: "Confirm password is required.",
                        equalTo: "Password did not match.",
                    },
                    email:{
                        required: "Email is required.",
                    },
                    compnay_name:{

                        required: "Name is required.",
                    },
                    terms_policy_checkbox:{
                        required: "Kindly accept the Terms of Use and Privacy Policy."
                    }

                },
                submitHandler: function(form) {
                    form.submit();
                }
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
        });
    </script>

@endsection