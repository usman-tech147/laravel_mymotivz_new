@extends('admin.layouts.layouts')
@section('title', 'All Employees')
@section('content')
    <div class="app-main__inner">
        <div class="card-header-tab card-header">
            <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><i
                    class="pe-7s-users mr-3 text-muted opacity-6" style="font-size: 35px; "> </i>Employee Database
            </div>
        </div>
        <div class="tabs-animation">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-3">
                        <div class="card-body">
                            <!-- <form action=""> -->
                            <ul class="search-form">
                                <li>
                                    <select id="search_subadmin" name=""
                                            class="form-control second-select multiselect-dropdown">
                                    </select>
                                </li>
                                <li>
                                    <button style="margin: 0px;" id="search_btn_sub_admin" type="button"
                                            class="btn btn-primary pull-left">Search
                                    </button>
                                </li>
                            </ul>
                            <!-- </form> -->
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card mb-3">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card-header-tab card-header">
                                    <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><i
                                            class="pe-7s-users mr-3 text-muted opacity-6" style="font-size: 35px;"> </i>Employees
                                    </div>
                                </div>

                                <div class="card-body candidate-scroll">
                                    <div class="table-responsive">
                                        <span>Total Results: <strong id="no_result"></strong></span>
                                        <table style="width: 100%;"
                                               class="table table-hover table-striped table-bordered table-cursor candidate-list">
                                            <thead>
                                            <tr>
                                                <th>Name</th>
                                            </tr>
                                            </thead>
                                            <tbody id="sub_admins_list">


                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="card-header-tab card-header">
                                    <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><i
                                            class="pe-7s-notebook mr-3 text-muted opacity-6"
                                            style="font-size: 35px;"> </i>Employee Information
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table-detail table table-hover table-striped table-bordered"
                                               id="sub_admin_details">
                                        </table>
                                        <div id="sub_admin_detail_btn">

                                        </div>
                                        {{--                                        <a class="tag" href="{{route('sub_admin_edit')}}">Edit Details</a>--}}
                                        {{--                                        <a class="tag" href="#">Delete</a>--}}
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <ul id="example-2" class="pagination"></ul>
                            <div class="show"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var admin = 0;
        $(document).on('click', '#search_btn_sub_admin', function () {
            admin = $('#search_subadmin').val();
            pageloading(0);
        });
        $(document).ready(function () {
            //
            // client = $('#contract_session').val();
            pageloading(0);
        });

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
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        url: "{{route('sub_admin_ajax')}}",
                        type: "post",
                        data: {
                            'page_num': options.current,
                            'admin': admin,
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
                        page_number = options.current;
                        var html = '';

                        var search = '<option value="" style="display: none">Select Sub Admin</option>';
                        var json = JSON.parse(response);
                        // alert(json[0]['clients'].length);
                        for (let i = 0; i < json[0]['sub_admins'].length; i++) {
                            // alert(json[0]['clients'].length);


                            html += '<tr><td  style="background: #fff;cursor: default;padding: 1px;"></td></tr>' +
                                '<tr data-id="' + json[0]['sub_admins'][i]['id'] + '" class="color-active sub_admins sub_admins-note-' + json[0]['sub_admins'][i]['id'] + '" onclick="showdetails(' + json[0]['sub_admins'][i]['id'] + ')" >' +
                                '<td><div class="add-cursor">' +
                                ' <a class="note-box" href="javascript:void(0)"><h4 class="bold-green">' + json[0]['sub_admins'][i]["name"] + '</h4></a>' +
                                '</div></td></tr>'
                        }
                        for (let k = 0; k < json[0]['drop_down'].length; k++) {

                            search += '<option value="' + json[0]['drop_down'][k]['id'] + '"  >' + json[0]['drop_down'][k]["name"] + '</option>';

                        }

                        document.getElementById('search_subadmin').innerHTML = search;
                        if (html == "") {
                            html = "No Employees Avaliable";
                            var newhtml = "<center>No Employee detail avaliable</center>";
                            document.getElementById('sub_admin_details').innerHTML = newhtml;
                            $('#sub_admin_detail_btn').hide();
                        }


                        document.getElementById('no_result').innerHTML = json[0]['total'];
                        document.getElementById('sub_admins_list').innerHTML = html;
                        var first_contract = $('#sub_admins_list tr:eq(1)').attr('data-id');
                        // alert(first_contract);
                        if (html != "No Company Avaliable") {
                            showdetails(first_contract);
                        }

                        refresh({
                            total: json[0]['total'], // 可选
                            length: 10, // 可选
                        });
                    });
                }
            });
        }

        function showdetails(id) {
            $('.sub_admins').removeClass('color-active');
            $('.sub_admins-note-' + id).addClass('color-active');
            $.ajax({
                url: "{{route('sub_admin_ajax_search')}}",
                type: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    id: id
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

                var json = JSON.parse(response);
                var html = '';
                var resume = '';
                var exs = '';
                var p = '';
                for (let i = 0; i < json['admin_privileges'].length; i++) {
                    p += '<span>' + json['admin_privileges'][i]['name'] + '</span>';
                }
                if (json['resume'] != null) {
                    exs = json['resume'].split('.').pop();
                    if (exs === 'pdf') {
                        resume += '<a target="_blank" href="' + window.location.origin + '/files/' + json['resume'] + '" style="font-size: 45px; margin: 0px 10px 0px 0px;" data-toggle="tooltip" title="" class="fa fa-file-pdf-o" data-original-title="' + exs + ' FILE"></a>'
                    }
                    if (exs === 'docx')
                        resume += '<a target="_blank" href="' + window.location.origin + '/files/' + json['resume'] + '" style="font-size: 45px; margin: 0px 10px 0px 0px;" data-toggle="tooltip" title="" class="fa fa-file-word-o" data-original-title="' + exs + ' FILE"></a>'
                    if (exs === 'doc')
                        resume += '<a target="_blank" href="' + window.location.origin + '/files/' + json['resume'] + '" style="font-size: 45px; margin: 0px 10px 0px 0px;" data-toggle="tooltip" title="" class="fa fa-file-word-o" data-original-title="' + exs + ' FILE"></a>'
                }

                html = '                                        \t<tr>\n' +
                    '                                        \t\t<th>Full Name</th>\n' +
                    '                                        \t\t<td>' + json['name'] + '</td>\n' +
                    '                                        \t</tr>\n' +
                    '                                        \t<tr>\n' +
                    '                                        \t\t<th>Email Address</th>\n' +
                    '                                        \t\t<td>' + json['email'] + '</td>\n' +
                    '                                        \t</tr>\n' +
                    '                                        \t<tr>\n' +
                    '                                        \t\t<th>Phone Number</th>\n' +
                    '                                        \t\t<td>' + json['phone_no'] + '</td>\n' +
                    '                                        \t</tr>\n' +
                    '                                        \t<tr>\n' +
                    '                                        \t<tr>\n' +
                    '                                        \t\t<th>Hire Date</th>\n' +
                    '                                        \t\t<td>' + json['hiring_date'] + '</td>\n' +
                    '                                        \t</tr>\n' +
                    '                                        \t<tr>\n' +
                    '                                        \t\t<th>Job Title</th>\n' +
                    '                                        \t\t<td>' + json['job_title'] + '</td>\n' +
                    '                                        \t</tr>\n' +
                    '                                        \t<tr>\n' +
                    '                                        \t\t<th>Home Address</th>\n' +
                    '                                        \t\t<td>' + json['home_address'] + '</td>\n' +
                    '                                        \t</tr>\n' +
                    '                                        \t<tr>\n' +
                    '                                        \t\t<th>Description</th>\n' +
                    '                                        \t\t<td>' + json['description'] + '</td>\n' +
                    '                                        \t</tr>\n' +
                    '                                        \t<tr>\n' +
                    '                                        \t\t<th>Privileges</th>\n';
                if (p == '') {
                    html += '                                        \t\t<td>' + 'Super Admin' + '</td>\n';
                } else {
                    html += '                                        \t\t<td>' + p + '</td>\n';
                }
                html += '                                        \t</tr>' +
                    '<tr><th>Resume:</th>' +
                    '<td>' +
                    resume +
                    '</td>' +
                    '</tr>';


                document.getElementById('sub_admin_details').innerHTML = html;


                var newhtml = '<a class="tag" href="{{url('/admin/sub-admin/edit')}}/' + json['id'] + '">Edit Details</a>' +
                    '       <a class="tag delete_sub_admin" href="javascript:void(0)" data-id="' + json['id'] + '" >Delete</a> ';

                document.getElementById('sub_admin_detail_btn').innerHTML = newhtml;
            });
        }


        $(document).on('click', '.delete_sub_admin', function () {
            var id = $(this).attr('data-id');

            swal({

                title: "Are you sure?",
                text: "You really want to remove this Employee!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: "{{route('sub_admin_delete')}}",
                            type: 'post',
                            data: {
                                "_token": "{{ csrf_token() }}",
                                id: id
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

                            pageloading(0);
                            swal("Employee is Removed!");
                        });
                    } else {
                        swal("Employee is not removed!");
                    }

                });
        });


    </script>

@endsection
