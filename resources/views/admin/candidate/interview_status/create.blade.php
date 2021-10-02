@extends('admin.layouts.layouts')

@section('content')
    <div class="app-main__inner">
        <div style="display: none;" class="exist">Interview status already exist</div>
        <div class="card-header-tab card-header">
            <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><i class="pe-7s-user mr-3 text-muted opacity-6" style="font-size: 35px; color: #4d9a10 !important;"> </i>Interview Status</div>
        </div>
        <div class="tabs-animation">
            <div class="row">
                <div class="col-md-12">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Create New Interview Status</label>
                                        <input id="status_name" name="name" type="text" class="form-control" placeholder="">
                                        <div class="error" style="display: none;">The field can't be empty</div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Select Interview status Background Color</label>
                                        <input id="status_color" name="color" type="color" class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-12"><button id="statusSubmit" type="button" class="btn btn-primary pull-left">Create Now</button></div>
                            </div>
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
                                        <th>Status</th>
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

        window.onload = status() ;

        function status() {
            // alert('123');
            var html='';
            var statusHtml = "" ;
            var statusTextColor = "" ;
            var index = 0 ;

            $.ajax({

                url: "{{route('interviewStatus')}}",
                type: 'get',

                {{--data:{--}}
                {{--    data: { client_id:client_id, note_des:note_des },--}}
                {{--    "_token": "{{ csrf_token() }}",--}}
                {{--},--}}

                // dataType: 'json'
            }).done(function(res){
                var json = JSON.parse(res) ;

                //
                var daily='';
                var weekly='';
                var monthly='';
                var index = 0 ;
                for (let i=0 ; i<json.length ; i++)
                {
                    index++ ;

                    statusTextColor = (json[i]['color'] === "#ffffff") ? '#000000' : '#ffffff' ;

                    statusHtml+= '<tr id="stts-row-'+json[i]['id']+'">\n' +
                        '                                    <td>'+index+'</td>\n' +
                        '                                    <td id="spanVal-'+json[i]['id']+'" style="color: '+statusTextColor+'; background-color: '+json[i]['color']+';text-align: center;">'+json[i]['name']+'</td>\n' +
                        '                                    <td><a data-toggle="modal" data-id="'+json[i]['id']+'" class="tag status-edit" href="#updateInterviewStatusModel">Edit</a> <a data-id="'+json[i]['id']+'" class="tag stts-del" href="javascript:void(0)">Delete</a>\n' +
                        '                                    </td>\n' +
                        '                                </tr><td colspan="3" style="background: #fff;cursor: default;padding: 1px;"></td></tr>' ;


                }

                console.log(statusHtml) ;
                document.getElementById('status-show').innerHTML= statusHtml ;
            });
        }

        $('#statusSubmit').click(function () {

            var statusName = $('#status_name').val() ;
            var statusColor = $('#status_color').val() ;

            if(statusName != "")
            {
                $.ajax({

                    url: "{{route('interview.status.create')}}",
                    type: 'post',

                    data: {
                        "_token": "{{ csrf_token() }}",
                        "statusName": statusName,
                        "statusColor": statusColor,
                    },

                    // dataType: 'json'
                }).done(function (res) {

                    if(res === 'true')
                    {
                        $('.exist').show() ;
                        setTimeout( function(){$('.exist').hide();} , 4000);
                    }else{
                        status() ;
                    }

                });
            }else{
                $('.error').show() ;
                setTimeout( function(){$('.error').hide();} , 4000);
            }


        }) ;


        // edit status
        $(document).on('click', '.status-edit', function() {

            id = $(this).attr('data-id')  ;

            var statusText = $('#spanVal-'+id).text() ;
            var statusColor = $('#spanVal-'+id).css('background-color') ;

            function rgb2hex(rgb) {
                var hexDigits = ["0","1","2","3","4","5","6","7","8","9","a","b","c","d","e","f"];
                rgb = rgb.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
                function hex(x) {
                    return isNaN(x) ? "00" : hexDigits[(x - x % 16) / 16] + hexDigits[x % 16];
                }
                return "#" + hex(rgb[1]) + hex(rgb[2]) + hex(rgb[3]);
            }

            var hexColor = rgb2hex(statusColor) ;

            $('#s_name_2').val(statusText);
            $('#s_color_2').val(hexColor) ;

        });


        $(document).on('click', '#model-interview-status-update', function(e) {

            var sLetestName = $('#s_name_2').val();
            var sLetestColor = $('#s_color_2').val();
            if (sLetestName != "") {

                $.ajax({
                    url: "{{route('interview.Status.update')}}",
                    type: 'post',

                    data: {

                        "_token": "{{ csrf_token() }}",
                        "id": id,
                        "statusText": sLetestName,
                        "statusColor": sLetestColor,

                    },

                    // dataType: 'json'
                }).done(function (res) {

                    if(res === 'true')
                    {
                        swal('Status already exists!') ;
                    }else{

                        if(sLetestColor === "#000000")
                        {
                            $('#spanVal-' + id).text(sLetestName).css('color', "#ffffff");
                        }else{
                            $('#spanVal-' + id).text(sLetestName).css('color', "#000000");
                        }

                        $('#spanVal-' + id).text(sLetestName).css('background-color', sLetestColor);
                    }
                });
            }else{
                swal("update failed! field can't be empty ") ;
            }
        }) ;

        // end edit status



        // delete status
        $(document).on('click', '.stts-del', function(e) {

            var statusId = $(this).attr('data-id') ;
            swal({

                title: "Are you sure",
                text: "Once deleted, you will not be able to recover this Interview status!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: "{{route('interview.Status.delete')}}",
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
                        swal("Your interview status is safe!");
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