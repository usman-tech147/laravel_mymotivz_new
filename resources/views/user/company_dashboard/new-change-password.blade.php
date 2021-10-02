@extends('layouts.company')

@section('content')
    <div class="app-main__inner">
        @if( session()->has('success') )
            <div style="text-align: center" class="alert alert-success">
                {{ session()->get('success') }}
            </div>

        @endif
        <div class="card-header-tab card-header">
            <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><i class="pe-7s-lock mr-3 text-muted opacity-6" style="font-size: 35px; color: #4d9a10 !important;"> </i>Change Password</div>
        </div>
        <div class="tabs-animation">
            <div class="row">
                <div class="col-md-12">
                    <div class="main-card mb-3 card">

                        <div class="card-body">
                            <form action="{{route('user.client.change-password')}}" method="post" id="company_change_password">
                                @csrf
                                @method('put')

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control" placeholder="Old Password">
                                            @if(session('danger'))
                                                <label class="error" for="password" id="password-error">{{session('danger')}}</label>
                                            @endif
                                            @error('password')
                                            <label class="error" for="password" id="password-error">{{$message}}</label>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="password" name="new_password" id="new_password" class="form-control" placeholder="New Password">
                                            @error('new_password')
                                            <label class="error" for="new_password" id="new_password-error">{{$message}}</label>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="password" name="confirm_password"  class="form-control" placeholder="Confirm New Password">
                                            @error('confirm_password')
                                            <label class="error" for="confirm_password" id="confirm_password-error">{{$message}}</label>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary pull-right">Update</button>
                                <div class="clearfix"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript" src="{{ asset('user/script/company/companyProfile.js') }}"></script>

    <script>
        $('#company_change_password').validate({
            rules:{
                password:{
                    required: true
                },
                new_password:{
                    required: true,
                    checkSpecialchar:true,
                    checkupper: true,
                    checkdigit: true,
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
                    maxlength: "New Password can contain maximum 15 characters.",
                    checkSpecialchar : "*Minimum 6 characters long.<br/>*Must contain at least 1 special character (@,!,#,.).<br/>*Must contain at least 1 uppercase letter.<br/>*Must contain at least 1 digit number.",
                    checkupper: "*Minimum 6 characters long.<br/>*Must contain at least 1 special character (@,!,#,.).<br/>*Must contain at least 1 uppercase letter.<br/>*Must contain at least 1 digit number.",
                    checkdigit: "*Minimum 6 characters long.<br/>*Must contain at least 1 special character (@,!,#,.).<br/>*Must contain at least 1 uppercase letter.<br/>*Must contain at least 1 digit number.",
                },
                confirm_password:{
                    required: "Password confirmation is required.",
                    equalTo: 'Password confirmation is incorrect.'
                }
            }
        })

        $.validator.addMethod("checkSpecialchar", function(value) {
            return /[^\w\s]/gi.test(value);
        });
        $.validator.addMethod("checkupper", function(value) {
            return /[A-Z]/.test(value);
        });
        $.validator.addMethod("checkdigit", function(value) {
            return /[0-9]/.test(value);
        });
    </script>
@endsection
