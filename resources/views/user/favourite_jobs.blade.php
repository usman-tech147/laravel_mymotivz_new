@extends('layouts.user_layout')

@section('title' , 'Saved Jobs')

@section('content')
    <div class="mm-subheader"><h1>Saved Jobs</h1></div>

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
{{--                                    <li class="details"><a href="#" class="icon-interface"></a></li>--}}
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
                            <h2 class="form-title">Saved Jobs</h2>
                            <div class="featured-jobs-list">
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
        <script>
            $(document).ready(function () {
                $("#connect_popup").html('Thank You for submitting your profile. One of our Career Developers will be reaching out to you shortly');
            });
        </script>
    @else
        <script>
            $(document).ready(function () {
                $("#connect_popup").html('The profile must be completed prior to connecting with a career developer.');
            });
        </script>
    @endif
    <script>

            $(document).ready(function () {
                // debugger
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

                        url: "{{route('view.saved.jobs')}}",
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
                        var totalRe = json[0];

                        for (var i = 0 ; i <myJSON.length; i++) {

                            time_ago = moment(myJSON[i]['created_at']).fromNow();

                            html+='<li class="col-md-12 li_'+myJSON[i]['id']+'" id="searched-jobslist">'+
                                '<div class="featured-jobslist-text">'+
                                '<figure><a href="/job/details/'+myJSON[i]['job_id']+'"><img src="'+window.location.origin+'/user/company_logo/'+myJSON[i]['job']['client']['logo']+'" alt="Company Logo"></a></figure>' +
                                '<section>'+
                                '<h2><a href="/job/details/'+myJSON[i]['job_id']+'">'+myJSON[i]['job']['job_title']+'</a></h2>' +
                                '<small><a href="/job/details/'+myJSON[i]['job_id']+'">'+myJSON[i]['job']['client']['company_name']+'</a></small>' +
                                '<span class="publish"><span>Saved '+time_ago+'</span></span>' +
                                '<p>'+myJSON[i]['job']['job_description']+'</p>' +
                                '<ul class="job-location">' +
                                '<li><i class="fa fa-map-marker"></i> '+myJSON[i]['job']['location']+'</li>' +
                                '<li><i class="icon-business"></i> Full Time</li>' +
                                '</ul>'+
                                '<div class="apply"><a href="javascript:void(0)" class="like"><i style="color:tomato" onclick=remove_fav_job('+myJSON[i]['id']+') style="color:tomato" class="fa fa-heart icon_'+myJSON[i]['id']+'"></i></a> <a href="/job/details/'+myJSON[i]['job_id']+'">Apply</a></div>' +
                                '</section>' +
                                '</div>'+
                                '</li>';

                        };

                        if(html == "")
                        {
                            document.getElementById('searched-jobslist').innerHTML='<div class="alert alert-secondary" style="width: 100%; text-align: center;" role="alert">'+'No Saved Job Found'+'</div>';

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
        function remove_fav_job(id) {
            /*var confirm_dialog = confirm("Are you sure to remove from Saved Job!");*/
            sweetAlert({
                title: "Are you sure?",
                text: "Are you sure to remove from Saved Job!",
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
                        url: "{{ route('Ajax.remove.saved.job') }}",
                        type:"POST",
                        async : false,
                        data:{id : id},
                        success:function(response){
                            if(response == 'deleted')
                            {
                                $(".li_"+id).hide();
                                $.notify("Job Removed Successfully",{
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
