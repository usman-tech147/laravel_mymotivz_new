@extends('admin.layouts.layouts')
<!-- Modal -->

@section('title', 'New Clients Database')
<!-- Modal -->
@section('content')

    <div class="app-main__inner">
        <div class="card-header-tab card-header">
            <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><i
                    class="pe-7s-wallet mr-3 text-muted opacity-6" style="font-size: 35px;"> </i> {{$candidate->name}}'s
                Profile Details
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
                                                <td> {{dateFormat($candidate->created_at)}} </td>
                                            </tr>
                                            <tr>
                                                <th>Profile Image:</th>
                                                <td>
                                                    @if($candidate->prof_image)
                                                        <img style="width: 100px ; height: 100px"
                                                             src="{{asset('/uploads/Candidate_Profile_Images/'.$candidate->prof_image)}}">
                                                    @else
                                                        <img style="width: 100px ; height: 100px"
                                                             src="{{asset('user/images/avatar1.png')}}">
                                                    @endif

                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Full Name:</th>
                                                <td id="candidate_database_name_2164">{{checkValue($candidate->name)}}</td>
                                            </tr>
                                            <tr>
                                                <th>Salary Requirements:</th>
                                                <td>
                                                    {{packageFormat($candidate->salary,
                                                    $candidate->salary_to,$candidate->salary_sign,
                                                    $candidate->salary_type)}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Phone Number:</th>
                                                <td>{{checkValue($candidate->phone)}}</td>
                                            </tr>
                                            <tr>
                                                <th>Industry:</th>
                                                <td><small class="borders">
                                                        @if($candidate->industry)
                                                            {{$candidate->industry->name}}
                                                        @else
                                                            N/A
                                                        @endif
                                                    </small>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Email:</th>
                                                <td>{{checkValue($candidate->email)}}</td>
                                            </tr>
                                            <tr>
                                                <th>Location:</th>
                                                <td>{{checkValue($candidate->location)}}</td>
                                            </tr>
                                            <tr>
                                                <th>Experience:</th>
                                                <td>{{checkValue($candidate->experience)}}</td>
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
                                                <th>Education:</th>
                                                <td id="edu-cls">
                                                    @if($candidate->education)
                                                        {{$candidate->education->name}}
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Linkedin Url:</th>
                                                <td id="edu-cls">
                                                    @if($candidate->linkedin_url)
                                                        {{$candidate->linkedin_url}}
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Authorization Status:</th>
                                                <td id="edu-cls">
                                                    @if($candidate->auth_status)
                                                        {{$candidate->auth_status}}
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th> Job Title:</th>
                                                <td>
                                                    @if(count($job_titles) > 0)
                                                        @foreach($job_titles as $job)
                                                            <span> {{$job}} </span>
                                                        @endforeach
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th> Certifications:</th>
                                                <td>
                                                    @if(count($certifications) > 0)
                                                        @foreach($certifications as $certification)
                                                            <span> {{$certification}} </span>
                                                        @endforeach
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Skills:</th>
                                                <td>
                                                    @if(count($skills) > 0)
                                                        @foreach($skills as $skill)
                                                            <span> {{$skill}} </span>
                                                        @endforeach
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Interest:</th>
                                                <td>
                                                    @if(count($interests)>0)
                                                        @foreach($interests as $interest)
                                                            <span> {{$interest}} </span>
                                                        @endforeach
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Status:</th>
                                                <td>
                                                    @if($candidate->job_title && $candidate->salary)
                                                        <span> Registered </span>
                                                    @else
                                                        <span> Not Registered </span>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Resume:</th>
                                                <td>
                                                    @if(!empty($resume))
                                                        <a target="_blank"
                                                           href="{{asset('/files/'.$resume->resume)}}"
                                                           style="font-size: 45px; margin: 0px 10px 0px 0px;"
                                                           data-toggle="tooltip" title="" class="fa fa-file-pdf-o"
                                                           data-original-title="pdf FILE">
                                                        </a>
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
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
                                                <th style="vertical-align: text-top; width: 280px">Professional
                                                    Summary:
                                                </th>
                                                <td>
                                                    @if($candidate->prof_summary)
                                                        {{$candidate->prof_summary}}
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <a href="{{route('front.candidates')}}" class="tag btn btn-link">Back to candidates
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
                            <i class="pe-7s-notebook mr-3 text-muted opacity-6" style="font-size: 35px;"> </i>Applied
                            Jobs
                        </div>
                    </div>
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-striped table-bordered removeborder">
                                    <tbody>
                                    <tr>
                                        <th>Job Title</th>
                                        <th>Company Name</th>
                                        <th>Industry</th>
                                        <th>Action</th>
                                    </tr>
                                    @if(count($candidate_jobs) > 0)
                                        @foreach($candidate_jobs as $job)
                                            <tr>
                                                <td>{{$job->job->job_title}}</td>
                                                <td>
                                                    @if($job->job->client)
                                                        {{$job->job->client->company_name}}
                                                    @else
                                                        MyMotivz
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($job->job->industry)
                                                        {{$job->job->industry->name}}
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                                <td><a href="{{route('get.front.job.details',[$job->job->id])}}"
                                                       class="tag">View Details</a></td>
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
