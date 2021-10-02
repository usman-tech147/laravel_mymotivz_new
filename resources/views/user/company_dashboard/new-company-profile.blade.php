@extends('layouts.company')

@section('content')
    <div class="app-main__inner">
        @if( session()->has('success') )
            <div style="text-align: center" class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
        <div class="card-header-tab card-header">
            <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><i
                    class="pe-7s-user mr-3 text-muted opacity-6"
                    style="font-size: 35px; color: #4d9a10 !important;"> </i>Company Profile
            </div>
        </div>
        <div class="tabs-animation">
            <div class="row">
                <div class="col-md-12">
                    <div class="main-card mb-3 card">

                        <div class="card-body">
                            <form class="underline-form" id="edit-user-company-profile">
                                @csrf
                                <input name="company_id" type="hidden" value="{{ session('c_email.id') }}">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Your Company Name</label>
                                            <input type="text" value="{{$client->company_name}}" class="form-control"
                                                   readonly>
                                        </div>
                                        @error('company_name')
                                        <label class="text-danger">{{$message}}</label>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Your Full Name</label>
                                            <input type="text" value="{{$client->name}}" class="form-control" readonly>
                                        </div>
                                        @error('name')
                                        <label class="text-danger">{{$message}}</label>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Your Title</label>
                                            <input type="text" value="{{$client->job_title}}" class="form-control"
                                                   readonly>
                                        </div>
                                        @error('job_title')
                                        <label class="text-danger">{{$message}}</label>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Phone Number</label>
                                            <input type="text" value="{{$client->phone}}" class="form-control" readonly>
                                        </div>
                                        @error('phone')
                                        <label class="text-danger">{{$message}}</label>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" value="{{$client->email}}" class="form-control" readonly>
                                        </div>
                                        @error('email')
                                        <label class="text-danger">{{$message}}</label>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Address</label>
                                            <input type="text" value="{{$client->address}}" class="form-control"
                                                   readonly>
                                        </div>
                                    </div>
                                    @if($client->complete_address != null)
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>City / State or Province</label>
                                                <input type="text" value="{{$client->complete_address}}"
                                                       class="form-control" id="location" readonly>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Zip Code</label>
                                            <input type="text"
                                                   value="@if($client->zip_code != null){{$client->zip_code}}@endif"
                                                   class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Website Address <small>(http://www.example.com)</small></label>
                                            <input type="text"
                                                   value="@if($client->web_url != null){{$client->web_url}}@endif"
                                                   class="form-control" readonly>
                                        </div>
                                        @error('web_url')
                                        <label class="text-danger">{{$message}}</label>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Industry</label>
                                            <input type="text"
                                                   value="@if($client['industry'] != null){{$client['industry']['name']}}@endif"
                                                   class="form-control" readonly>
                                        </div>
                                        @error('industry')
                                        <label class="text-danger">{{$message}}</label>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea class="form-control"
                                                      readonly="">@if($client->job_discription != null){{ ($client->job_discription) }}@endif</textarea>
                                        </div>
                                        @error('job_discription')
                                        <label class="text-danger">{{$message}}</label>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label>Profile Image</label>
                                        @if(Session::has('c_email.logo') && $client->logo != '')
                                            <br>
                                            <a href="{{ asset('/user/company_logo/') }}/{{Session('c_email.logo')}}"
                                               download class="resume_{{$client->id}}">
                                                <img style="width: 100px ; height: 100px"
                                                     src="{{ asset('/user/company_logo/') }}/{{Session('c_email.logo')}}">
                                            </a>
                                        @else
                                            <br>
                                            <label>No Image Uploaded.</label>
                                        @endif
                                    </div>
                                </div>
                                <a href="{{route('user.company.edit.dashboard')}}" class="btn btn-primary pull-right">Edit
                                    Profile</a>
                                <div class="clearfix"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

