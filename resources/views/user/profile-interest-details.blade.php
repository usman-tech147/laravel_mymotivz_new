@extends('layouts.user_layout')

@section('title' , 'Profile Interest Details')

@section('content')
    <!-- <div class="mm-subheader"><h1>Personal Job Details</h1></div> -->

    <div class="motivz-main-content">

        <!--// Main Section \\-->
        <div class="motivz-main-section">
            <div class="container">
                @if(Session::has('updated'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{Session::get('updated')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="row">
                    <!-- @include('user.include.candidate_side_bar') -->
                    <div class="col-md-12">
                        <div class="mm-motivz-jobdetail-content details-tabswrapper">
                            <div class="motivz-details-tabs">
                                <ul>
                                    <li class="active"><span class="fa fa-id-card-o"></span><br><small>Personal Details</small></li>
                                    <li class="active"><span class="fa fa-briefcase"></span><br><small>Job Details</small></li>
                                    <li class="active"><span class="fa fa-bar-chart"></span><br><small>Qualifications</small></li>
                                    <li class="active"><span class="fa fa-money"></span><br><small>Compensation</small></li>
                                    <li class="active active-page"><span class="fa fa-handshake-o"></span><br><small>Interests</small></li>
                                </ul>
                            </div>

                            <!-- <h2 class="form-title">Interests</h2> -->
                            <form action="{{route('candidate.save.interest.details')}}" name="profile_form" id="form_profile" enctype="multipart/form-data" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-title-wrap">
                                            <h2>MOVING THE NEEDLE</h2>
                                            <h3>Tell us what you’re looking for in your next opportunity.</h3>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            @php $default_tags = 'higher pay,better benefits,leadership position' @endphp
                                            <label>Add your interests</label>
                                            <input type="text" name="interest" id="interest" data-role="tagsinput" class="tags_1 tags form-control" placeholder="" value="@if(!is_null($Candidate['interest'])){{$Candidate->interest}}@else{{$default_tags}}@endif">
                                            <label id="interest-error" class="error" for="interest" style="display: none"></label>
                                            @error('interest')
                                            <label class="error">{{$message}}</label>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <br>
                                        <a href="{{route('candidate.view.salary.details')}}"><button type="button" class="form-submit">Back</button></a>
                                        <button type="submit" class="pull-right form-submit">Submit</button>
                                        <a href="{{route('new.candidate.dashboard')}}" type="button" id="finish_latter" class="pull-right form-submit finish-later" style="margin-right: 5px">Finish Later</a>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--// Main Section \\-->

    </div>

@stop

@section('script')
    <script src="{{asset('user/script/file-input/sortable.js')}}" type="text/javascript"></script>
    <script src="{{asset('user/script/file-input/fileinput.js')}}" type="text/javascript"></script>
    <script src="{{asset('user/script/file-input/theme.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/scripts/notify.min.js')}}"></script>
    <script>

        {{--$("#finish_latter").on("click" , function (){--}}
        {{--    window.href = "{{route('new.candidate.dashboard')}}"--}}
        {{--})--}}

        $(function () {
            $('#interest').tagsInput({
                width: 'auto',
                defaultText: 'Use comma or enter to separate interest'
            });
        });
        $(document).ready(function () {
            /*Bcz in textarea space did'nt working */
            $( document ).ready(function() {
                $("#form_profile").validate({
                    ignore:[],
                    rules: {

                        interest: {
                            maxlength: 255,
                        },
                    },
                    messages: {
                        interest: {
                            maxlength: "Interest must be less than 255 characters long.",
                        },
                    },
                    submitHandler: function(form) {
                        form.submit();
                    }

                });

            });

        });
    </script>

@endsection
