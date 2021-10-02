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
                    class="pe-7s-portfolio mr-3 text-muted opacity-6"
                    style="font-size: 35px; color: #4d9a10 !important;"> </i>Applicants | {{$job_title}}
            </div>
        </div>
        <div class="tabs-animation">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="motivz-job-list">
                                <ul class="row" id="searched-jobslist">
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
    {{--    <script type="text/javascript" src="{{ asset('user/script/company/activeJobs.js') }}"></script>--}}
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
                        url: "{{route('get.job.candidates')}}",
                        type: 'post',
                        data: {
                            current: options.current,
                            length: options.length,
                            job_id: {{$job_id}},
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
                    }).done(function (res) {
                        var json = JSON.parse(res);
                            {{--console.log(json);--}}
                        var totalRe = json[0];
                        var myJSON = json[1];
                        console.log(myJSON);
                        var total = json[2];
                        var total1 = json[3];


                        for (var i = 0; i < myJSON.length; i++) {
                            var fig;
                            if (myJSON[i]['candidate']['prof_image']) {
                                fig = '<figure><a href="' + window.location.origin + '/company/candidate-details/' + myJSON[i]['candidate']['encrypted_candidate_id'] + '/' + myJSON[i]['job']['encrypted_job_id'] + '"><img src="' + window.location.origin + '/uploads/Candidate_Profile_Images/' + myJSON[i]['candidate']['prof_image'] + '" alt=""></a></figure>'
                            } else {
                                fig = '<figure><a href="' + window.location.origin + '/company/candidate-details/' + myJSON[i]['candidate']['encrypted_candidate_id'] + '/' + myJSON[i]['job']['encrypted_job_id'] + '"><img src="' + window.location.origin + '/user/images/avatar1.png" alt=""></a></figure>'
                            }
                            html += '<li class="col-md-12 li_' + myJSON[i]['candidate']['id'] + '">' +
                                '<div class="motivz-joblisting-classic-wrap">' +
                                fig +
                                '<div class="motivz-joblisting-text">' +
                                '<div class="motivz-list-option">' +
                                '<h2><a href="' + window.location.origin + '/company/candidate-details/' + myJSON[i]['candidate']['encrypted_candidate_id'] + '/' + myJSON[i]['job']['encrypted_job_id'] + '">' + myJSON[i]['candidate']['name'] + '</a> ' +
                                // '<span>Applied ' + moment(myJSON[i]['created_at']).fromNow() + '</span> ';
                                '<span>Applied ' + myJSON[i]['applied_date'] + '</span> ';
                            if (myJSON[i]['is_new'] == 1) {
                                html += '<span style="background-color:red">New</span> ';
                            }
                            html += '<ul>' +
                                '<li><a href="' + window.location.origin + '/company/jobs/view-details/' + myJSON[i]['job']['id'] + '">' + myJSON[i]['job']['job_title'] + '</a></li>';
                            if (myJSON[i]['candidate']['phone'] == null) {
                                html += '<li><i class="fa fa-globe"></i> ' + 'N/A' + '</li>';
                            } else {
                                html += '<li><i class="fa fa-globe"></i> ' + myJSON[i]['candidate']['phone'] + '</li>';
                            }
                            if (myJSON[i]['candidate']['education'] == null) {
                                html += '<li><i class="fa fa-briefcase"></i>' + 'N/A' + '</li>';
                            } else {
                                html += '<li><i class="fa fa-briefcase"></i>' + myJSON[i]['candidate']['education']['name'] + '</li>';
                            }
                            if (myJSON[i]['candidate']['location']) {
                                html += '<li><i class="fa fa-briefcase"></i>' + myJSON[i]['candidate']['location'] + '</li>';
                            } else {
                                html += '<li><i class="fa fa-briefcase"></i>' + 'N/A' + '</li>';
                            }

                            html += '</ul>' +
                                '</div>' +
                                '<div class="motivz-job-userlist">' +
                                // '<a href="' + window.location.origin + '/company/edit/job/details/' + myJSON[i]['id'] + '" class="btn motivz-option-btn">Edit</a>' +
                                // '<a href="javascript:void(0)" onclick="job_del(' + myJSON[i]['id'] + ')" class="btn motivz-option-btn job-del">Delete</a>' +
                                '<a href="' + window.location.origin + '/company/candidate-details/' + myJSON[i]['candidate']['encrypted_candidate_id'] + '/' + myJSON[i]['job']['encrypted_job_id'] + '" class="btn motivz-option-btn">View Details</a>' +
                                // '<a href="javascript:void(0)" class="motivz-job-like fav-job data-id="' + myJSON[i]['id'] + '" ></a>' +
                                '</div>' +
                                '<div class="clearfix"></div>' +
                                '</div>' +
                                '</div>' +
                                '</li>'
                        }

                        if (html == "") {
                            document.getElementById('searched-jobslist').innerHTML = '<div class="alert alert-secondary" style="width: 100%; text-align: center;" role="alert">' + 'No Applicant found' + '</div>';

                        } else {
                            document.getElementById('searched-jobslist').innerHTML = html;
                        }

                        refresh({
                            total: total1,
                            length: options.length
                        });
                    }).fail(function (error) {
                    });
                }
            });
        }

    </script>
    <script type="text/javascript" src="{{ asset('user/script/company/companyProfile.js') }}"></script>
@endsection

