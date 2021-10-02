@extends('layouts.user_layout')

@section('title' , 'Active Jobs')

@section('content')
    <!--// Main Banner \\-->
    <div class="findjob-subheader"><h1>Active Jobs</h1></div>
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
                            @if( session()->has('success') )
                                <div style="text-align: center" class="alert alert-success">
                                    {{ session()->get('success') }}
                                </div>
                            @endif
                            <h2 class="form-title">Active Jobs</h2>
                            <div class="motivz-job-list">
                                <ul class="row" id="searched-jobslist">

{{--                                    @foreach( $jobs as $job )--}}
{{--                                        <li class="col-md-12">--}}
{{--                                            <div class="motivz-joblisting-classic-wrap">--}}
{{--                                                <figure><a href="#"><img src="@if(!empty(session('c_email.logo'))){{ asset('user/company_logo/'.session('c_email.logo')) }} @else {{asset('user\images\featured-img1.jpg')}} @endif" alt=""></a></figure>--}}
{{--                                                <div class="motivz-joblisting-text">--}}
{{--                                                    <div class="motivz-list-option">--}}

{{--                                                        @php--}}

{{--                                                            $startTime = \Carbon\Carbon::parse( $job->posted_at );--}}
{{--                                                            $endTime = \Carbon\Carbon::parse(\Carbon\Carbon::now());--}}
{{--                                                            $totalDuration = $endTime->diff($startTime);--}}

{{--                                                            if( $totalDuration->y > 0 ) {--}}

{{--                                                                $duration = $totalDuration->y ;--}}
{{--                                                            }else if( $totalDuration->m > 0 ) {--}}
{{--                                                                    $duration = $totalDuration->m." year ago" ;--}}
{{--                                                            }else if( $totalDuration->d > 0 ) {--}}
{{--                                                                    $duration = $totalDuration->d." day ago" ;--}}
{{--                                                            }else if( $totalDuration->h > 0 ) {--}}
{{--                                                                    $duration = $totalDuration->h." hour ago" ;--}}
{{--                                                            }else if( $totalDuration->i > 0 ) {--}}
{{--                                                                    $duration = $totalDuration->i." minute ago" ;--}}
{{--                                                            }else{--}}
{{--                                                                $duration = "just now" ;--}}
{{--                                                            }--}}


{{--                                                        @endphp--}}

{{--                                                        <h2><a href="{{route('user.job.details',[$job->id])}}">{{ $job->jobtitle }}</a> <span>{{ $duration }}</span></h2>--}}
{{--                                                        <ul>--}}
{{--                                                            <li><a href="javascript:void(0)">@ {{ $job['client']['company_name'] }}</a></li>--}}
{{--                                                            <li><i class="fa fa-globe"></i> {{ $job->city }}, {{ $job->state }}</li>--}}
{{--                                                            <li><i class="fa fa-briefcase"></i> {{$job->service}}</li>--}}
{{--                                                        </ul>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="motivz-job-userlist">--}}
{{--                                                        <a href="{{route('user.edit.job.details',[$job->id])}}" class="motivz-option-btn">Edit</a>--}}
{{--                                                        <a href="javascript:void(0)" data-id="{{ $job->id }}" class="motivz-option-btn job-del">Delete</a>--}}
{{--                                                        <form action="" id="delete-job-form" method="post" style="display:none;">--}}
{{--                                                            @csrf--}}
{{--                                                            @method('delete')--}}
{{--                                                        </form>--}}
{{--                                                        <a href="{{route('user.job.details',[$job->id])}}" class="motivz-option-btn">View Details</a>--}}
{{--                                                        <style>--}}
{{--                                                            .featured>*{--}}
{{--                                                                color: tomato !important;--}}
{{--                                                            }--}}
{{--                                                        </style>--}}
{{--                                                        <a href="javascript:void(0)" class="motivz-job-like fav-job  @if($job->featured==1) featured @endif" data-id="{{$job->id}}" ><i class="fa fa-heart" ></i></a>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="clearfix"></div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </li>--}}
{{--                                    @endforeach--}}
                                </ul>
                            </div>
                            <div class="pagination-wrap">
                                <div class="box">
                                    <ul id="example-2" class="pagination"></ul>
                                    <div class="show"></div>
                                </div>
{{--                                {{ $jobs->links() }}--}}
{{--                                <a href="#"><i class="fa fa-angle-right"></i></a>--}}
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
    <script type="text/javascript" src="{{ asset('user/script/company/activeJobs.js') }}"></script>
    <script src="{{asset('user/script/blockUI.js')}}"></script>
    <script src="{{asset('js/pagination.js')}}"></script>
    <script src="{{asset('assets/scripts/notify.min.js')}}"></script>
    <script src="{{asset('assets/scripts/moment.min.js')}}"></script>
    <script>

        $(document).ready(function () {
           Paginate(10);
        });
        function Paginate(length)
        {
            $('#example-2').pagination({
                total: 1,
                current: 1,
                length: 10,
                size: 1,

                ajax: function(options, refresh){

                    var html='';

                    $.ajax({

                        url: "{{route('user.client.job.active')}}",
                        type: 'post',

                        data:{
                            current: options.current,
                            length: options.length,
                            "_token": "{{ csrf_token() }}",
                        },
                        beforeSend: function(){
                            $.blockUI({ message: '<div class="spinner-grow text-success"></div><div class="spinner-grow text-success"></div><div class="spinner-grow text-success"></div>', css: {border:     'none',
                                    backgroundColor:'transparent'} });
                        },
                        complete:function(data){
                            $.unblockUI();
                        }
                        // dataType: 'json'
                    }).done(function(res){
                        var json = JSON.parse(res);

                        var myJSON = json[1];
                        var countNew = json[2]
                        var totalRe = json[0];

                        console.log(countNew)

                        for (var i = 0 ; i <myJSON.length; i++) {
                            // current_date = new Date();
                            // created_at = new Date(myJSON[i]['created_at']);
                            // var time =(current_date.getTime() - created_at.getTime()) / 1000;
                            // var year  = Math.abs(Math.round((time/(60 * 60 * 24))/365.25));
                            // var month = Math.abs(Math.round(time/(60 * 60 * 24 * 7 * 4)));
                            // var days = Math.abs(Math.round(time/(3600 * 24)));
                            // var hour = Math.abs(Math.round(time/3600));
                            // var minute = Math.abs(Math.round(time/60));
                            // alert(created_at+'current'+current_date);
                            time_ago = moment(myJSON[i]['created_at']).fromNow();

                            html+='<li class="col-md-12 li_'+myJSON[i]['id']+'">'+
                                        '<div class="motivz-joblisting-classic-wrap">'+
                                            '<figure><a href=""'+window.location.origin+'/company/jobs/view-details/'+myJSON[i]['id']+'""><img src="'+window.location.origin+'/user/company_logo/'+myJSON[i]['client']['logo']+'" alt=""></a></figure>'+
                                            '<div class="motivz-joblisting-text">'+
                                                '<div class="motivz-list-option">'+
                                                    '<h2><a href="'+window.location.origin+'/company/jobs/view-details/'+myJSON[i]['id']+'">'+myJSON[i]['job_title']+'</a> <span>Posted '+time_ago+'</span> <span>'+countNew[i]+' New</span></h2>'+
                                                    '<ul>'+
                                                        '<li><a href="'+window.location.origin+'/company/jobs/view-details/'+myJSON[i]['id']+'">@ '+myJSON[i]['client']['company_name']+'</a></li>'+
                                                       '<li><i class="fa fa-globe"></i> '+myJSON[i]['location']+'</li>'+
                                                        '<li><i class="fa fa-briefcase"></i>'+myJSON[i]['service']+'</li>'+
                                                    '</ul>'+
                                                '</div>'+
                                                '<div class="motivz-job-userlist">'+
                                                    '<a href="'+window.location.origin+'/company/edit/job/details/'+myJSON[i]['id']+'" class="motivz-option-btn">Edit</a>'+
                                                    '<a href="javascript:void(0)" onclick="job_del('+myJSON[i]['id']+')" class="motivz-option-btn job-del">Delete</a>'+
                                                    '<a href="'+window.location.origin+'/company/jobs/view-details/'+myJSON[i]['id']+'" class="motivz-option-btn">View Details</a>'+
                                                    '<a href="javascript:void(0)" class="motivz-job-like fav-job data-id="'+myJSON[i]['id']+'" ></a>'+
                                                 '</div>'+
                                                '<div class="clearfix"></div>'+
                                            '</div>'+
                                        '</div>'+
                                    '</li>'
                        }

                        if(html == "")
                        {
                            document.getElementById('searched-jobslist').innerHTML='<div class="alert alert-secondary" style="width: 100%; text-align: center;" role="alert">'+'No Active Job Found'+'</div>';

                        }else{
                            document.getElementById('searched-jobslist').innerHTML=html;
                        }

                        refresh({
                            total: totalRe,
                            length: length
                        });
                    }).fail(function(error){
                    });
                }
            });
        }
        {{--$('.fav-job').on('click', function (event){--}}
        {{--     event.preventDefault();--}}
        {{--    let button=$(this);--}}
        {{--    let id=button.attr('data-id');--}}

        {{--    console.log();--}}
        {{--     $.ajax({--}}
        {{--        url: "{{route('user.active_job.favourite')}}",--}}
        {{--        type: 'put',--}}
        {{--        data: {--}}
        {{--            _token: "{{csrf_token()}}",--}}
        {{--            id:id,--}}
        {{--        },--}}
        {{--        success: function (response){--}}
        {{--            if(response.featured==true){--}}
        {{--                button.addClass('featured');--}}
        {{--                swal(--}}
        {{--                    "Added to Favourites","","success"--}}
        {{--                )--}}
        {{--            }--}}
        {{--            else{--}}
        {{--                swal(--}}
        {{--                    "Removed from Favourites","","success"--}}
        {{--                )--}}
        {{--                button.removeClass('featured');--}}
        {{--            }--}}
        {{--        },--}}
        {{--         error: function (response){--}}
        {{--             console.log(response)--}}
        {{--         }--}}
        {{--    });--}}
        {{--});--}}
        // function job_del(id) {
        //
        //     $('#delete-job-form').attr('action','/company/delete/job/'+id);
        //     console.log($('#delete-job-form').attr('action'));
        //     sweetAlert({
        //         title: "Are you sure?",
        //         text: "Once deleted, you will not be able to recover!",
        //         icon: "warning",
        //         buttons: true,
        //         dangerMode: true,
        //     })
        //         .then((willDelete) => {
        //             if (willDelete) {
        //                 $('#delete-job-form').submit();
        //
        //             }
        //         });
        // }
        function job_del(id) {
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
                            url: "/company/delete/job",
                            type:"POST",
                            async : false,
                            data:{id : id},
                            success:function(response){
                                if(response == 'deleted')
                                {
                                    $(".li_"+id).hide();
                                    $.notify("Job Deleted Successfully",{
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
    <script type="text/javascript" src="{{ asset('user/script/company/companyProfile.js') }}"></script>

@endsection
