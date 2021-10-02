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
                                    class="pe-7s-portfolio mr-3 text-muted opacity-6" style="font-size: 35px;"> </i>Saved
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
                            {{--                            <div class="featured-jobs-list">--}}
                            {{--                                <ul class="row" id="searched-jobslist"></ul>--}}
                            {{--                                <div class="pagination-wrap">--}}
                            {{--                                    <div class="box">--}}
                            {{--                                        <ul id="example-2" class="pagination"></ul>--}}
                            {{--                                        <div class="show"></div>--}}
                            {{--                                    </div>--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}
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

        // function initialize() {
        //     var input = document.getElementById('search_place');
        //     var options = {
        //         types: ['(regions)'] //this should work !
        //     };
        //
        //     var autocomplete = new google.maps.places.Autocomplete(input, options);
        //     autocomplete.setComponentRestrictions(
        //         {'country': ['us']});
        // }
        // google.maps.event.addDomListener(window, 'load', initialize);

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
                        url: "{{route('view.saved.jobs')}}",
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

                        var myJSON = json[1];
                        var totalRe = json[0];
                        for (var i = 0; i < myJSON.length; i++) {

                            time_ago = moment(myJSON[i]['created_at']).fromNow();

                            var desc = myJSON[i]['job']['job_description']
                            html += '<li class="col-md-12">' +
                                '<div class="motivz-joblisting-classic-wrap">'
                            if (myJSON[i]['job']['client']) {
                                if (myJSON[i]['job']['client']['logo']) {
                                    html += '<figure><a href="/job/details/' + myJSON[i]['job_id'] + '"><img src="' + window.location.origin + '/user/company_logo/' + myJSON[i]['job']['client']['logo'] + '" alt=""></a></figure>'
                                } else {
                                    html += '<figure><a href="/job/details/' + myJSON[i]['job_id'] + '"><img src="' + window.location.origin + '/user/images/avatar1.png" alt=""></a></figure>'
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
                                // '<li><i class="fa fa-filter"></i> ' + myJSON[i]['job']['industry']['name'] + '</li>' +
                                '<li><i class="fa fa-briefcase"></i> ' + myJSON[i]['job']['service'] + '</li>' +
                                '</ul>' +
                                '</div>' +
                                '<div class="motivz-job-userlist">' +
                                // '<a href="/job/details/' + myJSON[i]['job_id'] + '" class="btn motivz-option-btn">Apply</a>'
                                '<div><a href="javascript:void(0)" class="like"><i style="color:tomato" onclick=remove_fav_job(' + myJSON[i]['id'] + ') style="color:tomato" class="fa fa-heart icon_' + myJSON[i]['id'] + '"></i></a> <a href="/job/details/' + myJSON[i]['job_id'] + '" class="btn motivz-option-btn" >View Details</a></div>';

                            html += '</div>' +
                                '<div class="clearfix"></div>' +
                                '</div>' +
                                '</div>' +
                                '</li>';

                        }

                        if (html == "") {
                            document.getElementById('searched-jobslist').innerHTML = '<div class="alert alert-secondary" style="width: 100%; text-align: center;" role="alert">' + 'No saved job found.' + '</div>';

                        } else {
                            document.getElementById('searched-jobslist').innerHTML = html;
                        }

                        refresh({
                            total: json[2],
                            length: options.length
                        });
                    }).fail(function (error) {
                    });
                }
            });
        }

        function remove_fav_job(id) {
            /*var confirm_dialog = confirm("Are you sure to remove from Saved Job!");*/
            sweetAlert({
                title: "Are you sure?",
                text: "Are you sure to remove from saved job!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url: "{{ route('Ajax.remove.saved.job') }}",
                            type: "POST",
                            async: false,
                            data: {id: id, "_token": "{{ csrf_token() }}"},
                            success: function (response) {
                                if (response == 'deleted') {
                                    $(".li_" + id).hide();
                                    $.notify("Job Removed Successfully", {
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

                                    Fun(10);

                                }

                            },
                        });
                    }
                });
        }
    </script>
@endsection
