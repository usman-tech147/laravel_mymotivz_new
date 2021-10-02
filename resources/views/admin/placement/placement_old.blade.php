@extends('admin.layouts.layouts')
@section('title', 'Placement')
@section('content')
                <div class="app-main__inner">
                    <div class="card-header-tab card-header">
                        <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><i class="pe-7s-cash mr-3 text-muted opacity-6" style="font-size: 35px; color: white !important;"> </i>Placement</div>
                    </div>
                    <div class="tabs-animation">                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <form action="">
                                            <ul class="search-form">
                                                <li>
                                                    <label>Company Name</label>
                                                    <select onchange="search_placement_job()" name="client" id="company_id_placement" class="multiselect-dropdown form-control client-list-check">
                                                        <option value="" style="display: none;"></option>
                                                        @foreach($pipelineClients as $client)

                                                            <option value="{{$client->id}}" >{{$client->company_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </li>
                                                <li>
                                                    <label>Job Title</label>
                                                    <select class="multiselect-dropdown job_title form-control"  name="job_title"  id="job_placement">
                                                        <option value="" style="display: none;"></option>
                                                    </select>
                                                </li>
                                                <li>
                                                    <label>Candidate Name</label>
                                                    <select class="multiselect-dropdown job_title form-control"  name="candidate_name_placement"  id="candidate_name_placement">
                                                        <option value="" style="display: none;"></option>
                                                        @foreach($jobCandidates as $candidate)

                                                            <option value="{{$candidate->id}}" >{{$candidate->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </li>
                                                <li>
                                                    <label>Sort</label>
                                                    <select class="multiselect-dropdown form-control"  name=""  id="sorting_order">
{{--                                                        <option value="" style="display: none;"></option>--}}
                                                            <option value="A" >A-Z</option>
                                                            <option value="Z" >Z-A</option>
                                                    </select>
                                                </li>
                                                <li>
                                                    <button id="search_placement" type="button" class="btn btn-primary pull-left" style="margin: 27px 0 0;">Search</button>
                                                </li>
                                            </ul>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="main-card mb-3 card">
                                    <div class="card-body">
                                        <div class="table-responsive otm table-otm">
                                            <table style="width: 100%;" id="placement_table" class="table table-hover table-striped table-bordered">
                                                <thead>
                                                    <tr>
{{--                                                        <th>No</th>--}}
                                                        <th>Start Date</th>
                                                        <th>Recruiter</th>
                                                        <th>Company Name</th>
                                                        <th>Hired</th>
                                                        <th>Job Title</th>
                                                        <th>Salary</th>
                                                        <th>Service FEE</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
<script>
    $(document).on('click','.edit_placement_btn',function () {
        var  id = $(this).attr('data-id');
        $.ajax({

            url: "{{route('searchplacement')}}",
            type: 'post',

            data: {"_token": "{{ csrf_token() }}" ,id:id },


            // dataType: 'json'
        }).done(function(res){
            var json = JSON.parse(res) ;
            console.log(json);
            // $('#edit_placement_start_date').val(json['s_date']);
            $('#edit_placement_start_date').datepicker("setDate", json['s_date'] );
            // $('#edit_placement_start_date').val(json['data'][0]['stat_date']);

            var company_id = json['data'][0]['client_id'];
            var job_id = json['data'][0]['job_id'];


            $('#edit_placement_id').val(json['data'][0]['id']);
            $('#edit_salary').val(json['data'][0]['salary']);
            $('#edit_service_fee').val(json['data'][0]['fee']);

            $('#edit_hire_company_name').val(json['data'][0]['client_id']);
            $('#select2-edit_hire_company_name-container').text(json['data'][0]['clients']['company_name']);
            $('#edit_hired_candidate').val(json['data'][0]['candidate_id']);
            $('#select2-edit_hired_candidate-container').text(json['data'][0]['candidates']['name']);
            var jobOp = "" ;
            $.ajax({
                url: "{{route('job-details-admin')}}",
                type: 'post',
                data:{
                    "_token": "{{ csrf_token() }}",
                    "dataId":company_id,
                },
            }).done(function(res){
                //   var json = JSON.parse(res) ;
                var json = res ;
                var chose = '';
                // console.log(json);
                for (var i = res.length - 1; i >= 0; i--) {
                    if(job_id==json[i]['id'])
                    {
                        chose = 'selected';
                    }
                    else {
                        chose = '';
                    }
                    jobOp += '<option value="'+json[i]['id']+'" '+chose+'>'+json[i]['jobtitle']+'</option>'
                }

                document.getElementById('edit_job_position').innerHTML=jobOp;

            });

         });
    });

    function search_placement_job(){

        var client_id = $('#company_id_placement').val() ;
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
            jobOp += ' <option value="" style="display: none;"></option>';
            for(let i=0 ; i<json.length ; i++)
            {
                jobOp += '<option value="'+json[i]['id']+'">'+json[i]['jobtitle']+'</option>'
            }

            document.getElementById('job_placement').innerHTML=jobOp;

        });
    }

</script>
@endsection
