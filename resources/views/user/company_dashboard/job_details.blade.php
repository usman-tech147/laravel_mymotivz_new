@extends('layouts.user_layout')

@section('title' , 'Job Details')

@section('content')
    <!--// Subheader \\-->
    <div class="mm-subheader" style="height: 230px;"><h1></h1></div>
    <!--// Subheader \\-->

    <!--// Main Section \\-->
    <div class="motivz-main-section motivz-typo-wrapfull">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="motivz-typo-wrap">
                        <figure class="motivz-jobdetail-list" style="padding:15px 15px 0 15px !important;">
                            @php
                                if(!empty(session('c_email.logo'))){
                                $img='/user/company_logo/'.session('c_email.logo');
                                }
                                else{
                                $img='/user/images/featured-img1.jpg';
                                }
                            @endphp
                            <span class="motivz-jobdetail-listthumb"><small
                                    style="background-image: url('{{$img}}');"></small></span>
                            <figcaption>
                                <h2>{{$job->jobtitle}}</h2>
                                @php
                                    $posted_date=new Carbon($job['posted_at']);
                                    $apply_before=new Carbon($job->applied_before);
                                    $startTime = \Carbon\Carbon::parse( $job->posted_at );
                                    $endTime = \Carbon\Carbon::now();
                                    $totalDuration = $posted_date->diff($endTime);
                                    if( $totalDuration->y > 0 ) {
                                       $duration = $totalDuration->y ;
                                    }else if( $totalDuration->m > 0 ) {
                                           $duration = $totalDuration->m." year ago" ;
                                    }else if( $totalDuration->d > 0 ) {
                                           $duration = $totalDuration->d." days ago" ;
                                    }else if( $totalDuration->h > 0 ) {
                                           $duration = $totalDuration->h." hour ago" ;
                                    }else if( $totalDuration->i > 0 ) {
                                           $duration = $totalDuration->i." minutes ago" ;
                                    }else{
                                       $duration = "now" ;
                                    }
                                $newDuration=get_date_diff($endTime,$startTime);

                                @endphp
                                <h2>{{$job->job_title}}</h2>
                                <span><small class="motivz-jobdetail-type">{{$job->service}}</small><a
                                        href="{{$job->web_url}}"
                                        target="_blank">{{$job->client->company_name}}</a><small
                                        class="motivz-jobdetail-postinfo">
{{--                                        {{$newDuration}}--}}
                                        {{--                                        Posted now--}}
                                    </small>
                                </span>
                                <ul class="motivz-jobdetail-options">
                                    <li><i class="fa fa-map-marker"></i> {{$job->location}}</li>
                                    <li><i class="fa fa-calendar"></i> Post Date: {{$posted_date->format('M d Y')}}</li>
                                    <li><i class="fa fa-calendar"></i> Apply Before: {{$apply_before->format('M d Y')}}
                                    </li>
                                    <li><i class="fa fa-eye"></i> Published {{$newDuration}}</li>
                                </ul>
                            </figcaption>
                        </figure>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--// Main Section \\-->
    <!--// Main Content \\-->
    <div class="motivz-main-content" style="padding-top: 0px;">

        <!--// Main Section \\-->
        <div class="motivz-main-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="mm-motivz-jobdetail-content">
                            <div class="mm-motivz-content-title"><h2>Job Detail</h2></div>
                            <div class="mm-motivz-jobdetail-services">
                                @if(!empty($job['package_to']))
                                    @php $package_to = ' - '.$job['package_sign'].$job['package_to']; @endphp
                                @else
                                    @php $package_to = ''; @endphp
                                @endif
                                <ul class="row">
                                    <li class="col-md-4">
                                        <i class="fa fa-money"></i>
                                        <div class="mm-motivz-services-text">Compensation
                                            <small>{{$job->package_sign.$job->package.$package_to.'/'.$job->package_type}}</small>
                                        </div>
                                    </li>
                                    <li class="col-md-4">
                                        <i class="fa fa-bar-chart"></i>
                                        <div class="mm-motivz-services-text">Experience
                                            <small>{{$job->required_experience}}</small></div>
                                    </li>
                                    <li class="col-md-4">
                                        <i class="fa fa-book"></i>
                                        <div class="mm-motivz-services-text">Job Type
                                            <small>{{$job['service']}} </small></div>
                                    </li>
                                    <li class="col-md-4">
                                        <i class="fa fa-graduation-cap"></i>
                                        <div class="mm-motivz-services-text">Education
                                            <small>{{$job['education']['name']}}</small></div>
                                    </li>
                                    <li class="col-md-4">
                                        <i class="fa fa-filter"></i>
                                        <div class="mm-motivz-services-text">Industry
                                            <small>{{$job['industry']['name']}}</small></div>
                                    </li>
                                    <li class="col-md-4">
                                        <i class="fa fa-id-card-o"></i>
                                        <div class="mm-motivz-services-text">Job Openings
                                            <small>{{$job['job_opening']}} </small></div>
                                    </li>
                                </ul>
                            </div>
                            <div class="mm-motivz-content-title"><h2>Job Description</h2></div>
                            <div class="mm-motivz-description">

                                {{--                                <p> {{htmlentities($job->job_description)}} </p>--}}

                                @if(htmlentities($job->job_description) == '&lt;p&gt;&amp;nbsp;&lt;/p&gt;' ||
                                    htmlentities($job->job_description) == '&lt;p&gt; &lt;/p&gt;' ||
                                    htmlentities($job->job_description) == '&lt;p&gt; &lt;/p&gt;&lt;p&gt; &lt;/p&gt;&lt;p&gt; &lt;/p&gt;')
                                    <p> N/A </p>
                                @else
                                    <p>{!! $job->job_description !!}</p>
                                @endif
                                {{--                                <p> {{htmlentities($job->job_description)}} </p>--}}

                            </div>
                            {{--<div class="mm-motivz-content-title"><h2>What You Will Do</h2></div>
                            <div class="mm-motivz-description">
                             <p>
                                 {{$job->job_responsibilities}}
                             </p>
                            </div>--}}
                            <div class="mm-motivz-content-title"><h2>Job Benefit:</h2></div>
                            <div class="mm-motivz-jobdetail-tags">
                                @if ($job['job_benefits'] != "")
                                    @foreach(explode(',', $job['job_benefits']) as $benefits)
                                        <a href="javascript:void(0)">{{$benefits}}</a>
                                    @endforeach
                                @else
                                    <p> N/A </p>
                                @endif
                            </div>
                            <div class="mm-motivz-content-title"><h2>Required Skills:</h2></div>
                            <div class="mm-motivz-jobdetail-tags">
                                @if ($job['required_skills'] != "")
                                    @foreach(explode(',', $job['required_skills']) as $skills)
                                        <a href="javascript:void(0)">{{$skills}}</a>
                                    @endforeach
                                @else
                                    <p> N/A </p>
                                @endif
                            </div>
                            <div class="mm-motivz-content-title"><h2>Licensure/Certification:</h2></div>
                            <div class="mm-motivz-jobdetail-tags">
                                @if ($job['certifications'] != "")
                                    @foreach(explode(',', $job['certifications']) as $certification)
                                        <a href="javascript:void(0)">{{$certification}}</a>
                                    @endforeach
                                @else
                                    <p> N/A </p>
                                @endif
                            </div>
                        </div>
                    </div>
                    @if($job['job_approved'] == 1)
                        <div class="col-md-12">
                            <div class="mm-motivz-jobdetail-content">
                                <h2 class="form-title">Applied Candidates</h2>
                                <div class="motivz-job-list">
                                    <ul class="row">
                                        @if(count($candidates_applied))
                                            @foreach($candidates_applied as $candidate)
                                                @php
                                                    $duration = getHumanDate($candidate['created_at']) ;

                                                   $jobID= Crypt::encrypt($job->id);
                                                   $cand= Crypt::encrypt($candidate['candidate']['id']);
                                                @endphp
                                                <li class="col-md-12">
                                                    <div class="motivz-joblisting-classic-wrap">
                                                        <figure>
                                                            <a href="{{route('user.candidate-details',[$cand,$jobID])}}"><img
                                                                    src="@if($candidate['candidate']['prof_image']){{asset('/uploads/Candidate_Profile_Images/'.$candidate['candidate']['prof_image'])}} @else {{asset('user/images/avatar1.png')}} @endif"
                                                                    alt=""></a></figure>
                                                        <div class="motivz-joblisting-text">
                                                            <div class="motivz-list-option">
                                                                <h2>
                                                                    <a href="{{route('user.candidate-details',[$cand,$jobID])}}">{{$candidate['name']}}</a>
                                                                    <span> Applied: {{$duration}}</span>
                                                                    @if($candidate['is_new'])
                                                                        <span style="background-color: red"> New </span>
                                                                    @endif
                                                                </h2>
                                                                {{--                                                                <span> Applied: {{$duration}}</span></h2>--}}
                                                                <ul>
                                                                    @if(!empty($candidate['candidate']['job_title']))

                                                                        <li>
                                                                            <a href="javascript:void(0)">{{str_replace(',',', ',$candidate['candidate']['job_title'])}} </a>
                                                                        </li>
                                                                    @else
                                                                        <li><a href="javascript:void(0)">N/A</a></li>
                                                                    @endif
                                                                    <li>
                                                                        <i class="fa fa-phone"></i> {{$candidate['phone']}}
                                                                    </li>
                                                                    @if(!empty($candidate['candidate']['education_id']))
                                                                        <li>
                                                                            <i class="fa fa-graduation-cap"></i> {{$candidate['candidate']['education']['name']}}
                                                                        </li>
                                                                    @else
                                                                        <li><i class="fa fa-graduation-cap"></i> N/A
                                                                        </li>
                                                                    @endif
                                                                    <li>
                                                                        <i class="fa fa-globe"></i>{{$candidate['location']}}
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="motivz-job-userlist">
                                                                <a href="{{route('user.candidate-details',[$cand,$jobID])}}"
                                                                   class="motivz-option-btn">View Details</a>
                                                            </div>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        @else
                                            {{--                                        <li class="col-md-12">No Candidate Applied Yet</li>--}}
                                            <div class="alert alert-secondary" style="width: 100%; text-align: center;"
                                                 role="alert">No Candidate Applied Yet
                                            </div>
                                        @endif
                                    </ul>
                                </div>
                                <div class="pagination-wrap">

                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <!--// Main Section \\-->

    </div>
    <!--// Main Content \\-->
@stop

@section('script')
    <script type="text/javascript" src="{{ asset('user/script/company/activeJobs.js') }}"></script>
@endsection
