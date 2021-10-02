@extends('layouts.login-layout')
@section('title','Login')
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
                                <h1>Sign In</h1>
                                @if( session()->has('error') )
                                    <div class="alert alert-danger alert-dismissible">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        {{ session()->get('error') }}
                                    </div>
                                @endif
                                @if( session()->has('success') )
                                    <div class="alert alert-success alert-dismissible">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        {{ session()->get('success') }}
                                    </div>
                                @endif
                                <form id="user-login-form" method="post" action="{{ route('login.post') }}">
                                    @csrf
                                    <ul>
                                        <li>
                                            <label class="checks-wrap" for="chk_company"><input id="chk_company" name="chk_type" type="radio" @if(old('chk_login')!='candidate') checked @endif> <span>I'm an Employer</span></label>
                                            <label class="checks-wrap" for="chk_candidate"><input id="chk_candidate" name="chk_type" type="radio" @if(old('chk_login')=='candidate') checked @endif> <span>I'm a Job Seeker</span></label>
                                            <input type="hidden" name="chk_login" id="chk_login" value="company">
                                        </li>
                                        <li>
                                            <i class="fa fa-envelope"></i>
                                            <input name="email" type="email" class="form-control" placeholder="Email" value="{{old('email')}}">
                                            @error('email')
                                            <label id="password_confirmation-error" class="error" for="email">{{ $message }}</label>
                                            @enderror
                                        </li>
                                        <li>
                                            <i class="fa fa-lock"></i>
                                            <!-- <label></label> -->
                                            <input name="password" type="password" class="form-control" placeholder="Password">
                                            @error('password')
                                            <label id="password_confirmation-error" class="error" for="email">{{ $message }}</label>
                                            @enderror
                                        </li>
                                        <li><a class="forgot-password" href="{{ route('user.forgot.password') }}">Forgot your password?</a></li>
                                        <li class="center"><input type="submit" value="Sign In" class="submit"></li>
                                        <li class="center"><p>Return to <a href="{{ route('welcome') }}">Home</a></p></li>
                                        <li class="center"><p>Don't already have an account? <a href="{{ route('user.signUp') }}">Sign Up</a></p></li>
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
    @if( session()->has('verify') )
        <script type="text/javascript">
            sweetAlert({
                title: "Success",
                text: "A verification link has been sent to your email. Please verify your account in order to process your job application",
                icon: "success",
            })
        </script>
    @endif
    @if( session()->has('non_verify') )
        <script type="text/javascript">
            sweetAlert({
                title: "Error",
                text: "A verification link has been sent to your email. Please verify your account fist and then apply for Job.",
                icon: "warning",
            })
        </script>
    @endif
    @if( session()->has('email_exists') )
        <script type="text/javascript">
            sweetAlert({
                title: "Error",
                text: "Your account already exists. Please login first and then apply for Job.",
                icon: "warning",
            })
        </script>
    @endif
    @if( session()->has('account_del') )
        <script type="text/javascript">
            sweetAlert({
                title: "Success",
                text: "Your account deleted successfully.",
                icon: "success",
            })
        </script>
    @endif
    <script>
        $('input[type=radio][name=chk_type]').change(function() {
            if ($("#chk_company").is(":checked")) {
                $("#chk_login").val('company');
            }
            else if ($("#chk_candidate").is(":checked")) {
                $("#chk_login").val('candidate');
            }
        });
        $( document ).ready(function() {

            $("#user-login-form").validate({
                rules: {
                    email:"required" ,
                    password: "required",

                },
                messages: {
                    password: "Password is required",
                    email:{
                        required: "Email is required",
                    }
                }
            });

        });
    </script>

@endsection