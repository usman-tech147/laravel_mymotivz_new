@extends('admin.layouts.layouts')
<!-- Modal -->

@section('title', 'Job Details')
<!-- Modal -->
@section('content')
    <div class="app-main__inner">
        <div class="card-header-tab card-header">
            <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><i
                    class="pe-7s-wallet mr-3 text-muted opacity-6" style="font-size: 35px;"> </i>{{$job->job_title}}'s
                Details
            </div>
        </div>
        <div class="tabs-animation">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="table-responsive">
                                        <table class="table-detail table table-hover table-striped table-bordered">
                                            <tbody>
                                            <tr>
                                                <th>Posted Date:</th>
                                                <td>{{dateFormat($job->created_at)}} </td>
                                            </tr>
                                            <tr>
                                                <th>Apply Before:</th>
                                                <td>{{dateFormat($job->applied_before)}} </td>
                                            </tr>
                                            <tr>
                                                <th>Job Title:</th>
                                                <td id="candidate_database_name_2164">{{$job->job_title}}</td>
                                            </tr>
                                            <tr>
                                                <th>Employer:</th>
                                                <td>
                                                    @if($job->client)
                                                        {{$job->client->company_name}}
                                                    @else
                                                        {{$job->mymotivz_title}}
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Compensation:</th>
                                                <td>
                                                    {{packageFormat($job->package, $job->package_to, $job->package_sign, $job->package_type)}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Experience:</th>
                                                <td>{{$job->required_experience}}</td>
                                            </tr>
                                            <tr>
                                                <th>Job Type:</th>
                                                <td>{{$job->service}}</td>
                                            </tr>
                                            <tr>
                                                <th>Education:</th>
                                                <td>{{$job->education->name}}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="table-responsive">
                                        <table class="table-detail table table-hover table-striped table-bordered">
                                            <tbody>

                                            <tr>
                                                <th>Industry:</th>
                                                <td>{{$job->industry->name}}</td>
                                            </tr>
                                            <tr>
                                                <th>Job Openings:</th>
                                                <td>{{$job->job_opening}}</td>
                                            </tr>
                                            <tr>
                                                <th>Job Benefits:</th>
                                                <td>
                                                    @if(count($job_benefits) > 0)
                                                        @foreach($job_benefits as $benefit)
                                                            <span class="borders">{{$benefit}}</span>
                                                        @endforeach
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Required Skills:</th>
                                                <td>
                                                    @if(count($required_skills) > 0)
                                                        @foreach($required_skills as $skill)
                                                            <span class="borders">{{$skill}}</span>
                                                        @endforeach
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Licensure/Certification:</th>
                                                <td>
                                                    @if(count($certifications) > 0)
                                                        @foreach($certifications as $certificate)
                                                            <span class="borders">{{$certificate}}</span>
                                                        @endforeach
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Status:</th>
                                                <td>
                                                    @if($job->job_approved == 0)
                                                        @if(now()->format('Y-m-d') < $job->applied_before)
                                                            <span> Pending </span>
                                                        @else
                                                            <span> Inactive </span>
                                                        @endif
                                                    @elseif($job->job_approved == 1)
                                                        <span> Approved </span>
                                                    @elseif($job->job_approved == 2)
                                                        <span> Rejected </span>
                                                    @endif
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table-detail table table-hover table-striped table-bordered">
                                            <tbody>
                                            <tr>
                                                <th style="vertical-align: text-top; width: 170px">Job Description:</th>
                                                @if(strlen(strip_tags($job->job_description)) > 1)
                                                    <td>{{strip_tags($job->job_description)}}</td>
                                                @else
                                                    <td>N/A</td>
                                                @endif

                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    @if(url()->previous() == url()->to('/').'/admin/front-site/pending/jobs')
                                        <a href="{{route('front.pending.jobs')}}" class="tag btn btn-link">Back to
                                            Pending jobs
                                            list</a>
                                        <button class="tag btn btn-link approve-job" data-loc="pending"
                                                data-id={{$job->id}}>
                                            Approve
                                        </button>
                                        <button class="tag btn btn-link reject-job" data-loc="pending"
                                                data-id={{$job->id}}> Reject
                                        </button>
                                    @elseif(url()->previous() == url()->to('/').'/admin/front-site/active/jobs')
                                        <a href="{{route('front.active.jobs')}}" class="tag btn btn-link">Back to Active
                                            jobs
                                            list</a>
                                    @elseif(url()->previous() == url()->to('/').'/admin/front-site/inactive/jobs')
                                        <a href="{{route('front.inactive.jobs')}}" class="tag btn btn-link">Back to
                                            Inactive jobs
                                            list</a>
                                    @elseif(url()->previous() == url()->to('/').'/admin/front-site/rejected/jobs')
                                        <a href="{{route('front.rejected.jobs')}}" class="tag btn btn-link">Back to
                                            Rejected jobs
                                            list</a>
                                        <button class="tag btn btn-link approve-job" data-loc="rejected"
                                                data-id={{$job->id}}> Approve
                                        </button>
                                    @endif
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                @if(url()->previous() != url()->to('/').'/admin/front-site/pending/jobs' && url()->previous() != url()->to('/').'/admin/front-site/rejected/jobs')
                    <div class="col-md-12">
                        <div class="card-header-tab card-header">
                            <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                                <i class="pe-7s-notebook mr-3 text-muted opacity-6" style="font-size: 35px;"> </i>
                                Applied Candidates
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped table-bordered removeborder">
                                        <tbody>
                                        <tr>
                                            <th>Name</th>
                                            <th>Location</th>
                                            <th>Phone Number</th>
                                            <th>Action</th>
                                        </tr>
                                        @if(count($applied_candidates) > 0)
                                            @foreach($applied_candidates as $candidate)
                                                <tr>
                                                    <td>{{$candidate['candidate']->name}}</td>
                                                    <td>{{$candidate['candidate']->location}}</td>
                                                    <td>{{$candidate['candidate']->phone}}</td>
                                                    <td>
                                                        <a href="{{route('get.front.candidate.details',[$candidate->candidate_id])}}"
                                                           class="tag">View Details</a></td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="4" style="text-align: center"><strong>No Candidates
                                                        Found</strong></td>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="box">
        <ul id="example-2" class="pagination"></ul>
        <div class="show"></div>
    </div>
    <script>
        $(document).on('click', '.approve-job', function (e) {
            e.preventDefault();
            let id = $(this).attr('data-id');
            let location = $(this).attr('data-loc');
            swal({
                title: "Are you sure you want to approve this job?",
                icon: "warning",
                buttons: {
                    cancel: true,
                    confirm: {text: 'Yes', className: 'sweet-success'},
                },
                dangerMode: true,
            }).then((approveJob) => {
                if (approveJob) {
                    $.ajax({
                        url: "{{route('job.approval.ajax')}}",
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
                        if (res == "approved") {
                            swal("Job is Approved!");
                            if (location === "pending") {
                                location.href = "{{route('front.pending.jobs')}}"
                            } else {
                                location.href = "{{route('front.rejected.jobs')}}"
                            }
                        } else {
                            swal(res);
                        }
                    });
                } else {
                    // swal("Your note is safe!");
                }

            });
        });

        $(document).on('click', '.reject-job', function (e) {
            e.preventDefault();
            let id = $(this).attr('data-id');
            swal({
                title: "Are you sure you want to reject this job?",
                icon: "warning",
                buttons: {
                    cancel: true,
                    confirm: {text: 'Yes', className: 'sweet-success'},
                },
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "{{route('job.rejected.ajax')}}",
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
                        if (res == "rejected") {
                            swal("Job is rejected!");
                            location.href = "{{route('front.pending.jobs')}}"
                        }
                    });
                } else {
                    // swal("your client is safe!");
                }

            });
        });
    </script>
@endsection
