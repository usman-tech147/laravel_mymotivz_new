@extends('layouts.company')

@section('content')
    <div class="app-main__inner">
        @if( session()->has('success') )
            <div style="text-align: center" class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
        <div class="card-header-tab card-header">
            <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><i
                    class="pe-7s-id mr-3 text-muted opacity-6" style="font-size: 35px; color: #4d9a10 !important;"> </i>Active
                Recruitments
            </div>
        </div>
        <div class="tabs-animation">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="motivz-job-list">

                                <ul class="row" id="active_recruitments"></ul>
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
    <script src="{{asset('user/script/blockUI.js')}}"></script>
    <script src="{{asset('js/pagination.js')}}"></script>
    <script src="{{asset('assets/scripts/notify.min.js')}}"></script>
    <script src="{{asset('js/moment.min.js')}}"></script>
    <script src="{{asset('js/moment_timezone.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            Paginate(10);
        });

        function Paginate(length) {
            $('#example-2').pagination({
                total: 1,
                current: 1,
                length: 10,
                size: 1,

                ajax: function (options, refresh) {

                    var html = '';

                    $.ajax({
                        url: "{{route('active.recruitment')}}",
                        type: 'post',
                        data: {
                            current: options.current,
                            length: options.length,
                            "_token": "{{ csrf_token() }}",
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
                        let totalRe = json[0];
                        let myJSON = json[1];
                        let countNew = json[2];
                        let total = json['total'];

                        for (var i = 0; i < myJSON.length; i++) {
                            var fig;
                            if (myJSON[i]['company_logo']['logo']) {
                                fig = '<figure><a href="recruitment-details/' + myJSON[i]['id'] + '"><img src="' + window.location.origin + '/user/company_logo/' + myJSON[i]['company_logo']['logo'] + '" alt=""></a></figure>'
                            } else {
                                fig = '<figure><a href="recruitment-details/' + myJSON[i]['id'] + '"><img src="' + window.location.origin + '/user/images/avatar1.png" alt=""></a></figure>'
                            }
                            html += '<li class="col-md-12 rec_' + myJSON[i]['id'] + '">' +
                                '<div class="motivz-joblisting-classic-wrap">' +
                                fig +
                                '<div class="motivz-joblisting-text">' +
                                '<div class="motivz-list-option">' +

                                '<h2><a href="recruitment-details/' + myJSON[i]['id'] + '">' + myJSON[i]['job_title'] + '</a> ';
                            html += '<ul>' +
                                '<li><i class="fa fa-globe"></i> ' + myJSON[i]['location'] + '</li>' +
                                '<li><i class="fa fa-filter"></i>' + myJSON[i]['industry']['name'] + '</li>' +
                                '<li><i class="fa fa-money"></i>' + myJSON[i]['salary_sign']+myJSON[i]['salary'];
                            if(myJSON[i]['salary_to']){
                                html +=  ' - '+ myJSON[i]['salary_sign']+myJSON[i]['salary_to'];
                            }
                            html += ' / '+ myJSON[i]['salary_type'] + '</li>';
                            html += '</ul>' +
                                '</div>' +
                                '<div class="motivz-job-userlist">' +
                                '<a href="javascript:void(0)" onclick="recruitment_del(' + myJSON[i]['id'] + ')" class="btn motivz-option-btn job-del">Delete</a>' +
                                '<a href="recruitment-details/' + myJSON[i]['id'] + '" class="btn motivz-option-btn">View Details</a>' +
                                '<a href="javascript:void(0)" class="motivz-job-like fav-job data-id="' + myJSON[i]['id'] + '" ></a>' +
                                '</div>' +
                                '<div class="clearfix"></div>' +
                                '</div>' +
                                '</div>' +
                                '</li>'
                        }

                        if (html == "") {
                            document.getElementById('active_recruitments').innerHTML = '<div class="alert alert-secondary" style="width: 100%; text-align: center;" role="alert">' + 'No active recruitment found' + '</div>';

                        } else {
                            document.getElementById('active_recruitments').innerHTML = html;
                        }

                        refresh({
                            length: options.length,
                            total: total,

                        });
                    }).fail(function (error) {
                    });
                }
            });
        }


        function recruitment_del(id) {
            sweetAlert({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover!",
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
                            url: "/company/recruitment/delete",
                            type: "POST",
                            async: false,
                            data: {id: id, "_token": "{{ csrf_token() }}",},
                            success: function (response) {
                                if (response == 'deleted') {
                                    $(".rec_" + id).hide();
                                    $.notify("Recruitment Deleted Successfully", {
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
                                }
                            },
                        });
                    }

                });
        }
    </script>
@endsection

