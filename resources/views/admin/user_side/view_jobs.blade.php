@extends('admin.layouts.layouts')
@section('title', 'Jobs')
@section('content')
    <div class="app-main__inner">
        <div class="card-header-tab card-header">
            <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><i
                        class="pe-7s-search mr-3 text-muted opacity-6"
                        style="font-size: 35px; color: #4d9a10 !important;"> </i>Search Job
            </div>
        </div>
        <div class="tabs-animation">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-3">
                        <div class="card-body">
                            <form action="">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input class="form-control" type="text" id="title" name="title"
                                                   style="width: 100%;"
                                                   placeholder="Job Title">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="location" id="location"
                                                   placeholder="Enter Location">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <select onchange="" id="selected-options-status" name=""
                                                class="form-control second-select multiselect-dropdown">
                                            <option value="0">Select Jobs Status</option>
                                            <option value="1"> Active Jobs</option>
                                            <option value="2"> Expired Jobs</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <button style="margin: 0px;" onclick="Fun(10)" type="button"
                                                class="btn btn-primary pull-left">
                                            Search
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card mb-3">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="card-header-tab card-header">
                                    <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><i
                                                class="pe-7s-users mr-3 text-muted opacity-6"
                                                style="font-size: 35px;"> </i>Jobs
                                    </div>
                                </div>
                                <div class="card-body candidate-scroll">
                                    <div class="table-responsive">
                                        <span>Total Results: <strong id="no_result"></strong></span>

                                        <table style="width: 100%;"
                                               class="table table-hover table-striped table-bordered table-cursor candidate-list">
                                            <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Job Title</th>
                                                <th>Status</th>
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
                                    <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><i
                                                class="pe-7s-notebook mr-3 text-muted opacity-6"
                                                style="font-size: 35px;"> </i>Job Details
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

        function jobDetails(id) {
            $('.add-note').removeClass('color-active');
            $('.add-note-' + id).addClass('color-active');
            let html = '';
            let html1 = '';
            let divNoteHtml = '';
            $.ajax({
                url: "{{route('user_side.view.job_detail')}}",
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
                let myJSON = json[0];
                html = '  <tr id="clientDetail-' + json[0]['id'] + '">' +
                    '<th>Posted At:</th><td>' + dateFormat(myJSON['created_at']) + ' </td></tr>' +
                    '<tr><th>Apply Before:</th><td>' + dateFormat(myJSON['applied_before']) + '</td></tr>' +
                    '<tr><th>Job Title:</th><td>' + checkValue(myJSON['job_title']) + '</td></tr>' +
                    '<tr><th>Education:</th><td>' + checkNestedValue(myJSON['education']) + '</td></tr>' +
                    '<tr><th>Job Location:</th><td>' + checkValue(myJSON['location']) + '</td></tr>' +
                    '<tr><th>Website Address:</th><td>' + checkValue(myJSON['web_url']) + '</td></tr>' +
                    '<tr><th>Industry:</th><td>' + checkNestedValue(myJSON['industry']) + '</td></tr>' +
                    '<tr><th>Job Type:</th><td>' + checkValue(myJSON['service']) + '</td></tr>' +
                    '<tr><th>Experience Level:</th><td>' + checkValue(myJSON['required_experience']) + '</td></tr>' +
                    '<tr><th>Number of Hires:</th><td>' + checkValue(myJSON['job_opening']) + '</td></tr>' +
                    '<tr><th>Compensation:</th><td>' +
                    packageFormat(myJSON['package'], myJSON['package_to'], myJSON['package_sign'], myJSON['package_type']) +
                    '</td></tr>' +
                    '<tr><th>Job Benefits:</th><td>' + splitValue(myJSON['job_benefits']) + '</td></tr>' +
                    '<tr><th>Required Skills:</th><td>' + splitValue(myJSON['required_skills']) + '</td></tr>' +
                    '<tr><th>Licensure/Certification:</th><td>' + splitValue(myJSON['certifications']) + '</td></tr>' +
                    '<tr><th colspan="2" style="vertical-align: text-top;"><strong>Job Description:</strong><br> <div class="job_description">' + json[0]['job_description'] + '</div></th></tr>';
                html1 = '<a dataid="' + json[0]['id'] + '" class="tag job-del" href="javascript:void(0)">Delete</a>' +
                    '<a class="tag" href="{{url('admin/front-site/edit-new-job')}}/' + json[0]['id'] + '">Edit</a>' +
                    '<a class="tag" href="{{url('admin/front-site/view_applied_candidates')}}/' + json[0]['id'] + '">Applied Candidates <small>' + json[1] + '</small></a>';

                document.getElementById('showJobDetails').innerHTML = html;
                document.getElementById('button-for-div').innerHTML = html1;
            });
        }

        function Fun(length) {
            let title = $('#title').val();
            let location = $('#location').val();
            $('#example-2').pagination({
                total: 1,
                current: 1,
                length: length,
                size: 1,
                ajax: function (options, refresh, $target) {
                    $.ajax({
                        url: "{{route('user_side.view.jobs.ajax')}}",
                        type: 'post',
                        data: {
                            current: options.current,
                            length: options.length,
                            "_token": "{{ csrf_token() }}",
                            "title": title,
                            "location": location,
                            "job_status": $('#selected-options-status').val()
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
                        let json = JSON.parse(res);
                        let myJSON = json[1];
                        let totalRe = json[0];
                        let html = '';
                        let index = 0;
                        for (let i = 0; i < myJSON.length; i++) {
                            index++;
                            if (i === 0) {
                                jobDetails(myJSON[i]['id'])
                                html += '<tr><td colspan="3" style="background: #fff;cursor: default;padding: 1px;"></td>' + '</tr>' +
                                    '<tr class="add-note color-active add-note-' + myJSON[i]['id'] + '" ' +
                                    'data-id="' + myJSON[i]['id'] + '" id="job-' + myJSON[i]['id'] + '" ' +
                                    'onclick=jobDetails(' + myJSON[i]['id'] + ')>' +
                                    '<td><strong>' + index + '</strong></td>' +
                                    '<td>' +
                                    '<a class="add-click arrow " href="javascript:void(0)"  ' +
                                    'data-id="' + myJSON[i]['id'] + ' id="job-info-ajax">' +
                                    '<h4 class="bold-green">' + checkValue(myJSON[i]['job_title']) + '</h4>' +
                                    '</a><small><b>' + checkValue(myJSON[i]['location']) + '</b>' +
                                    '</td>' +
                                    '<td>' +
                                    '<p class="add-cursor">' + '<span class="status">' +
                                    '<small>' + checkJobStatus(myJSON[i]['applied_before']) + '</small></span></p></td></td></tr>';
                            } else {
                                html += '<tr><td colspan="3" style="background: #fff;cursor: default;padding: 1px;"></td></tr>' +
                                    '<tr class="add-note add-note-' + myJSON[i]['id'] + '" ' +
                                    'data-id="' + myJSON[i]['id'] + '" id="job-' + myJSON[i]['id'] + '" ' +
                                    'onclick=jobDetails(' + myJSON[i]['id'] + ')> ' +
                                    '<td><strong>' + index + '</strong></td>' +
                                    '<td><a class="add-click arrow" href="javascript:void(0)"  ' +
                                    'data-id="' + myJSON[i]['id'] + ' id="job-info-ajax">' +
                                    '<h4 class="bold-green">' + checkValue(myJSON[i]['job_title']) + '</h4>' +
                                    '</a><small><b>' + checkValue(myJSON[i]['location']) + '</b>' +
                                    '</small>' +
                                    '</td>' +
                                    '<td>' +
                                    '<p class="add-cursor">' + '<span class="status">' +
                                    '<small>' + checkJobStatus(myJSON[i]['applied_before']) + '</small></span></p></td></td></tr>';
                            }
                        }
                        if (html === "") {
                            document.getElementById('htmlShow').innerHTML = '<tr><td colspan="3" style="background: #fff;cursor: default;padding: 1px;">No Jobs Found</td></tr>';
                            document.getElementById('showJobDetails').innerHTML = `<tr><td colspan="3" style="background: #fff;cursor: default;padding: 1px;">No Job's Detail Found</td></tr>`;
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

        $(document).on('click', '.job-del', function (e) {
            e.preventDefault();
            let id = $(this).attr('dataid');
            swal({
                title: "Are you sure",
                text: "Once deleted, you will not be able to recover this Job!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "{{route('user_side.delete.job')}}",
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
                        console.log(res);
                        swal("Your job is successfully deleted!");
                        $('#job-' + id).prev().remove();
                        $('#job-' + id).remove();
                        $('#htmlShow tr:eq(1)').addClass('color-active');
                        jobDetails($('#htmlShow tr:eq(1)').attr('data-id'));
                    });
                } else {
                    swal("your job is safe!");
                }

            });
        });
    </script>

@endsection



