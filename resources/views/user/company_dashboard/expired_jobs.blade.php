@extends('layouts.user_layout')

@section('title' , 'Expired Jobs')

@section('content')
<!--// Main Banner \\-->
<div class="findjob-subheader"><h1>Republish</h1></div>
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
                            @error('date')
                            <div style="text-align: center" class="alert alert-danger">
                                {{ $message }}
                            </div>
                            @enderror

                        <h2 class="form-title">Republish</h2>
                        <div class="motivz-job-list expired-jobs">
                            <ul class="row" id="searched-jobslist">
{{--                                @foreach($jobs as $job)--}}
{{--                                <li class="col-md-12">--}}
{{--                                    <div class="motivz-joblisting-classic-wrap">--}}
{{--                                        <figure><a href="#"><img src="{{ asset('user/company_logo/'.session('c_email.logo')) }}" alt=""></a></figure>--}}
{{--                                        <div class="motivz-joblisting-text">--}}
{{--                                            <div class="motivz-list-option">--}}
{{--                                                @php--}}

{{--                                                    $startTime = \Carbon\Carbon::parse($job->applied_before);--}}
{{--                                                    $endTime = \Carbon\Carbon::parse(\Carbon\Carbon::now());--}}
{{--                                                    $totalDuration = $endTime->diff($startTime);--}}

{{--                                                    if( $totalDuration->y > 0 ) {--}}

{{--                                                        $duration = $totalDuration->y ;--}}
{{--                                                    }else if( $totalDuration->m > 0 ) {--}}
{{--                                                            $duration = $totalDuration->m." year ago" ;--}}
{{--                                                    }else if( $totalDuration->d > 0 ) {--}}
{{--                                                            $duration = $totalDuration->d." day ago" ;--}}
{{--                                                    }else if( $totalDuration->h > 0 ) {--}}
{{--                                                            $duration = $totalDuration->h." hour ago" ;--}}
{{--                                                    }else if( $totalDuration->i > 0 ) {--}}
{{--                                                            $duration = $totalDuration->i." minute ago" ;--}}
{{--                                                    }else{--}}
{{--                                                        $duration = "just now" ;--}}
{{--                                                    }--}}


{{--                                                @endphp--}}
{{--                                                <h2><a href="{{route('user.job.details',[$job->id])}}">{{$job->job_title}}</a> <span class="expired-color">Expired: {{$duration}}</span></h2>--}}
{{--                                                <ul>--}}
{{--                                                    <li><i class="fa fa-globe"></i> {{$job->city}}, {{$job->state}}</li>--}}
{{--                                                    <li><i class="fa fa-filter"></i> {{$job->industry}}</li>--}}
{{--                                                    <li><i class="fa fa-briefcase"></i> {{$job->service}}</li>--}}
{{--                                                </ul>--}}
{{--                                            </div>--}}
{{--                                            <div class="motivz-job-userlist">--}}
{{--                                                <a href="{{route('user.job.details',[$job->id])}}" class="motivz-option-btn">View Details</a>--}}
{{--                                                <a href="#" class="motivz-option-btn job-del"  data-id="{{ $job->id }}">Remove</a>--}}
{{--                                                <form action="" id="delete-job-form" method="post" style="display:none;">--}}
{{--                                                    @csrf--}}
{{--                                                    @method('delete')--}}
{{--                                                </form>--}}

{{--                                                <a href="#" class="motivz-option-btn" data-toggle="modal" data-target="#applyBeforeModal" data-id="{{$job->id}}">Resubmit</a>--}}
{{--                                            </div>--}}
{{--                                            <div class="clearfix"></div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </li>--}}
{{--                                @endforeach--}}
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
<!--// Main Content \\-->

<div class="modal fade" id="applyBeforeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Select Apply Before Date: </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="resubmit-form" action="/company/job/resubmit">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="date" class="col-form-label">Date:</label>
                        <input type="hidden" name="job_id" id="job-id" value="1">
                        <input type="date" class="form-control" name="date" id="date" placeholder="DD-MM-YYYY">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="modal-submit">Resubmit</button>
            </div>
        </div>
    </div>
</div>
@stop

@section('script')
    <script src="{{asset('user/script/blockUI.js')}}"></script>
    <script src="{{asset('js/pagination.js')}}"></script>
    <script src="{{asset('assets/scripts/moment.min.js')}}"></script>
    <script src="{{asset('assets/scripts/notify.min.js')}}"></script>
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

                        url: "{{route('user.client.job.expired')}}",
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
                        // alert(res);
                        var json = JSON.parse(res);

                        var myJSON = json[1];
                        // alert(myJSON);
                        var totalRe = json[0];
                        // var fav_job = json[2];

                        for (var i = 0 ; i <myJSON.length; i++) {
                            // alert(myJSON[i]['created_at']);
                            time_ago = moment(myJSON[i]['created_at']).fromNow();


                            html+= '<li class="col-md-12 li_'+myJSON[i]['id']+'">'+
                                        '<div class="motivz-joblisting-classic-wrap">'+
                                            '<figure><a href="javascript:void(0)"><img src="'+window.location.origin+'/user/company_logo/'+myJSON[i]['client']['logo']+'" alt="Logo"></a></figure>'+
                                            '<div class="motivz-joblisting-text">'+
                                                '<div class="motivz-list-option">'+
                                                '<h2><a href="'+window.location.origin+'/company/jobs/view-details/'+myJSON[i]['id']+'">'+myJSON[i]['job_title']+'</a> <span class="expired-color">Expired: '+time_ago+'</span></h2>'+
                                                '<ul>'+
                                                '<li><i class="fa fa-globe"></i> '+myJSON[i]['location']+'</li>'+
                                                '<li><i class="fa fa-filter"></i> '+myJSON[i]['industry']['name']+'</li>'+
                                                '<li><i class="fa fa-briefcase"></i> '+myJSON[i]['service']+'</li>'+
                                                '</ul>'+
                                            '</div>'+
                                            '<div class="motivz-job-userlist">'+
                                                '<a href="'+window.location.origin+'/company/jobs/view-details/'+myJSON[i]['id']+'" class="motivz-option-btn">View Details</a>'+
                                                '<a href="javascript:void(0)" class="motivz-option-btn job-del" onclick="job_del('+myJSON[i]['id']+')">Delete</a>'+
                                                '<a href="javascript:void(0)" class="motivz-option-btn" data-toggle="modal" data-target="#applyBeforeModal" onclick="JobID('+myJSON[i]['id']+')">Republish</a>'+
                                                '</div>'+
                                                '<div class="clearfix"></div>'+
                                            '</div>'+
                                        '</div>'+
                                    '</li>'
                        }

                        if(html == "")
                        {
                            document.getElementById('searched-jobslist').innerHTML='<div class="alert alert-secondary" style="width: 100%; text-align: center;" role="alert">'+'No Expired Job Found'+'</div>';

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




        function JobID(id) {
            // alert(id);
            $("#job-id").val(id);

        }

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
        $('#resubmit-form').validate({
           rules:{
               date:{
                   required: true,
                   greaterThanToday: true
               }
           } ,
            messages:{
                date:{
                    required: "Date is required",
                }
            }
        });
        $('#modal-submit').on('click',function (event){
            event.preventDefault();
            $('#resubmit-form').submit();

        });
        $('#applyBeforeModal').on('show.bs.modal', function (event) {
            let button = $(event.relatedTarget);
            // let id = button.data('id');
            // $('#job-id').val(id);

        })
        // $('#applyBeforeModal').on('hidden.bs.modal', function (e) {
        //
        //     $('#job-id').val('');
        //
        // })
    </script>
    <script type="text/javascript" src="{{ asset('user/script/company/companyProfile.js') }}"></script>

@endsection
