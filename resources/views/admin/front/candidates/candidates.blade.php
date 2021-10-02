@extends('admin.layouts.layouts')
<!-- Modal -->

@section('title', 'New Clients Database')
<!-- Modal -->
@section('content')

    <div class="app-main__inner">
        <div class="card-header-tab card-header">
            <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><i
                    class="pe-7s-users mr-3 text-muted opacity-6" style="font-size: 35px; "> </i>Front Candidates
                Database
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
                                        <input type="text" class="form-control" name="candidate" id="candidate"
                                               placeholder="Candidate Name">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="title" id="title"
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
                                        SEARCH
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
                            <div class="col-md-5">
                                <div class="card-header-tab card-header">
                                    <div
                                        class="card-header-title font-size-lg text-capitalize font-weight-normal">
                                        <i class="pe-7s-users mr-3 text-muted opacity-6"
                                           style="font-size: 35px;"> </i>Candidates
                                    </div>
                                </div>
                                <div class="card-body candidate-scroll">
                                    <div class="table-responsive">
                                        <span>Total Results: <strong id="no_result"></strong></span>

                                        <table style="width: 100%;"
                                               class="table table-hover table-striped table-bordered table-cursor candidate-list">
                                            <thead>
                                            <tr>
                                                <th>Candidate's name</th>
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
                                    <div
                                        class="card-header-title font-size-lg text-capitalize font-weight-normal">
                                        <i class="pe-7s-notebook mr-3 text-muted opacity-6"
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

        function candidateDetails(id) {
            $('.add-note').removeClass('color-active');
            $('.add-note-' + id).addClass('color-active');
            let html = '';
            let html1 = '';
            $.ajax({
                url: "{{route('front.candidate.details.ajax')}}",
                type: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "candidateId": id,
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
                    '<th>Date Logged:</th><td>' + dateFormat(myJSON['created_at']) + ' </td></tr>' +
                    '<tr><th>Full Name:</th><td>' + checkValue(myJSON['name']) + '</td></tr>' +
                    '<tr><th>Salary Requirements:</th><td>' +
                    packageFormat(myJSON['salary'], myJSON['salary_to'], myJSON['salary_sign'], myJSON['salary_type']) + '' +
                    '</td></tr>' +
                    '<tr><th>Phone Numbers:</th><td>' + checkValue(myJSON['phone']) + '</td></tr>' +
                    '<tr><th>Interest:</th><td>' + splitValue(myJSON['interest']) + '</td></tr>' +
                    '<tr><th>Email:</th><td>' + checkValue(myJSON['email']) + '</td></tr>' +
                    '<tr><th>Locations:</th><td>' + checkValue(myJSON['location']) + '</td></tr>' +
                    '<tr><th>Education:</th><td>' + checkNestedValue(myJSON['education']) + '</td></tr>' +
                    '<tr><th>Skills:</th><td>' + splitValue(myJSON['skills']) + '</td></tr>' +
                    '<tr><th>Industry:</th><td>' + checkNestedValue(myJSON['industry']) + '</td></tr>';
                html1 = '<a href="{{url('admin/front-site/candidate-detail')}}/' + json['id'] + ' " class="btn tag"> ' +
                    'Candidate Details ' +
                    '</a>';
                document.getElementById('showCandidateDetails').innerHTML = html;
                document.getElementById('button-for-div').innerHTML = html1;
            });
        }

        function Fun(length) {
            let name = $('#candidate').val();
            let title = $('#title').val();
            let location = $('#location').val();
            let industry = $('#selected-options-industry').val();

            $('#example-2').pagination({
                total: 1,
                current: 1,
                length: length,
                size: 1,
                ajax: function (options, refresh, $target) {
                    $.ajax({
                        url: "{{route('front.candidates.ajax.all')}}",
                        type: 'post',
                        data: {
                            current: options.current,
                            length: options.length,
                            "_token": "{{ csrf_token() }}",
                            "name": name,
                            "title": title,
                            "location": location,
                            "industry": industry,
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
                        let html = '';
                        for (let i = 0; i < myJSON.length; i++) {
                            let name = 'N/A';
                            let location = 'N/A';
                            let status = 'N/A';
                            let industry = 'N/A';
                            if (myJSON[i]['name']) {
                                name = myJSON[i]['name'];
                            }
                            if (myJSON[i]['location']) {
                                location = myJSON[i]['location'];
                            }
                            if (myJSON[i]['status']) {
                                status = myJSON[i]['status']['name'];
                            }
                            if (myJSON[i]['industry']) {
                                industry = myJSON[i]['industry']['name'];
                            }
                            if (i === 0) {
                                candidateDetails(myJSON[i]['id']);
                                html += '<tr><td colspan="3" style="background: #fff;cursor: default;padding: 1px;"></td>' + '</tr>' +
                                    '<tr class="add-note color-active add-note-' + myJSON[i]['id'] + '" ' +
                                    'data-id="' + myJSON[i]['id'] + '" id="client-' + myJSON[i]['id'] + '" ' +
                                    'onclick=candidateDetails(' + myJSON[i]['id'] + ')>' +
                                    '<td><a class="add-click arrow " href="javascript:void(0)"  ' +
                                    'data-id="' + myJSON[i]['id'] + ' id="client-info-ajax">' +
                                    '<h4 class="bold-green">' + checkValue(myJSON[i]['name']) + '</h4></a><small><b>' +
                                    checkValue(myJSON[i]['location']) + '</b>' +
                                    '<p>' + checkValue(myJSON[i]['job_title']) + '</p>' +
                                    '</small>' +
                                    '</td>' +
                                    '<td>' +
                                    '<p class="add-cursor">' +
                                    '<span class="status">' +
                                    '<small>' + checkCandidate(myJSON[i]) + '</small>' +
                                    '</span>' +
                                    '</p></td>' +
                                    '</td></tr>';
                            } else {
                                html += '<tr><td colspan="3" style="background: #fff;cursor: default;padding: 1px;"></td></tr>' +
                                    '<tr class="add-note add-note-' + myJSON[i]['id'] + '" ' +
                                    'data-id="' + myJSON[i]['id'] + '" id="client-' + myJSON[i]['id'] + '" ' +
                                    'onclick=candidateDetails(' + myJSON[i]['id'] + ')> ' +
                                    '<td><a class="add-click arrow" href="javascript:void(0)"  ' +
                                    'data-id="' + myJSON[i]['id'] + ' id="client-info-ajax">' +
                                    '<h4 class="bold-green">' + checkValue(myJSON[i]['name']) + '</h4>' +
                                    '</a><small><b>' + checkValue(myJSON[i]['location']) + '</b>' +
                                    '<p>' + checkValue(myJSON[i]['job_title']) + '</p>' +
                                    '</small>' +
                                    '</td>' +
                                    '<td>' +
                                    '<p class="add-cursor">' +
                                    '<span class="status">' +
                                    '<small>' + checkCandidate(myJSON[i]) + '</small>' +
                                    '</span>' +
                                    '</p></td>' +
                                    '</td></tr>';
                            }
                        }
                        if (html === "") {
                            document.getElementById('htmlShow').innerHTML = '<tr><td colspan="3" style="background: #fff;cursor: default;padding: 1px;">No Clients Found</td></tr>';
                            document.getElementById('showCandidateDetails').innerHTML = `<tr><td colspan="3" style="background: #fff;cursor: default;padding: 1px;">No Client's Detail Found</td></tr>`;
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
