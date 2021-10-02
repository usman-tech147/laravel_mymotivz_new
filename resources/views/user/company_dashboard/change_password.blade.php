@extends('layouts.user_layout')

@section('title' , 'Change Password')

@section('content')

<!--// Main Banner \\-->
<div class="mm-subheader"><h1>Change Password</h1></div>
<!--// Main Banner \\-->

<!--// Main Content \\-->
<div class="motivz-main-content">

    <!--// Main Section \\-->
    <div class="motivz-main-section">
        <div class="container">
            <div class="row">
                @include('user.include.client_side_bar')
                <div class="col-md-9">
                    <div class="mm-motivz-jobdetail-content">
                        @if( session()->has('success') )
                            <div style="text-align: center" class="alert alert-success">
                                {{ session()->get('success') }}
                            </div>

                        @endif
                        <h2 class="form-title">Update your password</h2>
                        <div class="password-change">
                            <form action="{{route('user.client.change-password')}}" method="post" id="company_change_password">
                                @csrf
                                @method('put')
                                <ul class="row">
                                    <li>
                                        <label>Old Password</label>
                                        <input type="password" class="form-control" name="password" placeholder="Type here...">
                                        @if(session('danger'))
                                        <label class="error" for="password" id="password-error">{{session('danger')}}</label>
                                        @endif
                                        @error('password')
                                        <label class="error" for="password" id="password-error">{{$message}}</label>
                                        @enderror
                                    </li>

                                    <li>
                                        <label>New Password</label>
                                        <input type="password" name="new_password" id="new_password" class="form-control" placeholder="Type here...">
                                        @error('new_password')
                                        <label class="error" for="new_password" id="new_password-error">{{$message}}</label>
                                        @enderror
                                    </li>

                                    <li>
                                        <label>Confirm New Password</label>
                                        <input type="password" name="confirm_password" class="form-control" placeholder="Type here...">
                                        @error('confirm_password')
                                        <label class="error" for="confirm_password" id="confirm_password-error">{{$message}}</label>
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
<!--// Main Content \\-->
@stop

@section('script')

    <script type="text/javascript" src="{{ asset('user/script/company/companyProfile.js') }}"></script>

    <script>
        $('#company_change_password').validate({
            rules:{
                password:{
                    required: true
                },
                new_password:{
                    required: true,
                    minlength: 8,
                    maxlength: 15
                },
                confirm_password:{
                  equalTo: '#new_password',
                    required: true,
                }
            },
            messages:{
                password:{
                    required: "Password is required."
                },
                new_password:{
                    required: "New Password is required.",
                    minlength: "New Password can contain minimum 8 characters.",
                    maxlength: "New Password can contain maximum 15 characters."
                },
                confirm_password:{
                    required: "Password confirmation is required.",
                    equalTo: 'Password confirmation is incorrect.'
                }
            }
        })
    </script>

@endsection

