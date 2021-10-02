@extends('layouts.user1_layout')
@section('content')
    <div class="app-main__inner">
        <div class="card-header-tab card-header">
            <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><i
                    class="pe-7s-user mr-3 text-muted opacity-6"
                    style="font-size: 35px; color: #4d9a10 !important;"> </i>Candidate Profile
            </div>
        </div>
        <div class="tabs-animation">
            <div class="row">
                <div class="col-md-12">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <form class="underline-form">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Full Name</label>
                                            <input type="text" class="form-control" readonly
                                                   value="{{$Candidate->name}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Phone Number</label>
                                            <input type="text" class="form-control" readonly
                                                   value="{{$Candidate->phone}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" class="form-control" readonly
                                                   value="{{$Candidate->email}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Linkedin Profile (Optional)</label>
                                            <input type="text" class="form-control" readonly
                                                   value="@if(!is_null($Candidate['linkedin_url'])){{$Candidate->linkedin_url}}@else{{old('linkedin_url')}}@endif">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Compensation</label>
                                            @if(!empty($Candidate->salary) && !empty($Candidate->salary_to))
                                                <input type="text" class="form-control" readonly
                                                       value="@if(!is_null($Candidate['salary'])){{$Candidate->salary_sign.$Candidate->salary.'-'.$Candidate->salary_sign.$Candidate->salary_to.'/'.$Candidate->salary_type}}@endif">
                                            @else
                                                <input type="text" class="form-control" readonly
                                                       value="@if(!is_null($Candidate['salary'])){{$Candidate->salary_sign.$Candidate->salary.$Candidate->salary_to.'/'.$Candidate->salary_type}}@endif">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Experience</label>
                                            <input type="text" class="form-control" readonly
                                                   value="{{$Candidate->experience}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Education</label>
                                            <input type="text" class="form-control" readonly
                                                   value="@if(!is_null($Candidate['education_id'])){{$Candidate['education']['name']}}@else @endif">

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Industry</label>
                                            <input type="text" class="form-control" readonly
                                                   value="@if(!is_null($Candidate['industry_id'])){{$Candidate['industry']['name']}}@else @endif">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Job Type</label>
                                            <input type="text" class="form-control" readonly
                                                   value="{{$Candidate->job_type}}">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Professional Summary</label>
                                            <input type="text" class="form-control" readonly
                                                   value="{{$Candidate->prof_summary}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Job Title(s)</label>
                                            <div class="form-control">

                                                @if($Candidate->skills !="")
                                                    @foreach(explode(',', $Candidate->job_title) as $title)
                                                        <span class="tag">{{$title}}</span>
                                                        {{--                                                <span class="tag">Lorem Ipsum</span>--}}
                                                        {{--                                                <span class="tag">Lorem Ipsum</span>--}}
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Job Location</label>
                                            <div class="form-control">
                                                <span>{{$Candidate['location']}}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Interest</label>
                                            <div class="form-control">

                                                @if ($Candidate['interest'] != "")
                                                    @foreach(explode(',', $Candidate['interest']) as $interest)
                                                        {{--                                                        <a href="javascript:void(0)">{{$interest}}</a>--}}
                                                        <span class="tag">{{$interest}}</span>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Skills</label>
                                            <div class="form-control">
                                                @if($Candidate->skills !="")
                                                    @foreach(explode(',', $Candidate->skills) as $skill)
                                                        <span class="tag">{{$skill}}</span>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Licensure/Certification</label>
                                            <div class="form-control">
                                                @if($Candidate->certifications !="")
                                                    @foreach(explode(',', $Candidate->certifications) as $certificate)
                                                        <span class="tag">{{$certificate}}</span>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Authorization Status</label>
                                            <input type="text" class="form-control" readonly
                                                   value="@if(!is_null($Candidate['auth_status'])){{$Candidate->auth_status}} @endif">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Resume</label>
                                            @if(count($candidate_resume))
                                                <br>
                                                @foreach($candidate_resume as $cand_resume)
                                                    @if (pathinfo($cand_resume->resume, PATHINFO_EXTENSION) == 'docx')
                                                        @php $class= 'fa fa-file-word-o'; @endphp
                                                    @else  @php $class= 'fa fa-file-pdf-o'; @endphp
                                                    @endif
                                                    <a href="/files/{{$cand_resume->resume}}" download
                                                       class="resume_{{$cand_resume->id}}">
                                                        <i class="{{$class}}" style="font-size: 38px;"></i>
                                                    </a>
                                                @endforeach
                                            @else
                                                <br>
                                                <label>No Resume Uploaded.</label>
                                            @endif

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Profile Image</label>
                                        @if(Session::has('cand_prof_img') && $Candidate->prof_image != '')
                                            <br>
                                            <a href="/uploads/Candidate_Profile_Images/{{Session('cand_prof_img')}}"
                                               download class="prof_icon_{{$Candidate->id}}">
                                                <img style="width: 100px ; height: 100px"
                                                     src="/uploads/Candidate_Profile_Images/{{Session('cand_prof_img')}}"
                                                     class="icon_{{$Candidate->prof_img}}">
                                            </a>
                                        @else
                                            <br>
                                            <label>No Image Uploaded.</label>
                                        @endif
                                    </div>
                                </div>
                                <a href="{{route('temp.candidate.dashboard')}}" class="btn btn-primary pull-right">Edit
                                    Profile</a>
                                <div class="clearfix"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
