@extends('layouts.user_layout')

@section('title' , 'Candidates')

@section('content')
<!--// Main Banner \\-->
<div class="findjob-subheader"><h1>Candidates</h1></div>
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
                        <h2 class="form-title">Candidates</h2>
                        <div class="motivz-job-list">
                            <ul class="row">
                                @foreach($candidates as $candidate)
                                <li class="col-md-12">
                                    <div class="motivz-joblisting-classic-wrap">
                                        <figure><a href="{{route('user.candidate-details',[$candidate->id])}}"><img src="@if(!empty($candidate->prof_image)){{asset('/uploads/Candidate_Profile_Images/'.$candidate->prof_image)}} @else {{asset('user\images\avatar.png')}} @endif" alt=""></a></figure>
                                        <div class="motivz-joblisting-text">
                                            <div class="motivz-list-option">
                                                <h2><a href="{{route('user.candidate-details',[$candidate->id])}}">{{$candidate->name}}</a> </h2>
                                                <ul>
                                                    <li><a href="javascript:void(0)">{{$candidate->job_title}}</a></li>
                                                    <li><i class="fa fa-phone"></i> {{$candidate->phone}}</li>
                                                    <li><i class="fa fa-graduation-cap"></i> @if($candidate->education){{$candidate->education->name}}@else {{'-'}}@endif</li>
                                                    <li><i class="fa fa-globe"></i> {{$candidate->city}}, {{$candidate->state}}</li>
                                                </ul>
                                            </div>
                                            <div class="motivz-job-userlist">
                                                <a href="{{route('user.candidate-details',[$candidate->id])}}" class="motivz-option-btn">View Details</a>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="pagination-wrap">

                        </div>
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
    <script type="text/javascript" src="{{ asset('user/script/company/companyProfile.js') }}"></script>

    <script>


    </script>
@endsection
