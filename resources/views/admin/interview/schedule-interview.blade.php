
@extends('admin.layouts.layouts')
@section('title', 'Schedule Interview')
@section('content')
                <div class="app-main__inner">
                    <div class="card-header-tab card-header">
                        <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><i class="pe-7s-file mr-3 text-muted opacity-6" style="font-size: 35px; color: white !important;"> </i>Schedule Interview</div>
                    </div>
                    <div class="tabs-animation">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="main-card mb-3 card">
                                    <div class="card-body">
                                        <form id="schedule_form" method="post" action="{{route('interviewmail')}}" >
                                            @csrf
                                            <input type="hidden" id="candidate_session_id" value="@if((session()->has('candidate_id'))) {{session('candidate_id')}} @else 0 @endif ">
                                            <input type="hidden" id="job_session_id" value="@if((session()->has('job_id'))) {{session('job_id')}} @else 0 @endif ">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Company Name</label>
                                                        <select onchange="jobchange()" name="client" id="" class="multiselect-dropdown form-control client-list-check">
                                                            <option value="" style="display: none;"></option>
                                                            @foreach($clients as $client)

                                                            <option value="{{$client->id}}"  @if((session()->has('client_id')))  @if(session('client_id')==$client->id) selected @endif @endif>{{$client->company_name}}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('client')
                                                        <div class="error">{{ $message }}</div>
                                                        @enderror

                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">

                                                        <label>Job Title</label>
                                                        <select class="multiselect-dropdown job_title form-control" onchange="showCandidates()" name="job_title"  id="job_title">
                                                            <option value="" style="display: none;"></option>
                                                        </select>
                                                        @error('job_title')
                                                        <div class="error">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">

                                                        <label>Candidate Name</label>
                                                        <select name="candidate" id="candidate_id" class="form-control multiselect-dropdown">
                                                            <option value="" style="display: none;"></option>
                                                        </select>
                                                        @error('candidate')
                                                        <div class="error">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Select Date</label>
                                                        <input type="text" name="s_date"  placeholder="--/--/----" class="form-control" data-toggle="datepicker" readonly="">
                                                        @error('s_date')
                                                        <div class="error">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-4 date-select width5">
                                                    <div class="form-group">
                                                        <label>Select Time</label>
                                                        <input type="time" name="s_time" class="form-control">
                                                        @error('s_time')
                                                        <div class="error">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <span>To</span>
                                                    <div class="form-group">
                                                        <label>Select Time</label>
                                                        <input type="time" name="e_time" class="form-control">
                                                        @error('e_time')
                                                        <div class="error">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Time zone</label>
                                                        <select name="time_zone" class="multiselect-dropdown form-control">
                                                            <option value="" style="display: none;"></option>
                                                            <option value="PST">PST</option>
                                                            <option value="CST">CST</option>
                                                            <option value="EST">EST</option>
                                                        </select>
                                                        @error('time_zone')
                                                        <div class="error">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Status</label>
                                                        <select name="status" id="status_interview" class="form-control multiselect-dropdown">
                                                            <option value="" style="display: none;"></option>
                                                            @foreach($status as $stat)
                                                                <option value="{{$stat->id}}" >{{$stat->name}}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('status')
                                                        <div class="error">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>


                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Location</label>
                                                        <input type="text" name="location" class="form-control" placeholder="">
                                                        @error('location')
                                                        <div class="error">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Subject</label>
                                                        <input type="text" name="subject" class="form-control" placeholder="">
                                                        @error('subject')
                                                        <div class="error">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="optional">Receiver's Email Address</label>
                                                        <input type="text" id="recievers_emails" name="emails[]" class="form-control tags_5" placeholder="">
                                                        {{--                                                        <div class="error">Enter atleast 1 email</div>--}}
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Message</label>
                                                        <textarea name="message" class="form-control" placeholder=""></textarea>
                                                        @error('message')
                                                        <div class="error">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-12"><button type="submit" class="btn btn-primary pull-left">Send</button>&nbsp</div>
                                            </div>
                                            <div class="clearfix"></div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if(session()->has('Email'))
                    <script>
                        $( document ).ready(function() {
                            swal({

                                title: "Email",
                                text: "Emails are successfully delivered",
                            })
                        });
                    </script>
                @endif
    <script>
        $( document ).ready(function() {
            jobchange()
        });
        // $(document).ready(function() {
        //     $(document).on('click', '.job_title', function () {
        //         var job_id = $(this).val();
        //         alert(job_id);
        //         // showCandidates(job_id);
        //     });
        // });
        function jobchange(){
            var client_id = $('.client-list-check option:selected').val() ;
            var jobOp = "" ;
            $.ajax({

                url: "{{route('pipeline.client.jobs')}}",
                type: 'post',

                data:{
                    data: { client_id:client_id},
                    "_token": "{{ csrf_token() }}",
                },

                // dataType: 'json'
            }).done(function(res){
                var json = JSON.parse(res) ;
                var chose = '';
                jobOp += ' <option value="" style="display: none;"></option>';
                for(let i=0 ; i<json.length ; i++)
                {
                    if($('#job_session_id').val()==json[i]['id'])
                    {
                        chose = 'selected';
                    }
                    else
                    {
                        chose = '';
                    }
                    jobOp += '<option value="'+json[i]['id']+'" '+chose+'>'+json[i]['jobtitle']+'</option>'
                }

                document.getElementById('job_title').innerHTML=jobOp;
                showCandidates();

            });
        }


        function showCandidates()
        {
            var id = $('.job_title option:selected').val() ;
            // alert(id);
            var jobOp = "" ;
            var chose = '';
            $.ajax({
                url: "{{route('client.dashboard.job.candidate')}}",
                type: 'post',

                data:{
                    "_token": "{{ csrf_token() }}",
                    "jobId":id,
                },

                // dataType: 'json'
            }).done(function(res){
                var json = JSON.parse(res) ;
                console.log(json);


                // jobOp += ' <option value="" style="display: none;"></option>';
                for(let i=0 ; i<json.length ; i++)
                {
                    if($('#candidate_session_id').val()==json[i]['id'])
                    {
                        chose = 'selected';
                    }
                    else
                    {
                        chose = '';
                    }
                    jobOp += '<option value="'+json[i]['candidate_id']+'" '+chose+'>'+json[i]['candidate_name']+'</option>'
                }

                document.getElementById('candidate_id').innerHTML=jobOp;


                // candidate_id

            });
        }
    </script>
@endsection
