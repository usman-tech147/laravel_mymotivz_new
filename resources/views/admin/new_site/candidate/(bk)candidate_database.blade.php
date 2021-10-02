@extends('admin.layouts.layouts')
@section('title', 'Candidate Dashboard')
@section('content')
<div class="app-main__inner">
{{--    to get candidate id --}}
    <input id="cand-id-custom" type="hidden">
    @if(session()->has('Email'))
        <input type="hidden" id="email_reply_candidate_dashboard" value="{{session('Email')}}">
    @endif
    <div class="card-header-tab card-header">
        <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><i class="pe-7s-users mr-3 text-muted opacity-6" style="font-size: 35px; color: #4d9a10 !important;"> </i>Candidate Database</div>
    </div>
    <div class="tabs-animation">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="card-body">
                        <form action="">
                            <ul class="search-form">
                                <li>
                                    <input class="form-control" id="candidateName" name="candidate_name" type="text" style="width: 100%;" placeholder="Candidate's Name">
                                </li>
                                <li>
                                    <input class="form-control" id="candidateCity" name="city_state" type="text" placeholder="Enter City/State">
                                </li>
                                <li class="del"><button onclick="Fun(10)" style="margin: 0px;" type="button" class="btn btn-primary pull-left">Search</button><button type="button" data-toggle="tooltip" id="mega-search" title="Advanced Search" class="btn btn-primary pull-left mega-search" style="padding: 5px 10px; margin-left: 5px; margin-top: 0px;"><i style="font-size: 30px;" class="pe-7s-config"></i></button></li>
                            </ul>
                            <div  class="motivz-job-search can-adv-srch">
                                <ul>

                                    <li>
                                        <input id="Industry" name="Industry" type="text" class="form-control" placeholder="Types of Industry">
                                    </li>
                                    <li>
                                        <input id="Skills" name="Skills" type="text" class="tags_2 tags form-control" placeholder="Skills">
                                    </li>
                                    <li>
                                        <input id="job-title" name="jobTitle" type="text" class="tags_3 form-control" placeholder="Job Title">
                                    </li>

                                    <li>
                                        <select onchange="optionSearch()" id="selected-options-status" name="" class="form-control second-select multiselect-dropdown">
                                           <option style="display: none;" value=""></option>
                                            @foreach($statuses as $status)
                                                <option value="{{$status->id}}">{{$status->name}}</option>
                                            @endforeach
                                        </select>

                                    </li>

                                        <li><input onclick="Fun(10)" type="button" class="btn btn-primary pull-left" value="Search"></li>
                                </ul>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="card-header-tab card-header">
                                <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><i class="pe-7s-users mr-3 text-muted opacity-6" style="font-size: 35px;"> </i>Candidates</div>
                            </div>
                            <div class="card-body candidate-scroll">
                                <div class="table-responsive">
                                    <table style="width: 100%;" class="table table-hover table-striped table-bordered table-cursor candidate-list">
                                        <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Job Title</th>
                                            <th>Status</th>
                                            <th>Location</th>
                                        </tr>
                                        </thead>
                                        <tbody id="htmlShow">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="card-header-tab card-header">
                                <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><i class="pe-7s-notebook mr-3 text-muted opacity-6" style="font-size: 35px;"> </i>Candidate Details</div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="show-one-client" class="table-detail table table-hover table-striped table-bordered">

                                    </table>
                                    <div id="button-for-div">

                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card-body">
                                <div class="box-2">
                                    {{--    <ul id="example-2" class="pagination"></ul>--}}
                                    <ul id="example-3" class="pagination"></ul>
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


@if(session()->has('Email'))
    <script>
        var msg = $('#email_reply_candidate_dashboard').val();
        $( document ).ready(function() {
            swal({

                title: "Email",
                text: msg,
            });
            @php session()->forget('Email')  @endphp
        });

    </script>
@endif
<script>
    $(document).on('click','#add_to_pipeline_btn',function () {
        jobPicker();
    });
     window.onload=Fun(10);

    //to access globaly in deffernet functions..
    var candId = "";
    //for client detail

    function showDetails1(id){

        candId = id;
        //put it on popup form hidden field to sent it to backend for add it to pipeline..
        $('#candiate-id-for-pipeline').val(candId) ;

        $('.cus-cls').removeClass('color-active');
        $('.cus-cls-'+id).addClass('color-active');

        var html='';
        var html1='';
        var divNoteHtml='';
        $.ajax({

            url: "{{route('candidate.database.detail.ajax')}}",
            type: 'post',

            data:{
                "_token": "{{ csrf_token() }}",
                "dataId":id,
            },

            // dataType: 'json'
        }).done(function(response){


            var json = JSON.parse(response);
            var myJSON=json[0];
            var notes= json[1];

            divNoteHtml+='   <div id="append-note-cand-'+id+'" class="note-wrap detail"><ul>';
            for(var i=0; i<notes.length;i++){
                var date = new Date(notes[i]['created_at']);
                var job_date = new Date(myJSON[0]['created_at']);

                var newDate=(((date.getMonth() > 8) ? (date.getMonth() + 1) : ('0' + (date.getMonth() + 1))) + '/' + ((date.getDate() > 9) ? date.getDate() : ('0' + date.getDate())) + '/' + date.getFullYear());

                var job_date_1 =(((job_date.getMonth() > 8) ? (job_date.getMonth() + 1) : ('0' + (job_date.getMonth() + 1))) + '/' + ((job_date.getDate() > 9) ? job_date.getDate() : ('0' + job_date.getDate())) + '/' + job_date.getFullYear());

                if(notes[i]['description'] == null)
                {
                    var noteClient = "";
                }else{
                    var noteClient = notes[i]['description'];
                }
                divNoteHtml+=' <li id="delete-id-'+notes[i]['id']+'">' +
                    '<time>'+newDate+' </time>' +
                    '<p id="note-'+notes[i]['id']+'">'+noteClient+'</p>' +
                    '<a id="note-del-'+notes[i]['id']+'" dataId="'+notes[i]['id']+'" href="javascript:void(0)" class="tag btn note-del">Delete</a>' +
                    '<a id="note-edit-'+notes[i]['id']+'" dataid="'+notes[i]['id']+'" href="#editNotePopup" data-toggle="modal" class="tag btn editNote">Edit</a>'+
                    '</li>';
            }
            divNoteHtml+='     </ul></div>';
            // for (var i = 0 ; i <myJSON.length; i++) {
            // alert(myJSON[i]);
            // {{url("admin/Client/Database/")}}/'+myJSON[i]['id']+'
              var exp = '';
              var moreThenTen = "" ;
             (myJSON[0]['experience'] == 1) ? exp = 'year' : exp = 'years' ;
            (myJSON[0]['experience'] > 10) ? moreThenTen = 'More than 10' : moreThenTen = myJSON[0]['experience'] ;

            //use to append spans in td for skills..
            var skills = myJSON[0]['skills'].split(',') ;

            //use to append spans in td for education..
            //var education = myJSON[0]['education'].split(',') ;

            //use to append spans in td for industry..
            var industry = myJSON[0]['Industry'].split(',') ;

            var interest = myJSON[0]['interest'].split(',') ;



            var skillData = "" ;
            var indus = "" ;
            var intr = "" ;
            var resume = "" ;
            var exs = "" ;

            for(let a=0 ; a<skills.length; a++)
            {
                skillData += '<small class="borders">'+skills[a]+'</small>' ;
            }

            for(let b=0 ; b<industry.length; b++)
            {
                indus += '<small class="borders">'+industry[b]+'</small>' ;
            }


            for(let b=0 ; b<interest.length; b++)
            {
                intr += '<small class="borders">'+interest[b]+'</small>' ;
            }



            for(let b=0 ; b<myJSON[0]['resumes'].length; b++)
            {
                 exs = myJSON[0]['resumes'][b]['resume'].split('.').pop() ;
                if(exs === 'pdf')
                {
                    resume += '<a target="_blank" href="'+window.location.origin+'/public/files/'+myJSON[0]['resumes'][b]['resume']+'" style="font-size: 45px; margin: 0px 10px 0px 0px;" data-toggle="tooltip" title="" class="fa fa-file-pdf-o" data-original-title="'+exs+' FILE"></a>'
                }

                if(exs === 'docx')
                resume += '<a target="_blank" href="'+window.location.origin+'/public/files/'+myJSON[0]['resumes'][b]['resume']+'" style="font-size: 45px; margin: 0px 10px 0px 0px;" data-toggle="tooltip" title="" class="fa fa-file-word-o" data-original-title="'+exs+' FILE"></a>'
                if(exs === 'doc')
                resume += '<a target="_blank" href="'+window.location.origin+'/public/files/'+myJSON[0]['resumes'][b]['resume']+'" style="font-size: 45px; margin: 0px 10px 0px 0px;" data-toggle="tooltip" title="" class="fa fa-file-word-o" data-original-title="'+exs+' FILE"></a>'

            }

            //for get the candidate id to create note against them.
            $('#cand-id-custom').val(myJSON[0]['id']) ;

            html='  <tr><th>Date Logged:</th><td>'+job_date_1+' </td></tr>' +
                '<tr><th>Full Name:</th><td id="candidate_database_name_'+myJSON[0]['id']+'">'+myJSON[0]['name']+'</td>' + '</tr>' +
                '<tr><th>Salary Requirements:</th><td>'+myJSON[0]['salary']+'</td>' + '</tr>' +
                '<tr><th>Phone Number:</th><td>'+myJSON[0]['phone']+'</td></tr>' +
                '<tr><th>Interest:</th><td>'+intr+'</td></tr>' +
                '<tr><th>Email:</th><td>'+myJSON[0]['email']+'</td></tr>' +
                '<tr><th>City:</th><td>'+myJSON[0]['city']+'</td></tr>' +
                '<tr><th>State:</th><td>'+myJSON[0]['state']+'</td></tr>' +
                '<tr><th>Experience:</th><td>'+moreThenTen+' '+exp+'</td> </tr>' +
                '<tr><th>Education:</th><td id="edu-cls">'+myJSON[0]['education']['name']+'</td></tr>' +
                '<tr><th>Skills:</th><td id="skl-cls"></td></tr>'+
               '<tr><th>Industry:</th><td>'+indus+'</td></tr>' +
                '<tr></tr><tr><th>Notes:</th><td>'+divNoteHtml+'</td></tr>' +
                '<tr><th>Resume:</th>' +
                '<td>' +
                resume +
                '</td>' +
                '</tr>';
            // <tr><th>Types Of Industry:</th><td>'+myJSON[0]['industry']+'</td></tr>


            {{--if(myJSON[0]['recruitment_pipeline']==1)--}}
            {{--{--}}
            {{--    var buttonRecruiter='<a class="tag" href="{{url('admin/client/removePiplineClient/')}}/'+myJSON[0]['id']+'">Remove from pipeline</a>';--}}
            {{--}else{--}}
            {{--    var buttonRecruiter='<a id="add-pipe" class="tag" href="{{url('admin/client/addPiplineClient/')}}/'+myJSON[0]['id']+'" data-toggle="modal">Add to pipeline</a>';--}}
            {{--}--}}
                var p_btn = "";
           var stat= $('#candidate-id-'+candId).text() ;
            // alert(stat);
            // if (stat !="OTM")
            // {
                p_btn = '<a class="tag" data-toggle="modal" id="candidate_present_btn" href="#presentModal">Present</a>';
            // }
            html1='<a class="tag" data-toggle="modal" href="#statusModal">Update Status</a><a class="tag" data-toggle="modal" href="#exampleModal-1">Add Notes</a> <a class="tag" href="{{url('admin/candidate/edit/')}}/'+myJSON[0]['id']+'">Edit</a><a dataId="'+myJSON[0]['id']+'" class="tag del-cand" href="#">Delete</a>'+p_btn+'<a class="tag" id="add_to_pipeline_btn" data-toggle="modal" href="#pipelineModal_letest">Add to recruitment pipeline</a><a class="tag" dataId="'+myJSON[0]['id']+'" id="contact_candidate_btn" data-toggle="modal" href="#contact_candidateModal">Contact</a>';
            // };

            document.getElementById('show-one-client').innerHTML=html;
            document.getElementById('button-for-div').innerHTML=html1;
            if (skillData!="")
            {
                document.getElementById('skl-cls').innerHTML=skillData;
            }
            // if(eduData!="")
            // {
            //     document.getElementById('edu-cls').innerHTML=eduData;
            // }
            // alert(indus);
            if(indus!="")
            {
                // document.getElementById('idus-cls').innerHTML=indus;
            }



            //geting data status id using candidate id..
            var status_id = $('#candidate-id-'+candId).attr('data-id');
            $('#status-updated-slc option[value='+status_id+']').attr('selected', 'true');
        });
    }

    //end client detail
    $(document).on('click', '#contact_candidate_btn', function() {

        var candidate_id = $(this).attr('dataid');
        // alert(candidate_id);
        $('#candidate_id_contact').val(candidate_id);
    });




    function Fun(length) {

        // body...
        // alert('123');
         var name=$('#candidateName').val();
         var state=$('#candidateCity').val();
         var Industry=$('#Industry').val();
         var Skills=$('#Skills').val();
         var jobTitle=$('#job-title').val();
         var status=$('#selected-options-status').val();


        $('#example-3').pagination({
            total: 1, // 总数据条数
            current: 1, // 当前页码
            length: length, // 每页数据量
            size: 1, // 显示按钮个数
            /**
             * ajax请求远程数据
             * 此方法阻止按钮渲染
             * 直到调用refresh方法
             * @param  {[object]} options = {
             *      current: options.current,
             *      length: options.length,
             *      total: options.total
             *  }
             * @param  {[function]} refresh 回调函数以刷新分页按钮
             * @param  {[object]} $target [description]
             * @return {[type]}         [description]
             */
            ajax: function(options, refresh, $target){

                var html='';

                $.ajax({

                    url: "{{route('candidate.database.ajax')}}",
                    type: 'post',

                    data:{
                        current: options.current,
                        length: options.length,
                        "_token": "{{ csrf_token() }}",
                         "name":name,
                         "state":state,
                        "Industry":Industry,
                        "Skills":Skills,
                        'jobTitle': jobTitle,
                        'status':status,
                    },

                    // dataType: 'json'
                }).done(function(res){

                    var json = JSON.parse(res);
                    var statusTextColor = "" ;
                    var myJSON = json[1];
                    // alert(myJSON);
                    var totalRe = json[0];
                    // alert(total);
                    // console.log(res[1]);
                    // if(res[1].length!=0)
                    // {
                    // var response=res[1];
                    // alert(myJSON.length);
                    for (var i = 0 ; i <myJSON.length; i++) {

                        statusTextColor = (myJSON[i]['status']['color'] === '#ffffff') ? "#000000" : "#ffffff" ;

                        if(i==0)
                        {

                            showDetails1(myJSON[i]['id']);
                            html+= '<tr><td colspan="3" style="background: #fff;cursor: default;padding: 1px;"></td></tr><tr id="cadidate-'+myJSON[i]['id']+'" class="cus-cls color-active cus-cls-'+myJSON[i]['id']+' add-note" data-id="'+myJSON[i]['id']+'" onclick=showDetails1('+myJSON[i]['id']+')> <td><a class="add-click" href="javascript:void(0)" data-id="'+myJSON[i]['id']+' id="client-info-ajax">'+myJSON[i]['name']+'</a><ul class="custom-menu custom-menu-'+myJSON[i]['id']+'"><li><a href="{{route('client.dashboard')}}">Client Dashboard</a></li></ul></td><td><small>'+myJSON[i]['job_title']+'</small></td><td ><span data-id="'+myJSON[0]['status']['id']+'" class="status-span" id="candidate-id-'+myJSON[i]['id']+'" style="background-color: '+myJSON[i]['status']['color']+'!important; color: '+statusTextColor+';font-weight: bold">'+myJSON[i]['status']['name']+'</span></td><td><p class="add-cursor">'+myJSON[i]['city']+', '+myJSON[i]['state']+'</p></td> </tr>';
                        }else{
                            html+='<tr><td colspan="3" style="background: #fff;cursor: default;padding: 1px;"></td></tr><tr id="cadidate-'+myJSON[i]['id']+'" class="cus-cls cus-cls-'+myJSON[i]['id']+' add-note" data-id="'+myJSON[i]['id']+'" onclick=showDetails1('+myJSON[i]['id']+')> <td><a class="add-click" href="javascript:void(0)" data-id="'+myJSON[i]['id']+' id="client-info-ajax">'+myJSON[i]['name']+'</a><ul class="custom-menu custom-menu-'+myJSON[i]['id']+'"><li><a href="{{route('client.dashboard')}}">Client Dashboard</a></li></ul></td><td><small>'+myJSON[i]['job_title']+'</small></td><td ><span data-id="'+myJSON[0]['status']['id']+'" class="status-span" id="candidate-id-'+myJSON[i]['id']+'" style="background-color: '+myJSON[i]['status']['color']+'!important; color: '+statusTextColor+';font-weight: bold">'+myJSON[i]['status']['name']+'</span></td><td><p class="add-cursor">'+myJSON[i]['city']+',  '+myJSON[i]['state']+'</p></td> </tr>'
                        }
                        // html+=' <tr class="color-active"> <td class="add-note" data-id="'+myJSON[i]['id']+'"><h4 class="arrow"><a class="add-click" href="javascript:void(0)" onclick=showDetails1('+myJSON[i]['id']+') data-id="'+myJSON[i]['id']+' id="client-info-ajax">'+myJSON[i]['name']+'</a></h4><small>('+myJSON[i]['name']+')</small><p><strong>City/State:</strong> '+myJSON[i]['city']+'</p><ul class="custom-menu custom-menu-'+myJSON[i]['id']+'"><li data-action="first"><a data-toggle="modal" href="#exampleModal">Add Notes</a></li><li><a href="client-dashboard.html">Client Dashboard</a></li><li><a href="schedule-interview.html">Schedule Interview</a></li></ul> </td> </tr>';
                    }

                    if(html == "")
                    {
                        document.getElementById('htmlShow').innerHTML='<p>No Result Found</p>';
                        document.getElementById('show-one-client').innerHTML='<p>No Result Found</p>';
                        document.getElementById('button-for-div').innerHTML='<p></p>';

                    }else{
                        document.getElementById('htmlShow').innerHTML=html;
                    }

                    // }else{
                    //     document.getElementById('htmlShow').innerHTML='';
                    // }
                    // res.total=res[0];
                    // res.length=1;
                    // do something
                    // 请务必调用此方法，否则分页按钮不会刷新
                    refresh({
                        total: totalRe,// 可选
                        length: length // 可选
                    });
                }).fail(function(error){
                });
            }
        });
    }


    //note delete
    $(document).on('click', '.note-del', function(e) {
        // e.preventDefault();
        var id = $(this).attr('dataid');

        swal({

            title: "Are you sure",
            text: "Once deleted, you will not be able to recover this note!",
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
                            "noteId":id,

                        },

                        // dataType: 'json'
                    }).done(function(res){
                        $('#delete-id-'+id).remove();
                    });
                } else {
                    swal("Your note is safe!");
                }

            });
    });
//end delete note


    //edit note

    $(document).on('click', '.editNote', function(e) {
        // alert('123');

        id = $(this).attr('dataid');

        var text = $('#note-'+id).text() ;

        $('#node-edit-clas').text(text) ;

    });

    $(document).on('click', '#note-edit-submit', function(e) {

        var noteText = $('#node-edit-clas').val() ;
        $.ajax({
            url: "{{route('note.edit')}}",
            type: 'post',

            data:{

                "_token": "{{ csrf_token() }}",
                "noteId":id,
                "noteText": noteText,

            },

            // dataType: 'json'
        }).done(function(res){

            $('#note-'+id).text(noteText) ;

        });

    });


    //end edit note


    //update status
    $(document).on('click', '#update-status', function(e) {

        var option = $('#status-updated-slc option:selected') ;

        var opColor = $('#status-updated-slc option:selected').attr('color') ;

        var status = option.val() ;
        var statusText = option.text() ;


        if(statusText.toLowerCase() == 'otm')
        {
            $.ajax({
                url: "{{route('otm.remove.pipeline')}}",
                type: 'post',

                data:{

                    "_token": "{{ csrf_token() }}",
                    "candId": candId,

                },

                // dataType: 'json'
            }).done(function(res){

            });
        }


       // alert(statusText);
        // var color = option.css('background-color');

        //color = color.replace(')', ', 0.75)').replace('rgb', 'rgba');
        $.ajax({
            url: "{{route('update.status.ajax')}}",
            type: 'post',

            data:{

                "_token": "{{ csrf_token() }}",
                "status":status,
                "candId": candId,

            },

            // dataType: 'json'
        }).done(function(res){

             var textColor =  (opColor === "#ffffff") ? '#000000' : '#ffffff' ;

            $('#candidate-id-'+candId).text(statusText).css('background-color' , opColor) ;
            $('#candidate-id-'+candId).text(statusText).css('color' , textColor) ;
        });

    });
    //end update status




    // delete candiadte

    $(document).on('click', '.del-cand', function(e) {
        e.preventDefault();
        var id = $(this).attr('dataid');

        swal({

            title: "Are you sure",
            text: "Once deleted, you will not be able to recover this candidate!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "{{route('candidate.delete')}}",
                        type: 'post',

                        data:{

                            "_token": "{{ csrf_token() }}",
                            "candId":id,
                        },

                        // dataType: 'json'
                    }).done(function(res){
                        swal("Your candidate is successfully deleted!");

                        $('#cadidate-'+id).prev().remove();
                        $('#cadidate-'+id).remove();
                        $('#htmlShow tr:eq(1)').addClass('color-active');
                        // $('#show-one-client').empty();
                        // $('#button-for-div').empty();
                        showDetails1($('#htmlShow tr:eq(1)').attr('data-id'));

                    });

                } else {
                    swal("your candidate is safe!");
                }

            });
    });

    //end delete databse


    //to show advance search
    $('#mega-search').click(function () {
        $('.mega-search').show() ;
    });


</script>


@endsection