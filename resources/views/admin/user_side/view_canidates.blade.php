@extends('admin.layouts.layouts')
@section('title', 'Applied Candidates')
@section('content')
    <div class="app-main__inner">
        <div class="card-header-tab card-header">
            <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><i
                        class="pe-7s-search mr-3 text-muted opacity-6"
                        style="font-size: 35px; color: #4d9a10 !important;"> </i>Search
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
                                            <input class="form-control" id="candidateName" name="candidate_name"
                                                   type="text" style="width: 100%;" placeholder="Candidate's Name">
                                        </div>
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
                                                style="font-size: 35px;"> </i>Candidate's List
                                    </div>
                                </div>
                                <div class="card-body candidate-scroll">
                                    <div class="table-responsive">
                                        <span>Total Results: <strong id="no_result"></strong></span>
                                        <table style="width: 100%;"
                                               class="table table-hover table-striped table-bordered table-cursor candidate-list">
                                            <thead>
                                            <tr>
                                                <th style="width: 50px;">No</th>
                                                <th>Candidate's Name</th>
                                                <th style="width: 150px;"> Status</th>
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
                                                style="font-size: 35px;"> </i>Candidate Details
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="showCandidateDetails"
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

        function candidateDetails(id, job_id) {
            $('.add-note').removeClass('color-active');
            $('.add-note-' + id).addClass('color-active');
            let html = '';
            let html1 = '';
            $.ajax({
                url: "{{route('user_side.view.candidate_detail')}}",
                type: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "candidateId": id,
                    "jobId": job_id
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
                let myJSON = json[0][0];
                html = '  <tr id="candidateDetail-' + myJSON['id'] + '">' +
                    '<th>Posted At:</th><td>' + dateFormat(myJSON['created_at']) + ' </td></tr>' +
                    '<tr><th>Full Name:</th><td>' + checkValue(myJSON['name']) + '</td></tr>' +
                    '<tr><th>Linkedin Url:</th><td>' + checkValue(myJSON['linkedin_url']) + '</td></tr>' +
                    '<tr><th>Authorizaton Status:</th><td>' + checkValue(myJSON['auth_status']) + '</td></tr>' +
                    '<tr><th>Salary Requirements:</th><td>' +
                    packageFormat(myJSON['salary'], myJSON['salary_to'], myJSON['salary_sign'], myJSON['salary_type']) +
                    '</td></tr>' +
                    '<tr><th>Phone Number:</th><td>' + checkValue(myJSON['phone']) + '</td></tr>' +
                    '<tr><th>Email:</th><td>' + checkValue(myJSON['email']) + '</td></tr>' +
                    '<tr><th>Location:</th><td>' + checkValue(myJSON['location']) + '</td></tr>' +
                    '<tr><th>Experience:</th><td>' + checkValue(myJSON['experience']) + '</td></tr>' +
                    '<tr><th>Education:</th><td>' + checkNestedValue(myJSON['education']) + '</td></tr>' +
                    '<tr><th>Job Titles:</th><td>' + splitValue(myJSON['job_title']) + '</td></tr>' +
                    '<tr><th>Certifications:</th><td>' + splitValue(myJSON['certifications']) + '</td></tr>' +
                    '<tr><th>Interest:</th><td>' + splitValue(myJSON['interest']) + '</td></tr>' +
                    '<tr><th>Required Skills:</th><td>' + splitValue(myJSON['skills']) + '</td></tr>' +
                    '<tr><th>Industry:</th><td>' + checkNestedValue(myJSON['industry']) + '</td></tr>';
                if(json[2]){
                    html1 = '<a class="tag" href="/files/' + json[2]['resume'] + '" data-toggle="tooltip" title="" class="fa fa-file-pdf-o" data-original-title="pdf FILE">Download Resume</a>';
                }
                else{
                    html += '<tr><th>Resume:</th><td>' + 'N/A' + '</td></tr>';
                }
                // html1 = '<a class="tag" href="/files/' + json[2]['resume'] + '" data-toggle="tooltip" title="" class="fa fa-file-pdf-o" data-original-title="pdf FILE">Download Resume</a>';
                document.getElementById('showCandidateDetails').innerHTML = html;
                document.getElementById('button-for-div').innerHTML = html1;
            });
        }

        function Fun(length) {
            var name = $('#candidateName').val();
            $('#example-2').pagination({
                total: 1,
                current: 1,
                length: length,
                size: 1,
                ajax: function (options, refresh, $target) {
                    var html = '';
                    $.ajax({
                        url: "{{route('user_side.view.candidates.ajax')}}",
                        type: 'post',
                        data: {
                            current: options.current,
                            length: options.length,
                            "_token": "{{ csrf_token() }}",
                            "id": {{$id}},
                            "name": name,
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
                        let index = 0;
                        for (let i = 0; i < myJSON.length; i++) {
                            index++;
                            if (i === 0) {
                                candidateDetails(myJSON[i]['candidate_id'], myJSON[i]['job_id'])
                                html += '<tr><td colspan="3" style="background: #fff;cursor: default;padding: 1px;"></td>' + '</tr>' +
                                    '<tr class="add-note ' +
                                    'color-active add-note-' + myJSON[i]['id'] + '" data-id="' + myJSON[i]['candidate_id'] + '" ' +
                                    'id="job-' + myJSON[i]['candidate_id'] + '" ' +
                                    'onclick=candidateDetails(' + myJSON[i]['candidate_id'] + ',' + myJSON[i]['job_id'] + ')>' +
                                    '<td><strong>' + index + '</strong></td>' +
                                    '<td>' +
                                    '<a class="add-click arrow " href="javascript:void(0)"  ' +
                                    'data-id="' + myJSON[i]['candidate_id'] + ' id="job-info-ajax">' +
                                    '<h4 class="bold-green">' + checkNestedValue(myJSON[i]['candidate']) + '</h4></a>' +
                                    '</td>' +
                                    '<td>' +
                                    '<p class="add-cursor">' +
                                    '<span class="status">' +
                                    '<small>' + checkCandidate(myJSON[i]['candidate']) + '</small>' +
                                    '</span>' +
                                    '</p></td>' +
                                    '</td></tr>';
                            } else {
                                html += '<tr><td colspan="3" style="background: #fff;cursor: default;padding: 1px;"></td></tr>' +
                                    '<tr class="add-note add-note-' + myJSON[i]['id'] + '" ' +
                                    'data-id="' + myJSON[i]['candidate_id'] + '" ' +
                                    'id="job-' + myJSON[i]['candidate_id'] + '" ' +
                                    'onclick=candidateDetails(' + myJSON[i]['candidate_id'] + ',' + myJSON[i]['job_id'] + ')> ' +
                                    '<td><strong>' + index + '</strong></td>' +
                                    '<td><a class="add-click arrow" href="javascript:void(0)"  ' +
                                    'data-id="' + myJSON[i]['candidate_id'] + ' id="job-info-ajax">' +
                                    '<h4 class="bold-green">' + checkNestedValue(myJSON[i]['candidate']) + '</h4>' +
                                    '</a>' +
                                    '</td>' +
                                    '<td>' +
                                    '<p class="add-cursor">' +
                                    '<span class="status">' +
                                    '<small>' + checkCandidate(myJSON[i]['candidate']) + '</small>' +
                                    '</span>' +
                                    '</p></td>' +
                                    '</td></tr>';
                            }
                        }
                        if (html === "") {
                            document.getElementById('htmlShow').innerHTML = '<tr><td colspan="3" ' +
                                'style="background: #fff;cursor: default;padding: 1px;">No Candidate Found</td></tr>';
                            document.getElementById('showCandidateDetails').innerHTML =
                                `<tr><td colspan="3" style="background: #fff;cursor: default;padding: 1px;">
No Candidate's Detail Found</td></tr>`;
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



