@extends('layouts.user_layout')

@section('title' , 'Applied Jobs')

@section('content')
    <div class="mm-subheader"><h1>Applied Jobs</h1></div>

    <div class="motivz-main-content">

        <!--// Main Section \\-->
        <div class="motivz-main-section">
            <div class="container">

                <div class="row">
                    <div class="col-md-12">
                        <div class="job-search">
                            <ul>
                                <li class="title">
                                    <input type="text" name="search_job_title" id="search_job_title" placeholder="Job Title or keyword">
                                </li>
                                <li class="location"><i class="icon-placeholder"></i>
                                    <input type="text" name="search_place" id="search_place" placeholder="City or area">
                                </li>
{{--                                <li class="details"><a href="#" class="icon-interface"></a></li>--}}
                                <li>
                                    <label>
                                        <i class="icon-search"></i>
                                        <input type="submit" onclick="Fun(10)" value="Search Job">
                                    </label>
                                </li>
                            </ul>
                        </div>
                    </div>
                    @include('user.include.candidate_side_bar')

                    <div class="col-md-9">
                        <div class="mm-motivz-jobdetail-content">
                            <h2 class="form-title">Applied Jobs</h2>
                            <div class="motivz-job-list">
                                <ul class="row" id="searched-jobslist">

                                </ul>
                            </div>
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
        <!--// Main Section \\-->

    </div>
@stop

@section('script')
    <link href="{{asset('css/bootstrap-tagsinput.css')}}" rel="stylesheet">
    <script src="{{asset('js/bootstrap-tagsinput.js')}}"></script>
    <script src="{{asset('assets/scripts/moment.min.js')}}"></script>
    <script src="{{asset('assets/scripts/notify.min.js')}}"></script>
    <script src="{{asset('user/script/blockUI.js')}}"></script>
    <script src="{{asset('js/pagination.js')}}"></script>



        @if($Candidate->career_dev == 1)
        {
            <script>
                $(document).ready(function () {
                    $("#connect_popup").html('Thank You for submitting your profile. One of our Career Developers will be reaching out to you shortly');
                });
            </script>
        }
        @else
            {
            <script>
                $(document).ready(function () {
                    $("#connect_popup").html('The profile must be completed prior to connecting with a career developer.');
                });
            </script>
            }
        @endif

    <script>

        $(document).ready(function () {


            Fun(10);
        });
        function Fun(length) {
            // body...
            var job_title=$('#search_job_title').val();
            var place=$('#search_place').val();


            $('#example-2').pagination({
                total: 1,
                current: 1,
                length: 10,
                size: 1,

                ajax: function(options, refresh, $target){

                    var html='';

                    $.ajax({

                        url: "{{route('ajax.applied.jobs')}}",
                        type: 'post',

                        data:{
                            current: options.current,
                            length: options.length,
                            "_token": "{{ csrf_token() }}",
                            job_title : job_title,
                            place     : place,
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
                        // alert(res);
                        var json = JSON.parse(res);

                        var myJSON = json[1];
                        // alert(myJSON);
                        var totalRe = json[0];
                        // var fav_job = json[2];

                        for (var i = 0 ; i <myJSON.length; i++) {

                            time_ago = moment(myJSON[i]['job']['created_at']).fromNow();

                            var img = '<figure><a href="/job/details/'+myJSON[i]['job_id']+'"><img src="'+window.location.origin+'/user/company_logo/'+myJSON[i]['job']['client']['logo']+'" alt=""></a></figure>';
                            console.log(img);
                            html+='<li class="col-md-12">'+
                                '<div class="motivz-joblisting-classic-wrap">'+
                                img+
                                '<div class="motivz-joblisting-text">'+
                                '<div class="motivz-list-option">'+
                                '<h2><a href="/job/details/'+myJSON[i]['job_id']+'">'+myJSON[i]['job']['job_title']+'</a></h2>'+
                                '<ul>'+
                                '<li><a href="/job/details/'+myJSON[i]['job_id']+'">@ '+myJSON[i]['job']['client']['company_name']+'</a></li>'+
                                '<li><i class="fa fa-globe"></i> '+myJSON[i]['job']['location']+'</li>'+
                                '<li><i class="fa fa-filter"></i> '+myJSON[i]['job']['industry']['name']+'</li>'+
                                '<li><i class="fa fa-briefcase"></i> '+myJSON[i]['job']['service']+'</li>'+
                                '</ul>'+
                                '</div>'+
                                '<div class="motivz-job-userlist">'+
                                '<a href="/job/details/'+myJSON[i]['job_id']+'" class="motivz-option-btn">View Details</a>'+
                                '<a href="javascript:void(0)" class="motivz-job-like"><i onclick="save_fav_job('+myJSON[i]['job_id']+')" class="fa fa-heart icon_'+myJSON[i]['job_id']+'"></i></a>'+
                                '</div>'+
                                '<div class="clearfix"></div>'+
                                '</div>'+
                                '</div>'+
                                '</li>';
                        }

                        if(html == "")
                        {
                            document.getElementById('searched-jobslist').innerHTML='<div class="alert alert-secondary" style="width: 100%; text-align: center;" role="alert">'+'No Applied Job Found'+'</div>';

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

        /*Remove JOb from Saved Jobs*/
        function save_fav_job(id) {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('Ajax.save.job') }}",
                type:"POST",
                async : false,
                data:{id : id},
                success:function(response){

                    if(response == 'saved')
                    {
                        $(".icon_"+id).css('color','tomato');
                        $.notify("Job Saved Successfully",{
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
                    else
                    {
                        $(".icon_"+id).css('color','');
                        $.notify("Removed from Saved Job Successfully",{
                            clickToHide: true,
                            autoHide: true,
                            autoHideDelay: 2000,
                            arrowShow: true,
                            arrowSize: 5,
                            breakNewLines: true,
                            elementPosition: "bottom",
                            globalPosition: "top center",
                            style: "bootstrap", // or metro
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
    </script>
    <style>
        .error {
            color: #F00;
        }
        span.tag{
            background: #2b935e;
        }
    </style>
@endsection
