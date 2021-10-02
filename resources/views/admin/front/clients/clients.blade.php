@extends('admin.layouts.layouts')
<!-- Modal -->

@section('title', 'New Clients Database')
<!-- Modal -->
@section('content')

    <div class="app-main__inner">
        <div class="card-header-tab card-header">
            <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><i
                        class="pe-7s-users mr-3 text-muted opacity-6" style="font-size: 35px; "> </i>User Side Clients
                Database
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
                                        <input class="form-control" type="text" name="client-city" id="location"
                                               placeholder="Location">
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
                                    <div class="col-md-7">
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
                                    <div class="col-md-5">
                                        <div class="card-header-tab card-header">
                                            <div
                                                    class="card-header-title font-size-lg text-capitalize font-weight-normal">
                                                <i class="pe-7s-notebook mr-3 text-muted opacity-6"
                                                   style="font-size: 35px;"> </i>Client Details
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table id="showClientDetails"
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

        function clientDetails(id) {
            $('.add-note').removeClass('color-active');
            $('.add-note-' + id).addClass('color-active');
            let html = '';
            let html1 = '';
            $.ajax({
                url: "{{route('front.client.details.ajax')}}",
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
            }).done(function (response) {
                let json = JSON.parse(response);
                let myJSON = json;
                html = '  <tr id="clientDetail-' + json['id'] + '">' +
                    '<th>Date logged:</th><td>' + dateFormat(myJSON['created_at']) + ' </td></tr>' +
                    '<tr><th>POC:</th><td>' + checkValue(myJSON['name']) + '</td></tr>' +
                    '<tr><th>Phone Number:</th><td>' + checkValue(myJSON['phone']) + '</td></tr>' +
                    '<tr><th>Email:</th><td>' + checkValue(myJSON['email']) + '</td></tr>' +
                    '<tr><th>Location:</th><td>' + checkValue(myJSON['complete_address']) + '</td></tr>' +
                    '<tr><th>Company Name:</th><td>' + checkValue(myJSON['company_name']) + '</td> </tr>' +
                    '<tr><th>Website Address:</th><td>' + checkValue(myJSON['web_url']) + '</td></tr>';
                html1 = '<a href="{{url('admin/front-site/client-detail')}}/' + json['id'] + ' " class="btn tag"> ' +
                    'View Client Details ' +
                    '</a>';
                document.getElementById('showClientDetails').innerHTML = html;
                document.getElementById('button-for-div').innerHTML = html1;
            });
        }

        function Fun(length) {
            let name = $('#clientName').val();
            let location = $('#location').val();
            $('#example-2').pagination({
                total: 1,
                current: 1,
                length: length,
                size: 1,
                ajax: function (options, refresh, $target) {
                    let html = '';
                    $.ajax({
                        url: "{{route('front.clients.ajax.all')}}",
                        type: 'post',
                        data: {
                            current: options.current,
                            length: options.length,
                            "_token": "{{ csrf_token() }}",
                            "name": name,
                            "location": location,
                        },
                        beforeSend: function () {
                            $.blockUI({
                                message: '<div class="spinner-grow text-success"></div>' +
                                    '<div class="spinner-grow text-success"></div>' +
                                    '<div class="spinner-grow text-success"></div>',
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
                        for (let i = 0; i < myJSON.length; i++) {
                            if (i === 0) {
                                clientDetails(myJSON[i]['id']);
                                html += '<tr><td colspan="3" style="background: #fff;cursor: default;padding: 1px;"></td>' + '</tr>' +
                                    '<tr class="add-note color-active add-note-' + myJSON[i]['id'] + '" ' +
                                    'data-id="' + myJSON[i]['id'] + '" id="client-' + myJSON[i]['id'] + '" ' +
                                    'onclick=clientDetails(' + myJSON[i]['id'] + ')>' +
                                    '<td><a class="add-click arrow " href="javascript:void(0)"  ' +
                                    'data-id="' + myJSON[i]['id'] + ' id="client-info-ajax">' +
                                    '<h4 class="bold-green">' + checkValue(myJSON[i]['company_name']) + '</h4></a>' +
                                    '<small><b>' + checkValue(myJSON[i]['complete_address']) + '</b>' +
                                    '</small>' +
                                    '</td><td>' + checkValue(myJSON[i]['name']) + '</td>' +
                                    '<td><p class="">' + checkNestedValue(myJSON[i]['industry']) + '</p></td>' +
                                    '<td><a class="add-cursor" ' +
                                    'href="{{url('admin/front-site/client-detail')}}/' +
                                    myJSON[i]['id'] + '">' + myJSON[i]['user_jobs_count'] + '</a>' +
                                    '</td></tr>';
                            } else {
                                html += '<tr><td colspan="3" style="background: #fff;cursor: default;padding: 1px;"></td></tr>' +
                                    '<tr class="add-note add-note-' + myJSON[i]['id'] + '" ' +
                                    'data-id="' + myJSON[i]['id'] + '" id="client-' + myJSON[i]['id'] + '" ' +
                                    'onclick=clientDetails(' + myJSON[i]['id'] + ')> ' +
                                    '<td><a class="add-click arrow" href="javascript:void(0)"  ' +
                                    'data-id="' + myJSON[i]['id'] + ' id="client-info-ajax">' +
                                    '<h4 class="bold-green">' + checkValue(myJSON[i]['company_name']) + '</h4>' +
                                    '</a><small><b>' + checkValue(myJSON[i]['complete_address']) + '</b>' +
                                    '</small>' +
                                    '</td><td>' + checkValue(myJSON[i]['name']) + '</td><td><p class="">' + checkNestedValue(myJSON[i]['industry']) + '</p>' +
                                    '</td><td><a class="add-cursor" ' +
                                    'href="{{url('admin/front-site/client-detail')}}/' +
                                    myJSON[i]['id'] + '">' + myJSON[i]['user_jobs_count'] + '</a>' +
                                    '</td></tr>';
                            }
                        }
                        if (html === "") {
                            document.getElementById('htmlShow').innerHTML = '<tr><td colspan="3" style="background: #fff;cursor: default;padding: 1px;">No Clients Found</td></tr>';
                            document.getElementById('showClientDetails').innerHTML = `<tr><td colspan="3" style="background: #fff;cursor: default;padding: 1px;">No Client's Detail Found</td></tr>`;
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

    </script>
@endsection
