@extends('admin.layouts.layouts')
@section('title', 'Job Database')
@section('content')
   @if(session()->has('clientEditMessage'))
        <div class="alert alert-success">
            {{ session()->get('clientEditMessage') }}
        </div>
    @endif
     @if(session()->has('delClientMessage'))
        <div class="alert alert-success">
            {{ session()->get('delClientMessage') }}
        </div>
    @endif

    @if(session()->has('piplinemessage'))
        <div class="alert alert-success">
            {{ session()->get('piplinemessage') }}
        </div>
    @endif
     @if(session()->has('removepipline'))
        <div class="alert alert-success">
            {{ session()->get('removepipline') }}
        </div>
    @endif
    <div class="app-main__inner">
                    <div class="card-header-tab card-header">
                        <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><i class="pe-7s-portfolio mr-3 text-muted opacity-6" style="font-size: 35px; color: #white !important;"> </i>Job Openings</div>
                    </div>
                    <div class="tabs-animation">                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card mb-3">
                                    <div class="card-body">
                                      <!-- <form action=""> -->
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="jobTitle" id="jobTitle" placeholder="Job Title">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <input type="text" class="form-control"  name="jobCity" id="jobCity" placeholder="City">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <input type="text" class="form-control"  name="jobState" id="jobState" placeholder="State">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <select id="selected-options-main-search-job-openinga" name="" class="form-control second-select multiselect-dropdown">
                                                        <option value=""></option>
                                                        @foreach($clientss as $client)
                                                            <option value="{{$client->id}}">{{$client->company_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <input type="text" class="form-control"  name="industry" id="industry" placeholder="Industry">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <button type="button" onclick="jobsFun(10)" class="btn btn-primary pull-left">SEARCH</button>
                                            </div>
                                        </div>
                                      <!-- </form> -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="card mb-3">
                                    <div class="row">
                                        <div class="col-md-7">
                                            <div class="card-header-tab card-header">
                                                <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><i class="pe-7s-note2 mr-3 text-muted opacity-6" style="font-size: 35px;"> </i>Jobs</div>
                                            </div>
                                            <div class="card-body candidate-scroll">
                                                <div class="table-responsive">
                                                    <span>Total Results: <strong id="no_result"></strong></span>

                                                    <table style="width: 100%;" class="candidate-list table table-hover table-striped table-bordered table-cursor">
                                                        <thead>
                                                            <tr>
                                                                <th>Job Title</th>
                                                                <th>Employers</th>
                                                                <th>Industry</th>
{{--                                                                <th>Location</th>--}}
                                                            </tr>
                                                        </thead>
                                                        <tbody id="html-job">
                                                       
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="card-header-tab card-header">
                                                <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><i class="pe-7s-notebook mr-3 text-muted opacity-6" style="font-size: 35px;"> </i>Job Details</div>
                                            </div>
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table id="table-data-ajax" class="table-detail table table-hover table-striped table-bordered">
                                                      
                                                    </table>
                                                   
                                                     <div id="buttons-job"></div>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box">
        <ul id="example-2" class="pagination"></ul>
        <div class="show"></div>
                            </div>


  <script type="text/javascript">
  
window.onload=jobsFun(10);
     function jobsFun(length) {
        // body...
        var html='';
        // alert('123');
        var name=$('#jobTitle').val();
        var state=$('#jobState').val();
        var city=$('#jobCity').val();
        var company = $('#selected-options-main-search-job-openinga option:selected').val() ;
        var industy = $('#industry').val() ;
        // alert(state);
        // alert(name);

 
    $('#example-2').pagination({
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
// alert('qwe');
// alert(stat)
var html='';
// alert('qwe');
        $.ajax({

            url: "{{route('jobs.ajax')}}",
            type: 'post',

            data:{
                current: options.current,
                length: options.length,
                 "_token": "{{ csrf_token() }}",
                 'name':name,
                 'state':state,
                 'city':city,
                'company':company,
                'industy':industy,

               
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
            var mjson = JSON.parse(res);
            var json= mjson[1];
            if(json!="") {
                var totalRe = mjson[0];

                for (var i = 0; i < json.length; i++) {
                    //{{url("admin/Job/Database/")}}/'+json[i]['id']+'
                    if (i == 0) {
                        showDetails1(json[i]['id']);
                    }
                    if(json[i]['client']!=undefined && json[i]['client']!='' && json[i]['client']!=null)
                    {
                        var comanyName=json[i]['client']['company_name'];
                    }else{
                        var comanyName='';
                    }

                    if(i === 0)
                    {
                        html += '   <tr><td colspan="3" style="background: #fff;cursor: default;padding: 1px;"></td></tr><tr class="add-note add-note-'+json[i]['id']+' color-active" id="job-del-' + json[i]['id'] + '" onclick=showDetails1(' + json[i]['id'] + ')><td><a class="job-arrow" href="javascript:void(0)"  data-id="' + json[i]['id'] + '" id="client-info-ajax" ><h4 class="bold-green">' + json[i]['jobtitle'] + '</h4></a><small><b>' + json[i]['city'] + ", "+'  ' + json[i]['state'] + '</b></small></td><td>' + comanyName + '</td><td><div class="add-cursor">' + json[i]['industry'] + '</div></td></td></tr>';
                    }else{
                        html += '   <tr><td colspan="3" style="background: #fff;cursor: default;padding: 1px;"></td></tr><tr class="add-note add-note-'+json[i]['id']+'" id="job-del-' + json[i]['id'] + '" onclick=showDetails1(' + json[i]['id'] + ')><td><a class="job-arrow" href="javascript:void(0)" data-id="' + json[i]['id'] + '" id="client-info-ajax" ><h4 class="bold-green">' + json[i]['jobtitle'] + '</h4></a><small><b>' + json[i]['city'] + ", "+'  ' + json[i]['state'] + '</b></small></td><td>' + comanyName + '</td><td><div class="add-cursor">' + json[i]['industry'] + '</div></td></tr>';
                    }
                   
                }
            }else{
                html="No Result Found";
                document.getElementById('table-data-ajax').innerHTML=html;
                document.getElementById('buttons-job').innerHTML='';
            }
            document.getElementById('html-job').innerHTML=html;
            document.getElementById('no_result').innerHTML=totalRe;
            refresh({
                total: totalRe,// 可选
                length: length // 可选
            });
        }).fail(function(error){
        });
    }
});
       }

     function showDetails1(id){
        // alert(id);

        $('.add-note').removeClass('color-active');
        $('.add-note-'+id).addClass('color-active');
        var html='';
        var html1='';
        var divNoteHtml='';
        $.ajax({

            url: "{{route('job-Details-Ajax')}}",
            type: 'post',

            data:{
                 "_token": "{{ csrf_token() }}",
                 "dataId":id,
               
            },
            beforeSend: function(){
                $.blockUI({ message: '<div class="spinner-grow text-success"></div><div class="spinner-grow text-success"></div><div class="spinner-grow text-success"></div>', css: {border:     'none',
                        backgroundColor:'transparent'} });
            },
            complete:function(data){
                $.unblockUI();
            }
            // dataType: 'json'
        }).done(function(response){
           // alert(response);
           // <tr><th>Expiry Date:</th><td>10/10/2019</td></tr>
            var json = JSON.parse(response);
            var job_date = new Date(json[0]['created_at']);
            var job_date_1 =(((job_date.getMonth() > 8) ? (job_date.getMonth() + 1) : ('0' + (job_date.getMonth() + 1))) + '/' + ((job_date.getDate() > 9) ? job_date.getDate() : ('0' + job_date.getDate())) + '/' + job_date.getFullYear());
            var admin_id = $('#admin_id').val();
            // alert(json);
        // console.log(json);
            if(json[0]['service'] == null)
            {
                var serviceEmpty = "";
            }else
            {
                serviceEmpty = json[0]['service'] ;
            }

            if(json[0]['web_url'] == null)
            {
                var webUrl = "";
            }else
            {
                webUrl = json[0]['web_url'] ;
            }




           html='  <tr><th>Posted Date:</th><td>'+job_date_1+'</td></tr><tr><th>Job Title:</th><td>'+json[0]['jobtitle']+'</td></tr><tr> <th>Employers:</th><td id="current_company_name">'+json[0]['client']['company_name']+'</td></tr> <tr><th>Location:</th><td>'+json[0]['city']+', '+json[0]['state']+'</td><tr><th>Website:</th><td>'+webUrl+'</td></tr><tr> <th>Compensation:</th><td>'+json[0]['package']+'</td> </tr><tr> <th>Industry:</th> <td>'+json[0]['industry']+'</td></tr><tr><th>service needed:</th> <td>'+serviceEmpty+'</td></tr> <tr> <th style="vertical-align: top;">Job Requirements:</th><td> <div class="job-requirements"> <P>'+json[0]['job_discription']+'</P></div></td></tr>';
           // alert(json[0]['pipeline'].length);
            if(json[0]['pipeline_id']==admin_id)
            {
                var buttonRecruiter='<a dataid="'+json[0]['id']+'" id="removeJobPipe"  class="tag" href="javascript:void(0)">Remove from pipeline</a>';
            }
            else{
                $('#form-id-job-pipline-id-field').val(json[0]['id']);
                var buttonRecruiter='<span id="remove"><a data-id="'+json[0]['id']+'" id="add-pipe" class="tag" href="javascript:void(0)" >Add to pipeline</a></span>';
            }
             html1=' <a class="tag" href="{{url("admin/job/edit/")}}/'+json[0]['id']+'">Edit</a>' +
                 '@can('delete', App\Job::class)<a dataid="'+json[0]['id']+'" class="tag job-del" href="javascript:void(0)">Delete</a>@endcan'
                 +buttonRecruiter+' ';
                document.getElementById('table-data-ajax').innerHTML=html;
                document.getElementById('buttons-job').innerHTML=html1;

        });

    }

     

$(document).on('click', '.job-del', function(e) {
    // e.preventDefault(); 

            var id = $(this).attr('dataid');

           swal({

              title: "Are you sure",
              text: "Once deleted, you will not be able to recover this job!",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {
                 $.ajax({
                            url: "{{route('job.delete')}}",
                            type: 'post',

                            data:{
                               
                                 "_token": "{{ csrf_token() }}",
                                  "jobId":id,
                               
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

                            // $('#job-del-'+id).prev().remove();
                            // $('#job-del-'+id).remove();
                            // $('#table-data-ajax').empty();
                            // $('#buttons-job').empty();
                     jobsFun(10);
                        });
              } else {
                swal("Your Job is safe!");
              }

        });
});

//for job delete..
$(document).on('click', '.del-swal', function(e) {
    e.preventDefault();
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
                    url: "{{route('client.delete')}}",
                    type: 'post',

                    data:{

                        "_token": "{{ csrf_token() }}",
                        "clientId":id,

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
                    $('#client-'+id).remove();
                    $('#show-one-client').empty();
                    $('#button-for-div').empty();

                });

            } else {
                swal("your client is safe!");
            }

        });
});


//end job delete


//add job form pipeline
$(document).on('click', '#add-pipe', function(e) {

    var id = $(this).attr('data-id');
    // alert(id);
    swal({

        title: "Are you sure",
        text: "you want to add this job to pipeline!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: "{{route('jobpipline.created')}}",
                    type: 'post',

                    data:{

                        "_token": "{{ csrf_token() }}",
                        "job_id":id,

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

                    // if($('#addClientpipe').text() === 'remove from pipeline')
                    // {
                    if (res=='fail')
                    {
                        swal('Job is Already in pipeline with another Employee');
                    }
                    else
                    {
                        swal('Job is successfully added to pipeline');
                        jobsFun(10);
                        $('#add-pipe').attr('href', 'javascript:void(0)');
                        $('#add-pipe').text('Remove from pipeline');
                        $('#add-pipe').attr("id","removeJobPipe");
                    }



                    // }
                    // else{
                    //     $('#addClientpipe').text('remove from pipeline');
                    //     $('#addClientpipe').attr("id","addClientpipe");
                    // }

                });

            } else {
                swal("Not added into pipeline!");
            }

        });

});
$(document).on('click', '#removeJobPipe', function(e) {
    e.preventDefault();

    var id = $(this).attr('dataId');

    swal({

        title: "Are you sure",
        text: "You want to remove it to pipeline!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: "{{route('job.removePiplinejobAjax')}}",
                    type: 'post',

                    data:{

                        "_token": "{{ csrf_token() }}",
                        "jobId":id,

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

                    //if($('#rmvClientPipe').text() === 'remove from pipeline')
                    {
                        $('#removeJobPipe').attr('href', '#pipelineModal');
                        $('#removeJobPipe').text('Add To Pipeline');
                        $('#removeJobPipe').attr("data-toggle","modal");
                        $('#removeJobPipe').attr("id","add-pipe");

                    }
                    // else{
                    //     $('#addClientpipe').text('remove from pipeline');
                    //     $('#addClientpipe').attr("id","addClientpipe");
                    // }

                });

            } else {
                swal("Not removed from pipeline!");
            }

        });
});
//end remove job from pipeline


//add job to pipeline
$(document).on("click","#job-pipe-sub",function(e) {
    e.preventDefault();

    var job_id = $('#form-id-job-pipline-id-field').val() ;
    var client_id = $('#client_name').val() ;
    var job_pipeline = $('#job-pipeline').val() ;

    $.ajax({

        url: "{{route('jobpipline.created')}}",
        type: 'post',

        data:{
            "_token": "{{ csrf_token() }}",
            "job_id":job_id,
            "client_id":client_id,
            "job_pipeline":job_pipeline,
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

        // $('#add-pipe').attr('href', '');
        // $('#add-pipe').text('Remove from pipeline');
        // $('#add-pipe').attr("id","removeJobPipe");
        if (res=='fail')
        {
            swal('Job is Already in pipeline with another Employee');
        }
        else
        {
            jobsFun(10);
        }

    });


});

//end add job to pipeline
</script>

@endsection
