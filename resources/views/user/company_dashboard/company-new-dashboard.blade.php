@extends('layouts.company')

@section('content')
    <div class="app-main__inner">
        <div class="card-header-tab card-header">
            <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><i
                    class="pe-7s-map mr-3 text-muted opacity-6"
                    style="font-size: 35px; color: #4d9a10 !important;"> </i>Dashboard
            </div>
        </div>
        <div class="tabs-animation">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row dashboard-box-wrap">
                                <div class="col-md-6 col-xl-4">
                                    <a href="{{route('user.client.dashboard')}}" class="dashboard-box">
                                        <i class="icon-company-profile"></i>
                                        <h2>Company Profile</h2>
                                    </a>
                                </div>
                                <div class="col-md-6 col-xl-4">
                                    <a href="{{route('user.client.job.post')}}" class="dashboard-box">
                                        <i class="icon-post-jobs"></i>
                                        <h2>Post a Job</h2>
                                    </a>
                                </div>
                                <div class="col-md-6 col-xl-4">
                                    <a href="{{route('user.client.job.create')}}" class="dashboard-box">
                                        <i class="icon-recruiting-services"></i>
                                        <h2>Recruiting Services</h2>
                                    </a>
                                </div>
                                <div class="col-md-6 col-xl-4">
                                    <a href="{{route('company.recruitment')}}" class="dashboard-box">
                                        <i class="pe-7s-id"></i>
                                        <h2>Active Recruitments </h2>
                                        <small>{{$recruit}}</small>
                                    </a>
                                </div>
                                <div class="col-md-6 col-xl-4">
                                    <a href="{{route('user.client.view.job.active')}}" class="dashboard-box">
                                        <i class="icon-active-jobs"></i>
                                        <h2>Active Jobs </h2>
                                        <small>{{$active_jobs}}</small>
                                    </a>
                                </div>
                                <div class="col-md-6 col-xl-4">
                                    <a href="{{route('user.client.view.job.expired')}}" class="dashboard-box">
                                        <i class="pe-7s-shield"></i>
                                        <h2>Inactive Jobs </h2>
                                        <small>{{$expired}}</small>
                                    </a>
                                </div>
                                <div class="col-md-6 col-xl-4">
                                    <a href="javascript:void(0)" class="dashboard-box">
                                        <i class="icon-job-interview"></i>
                                        <h2>Scheduled Interviews</h2>
                                    </a>
                                </div>
                                <div class="col-md-6 col-xl-4">
                                    <a href="{{route('user.client.view.job.active')}}" class="dashboard-box">
                                        <i class="icon-job-applicants"></i>
                                        <h2>Job Applicants </h2>
                                        <span class="notification-alert">
                                            <i class="fa fa-bell"></i>
                                            <small>
                                                @if($new_applicants > 0)
                                                    {{$new_applicants}}
                                                @endif
                                            </small>
                                        </span>
                                        <!-- <small>( New)</small> -->
                                    </a>
                                </div>
                                <div class="col-md-6 col-xl-4">
                                    <a href="javascript:void(0)" class="dashboard-box">
                                        <i class="icon-message-icon"></i>
                                        <h2>Message </h2>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
