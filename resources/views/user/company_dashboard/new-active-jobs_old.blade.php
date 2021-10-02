@extends('layouts.company')

@section('content')
    <div class="app-main__inner">
        @if( session()->has('success') )
            <div style="text-align: center" class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
        <div class="card-header-tab card-header">
            <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><i class="pe-7s-portfolio mr-3 text-muted opacity-6" style="font-size: 35px; color: #4d9a10 !important;"> </i>Active Jobs</div>
        </div>
        <div class="tabs-animation">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="motivz-job-list">
                                <ul class="row" id="searched-jobslist">
{{--                                    <li class="col-md-12">--}}
{{--                                        <div class="motivz-joblisting-classic-wrap">--}}
{{--                                            <figure>--}}
{{--                                                <a href=""><img src="http://www.mymotivz2.development-env.com/user/company_logo/capture-2021_01_11-22-08-35.jpg" alt=""></a>--}}
{{--                                            </figure>--}}
{{--                                            <div class="motivz-joblisting-text">--}}
{{--                                                <div class="motivz-list-option">--}}
{{--                                                    <h2><a href="http://www.mymotivz2.development-env.com/company/active/jobs/view-details/40">Aut facere est fugi</a> <span>Posted 2 months ago</span></h2>--}}
{{--                                                    <ul>--}}
{{--                                                        <li><a href="http://www.mymotivz2.development-env.com/company/active/jobs/view-details/40">@ Testing</a></li>--}}
{{--                                                        <li><i class="fa fa-globe"></i> Id corporis iusto e</li>--}}
{{--                                                        <li><i class="fa fa-briefcase"></i>Contract</li>--}}
{{--                                                    </ul>--}}
{{--                                                </div>--}}
{{--                                                <div class="motivz-job-userlist">--}}
{{--                                                    <a href="edit-job.html" class="btn motivz-option-btn">Edit</a>--}}
{{--                                                    <a href="javascript:void(0)" class="btn motivz-option-btn job-del">Delete</a>--}}
{{--                                                    <a href="http://www.mymotivz2.development-env.com/company/active/jobs/view-details/40" class="btn motivz-option-btn">View Details</a>--}}
{{--                                                    <a href="javascript:void(0)" class="motivz-job-like fav-job"></a>--}}
{{--                                                </div>--}}
{{--                                                <div class="clearfix"></div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </li>--}}
{{--                                    <li class="col-md-12">--}}
{{--                                        <div class="motivz-joblisting-classic-wrap">--}}
{{--                                            <figure>--}}
{{--                                                <a href=""><img src="http://www.mymotivz2.development-env.com/user/company_logo/capture-2021_01_11-22-08-35.jpg" alt=""></a>--}}
{{--                                            </figure>--}}
{{--                                            <div class="motivz-joblisting-text">--}}
{{--                                                <div class="motivz-list-option">--}}
{{--                                                    <h2><a href="http://www.mymotivz2.development-env.com/company/active/jobs/view-details/40">Aut facere est fugi</a> <span>Posted 2 months ago</span></h2>--}}
{{--                                                    <ul>--}}
{{--                                                        <li><a href="http://www.mymotivz2.development-env.com/company/active/jobs/view-details/40">@ Testing</a></li>--}}
{{--                                                        <li><i class="fa fa-globe"></i> Id corporis iusto e</li>--}}
{{--                                                        <li><i class="fa fa-briefcase"></i>Contract</li>--}}
{{--                                                    </ul>--}}
{{--                                                </div>--}}
{{--                                                <div class="motivz-job-userlist">--}}
{{--                                                    <a href="edit-job.html" class="btn motivz-option-btn">Edit</a>--}}
{{--                                                    <a href="javascript:void(0)" class="btn motivz-option-btn job-del">Delete</a>--}}
{{--                                                    <a href="http://www.mymotivz2.development-env.com/company/active/jobs/view-details/40" class="btn motivz-option-btn">View Details</a>--}}
{{--                                                    <a href="javascript:void(0)" class="motivz-job-like fav-job"></a>--}}
{{--                                                </div>--}}
{{--                                                <div class="clearfix"></div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </li>--}}
{{--                                    <li class="col-md-12">--}}
{{--                                        <div class="motivz-joblisting-classic-wrap">--}}
{{--                                            <figure>--}}
{{--                                                <a href=""><img src="http://www.mymotivz2.development-env.com/user/company_logo/capture-2021_01_11-22-08-35.jpg" alt=""></a>--}}
{{--                                            </figure>--}}
{{--                                            <div class="motivz-joblisting-text">--}}
{{--                                                <div class="motivz-list-option">--}}
{{--                                                    <h2><a href="http://www.mymotivz2.development-env.com/company/active/jobs/view-details/40">Aut facere est fugi</a> <span>Posted 2 months ago</span></h2>--}}
{{--                                                    <ul>--}}
{{--                                                        <li><a href="http://www.mymotivz2.development-env.com/company/active/jobs/view-details/40">@ Testing</a></li>--}}
{{--                                                        <li><i class="fa fa-globe"></i> Id corporis iusto e</li>--}}
{{--                                                        <li><i class="fa fa-briefcase"></i>Contract</li>--}}
{{--                                                    </ul>--}}
{{--                                                </div>--}}
{{--                                                <div class="motivz-job-userlist">--}}
{{--                                                    <a href="edit-job.html" class="btn motivz-option-btn">Edit</a>--}}
{{--                                                    <a href="javascript:void(0)" class="btn motivz-option-btn job-del">Delete</a>--}}
{{--                                                    <a href="http://www.mymotivz2.development-env.com/company/active/jobs/view-details/40" class="btn motivz-option-btn">View Details</a>--}}
{{--                                                    <a href="javascript:void(0)" class="motivz-job-like fav-job"></a>--}}
{{--                                                </div>--}}
{{--                                                <div class="clearfix"></div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </li>--}}
                                </ul>
                                <div class="pagination-wrap">
                                    <div class="box">
                                        <ul id="example-2" class="pagination"></ul>
                                        <div class="show"></div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript" src="{{ asset('user/script/company/activeJobs.js') }}"></script>
    <script src="{{asset('user/script/blockUI.js')}}"></script>
    <script src="{{asset('js/pagination.js')}}"></script>
    <script src="{{asset('assets/scripts/notify.min.js')}}"></script>
{{--    Old--}}
{{--    <script src="{{asset('assets/scripts/moment.min.js')}}"></script>--}}
{{--    New--}}
    <script src="{{asset('js/moment.min.js')}}"></script>
    <script src="{{asset('js/moment_timezone.min.js')}}"></script>
    <script>

        $(document).ready(function () {
            Paginate(5);
        });
        function Paginate(length)
        {
            $('#example-2').pagination({
                // total: 1,
                current: 1, // Current page number
                length: 9, // Data volume per page
                size: 5, // Display the number of buttons
                // current: 1,
                // length: 5,
                // size: 1,
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
                        dataType: 'json',
                        beforeSend: function(){
                            $.blockUI({ message: '<div class="spinner-grow text-success"></div><div class="spinner-grow text-success"></div><div class="spinner-grow text-success"></div>', css: {border:     'none',
                                    backgroundColor:'transparent'} });
                        },
                        complete:function(data){
                            $.unblockUI();
                        }
                    }).done(function(res){
                        console.log(JSON.parse(res))
                        {{--var json = JSON.parse(res);--}}
                        {{--var myJSON = json[1];--}}
                        {{--var totalRe = json[0];--}}
                        {{--var countNew = json[2];--}}

                        {{--for (var i = 0 ; i <myJSON.length; i++) {--}}
                        {{--    // current_date = new Date();--}}
                        {{--    // created_at = new Date(myJSON[i]['created_at']);--}}
                        {{--    // var time =(current_date.getTime() - created_at.getTime()) / 1000;--}}
                        {{--    // var year  = Math.abs(Math.round((time/(60 * 60 * 24))/365.25));--}}
                        {{--    // var month = Math.abs(Math.round(time/(60 * 60 * 24 * 7 * 4)));--}}
                        {{--    // var days = Math.abs(Math.round(time/(3600 * 24)));--}}
                        {{--    // var hour = Math.abs(Math.round(time/3600));--}}
                        {{--    // var minute = Math.abs(Math.round(time/60));--}}
                        {{--    // alert(created_at+'current'+current_date);--}}
                        {{--    @php--}}
                        {{--        $d=new \Carbon\Carbon();--}}

                        {{--    @endphp--}}
                        {{--    moment.tz.setDefault('{{$d->timezoneName}}')--}}
                        {{--    time_ago = moment(myJSON[i]['created_at']).fromNow();--}}
                        {{--    var fig;--}}
                        {{--    if(myJSON[i]['client']['logo'] !=null)--}}
                        {{--    {--}}
                        {{--        fig = '<figure><a href="/job/details/'+myJSON[i]['id']+'"><img src="'+window.location.origin+'/user/company_logo/'+myJSON[i]['client']['logo']+'" alt=""></a></figure>'--}}
                        {{--    }--}}
                        {{--    else--}}
                        {{--    {--}}
                        {{--        fig = '<figure><a href="/job/details/'+myJSON[i]['id']+'"><img src="'+window.location.origin+'/user/images/featured-img1.jpg" alt=""></a></figure>'--}}
                        {{--    }--}}
                        {{--    html+='<li class="col-md-12 li_'+myJSON[i]['id']+'">'+--}}
                        {{--        '<div class="motivz-joblisting-classic-wrap">'+--}}
                        {{--        fig+--}}
                        {{--        '<div class="motivz-joblisting-text">'+--}}
                        {{--        '<div class="motivz-list-option">'+--}}
                        {{--        '<h2><a href="'+window.location.origin+'/company/active/jobs/view-details/'+myJSON[i]['id']+'">'+myJSON[i]['job_title']+'</a> <span>Posted '+time_ago+'</span> <span>'+countNew[i]+' New</span></h2>'+--}}
                        {{--        '<ul>'+--}}
                        {{--        '<li><a href="'+window.location.origin+'/company/active/jobs/view-details/'+myJSON[i]['id']+'">@ '+myJSON[i]['client']['company_name']+'</a></li>'+--}}
                        {{--        '<li><i class="fa fa-globe"></i> '+myJSON[i]['location']+'</li>'+--}}
                        {{--        '<li><i class="fa fa-briefcase"></i>'+myJSON[i]['service']+'</li>'+--}}
                        {{--        '</ul>'+--}}
                        {{--        '</div>'+--}}
                        {{--        '<div class="motivz-job-userlist">'+--}}
                        {{--        '<a href="'+window.location.origin+'/company/edit/job/details/'+myJSON[i]['id']+'" class="btn motivz-option-btn">Edit</a>'+--}}
                        {{--        '<a href="javascript:void(0)" onclick="job_del('+myJSON[i]['id']+')" class="btn motivz-option-btn job-del">Delete</a>'+--}}
                        {{--        '<a href="'+window.location.origin+'/company/active/jobs/view-details/'+myJSON[i]['id']+'" class="btn motivz-option-btn">View Details</a>'+--}}
                        {{--        '<a href="javascript:void(0)" class="motivz-job-like fav-job data-id="'+myJSON[i]['id']+'" ></a>'+--}}
                        {{--        '</div>'+--}}
                        {{--        '<div class="clearfix"></div>'+--}}
                        {{--        '</div>'+--}}
                        {{--        '</div>'+--}}
                        {{--        '</li>'--}}
                        {{--}--}}

                        {{--if(html == "")--}}
                        {{--{--}}
                        {{--    document.getElementById('searched-jobslist').innerHTML='<div class="alert alert-secondary" style="width: 100%; text-align: center;" role="alert">'+'No active job found'+'</div>';--}}

                        {{--}else{--}}
                        {{--    document.getElementById('searched-jobslist').innerHTML=html;--}}
                        {{--}--}}

                        {{--refresh({--}}
                        {{--    total: res.total,--}}
                        {{--    length: res.length--}}
                        {{--});--}}
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
                            data:{id : id ,  "_token": "{{ csrf_token() }}",},
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

