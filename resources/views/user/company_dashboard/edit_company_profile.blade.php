@extends('layouts.user_layout')

@section('title' , 'Company Profile')

@section('content')
    <!--// Main Banner \\-->
    <div class="mm-subheader"><h1>Company Profile</h1></div>
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
                            <h2 class="form-title">Company Profile</h2>
                            <form id="edit-user-company-profile" class="detail_page" method="post" action="javascript:void(0)">

                                @csrf

                                <input name="company_id" type="hidden" value="{{ session('c_email.id') }}">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Your Company Name</label>
                                            <span>{{$client->company_name}}</span>
                                            @error('company_name')
                                            <label class="text-danger">{{$message}}</label>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Your Full Name</label>
                                            <span>{{$client->name}}</span>
                                            @error('name')
                                            <label class="text-danger">{{$message}}</label>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Your Title</label>
                                            <span>{{$client->job_title}}</span>
                                            @error('job_title')
                                            <label class="text-danger">{{$message}}</label>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Phone Number</label>
                                            <span>{{$client->phone}}</span>
                                            @error('phone')
                                            <label class="text-danger">{{$message}}</label>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <span>{{$client->email}}</span>
                                            @error('email')
                                            <label class="text-danger">{{$message}}</label>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Address</label>
                                            <span>{{$client->address}}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Country</label>
                                            <span>{{$client['country']['name']}}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>City</label>
                                            <span>{{$client->city}}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>State</label>
                                            <span>{{$client['state']['name']}}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Zip Code</label>
                                            <span>{{$client->zip_code}}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Website Address <small>(http://www.example.com)</small></label>
                                            <span>{{$client->web_url}}</span>
                                            @error('web_url')
                                            <label class="text-danger">{{$message}}</label>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Industry</label>
                                            <span>{{$client['industry']['name']}}</span>
                                            @error('industry')
                                            <label class="text-danger">{{$message}}</label>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Description</label>
                                            <span>{{ $client->job_discription }}</span>
                                            @error('job_discription')
                                            <label class="text-danger">{{$message}}</label>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <a href="{{route('user.company.edit.dashboard')}}" class="pull-right form-submit">Edit Company Profile</a>
                                <div class="clearfix"></div>
                            </form>
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
@section('script_client_sidebar')
@endsection

