@extends('layouts.company')

@section('content')
    <div class="app-main__inner">
        <div class="card-header-tab card-header">
            <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><i class="pe-7s-portfolio mr-3 text-muted opacity-6" style="font-size: 35px; color: #4d9a10 !important;"> </i>Recruitment Details</div>
        </div>
        <div class="tabs-animation">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table-detail table table-hover table-striped table-bordered">
                                    <tr>
                                        <th>Job Title</th>
                                        <td>{{$recruitment->job_title}}</td>
                                    </tr>
                                    <tr>
                                        <th>Education</th>
                                        <td>{{$recruitment['education']['name']}}</td>
                                    </tr>
                                    <tr>
                                        <th>Job Location</th>
                                        <td>{{$recruitment->location}}</td>
                                    </tr>
                                    <tr>
                                        <th>Website Address</th>
                                        <td>{{$recruitment->web_url}}</td>
                                    </tr>
                                    <tr>
                                        <th>Industry</th>
                                        <td>{{$recruitment['industry']['name']}}</td>
                                    </tr>
                                    <tr>
                                        <th>Type of service needed</th>
                                        <td>{{$recruitment->service}}</td>
                                    </tr>
                                    <tr>
                                        {{--                                        <th>Enter your desired pay</th>--}}
                                        <th>Desired pay</th>
                                        <td>{{$recruitment->salary_sign}}{{$recruitment->salary}}@if(!is_null($recruitment->salary_to)) - {{$recruitment->salary_sign}}{{$recruitment->salary_to}}@endif/{{$recruitment->salary_type}}</td>

                                    </tr>
                                    <tr>
                                        <th>Attach File</th>
                                        @if(($recruitment['document']))
                                            <td>
                                                @php
                                                    $file=$recruitment->document;
                                                    $extention=explode('.', $file)[1];
                                                    $extention=strtolower($extention);
                                                @endphp
                                                @if($extention=='pdf')
                                                    <a href="{{asset('uploads/Recruitment_Services_Files/'.$file)}}" target="_blank" data-toggle="tooltip" data-original-title="PDF File">
                                                        <i class="fa fa-file-pdf-o" style="font-size: 38px;"></i>
                                                    </a>
                                                @elseif($extention=='docx' || 'doc')
                                                    <a href="https://view.officeapps.live.com/op/embed.aspx?src={{asset('uploads/Recruitment_Services_Files/'.$file)}}" target="_blank" data-toggle="tooltip" data-original-title="@if($extention=='docx') DOCX File @elseif($extention=='doc') DOC File @endif">
                                                        <i class="fa fa-file-word-o" style="font-size: 38px;"></i>
                                                    </a>
                                                @endif
                                            </td>
                                        @else
                                            <td>No File Attached</td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <th>Job Descriptions</th>
                                        <td>{{$recruitment->job_desc}}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
