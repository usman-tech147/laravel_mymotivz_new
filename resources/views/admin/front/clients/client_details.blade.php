@extends('admin.layouts.layouts')
<!-- Modal -->

@section('title', 'Client')
<!-- Modal -->
@section('content')
    <div class="app-main__inner">
        <div class="card-header-tab card-header">
            <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><i
                    class="pe-7s-wallet mr-3 text-muted opacity-6"
                    style="font-size: 35px;"> </i>{{$client[0]->company_name}}'s
                Details
            </div>
        </div>
        <div class="tabs-animation">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="table-responsive">
                                        <table class="table-detail table table-hover table-striped table-bordered">
                                            <tbody>
                                            <tr>
                                                <th>Date Logged:</th>
                                                <td>{{ dateFormat($client[0]->created_at)}} </td>
                                            </tr>
                                            <tr>
                                                <th>Company Name:</th>
                                                <td>{{checkValue($client[0]->company_name)}}</td>
                                            </tr>
                                            <tr>
                                                <th>Company Logo:</th>
                                                <td>
                                                    @if($client[0]->logo)
                                                        <img style="width: 100px ; height: 100px"
                                                             src="{{asset('user/company_logo/'.$client[0]->logo)}}">
                                                    @else
                                                        <img style="width: 100px ; height: 100px"
                                                             src="{{asset('user/images/avatar1.png')}}">
                                                    @endif

                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Email:</th>
                                                <td>{{checkValue($client[0]->email)}}</td>
                                            </tr>
                                            <tr>
                                                <th>Name:</th>
                                                <td>{{checkValue($client[0]->name)}}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="table-responsive">
                                        <table class="table-detail table table-hover table-striped table-bordered">
                                            <tbody>
                                            <tr>
                                                <th>Job Title:</th>
                                                <td>{{checkValue($client[0]->job_title)}}</td>
                                            </tr>
                                            <tr>
                                                <th>Zip Code:</th>
                                                <td>{{checkValue($client[0]->zip_code)}}</td>
                                            </tr>
                                            <tr>
                                                <th>Address:</th>
                                                <td>{{checkValue($client[0]->complete_address)}}</td>
                                            </tr>
                                            <tr>
                                                <th>Url:</th>
                                                <td>{{checkValue($client[0]->web_url)}}</td>
                                            </tr>
                                            <tr>
                                                <th>Industry:</th>
                                                <td>{{checkValue($industry->name)}}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table-detail table table-hover table-striped table-bordered">
                                            <tbody>
                                            <tr>
                                                <th style="vertical-align: text-top; width: 170px">Job Description:</th>
                                                @if(strlen(strip_tags($client[0]->job_discription)) > 1)
                                                    <td>{{strip_tags($client[0]->job_discription)}}</td>
                                                @else
                                                    <td>N/A</td>
                                                @endif

                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <a href="{{route('front.clients')}}" class="tag btn btn-link">Back to clients
                                        list</a>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card-header-tab card-header">
                        <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                            <i class="pe-7s-notebook mr-3 text-muted opacity-6" style="font-size: 35px;"> </i>
                            Posted Jobs
                        </div>
                    </div>
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-striped table-bordered removeborder">
                                    <tbody>
                                    <tr>
                                        <th>Job Title</th>
                                        <th>Job Type</th>
                                        <th> Status</th>
                                        <th>Action</th>
                                    </tr>
                                    @if(count($client[0]['user_jobs']) > 0)
                                        @foreach($client[0]['user_jobs'] as $job)
                                            <tr>
                                                <td>{{$job->job_title}}</td>
                                                <td>
                                                    {{$job->service}}
                                                </td>
                                                <td>
                                                    @if($job->job_approved == 0)
                                                        <span> Pending </span>
                                                    @elseif($job->job_approved == 1)
                                                        <span> Approved </span>
                                                    @elseif($job->job_approved == 2)
                                                        <span> Rejected </span>
                                                    @endif
                                                </td>
                                                <td><a href="{{route('get.front.job.details',[$job->id])}}"
                                                       class="tag">View Details</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="4" style="text-align: center"><strong>No Job Found</strong>
                                            </td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="box">
        <ul id="example-2" class="pagination"></ul>
        <div class="show"></div>
    </div>
@endsection
