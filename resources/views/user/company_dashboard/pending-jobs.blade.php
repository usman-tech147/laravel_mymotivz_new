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
                    class="pe-7s-shield mr-3 text-muted opacity-6"
                    style="font-size: 35px; color: #4d9a10 !important;"> </i>Pending Jobs
            </div>
        </div>
        <div class="tabs-animation">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-3">
                        <div class="card-body">

                            @error('date')
                            <div style="text-align: center" class="alert alert-danger">
                                {{ $message }}
                            </div>
                            @enderror
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
    <div>
        <div class="modal fade" id="applyBeforeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Select Apply Before Date: </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" id="resubmit-form" action="/company/job/resubmit">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label for="date" class="col-form-label">Date:</label>
                                <input type="hidden" name="job_id" id="job-id" value="1">
                                <input type="date" class="form-control" name="date" id="date" placeholder="DD-MM-YYYY">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="modal-submit">Resubmit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>




@endsection

@section('js')
    <script src="{{asset('user/script/blockUI.js')}}"></script>
    <script src="{{asset('js/pagination.js')}}"></script>
    <script src="{{asset('assets/scripts/moment.min.js')}}"></script>
    <script src="{{asset('assets/scripts/notify.min.js')}}"></script>
    <script>
        $("#applyBeforeModal").appendTo("body");
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
                    let html = '';
                    $.ajax({
                        url: "{{route('user.client.view.job.pending')}}",
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
                    }).done(function (res) {
                        let json = JSON.parse(res);

                        let myJSON = json[1];
                        let total = json[2];
                        let totalRe = json[0];
                        for (let i = 0; i < myJSON.length; i++) {
                            let fig;
                            if (myJSON[i]['client']['logo']) {
                                fig = '<figure><a href="/job/details/' + myJSON[i]['id'] + '"><img src="' + window.location.origin + '/user/company_logo/' + myJSON[i]['client']['logo'] + '" alt=""></a></figure>'
                            } else {
                                fig = '<figure><a href="/job/details/' + myJSON[i]['id'] + '"><img src="' + window.location.origin + '/user/images/featured-img1.jpg" alt=""></a></figure>'
                            }

                            html += '<li class="col-md-12 li_' + myJSON[i]['id'] + '">' +
                                '<div class="motivz-joblisting-classic-wrap">' +
                                fig +
                                '<div class="motivz-joblisting-text">' +
                                '<div class="motivz-list-option">' +
                                '<h2><a href="' + window.location.origin + '/company/jobs/view-details/' + myJSON[i]['id'] + '">' + myJSON[i]['job_title'] + '</a> <span class="bg-warning" style="color: black">Pending</span></h2>' +
                                '<ul>' +
                                '<li><i class="fa fa-globe"></i> ' + myJSON[i]['location'] + '</li>' +
                                '<li><i class="fa fa-filter"></i> ' + myJSON[i]['industry']['name'] + '</li>' +
                                '<li><i class="fa fa-briefcase"></i> ' + myJSON[i]['service'] + '</li>' +
                                '</ul>' +
                                '</div>' +
                                '<div class="motivz-job-userlist">' +
                                '<a href="' + window.location.origin + '/company/jobs/view-details/' + myJSON[i]['id'] + '" class="btn motivz-option-btn">View Details</a>' +
                                '<a href="javascript:void(0)" class="btn motivz-option-btn job-del" onclick="job_del(' + myJSON[i]['id'] + ')">Delete</a>' +
                                '</div>' +
                                '<div class="clearfix"></div>' +
                                '</div>' +
                                '</div>' +
                                '</li>'
                        }

                        if (html == "") {
                            document.getElementById('searched-jobslist').innerHTML = '<div class="alert alert-secondary" style="width: 100%; text-align: center;" role="alert">' + 'No pending job found' + '</div>';

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

        function job_del(id) {
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
                            url: "/company/delete/job",
                            type: "POST",
                            async: false,
                            data: {id: id, "_token": "{{ csrf_token() }}",},
                            success: function (response) {
                                if (response == 'deleted') {
                                    $(".li_" + id).hide();
                                    $.notify("Job Deleted Successfully", {
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

        {{--$('#resubmit-form').validate({--}}
        {{--    rules: {--}}
        {{--        date: {--}}
        {{--            required: true,--}}
        {{--            greaterThanToday: "#date"--}}
        {{--        }--}}
        {{--    },--}}
        {{--    messages: {--}}
        {{--        date: {--}}
        {{--            required: "Date is required",--}}
        {{--        }--}}
        {{--    }--}}
        {{--});--}}
        {{--jQuery.validator.addMethod("greaterThanToday",--}}
        {{--    function (value, element, params) {--}}

        {{--        let date1 = new Date(value)--}}
        {{--        let date2 = new Date()--}}
        {{--        return date1.getTime() > date2.getTime();--}}
        {{--    }, 'Must be greater than today.');--}}
        {{--$('#modal-submit').on('click', function (event) {--}}
        {{--    event.preventDefault();--}}
        {{--    $('#resubmit-form').submit();--}}

        {{--});--}}
        {{--$('#applyBeforeModal').on('show.bs.modal', function (event) {--}}
        {{--    let button = $(event.relatedTarget);--}}
        {{--})--}}


        {{--function JobID(id) {--}}
        {{--    $("#job-id").val(id);--}}
        {{--}--}}

    </script>

@endsection
