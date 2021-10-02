@extends('admin.layouts.layouts')
@section('title', 'Todo Actions')
@section('content')

<div class="app-main__inner">
    <div style="display: none;" class="exist">action already exist</div>
    <div class="card-header-tab card-header">
        <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><i class="pe-7s-user mr-3 text-muted opacity-6" style="font-size: 35px; color: white !important;"> </i>Actions</div>
    </div>
    <div class="tabs-animation">
        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                            <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Create New Action</label>
                                            <input id="action_name" name="name" type="text" class="form-control" placeholder="">
                                            <div class="error" style="display: none;">Action name cannot be empty</div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Select action Background Color</label>
                                            <input id="action_color" name="color" type="color" class="form-control" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-md-4"><button id="actionSubmit" style="margin: 31px 0 0;" type="button" class="btn btn-primary pull-left">Create Now</button></div>
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
                                <tbody id="action-show">

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

    window.onload = action() ;

    function action() {
            var html='';

            $.ajax({
                url: "{{route('todoactionslist')}}",
                type: 'get',
            }).done(function(res){
                var json = JSON.parse(res) ;
                var actionHtml = "" ;
                var index = 0 ;
                var actionTextColor = "" ;
                 for (let i=0 ; i<json.length ; i++)
                 {
                                index++ ;
                                   actionTextColor = (json[i]['color'] === "#ffffff") ? '#000000' : '#ffffff' ;
                                   actionHtml+= '<td colspan="3" style="background: #fff;cursor: default;padding: 1px;"></td></tr><tr id="stts-row-'+json[i]['id']+'">\n' +
                                       '<td>'+index+'</td>\n' +
                                       '<td><span class="status" id="spanVal-'+json[i]['id']+'" style="color: '+actionTextColor+'; background-color: '+json[i]['color']+';text-align: center;"><small>'+json[i]['name']+'</small></span></td>\n' +
                                       '<td><a data-toggle="modal" data-id="'+json[i]['id']+'" class="tag action-edit" href="#updateActionModel">Edit</a> ' +
                                       '<a data-id="'+json[i]['id']+'" class="tag action-del" href="javascript:void(0)">Delete</a>\n' +
                                       '</td>\n' +
                                       '</tr>' ;


                 }

                document.getElementById('action-show').innerHTML=actionHtml;
        });
    }

    $('#actionSubmit').click(function () {

        var actionName = $('#action_name').val() ;
        var actionColor = $('#action_color').val() ;
        $('#action_name').val('') ;
        $('#action_color').val('') ;
        if(actionName != "")
        {
            $.ajax({

                url: "{{route('createdaction')}}",
                type: 'post',

                data: {
                    "_token": "{{ csrf_token() }}",
                    "Name": actionName,
                    "Color": actionColor,
                },

                // dataType: 'json'
            }).done(function (res) {

                if(res === 'true')
                {
                    $('.exist').show() ;
                    setTimeout( function(){$('.exist').hide();} , 4000);
                }else{
                    action() ;
                }

            });
        }else{
            $('.error').show() ;
            setTimeout( function(){$('.error').hide();} , 4000);
        }


    }) ;


    // edit action
    $(document).on('click', '.action-edit', function() {

        id = $(this).attr('data-id')  ;

      var actionText = $('#spanVal-'+id).text() ;

      var actionColor = $('#spanVal-'+id).css('background-color') ;

        function rgb2hex(rgb) {
            var hexDigits = ["0","1","2","3","4","5","6","7","8","9","a","b","c","d","e","f"];
            rgb = rgb.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
            function hex(x) {
                return isNaN(x) ? "00" : hexDigits[(x - x % 16) / 16] + hexDigits[x % 16];
            }
            return "#" + hex(rgb[1]) + hex(rgb[2]) + hex(rgb[3]);
        }

        var hexColor = rgb2hex(actionColor) ;
          $('#action_update_name').val(actionText) ;
          $('#action_update_color').val(hexColor) ;

    });


    $(document).on('click', '#model-action-update', function(e) {

        var sLetestName = $('#action_update_name').val();
        var sLetestColor = $('#action_update_color').val();
        if (sLetestName != "") {

        $.ajax({
            url: "{{route('updateaction')}}",
            type: 'post',

            data: {

                "_token": "{{ csrf_token() }}",
                "id": id,
                "Text": sLetestName,
                "Color": sLetestColor,

            },

            // dataType: 'json'
        }).done(function (res) {

            if(res === 'true')
                {
                    swal('Action already exists!') ;
                }else{
                    if(sLetestColor === "#ffffff")
                    {
                        $('#spanVal-' + id).html('<small>'+sLetestName+'</small>');
                        $('#spanVal-' + id).css('color', "#000000");

                    }else{
                        $('#spanVal-' + id).html('<small>'+sLetestName+'</small>');
                        $('#spanVal-' + id).css('color', "#ffffff");
                    }
                    $('#spanVal-' + id).html('<small>'+sLetestName+'</small>');
                    $('#spanVal-' + id).css('background-color', sLetestColor);
                }
        });
    }else{
            swal("update failed! field can't be empty ") ;
        }
    }) ;

    // end edit action



    // delete action
    $(document).on('click', '.action-del', function(e) {

        var actionId = $(this).attr('data-id') ;
        swal({

            title: "Are you sure",
            text: "Once deleted, you will not be able to recover this action!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "{{route('deleteaction')}}",
                        type: 'post',

                        data:{

                            "_token": "{{ csrf_token() }}",
                            "actionId":actionId,

                        },

                        // dataType: 'json'
                    }).done(function(res){

                        if(res === 'true')
                        {
                            swal("This action cannot be deleted as it is assigned to one or more candidates. Please remove this action from all candidates to delete it.");
                        }else{
                            $('#stts-row-'+actionId).prev().remove();
                            $('#stts-row-'+actionId).remove();
                        }

                    });
                } else {
                    swal("Your action is safe!");
                }

            });

    }) ;
    //end delete action



    //reminder for action

    //end reminder for action

</script>


@endsection
