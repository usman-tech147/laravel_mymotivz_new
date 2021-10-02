@extends('layouts.company')

@section('content')
    <div class="app-main__inner">
        @if( session()->has('success') )
            <div style="text-align: center" class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
        <div class="card-header-tab card-header">
            <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><i
                    class="pe-7s-portfolio mr-3 text-muted opacity-6" style="font-size: 35px; color: #4d9a10 !important;"> </i>Active Jobs
            </div>
        </div>
        <div class="tabs-animation">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="motivz-job-list">
                                <ul class="row" id="searched-jobslist"></ul>
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
{{--    <script type="text/javascript" src="{{ asset('user/script/company/activeJobs.js') }}"></script>--}}
    <script src="{{asset('user/script/blockUI.js')}}"></script>
    <script src="{{asset('js/pagination.js')}}"></script>
    <script src="{{asset('assets/scripts/notify.min.js')}}"></script>
    <script src="{{asset('js/moment.min.js')}}"></script>
    <script src="{{asset('js/moment_timezone.min.js')}}"></script>
    <script>

        $(document).ready(function () {
            Paginate(10);
        });

        function Paginate(length) {
            $('#example-2').pagination({
                total: 1,
                current: 1,
                length: 10,
                size: 1,

                ajax: function (options, refresh) {

                    var html = '';

                    $.ajax({
                        url: "{{route('user.client.job.active')}}",
                        type: 'post',
                        data: {
                            current: options.current,
                            length: options.length,
                            "_token": "{{ csrf_token() }}",
                        },
                        beforeSend: function () {
                            $.blockUI({
                                message: '<div class="spinner-grow text-success"></div><div class="spinner-grow text-success"></div><div class="spinner-grow text-success"></div>',
                                css: {
                                    border: 'none',
                                    backgroundColor: 'transparent'
                                }
                            });
                        },
                        complete: function (data) {
                            $.unblockUI();
                        }
                        // dataType: 'json'
                    }).done(function (res) {
                        var json = JSON.parse(res);
                        let totalRe = json[0];
                        let myJSON = json[1];
                        console.log(myJSON);
                        let countNew = json[2];
                        let total = json['total'];
                        for (var i = 0; i < myJSON.length; i++) {
                            @php
                                $d=new \Carbon\Carbon();

                            @endphp
                            moment.tz.setDefault('{{$d->timezoneName}}')
                            // time_ago = moment(myJSON[i]['created_at']).fromNow();
                            time_ago = myJSON[i]['active'];
                            var fig;
                            if (myJSON[i]['client']['logo']) {
                                fig = '<figure><a href="/job/details/' + myJSON[i]['id'] + '"><img src="' + window.location.origin + '/user/company_logo/' + myJSON[i]['client']['logo'] + '" alt=""></a></figure>'
                            } else {
                                fig = '<figure><a href="/job/details/' + myJSON[i]['id'] + '"><img src="' + window.location.origin + '/user/images/avatar1.png" alt=""></a></figure>'
                            }
                            html += '<li class="col-md-12 li_' + myJSON[i]['id'] + '">' +
                                '<div class="motivz-joblisting-classic-wrap">' +
                                fig +
                                '<div class="motivz-joblisting-text">' +
                                '<div class="motivz-list-option">' +

                            '<h2><a href="' + window.location.origin + '/company/jobs/view-details/' + myJSON[i]['id'] + '">' + myJSON[i]['job_title'] + '</a> ';
                            if(countNew[i])
                            {
                                html += '<span>Posted ' + time_ago + '</span> ' +
                                    '<span class="list-notify">' +
                                    '<i class="fa fa-user"></i> ' +
                                    '<a href="' + window.location.origin  + '/company/view/job/applicants/' + myJSON[i]['id'] + '" style="color:#FFF; text-decoration: none"> ' +
                                    ' New Applicants ' +
                                    '<small>' + countNew[i] + '</small> ' +
                                    '</a> ' +
                                    '</span>';
                            }
                            else{
                                html += '<span>Posted ' + time_ago + '</span>' +
                                    ' <span class="list-notify">' +
                                    '<i class="fa fa-user"></i> ' +
                                    '<a href="' + window.location.origin  + '/company/view/job/applicants/' + myJSON[i]['id'] + '" style="color:#FFF; text-decoration: none"> ' +
                                    'Applicants ' +
                                    '</a> ' +
                                    '</span>';
                            }
                            if(myJSON[i]['job_approved'] === 0)
                            {
                                html += '<span style="margin-left: 5px; background-color: blue">Pending</span></h2>';
                            }
                            if(myJSON[i]['job_approved'] === 1)
                            {
                                html += '<span style="margin-left: 5px">Approved</span></h2>';
                            }
                            if(myJSON[i]['job_approved'] === 2)
                            {
                                html += '<span style="margin-left: 5px; background-color: red"">Rejected</span></h2>';
                            }
                                // '<span></span></h2>' +
                                html +='<ul>' +
                                '<li><a href="' + window.location.origin + '/company/jobs/view-details/' + myJSON[i]['id'] + '">@ ' + myJSON[i]['client']['company_name'] + '</a></li>' +
                                '<li><i class="fa fa-globe"></i> ' + myJSON[i]['location'] + '</li>' +
                                '<li><i class="fa fa-briefcase"></i>' + myJSON[i]['service'] + '</li>' +
                                '</ul>' +
                                '</div>' +
                                '<div class="motivz-job-userlist">' +
                                '<a href="' + window.location.origin + '/company/edit/job/details/' + myJSON[i]['id'] + '" class="btn motivz-option-btn">Edit</a>' +
                                '<a href="javascript:void(0)" onclick="job_del(' + myJSON[i]['id'] + ')" class="btn motivz-option-btn job-del">Delete</a>' +
                                '<a href="' + window.location.origin + '/company/jobs/view-details/' + myJSON[i]['id'] + '" class="btn motivz-option-btn">View Details</a>' +
                                '<a href="javascript:void(0)" class="motivz-job-like fav-job data-id="' + myJSON[i]['id'] + '" ></a>' +
                                '</div>' +
                                '<div class="clearfix"></div>' +
                                '</div>' +
                                '</div>' +
                                '</li>'
                        }

                        if (html == "") {
                            document.getElementById('searched-jobslist').innerHTML = '<div class="alert alert-secondary" style="width: 100%; text-align: center;" role="alert">' + 'No active job found' + '</div>';

                        } else {
                            document.getElementById('searched-jobslist').innerHTML = html;
                        }

                        refresh({
                            length: options.length,
                            total: total,

                        });
                    }).fail(function (error) {
                    });
                }
            });
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
                            type: "POST",
                            async: false,
                            data: {id: id, "_token": "{{ csrf_token() }}",},
                            success: function (response) {
                                if (response == 'deleted') {
                                    $(".li_" + id).hide();
                                    $.notify("Job Deleted Successfully", {
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

