@extends('admin.layouts.layouts')
@section('title', 'Recruitment Pipeline')
@section('content')
    @if(session()->has('delMessage'))
        <div class="alert alert-success">
            {{ session()->get('delMessage') }}
        </div>
    @endif
    @if(session()->has('Email'))
        <input type="hidden" id="email_reply" value="{{session('Email')}}">
    @endif
    <div class="app-main__inner">
        <div class="card-header-tab card-header">
            <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><i
                    class="pe-7s-map mr-3 text-muted opacity-6" style="font-size: 35px; color: white !important;"> </i>Recruitment
                Pipeline
            </div>
        </div>
        <div class="tabs-animation">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-3">
                        <div class="card-body">
                            <form action="#">
                                <ul class="search-form">
                                    <li>
                                        <input class="form-control" id="com-name" type="text"
                                               placeholder="Company Name">
                                    </li>
                                    {{--                                                <li><button id="company-search" type="button" class="btn btn-primary pull-left" onclick="companySearch()">Search</button></li>--}}
                                    <li>
                                        <button id="company-search" type="button" class="btn btn-primary pull-left"
                                                onclick="pageloading(0)">Search
                                        </button>
                                    </li>
                                </ul>
                            </form>
                            <a href="#emptypresentModal" id="present_modal_id" data-toggle="modal"
                               class="btn btn-primary pull-right">Present</a>
                            <?php
                            //                                        dd($pipelineClients);
                            ?>
                            <a href="{{route('schedule-interview')}}" style="margin: 0px 5px 0px 0px;"
                               class="btn btn-primary pull-right">Schedule Interview</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-ovrflow">
                <div class="table-ovrflow-width">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card mb-3">
                                <div class="card-header-tab card-header">
                                    <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><i
                                            class="pe-7s-users mr-3 text-muted opacity-6" style="font-size: 35px;"> </i>Clients
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table style="width: 100%;"
                                               class="candidate-list table table-hover table-striped table-bordered table-cursor">
                                            <thead>
                                            <tr>
                                                <th>Company Names</th>
                                                {{--                                                            <th>Location</th>--}}
                                            </tr>
                                            </thead>
                                            <tbody id="client-show">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card mb-3">
                                <div class="card-header-tab card-header">
                                    <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><i
                                            class="pe-7s-note2 mr-3 text-muted opacity-6" style="font-size: 35px;"> </i>Jobs
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table style="width: 100%;"
                                               class="table table-hover table-striped table-bordered table-cursor">
                                            <thead>
                                            <tr>
                                                <th>Job Openings</th>
                                                <th>Location</th>
                                            </tr>
                                            </thead>
                                            <tbody id="jobs-list">


                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-header-tab card-header">
                                    <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><i
                                            class="pe-7s-note2 mr-3 text-muted opacity-6" style="font-size: 35px;"> </i>Pipeline
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table style="width: 100%;"
                                               class="table table-hover table-striped table-bordered table-cursor">
                                            <thead>
                                            <tr>
                                                <th>Candidates</th>
                                                <th style="width: 70px;">Status</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody id="pipeline_candidates_lists">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <ul id="example-2" class="pagination"></ul>
                        <div class="show"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if ($errors->any())
        <script>

            $(document).ready(function () {
                $('body').addClass('modal-open');
                $("#presentModal").addClass('in show');
                // $("#presentemptyModal").addClass('in show');
                $('#modal-close').click(function () {
                    $('body').removeClass('modal-open');
                    $("#presentModal").removeClass('in show');
                    // $("#presentemptyModal").removeClass('in show');
                })
                // add class="modal-open" in body
                // alert('sgfkaelfhisldkjgv');
                // $("#present_modal_id").click();
                // $("#presentModal").modal('show');
            });

        </script>
    @endif
    @if(session()->has('Email'))
        <script>
            var msg = $('#email_reply').val();
            $(document).ready(function () {
                swal({

                    title: "Email",
                    text: msg,
                });
                @php session()->forget('Email')  @endphp
            });

        </script>
    @endif
    <script type="text/javascript">

        // window.onload=companySearch();
        $(document).on('click', '#candidate_dashboard_notes', function () {
            var cand_id = $(this).attr('data-id');
            $('#dasboard_cadidate_id').val(cand_id);

        });

        $(document).on('click', '.note-candidate-delete', function () {
            var id = $(this).attr('data-id');
            swal({

                title: "Are you sure",
                text: "Once deleted, you will not be able to recover this note!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: "{{route('note.delete')}}",
                            type: 'post',

                            data: {

                                "_token": "{{ csrf_token() }}",
                                "noteId": id,

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

                            $('#candidate-note-id-' + id).remove();
                            swal("Your note is successfully deleted!");
                        });
                    } else {
                        swal("Your note is safe!");
                    }

                });
            // alert(note_id);

        });
        $(document).ready(function () {
            // Openings($('#client-show').find('tr').eq(1).attr('data-id'));
        });

        function showCandidates(id) {
            var html = "";
            // alert(id);
            $.ajax({
                url: "{{route('dashboardjobcandidate')}}",
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
                // dataType: 'json'
            }).done(function (res) {
                var json = JSON.parse(res);
                var newHtml = "";
                console.log(json);
                for (let i = 0; i < json[0]['admin_candidates'].length; i++) {
                    newHtml = "";
                    //
                    for (let j = 0; j < json[0]['admin_candidates'][i]['admin_notes'].length; j++) {
                        //
                        var notes = json[0]['admin_candidates'][i]['admin_notes'];
                        // console.log(notes);
                        var date = new Date(notes[j]['created_at']);
                        var mlist = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
                        var monName = mlist[date.getMonth()];


                        var day = date.getDate();

                        var newDate = (day < 10 ? '0' : '') + day + '-' + monName + '-' + date.getFullYear();


                        // var newDate=(((date.getMonth() > 8) ? (date.getMonth() + 1) : ('0' + (date.getMonth() + 1))) + '/' + ((date.getDate() > 9) ? date.getDate() : ('0' + date.getDate())) + '/' + date.getFullYear());

                        // convert the time here
                        newHtml += '<li id="candidate-note-id-' + notes [j]['id'] + '"><time datetime="">' + newDate + '</time><p id="candidate-des-' + notes[j]['id'] + '">' + notes[j]['description'] + '</p> <a  data-id="' + notes[j]['id'] + '" href="#" class="tag btn note-candidate-delete">Delete</a> <a id="note-edit-' + notes[j]['id'] + '" dataId="' + notes[j]['id'] + '" href="#editNotecandidate" data-toggle="modal" class="tag btn editNotecandidate">Edit</a></li>';
                        // console.log(newHtml);
                    }
                    if (newHtml === "") {
                        newHtml = "No Notes Available";
                    }
                    // // alert('123');
                    //

                    // alert(i)
                    html += '<tr><td colspan="3" style="background: #fff;cursor: default;padding: 1px;"></td></tr>' +
                        '<tr id="candidate-row-' + json[0]['candidates'][i]['id'] + '">' +
                        '<td class="add-note-candidate" data-id="' + json[0]['candidates'][i]['id'] + '">' +
                        '<div id="remove_candidate-id-' + json[0]['candidates'][i]['id'] + '" class="note-box">' +
                        '<a class="note-box" href="javascript:void(0)">' + json[0]['candidates'][i]['name'] +
                        '</a>' +
                        '<div id="candidatesnotes-' + json[0]['candidates'][i]['id'] + '" class="note-wrap ">' +
                        '<ul id="notes-list-' + json[0]['candidates'][i]['id'] + '">' + newHtml +

                        '</ul>' +
                        '</div>' +
                        '</div>' +
                        '<ul class="custom-menu custom-menu-candidate-' + json[0]['candidates'][i]['id'] + '">' +
                        '<li><a href="#presentModal" id="present_modal_pipeline_candidate" data-id="' + json[0]['candidates'][i]['id'] + '" data-toggle="modal" class="">Present</a></li>' +
                        '<li><a href="#" onclick="candidateRemovePipline(' + json[0]['candidates'][i]['id'] + ')">Remove From Pipeline</a></li>' +
                        '</ul>' +
                        '</td>' +
                        '<td><img width="50px" height="50px" src="' + window.location.origin + '/status_icons/' + json[0]['candidates'][i]['status']['status_icon'] + '"></td>' +
                        '<td><a href="{{url('admin/candidate/detail/')}}/' + json[0]['candidates'][i]['id'] + '" class="tag">View Details</a><a class="tag" data-toggle="modal"  data-id="' + json[0]['candidates'][i]['id'] + '" id="candidate_dashboard_notes" href="#dashboard_candidate_notes_modal">Add Notes</a> <a class="tag" href="{{url('admin/candidate/edit/')}}/' + json[0]['candidates'][i]['id'] + '">Edit</a><a class="tag pipeline_update_status" data-toggle="modal" data-status="' + json[0]['candidates'][i]['status']['id'] + '"  data-id="' + json[0]['candidates'][i]['id'] + '"  href="#pipelinestatusModal">Update Status</a> <a id="hired_btn" data-id="' + json[0]['candidates'][i]['id'] + '" class="tag" href="#hiredModal" data-toggle="modal">Hired</a></td>\n' +
                        '</tr>';
                }
                if (html === "") {
                    html = '<center>No Candidates Found</center>';
                }
                // document.getElementById('candidates-client-dashboard').innerHTML="";
                document.getElementById('pipeline_candidates_lists').innerHTML = html;
            });
        }

        // var id=$('#testfield').val();
        // var id=;
        // alert($('#client-show').find('tr').eq(1).attr('data-id'));
        // window.onload=Openings();
        // window.onload=companySearch();
        function Openings(id) {
            // body...
            // alert(id);
            // alert(id);
            $('.add-note').removeClass('color-active');
            $('.add-note-' + id).addClass('color-active');
            // alert(id);
            var html = '<center>No Jobs Found</center>';
            var dataid = id;
            $.ajax({
                url: "{{route('job-details-admin')}}",
                type: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "dataId": dataid,
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

                if (response.length > 0) {
                    html = '';
                    var first_job = 'color-active';
                    for (var i = response.length - 1; i >= 0; i--) {

                        html += ' <tr><td colspan="2" style="background: #fff;cursor: default;padding: 1px;"></td></tr><tr class="add-note-job add-note-job-' + response[i]["id"] + ' ' + first_job + '" data-id="' + response[i]["id"] + '" id="job-id-' + response[i]["id"] + '"><td  ><a href="{{url("admin/job/detail/")}}/' + response[i]['id'] + '">' + response[i]['jobtitle'] + '</a><ul class="custom-menu custom-menu-job-' + response[i]['id'] + '"><li><a href="{{url("/admin/job/detail")}}/' + response[i]['id'] + '">View Job Details</a></li><li><a class="job-remove-pipe" dataid=' + response[i]["id"] + ' href="#">Remove From Pipeline</a></li></ul></td><td><div class="add-cursor">' + response[i]["city"] + ', ' + response[i]["state"] + '</div></td></tr>';
                        first_job = '';
                    }

                }
                document.getElementById('jobs-list').innerHTML = html;
                if (html != '<center>No Jobs Found</center>') {
                    showCandidates($('#jobs-list').find('tr').eq(1).attr('data-id'));
                } else {
                    html = '<center>No Candidates Found</center>';
                    document.getElementById('pipeline_candidates_lists').innerHTML = html;
                }


            });
            $(document).on('click', '.add-note-job', function () {
                var tr = $(this);

                $('.add-note-job').removeClass('color-active');
                tr.addClass('color-active');
                var jobIdCand = tr.attr('data-id');
                //call function to get all candiates against them..
                showCandidates(jobIdCand)
            });

            //swal
            $(document).on('click', '#note-dashboard', function (e) {
                e.preventDefault();
                var id = $(this).attr('dataid');
                // alert(id);
                swal({

                    title: "Are you sure",
                    text: "Once deleted, you will not be able to recover this!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            $.ajax({
                                url: "{{route('note.delete')}}",
                                type: 'post',

                                data: {

                                    "_token": "{{ csrf_token() }}",
                                    "noteId": id,

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
                                // alert(id);
                                $('#dashboard-note-id-' + id).remove();
                            });
                        } else {
                            swal("Your note is safe!");
                        }

                    });
            });
        }

        function candidateRemovePipline(id) {
            // var nextId = $('#remove-id-' + id).attr('data-id');
            var job_id = $('#jobs-list').find('.color-active').attr('data-id');
            // alert(nextId);
            swal({

                title: "Are you sure",
                text: "You want to remove this Candidate from Pipeline!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: "{{route('candidate.remove.pipeline')}}",
                            type: 'post',
                            data: {
                                "_token": "{{ csrf_token() }}",
                                "candidate_id": id,
                                "job_id": job_id,
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

                            // console.log(res);
                            swal("Your candidate is successfully removed from pipeline!");
                            $('#candidate-row-' + id).prev().remove();
                            $('#candidate-row-' + id).remove();
                            // $('#remove-id-' + id).remove();
                            //
                            // if (nextId != '') {
                            //     Openings(nextId);
                            // } else {
                            //     document.getElementById('jobs-list').innerHTML = '';
                            // }
                        });
                    } else {
                        swal("Your candidate is still in pipeline!");
                    }

                });
        }

        function RemovePipline(id) {
            var nextId = $('#remove-id-' + id).attr('data-id');
            // alert(nextId);
            swal({

                title: "Are you sure",
                text: "All the jobs and there candidates will also be removed from he pipline!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: "{{route('client.removePiplineClientAjax')}}",
                            type: 'post',

                            data: {

                                "_token": "{{ csrf_token() }}",
                                "noteId": id,

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
                            pageloading(0);
                        });
                    } else {
                        swal("Your client still in pipeline!");
                    }

                });


        }


        //edit note

        $(document).on('click', '.editNote', function (e) {

            id = $(this).attr('dataid');
            var text = $('#note-' + id).text();

            $('#node-edit-clas').text(text);

        });

        $(document).on('click', '#note-edit-submit', function (e) {

            var noteText = $('#node-edit-clas').val();
            $.ajax({
                url: "{{route('note.edit')}}",
                type: 'post',

                data: {

                    "_token": "{{ csrf_token() }}",
                    "noteId": id,
                    "noteText": noteText,

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

                $('#note-' + id).text(noteText);

            });

        });


        //end edit note


        $(document).on("click", ".job-remove-pipe", function (e) {

            var id = $(this).attr('dataid');

            swal({

                title: "Are you sure",
                text: "All the candidates of this job will also be removed!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: "{{route('job.removePiplinejobAjax')}}",
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
                            // dataType: 'json'
                        }).done(function (res) {
                            pageloading(0);
                            // $('#job-id-'+id).prev().remove();
                            // $('#job-id-'+id).remove();
                        });
                    } else {
                        swal("Your job still in pipeline!");
                    }

                });

        });


        window.onload = pageloading(0);
        var page_number = 0;
        var client = 0;

        function pageloading(page) {
            $('#example-2').pagination({
                total: 1, // 总数据条数
                current: 1, // 当前页码
                length: 1, // 每页数据量
                size: 1, // 显示按钮个数
                prev: 'Previous',
                next: 'Next',
                /**
                 * [click description]
                 * @param  {[object]} options = {
                 *      current: options.current,
                 *      length: options.length,
                 *      total: options.total
                 *  }
                 */

                ajax: function (options, refresh, $target) {
                    // console.log(options);
                    // alert('Idhrrrrr hnnnn');

                    //company list
                    //e.preventDefault();
                    var comName = $('#com-name').val();

                    $.ajax({
                        url: "{{route('company.search.dashboard.ajax')}}",
                        type: 'post',

                        data: {

                            "_token": "{{ csrf_token() }}",
                            'page_num': options.current,
                            "comName": comName,

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
                        var html = "";
                        var newHtml = "";
                        var start = '';
                        for (let i = 0; i < json[0]['clients'].length; i++) {
                            newHtml = "";

                            for (let j = 0; j < json[0]['clients'][i]['notes'].length; j++) {

                                var notes = json[0]['clients'][i]['notes'];

                                var date = new Date(notes[j]['created_at']);

                                var mlist = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
                                var monName = mlist[date.getMonth()];
                                //
                                //
                                var day = date.getDate();

                                var newDate = (day < 10 ? '0' : '') + day + '-' + monName + '-' + date.getFullYear();


                                // var newDate=(((date.getMonth() > 8) ? (date.getMonth() + 1) : ('0' + (date.getMonth() + 1))) + '/' + ((date.getDate() > 9) ? date.getDate() : ('0' + date.getDate())) + '/' + date.getFullYear());

                                // convert the time here
                                newHtml += '<li id="dashboard-note-id-' + notes [j]['id'] + '"> <time datetime="">' + newDate + '</time><p id="note-' + notes[j]['id'] + '">' + notes[j]['description'] + '</p> <a id="note-dashboard" dataid="' + notes[j]['id'] + '" href="#" class="tag btn">Delete</a> <a id="note-edit-' + notes[j]['id'] + '" dataId="' + notes[j]['id'] + '" href="#editNotePopup" data-toggle="modal" class="tag btn editNote">Edit</a></li>';
                            }
                            if (newHtml === "") {
                                newHtml = "No Notes Available";
                            }
                            // alert('123');

                            html += '<tr><td  style="background: #fff;cursor: default;padding: 1px;"></td></tr><tr  class="add-note add-note-' + json[0]['clients'][i]['id'] + '" data-id="' + json[0]['clients'][i]['id'] + '" onclick="Openings(' + json[0]['clients'][i]['id'] + ')"><td><div id="remove-id-' + json[0]['clients'][i]['id'] + '"class="note-box"><div class="add-cursor"> <a class="note-box" href="javascript:void(0)"><h4 class="bold-green">' + json[0]['clients'][i]["company_name"] + '</h4></a> <small><b>' + json[0]['clients'][i]['city'] + ', ' + json[0]['clients'][i]['state'] + '</b></small><div id="dashboardNotes-' + json[0]['clients'][i]['id'] + '" class="note-wrap "><ul id="client-notes-list-' + json[0]['clients'][i]['id'] + '">' + newHtml + '</ul></div></div></div> <ul class="custom-menu custom-menu-' + json[0]['clients'][i]['id'] + '"><li data-action="first"><a data-toggle="modal" href="#exampleModal1">Add Notes</a></li><li><a href="#">Client Dashboard</a></li><li><a href="">Client Details</a></li><li><form id="company_interview_form_' + json[0]['clients'][i]['id'] + '" action="{{route('company-schedule-interview')}}" method="post">@csrf<input type="hidden" name="client_id" value="' + json[0]['clients'][i]['id'] + '"></form><a id="" onClick="company_interview_submit(' + json[0]['clients'][i]['id'] + ')">Schedule Interview</a></li><li><a href="javascript:void(0)" onclick=RemovePipline(' + json[0]['clients'][i]['id'] + ')>Remove From Pipeline</a></li></ul></td></tr>';
                            if (i == 0) {
                                start = json[0]['clients'][i]['id'];
                            }
                        }
                        if (html != "") {
                            // console.log($('#client-show tr:nth-child(2)'));
                            //  alert('not');
                            // Openings($('#client-show').find('tr').eq(1).attr('data-id'));
                        } else {
                            html = "No Company Avaliable";
                        }
                        document.getElementById('client-show').innerHTML = html;
                        Openings(start);

                        refresh({
                            total: json[0]['total'], // 可选
                            length: 10, // 可选
                        });
                    });
                }
            });
        }

        function company_interview_submit(id) {
            $("#company_interview_form_" + id).submit();
        }

        //end company list

    </script>
@endsection
