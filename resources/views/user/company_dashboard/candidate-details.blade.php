@extends('layouts.user_layout')

@section('title' , 'Candidates Details')

@section('content')

    <!--// Subheader \\-->
    <div class="mm-subheader" style="height: 230px;"><h1></h1></div>
    <!--// Subheader \\-->
    <!--// Main Content \\-->
    <div class="motivz-main-content">

        <!--// Main Section \\-->
        <div class="motivz-main-section motivz-typo-wrapfull">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="motivz-typo-wrap candidate">
                            <figure class="motivz-jobdetail-list">
                                <span class="motivz-jobdetail-listthumb"><small
                                        style="background-position: top; background-image: url('@if(!empty($candidate->prof_image)){{asset('/uploads/Candidate_Profile_Images/'.$candidate->prof_image)}} @else {{asset('user/images/avatar1.png')}} @endif');"></small></span>
                                <figcaption>
                                    <h2>{{$cand_apply_job->name}}
                                        <small>( @if(!empty($candidate->job_title)){{$candidate->job_title}}@else
                                                N/A @endif )</small></h2>
                                    <ul class="motivz-jobdetail-options">
                                        <li><i style="color:#999999;"
                                               class="fa fa-map-marker"></i>{{$cand_apply_job->location}}</li>
                                        <li><i class="fa fa-envelope"></i> {{$candidate->email}}</li>
                                        <li><i class="fa fa-phone"></i> {{$cand_apply_job->phone}}</li>
                                    </ul>
                                    <ul class="social-net">
                                        @if($candidate->linkedin_url)
                                            <li><a href="{{$candidate->linkedin_url}}" target="_blank"
                                                   class="fa fa-linkedin"></a></li>
                                        @endif
                                    </ul>
                                </figcaption>
                            </figure>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="mm-motivz-jobdetail-content">
                            <div class="mm-motivz-content-title"><h2>Professional Summary</h2></div>
                            <div class="mm-motivz-description">
                                <p>@if(!empty($candidate->prof_summary)){{$candidate->prof_summary}}@else N/A @endif</p>
                            </div>
                            <div class="mm-motivz-content-title"><h2>Skills</h2></div>
                            <div class="mm-motivz-jobdetail-tags" style="margin: 0px 0px 30px;">
                                @if(!empty($candidate->skills))
                                    @php
                                        $skills= explode(',',$candidate->skills);
                                    @endphp
                                    @foreach($skills as $skill)
                                        <a href="javascript:void(0)">{{$skill}}</a>
                                    @endforeach
                                @else
                                    <a href="javascript:void(0)">N/A</a>
                                @endif
                            </div>
                            <div class="mm-motivz-content-title"><h2>Basic Information</h2></div>
                            <div class="basic-information">
                                <ul>
                                    <li>
                                        <span>Job Title</span>
                                        {{--<p>@if(!empty($candidate->job_title)){{$candidate->job_title}}@else N/A @endif</p>--}}
                                        @if(!empty($candidate->job_title))
                                            @php
                                                $job_title= explode(',',$candidate->job_title);
                                            @endphp
                                            <p>@foreach($job_title as $job_title)<span>{{$job_title}}</span>@endforeach
                                            </p>
                                        @else
                                            <p><span>N/A</span></p>
                                        @endif
                                    </li>
                                    <li>
                                        <span>Location</span>
                                        <p>{{$cand_apply_job->location}}</p>
                                        {{--                                        @if(!empty($candidate->location))--}}
                                        {{--                                            @php--}}
                                        {{--                                                $locations= explode(',',$candidate->location);--}}
                                        {{--                                            @endphp--}}
                                        {{--                                            <p>@foreach($locations as $location)<span>{{$location}}</span>@endforeach</p>--}}
                                        {{--                                        @else--}}
                                        {{--                                            <p><span>N/A</span></p>--}}
                                        {{--                                        @endif--}}
                                    </li>
                                    <li>
                                        <span>Interest</span>
                                        @if(!empty($candidate->interest))
                                            @php
                                                $interests= explode(',',$candidate->interest);
                                            @endphp
                                            <p>@foreach($interests as $interest)<span>{{$interest}}</span>@endforeach
                                            </p>
                                        @else
                                            <p><span>N/A</span></p>
                                        @endif
                                    </li>
                                    <li>
                                        <span>Licensure/Certification</span>
                                        @if(!empty($candidate->certifications))
                                            @php
                                                $certifications= explode(',',$candidate->certifications);
                                            @endphp
                                            <p>@foreach($certifications as $certification)
                                                    <span>{{$certification}}</span>@endforeach</p>
                                        @else
                                            <p><span>N/A</span></p>
                                        @endif
                                    </li>
                                    <li>
                                        <span>Experience</span>
                                        <p>@if(!empty($candidate->experience)){{$candidate->experience}}@else
                                                N/A @endif</p>
                                    </li>
                                    <li>
                                        <span>Education</span>
                                        @if(!empty($candidate->education_id))
                                            <p>{{$candidate->education->name}}</p> @else <p>N/A</p> @endif
                                    </li>
                                    <li>
                                        <span>Industry</span>
                                        <p>@if(!empty($candidate->industry_id)){{$candidate->industry->name}}@else
                                                N/A @endif</p>
                                    </li>
                                    <li>
                                        <span>Authorization Status</span>
                                        <p>@if(!empty($candidate->auth_status)){{$candidate->auth_status}}@else
                                                N/A @endif</p>
                                    </li>

                                </ul>
                            </div>
                            @if($cand_resume)
                                <a href="/files/{{$cand_resume->resume}}" id="printtt" class="simple-btn" download>Download
                                    Resume</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--// Main Section \\-->

    </div>
    <!--// Main Content \\-->

@stop

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/printThis/1.15.0/printThis.min.js"
            integrity="sha512-d5Jr3NflEZmFDdFHZtxeJtBzk0eB+kkRXWFQqEc1EKmolXjHm2IKCA7kTvXBNjIYzjXfD5XzIjaaErpkZHCkBg=="
            crossorigin="anonymous"></script>

@endsection
