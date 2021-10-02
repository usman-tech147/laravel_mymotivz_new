@extends('admin.layouts.layouts')
@section('title', 'Candidate Education')
@section('content')

    <div class="app-main__inner">
        <div style="display: none;" class="exist">Education already exists</div>
        <div class="card-header-tab card-header">
            <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><i class="pe-7s-user mr-3 text-muted opacity-6" style="font-size: 35px; color: white !important;"> </i>Candidate Education</div>
        </div>
        <div class="tabs-animation">
            <div class="row">
                <div class="col-md-12">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Create New Education</label>
                                        <input id="education_name" name="name" type="text" class="form-control" placeholder="">
                                        <div class="error" style="display: none;">The field can't be empty</div>
                                    </div>
                                </div>
                                <div class="col-md-3"><button style="margin: 31px 0 0;" id="educationSubmit" type="button" class="btn btn-primary pull-left">Create Now</button></div>
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
                                    <tbody id="education-show">

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

                url: "{{route('education.list.ajax')}}",
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

                    if(json[i]['id'] == 1 || json[i]['id'] == 2 || json[i]['id'] == 3
                        || json[i]['id'] == 4 || json[i]['id'] == 5 || json[i]['id'] == 6
                        || json[i]['id'] == 7
                    )
                    {
                        statusHtml+= '<tr><td colspan="2" style="background: #fff;cursor: default;padding: 1px;"></td></tr><tr id="stts-row-'+json[i]['id']+'">\n' +
                            '                                    <td>'+index+'</td>\n' +
                            '                                    <td id="spanVal-'+json[i]['id']+'">'+json[i]['name']+'</td>\n' + '<td></td>\n' +
                            '                                </tr>' ;
                    }else{
                        statusHtml+= '<tr><td colspan="2" style="background: #fff;cursor: default;padding: 1px;"></td></tr><tr id="stts-row-'+json[i]['id']+'">\n' +
                            '                                    <td>'+index+'</td>\n' +
                            '                                    <td id="spanVal-'+json[i]['id']+'" >'+json[i]['name']+'</td>\n' +
                            '                                    <td><a data-toggle="modal" data-id="'+json[i]['id']+'" class="tag education-edit" href="#eduactionModal">Edit</a> <a data-id="'+json[i]['id']+'" class="tag stts-del" href="#">Delete</a>\n' +
                            '                                    </td>\n' +
                            '                                </tr>' ;
                    }


                }

                document.getElementById('education-show').innerHTML=statusHtml;
            });
        }

   $('#educationSubmit').click(function () {

    var educationName = $('#education_name').val() ;

    if(educationName != "")
    {
        $.ajax({

            url: "{{route('education.created')}}",
            type: 'post',

            data: {
                "_token": "{{ csrf_token() }}",
                "educationName": educationName,
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
$(document).on('click', '.education-edit', function() {

    id = $(this).attr('data-id')  ;

    var educationText = $('#spanVal-'+id).text() ;

    $('#e_name').val(educationText) ;


});


        $(document).on('click', '#update-education', function(e) {

            var eLetestName = $('#e_name').val();

            if (eLetestName != "") {

                $.ajax({
                    url: "{{route('education.edit')}}",
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
                        swal('Education already exists!') ;
                    }else{
                        $('#spanVal-' + id).text(eLetestName);
                    }
                });
            }else{
                swal("update failed! field can't be empty ") ;
            }
        }) ;

        // end edit status



        // delete education
        $(document).on('click', '.stts-del', function(e) {

            var educationId = $(this).attr('data-id') ;
            swal({

                title: "Are you sure",
                text: "Once deleted, you will not be able to recover this education!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: "{{route('education.delete')}}",
                            type: 'post',

                            data:{

                                "_token": "{{ csrf_token() }}",
                                "educationId":educationId,

                            },

                            // dataType: 'json'
                        }).done(function(res){
                                $('#stts-row-'+educationId).remove();

                        });
                    } else {
                        swal("Your education is safe!");
                    }

                });

        }) ;
        //end delete education



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
