@extends('admin.layouts.layouts')

@section('content')

    <div class="app-main__inner">
<div class="col-md-12">
    <div class="card mb-3">
    <div class="card-header-tab card-header">
        <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><i class="pe-7s-notebook mr-3 text-muted opacity-6" style="font-size: 35px;"> </i>Job Details</div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="table-data-ajax" class="table-detail table table-hover table-striped table-bordered">
                <tr id="job-del-' + json[i]['id'] + '"></tr>
                <tr><th>Job Posting Date:</th><td>{{$jobDetail[0]['created_at']}}</td></tr>
                <tr><th>Job Title:</th><td>{{$jobDetail[0]['jobtitle']}}</td></tr>
                <tr> <th>Company Name:</th><td>{{$companyName}}</td></tr>
                <tr><th>City:</th><td>{{$jobDetail[0]['city']}}</td> </tr>
                <tr> <th>State:</th> <td>{{$jobDetail[0]['state']}}</td></tr>
                <tr><th>Website Address:</th><td>{{$jobDetail[0]['web_url']}}</td></tr>
                <tr> <th>Compensation Package:</th><td>{{$jobDetail[0]['package']}}</td> </tr>
                <tr> <th>Types of Industry:</th> <td>{{$jobDetail[0]['industry']}}</td></tr>
                <tr><th>Types of service needed:</th> <td>{{$jobDetail[0]['service']}}</td></tr>
                <tr> <th style="vertical-align: top;">Job Requirements:</th><td> <div class="job-requirements"> <P>{!! $jobDetail[0]['job_discription']!!}</P></div></td></tr>
            </table>
            <a class="btn btn-success" href="{{route('job.database')}}">View All Jobs</a>
            <div id="buttons-job"></div>
        </div>
        <div class="clearfix"></div>
    </div>
    </div>
</div>
    </div>

@endsection