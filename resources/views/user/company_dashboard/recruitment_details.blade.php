@extends('layouts.user_layout')

@section('title' , 'Recruitment Services Details')

@section('content')
    <!--// Main Banner \\-->
    <div class="mm-subheader"><h1>Job Order Details</h1></div>
    <!--// Main Banner \\-->

    <!--// Main Content \\-->
    <div class="motivz-main-content">

        <!--// Main Section \\-->
        <div class="motivz-main-section">
            <div class="container">
                <div class="row">
                    @include('user.include.client_side_bar')
                    <div class="col-md-9">
                       <div class="mm-motivz-jobdetail-content">
                            <h2 class="form-title">Job Order Details</h2>
                            <div class="motivz-table-responsives">
                                <table class="table table-detail">
                                    <tr>
                                        <th>Job Title</th>
                                        <td>{{$recruitment->job_title}}</td>
                                    </tr>
                                    <tr>
                                        <th>Education</th>
                                        <td>{{$recruitment['education']['name']}}</td>
                                    </tr>
                                    <tr>
                                        <th>Location</th>
                                        <td>{{$recruitment->location}}</td>
                                    </tr>
                                    {{--<tr>
                                        <th>State</th>
                                        <td>{{$recruitment->job_title}}</td>
                                    </tr>--}}
                                    <tr>
                                        <th>Website Address</th>
                                        <td>{{$recruitment->web_url}}</td>
                                    </tr>
                                    <tr>
                                        <th>Salary</th>
                                        <td>{{$recruitment->salary_sign}}{{$recruitment->salary}}@if(!is_null($recruitment->salary_to)) - {{$recruitment->salary_sign}}{{$recruitment->salary_to}}@endif/{{$recruitment->salary_type}}</td>
                                    </tr>
                                    <tr>
                                        <th>Type of Industry</th>
                                        <td>{{$recruitment['industry']['name']}}</td>
                                    </tr>
                                    <tr>
                                        <th>Type of service needed</th>
                                        <td>{{$recruitment->service}}</td>
                                    </tr>
                                    <tr>
                                        <th>Job Description</th>
                                        <td>{{$recruitment->job_desc}}</td>
                                    </tr>
                                    <tr>
                                        <th>Attached File</th>
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
                                </table>
                            </div>
{{--                            <a href="#" class="pull-right form-submit">Button</a>--}}
                            <div class="clearfix"></div>
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

@endsection
