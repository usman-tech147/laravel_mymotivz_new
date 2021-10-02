@extends('admin.layouts.layouts')
@section('title', 'Edit Job')
@section('content')
    {{--    {{dd($clients[1])}}--}}
    <div class="app-main__inner">
        <div class="card-header-tab card-header">
            <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><i
                    class="pe-7s-portfolio mr-3 text-muted opacity-6"
                    style="font-size: 35px; color: white !important;"> </i>Edit Job
            </div>
        </div>
        <div class="tabs-animation">
            <div class="row">
                <div class="col-md-12">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <form id="edit-job-validation" method="post" action="{{route('job.edit.submit')}}"
                                  enctype="multipart/form-data">
                                @csrf

                                <input name="id_job" type="hidden" value="{{$job[0]->id}}">

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Company Name</label>
                                            <select name="company_name" class="multiselect-dropdown form-control" id="">
                                                @foreach($clients as $client)
                                                    <option value="{{$client->id}}"
                                                            @if($client->id == $job[0]->client_id ) selected @endif>{{$client->company_name}}</option>
                                                @endforeach
                                            </select>


                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Job Title</label>
                                            <input type="text" name="jobtitle" value="{{$job[0]->jobtitle}}"
                                                   class="form-control" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>City</label>
                                            <input type="text" name="city" value="{{$job[0]->city}}"
                                                   class="form-control" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>State</label>
                                            <input type="text" name="state" value="{{$job[0]->state}}"
                                                   class="form-control" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="optional">Website address</label>
                                            <input type="text" name="web_url" value="{{$job[0]->web_url}}"
                                                   class="form-control" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Compensation Package</label>
                                            <input type="text" name="package" value="{{$job[0]->package}}"
                                                   class="form-control" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Types of Industry</label>
                                            <input type="text" name="industry" value="{{$job[0]->industry}}" id="tags_1"
                                                   class="tags form-control" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Types of service needed</label>
                                            <select name="service" id="" class="form-control">
                                                <!-- <option value="" style="display: none;"></option> -->

                                                <option value="Direct">Direct Placement</option>
                                                <option value="Temporary">Temporary Staffing</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label style="opacity: 0;">Add to recruitment pipeline</label>
                                        <div class="custom-checkbox custom-control" style="margin-bottom: 10px;">
                                            <input type="checkbox" name="recruitment_pipeline"
                                                   @if($job[0]->recruitment_pipeline == 1) checked @endif
                                                   id="a" class="custom-control-input" value="1">
                                            <label class="custom-control-label" style="cursor:pointer;" for="a">Add to
                                                recruitment pipeline</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="optional">Job Requirements</label>
                                            <textarea name="job_discription" id="editor">
                                                         <p>{{$job[0]->job_discription}}</p>
                                                    </textarea>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary pull-right">SAVE</button>
                                <div class="clearfix"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
