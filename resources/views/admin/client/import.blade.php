@extends('admin.layouts.layouts')
@section('title', 'Client Import')
@section('content')
{{--    @if(session()->has('message'))--}}


        <div id="error_toaster" class="alert alert-danger custom-toster" style="display: none">

        </div>
{{--    @endif--}}
    @if(session()->has('file_upload'))
        <div class="alert alert-success">
            {{ session()->get('file_upload') }}
        </div>
    @endif
<div class="alert" style="box-shadow: unset; padding: 0px">
    @if(session()->has('file_error'))
        <div class="alert-redesign alert-success">
{{--            tfgujhrtfujy--}}
            {{ session()->get('file_error') }}
        </div>
    @endif
    @if(session()->has('file_error1'))
        <div class="alert-redesign alert-success">
{{--            sdfhdfg--}}
            {{ session()->get('file_error1') }}
        </div>
    @endif
</div>

    <div class="app-main__inner">
        <div class="card-header-tab card-header">
            <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><i class="pe-7s-user mr-3 text-muted opacity-6" style="font-size: 35px; color: white !important;"> </i>Import New Clients</div>
        </div>
        <div class="tabs-animation">
            <div class="row">
                <div class="col-md-12">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <a href="#client_sampleModal" data-toggle="modal" class="btn btn-primary pull-right">View Sample</a>

                            <a href="{{asset('assets')}}/sample_imports/client.xlsx" style="margin-right: 4px" target="_blank" class="btn btn-primary pull-right">Download Sample</a>

                            <form id="client-import" method="post" action="javascript:void(0)" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label >Excel File <small>(Record with duplicate emails will be skipped)</small></label>
                                            <div enctype="multipart/form-data">
                                                <input name="excel" id="file-upload-demo" type="file" >


                                            </div>
                                            <label id="file-upload-demo-error" class="error" for="file-upload-demo" style="display: none">Please select File</label>
                                        </div>
                                    </div>


                                </div>
                                <button type="button" id="import_client" class="btn btn-primary pull-right">Import Clients</button>
                                <div class="clearfix"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
$('#import_client').click(function () {
    var data = new FormData();
    var file = $( '#file-upload-demo' )[0].files[0];
    // console.log(file);
    if ($('#client-import').valid())
    {
        $('#file-upload-demo-error').hide();
        data.append("excel", file);
        // formData.append('file', file);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{route('clientimportsubmit')}}",
            type: 'post',
            processData: false,
            contentType: false,
            data:data,
            beforeSend: function(){
                $.blockUI({ message: '<div class="spinner-grow text-success"></div><div class="spinner-grow text-success"></div><div class="spinner-grow text-success"></div>', css: {border:     'none',
                        backgroundColor:'transparent'} });
            },
            complete:function(data){
                $.unblockUI();
            },
            // error : function (error) {
            //         // $('#error_toaster').text(error.responseText);
            //         // $('#error_toaster').show();
            //     console.log(error);
            //
            // },
            error: function (jqXHR, exception) {

                var msg = '';
                if (jqXHR.status === 0) {
                    msg = 'Not connect.\n Verify Network.';
                } else if (jqXHR.status == 404) {
                    msg = 'Invalid Request Please Try Again.';
                } else if (jqXHR.status == 500) {
                    msg = 'Your File contains Empty Columns';
                }  else if (exception === 'timeout') {
                    msg = 'Time out error.';
                } else {
                    msg = 'Error Please Try again.';
                    $('#error_toaster').text(msg);
                    $('#error_toaster').show();
                    setTimeout(function(){ location.reload(); }, 5000);
                }
                $('#error_toaster').text(msg);
                $('#error_toaster').show();
                // console.log(msg);
            },

        }).done(function(res){
            location.reload();
        });
    }
    else
    {
        $('#file-upload-demo-error').show();
    }
});
</script>
    @endsection
