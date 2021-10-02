@extends('admin.layouts.layouts')
@section('title', 'Scheduled Interview')
@section('content')


                <div class="app-main__inner">
                    <div class="tabs-animation">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card mb-3">
                                    <div class="card-header-tab card-header">
                                        <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><i class="pe-7s-file mr-3 text-muted opacity-6" style="font-size: 35px;"> </i>Scheduled Interviews</div>
                                    </div>
                                    <div class="card-body">
                                      <form action="">
                                        <ul class="search-form">
                                          <li>
                                              <label>Company Name</label>
                                              <select onchange="search_job()" name="client" id="company_id_interview" class="multiselect-dropdown form-control client-list-check">
                                                  <option value="" style="display: none;"></option>
                                                  @foreach($clients as $client)

                                                      <option value="{{$client->id}}" >{{$client->company_name}}</option>
                                                  @endforeach
                                              </select>
                                          </li>
                                          <li>
                                              <label>Job Title</label>
                                              <select class="multiselect-dropdown job_title form-control"  name="job_title"  id="job_interview">
                                                  <option value="" style="display: none;"></option>
                                              </select>
                                          </li>
                                            <li>
                                                <label>Candidate Name</label>
                                                <select class="multiselect-dropdown job_title form-control"  name="candidate_name_interview"  id="candidate_name_interview">
                                                    <option value="" style=""></option>
                                                    @foreach($candidates as $candidate)

                                                        <option value="{{$candidate->id}}" >{{$candidate->name}}</option>
                                                    @endforeach
                                                </select>
                                            </li>
                                            <li>
                                                <label>Type</label>
                                                <select class="multiselect-dropdown job_title form-control"  name=""  id="type_interview">
{{--                                                    <option value="" style="display: none;"></option>--}}

                                                    <option value="Process" >In Process</option>
                                                    <option value="Rejected" >Rejected/Declined</option>

                                                </select>
                                            </li>
                                          <li>
                                              <button id="search_interview" type="button" class="btn btn-primary pull-left" style="margin: 27px 0 0;">Search</button>
                                          </li>
                                        </ul>
                                      </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="table-responsive otm table-otm">
                                            <table style="width: 100%;" id="scheduled_interviews" class="table table-hover table-striped table-bordered ">
                                                <thead>
                                                    <tr>
                                                        <th>Company Name</th>
                                                        <th>Job</th>
                                                        <th>Candidate</th>
                                                        <th>Date</th>
                                                        <th>From</th>
                                                        <th>To</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <tr><td colspan="3" style="background: #fff;cursor: default;padding: 1px;"></td></tr>
{{--                                                    <tr>--}}
{{--                                                        <td><a href="clients-list.html">Dakota Rice</a></td>--}}
{{--                                                        <td>Lorem Ipsum</td>--}}
{{--                                                        <td><a href="candidates-list.html">Jone Deo</a></td>--}}
{{--                                                        <td>10/10/2019 - 03:30 PM</td>--}}
{{--                                                        <td>11/10/2019 - 03:30 PM</td>--}}
{{--                                                        <td><span style="color: #000; background-color: #ff9900;">Phone Interview</span></td>--}}
{{--                                                        <td><a data-toggle="modal" href="#statusModal" class="tag">Update Status</a><a class="tag" data-toggle="modal" href="#exampleModal">View Details</a></td>--}}
{{--                                                    </tr>--}}

                                                </tbody>
                                            </table>
                                        </div>
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



        function search_job(){

            var client_id = $('#company_id_interview').val() ;
            var jobOp = "" ;
            $.ajax({

                url: "{{route('pipeline.client.jobs')}}",
                type: 'post',

                data:{
                    data: { client_id:client_id},
                    "_token": "{{ csrf_token() }}",
                },
                beforeSend: function(){
                    $.blockUI({ message: '<div class="spinner-grow text-success"></div><div class="spinner-grow text-success"></div><div class="spinner-grow text-success"></div>', css: {border:     'none',
                            backgroundColor:'transparent'} });
                },
                complete:function(data){
                    $.unblockUI();
                }
                // dataType: 'json'
            }).done(function(res){
                var json = JSON.parse(res) ;
                jobOp += ' <option value="" style="display: none;"></option>';
                for(let i=0 ; i<json.length ; i++)
                {
                    jobOp += '<option value="'+json[i]['id']+'">'+json[i]['jobtitle']+'</option>'
                }

                document.getElementById('job_interview').innerHTML=jobOp;

            });
        }
    </script>
 @endsection             


