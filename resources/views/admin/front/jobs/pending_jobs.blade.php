@extends('admin.layouts.layouts')
<!-- Modal -->

@section('title', 'Pending Jobs Database')
<!-- Modal -->
@section('content')
    <div class="app-main__inner">
        <div class="card-header-tab card-header">
            <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><i
                    class="pe-7s-users mr-3 text-muted opacity-6" style="font-size: 35px; "> </i>User side Pending Jobs Database
            </div>
        </div>
        <div class="tabs-animation">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-3">
                        <div class="card-body">
                            <!-- <form action=""> -->
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="jobTitle" id="jobTitle"
                                               placeholder="Job Title">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="location" id="location"
                                               placeholder="Location">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <select onchange="" id="selected-options-industry" name=""
                                            class="form-control second-select multiselect-dropdown">
                                        <option value="0">Select Industry</option>
                                        @foreach($industries as $industry)
                                            <option value="{{$industry->id}}">
                                                {{$industry->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <button type="button" onclick="Fun(10)" class="btn btn-primary pull-left">
                                        Search Job
                                    </button>
                                </div>
                            </div>
                            <!-- </form> -->
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card mb-3">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card-header-tab card-header">
                                    <div
                                        class="card-header-title font-size-lg text-capitalize font-weight-normal">
                                        <i class="pe-7s-users mr-3 text-muted opacity-6"
                                           style="font-size: 35px;"> </i>Pending Jobs
                                    </div>
                                </div>
                                <div class="card-body candidate-scroll">
                                    <div class="table-responsive">
                                        <span>Total Results: <strong id="no_result"></strong></span>

                                        <table style="width: 100%;"
                                               class="table table-hover table-striped table-bordered table-cursor candidate-list">
                                            <thead>
                                            <tr>
                                                <th>Job Title</th>
                                                <th>Employers</th>
                                                <!-- <th>Industry</th> -->
                                            </tr>
                                            </thead>
                                            <tbody id="htmlShow">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card-header-tab card-header">
                                    <div
                                        class="card-header-title font-size-lg text-capitalize font-weight-normal">
                                        <i class="pe-7s-notebook mr-3 text-muted opacity-6"
                                           style="font-size: 35px;"> </i>Pending Job Details
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="showJobDetails"
                                               class="table-detail table table-hover table-striped table-bordered">


                                        </table>
                                        <div id="button-for-div"></div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="box">
        <ul id="example-2" class="pagination"></ul>
        <div class="show"></div>
    </div>


    <script type="text/javascript">
        window.onload = Fun(10);

        function pendingJobDetails(id) {
            $('.add-note').removeClass('color-active');
            $('.add-note-' + id).addClass('color-active');
            let html = '';
            let html1 = '';
            $.ajax({
                url: "{{route('front.pending.job.details.ajax')}}",
                type: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "jobId": id,
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
            }).done(function (response) {
                let json = JSON.parse(response);
                let myJSON = json;
                html = '  <tr id="clientDetail-' + myJSON['id'] + '">' +
                    '<th>Posted Date:</th><td>' + dateFormat(myJSON['created_at']) + ' </td></tr>' +
                    '<th>Applied Before Date:</th><td>' + dateFormat(myJSON['applied_before']) + '</td></tr>' +
                    '<tr><th>Job Title:</th><td>' + checkValue(myJSON['job_title']) + '</td></tr>' +
                    '<tr><th>Employer:</th><td>' + checkNestedValue(myJSON['client']) + '</td></tr>' +
                    '<tr><th>Location:</th><td>' + checkValue(myJSON['location']) + '</td></tr>' +
                    '<tr><th>Website:</th><td>' + checkValue(myJSON['web_url']) + '</td></tr>' +
                    '<tr><th>Job Requirements:</th><td>' + splitValue(myJSON['required_skills']) + '</td></tr>' +
                    '<tr><th>Industry:</th><td>' + checkNestedValue(myJSON['industry']) + '</td></tr>';
                html1 = '<button dataId=' + json['id'] + ' class="tag btn btn-link approve-job"> Approve </button>' +
                    '<button dataId=' + json['id'] + ' class="tag btn btn-link reject-job"> Reject </button>'+
                    '<a href="{{url('admin/front-site/job-detail')}}/' + json['id']+' " class="btn tag"> ' +
                    'View Job Details ' +
                    '</a>';
                document.getElementById('showJobDetails').innerHTML = html;
                document.getElementById('button-for-div').innerHTML = html1;
            });
        }
        function Fun(length) {
            let title = $('#jobTitle').val();
            let industry = $('#selected-options-industry').val();
            let job_status = $('#selected-options-job-status').val();
            let location = $('#location').val();
            $('#example-2').pagination({
                total: 1,
                current: 1,
                length: length,
                size: 1,
                ajax: function (options, refresh, $target) {
                    let html = '';
                    $.ajax({
                        url: "{{route('front.pending.jobs.ajax.all')}}",
                        type: 'post',
                        data: {
                            current: options.current,
                            length: options.length,
                            "_token": "{{ csrf_token() }}",
                            "title": title,
                            "location": location,
                            "industry": industry,
                            "job_status": job_status,
                        },
                        beforeSend: function () {
                            $.blockUI({
                                message: '<div class="spinner-grow text-success">' +
                                    '</div><div class="spinner-grow text-success">' +
                                    '</div><div class="spinner-grow text-success"></div>',
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
                        let json = JSON.parse(res);
                        let myJSON = json[1];
                        let totalRe = json[0];
                        console.log("total jobs: "+totalRe);
                        for (let i = 0; i < myJSON.length; i++) {
                            if (i === 0) {
                                pendingJobDetails(myJSON[i]['id']);
                                html += '<tr><td colspan="2" style="background: #fff;cursor: default;padding: 1px;">' +
                                    '</td>' + '</tr>' +
                                    '<tr class="add-note color-active add-note-' + myJSON[i]['id'] + '" ' +
                                    'data-id="' + myJSON[i]['id'] + '" id="client-' + myJSON[i]['id'] + '" ' +
                                    'onclick=pendingJobDetails(' + myJSON[i]['id'] + ')>' +
                                    '<td><a class="add-click " href="javascript:void(0)"  ' +
                                    'data-id="' + myJSON[i]['id'] + ' id="client-info-ajax">' +
                                    '<h4 class="bold-green">' + checkValue(myJSON[i]['job_title']) + '</h4></a>' +
                                    '<small><b>' + checkValue(myJSON[i]['location']) + '</b>' +
                                    '</small>' +
                                    '</td><td><p class="add-cursor"></p>' + checkNestedValue(myJSON[i]['client']) + '</td>' +
                                    '</tr>';
                            } else {
                                html += '<tr><td colspan="2" style="background: #fff;cursor: default;padding: 1px;">' +
                                    '</td></tr>' +
                                    '<tr class="add-note add-note-' + myJSON[i]['id'] + '" ' +
                                    'data-id="' + myJSON[i]['id'] + '" id="client-' + myJSON[i]['id'] + '" ' +
                                    'onclick=pendingJobDetails(' + myJSON[i]['id'] + ')> ' +
                                    '<td><a class="add-click arrow" href="javascript:void(0)"  ' +
                                    'data-id="' + myJSON[i]['id'] + ' id="client-info-ajax">' +
                                    '<h4 class="bold-green">' + checkValue(myJSON[i]['job_title']) + '</h4></a>' +
                                    '<small><b>' + checkValue(myJSON[i]['location']) + '</b>' +
                                    '</small>' +
                                    '</td><td><p class="add-cursor"></p>' + checkNestedValue(myJSON[i]['client']) + '</td>' +
                                    '</tr>';
                            }
                        }
                        if (html === "") {
                            document.getElementById('htmlShow').innerHTML = '<tr><td colspan="3" style="background: #fff;cursor: default;padding: 1px;">No Pending Jobs Found</td></tr>';
                            document.getElementById('showJobDetails').innerHTML = `<tr><td colspan="3" style="background: #fff;cursor: default;padding: 1px;">No Pending Job's Detail Found</td></tr>`;
                            document.getElementById('button-for-div').innerHTML = '<p></p>';
                        } else {
                            document.getElementById('htmlShow').innerHTML = html;
                        }
                        document.getElementById('no_result').innerHTML = totalRe;
                        refresh({
                            total: totalRe,
                            length: length
                        });
                    }).fail(function (error) {
                    });
                }
            });
        }

        $(document).on('click', '.approve-job', function (e) {
            e.preventDefault();
            let id = $(this).attr('dataid');
            swal({
                title: "Are you sure you want to approve this job?",
                icon: "warning",
                buttons: {
                    cancel: true,
                    confirm: {text:'Yes',className:'sweet-success'},
                },
                dangerMode: true,
            }).then((approveJob) => {
                if (approveJob) {
                    $.ajax({
                        url: "{{route('job.approval.ajax')}}",
                        type: 'post',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "jobId": id,
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
                        if (res == "approved") {
                            swal("Job is Approved!");
                            Fun(10)
                        } else {
                            swal(res);
                        }
                    });
                } else {
                    // swal("Your note is safe!");
                }

            });
        });

        $(document).on('click', '.reject-job', function (e) {
            e.preventDefault();
            let id = $(this).attr('dataid');
            swal({
                title: "Are you sure you want to reject this job?",
                icon: "warning",
                buttons: {
                    cancel: true,
                    confirm: {text:'Yes',className:'sweet-success'},
                },
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "{{route('job.rejected.ajax')}}",
                        type: 'post',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "jobId": id,
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
                        if (res == "rejected") {
                            swal("Job is rejected!");
                            Fun(10)
                        }
                    });
                } else {
                    // swal("your client is safe!");
                }

            });
        });

    </script>



@endsection
