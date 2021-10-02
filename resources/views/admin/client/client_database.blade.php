@extends('admin.layouts.layouts')
<!-- Modal -->

@section('title', 'Client Database')
<!-- Modal -->
@section('content')
    @if(session()->has('delMessage'))
        <div class="alert alert-success">
            {{ session()->get('delMessage') }}
        </div>
    @endif

    @if(session()->has('clientEditMessage'))
        <div class="alert alert-success">
            {{ session()->get('clientEditMessage') }}
        </div>
    @endif
    @if(session()->has('clientNoteMessage'))
        <div class="alert alert-success">
            {{ session()->get('clientNoteMessage') }}
        </div>
    @endif

    @if(session()->has('delClientMessage'))
        <div class="alert alert-success">
            {{ session()->get('delClientMessage') }}
        </div>
    @endif

    @if(session()->has('addpipline'))
        <div class="alert alert-success">
            {{ session()->get('addpipline') }}
        </div>
    @endif
    @if(session()->has('removedpipline'))
        <div class="alert alert-success">
            {{ session()->get('removedpipline') }}
        </div>
    @endif

    <div class="app-main__inner">
        <div class="card-header-tab card-header">
            <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><i
                    class="pe-7s-users mr-3 text-muted opacity-6" style="font-size: 35px; "> </i>Clients Database
            </div>
        </div>
        <div class="tabs-animation">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input class="form-control" type="text" style="width: 100%;" name="client-name"
                                               id="clientName" placeholder="Company Name"></div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input class="form-control" type="text" name="client-city" id="clientCity"
                                               placeholder="City">

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input class="form-control" type="text" name="client-state" id="clientstate"
                                               placeholder="State">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <button style="margin: 0px;" type="button" onclick="Fun(10)"
                                            class="btn btn-primary pull-left">Search
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card mb-3">
                        <div class="table-ovrflow">
                            <div class="table-ovrflow-width" style="width: 1300px;">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="card-header-tab card-header">
                                            <div
                                                class="card-header-title font-size-lg text-capitalize font-weight-normal">
                                                <i class="pe-7s-users mr-3 text-muted opacity-6"
                                                   style="font-size: 35px;"> </i>Clients
                                            </div>
                                        </div>
                                        <div class="card-body candidate-scroll">
                                            <div class="table-responsive">
                                                <span>Total Results: <strong id="no_result"></strong></span>

                                                <table style="width: 100%;"
                                                       class="table table-hover table-striped table-bordered table-cursor candidate-list">
                                                    <thead>
                                                    <tr>
                                                        <th>Company Name</th>
                                                        <th>POC</th>
                                                        <th>Industry</th>
                                                        <th>#Job Openings</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="htmlShow">

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="card-header-tab card-header">
                                            <div
                                                class="card-header-title font-size-lg text-capitalize font-weight-normal">
                                                <i class="pe-7s-notebook mr-3 text-muted opacity-6"
                                                   style="font-size: 35px;"> </i>Client Details
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table id="show-one-client"
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
        </div>
    </div>
    <div class="box">
        <ul id="example-2" class="pagination"></ul>
        <div class="show"></div>
    </div>


    <script type="text/javascript">

        window.onload = Fun(10);

        function showDetails1(id) {
            $('.add-note').removeClass('color-active');
            $('.add-note-' + id).addClass('color-active');
            var html = '';
            var html1 = '';
            var divNoteHtml = '';
            $.ajax({

                url: "{{route('client.database.ajax.detail')}}",
                type: 'post',

                data: {
                    "_token": "{{ csrf_token() }}",
                    "dataId": id,
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
            }).done(function (response) {

                var json = JSON.parse(response);
                var myJSON = json[0];
                var contract = json[2];
                var notes = json[1];
                console.log(notes);
                divNoteHtml += '   <div id="append-note-' + id + '" class="note-wrap detail"><ul>';
                for (var i = 0; i < notes.length; i++) {
                    var date = new Date(notes[i]['created_at']);
                    var newDate = (((date.getMonth() > 8) ? (date.getMonth() + 1) : ('0' + (date.getMonth() + 1))) + '/' + ((date.getDate() > 9) ? date.getDate() : ('0' + date.getDate())) + '/' + date.getFullYear());
                    divNoteHtml += ' <li id="delete-id-' + notes[i]['id'] + '">' +
                        '<time>' + newDate + ' </time>' +
                        '<p id="note-' + notes[i]['id'] + '">' + notes[i]['description'] + '</p>' +
                        '<a id="note-del-' + notes[i]['id'] + '" dataId="' + notes[i]['id'] + '" href="javascript:void(0)" class="tag btn note-del">Delete</a>' +
                        '<a id="note-edit-' + notes[i]['id'] + '" dataId="' + notes[i]['id'] + '"  href="#editNotePopup" data-toggle="modal" class="tag btn editNote">Edit</a>' +
                        '</li>';
                }
                divNoteHtml += '     </ul></div>';
                var job_date = new Date(myJSON[0]['created_at']);
                var job_date_1 = (((job_date.getMonth() > 8) ? (job_date.getMonth() + 1) : ('0' + (job_date.getMonth() + 1))) + '/' + ((job_date.getDate() > 9) ? job_date.getDate() : ('0' + job_date.getDate())) + '/' + job_date.getFullYear());

                // for (var i = 0 ; i <myJSON.length; i++) {
                // alert(myJSON[i]);
                if (myJSON[0]['web_url'] == null) {
                    webUrl = "";
                } else {
                    webUrl = myJSON[0]['web_url'];
                }
                var con = '';
                var icon;
                if (contract != null) {
                    if (contract['status'] == 0) {
                        icon = '<a @can('view', \App\Models\Admin\AdminContract::class) target="_blank" href="' + window.location.origin + '/public/files/' + contract['contract_file'] + '" @endcan @cannot('view',  \App\Models\Admin\AdminContract::class) href="javascript:void(0)" @endcannot style="font-size: 45px; margin: 0px 10px 0px 0px;" data-toggle="tooltip" title="" class=" "  ><img id="img-' + id + '" height="50" width="50" src="' + window.location.origin + '/assets/images/contract_sent.png"></a>'
                    } else {
                        icon = '<a  @can('view',  \App\Models\Admin\AdminContract::class) target="_blank" href="' + window.location.origin + '/public/files/' + contract['contract_file'] + '" @endcan @cannot('view',  \App\Models\Admin\AdminContract::class) href="javascript:void(0)" @endcannot style="font-size: 45px; margin: 0px 10px 0px 0px;" data-toggle="tooltip" title="" class=" "  ><img id="img-' + id + '" height="50" width="50" src="' + window.location.origin + '/assets/images/contract_signed.png"></a>'

                    }
                    con = '<tr><th>Latest Contract Status:</th><td>' + icon + '</td></tr>';

                }
                var phone_number = myJSON[0]['phone'];
                if (phone_number == -1) {
                    phone_number = 'N/A'
                }
                html = '  <tr id="clientDetail-' + myJSON[0]['id'] + '">' +
                    '<th>Date logged:</th><td>' + job_date_1 + ' </td></tr>' +
                    '<tr><th>POC:</th><td>' + myJSON[0]['name'] + '</td></tr>' +
                    '<tr><th>Phone Number:</th><td>' + phone_number + '</td></tr>' +
                    '<tr><th>Email:</th><td>' + myJSON[0]['email'] + '</td></tr>' +
                    '<tr><th>Location:</th><td>' + myJSON[0]['city'] + ', ' + myJSON[0]['state'] + '</td></tr>' +
                    '<tr><th>Company Name:</th><td>' + myJSON[0]['company_name'] + '</td> </tr>' +
                    '<tr><th>Website Address:</th><td>' + webUrl + '</td></tr>' +
                    '<tr><th>Notes:</th><td>' + divNoteHtml + '</td></tr>' + con;
                // <tr><th>Types Of Industry:</th><td>'+myJSON[0]['industry']+'</td></tr>

                // console.log(myJSON[0]['pipeline'].length);
                if (myJSON[0]['pipeline'].length) {
                    var buttonRecruiter = '<a dataId=' + myJSON[0]['id'] + ' id="rmvClientPipe" class="tag" href="javascript:void(0)">Remove from pipeline</a>';
                } else {
                    var buttonRecruiter = '<a dataId=' + myJSON[0]['id'] + ' id="addClientpipe" class="tag" href="javascript:void(0)" data-toggle="modal">Add to pipeline</a>';
                }
                html1 = ' <a class="tag" href="{{url("admin/client/edit/")}}/' + myJSON[0]['id'] + '">Edit</a>' +
                    '@can('delete', App\Models\Admin\AdminClient::class)<a dataId=' + myJSON[0]['id'] + ' class="tag del-swal" href="{{url("admin/client/delete/")}}/' + myJSON[0]['id'] + '">Delete</a>@endcan' +
                    '' + buttonRecruiter + '';
                // };
                document.getElementById('show-one-client').innerHTML = html;
                document.getElementById('button-for-div').innerHTML = html1;
            });
        }

        function Fun(length) {
            // body...
            // alert('123');

            var name = $('#clientName').val();
            var state = $('#clientstate').val();
            var city = $('#clientCity').val();
            // alert(state);
            // alert(name);


            $('#example-2').pagination({
                total: 1, // 总数据条数
                current: 1, // 当前页码
                length: length, // 每页数据量
                size: 1, // 显示按钮个数
                ajax: function (options, refresh, $target) {

                    var html = '';

                    $.ajax({

                        url: "{{route('client.database.ajax')}}",
                        type: 'post',

                        data: {
                            current: options.current,
                            length: options.length,
                            "_token": "{{ csrf_token() }}",
                            "name": name,
                            "state": state,
                            "city": city,
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
                        var myJSON = json[1];
                        // alert(myJSON);
                        var totalRe = json[0];
                        // alert(total);
                        console.log(myJSON[1]);
                        // if(res[1].length!=0)
                        // {
                        // var response=res[1];
                        // alert(myJSON.length);
                        // var th = '' ;
                        for (var i = 0; i < myJSON.length; i++) {
                            if (i === 0) {
                                showDetails1(myJSON[i]['id']);
                            }
                            if (myJSON[i]['industry'] == null) {
                                var industry = "";
                            } else {
                                var industry = myJSON[i]['industry'];
                            }
                            if (i === 0) {
                                html += '<tr><td colspan="3" style="background: #fff;cursor: default;padding: 1px;"></td>' + '</tr>' +
                                    '<tr class="add-note color-active add-note-' + myJSON[i]['id'] + '" data-id="' + myJSON[i]['id'] + '" id="client-' + myJSON[i]['id'] + '" onclick=showDetails1(' + myJSON[i]['id'] + ')>' +
                                    '<td><a class="add-click arrow " href="javascript:void(0)"  data-id="' + myJSON[i]['id'] + ' id="client-info-ajax">' +
                                    '<h4 class="bold-green">' + myJSON[i]['company_name'] + '</h4></a><small><b>' + myJSON[i]['city'] + ", " + ' ' + myJSON[i]['state'] + '</b>' +
                                    '</small><ul class="custom-menu custom-menu-' + myJSON[i]['id'] + '"><li data-action="first"><a data-toggle="modal" href="#exampleModal">Add Notes</a></li>' +
                                    '<li><a href="{{route('client.dashboard')}}">Client Dashboard</a></li></ul></td><td>' + myJSON[i]['name'] + '</td>' +
                                    '<td><p class="">' + industry + '</p></td>' +
                                    '<td><a class="add-cursor" href="{{url('/admin/client/jobs/details')}}/' + myJSON[i]['id'] + '">' + myJSON[i]['admin_jobs_count'] + '</a>' +
                                    '</td></tr>';
                                {{--html+='<tr><td colspan="4" style="background: #fff;cursor: default;padding: 1px;"></td></tr><tr class="add-note color-active add-note-'+myJSON[i]['id']+'" data-id="'+myJSON[i]['id']+'" id="client-'+myJSON[i]['id']+'" onclick=showDetails1('+myJSON[i]['id']+')><td><a class="add-click arrow" href="javascript:void(0)"  data-id="'+myJSON[i]['id']+' id="client-info-ajax">'+myJSON[i]['company_name']+'</a><ul class="custom-menu custom-menu-'+myJSON[i]['id']+'"><li data-action="first"><a data-toggle="modal" href="#exampleModal">Add Notes</a></li><li><a href="{{route('client.dashboard')}}">Client Dashboard</a></li><li><form id="company_database_interview_form_'+myJSON[i]['id']+'" action="{{route('company-schedule-interview')}}" method="post">@csrf<input type="hidden" name="client_id" value="'+myJSON[i]['id']+'"></form><a id="" onClick="company_database_interview_submit('+myJSON[i]['id']+')">Schedule Interview</a></li></ul></td><td>'+myJSON[i]['name']+'</td><td><p>'+myJSON[i]['city']+", "+' '+myJSON[i]['state']+'</p></td> <td><p class="">'+industry+'</p></td><td><a class="add-cursor" href="{{url('/admin/client/jobs/details')}}/'+myJSON[i]['id']+'">'+myJSON[i]['admin_jobs_count']+'</a></td></tr>';--}}
                            } else {
                                html += '<tr><td colspan="3" style="background: #fff;cursor: default;padding: 1px;"></td></tr>' +
                                    '<tr class="add-note add-note-' + myJSON[i]['id'] + '" data-id="' + myJSON[i]['id'] + '" id="client-' + myJSON[i]['id'] + '" onclick=showDetails1(' + myJSON[i]['id'] + ')> ' +
                                    '<td><a class="add-click arrow" href="javascript:void(0)"  data-id="' + myJSON[i]['id'] + ' id="client-info-ajax">' +
                                    '<h4 class="bold-green">' + myJSON[i]['company_name'] + '</h4>' +
                                    '</a><small><b>' + myJSON[i]['city'] + ", " + ' ' + myJSON[i]['state'] + '</b>' +
                                    '</small><ul class="custom-menu custom-menu-' + myJSON[i]['id'] + '">' +
                                    '<li data-action="first"><a data-toggle="modal" href="#exampleModal">Add Notes</a>' +
                                    '</li><li><a href="{{route('client.dashboard')}}">Client Dashboard</a></li></ul></td><td>' + myJSON[i]['name'] + '</td><td><p class="">' + industry + '</p>' +
                                    '</td><td><a class="add-cursor" href="{{url('/admin/client/jobs/details')}}/' + myJSON[i]['id'] + '">' + myJSON[i]['admin_jobs_count'] + '</a>' +
                                    '</td></tr>';
                                {{--html+='<tr><td colspan="4" style="background: #fff;cursor: default;padding: 1px;"></td></tr><tr class="add-note add-note-'+myJSON[i]['id']+'" data-id="'+myJSON[i]['id']+'" id="client-'+myJSON[i]['id']+'" onclick=showDetails1('+myJSON[i]['id']+')> <td><a class="add-click arrow" href="javascript:void(0)"  data-id="'+myJSON[i]['id']+' id="client-info-ajax">'+myJSON[i]['company_name']+'</a><ul class="custom-menu custom-menu-'+myJSON[i]['id']+'"><li data-action="first"><a data-toggle="modal" href="#exampleModal">Add Notes</a></li><li><a href="{{route('client.dashboard')}}">Client Dashboard</a></li><li<form id="company_database_interview_form_'+myJSON[i]['id']+'" action="{{route('company-schedule-interview')}}" method="post">@csrf<input type="hidden" name="client_id" value="'+myJSON[i]['id']+'"></form><a id="" onClick="company_database_interview_submit('+myJSON[i]['id']+')">Schedule Interview</a></li></ul></td><td>'+myJSON[i]['name']+'</td><td><p>'+myJSON[i]['city']+", "+' '+myJSON[i]['state']+'</p></td> <td><p class="">'+industry+'</p></td><td><a class="add-cursor" href="{{url('/admin/client/jobs/details')}}/'+myJSON[i]['id']+'">'+myJSON[i]['admin_jobs_count']+'</a></td></tr>';--}}
                            }
                        }
                        ;

                        if (html === "") {
                            document.getElementById('htmlShow').innerHTML = '<tr><td colspan="3" style="background: #fff;cursor: default;padding: 1px;">No Clients Found</td></tr>';
                            document.getElementById('show-one-client').innerHTML = `<tr><td colspan="3" style="background: #fff;cursor: default;padding: 1px;">No Client's Detail Found</td></tr>`;
                            document.getElementById('button-for-div').innerHTML = '<p></p>';

                        } else {
                            document.getElementById('htmlShow').innerHTML = html;


                        }
                        document.getElementById('no_result').innerHTML = totalRe;
                        refresh({
                            total: totalRe,// 可选
                            length: length // 可选
                        });
                    }).fail(function (error) {
                    });
                }
            });
        }

        function company_database_interview_submit(id) {
            $("#company_database_interview_form_" + id).submit();
        }


        //note delete
        $(document).on('click', '.note-del', function (e) {
            // e.preventDefault();
            var id = $(this).attr('dataid');

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
                            $('#delete-id-' + id).remove();
                        });
                    } else {
                        swal("Your note is safe!");
                    }

                });
        });

        //end note delete.


        //edit note

        $(document).on('click', '.editNote', function (e) {
            // alert('123');

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


        //for client delete..
        $(document).on('click', '.del-swal', function (e) {
            e.preventDefault();
            var id = $(this).attr('dataid');

            swal({

                title: "Are you sure",
                text: "Once deleted, you will not be able to recover this Client!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: "{{route('client.delete')}}",
                            type: 'post',

                            data: {

                                "_token": "{{ csrf_token() }}",
                                "clientId": id,

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
                            $('#client-' + id).prev().remove();
                            $('#client-' + id).remove();
                            $('#show-one-client').empty();
                            $('#button-for-div').empty();

                        });

                    } else {
                        swal("your client is safe!");
                    }

                });
        });


        //end client delete


        //add pipeline client

        $(document).on('click', '#addClientpipe', function () {
            var id = $(this).attr('dataId');
            swal({
                title: "Are you sure",
                text: "you want to add it to pipeline!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: "{{route('client.addToPipeline')}}",
                            type: 'post',
                            data: {
                                "_token": "{{ csrf_token() }}",
                                "clientId": id,
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
                            console.log(res);
                            // if($('#addClientpipe').text() === 'remove from pipeline')
                            {
                                $('#addClientpipe').text('Remove from Pipeline');
                                $('#addClientpipe').attr("id", "rmvClientPipe");
                            }
                            // else{
                            //     $('#addClientpipe').text('remove from pipeline');
                            //     $('#addClientpipe').attr("id","addClientpipe");
                            // }

                        });

                    } else {
                        swal("Not added into pipeline!");
                    }

                });
        });

        //end pipeline client


        //remove from pipeline
        $(document).on('click', '#rmvClientPipe', function (e) {
            e.preventDefault();
            var id = $(this).attr('dataId');
            swal({
                title: "Are you sure",
                text: "You want to remove it from pipeline!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: "{{route('client.removePiplineClient')}}",
                            type: 'post',
                            data: {
                                "_token": "{{ csrf_token() }}",
                                "clientId": id,
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

                            //if($('#rmvClientPipe').text() === 'remove from pipeline')
                            {
                                $('#rmvClientPipe').text('Add To Pipeline');
                                $('#rmvClientPipe').attr("id", "addClientpipe");
                            }
                            // else{
                            //     $('#addClientpipe').text('remove from pipeline');
                            //     $('#addClientpipe').attr("id","addClientpipe");
                            // }

                        });

                    } else {
                        swal("Not removed from pipeline!");
                    }

                });
        });

        //end remove from pipeline


    </script>



@endsection
