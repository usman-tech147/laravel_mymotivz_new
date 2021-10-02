@extends('admin.layouts.layouts')
@section('title', 'Edit Candidate')
@section('content')
    @if(session()->has('candidateSuccessEdit'))
        <div class="alert alert-success custom-toster">
            {{ session()->get('candidateSuccessEdit') }}
        </div>
    @endif

    <div class="app-main__inner">
        <div class="card-header-tab card-header">
            <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><i
                        class="pe-7s-settings mr-3 text-muted opacity-6"
                        style="font-size: 35px; color: white !important;"> </i>Edit Candidate Detail
            </div>
        </div>
        <div class="tabs-animation">
            <div class="row">
                <div class="col-md-12">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <form id="editCandidateValidation" enctype="multipart/form-data" method="post"
                                  action="{{route('candidate.edited')}}">
                                @csrf
                                <input name="id" type="hidden" value="{{$candidate[0]['id']}}">
                                {{--                                <input name="previous_url" type="hidden" value=" ">--}}
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Full name</label>
                                            <input name="name" value="{{$candidate[0]['name']}}" type="text"
                                                   class="form-control" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Job Title</label>
                                            <input name="job_title" value="{{$candidate[0]['job_title']}}" type="text"
                                                   class="form-control" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Phone number</label>
                                            <input name="phone" value="{{$candidate[0]['phone']}}" type="text"
                                                   class="form-control" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input name="email" value="{{$candidate[0]['email']}}" type="text"
                                                   class="form-control" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>City</label>
                                            <input name="city" value="{{$candidate[0]['city']}}" type="text"
                                                   class="form-control" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>State</label>
                                            <input name="state" value="{{$candidate[0]['state']}}" type="text"
                                                   class="form-control" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="optional">Employer</label>
                                            <input name="employer" value="{{$candidate[0]['employer']}}" type="text"
                                                   class="form-control" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Salary Requirements</label>
                                            <input name="salary" value="{{$candidate[0]['salary']}}" type="text"
                                                   class="form-control" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Skills
                                                <small>(Please add a comma separated list.)</small>
                                            </label>
                                            <input name="skills" value="{{$candidate[0]['skills']}}" type="text"
                                                   class="tags_1 tags form-control" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Interest
                                                <small>(Please add a comma separated list.)</small>
                                            </label>
                                            <input name="interest" value="{{$candidate[0]['interest']}}" type="text"
                                                   class="tags_1 tags form-control" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Experience</label>
                                            <select name="experience" id="" class="form-control">
                                                <option value="1"
                                                        @if($candidate[0]['experience'] === 1) selected @endif>1 Year
                                                </option>
                                                <option value="2"
                                                        @if($candidate[0]['experience'] === 2) selected @endif>2 Year
                                                </option>
                                                <option value="3"
                                                        @if($candidate[0]['experience'] === 3) selected @endif>3 Year
                                                </option>
                                                <option value="4"
                                                        @if($candidate[0]['experience'] === 4) selected @endif>4 Year
                                                </option>
                                                <option value="5"
                                                        @if($candidate[0]['experience'] === 5) selected @endif>5 Year
                                                </option>
                                                <option value="6"
                                                        @if($candidate[0]['experience'] === 6) selected @endif>6 Year
                                                </option>
                                                <option value="7"
                                                        @if($candidate[0]['experience'] === 7) selected @endif>7 Year
                                                </option>
                                                <option value="8"
                                                        @if($candidate[0]['experience'] === 8) selected @endif>8 Year
                                                </option>
                                                <option value="9"
                                                        @if($candidate[0]['experience'] === 9) selected @endif>9 Year
                                                </option>
                                                <option value="10"
                                                        @if($candidate[0]['experience'] === 10) selected @endif>10 Year
                                                </option>
                                                <option value="11"
                                                        @if($candidate[0]['experience'] === 11) selected @endif>More
                                                    than 10
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Education</label>
                                            <select class="form-control" name="education">
                                                @foreach($education as $edu)
                                                    <option @if($candidate[0]['education_id'] == $edu['id']) selected
                                                            @endif value="{{$edu['id']}}">{{$edu['name']}}</option>
                                                @endforeach
                                            </select>
                                            {{--                                            <input name="education" value="{{$candidate[0]['education']}}" type="text" class="tags_1 tags form-control" placeholder="">--}}
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Status</label>


                                            <select name="status_id" id="" class="form-control">
                                                @foreach($statuses as $status)
                                                    <option @if($status['id'] == $candidate[0]['admin_status_id']) selected
                                                            @endif value="{{$status['id']}}">{{$status['name']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Industry
                                                <small>(Please add a comma separated list.)</small>
                                            </label>
                                            <input name="Industry" value="{{$candidate[0]['Industry']}}" type="text"
                                                   class="tags_1 tags form-control" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="optional">Upload Resume</label>
                                            <div enctype="multipart/form-data">
                                                <input name="resume[]" id="file-upload-demo" class="file-upload-demo-1"
                                                       type="file" multiple>
                                            </div>
                                        </div>
                                        <p style="color:red" id="error-image"></p>
                                    </div>
                                    {{--                                    resumes--}}
                                    <div class="col-md-12">
                                        <div class="pdf-remove-img">
                                            <ul>
                                                @if(!empty($candidate[0]['adminResumes']))
                                                    @foreach($candidate[0]['adminResumes'] as $resume)
                                                        @if(pathinfo($resume['resume'], PATHINFO_EXTENSION)=== 'pdf')
                                                            <li id="resume-{{$resume['id']}}">
                                                                <figure>
                                                                    <a @can('download', \App\Models\Admin\AdminResume::class)target="_blank"
                                                                       href="{{url('files/admin/'.$resume['resume'])}}"
                                                                       @endcan
                                                                       @cannot('download', \App\Models\Admin\AdminResume::class)
                                                                       href="javascript:void(0)"@endcannot>
                                                                        <i class="fa fa-file-pdf-o"></i>
                                                                    </a>
                                                                    @can('delete', \App\Models\Admin\AdminResume::class)
                                                                        <span dataId="{{$resume['id']}}"
                                                                              class="fa fa-trash cv-del"></span>
                                                                    @endcan
                                                                </figure>
                                                            </li>
                                                        @else
                                                            <li id="resume-{{$resume['id']}}">
                                                                <figure>
                                                                    <a @can('download', \App\Models\Admin\AdminResume::class)target="_blank"
                                                                       href="{{url('files/admin/'.$resume['resume'])}}"
                                                                       @endcan
                                                                       @cannot('download', \App\Models\Admin\AdminResume::class)
                                                                       href="javascript:void(0)" @endcannot >
                                                                        <i class="fa fa-file-word-o"></i>
                                                                    </a>
                                                                    @can('delete', \App\Models\Admin\AdminResume::class)
                                                                        <span dataId="{{$resume['id']}}"
                                                                              class="fa fa-trash cv-del"></span>
                                                                    @endcan
                                                                </figure>
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                    {{--                                    end resumes--}}
                                </div>
                                <button type="submit" class="btn btn-primary pull-right cus-val-candi">Save</button>
                                <a href="{{session('previous_url')}}" class="btn btn-primary pull-left cus-val-candi">Return</a>
                                <div class="clearfix"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        $(".cv-del").click(function () {
            swal({
                title: "Are you sure",
                text: "Once deleted, you will not be able to recover this resume!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                    if (willDelete) {
                        var resume = $(this);
                        id = resume.attr('dataId');
                        $.ajax({
                            url: "{{route('resume.del')}}",
                            type: 'post',
                            data: {
                                "_token": "{{ csrf_token() }}",
                                "resId": id,
                            },

                            // dataType: 'json'
                        }).done(function (response) {
                            console.log(response);
                            $('#resume-' + id).remove();
                        });
                    } else {
                        swal("Your resume is safe!");
                    }

                });

        });
    </script>

@endsection
