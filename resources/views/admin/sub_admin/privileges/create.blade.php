@extends('admin.layouts.layouts')
@section('title', 'Admin Privileges')
@section('content')

    <div class="app-main__inner">
        <div style="display: none;" class="exist">Privilege already exists</div>
        <div class="card-header-tab card-header">
            <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><i class="pe-7s-user mr-3 text-muted opacity-6" style="font-size: 35px; color: white !important;"> </i>Sub Admin Privilege</div>
        </div>
        <div class="tabs-animation">
            <div class="row">
                <div class="col-md-12">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Create New Privilege</label>
                                        <input id="privilege_name" name="name" type="text" class="form-control" placeholder="">
                                        <div class="error" style="display: none;">The field can't be empty</div>
                                    </div>
                                </div>
                                <div class="col-md-3"><button style="margin: 31px 0 0;" id="privilegeSubmit" type="button" class="btn btn-primary pull-left">Create Now</button></div>
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
                                        <th>Name</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody id="privilege-show">

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
{{----}}
        window.onload = status() ;

        function status() {
            // alert('123');
            var html='';

            $.ajax({

                url: "{{route('privilege.list.ajax')}}",
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
                for (let i=0 ; i<json.length ; i++)
                {
                    //index for number th
                    index++ ;
                   {
                        statusHtml+= '<tr><td colspan="2" style="background: #fff;cursor: default;padding: 1px;"></td></tr><tr id="stts-row-'+json[i]['id']+'">\n' +
                            '                                    <td>'+index+'</td>\n' +
                            '                                    <td id="spanVal-'+json[i]['id']+'" >'+json[i]['name']+'</td>\n' +
                            '                                    <td><a data-toggle="modal" data-id="'+json[i]['id']+'" class="tag privilege-edit" href="#privilegeModal">Edit</a> <a data-id="'+json[i]['id']+'" class="tag stts-del" href="#">Delete</a>\n' +
                            '                                    </td>\n' +
                            '                                </tr>' ;
                    }


                }

                document.getElementById('privilege-show').innerHTML=statusHtml;
            });
        }

   $('#privilegeSubmit').click(function () {

    var privilegeName = $('#privilege_name').val() ;

    if(privilegeName != "")
    {
        $.ajax({

            url: "{{route('privilege.created')}}",
            type: 'post',

            data: {
                "_token": "{{ csrf_token() }}",
                "privilegeName": privilegeName,
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
            $('#privilege_name').val('') ;

        });
    }else{
        $('.error').show() ;
        setTimeout( function(){$('.error').hide();} , 4000);
    }


}) ;


// edit status
$(document).on('click', '.privilege-edit', function() {

    id = $(this).attr('data-id')  ;

    var privilegeText = $('#spanVal-'+id).text() ;

    $('#p_name').val(privilegeText) ;


});


        $(document).on('click', '#update-privilege', function(e) {

            var eLetestName = $('#p_name').val();
// alert('here');
            if (eLetestName != "") {

                $.ajax({
                    url: "{{route('privilege.edit')}}",
                    type: 'post',

                    data: {

                        "_token": "{{ csrf_token() }}",
                        "id": id,
                        "eLetestName": eLetestName,


                    },

                    // dataType: 'json'
                }).done(function (res) {

                    if(res === 'true')
                    {
                        swal('Privilege already exists!') ;
                    }else{
                        $('#spanVal-' + id).text(eLetestName);
                    }
                });
            }else{
                swal("update failed! field can't be empty ") ;
            }
        }) ;

        // end edit status



        // delete privilege
        $(document).on('click', '.stts-del', function(e) {

            var privilegeId = $(this).attr('data-id') ;
            swal({

                title: "Are you sure",
                text: "Once deleted, you will not be able to recover this privilege!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: "{{route('privilege.delete')}}",
                            type: 'post',

                            data:{

                                "_token": "{{ csrf_token() }}",
                                "privilegeId":privilegeId,

                            },

                            // dataType: 'json'
                        }).done(function(res){
                                $('#stts-row-'+privilegeId).remove();

                        });
                    } else {
                        swal("Your privilege is safe!");
                    }

                });

        }) ;
        //end delete privilege



    {{--    //reminder for status--}}
    {{--    $(document).on('change', '.reminder-status', function(e) {--}}

    {{--        var id = $(this).attr('data-id')  ;--}}
    {{--        var reminderVal = $('option:selected',this).attr('value');--}}

    {{--        $.ajax({--}}

    {{--            url: "{{route('status.reminder.ajax')}}",--}}
    {{--            type: "post" ,--}}

    {{--            data: {--}}
    {{--                '_token':'{{csrf_token()}}',--}}
    {{--                'status_id':id,--}}
    {{--                'reminderVal':reminderVal,--}}
    {{--            }--}}

    {{--        }).done(function (res) {--}}
    {{--            status() ;--}}
    {{--            swal("status updated successfully") ;--}}
    {{--        });--}}

    {{--    }) ;--}}
    {{--    //end reminder for status--}}

    </script>


@endsection
