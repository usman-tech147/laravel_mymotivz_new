@extends('admin.layouts.layouts')
@section('title', 'Client Dashboard')
@section('content')
    @if(session()->has('Email'))
        <input type="hidden" id="email_reply" value="{{session('Email')}}">
    @endif
    <div class="app-main__inner">
        <div class="card-header-tab card-header">
            <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><i class="pe-7s-user mr-3 text-muted opacity-6" style="font-size: 35px; color: white !important;"> </i>Client Dashboard</div>
        </div>
        <div class="tabs-animation">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-3">
                        <div class="card-body">
                            <form action="">
                                <ul class="search-form">
                                    <li>
                                        <select onchange="getJobs()" name="" id="select-module">
                                            <option value="1">company Name</option>
                                            <option value="2">Job Title</option>
                                        </select>
                                        <select onchange="optionSearch()" id="selected-options" name="" class="form-control second-select multiselect-dropdown">
                                            @foreach($clients as $client)
                                                <option value="{{$client->id}}">{{$client->company_name}}</option>
                                            @endforeach
                                        </select>
                                    </li>
                                    <li><button style="margin: 0px; display: none;" type="submit" class="btn btn-primary pull-left">Search</button></li>
                                </ul>
                            </form>
                            <a href="#contractformModal" id="submit_contract" data-toggle="modal" class="btn btn-primary btn-shine pull-right" style="margin: 0px 0px 0px 5px;">Submit Contract</a>
                            <a @can('view', \App\Models\Admin\AdminContract::class) href="{{route('allcontract')}}" @endcan @cannot('view', \App\Models\Admin\AdminContract::class) href="javascript:void(0)" @endcannot class="btn btn-primary btn-shine pull-right" style="margin: 0px 0px 0px 5px;">All Contracts</a>
                            <a href="#presentModal" id="present_modal_client" data-toggle="modal" class="btn btn-primary pull-right">Present</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-ovrflow">
                <div class="table-ovrflow-width">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card mb-3">
                                <div class="card-header-tab card-header">
                                    <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><i class="pe-7s-note2 mr-3 text-muted opacity-6" style="font-size: 35px;"> </i>Jobs</div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table style="width: 100%;" class="candidate-list table table-hover table-striped table-bordered table-cursor">
                                            <thead>
                                            <tr>
                                                <th>Job Openings</th>
                                            </tr>
                                            </thead>
                                            <tbody id="jobs-client-dashboard">


                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card mb-3">
                                <div class="card-header-tab card-header">
                                    <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><i class="pe-7s-users mr-3 text-muted opacity-6" style="font-size: 35px;"> </i>Candidates</div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table style="width: 100%;" class="table table-hover table-striped table-bordered table-cursor">
                                            <thead>
                                            <tr>
                                                <th>Name</th>
                                            </tr>
                                            </thead>
                                            <tbody id="candidates-client-dashboard">


                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-header-tab card-header">
                                    <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><i class="pe-7s-notebook mr-3 text-muted opacity-6" style="font-size: 35px;"> </i>Candidate Details</div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="candaite-client-dahboard-detail" class="table-detail table table-hover table-striped table-bordered">

                                        </table>

                                        <div id="candaite-client-dahboard-detail-btns">

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(session()->has('Email'))
        <script>
            var msg = $('#email_reply').val();
            $( document ).ready(function() {
                swal({

                    title: "Email",
                    text: msg,
                });
                @php session()->forget('Email')  @endphp
            });

        </script>
    @endif
    @if ($errors->any())
        <script>

            $( document ).ready(function() {
                $('body').addClass('modal-open');
                $("#contractformModal").addClass('in show');
                // $("#presentemptyModal").addClass('in show');
                $('#contract_close_btn').click(function () {
                    $('body').removeClass('modal-open');
                    $("#contractformModal").removeClass('in show');
                    // $("#presentemptyModal").removeClass('in show');
                })
            });

        </script>
    @endif
    <script>
        $(document).ready(function () {
            getJobs();
            optionSearch();

        });
        var moduleId = 1 ;
        var candiate_id = "" ;
        function getJobs() {

            //define as global variable to get value againt them.

            moduleId = $('#select-module option:selected').val() ;
            // alert(moduleId);
            var op = "";
            $.ajax({
                url: "{{route('client.dashboard.search.dropdown')}}",
                type: 'post',

                data:{
                    "_token": "{{ csrf_token() }}",
                    "moduleId":moduleId,
                },
                // dataType: 'json'
            }).done(function(res){
                var json = JSON.parse(res) ;

                if(moduleId == 1)
                {
                    for (let i=0;i<json.length;i++)
                    {
                        op += '<option value="'+json[i]['id']+'">'+json[i]['company_name']+'</option>' ;
                    }
                    document.getElementById('selected-options').innerHTML=op;
                }else if(moduleId == 2)
                {
                    for (let i=0;i<json.length;i++)
                    {
                        op += '<option data-client="'+json[i]['client_id']+'"  value="'+json[i]['id']+'">'+json[i]['jobtitle']+'</option>' ;
                    }
                    document.getElementById('selected-options').innerHTML=op;
                }
                optionSearch();
            });
        }



        function optionSearch()
        {
            var html="";
            var opId = "" ;
            if(moduleId == 1)
            {
                var opId = $("#selected-options option:selected").val() ;
            }else{
                var opId = $("#selected-options option:selected").text() ;
            }
            // alert('opID '+opId);
            // alert(opId);
            $.ajax({
                url: "{{route('client.dashboard.search.option')}}",
                type: 'post',

                data:{
                    "_token": "{{ csrf_token() }}",
                    "opId":opId,
                    "moduleId":moduleId,
                },
                // dataType: 'json'
            }).done(function(res){
                var json = JSON.parse(res) ;

                if(json.length === 0)
                {
                    $('#candidates-client-dashboard').empty();

                    $('#candaite-client-dahboard-detail').empty();
                    $('#candaite-client-dahboard-detail-btns').hide();
                }
                // alert('opID '+opId);
                for (let i=0; i<json.length; i++)
                {
                    if(i==0)
                    {
                        // alert('candidate fun '+json[i]['id'])
                        showCandidates(json[i]['id']) ;
                        html +='<tr><td colspan="2" style="background: #fff;cursor: default;padding: 1px;"></td></tr><tr data-id="'+json[i]['id']+'" class="dashbord-jobs color-active">\n' +
                            '<td><div class="add-cursor"><a  href="javascript:void(0)"><h4 class="bold-green">'+json[i]['jobtitle']+'</h4></a><small><b>'+json[i]["city"]+', '+json[i]["state"]+'</b></small></div></td>'+
                            '</tr>' ;
                    }else{
                        html +='<tr><td colspan="2" style="background: #fff;cursor: default;padding: 1px;"></td></tr><tr data-id="'+json[i]['id']+'" class="dashbord-jobs">\n' +
                            '<td><div class="add-cursor"><a  href="javascript:void(0)"><h4 class="bold-green">'+json[i]['jobtitle']+'</h4></a><small><b>'+json[i]["city"]+', '+json[i]["state"]+'</b></small></div></td>'+
                            '</tr>' ;
                    }
                }
                if(html=="")
                {
                    // html='<tr><td colspan="2" style="background: #fff;cursor: default;padding: 1px;"></td></tr><td>You have no Job against this Client in pipeline</td><tr>'
                    html='<center>You have no Job against this Client in pipeline</center>';
                    var html2 = '<center>No Candidates Avaliable</center>';
                    var nhtml = '<center>No Details Avaliable</center>';
                    document.getElementById('candaite-client-dahboard-detail').innerHTML=nhtml ;
                    document.getElementById('candidates-client-dashboard').innerHTML=html2;
                }
                document.getElementById('jobs-client-dashboard').innerHTML="";
                document.getElementById('jobs-client-dashboard').innerHTML=html;
            });
        }


        //put the arrow on a current value..
        $(document).on('click', '.dashbord-jobs', function() {
            var tr = $(this);

            $('.dashbord-jobs').removeClass('color-active') ;
            tr.addClass('color-active') ;
            var jobIdCand = tr.attr('data-id');
            //call function to get all candiates against them..
            // $('#client_dashboard_job').val(jobIdCand);
            showCandidates(jobIdCand)
        });

        function showCandidates(id)
        {
            $('#candaite-client-dahboard-detail').hide();
            $('#candaite-client-dahboard-detail-btns').hide() ;

            var html="" ;
            // alert(id);
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
                var color = "" ;
                for(let j=0; j<json.length; j++)
                {

                    if(j==0)
                    {

                        if(json[j]['color'] == "#ffffff")
                        {
                            color = "#000000" ;
                        }else{
                            color = "#ffffff" ;
                        }
                        showDetail(json[j]['candidate_id']);
                        html +='<tr><td style="background: #fff;cursor: default;padding: 1px;"></td></tr><tr data-id="'+json[j]['candidate_id']+'" class="dashbord-candidates">\n' +
                            '<td style="font-weight: bold" class="add-note active " data-id="'+json[j]['candidate_id']+'">'+json[j]['candidate_name']+' ' +
                            // '<a style="color: '+color+';" class="note-box" href="candidates-list.html">'+json[j]['job_title']+'</a>\n' +
                            '<ul class="custom-menu custom-menu-'+json[j]['candidate_id']+'">\n' +
                            '<li data-action="first"><a data-toggle="modal" href="#exampleModal">Add Notes</a></li>\n' +
                            '<li data-action="second"><a href="#">View Detail</a></li>\n' +
                            '</ul>\n' +
                            '</td>\n' +
                            '</tr>' ;
                    }else{

                        html +='<tr><td style="background: #fff;cursor: default;padding: 1px;"></td></tr><tr data-id="'+json[j]['candidate_id']+'" class="dashbord-candidates">\n' +
                            '<td style="font-weight: bold" class="add-note " data-id="'+json[j]['candidate_id']+'">'+json[j]['candidate_name']+' ' +
                            // '<a style="color: '+color+'" class="note-box" href="candidates-list.html">'+json[j]['job_title']+'</a>\n' +
                            '<ul class="custom-menu custom-menu-'+json[j]['candidate_id']+'">\n' +
                            '<li data-action="first"><a data-toggle="modal" href="#exampleModal">Add Notes</a></li>\n' +
                            '<li data-action="second"><a href="#">View Detail</a></li>\n' +
                            '</ul>\n' +
                            '</td>\n' +
                            '</tr>' ;
                    }
                }
                if(html=="")
                {
                    html = '<center>No Candidates Avaliable</center>';
                    var nhtml = '<center>No Details Avaliable</center>';
                    document.getElementById('candaite-client-dahboard-detail').innerHTML=nhtml ;
                    $('#candaite-client-dahboard-detail').show();

                }
                // document.getElementById('candidates-client-dashboard').innerHTML="";
                document.getElementById('candidates-client-dashboard').innerHTML=html;
            });
        }

        $(document).on('click', '.dashbord-candidates', function(e) {
            e.preventDefault();
            var tr = $(this);

            var id = tr.attr('data-id') ;
            $('.dashbord-candidates').children().removeClass('active') ;
            tr.children().addClass('active');

            showDetail(id) ;
        }) ;
        function candidateRemovePipline(id)
        {
            var job_id= $('#jobs-client-dashboard tr.color-active').attr('data-id');
            // alert(nextId);
            swal({

                title: "Are you sure",
                text: "You want to remove this Candidate from Pipeline!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: "{{route('candidate.remove.pipeline')}}",
                            type: 'post',

                            data: {

                                "_token": "{{ csrf_token() }}",
                                "candidate_id": id,
                                "job_id": job_id,


                            },
                            // dataType: 'json'
                        }).done(function (res) {

                            // console.log(res);
                            swal("Your candidate is successfully removed from pipeline!");
                            showCandidates(job_id)

                        });
                    } else {
                        swal("Your candidate is still in pipeline!");
                    }

                });
        }
        function showDetail(id)
        {
            //for getting canidate id into update status function
            $('#candidate-status-update-client-dashboard').val(id) ;

            $('#candaite-client-dahboard-detail').show();
            $('#candaite-client-dahboard-detail-btns').show() ;

            // tempeary remove after buttons functioning
            $('#candaite-client-dahboard-detail-btns').show() ;

            var html = "" ;
            var notes = "" ;
            var btns = "" ;
            $.ajax({
                url: "{{route('client.dashboard.job.candidate.detail')}}",
                type: 'post',
                data:{
                    "_token": "{{ csrf_token() }}",
                    "candId":id,
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
                console.log(json[0]);
                for (let i=0 ; i<json[0]['admin_notes'].length; i++)
                {
                    var date = new Date(json[0]['admin_notes'][i]['created_at']);
                    var newDate=(((date.getMonth() > 8) ? (date.getMonth() + 1) : ('0' + (date.getMonth() + 1))) + '/' + ((date.getDate() > 9) ? date.getDate() : ('0' + date.getDate())) + '/' + date.getFullYear());
                    notes += '<li id="candidate_note_detail_client-'+json[0]['admin_notes'][i]['id']+'">\n' +
                        '<time datetime="">'+newDate+'</time>\n' +
                        '<p>'+json[0]['admin_notes'][i]['description']+'</p>\n' +
                        '<a  id="note-c-dash-del-'+json[0]['admin_notes'][i]['id']+'" data-id="'+json[0]['admin_notes'][i]['id']+'" href="javascript:void(0)" class="tag btn note-c-dash-del">Delete</a>\n' +
                        '</li>\n' ;
                }
                if(notes=="")
                {
                    notes='<li> No Notes Avaliable</li>'
                }

                html += ' <tr>\n' +
                    '<th>Full Name:</th>\n' +
                    '<td id="selected_candidate">'+json[0]['name']+'</td>\n' +
                    '</tr>\n' +
                    '<tr>\n' +
                    '<th>Job Title:</th>\n' +
                    '<td>'+json[0]['job_title']+'</td>\n' +
                    '</tr>\n' +
                    '<tr>\n' +
                    '<th>Phone Number:</th>\n' +
                    '<td>'+json[0]['phone']+'</td>\n' +
                    '</tr>\n' +
                    '<tr>\n' +
                    '<th>Email:</th>\n' +
                    '<td>'+json[0]['email']+'</td>\n' +
                    '</tr>\n' +
                    '<tr>\n' +
                    '<th>Status:</th>\n' +
                    '<td><img id="client-dash-sts-'+json[0]['id']+'" width="50px" height="50px" src="'+window.location.origin+'/status_icons/'+json[0]['admin_status']['status_icon']+'"></td>\n' +
                    '</tr>\n' +
                    '<tr>\n' +
                    '<th>Notes:</th>\n' +
                    '<td>\n' +
                    '<div class="note-wrap detail">\n' +
                    '<ul id="notes-list-'+json[0]['id']+'">'+notes+'</ul>\n' +
                    '</div>\n' +
                    '</td>\n' +
                    '</tr>' ;


                btns = '<form id="client_dashboard_interview_form_'+json[0]['id']+'" action="{{route('company-schedule-interview')}}" method="post">@csrf<input type="hidden" name="candidate_id" value="'+json[0]['id']+'"><input type="hidden" id="client_dashboard_job" name="job_id" value=""><input type="hidden" id="client_dashboard_client" name="client_id" value=""></form>\n' +
                    '<a data-id="'+id+'" data-state="'+json[0]['admin_status']['id']+'" id="update-status-client-dashboard" class="tag" data-toggle="modal" href="#statusModal-client-dashboard">Update Status</a>\n' +
                    '<a href="#presentModal" id="present_modal_client_dashboard" data-id="'+json[0]['id']+'" data-toggle="modal" class="tag">Present</a>'+
                    '<a class="tag" onClick="client_dashboard_interview_submit('+json[0]['id']+')">Schedule Interview</a>\n' +
                    '<a class="tag" href="#hiredModal" data-id="'+json[0]['id']+'" id="client_hire_btn" data-toggle="modal">Hired</a>\n' +
                    // '<a class="tag" href="#">Add to pipeline</a>--}}\n' +
                    '<a class="tag" onclick="candidateRemovePipline('+json[0]['id']+')" href="#">Remove from pipeline</a>' ;



                document.getElementById('candaite-client-dahboard-detail').innerHTML=html ;
                document.getElementById('candaite-client-dahboard-detail-btns').innerHTML=btns ;
                form_values();

            });

        }
        $(document).on('click', '#present_modal_client_dashboard', function() {

            var candidate_id = $(this).attr('data-id');
            var job_id= $('#jobs-client-dashboard tr.color-active').attr('data-id');
            var client_id = 0;

            if(moduleId == 1)
            {
                client_id = $("#selected-options option:selected").val() ;
            }else{
                client_id =$("#selected-options option:selected").attr('data-client') ;
            }
            // $('#company_name_present').val(client_id);
            // $('#job-list-present').val(job_id);
            // $('#candidate-id-present').val(candidate_id);
            $.when($.ajax({
                    url: "{{route('client.all.ajax')}}",
                    type: 'get',
                beforeSend: function(){
                    $.blockUI({ message: '<div class="spinner-grow text-success"></div><div class="spinner-grow text-success"></div><div class="spinner-grow text-success"></div>', css: {border:     'none',
                            backgroundColor:'transparent'} });
                },
                complete:function(data){
                    $.unblockUI();
                }
                }).done(function(res){
                    console.log('when');
                            var json = JSON.parse(res) ;
                          var jobOp='' ;
                          var chose = '';
                          // console.log(json);
                          for (var i = json.length - 1; i >= 0; i--) {
                              if(client_id==json[i]['id'])
                              {
                                  chose = 'selected';
                              }
                              else {
                                  chose = '';
                              }
                              jobOp += '<option value="'+json[i]['id']+'" '+chose+'>'+json[i]['company_name']+'</option>'
                          }

                          document.getElementById('company_name_present').innerHTML=jobOp;
                  functionSet();
              })).then(function () {
                var jobOp = "" ;
                $.ajax({
                    url: "{{route('job-details-admin')}}",
                    type: 'post',
                    data:{
                        "_token": "{{ csrf_token() }}",
                        "dataId":client_id,
                    },
                    beforeSend: function(){
                        $.blockUI({ message: '<div class="spinner-grow text-success"></div><div class="spinner-grow text-success"></div><div class="spinner-grow text-success"></div>', css: {border:     'none',
                                backgroundColor:'transparent'} });
                    },
                    complete:function(data){
                        $.unblockUI();
                    }
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

                    document.getElementById('job-list-present').innerHTML=jobOp;

                });
            }).then(function () {


                $('#candidate-id-present').val(candidate_id);
                var c_name= $('#selected_candidate').text();
                $('#candidate-id-present').next('span').find('.select2-selection__rendered').html('<li class="select2-selection__choice" title="'+c_name+'" ><span class="select2-selection__choice__remove" role="presentation">×</span>'+c_name+'</li>');
            });

        });

        function client_dashboard_interview_submit(id)
        {
            $("#client_dashboard_interview_form_"+id).submit();
        }

        function form_values()
        {

            var job_id_for_form= $('#jobs-client-dashboard tr.color-active').attr('data-id');
            // alert(job_id_for_form);
            $('#client_dashboard_job').val(job_id_for_form);

            if(moduleId == 1)
            {
                // alert($("#selected-options option:selected").val());
                $('#client_dashboard_client').val($("#selected-options option:selected").val()) ;
            }else{
                // alert($("#selected-options option:selected").attr('data-client'));
                $('#client_dashboard_client').val($("#selected-options option:selected").attr('data-client')) ;
            }
        }

        $(document).on('click', '#client_hire_btn', function()
        {

            document.getElementById("add_placement_form").reset();
            var c_id=0;
            var cand_id = $(this).attr('data-id');
          var  mId = $('#select-module option:selected').val() ;

            if(mId == 1)
        {
            // alert($("#selected-options option:selected").val());
            c_id= $("#selected-options option:selected").val() ;
        }else{
            // alert($("#selected-options option:selected").attr('data-client'));
            c_id= $("#selected-options option:selected").attr('data-client');
        }
            var job_id= $('#jobs-client-dashboard tr.color-active').attr('data-id');
            var cand_name= $('#selected_candidate').text();
// alert(c_id);

            $.ajax({
                url: "{{route('noncontract')}}",
                type: 'get',

            }).done(function(res) {
                var json = JSON.parse(res);
                var non_con_clients = '';
                var chose = '';
                // console.log(json);
                for (var i = 0; i < json.length; i++) {

                    if (c_id==json[i]['id'])
                    {
                        chose = 'selected';
                    }
                    else {
                        chose = '';
                    }
                    non_con_clients += '<option value="' + json[i]['id'] + '" '+chose+' >' + json[i]['company_name'] + '</option>'
                }
                document.getElementById('hire_company_name').innerHTML=non_con_clients;

            });

            $('#hired_candidate').val(cand_id);
            // alert(cand_name);
            $('#select2-hired_candidate-container').text(cand_name);
            var jobOp = "" ;
            $.ajax({
                url: "{{route('job-details-admin')}}",
                type: 'post',
                data:{
                    "_token": "{{ csrf_token() }}",
                    "dataId":c_id,
                },

            }).done(function(res){
                //   var json = JSON.parse(res) ;
                var json = res ;
                var chose1 = '';
                // console.log(json);
                for (var i = res.length - 1; i >= 0; i--) {
                    if(job_id==json[i]['id'])
                    {
                        chose1 = 'selected';
                    }
                    else {
                        chose1 = '';
                    }
                    jobOp += '<option value="'+json[i]['id']+'" '+chose1+'>'+json[i]['jobtitle']+'</option>'
                }
                console.log(jobOp);
                document.getElementById('job_position').innerHTML=jobOp;

            {{--});--}}

        });
        });
        $(document).on('click', '.note-c-dash-del', function(){
            var noteId = $(this).attr('data-id') ;
            swal({
                title: "Are you sure",
                text: "You want to remove this Note!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: "{{route('note.delete')}}",
                            type: 'post',

                            data:{
                                "_token": "{{ csrf_token() }}",
                                "noteId":noteId,
                            },

                            // dataType: 'json'
                        }).done(function(res) {
                            var json = JSON.parse(res) ;
                            // alert(json);


                            $.when( $('#candidate_note_detail_client-'+noteId).remove()).then(function () {
                                if($('#notes-list-'+noteId).has(li).length==0)
                                {
                                    var no_note = "<li>No Notes Avaliable</li>";
                                    $('#notes-list-'+noteId).append(no_note);
                                }
                            });


                            $('#candidate_note_detail_client-'+noteId).remove() ;
                            // console.log($('#notes-list-'+noteId).find(li));

                            swal("Your note is successfully Deleted!");
                        });
                    } else {
                        swal("Your note is safe!");
                    }

                });

        });


        //update status

        $(document).on('click', '#update-status-client-dashboard', function(e) {
            candiate_id = $(this).attr('data-id') ;
            var status_id = $(this).attr('data-state') ;
            var se = '';
            $.ajax({

                url: "{{route('status.ajax')}}",
                type: 'get',

            }).done(function(res){
                var json = JSON.parse(res) ;
                for (let i =0 ;i<json.length;i++)
                {
                    if(json[i]['id']==status_id)
                    {

                        se = 'selected';
                        // alert(json[i]['id'],se);
                        // alert(json[i]['name']);
                    }
                    else {
                        se = '';
                    }

                    $('#status-updated-slc-client-dashboard').append('<option image="'+window.location.origin+'/status_icons/'+json[i]['status_icon']+'" value="'+json[i]['id']+'" '+se+'>'+json[i]['name']+'</option>');
                }

            });


        });

        $(document).on('click', '#update-status-client-dash', function(e) {

            var option = $('#status-updated-slc-client-dashboard option:selected') ;

            var opColor = $('#status-updated-slc-client-dashboard option:selected').attr('image') ;

            var status = option.val() ;
            var statusText = option.text() ;



            // alert(statusText);
            // var color = option.css('background-color');

            //color = color.replace(')', ', 0.75)').replace('rgb', 'rgba');
            $.ajax({
                url: "{{route('update.status.ajax')}}",
                type: 'post',

                data:{

                    "_token": "{{ csrf_token() }}",
                    "status":status,
                    "candId": candiate_id,

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

                $('#client-dash-sts-'+candiate_id).attr('src' , opColor) ;

                $('#update-status-client-dashboard').attr('data-state',status)

            });

        });
        //end update status

    </script>
@endsection
