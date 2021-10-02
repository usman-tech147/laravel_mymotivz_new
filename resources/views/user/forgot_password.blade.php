@extends('layouts.login-layout')
@section('title','Forgot Your Password')

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
                                <h1>Forgot Your Password</h1>
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
                                <form id="user-forgot-password-form" action="{{ route('user.forgot.password') }}" method="post">
                                    @csrf
                                    <ul>
                                        <li>
                                            <i class="fa fa-envelope"></i>
                                            <input name="email" type="email" class="form-control" placeholder="Your Email Address">
                                            @error('email')
                                            <label id="password_confirmation-error" class="error" for="email">{{ $message }}</label>
                                            @enderror
                                        </li>
                                        <li class="center"><input type="submit" value="Submit" class="submit"></li>
                                        <li class="center"><p>Return to <a href="{{ route('welcome') }}">Home</a></p><p>Don't already have an account? <a href="{{ route('user.signUp') }}">Sign Up</a></p></li>
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

            $("#user-forgot-password-form").validate({
                rules: {
                    email:"required" ,

                },
                messages: {
                    email:{
                        required: "Email is required.",
                    }
                }
            });

        });
    </script>

@endsection