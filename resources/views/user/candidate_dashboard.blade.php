@extends('layouts.user_layout')

@section('title' , 'Candidate Dashboard')

@section('content')
    <div class="mm-subheader"><h1>Candidate Dashboard</h1></div>

    <div class="motivz-main-content">

        <!--// Main Section \\-->
        <div class="motivz-main-section">
            <div class="container">

                <div class="row">
                    <div class="col-md-12">
                        <div class="job-search">
                            <form action="{{route('main.search.job')}}" method="POST" name="search_job">
                                @csrf
                                <ul>
                                    <li class="title">
                                        <input type="text" name="search_job_title" id="search_job_title" placeholder="Job Title or keyword">
                                    </li>
                                    <li class="location"><i class="icon-placeholder"></i>
                                        <input type="text" name="search_place" id="search_place" placeholder="City or area">
                                    </li>
                                    <li>
                                        <label>
                                            <i class="icon-search"></i>
                                            <input type="submit" value="Search Job">
                                        </label>
                                    </li>
                                </ul>
                            </form>
                        </div>
                    </div>
                    @include('user.include.candidate_side_bar')

                    <div class="col-md-9">
                        <div class="mm-motivz-jobdetail-content">
                            <h2 class="form-title">Relevant Jobs</h2>
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

                    url: "{{route('view.relevant.jobs')}}",
                    type: 'post',

                    data:{
                        current: options.current,
                        length: options.length,
                        "_token": "{{ csrf_token() }}",
                        /*job_title : job_title,
                        place     : place,*/
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
                        var fig;
                        if(myJSON[i]['client']['logo'])
                        {
                            fig = '<figure><a href="/job/details/'+myJSON[i]['id']+'"><img src="'+window.location.origin+'/user/company_logo/'+myJSON[i]['client']['logo']+'" alt=""></a></figure>'
                        }
                        else
                        {
                            fig = '<figure><a href="/job/details/'+myJSON[i]['id']+'"><img src="'+window.location.origin+'/user/images/featured-img1.jpg" alt=""></a></figure>'
                        }
                        html+='<li class="col-md-12">'+
                            '<div class="motivz-joblisting-classic-wrap">'+
                            +
                            '<div class="motivz-joblisting-text">'+
                            '<div class="motivz-list-option">'+
                            '<h2><a href="/job/details/'+myJSON[i]['id']+'">'+myJSON[i]['job_title']+'</a></h2>'+
                            '<ul>'+
                            '<li><a href="/job/details/'+myJSON[i]['id']+'">@ '+myJSON[i]['client']['company_name']+'</a></li>'+
                            '<li><i class="fa fa-globe"></i> '+myJSON[i]['location']+'</li>'+
                            '<li><i class="fa fa-filter"></i> '+myJSON[i]['industry']['name']+'</li>'+
                            '<li><i class="fa fa-briefcase"></i> '+myJSON[i]['service']+'</li>'+
                            '</ul>'+
                            '</div>'+
                            '<div class="motivz-job-userlist">'+
                            '<a href="/job/details/'+myJSON[i]['id']+'" class="motivz-option-btn">View Details</a>'+
                            '</div>'+
                            '<div class="clearfix"></div>'+
                            '</div>'+
                            '</div>'+
                            '</li>';

                    };

                    if(html == "")
                    {
                        document.getElementById('searched-jobslist').innerHTML='<div class="alert alert-secondary" style="width: 100%; text-align: center;" role="alert">'+'No relevant job found.'+'</div>';

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
</script>
@endsection
