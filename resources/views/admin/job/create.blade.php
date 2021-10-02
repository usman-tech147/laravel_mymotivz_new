@extends('admin.layouts.layouts')
@section('title', 'New Job')
@section('content')



<div class="app-main__inner">
                    <div class="card-header-tab card-header">
                        <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><i class="pe-7s-portfolio mr-3 text-muted opacity-6" style="font-size: 35px; color: white !important;"> </i>Add New Job      @if(session()->has('message'))
        <div class="alert alert-success custom-toster">
            {{ session()->get('message') }}
        </div>
    @endif</div>
                    </div>
                    <div class="tabs-animation">                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="main-card mb-3 card">
                                    <div class="card-body">
                                          <form id="job-validation" method="post" action="{{route('job.created')}}" enctype="multipart/form-data">
                                          	@csrf
                                            <div class="row">
                                              <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Company Name</label>
                                                        <select name="company_name" value="{{ old('company_name') }}" class="multiselect-dropdown form-control" id="">
                                                            @foreach($clients as $client)
                                                                <option value="{{$client->id}}">{{$client->company_name}}</option>
                                                            @endforeach
                                                        </select>

                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Job Title</label>
                                                        <input type="text" name="jobtitle" value="{{ old('jobtitle') }}" class="form-control" placeholder="">
                                                         @error('jobtitle')
                                            <div class="error">{{ $message }}</div>
                                            @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>City</label>
                                                        <input type="text" value="{{ old('city') }}" name="city" class="form-control" placeholder="">
                                                           @error('city')
                                            <div class="error">{{ $message }}</div>
                                            @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>State</label>
                                                        <input type="text" name="state" value="{{ old('state') }}" class="form-control" placeholder="">
                                                           @error('state')
                                            <div class="error">{{ $message }}</div>
                                            @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="optional">Website address <small>(http://www.example.com)</small></label>
                                                        <input type="text" name="web_url" value="{{ old('web_url') }}" class="form-control" placeholder="">
                                                           @error('web_url')
                                                                <div class="error">{{ $message }}</div>
                                                            @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Salary</label>
                                                        <input type="text" name="package" value="{{ old('package') }}" class="form-control" placeholder="">
                                                         @error('package')
                                            <div class="error">{{ $message }}</div>
                                            @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Types of Industry</label>
                                                        <input type="text" name="industry" value="{{ old('industry') }}" id="" class="form-control" placeholder="">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Types of service needed</label>
                                                        <select name="service" id="" class="form-control">
{{--                                                          <option value="" style="display: none;"></option>--}}
                                                          <option value="Direct">Direct Placement</option>
                                                          <option value="Temporary">Temporary Staffing</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label style="opacity: 0;">Add to recruitment pipeline</label>
                                                    <div class="custom-checkbox custom-control" style="margin-bottom: 10px;">
                                                        <input type="checkbox" name="recruitment_pipeline" checked="" id="a" class="custom-control-input" value="1">
                                                        <label class="custom-control-label" style="cursor:pointer;" for="a">Add to recruitment pipeline</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                  <div class="form-group">
                                                    <label class="optional">Job Requirements</label>
                                                    <textarea name="job_discription" id="editor">
                                                       {{ old('job_discription') }}
                                                    </textarea>
                                                  </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary pull-right">Add New Job</button>
                                            <div class="clearfix"></div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
 
       @endsection



