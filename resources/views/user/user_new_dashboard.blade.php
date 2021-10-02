@extends('layouts.user1_layout')

@section('content')
    <div class="app-main__inner">
        <div class="tabs-animation">
            <div class="row">
                <div class="col-md-12 dash-boxes">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="dash-box">
                                        <a href="{{route('view.applied.jobs')}}">
                                            <i class="pe-7s-albums"></i>
                                            <section>
                                                <h2>{{$applied_jobs}}</h2>
                                                <span>Applied Jobs</span>
                                            </section>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="dash-box">
                                        <a href="{{route('saved.jobs')}}">
                                            <i class="pe-7s-portfolio"></i>
                                            <section>
                                                <h2>{{$favourite_job}}</h2>
                                                <span>Saved Jobs</span>
                                            </section>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="dash-box">
                                        <a href="javascript:void(0)">
                                            <i class="pe-7s-note2"></i>
                                            <section>
                                                <h2>0</h2>
                                                <span>Job Interview</span>
                                            </section>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="dash-box">
                                        <a href="javascript:void(0)">
                                            <i class="pe-7s-comment"></i>
                                            <section>
                                                <h2>0</h2>
                                                <span>Message</span>
                                            </section>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="job-search-wrapper">
                                <form method="post" action="{{route('main.search.job')}}">
                                    @csrf
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
                                                    <input type="submit" value="Search Job">
                                                </label>
                                            </li>
                                        </ul>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card mb-3">
                        <div class="card-header-tab card-header">
                            <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><i
                                    class="pe-7s-portfolio mr-3 text-muted opacity-6" style="font-size: 35px;"> </i>Relevant
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
            // debugger
            Fun(10);
        });

        function Fun(length) {
            // body...
            console.log('fn call')
            var job_title = $('#search_job_title').val();
            var place = $('#search_place').val();


            $('#example-2').pagination({
                total: 1,
                current: 1,
                length: 10,
                size: 1,

                ajax: function (options, refresh, $target) {
                    console.log('ajax function')
                    var html = '';

                    $.ajax({

                        url: "{{route('view.relevant.jobs')}}",
                        type: 'post',

                        data: {
                            current: options.current,
                            length: options.length,
                            "_token": "{{ csrf_token() }}",
                            /*job_title : job_title,
                            place     : place,*/
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
                        var totalRe = json[0];
                        console.log(myJSON)
                        for (var i = 0; i < myJSON.length; i++) {

                            time_ago = moment(myJSON[i]['created_at']).fromNow();
                            var fig;
                            if (myJSON[i]['client']) {
                                if (myJSON[i]['client']['logo']) {
                                    fig = '<figure><a href="/job/details/' + myJSON[i]['id'] + '"><img src="' + window.location.origin + '/user/company_logo/' + myJSON[i]['client']['logo'] + '" alt=""></a></figure>'
                                } else {
                                    fig = '<figure><a href="/job/details/' + myJSON[i]['id'] + '"><img src="' + window.location.origin + '/user/images/featured-img1.jpg" alt=""></a></figure>'
                                }
                            }
                            if (myJSON[i]['admin']) {
                                fig = '<figure><a href="/job/details/' + myJSON[i]['id'] + '"><img src="' + window.location.origin + '/' + myJSON[i]['mymotivz_logo'] + '" alt=""></a></figure>'
                            }
                            html += '<li class="col-md-12">' +
                                '<div class="motivz-joblisting-classic-wrap">' +
                                fig +
                                '<div class="motivz-joblisting-text">' +
                                '<div class="motivz-list-option">' +
                                '<h2><a href="/job/details/' + myJSON[i]['id'] + '">' + myJSON[i]['job_title'] + '</a></h2>' +
                                '<ul>';
                            if (myJSON[i]['client']) {
                                html += '<li><a href="/job/details/' + myJSON[i]['id'] + '">@ ' + myJSON[i]['client']['company_name'] + '</a></li>';
                            }
                            if (myJSON[i]['admin']) {
                                html += '<li><a href="/job/details/' + myJSON[i]['id'] + '">@ ' + myJSON[i]['mymotivz_title'] + '</a></li>';
                            }
                            html += '<li><i class="fa fa-globe"></i> ' + myJSON[i]['location'] + '</li>' +
                                '<li><i class="fa fa-filter"></i> ' + myJSON[i]['industry']['name'] + '</li>' +
                                '<li><i class="fa fa-briefcase"></i> ' + myJSON[i]['service'] + '</li>' +
                                '</ul>' +
                                '</div>' +
                                '<div class="motivz-job-userlist">' +
                                '<a href="/job/details/' + myJSON[i]['id'] + '" class="btn motivz-option-btn">View Details</a>' +
                                '</div>' +
                                '<div class="clearfix"></div>' +
                                '</div>' +
                                '</div>' +
                                '</li>';

                        }
                        ;

                        if (html == "") {
                            document.getElementById('searched-jobslist').innerHTML = '<div class="alert alert-secondary" style="width: 100%; text-align: center;" role="alert">' + 'No relevant job found.' + '</div>';

                        } else {
                            document.getElementById('searched-jobslist').innerHTML = html;
                        }

                        refresh({
                            total: totalRe,
                            length: length
                        });
                    }).fail(function (error) {
                        console.log('fail')
                    });
                }
            });
        }


        // function initialize() {
        //     var input = document.getElementById('search_place');
        //
        //     var options = {
        //         types: ['(regions)'] //this should work !
        //     };
        //
        //     var autocomplete = new google.maps.places.Autocomplete(input, options);
        //     // autocomplete.setComponentRestrictions(
        //     //     {'country': ['us']});
        // }
        //
        // google.maps.event.addDomListener(window, 'load', initialize);

    </script>
@endsection
