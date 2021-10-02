@extends('admin.layouts.layouts')
@section('title', 'Candidate Import')
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
    @if(session()->has('file_error3'))
    <div class="alert-redesign alert-success">

        {{ session()->get('file_error3') }}
    </div>
    @endif
    @if(session()->has('file_error4'))
    <div class="alert-redesign alert-success">

        {{ session()->get('file_error4') }}
    </div>
    @endif
</div>
    <div class="app-main__inner">
        <div class="card-header-tab card-header">
            <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><i class="pe-7s-user mr-3 text-muted opacity-6" style="font-size: 35px; color: white !important;"> </i>Import New Candidates</div>
        </div>
        <div class="tabs-animation">
            <div class="row">
                <div class="col-md-12">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <a href="#candidate_sampleModal" data-toggle="modal" class="btn btn-primary pull-right">View Sample</a>
                            <a href="{{asset('assets')}}/sample_imports/candidate.xlsx" target="_blank" style="margin-right: 4px" class="btn btn-primary pull-right">Download Sample</a>

                            <form id="candidate-import" method="post" action="javascript:void(0)" enctype="multipart/form-data">
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
                                <button type="button" id="import_candidate" class="btn btn-primary pull-right">Import Candidates</button>
                                <div class="clearfix"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
$('#import_candidate').click(function () {
    var data = new FormData();
    var file = $( '#file-upload-demo' )[0].files[0];
    console.log($('#candidate-import').valid());
    if ($('#candidate-import').valid())
    {
        $('#file-upload-demo-error').hide();
        data.append("excel", file);
        // formData.append('file', file);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{route('new.candidateimportsubmit')}}",
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
            },

        }).done(function(res){
            // console.log(res);
            // console.log("restart");

            // alert(res)
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
