@extends('admin.layouts.layouts')
@section('title', 'Search')

@section('content')
    @if(session()->has('piplinemessage'))
        <div class="alert alert-success">
            {{ session()->get('piplinemessage') }}
        </div>
    @endif
    <div class="app-main__inner">
        <div class="tabs-animation">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-3">
                        <div class="card-header-tab card-header">
                            <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><i
                                    class="pe-7s-search mr-3 text-muted opacity-6" style="font-size: 35px;"> </i>Search
                            </div>
                        </div>
                        <div class="card-body">
                            {{--                            <form action="">--}}
                            <ul class="search-form mega-search-detail">
                                <li>
                                    {{--                                        <label>Type Here For Search</label>--}}
                                    <div class="clearfix"></div>
                                    <select id="module-selector">
                                        <option value="1">Client Search</option>
                                        <option value="2">Candidate Search</option>
                                        <option value="3">Job Search</option>
                                    </select>
                                    <input id="name" type="text" placeholder="Name/Title">
                                </li>

                                <li>
                                    {{--                                        <label>Enter City/State</label>--}}
                                    <input id="city" type="text" placeholder="City" class="form-control">
                                </li>
                                <li>
                                    {{--                                        <label>Enter City/State</label>--}}
                                    <input id="state" type="text" placeholder="State" class="form-control">
                                </li>
                                <li class="search-client search-design-btn del">
                                    <button onclick="Fun_client(10)" type="button" class="btn btn-primary pull-left">
                                        Search
                                    </button>
                                    <button type="button" data-toggle="tooltip" title="Advanced Search"
                                            class="btn btn-primary pull-left mega-search"
                                            style="padding: 5px 10px; margin-left: 5px;"><i style="font-size: 30px;"
                                                                                            class="pe-7s-config"></i>
                                    </button>
                                </li>
                                <li class="search-candidate search-design-btn del" style="display: none;">
                                    <button onclick="Fun_candidate(10)" type="button" class="btn btn-primary pull-left">
                                        Search
                                    </button>
                                    <button type="button" data-toggle="tooltip" title="Advanced Search"
                                            class="btn btn-primary pull-left mega-search"
                                            style="padding: 5px 10px; margin-left: 5px;"><i style="font-size: 30px;"
                                                                                            class="pe-7s-config"></i>
                                    </button>
                                </li>
                                <li class="search-job search-design-btn del" style="display: none;">
                                    <button onclick="jobsFun(10)" type="button" class="btn btn-primary pull-left">
                                        Search
                                    </button>
                                    <button type="button" data-toggle="tooltip" title="Advanced Search"
                                            class="btn btn-primary pull-left mega-search"
                                            style="padding: 5px 10px; margin-left: 5px;"><i style="font-size: 30px;"
                                                                                            class="pe-7s-config"></i>
                                    </button>
                                </li>
                                {{--                                </ul>--}}
                                {{--                                <div class="motivz-job-search">--}}
                                {{--                                    <ul id="client-search-perent">--}}
                                <li class="remove-li client-search-perent">
                                    <input id="client-jobTitle" type="text" class="tags_3 form-control"
                                           placeholder="Job Title">
                                </li>

                                <li class="remove-li client-search-perent">
                                    <input id="poc" type="text" class="form-control" placeholder="POC">
                                </li>
                                <li class="remove-li client-search-perent">
                                    <input id="client-industry" type="text" class="form-control" placeholder="Industry">
                                </li>
                                <li class="remove-li client-search-perent"><input class="btn btn-primary"
                                                                                  onclick="Fun_client(10)" type="button"
                                                                                  value="Search"></li>
                                {{--                                    </ul>--}}

                                {{--                                    <ul style="display: none" id="candidate-search-perent">--}}
                                <li class="remove-li candidate-search-perent">
                                    <input id="candidate-job-title" type="text" class="tags_4 form-control"
                                           placeholder="Job Title">
                                </li>

                                <li class="remove-li candidate-search-perent">
                                    <input id="skills" type="text" class="tags_2 form-control" placeholder="Skills">
                                </li>
                                <li class="remove-li candidate-search-perent">
                                    <input id="industry" type="text" class="form-control" placeholder="Industry">
                                </li>

                                <li class="remove-li candidate-search-perent">
                                    <select onchange="optionSearch()" id="selected-options-status" name=""
                                            class="form-control second-select multiselect-dropdown">
                                        <option style="display: none;" value=""></option>
                                        @foreach($statuses as $status)
                                            <option value="{{$status->id}}">{{$status->name}}</option>
                                        @endforeach
                                    </select>

                                </li>


                                <li class="remove-li candidate-search-perent"><input class="btn btn-primary"
                                                                                     onclick="Fun_candidate(10)"
                                                                                     type="button" value="Search"></li>
                                {{--                                    </ul>--}}

                                {{--                                    <ul style="display: none;" id="job-search-perent">--}}
                                <li class="remove-li job-search-perent">
                                    <input id="service" type="text" class="form-control" placeholder="Service Needed">
                                </li>
                                <li class="remove-li job-search-perent">
                                    <input id="salary" type="text" class="form-control" placeholder="Compensation">
                                </li>
                                <li class="remove-li job-search-perent">
                                    <select id="selected-options-main-search" name=""
                                            class="form-control second-select multiselect-dropdown">
                                        <option value=""></option>
                                        @foreach($clients as $client)
                                            <option value="{{$client->id}}">{{$client->name}}</option>
                                        @endforeach
                                    </select>
                                </li>
                                <li class="remove-li job-search-perent"><input class="btn btn-primary"
                                                                               onclick="jobsFun(10)" type="button"
                                                                               value="Search"></li>
                            </ul>

                            {{--                                </div>--}}
                            {{--                            </form>--}}
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card mb-3">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="card-header-tab card-header">
                                    <div id="module-name"
                                         class="card-header-title font-size-lg text-capitalize font-weight-normal"><i
                                            class="pe-7s-users mr-3 text-muted opacity-6" style="font-size: 35px;"> </i>Clients
                                    </div>
                                </div>
                                <div class="card-body candidate-scroll">
                                    <div class="table-responsive">
                                        <table id="htmlShow" style="width: 100%;"
                                               class="table table-hover table-striped table-bordered table-cursor candidate-list">

                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="card-header-tab card-header">
                                    <div id="module-detail"
                                         class="card-header-title font-size-lg text-capitalize font-weight-normal"><i
                                            class="pe-7s-notebook mr-3 text-muted opacity-6"
                                            style="font-size: 35px;"> </i>Client Details
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="show-one-client"
                                               class="table-detail table table-hover table-striped table-bordered">
                                        </table>
                                        <div id="button-for-div">

                                        </div>
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
        <ul id="search-pag" class="pagination"></ul>
        <div class="show"></div>
    </div>
    <script>


        var candId = 0;
        var option = $('#module-selector option:selected').val();
        var job_id_cus = 0;

        //client testing
        function showDetails(id) {
            // alert(id);

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

                // dataType: 'json'
            }).done(function (response) {

                var json = JSON.parse(response);
                var myJSON = json[0];
                var contract = json[2];
                console.log(myJSON[0]['id']);
                var notes = json[1];
                divNoteHtml += '   <div id="append-note-' + id + '" class="note-wrap detail"><ul>';
                for (var i = 0; i < notes.length; i++) {

                    var date = new Date(notes[i]['created_at']);


                    var newDate = (((date.getMonth() > 8) ? (date.getMonth() + 1) : ('0' + (date.getMonth() + 1))) + '/' + ((date.getDate() > 9) ? date.getDate() : ('0' + date.getDate())) + '/' + date.getFullYear());


                    divNoteHtml += ' <li id="delete-id-' + notes[i]['id'] + '"><time>' + newDate + ' </time><p id="note-' + notes[i]['id'] + '">' + notes[i]['description'] + '</p><a id="note-del-' + notes[i]['id'] + '" dataId="' + notes[i]['id'] + '" href="javascript:void(0)" class="tag btn note-del">Delete</a><a id="note-edit-' + notes[i]['id'] + '" dataId="' + notes[i]['id'] + '"  href="#editNotePopup" data-toggle="modal" class="tag btn editNote">Edit</a></li>';
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
                    if (contract['admin_status'] == 0) {
                        icon = '<a @can('view', App\Models\Admin\AdminContract::class) target="_blank" href="{{route('allcontract')}}" @endcan @cannot('view', App\Models\Admin\AdminContract::class) href="javascript:void(0)" @endcannot style="font-size: 45px; margin: 0px 10px 0px 0px;" data-toggle="tooltip" title="" class=" "  ><img id="img-' + id + '" height="50" width="50" src="' + window.location.origin + '/assets/images/contract_sent.png"></a>'
                    } else {
                        icon = '<a  @can('view', \App\Models\Admin\AdminContract::class) target="_blank" href="{{route('allcontract')}}" @endcan @cannot('view', App\Models\Admin\AdminContract::class) href="javascript:void(0)" @endcannot style="font-size: 45px; margin: 0px 10px 0px 0px;" data-toggle="tooltip" title="" class=" "  ><img id="img-' + id + '" height="50" width="50" src="' + window.location.origin + '/assets/images/contract_signed.png"></a>'

                    }
                    con = '<tr><th>Latest Contract Status:</th><td>' + icon + '</td></tr>';

                }
                var phone_number = myJSON[0]['phone'];
                if (phone_number == -1) {
                    phone_number = 'N/A'
                }
                html = '  <tr id="clientDetail-' + myJSON[0]['id'] + '"><th>Date logged:</th><td>' + job_date_1 + ' </td></tr><tr><th>POC:</th><td>' + myJSON[0]['name'] + '</td></tr><tr><th>Phone Number:</th>' +
                    '<td>' + phone_number + '</td></tr>' +
                    '<tr><th>Email:</th><td>' + myJSON[0]['email'] + '</td></tr><tr><th>Location:</th><td>' + myJSON[0]['city'] + ', ' + myJSON[0]['state'] + '</td></tr><tr><th>Company Name:</th><td>' + myJSON[0]['company_name'] + '</td> </tr><tr><th>Website Address:</th><td>' + webUrl + '</td></tr><tr><th>Notes:</th><td>' + divNoteHtml + '</td></tr>' + con;
                // <tr><th>Types Of Industry:</th><td>'+myJSON[0]['industry']+'</td></tr>

                // console.log(myJSON[0]['pipeline'].length);
                console.log(myJSON[0]['pipeline'])
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

        function Fun_client(length) {
            // body...
            // alert('123');
            var name = $('#name').val();
            var state = $('#state').val();
            var city = $('#city').val();
            var poc = $('#poc').val();
            var jobTitle = $('#client-jobTitle').val();
            var industry = $('#client-industry').val();


            $('#search-pag').pagination({
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
                            "industry": industry,
                            "jobTitle": jobTitle,
                            "poc": poc,
                        },

                        // dataType: 'json'
                    }).done(function (res) {
                        //alert(res);
                        var json = JSON.parse(res);
                        // alert(json[0]);

                        var myJSON = json[1];
                        // alert(myJSON);
                        var totalRe = json[0];
                        // alert(total);
                        // console.log(res[1]);
                        // if(res[1].length!=0)
                        // {
                        // var response=res[1];
                        // alert(myJSON.length);
                        var th = '<thead><tr><th>Company Name</th><th>POC</th><th>Industry</th><th>#Job Openings</th></tr></thead>';
                        for (var i = 0; i < myJSON.length; i++) {
                            if (i == 0) {
                                showDetails(myJSON[i]['id']);
                            }

                            {{--// {{url("admin/Client/Database/")}}/'+myJSON[i]['id']+'--}}
                            if (myJSON[i]['industry'] == null) {
                                var industry = "";
                            } else {
                                var industry = myJSON[i]['industry'];
                            }


                            if (i == 0) {
                                html += '<tr><td colspan="3" style="background: #fff;cursor: default;padding: 1px;"></td></tr><tr class="add-note color-active add-note-' + myJSON[i]['id'] + '" data-id="' + myJSON[i]['id'] + '" id="client-' + myJSON[i]['id'] + '" onclick=showDetails(' + myJSON[i]['id'] + ')><td><a class="add-click arrow " href="javascript:void(0)"  data-id="' + myJSON[i]['id'] + ' id="client-info-ajax"><h4 class="bold-green">' + myJSON[i]['company_name'] + '</h4></a><small><b>' + myJSON[i]['city'] + ", " + ' ' + myJSON[i]['state'] + '</b></small><ul class="custom-menu custom-menu-' + myJSON[i]['id'] + '"><li data-action="first"><a data-toggle="modal" href="#exampleModal">Add Notes</a></li><li><a href="{{route('client.dashboard')}}">Client Dashboard</a></li></ul></td><td>' + myJSON[i]['name'] + '</td><td><p class="">' + industry + '</p></td><td><a class="add-cursor" href="{{url('/admin/client/jobs/details')}}/' + myJSON[i]['id'] + '">' + myJSON[i]['jobs_count'] + '</a></td></tr>';
                            } else {
                                html += '<tr><td colspan="3" style="background: #fff;cursor: default;padding: 1px;"></td></tr><tr class="add-note add-note-' + myJSON[i]['id'] + '" data-id="' + myJSON[i]['id'] + '" id="client-' + myJSON[i]['id'] + '" onclick=showDetails(' + myJSON[i]['id'] + ')> <td><a class="add-click arrow" href="javascript:void(0)"  data-id="' + myJSON[i]['id'] + ' id="client-info-ajax"><h4 class="bold-green">' + myJSON[i]['company_name'] + '</h4></a><small><b>' + myJSON[i]['city'] + ", " + ' ' + myJSON[i]['state'] + '</b></small><ul class="custom-menu custom-menu-' + myJSON[i]['id'] + '"><li data-action="first"><a data-toggle="modal" href="#exampleModal">Add Notes</a></li><li><a href="{{route('client.dashboard')}}">Client Dashboard</a></li></ul></td><td>' + myJSON[i]['name'] + '</td><td><p class="">' + industry + '</p></td><td><a class="add-cursor" href="{{url('/admin/client/jobs/details')}}/' + myJSON[i]['id'] + '">' + myJSON[i]['jobs_count'] + '</a></td></tr>';
                            }


                        }
                        ;

                        if (html == "") {
                            document.getElementById('htmlShow').innerHTML = '<p>No Result Found</p>';
                            document.getElementById('show-one-client').innerHTML = '<p>No Result Found</p>';
                            document.getElementById('button-for-div').innerHTML = '<p></p>';

                        } else {
                            document.getElementById('htmlShow').innerHTML = "" + th + html;
                        }

                        // }else{
                        //     document.getElementById('htmlShow').innerHTML='';
                        // }
                        // res.total=res[0];
                        // res.length=1;
                        // do something
                        // 请务必调用此方法，否则分页按钮不会刷新
                        refresh({
                            total: totalRe,// 可选
                            length: length // 可选
                        });
                    }).fail(function (error) {
                    });
                }
            });
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

                            // dataType: 'json'
                        }).done(function (res) {
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
            // e.preventDefault();

            var id = $(this).attr('dataId');
            // alert(id);
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

                            // dataType: 'json'
                        }).done(function (res) {

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


        //end client testing


        //testing
        // window.onload=Fun(10);

        //to access globaly in deffernet functions..
        //for client detail

        function showDetails1(id) {

            candId = id;
            //put it on popup form hidden field to sent it to backend for add it to pipeline..
            $('#candiate-id-for-pipeline').val(candId);

            $('.cus-cls').removeClass('color-active');
            $('.cus-cls-' + id).addClass('color-active');

            var html = '';
            var html1 = '';
            var divNoteHtml = '';
            $.ajax({

                url: "{{route('candidate.database.detail.ajax')}}",
                type: 'post',

                data: {
                    "_token": "{{ csrf_token() }}",
                    "dataId": id,
                },

                // dataType: 'json'
            }).done(function (response) {


                var json = JSON.parse(response);
                // console.log(json);
                var myJSON = json[0];
                var notes = json[1];
                var job_date = new Date(myJSON[0]['created_at']);
                var job_date_1 = (((job_date.getMonth() > 8) ? (job_date.getMonth() + 1) : ('0' + (job_date.getMonth() + 1))) + '/' + ((job_date.getDate() > 9) ? job_date.getDate() : ('0' + job_date.getDate())) + '/' + job_date.getFullYear());
                divNoteHtml += '   <div id="append-note-cand-' + id + '" class="note-wrap detail"><ul>';
                for (var i = 0; i < notes.length; i++) {
                    var date = new Date(notes[i]['created_at']);
                    var job_date = new Date(myJSON[0]['created_at']);

                    var newDate = (((date.getMonth() > 8) ? (date.getMonth() + 1) : ('0' + (date.getMonth() + 1))) + '/' + ((date.getDate() > 9) ? date.getDate() : ('0' + date.getDate())) + '/' + date.getFullYear());

                    if (notes[i]['description'] == null) {
                        var noteClient = "";
                    } else {
                        var noteClient = notes[i]['description'];
                    }
                    divNoteHtml += ' <li id="delete-id-' + notes[i]['id'] + '">' +
                        '<time>' + newDate + ' </time>' +
                        '<p id="note-' + notes[i]['id'] + '">' + noteClient + '</p>' +
                        '<a id="note-del-' + notes[i]['id'] + '" dataId="' + notes[i]['id'] + '" href="javascript:void(0)" class="tag btn note-del">Delete</a>' +
                        '<a id="note-edit-' + notes[i]['id'] + '" dataid="' + notes[i]['id'] + '" href="#editNotePopup" data-toggle="modal" class="tag btn editNote">Edit</a>' +
                        '</li>';
                }
                divNoteHtml += '     </ul></div>';
                // for (var i = 0 ; i <myJSON.length; i++) {
                // alert(myJSON[i]);
                // {{url("admin/Client/Database/")}}/'+myJSON[i]['id']+'
                var exp = '';
                var moreThenTen = "";
                (myJSON[0]['experience'] == 1) ? exp = 'year' : exp = 'years';
                (myJSON[0]['experience'] > 10) ? moreThenTen = 'More than 10' : moreThenTen = myJSON[0]['experience'];

                //use to append spans in td for skills..
                var skills = myJSON[0]['skills'].split(',');

                //use to append spans in td for education..
                //var education = myJSON[0]['education'].split(',') ;

                //use to append spans in td for industry..
                var industry = myJSON[0]['Industry'].split(',');

                var interest = myJSON[0]['interest'].split(',');


                var skillData = "";
                var indus = "";
                var intr = "";
                var resume = "";
                var exs = "";
                var statusTextColor = "";
                for (let a = 0; a < skills.length; a++) {
                    skillData += '<small class="borders"><img src="{{ asset('assets/images/checkicon.png') }}" alt="">' + skills[a] + '</small>';
                }

                for (let b = 0; b < industry.length; b++) {
                    indus += '<small class="borders"> ' + industry[b] + '</small>';
                }


                for (let b = 0; b < interest.length; b++) {
                    intr += '<small class="borders"><img src="{{ asset('assets/images/checkicon.png') }}" alt="">' + interest[b] + '</small>';
                }


                console.log("resume: " + myJSON[0]['admin_resumes'])
                for (let b = 0; b < myJSON[0]['admin_resumes'].length; b++) {
                    exs = myJSON[0]['admin_resumes'][b]['resume'].split('.').pop();
                    if (exs === 'pdf') {
                        resume += '<a @can('download', App\Models\Admin\AdminResume::class) target="_blank" href="' + window.location.origin + '/public/files/' + myJSON[0]['admin_resumes'][b]['resume'] + '"@endcan @cannot('download', App\Models\Admin\AdminResume::class) href="javascript:void(0)" @endcannot style="font-size: 45px; margin: 0px 10px 0px 0px;" data-toggle="tooltip" title="" class="fa fa-file-pdf-o" data-original-title="' + exs + ' FILE"></a>'
                    }

                    if (exs === 'docx')
                        resume += '<a @can('download', App\Models\Admin\AdminResume::class) target="_blank" href="' + window.location.origin + '/public/files/' + myJSON[0]['admin_resumes'][b]['resume'] + '"@endcan @cannot('download', App\Models\Admin\AdminResume::class) href="javascript:void(0)" @endcannot" style="font-size: 45px; margin: 0px 10px 0px 0px;" data-toggle="tooltip" title="" class="fa fa-file-word-o" data-original-title="' + exs + ' FILE"></a>'
                    if (exs === 'doc')
                        resume += '<a @can('download', App\Models\Admin\AdminResume::class) target="_blank" href="' + window.location.origin + '/public/files/' + myJSON[0]['admin_resumes'][b]['resume'] + '"@endcan @cannot('download', App\Models\Admin\AdminResume::class) href="javascript:void(0)" @endcannot" style="font-size: 45px; margin: 0px 10px 0px 0px;" data-toggle="tooltip" title="" class="fa fa-file-word-o" data-original-title="' + exs + ' FILE"></a>'

                }
                statusTextColor = (myJSON[0]['admin_status']['color'] === '#ffffff') ? "#000000" : "#ffffff";
                //for get the candidate id to create note against them.
                $('#cand-id-custom').val(myJSON[0]['id']);

                var salary = myJSON[0]['salary'];
                if (myJSON[0]['salary'] == -1) {
                    salary = 'N/A';
                }
                if (myJSON[0]['experience'] == -1) {
                    moreThenTen = 'N/A';
                    exp = ' ';
                }
                var emp = myJSON[0]['employer'];
                if (myJSON[0]['employer'] == null) {
                    emp = 'N/A';
                }
                html = '  <tr><th>Date Logged:</th><td>' + job_date_1 + ' </td></tr>' +
                    '<tr><th>Full Name:</th><td id="candidate_database_name_' + myJSON[0]['id'] + '">' + myJSON[0]['name'] + '</td>' + '</tr>' +
                    '<tr><th>Salary Requirements:</th><td>' + salary + '</td>' + '</tr>' +
                    '<tr><th>Phone Number:</th><td>' + myJSON[0]['phone'] + '</td></tr>' +
                    '<tr><th>Interest:</th><td>' + intr + '</td></tr>' +
                    '<tr><th>Email:</th><td>' + myJSON[0]['email'] + '</td></tr>' +
                    '<tr><th>Employer:</th><td>' + emp + '</td></tr>' +
                    '<tr><th>Location:</th><td>' + myJSON[0]['city'] + ', ' + myJSON[0]['state'] + '</td></tr>' +
                    '<tr><th>Experience:</th><td>' + moreThenTen + ' ' + exp + '</td> </tr>';
                if (myJSON[0]['admin_education']) {
                    html += '<tr><th>Education:</th><td id="edu-cls">' + myJSON[0]['admin_education']['name'] + '</td></tr>';
                } else {
                    html += '<tr><th>Education:</th><td id="edu-cls">' + 'N/A' + '</td></tr>';
                }
                html += '<tr><th>Skills:</th><td id="skl-cls"></td></tr>' +
                    '<tr><th>Industry:</th><td>' + indus + '</td></tr>' +
                    '<tr><th>Status:</th><td><img width="50px" height="50px" src="' + window.location.origin + '/status_icons/' + myJSON[0]['admin_status']['status_icon'] + '" data-id="' + myJSON[0]['admin_status']['id'] + '" id="candidate-id-' + myJSON[0]['id'] + '"></td></tr>' +
                    // '<tr><th>Status:</th><td><span class="status" data-id="'+myJSON[0]['admin_status']['id']+'" id="candidate-id-'+myJSON[0]['id']+'" style="background-color: '+myJSON[0]['admin_status']['color']+'!important; color: '+statusTextColor+';font-weight: bold"><small>'+myJSON[0]['admin_status']['name']+'</small></span></td></tr>' +
                    '<tr><th>Notes:</th><td>' + divNoteHtml + '</td></tr>' +
                    '<tr><th>Resume:</th>' +
                    '<td>' +
                    resume +
                    '</td>' +
                    '</tr>';
                // <tr><th>Types Of Industry:</th><td>'+myJSON[0]['industry']+'</td></tr>


                    {{--if(myJSON[0]['recruitment_pipeline']==1)--}}
                    {{--{--}}
                    {{--    var buttonRecruiter='<a class="tag" href="{{url('admin/client/removePiplineClient/')}}/'+myJSON[0]['id']+'">Remove from pipeline</a>';--}}
                    {{--}else{--}}
                    {{--    var buttonRecruiter='<a id="add-pipe" class="tag" href="{{url('admin/client/addPiplineClient/')}}/'+myJSON[0]['id']+'" data-toggle="modal">Add to pipeline</a>';--}}
                    {{--}--}}
                var p_btn = "";
                var stat = $('#candidate-id-' + candId).text();
                // alert(stat);
                // if (stat !="OTM")
                // {
                p_btn = '<a class="tag" data-toggle="modal" id="candidate_present_btn" href="#presentModal">Present</a>';
                // }
                html1 = '<a class="tag" data-toggle="modal" href="#statusModal">Update Status</a><a class="tag" data-toggle="modal" href="#exampleModal-1">Add Notes</a> <a class="tag" href="{{url('admin/candidate/edit/')}}/' + myJSON[0]['id'] + '">Edit</a> @can('delete', App\Models\Admin\AdminCandidate::class)<a dataId="' + myJSON[0]['id'] + '" class="tag del-cand" href="#">Delete</a> @endcan ' + p_btn + '<a class="tag" id="add_to_pipeline_btn" data-toggle="modal" href="#pipelineModal_letest">Add to recruitment pipeline</a>';
                // };

                document.getElementById('show-one-client').innerHTML = html;
                document.getElementById('button-for-div').innerHTML = html1;
                if (skillData != "") {
                    document.getElementById('skl-cls').innerHTML = skillData;
                }
                // if(eduData!="")
                // {
                //     document.getElementById('edu-cls').innerHTML=eduData;
                // }
                // alert(indus);
                if (indus != "") {
                    // document.getElementById('idus-cls').innerHTML=indus;
                }


                //geting data status id using candidate id..
                var status_id = $('#candidate-id-' + candId).attr('data-id');
                $('#status-updated-slc option[value=' + status_id + ']').attr('selected', 'true');
            });

        }

        //end client detail


        function Fun_candidate(length) {

            // body...
            // alert('123');
            var name = $('#name').val();
            var state = $('#state').val();
            var city = $('#city').val();
            var Industry = $('#industry').val();
            var Skills = $('#skills').val();

            var jobTitle = $('#candidate-job-title').val();
            var status = $('#selected-options-status').val();

            $('#search-pag').pagination({
                total: 1, // 总数据条数
                current: 1, // 当前页码
                length: length, // 每页数据量
                size: 1, // 显示按钮个数
                /**
                 * ajax请求远程数据
                 * 此方法阻止按钮渲染
                 * 直到调用refresh方法
                 * @param  {[object]} options = {
                 *      current: options.current,
                 *      length: options.length,
                 *      total: options.total
                 *  }
                 * @param  {[function]} refresh 回调函数以刷新分页按钮
                 * @param  {[object]} $target [description]
                 * @return {[type]}         [description]
                 */
                ajax: function (options, refresh, $target) {

                    var html = '';

                    $.ajax({

                        url: "{{route('candidate.database.ajax')}}",
                        type: 'post',

                        data: {
                            current: options.current,
                            length: options.length,
                            "_token": "{{ csrf_token() }}",
                            "name": name,
                            "state": state,
                            "city": city,
                            "Industry": Industry,
                            "Skills": Skills,
                            'jobTitle': jobTitle,
                            'status': status,
                        },

                        // dataType: 'json'
                    }).done(function (res) {

                        var json = JSON.parse(res);
                        var statusTextColor = "";
                        var myJSON = json[1];
                        // alert(myJSON);
                        var totalRe = json[0];
                        // alert(total);
                        // console.log(res[1]);
                        // if(res[1].length!=0)
                        // {
                        // var response=res[1];
                        // alert(myJSON.length);
                        for (var i = 0; i < myJSON.length; i++) {

                            statusTextColor = (myJSON[i]['admin_status']['color'] === '#ffffff') ? "#000000" : "#ffffff";

                            if (i == 0) {

                                showDetails1(myJSON[i]['id']);
                                html += ' <thead><tr>\n' +
                                    '                                          <th><input type="checkbox" id="candidate_checklist"></th>\n' +
                                    '                                            <th>Candidate\'s name </th><th style="width: 70px;">Status</th>' +
                                    '</tr></thead>\n' +
                                    '<tr><td colspan="3" style="background: #fff;cursor: default;padding: 1px;"></td></tr><tr id="cadidate-' + myJSON[i]['id'] + '" class="cus-cls color-active cus-cls-' + myJSON[i]['id'] + ' add-note" data-id="' + myJSON[i]['id'] + '" onclick=showDetails1(' + myJSON[i]['id'] + ')><td><input type="checkbox" class="candidate_checkboxes"></td><td><h4 class=" bold-green" data-id="' + myJSON[i]['id'] + ' id="client-info-ajax">' + myJSON[i]['name'] + '</h4><small><b>' + myJSON[i]['job_title'] + '</b></small><p>' + myJSON[i]['city'] + ', ' + myJSON[i]['state'] + '</p></td><td><p class="add-cursor"><img id="list_status-' + myJSON[i]['id'] + '" data-id="' + myJSON[i]['admin_status']['id'] + '" width="50px" height="50px" src="' + window.location.origin + '/status_icons/' + myJSON[i]['admin_status']['status_icon'] + '" ></p></td></tr>';
                            } else {
                                html += '<tr><td colspan="3" style="background: #fff;cursor: default;padding: 1px;"></td></tr><tr id="cadidate-' + myJSON[i]['id'] + '" class="cus-cls cus-cls-' + myJSON[i]['id'] + ' add-note" data-id="' + myJSON[i]['id'] + '" onclick=showDetails1(' + myJSON[i]['id'] + ')><td><input type="checkbox" class="candidate_checkboxes"></td> <td><h4 class=" bold-green" data-id="' + myJSON[i]['id'] + ' id="client-info-ajax">' + myJSON[i]['name'] + '</h4><small><b>' + myJSON[i]['job_title'] + '</b></small><p>' + myJSON[i]['city'] + ', ' + myJSON[i]['state'] + '</p></td><td><p class="add-cursor"><img id="list_status-' + myJSON[i]['id'] + '" data-id="' + myJSON[i]['admin_status']['id'] + '" width="50px" height="50px" src="' + window.location.origin + '/status_icons/' + myJSON[i]['admin_status']['status_icon'] + '" ></p></td></tr>'
                            }

                        }

                        if (html == "") {
                            document.getElementById('htmlShow').innerHTML = '<tr><td colspan="3" style="background: #fff;cursor: default;padding: 1px;">No Result Found</td></tr>';
                            document.getElementById('show-one-client').innerHTML = '<tr><td colspan="3" style="background: #fff;cursor: default;padding: 1px;">No Result Found</td></tr>';
                            document.getElementById('button-for-div').innerHTML = '<p></p>';

                        } else {

                            document.getElementById('htmlShow').innerHTML = html;
                        }
                        // }else{
                        //     document.getElementById('htmlShow').innerHTML='';
                        // }
                        // res.total=res[0];
                        // res.length=1;
                        // do something
                        // 请务必调用此方法，否则分页按钮不会刷新
                        refresh({
                            total: totalRe,// 可选
                            length: length // 可选
                        });
                    }).fail(function (error) {
                    });
                }
            });

            //end testing


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

                                // dataType: 'json'
                            }).done(function (res) {
                                $('#delete-id-' + id).remove();
                            });
                        } else {
                            swal("Your note is safe!");
                        }

                    });
            });
            //end delete note


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

                    // dataType: 'json'
                }).done(function (res) {

                    $('#note-' + id).text(noteText);

                });

            });


            //end edit note


            //update status
            $(document).on('click', '#update-status', function (e) {

                var option = $('#status-updated-slc option:selected');

                var opColor = $('#status-updated-slc option:selected').attr('color');

                var status = option.val();
                var statusText = option.text();


                // alert(statusText);
                // var color = option.css('background-color');

                //color = color.replace(')', ', 0.75)').replace('rgb', 'rgba');
                $.ajax({
                    url: "{{route('update.status.ajax')}}",
                    type: 'post',

                    data: {

                        "_token": "{{ csrf_token() }}",
                        "status": status,
                        "candId": candId,

                    },

                    // dataType: 'json'
                }).done(function (res) {

                    var textColor = (opColor === "#ffffff") ? '#000000' : '#ffffff';

                    $('#candidate-id-' + candId).text(statusText).css('background-color', opColor);
                    $('#candidate-id-' + candId).text(statusText).css('color', textColor);
                });

            });
            //end update status


            // delete candiadte

            $(document).on('click', '.del-cand', function (e) {
                e.preventDefault();
                var id = $(this).attr('dataid');

                swal({

                    title: "Are you sure",
                    text: "Once deleted, you will not be able to recover this candidate!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            $.ajax({
                                url: "{{route('candidate.delete')}}",
                                type: 'post',

                                data: {

                                    "_token": "{{ csrf_token() }}",
                                    "candId": id,

                                },

                                // dataType: 'json'
                            }).done(function (res) {

                                $('#cadidate-' + id).prev().remove();
                                $('#cadidate-' + id).remove();
                                $('#htmlShow tr:eq(1)').addClass('color-active');
                                showDetails1($('#htmlShow tr:eq(1)').attr('data-id'));


                            });

                        } else {
                            swal("your candidate is safe!");
                        }

                    });
            });

        }


        //job function..
        // window.onload=jobsFun(10);
        function jobsFun(length) {
            // body...
            var html = '';
            // alert('123');
            var name = $('#name').val();
            var state = $('#state').val();
            var city = $('#city').val();
            var salary = $('#salary').val();
            // var jobIndutry=$('#job-industry').val();
            var service = $('#service').val();
            var company = $('#selected-options-main-search option:selected').val();

            // alert(state);
            // alert(name);


            $('#search-pag').pagination({
                total: 1, // 总数据条数
                current: 1, // 当前页码
                length: length, // 每页数据量
                size: 1, // 显示按钮个数
                /**
                 * ajax请求远程数据
                 * 此方法阻止按钮渲染
                 * 直到调用refresh方法
                 * @param  {[object]} options = {
                 *      current: options.current,
                 *      length: options.length,
                 *      total: options.total
                 *  }
                 * @param  {[function]} refresh 回调函数以刷新分页按钮
                 * @param  {[object]} $target [description]
                 * @return {[type]}         [description]
                 */
                ajax: function (options, refresh, $target) {

                    var html = '';

                    $.ajax({

                        url: "{{route('jobs.ajax')}}",
                        type: 'post',

                        data: {
                            current: options.current,
                            length: options.length,
                            "_token": "{{ csrf_token() }}",
                            'name': name,
                            'state': state,
                            'city': city,
                            'service': service,
                            'company': company,
                            'salary': salary,
                        },

                        // dataType: 'json'
                    }).done(function (res) {

                        var mjson = JSON.parse(res);
                        var json = mjson[1];
                        if (json != "") {
                            var totalRe = mjson[0];

                            for (var i = 0; i < json.length; i++) {
                                //{{url("admin/Job/Database/")}}/'+json[i]['id']+'
                                if (i == 0) {
                                    showDetails3(json[i]['id']);
                                }
                                if (json[i]['admin_client'] != undefined && json[i]['admin_client'] != '' && json[i]['admin_client'] != null) {
                                    var comanyName = json[i]['admin_client']['company_name'];
                                } else {
                                    var comanyName = '';
                                }

                                if (i === 0) {
                                    html += '<thead><tr>\n' +
                                        '                                                                <th>Job Title</th>\n' +
                                        '                                                                <th>Employers</th>\n' +
                                        '                                                                <th>Industry</th>\n' +
                                        // '                                                                <th>Location</th>\n' +
                                        '                                                            </tr></thead>' +
                                        '   <tr><td colspan="3" style="background: #fff;cursor: default;padding: 1px;"></td></tr><tr class="add-note add-note-' + json[i]['id'] + ' color-active" id="job-del-' + json[i]['id'] + '" onclick=showDetails3(' + json[i]['id'] + ')><td><a class="job-arrow" href="javascript:void(0)"  data-id="' + json[i]['id'] + '" id="client-info-ajax" ><h4 class="bold-green">' + json[i]['jobtitle'] + '</h4></a><small><b>' + json[i]['city'] + ", " + '  ' + json[i]['state'] + '</b></small></td><td>' + comanyName + '</td><td><div class="add-cursor">' + json[i]['industry'] + '</div></td></td></tr>';
                                } else {
                                    html += '   <tr><td colspan="3" style="background: #fff;cursor: default;padding: 1px;"></td></tr><tr class="add-note add-note-' + json[i]['id'] + '" id="job-del-' + json[i]['id'] + '" onclick=showDetails3(' + json[i]['id'] + ')><td><a class="job-arrow" href="javascript:void(0)" data-id="' + json[i]['id'] + '" id="client-info-ajax" ><h4 class="bold-green">' + json[i]['jobtitle'] + '</h4></a><small><b>' + json[i]['city'] + ", " + '  ' + json[i]['state'] + '</b></small></td><td>' + comanyName + '</td><td><div class="add-cursor">' + json[i]['industry'] + '</div></td></tr>';
                                }

                            }
                        } else {
                            html = "No Result Found";
                            document.getElementById('htmlShow').innerHTML = html;
                            document.getElementById('show-one-client').innerHTML = html;
                            document.getElementById('button-for-div').innerHTML = '';
                        }
                        document.getElementById('htmlShow').innerHTML = html;

                        refresh({
                            total: totalRe,// 可选
                            length: length // 可选
                        });
                    }).fail(function (error) {
                    });
                }
            });
        }

        function showDetails3(id) {

            job_id_cus = id;
            $('.add-note').removeClass('color-active');
            $('.add-note-' + id).addClass('color-active');
            var html = '';
            var html1 = '';
            var divNoteHtml = '';
            $.ajax({

                url: "{{route('job-Details-Ajax')}}",
                type: 'post',

                data: {
                    "_token": "{{ csrf_token() }}",
                    "dataId": id,

                },

                // dataType: 'json'
            }).done(function (response) {
                // alert(response);
                // <tr><th>Expiry Date:</th><td>10/10/2019</td></tr>
                var json = JSON.parse(response);
                console.log(json);
                var job_date = new Date(json[0]['created_at']);
                var job_date_1 = (((job_date.getMonth() > 8) ? (job_date.getMonth() + 1) : ('0' + (job_date.getMonth() + 1))) + '/' + ((job_date.getDate() > 9) ? job_date.getDate() : ('0' + job_date.getDate())) + '/' + job_date.getFullYear());

                // alert(json);
                // console.log(json);
                if (json[0]['service'] == null) {
                    var serviceEmpty = "";
                } else {
                    serviceEmpty = json[0]['service'];
                }

                if (json[0]['web_url'] == null) {
                    var webUrl = "";
                } else {
                    webUrl = json[0]['web_url'];
                }


                html = '  <tr><th>Posted Date:</th><td>' + job_date_1 + '</td></tr><tr><th>Job Title:</th><td>' + json[0]['jobtitle'] + '</td></tr><tr> <th>Employers:</th><td>' + json[0]['admin_client']['company_name'] + '</td></tr> <tr><th>City:</th><td>' + json[0]['city'] + '</td> </tr><tr> <th>State:</th> <td>' + json[0]['state'] + '</td></tr><tr><th>Website:</th><td>' + webUrl + '</td></tr><tr> <th>Compensation:</th><td>' + json[0]['package'] + '</td> </tr><tr> <th>Industry:</th> <td>' + json[0]['industry'] + '</td></tr><tr><th>Service Needed:</th> <td>' + serviceEmpty + '</td></tr> <tr> <th style="vertical-align: top;">Job Requirements:</th><td> <div class="job-requirements"> <P>' + json[0]['job_discription'] + '</P></div></td></tr>';
                // alert(json[0]['recruitment_pipeline']);
                if (json[0]['recruitment_pipeline'] == 1) {

                    var buttonRecruiter = '<a dataid="' + json[0]['id'] + '" id="removeJobPipe"  class="tag" href="javascript:void(0)">Remove from pipeline</a>';
                } else {
                    $('#form-id-job-pipline-id-field').val(json[0]['id']);

                    job_id = json[0]['id'];
                    // var test = $('#form-id-job-pipline-id-field').val();
                    // alert(test);
                    var buttonRecruiter = '<span id="remove"><a id="add-pipe" class="tag" href="#pipelineModal" data-toggle="modal">Add to pipeline</a></span>';
                }
                html1 = ' <a class="tag" href="{{url("admin/job/edit/")}}/' + json[0]['id'] + '">Edit</a><a dataid="' + json[0]['id'] + '" class="tag job-del" href="javascript:void(0)">Delete</a>' + buttonRecruiter + ' ';
                document.getElementById('show-one-client').innerHTML = html;
                document.getElementById('button-for-div').innerHTML = html1;

            });

        }


        $(document).on('click', '.job-del', function (e) {
            // e.preventDefault();

            var id = $(this).attr('dataid');

            swal({

                title: "Are you sure",
                text: "Once deleted, you will not be able to recover this job!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: "{{route('job.delete')}}",
                            type: 'post',

                            data: {

                                "_token": "{{ csrf_token() }}",
                                "jobId": id,

                            },

                            // dataType: 'json'
                        }).done(function (res) {
                            $('#job-del-' + id).prev().remove();
                            $('#job-del-' + id).remove();
                            $('#table-data-ajax').empty();
                            $('#buttons-job').empty();
                        });
                    } else {
                        swal("Your Job is safe!");
                    }

                });
        });

        //for job delete..
        $(document).on('click', '.del-swal', function (e) {
            e.preventDefault();
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
                            url: "{{route('client.delete')}}",
                            type: 'post',

                            data: {

                                "_token": "{{ csrf_token() }}",
                                "clientId": id,

                            },

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


        //end job delete


        //remove job form pipeline
        $(document).on('click', '#removeJobPipe', function (e) {
            e.preventDefault();

            var id = $(this).attr('dataId');

            swal({

                title: "Are you sure",
                text: "You want to remove it to pipeline!",
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

                            // dataType: 'json'
                        }).done(function (res) {

                            //if($('#rmvClientPipe').text() === 'remove from pipeline')
                            {
                                // $('#removeJobPipe').text('Add To Pipeline');
                                // $('#removeJobPipe').attr("id","addClientpipe");
                                $('#removeJobPipe').attr('href', '#pipelineModal');
                                $('#removeJobPipe').text('Add To Pipeline');
                                $('#removeJobPipe').attr("id", "add-pipe");
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
        //end remove job from pipeline

        //add job to pipeline
        $(document).on("click", "#job-pipe-sub", function (e) {
            e.preventDefault();

            // var job_id = $('#form-id-job-pipline-id-field').val() ;
            var client_id = $('#client_name').val();
            var job_pipeline = $('#job-pipeline').val();

            $.ajax({

                url: "{{route('jobpipline.created')}}",
                type: 'post',

                data: {
                    "_token": "{{ csrf_token() }}",
                    "job_id": job_id,
                    "client_id": client_id,
                    "job_pipeline": job_pipeline,
                },

                // dataType: 'json'
            }).done(function (res) {

                $('#add-pipe').attr('href', '');
                $('#add-pipe').text('Remove from pipeline');
                $('#add-pipe').attr("id", "removeJobPipe");

            });


        });

        //end add job to pipeline

        //end job


        $('.remove-li').hide();

        $('.mega-search').click(function () {

            var option = $('#module-selector option:selected').val();

            if (option == 1) {
                $('.search-client.search-design-btn.del').hide();

                $('.remove-li.candidate-search-perent').hide();
                $('.remove-li.job-search-perent').hide();

                $('.remove-li.client-search-perent').show();
            } else if (option == 2) {

                $('.search-client.search-design-btn.del').hide();

                $('.remove-li.client-search-perent').hide();
                $('.remove-li.job-search-perent').hide();
                $('.candidate-search-perent').show();
            } else {

                $('.search-client.search-design-btn.del').hide();

                $('.candidate-search-perent').hide();
                $('.remove-li.client-search-perent').hide();
                $('.job-search-perent').show();
            }

        });


        $('#module-selector').change(function () {
            var option = $('#module-selector option:selected').val();
            // $('.remove-li').hide();
            if (option == 1) {
                //$('.search-client.search-design-btn.del').hide();

                $('.remove-li.candidate-search-perent').hide();
                $('.remove-li.job-search-perent').hide();

                $('.remove-li.client-search-perent').hide();


                $('.search-candidate').hide();
                $('.search-job').hide();

                $('.search-client').show();
                $('#module-name').html('<i class="pe-7s-users mr-3 text-muted opacity-6" style="font-size: 35px;"> </i>Clients');
                $('#module-detail').html('<i class="pe-7s-notebook mr-3 text-muted opacity-6" style="font-size: 35px;"> </i>Client Details');
                Fun_client();

            } else if (option == 2) {

                //$('.search-client.search-design-btn.del').hide();

                $('.remove-li.client-search-perent').hide();
                $('.remove-li.job-search-perent').hide();
                $('.candidate-search-perent').hide();


                $('.search-client').hide();
                $('.search-job').hide();


                $('.search-candidate').show()

                $('#module-name').html('<i class="pe-7s-users mr-3 text-muted opacity-6" style="font-size: 35px;"> </i>Candidates');
                $('#module-detail').html('<i class="pe-7s-notebook mr-3 text-muted opacity-6" style="font-size: 35px;"> </i>Candidate Details');


                Fun_candidate();
            } else {

                //$('.search-client.search-design-btn.del').hide();

                $('.candidate-search-perent').hide();
                $('.remove-li.client-search-perent').hide();
                $('.job-search-perent').hide();


                $('.search-candidate').hide()
                $('.search-client').hide();
                $('.search-job').show();


                $('#module-name').html('<i class="pe-7s-users mr-3 text-muted opacity-6" style="font-size: 35px;"> </i>Jobs');
                $('#module-detail').html('<i class="pe-7s-notebook mr-3 text-muted opacity-6" style="font-size: 35px;"> </i>Job Details');
                jobsFun(10);
            }
        })
        Fun_client();

    </script>
@endsection
