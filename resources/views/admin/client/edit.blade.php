@extends('admin.layouts.layouts')
@section('title', 'Edit Client')
@section('content')
<div class="app-main__inner">
    <div class="card-header-tab card-header">
        <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><i class="pe-7s-settings mr-3 text-muted opacity-6" style="font-size: 35px; color: white !important;"> </i>Edit Client Details</div>
    </div>
    <div class="tabs-animation">
        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <form id="edit-client-validation" method="post" action="{{route('client.edit.submit')}}">
                            @csrf
                            <input name="client_id" type="hidden" value="{{$client[0]->id}}">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Company Name</label>
                                        <input name="company_name" value="{{$client[0]->company_name}}" type="text" class="form-control" placeholder="">
                                        @error('company_name')
                                        <div class="error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Full name</label>
                                        <input name="name" value="{{$client[0]->name}}" type="text" class="form-control" placeholder="">
                                        @error('name')
                                        <div class="error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Job Title</label>
                                        <input name="job_title" value="{{$client[0]->job_title}}" type="text" class="form-control" placeholder="">
                                        @error('job_title')
                                        <div class="error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Phone number</label>
                                        <input name="phone" value="{{$client[0]->phone}}" type="text" class="form-control" placeholder="">
                                        @error('phone')
                                        <div class="error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input name="email" value="{{$client[0]->email}}" type="text" class="form-control" placeholder="">
                                        @error('email')
                                        <div class="error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>City</label>
                                        <input name="city" value="{{$client[0]->city}}" type="text" class="form-control" placeholder="">
                                        @error('city')
                                        <div class="error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>State</label>
                                        <input name="state" value="{{$client[0]->state}}" type="text" class="form-control" placeholder="">
                                        @error('state')
                                        <div class="error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="optional">Website address <small>(http://www.example.com)</small></label>
                                        <input name="web_url" value="{{$client[0]->web_url}}" type="text" class="form-control" placeholder="">
                                        @error('web_url')
                                        <div class="error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Industry</label>
                                        <input name="industry" value="{{$client[0]->industry}}" type="text" class="form-control" placeholder="">
                                        @error('industry')
                                        <div class="error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label style="opacity: 0;">Add to recruitment pipeline</label>
                                    <div class="custom-checkbox custom-control" style="margin-bottom: 10px;">
                                        <input name="recruitment_pipeline" value="1" @if($client[0]->recruitment_pipeline == 1) checked @endif type="checkbox"  id="a" class="custom-control-input">
                                        <label class="custom-control-label" style="cursor:pointer;" for="a">Add to recruitment pipeline</label>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary pull-right">Save</button>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

