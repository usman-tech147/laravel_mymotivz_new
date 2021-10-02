@extends('admin.layouts.layouts')
@section('title', 'New Client')
@section('content')
    @if(session()->has('message'))


        <div class="alert alert-success custom-toster">
            {{ session()->get('message') }}
        </div>
    @endif
    <div class="app-main__inner">
        <div class="card-header-tab card-header">
            <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><i class="pe-7s-user mr-3 text-muted opacity-6" style="font-size: 35px; color: white !important;"> </i>Add New Client</div>
        </div>
        <div class="tabs-animation">
            <div class="row">
                <div class="col-md-12">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <form id="client-validation" method="post" action="{{route('client.created')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Company Name</label>
                                            <input name="company_name" type="text"  class="form-control" placeholder="" value="{{ old('company_name') }}">
                                            @error('company_name')
                                            <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Full name</label>
                                            <input name="name" value="{{ old('name') }}" type="text" class="form-control" placeholder="">
                                            @error('name')
                                            <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Job Title</label>
                                            <input name="job_title" value="{{ old('job_title') }}" type="text" class="form-control" placeholder="">
                                            @error('job_title')
                                            <div class="error">{{ $message }}</div>
                                            @enderror

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Phone Number</label>
                                            <input name="phone" type="text" value="{{ old('phone') }}" class="form-control" placeholder="">
                                            @error('phone')
                                            <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input name="email" id="email-client" type="email" value="{{ old('email') }}" class="form-control" placeholder="">
                                            @error('email')
                                            <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>City</label>
                                            <input name="city"  value="{{ old('city') }}" type="text" class="form-control" placeholder="">
                                            @error('city')
                                            <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>State</label>
                                            <input name="state" value="{{ old('state') }}" type="text" class="form-control" placeholder="">
                                            @error('state')
                                            <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="optional">Website Address <small>(http://www.example.com)</small></label>
                                            <input name="web_url" value="{{ old('web_url') }}" type="text" class="form-control" placeholder="">
                                            @error('web_url')
                                            <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Industry</label>
                                            <input name="industry" value="{{ old('industry') }}" type="text" class="form-control" placeholder="">
                                            @error('industry')
                                            <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- value="{{ old('recruitment_pipeline') }}" -->
                                    <div class="col-md-4">
                                        <label style="opacity: 0;">Add to recruitment pipeline</label>
                                        <div class="custom-checkbox custom-control" style="margin-bottom: 10px;">
                                            <input name="recruitment_pipeline" value="1" type="checkbox"  id="a" class="custom-control-input" checked>
                                            <label class="custom-control-label" style="cursor:pointer;" for="a">Add to recruitment pipeline</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="optiona">Add Notes</label>
                                            <textarea name="note" class="form-control" placeholder="">{{ old('note') }}</textarea>
                                        </div>
                                    </div>
                                    <!-- <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Job Requirements</label>
                                            <textarea name="job_discription" value="{{ old('job_discription') }}" id="editor">
                                                        
                                                    </textarea>
                                        </div>
                                    </div> -->
                                </div>
                                <button type="submit" class="btn btn-primary pull-right">Add New Client</button>
                                <div class="clearfix"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @endsection
