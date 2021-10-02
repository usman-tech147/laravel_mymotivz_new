@extends('admin.layouts.layouts')
@section('title', 'Change Password')
@section('content')

{{--@if(session()->has('passchange'))--}}
{{--        <div class="alert alert-success">--}}
{{--            {{ session()->get('passchange') }}--}}
{{--        </div>--}}
{{--    @endif--}}
@if(session()->has('Password'))
        <div class="alert alert-danger">
            {{ session()->get('Password') }}
        </div>
    @endif
@if(session()->has('profile_pic'))
        <div class="alert alert-success">
            {{ session()->get('profile_pic') }}
        </div>
    @endif

<div class="app-main__inner">
                    <div class="card-header-tab card-header">
                        <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><i class="pe-7s-portfolio mr-3 text-muted opacity-6" style="font-size: 35px; color: #4d9a10 !important;"> </i>Change Password</div>
                    </div>
                    <div class="tabs-animation">                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="main-card mb-3 card">
                                    <div class="card-body">
                                          <form method="post" action="{{route('update.password')}}" id="password_form">
                                          	@csrf
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Current Password</label>
                                                        <input type="password" name="current_password" class="form-control" placeholder="******">
                                                        @error('current_password')
                                                        <div class="error">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Password</label>
                                                       <input type="password"  id="new_password" name="password" class="form-control" placeholder="******">
                                     @error('password')
                                            <div class="error">{{ $message }}</div>
                                            @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Confirm Password</label>
                                                        <input type="password" name="password_confirmation"  class="form-control" placeholder="******">
                                    @error('password_confirmation')
                                            <div class="error">{{ $message }}</div>
                                            @enderror
                                                    </div>
                                                </div>
                                               
                                            </div>
                                            <button type="submit" class="btn btn-primary pull-right">Update password</button>
                                            <div class="clearfix"></div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
    <div class="card-header-tab card-header">
                        <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><i class="pe-7s-portfolio mr-3 text-muted opacity-6" style="font-size: 35px; color: #4d9a10 !important;"> </i>Profile Picture</div>
                    </div>
                    <div class="tabs-animation">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="main-card mb-3 card">
                                    <div class="card-body">
                                          <form method="post" action="{{route('update.pic')}}" id="picture_form" enctype="multipart/form-data">
                                          	@csrf
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Select Profile Image</label>
                                                        <input name="profile_pic" type="file" class="form-control">
                                                        @error('profile_pic')
                                                        <div class="error">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary pull-right">Update Picture</button>
                                            <div class="clearfix"></div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
 
       @endsection



