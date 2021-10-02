@extends('layouts.login-layout')
@section('title','Update Password')
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
                                <h1>Update Password</h1>
                                @if( session()->has('error') )
                                    <div class="alert alert-danger">
                                        {{ session()->get('error') }}
                                    </div>
                                @endif
                                @if( session()->has('success') )
                                    <div class="alert alert-success">
                                        {{ session()->get('success') }}
                                    </div>
                                @endif
                                <form id="user-update-password-form" method="post" action="{{ route('user.update.Password') }}">
                                    <input name="code" type="hidden" value="{{ $code }}">
                                    @csrf

                                    <ul>
                                        <li>
                                            <i class="fa fa-lock"></i>
                                            <input id="password" name="password" type="password" class="form-control" placeholder="Password">
                                            @error('password')
                                                <label id="password_confirmation-error" class="error" for="email">{{ $message }}</label>
                                            @enderror
                                        </li>
                                        <li>
                                            <i class="fa fa-lock"></i>
                                            <input name="password_confirmation" type="password" class="form-control" placeholder="Confirm Password">
                                            @error('password_confirmation')
                                                <label id="password_confirmation-error" class="error" for="email">{{ $message }}</label>
                                            @enderror
                                        </li>
{{--                                        <li><a class="forgot-password" href="{{ route('user.forgot.password') }}">Forgot your password?</a></li>--}}
                                        <li class="center"><input type="submit" value="Update" class="submit"></li>
                                        <li class="center"><p><a href="{{ route('user.login') }}">Login to my account</a></p></li>
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

    <script>
        $( document ).ready(function() {

            $("#user-update-password-form").validate({
                rules: {

                    password: {
                        required: true,
                        minlength:6,
                        maxlength : 20,
                        checkSpecialchar:true,
                        checkupper: true,
                        checkdigit: true,
                    },
                    password_confirmation: {
                        required: true,
                        equalTo: "#password",
                    },
                },
                messages: {

                    password: {
                        required: "Please Enter Password.",
                        minlength: "Password must be minimum 6 characters long.",
                        maxlength: "Password must be less than 20 characters.",
                        checkSpecialchar : "Password must contain at least 1 special character.",
                        checkupper: 'Password must contain at least one upper case character.',
                        checkdigit: 'Password must contain at least one digit.',

                    },
                    password_confirmation: {
                        required: "Please Enter Confirm Password.",
                        equalTo: "Password did not match.",
                    },
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