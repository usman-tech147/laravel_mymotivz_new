@extends('admin.layouts.layouts')
@section('title', 'Candidate Status')
@section('content')
    @if(session()->has('status_exist'))
        <div class="alert alert-danger custom-toster">
            {{ session()->get('status_exist') }}
        </div>
    @endif
    @if(session()->has('status_success'))
        <div class="alert alert-success custom-toster">
            {{ session()->get('status_success') }}
        </div>
    @endif
<div class="app-main__inner">
    <div style="display: none;" class="exist">Status already exist</div>
    <div class="card-header-tab card-header">
        <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><i class="pe-7s-user mr-3 text-muted opacity-6" style="font-size: 35px; color: white !important;"> </i>Candidate Status</div>
    </div>
    <div class="tabs-animation">
        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <form method="post" action="{{route('status.created')}}" id="status_create_form" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label class="optional">Status Icon</label>
                                        <div enctype="multipart/form-data">
                                            <input name="status_icon" id="file-upload-demo" type="file">
                                            @error('status_icon')
                                            <div class="error">{{ $message }}</div>
                                            @enderror

                                        </div>
                                        <label id="file-upload-demo-error" class="error" for="file-upload-demo" style="display: none">Please select Status icon</label>

                                    </div>
                                </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Create New Status</label>
                                            <input id="status_name" name="name" type="text" class="form-control" placeholder="">
                                            <div class="error" style="display: none;">The field can't be empty</div>
                                        </div>
                                    </div>
                                <div class="col-md-3"><button style="margin: 31px 0px 0px" id="statusSubmit" type="button" class="btn btn-primary pull-left">Create Now</button></div>

                                {{--                                    </div>--}}
{{--                                <div class="row">--}}

                                </div>
                        </form>


                            <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table style="width: 100%;"  class="table table-hover table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Status name</th>
                                    <th style="width: 70px;">Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody id="status-show">

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
    $(document).ready(function () {

    });

    window.onload = status() ;

    function status() {
            // alert('123');
            var html='';

            $.ajax({

                url: "{{route('status.ajax')}}",
                type: 'get',

                {{--data:{--}}
                {{--    data: { client_id:client_id, note_des:note_des },--}}
                {{--    "_token": "{{ csrf_token() }}",--}}
                {{--},--}}

                // dataType: 'json'
            }).done(function(res){
                var json = JSON.parse(res) ;
                var statusHtml = "" ;
                var daily='';
                var weekly='';
                var monthly='';
                var index = 0 ;
                var statusTextColor = "" ;
                 for (let i=0 ; i<json.length ; i++)
                 {
                                //index for number th
                                index++ ;
                                if(json[i]['reminder']=='Daily')
                                {
                                     daily="selected";
                                }else
                                {
                                    daily="";
                                }
                                if(json[i]['reminder']=='Monthly')
                                {
                                    monthly="selected";
                                }else{
                                    monthly="";
                                }
                                    if(json[i]['reminder']=='Weekly')
                                {
                                    weekly="selected";
                                }else{
                                        weekly="";
                                    }

                                   statusTextColor = (json[i]['color'] === "#ffffff") ? '#000000' : '#ffffff' ;

                                   statusHtml+= '<td colspan="3" style="background: #fff;cursor: default;padding: 1px;"></td></tr><tr id="stts-row-'+json[i]['id']+'">\n' +
                                       '                                    <td>'+index+'</td>\n' +
                                       '                                    <td ><strong id="spanVal-'+json[i]['id']+'" style="text-align: center;">'+json[i]['name']+'</strong></td>\n' +
                                       '                                    <td ><img id="stt_icon-'+json[i]['id']+'" width="50px" height="50px" src="'+window.location.origin+'/status_icons/'+json[i]['status_icon']+'"></td>\n' +
                                       '                                    <td><a data-toggle="modal" data-id="'+json[i]['id']+'" class="tag status-edit" href="#updateStatusModel">Edit</a> \n' +
                                       '                                        <select data-id="'+json[i]['id']+'" class="reminder-status">\n' +
                                       // <a data-id="'+json[i]['id']+'" class="tag stts-del" href="javascript:void(0)">Delete</a>
                                       '                                            <option   value="">Reminder</option>\n' +
                                       '                                            <option  '+daily+' value="Daily">Daily</option>\n' +
                                       '                                            <option  '+weekly+' value="Weekly">Weekly</option>\n' +
                                       '                                            <option '+monthly+' value="Monthly">Monthly</option>\n' +
                                       '                                        </select>\n' +
                                       '                                    </td>\n' +
                                       '                                </tr>' ;
                                   //
                                   // statusHtml+= '<td colspan="3" style="background: #fff;cursor: default;padding: 1px;"></td></tr><tr id="stts-row-'+json[i]['id']+'">\n' +
                                   //     '                                    <td>'+index+'</td>\n' +
                                   //     '                                    <td ><span class="status" id="spanVal-'+json[i]['id']+'" style="color: '+statusTextColor+'; background-color: '+json[i]['color']+';text-align: center;"><small>'+json[i]['name']+'</small></span></td>\n' +
                                   //     '                                    <td><a data-toggle="modal" data-id="'+json[i]['id']+'" class="tag status-edit" href="#updateStatusModel">Edit</a> \n' +
                                   //     '                                        <select data-id="'+json[i]['id']+'" class="reminder-status">\n' +
                                   //     // <a data-id="'+json[i]['id']+'" class="tag stts-del" href="javascript:void(0)">Delete</a>
                                   //     '                                            <option   value="">Reminder</option>\n' +
                                   //     '                                            <option  '+daily+' value="Daily">Daily</option>\n' +
                                   //     '                                            <option  '+weekly+' value="Weekly">Weekly</option>\n' +
                                   //     '                                            <option '+monthly+' value="Monthly">Monthly</option>\n' +
                                   //     '                                        </select>\n' +
                                   //     '                                    </td>\n' +
                                   //     '                                </tr>' ;


                 }

                document.getElementById('status-show').innerHTML=statusHtml;
        });
    }

    $('#statusSubmit').click(function () {



        if ($('#status_create_form').valid())
        {
            $('#status_create_form').submit()
        }

        {{--var statusName = $('#status_name').val() ;--}}
        {{--var statusColor = $('#status_color').val() ;--}}

        {{--if(statusName != "")--}}
        {{--{--}}
        {{--    $.ajax({--}}

        {{--        url: "{{route('status.created')}}",--}}
        {{--        type: 'post',--}}

        {{--        data: {--}}
        {{--            "_token": "{{ csrf_token() }}",--}}
        {{--            "statusName": statusName,--}}
        {{--            "statusColor": statusColor,--}}
        {{--        },--}}

        {{--        // dataType: 'json'--}}
        {{--    }).done(function (res) {--}}

        {{--        if(res === 'true')--}}
        {{--        {--}}
        {{--            $('.exist').show() ;--}}
        {{--            setTimeout( function(){$('.exist').hide();} , 4000);--}}
        {{--        }else{--}}
        {{--            status() ;--}}
        {{--        }--}}

        {{--    });--}}
        {{--}else{--}}
        {{--    $('.error').show() ;--}}
        {{--    setTimeout( function(){$('.error').hide();} , 4000);--}}
        {{--}--}}


    }) ;


    // edit status
    $(document).on('click', '.status-edit', function() {
        id = $(this).attr('data-id')  ;

        var icon = $('#stt_icon-'+id).attr('src');
        $('#update_status_icon').attr('src',icon);


      var statusText = $('#spanVal-'+id).text() ;
      // var statusColor = $('#spanVal-'+id).css('background-color') ;

        function rgb2hex(rgb) {
            var hexDigits = ["0","1","2","3","4","5","6","7","8","9","a","b","c","d","e","f"];
            rgb = rgb.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
            function hex(x) {
                return isNaN(x) ? "00" : hexDigits[(x - x % 16) / 16] + hexDigits[x % 16];
            }
            return "#" + hex(rgb[1]) + hex(rgb[2]) + hex(rgb[3]);
        }

        // var hexColor = rgb2hex(statusColor) ;


          $('#s_name').val(statusText) ;
          $('#status_id').val(id) ;
          // $('#s_color').val(hexColor) ;

    });


    $(document).on('click', '#model-stts-update', function(e) {

        if ($('#update_status_form').valid())
        {
            $('#update_status_form').submit()
        }
    }) ;

    // end edit status



    // delete status
    $(document).on('click', '.stts-del', function(e) {

        var statusId = $(this).attr('data-id') ;
        swal({

            title: "Are you sure",
            text: "Once deleted, you will not be able to recover this status!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "{{route('status.delete.ajax')}}",
                        type: 'post',

                        data:{

                            "_token": "{{ csrf_token() }}",
                            "statusId":statusId,

                        },

                        // dataType: 'json'
                    }).done(function(res){

                        if(res === 'true')
                        {
                            swal("This status cannot be deleted as it is assigned to one or more candidates. Please remove this status from all candidates to delete it.");
                        }else{
                            $('#stts-row-'+statusId).remove();
                        }

                    });
                } else {
                    swal("Your status is safe!");
                }

            });

    }) ;
    //end delete status



    //reminder for status
    $(document).on('change', '.reminder-status', function(e) {

        var id = $(this).attr('data-id')  ;
        var reminderVal = $('option:selected',this).attr('value');

        $.ajax({

           url: "{{route('status.reminder.ajax')}}",
           type: "post" ,

            data: {
               '_token':'{{csrf_token()}}',
               'status_id':id,
               'reminderVal':reminderVal,
            }

        }).done(function (res) {
            status() ;
            swal("status updated successfully") ;
        });

    }) ;
    //end reminder for status

</script>


@endsection
