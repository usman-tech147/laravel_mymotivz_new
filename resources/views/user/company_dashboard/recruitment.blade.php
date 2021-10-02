 @extends('layouts.user_layout')

@section('title' , 'Active Recruitment Services')

@section('content')
    <!--// Main Banner \\-->
    <div class="mm-subheader"><h1>Recruitment Services</h1></div>
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
                            <h2 class="form-title">Active Recruitments List</h2>
                            <div class="motivz-job-list">
                                <ul class="row">
                                @if(count($recruitment))
                                    @foreach($recruitment as $recruitment)
                                        <li class="col-md-12 rec_{{$recruitment->id}}">
                                        <div class="motivz-joblisting-classic-wrap">
{{--                                            <figure><a href="#"><img src="images/featured-img1.jpg" alt=""></a></figure>--}}
                                            <div class="motivz-joblisting-text">
                                                <div class="motivz-list-option">
                                                    <h2><a href="{{route('company.recruitment.detail',[$recruitment->id])}}">{{$recruitment->job_title}}</a></h2>
                                                    <ul>
                                                        <li><i class="fa fa-globe"></i> {{$recruitment->location}}</li>
                                                        <li><i class="fa fa-filter"></i> {{$recruitment['industry']['name']}}</li>
                                                        <li><i class="fa fa-money"></i> {{$recruitment->salary_sign}}{{$recruitment->salary}}@if(!is_null($recruitment->salary_to)) - {{$recruitment->salary_sign}}{{$recruitment->salary_to}}@endif/{{$recruitment->salary_type}}</li>
                                                    </ul>
                                                </div>
                                                <div class="motivz-job-userlist">
                                                    <a href="javascript:void(0)" onclick="recruitment_del({{$recruitment->id}})" class="motivz-option-btn">Delete</a>
                                                    <a href="{{route('company.recruitment.detail',[$recruitment->id])}}" class="motivz-option-btn">View Details</a>
                                                </div>
                                            <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                @else
                                        <div class="alert alert-secondary" style="width: 100%; text-align: center;" role="alert">No Recruitment Service Found</div>
                                @endif
                                </ul>
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
<script src="{{asset('assets/scripts/notify.min.js')}}"></script>
<script>
    function recruitment_del(id) {
        sweetAlert({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })

            .then((willDelete) => {
                if (willDelete) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "/company/recruitment/delete",
                        type:"POST",
                        async : false,
                        data:{ id : id },
                        success:function(response){
                            if(response == 'deleted')
                            {
                                $(".rec_"+id).hide();
                                $.notify("Recruitment Deleted Successfully",{
                                    clickToHide: true,
                                    autoHide: true,
                                    autoHideDelay: 2000,
                                    arrowShow: true,
                                    arrowSize: 5,
                                    breakNewLines: true,
                                    elementPosition: "bottom",
                                    globalPosition: "top center",
                                    style: "bootstrap",
                                    className: "success",
                                    show: "slideDown",
                                    showDuration: 200,
                                    hideAnimation: "slideUp",
                                    hideDuration: 200,
                                    gap: 5,
                                });
                            }
                        },
                    });
                }

            });

    }
</script>

@endsection
