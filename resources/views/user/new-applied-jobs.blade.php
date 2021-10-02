@extends('layouts.user1_layout')

@section('content')
    <div class="app-main__inner">
        <div class="tabs-animation">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="job-search-wrapper">


                                <div class="job-search">
                                    <ul>
                                        <li class="title">
                                            <input type="text" id="search_job_title" name="search_job_title"
                                                   placeholder="Job title or keyword" value="">
                                        </li>
                                        <li class="location"><i class="fa fa-map-marker"></i>
                                            <input type="text" id="search_place" name="search_place"
                                                   placeholder="City or area" value="">
                                        </li>
                                        <li>
                                            <label>
                                                <i class="fa fa-search"></i>
                                                <input type="submit" onclick="Fun(10)" value="Search Job">
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card mb-3">
                        <div class="card-header-tab card-header">
                            <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><i
                                    class="pe-7s-albums mr-3 text-muted opacity-6" style="font-size: 35px;"> </i>Applied
                                Jobs
                            </div>
                        </div>
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
    <link href="{{asset('css/bootstrap-tagsinput.css')}}" rel="stylesheet">
    <script src="{{asset('js/bootstrap-tagsinput.js')}}"></script>
    <script src="{{asset('assets/scripts/moment.min.js')}}"></script>
    <script src="{{asset('assets/scripts/notify.min.js')}}"></script>
    <script src="{{asset('user/script/blockUI.js')}}"></script>
    <script src="{{asset('js/pagination.js')}}"></script>

    <script>
        $(document).ready(function () {
            Fun(10);
        });

        function Fun(length) {
            // body...
            var job_title = $('#search_job_title').val();
            var place = $('#search_place').val();


            $('#example-2').pagination({
                total: 1,
                current: 1,
                length: 10,
                size: 1,

                ajax: function (options, refresh, $target) {

                    var html = '';

                    $.ajax({

                        url: "{{route('ajax.applied.jobs')}}",
                        type: 'post',

                        data: {
                            current: options.current,
                            length: options.length,
                            "_token": "{{ csrf_token() }}",
                            job_title: job_title,
                            place: place,
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
                        // alert(res);

                        var json = JSON.parse(res);

                        // var savedJobs = json[2]
                        var total = json[2]

                        var myJSON = json[1];
                        console.log(myJSON);
                        // alert(myJSON);
                        var totalRe = json[0];
                        // var fav_job = json[2];

                        for (var i = 0; i < myJSON.length; i++) {

                            time_ago = moment(myJSON[i]['job']['created_at']).fromNow();
                            html += '<li class="col-md-12">' +
                                '<div class="motivz-joblisting-classic-wrap">'
                            if (myJSON[i]['job']['client']) {
                                if (myJSON[i]['job']['client']['logo']) {
                                    html += '<figure><a href="/job/details/' + myJSON[i]['job_id'] + '"><img src="' + window.location.origin + '/user/company_logo/' + myJSON[i]['job']['client']['logo'] + '" alt=""></a></figure>'
                                } else {
                                    html += '<figure><a href="/job/details/' + myJSON[i]['job_id'] + '"><img src="' + window.location.origin + '/user/images/featured-img1.jpg" alt=""></a></figure>'
                                }
                            }
                            if (myJSON[i]['job']['admin']) {
                                html += '<figure><a href="/job/details/' + myJSON[i]['job_id'] + '"><img src="' + window.location.origin + '/' + myJSON[i]['job']['mymotivz_logo'] + '" alt=""></a></figure>'
                            }
                            html += '<div class="motivz-joblisting-text">' +
                                '<div class="motivz-list-option">' +
                                '<h2><a href="/job/details/' + myJSON[i]['job_id'] + '">' + myJSON[i]['job']['job_title'] + '</a></h2>' +
                                '<ul>';
                            if (myJSON[i]['job']['client']) {
                                html += '<li><a href="/job/details/' + myJSON[i]['job_id'] + '">@ ' + myJSON[i]['job']['client']['company_name'] + '</a></li>';
                            }
                            if (myJSON[i]['job']['admin']) {
                                html += '<li><a href="/job/details/' + myJSON[i]['job_id'] + '">@ ' + myJSON[i]['job']['mymotivz_title'] + '</a></li>';
                            }
                            html += '<li><i class="fa fa-globe"></i> ' + myJSON[i]['job']['location'] + '</li>' +
                                '<li><i class="fa fa-filter"></i> ' + myJSON[i]['job']['industry']['name'] + '</li>' +
                                '<li><i class="fa fa-briefcase"></i> ' + myJSON[i]['job']['service'] + '</li>' +
                                '</ul>' +
                                '</div>' +
                                '<div class="motivz-job-userlist">' +
                                '<a href="/job/details/' + myJSON[i]['job_id'] + '" class="btn motivz-option-btn">View Details</a>'

                            html += '</div>' +
                                '<div class="clearfix"></div>' +
                                '</div>' +
                                '</div>' +
                                '</li>';
                        }

                        if (html == "") {
                            document.getElementById('searched-jobslist').innerHTML = '<div class="alert alert-secondary" style="width: 100%; text-align: center;" role="alert">' + 'No applied job found.' + '</div>';

                        } else {
                            document.getElementById('searched-jobslist').innerHTML = html;
                        }

                        refresh({
                            total: total,
                            length: options.length
                        });
                    }).fail(function (error) {
                    });
                }
            });
        }

        function heartColor(arr, jobId) {
            // console.log("job id :"+jobId)

            var color = ''
            for (var i = 0; i < arr.length && color == ''; i++) {
                // console.log("array :"+arr[i]['job_id'])
                if (arr[i]['job_id'] == jobId) {
                    color = 'tomato'
                }
            }
            // console.log('color :'+color)
            return color
        }

        function save_fav_job(id) {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('Ajax.save.job') }}",
                type: "POST",
                async: false,
                data: {id: id, "_token": "{{ csrf_token() }}",},
                success: function (response) {

                    if (response == 'saved') {
                        $(".icon_" + id).css('color', 'tomato');
                        $.notify("Job Saved Successfully", {
                            clickToHide: true,
                            autoHide: true,
                            autoHideDelay: 2000,
                            arrowShow: true,
                            arrowSize: 5,
                            breakNewLines: true,
                            elementPosition: "bottom",
                            globalPosition: "top center",
                            style: "bootstrap",
                            className: "success",
                            show: "slideDown",
                            showDuration: 200,
                            hideAnimation: "slideUp",
                            hideDuration: 200,
                            gap: 5,
                        });

                    } else {
                        $(".icon_" + id).css('color', '');
                        $.notify("Removed from Saved Job Successfully", {
                            clickToHide: true,
                            autoHide: true,
                            autoHideDelay: 2000,
                            arrowShow: true,
                            arrowSize: 5,
                            breakNewLines: true,
                            elementPosition: "bottom",
                            globalPosition: "top center",
                            style: "bootstrap", // or metro
                            className: "success",
                            show: "slideDown",
                            showDuration: 200,
                            hideAnimation: "slideUp",
                            hideDuration: 200,
                            gap: 5,
                        });

                    }

                },
            });
        }
    </script>

@endsection
