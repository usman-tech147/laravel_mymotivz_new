@extends('layouts.user1_layout')

@section('content')
    <div class="app-main__inner">
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
        <div class="card-header-tab card-header">
            <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><i class="pe-7s-lock mr-3 text-muted opacity-6" style="font-size: 35px; color: #4d9a10 !important;"> </i>Change Password</div>
        </div>
        <div class="tabs-animation">

            <div class="row">

                <div class="col-md-12">

                    <div class="main-card mb-3 card">

                        <div class="card-body">
                            <form action="{{route('candidate.change.password')}}" autocomplete="off" id="change_pass_form" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="password" name="old_pass" class="form-control" placeholder="Old Password">
                                            @error('old_pass')
                                            <label class="text-danger">{{$message}}</label>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="password" class="form-control" name="new_pass" id="new_pass" placeholder="New Password">
                                            @error('new_pass')
                                            <label class="text-danger">{{$message}}</label>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="password" name="new_pass_confirm" class="form-control" placeholder="Confirm New Password">
                                            @error('new_pass_confirm')
                                            <label class="text-danger">{{$message}}</label>
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
    <link href="{{asset('css/bootstrap-tagsinput.css')}}" rel="stylesheet">
    <script src="{{asset('js/bootstrap-tagsinput.js')}}"></script>
    <script src="{{asset('assets/scripts/notify.min.js')}}"></script>

    <script>
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
    </script>
@endsection


