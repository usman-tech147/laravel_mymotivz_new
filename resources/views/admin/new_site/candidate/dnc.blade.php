@extends('admin.layouts.layouts')
@section('title', 'DNC Candidates')
@section('content')

    <div class="app-main__inner">
    <div class="card-header-tab card-header">
        <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><i class="pe-7s-file mr-3 text-muted opacity-6" style="font-size: 35px; color: white !important;"> </i>DNC Candidates</div>
    </div>
    <div class="tabs-animation">
        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <div class="table-responsive otm table-otm">
{{--                            <table style="width: 100%;" id="candidate-otm" class="table table-bordered">--}}
                            <table style="width: 100%;" id="example" class="table table-hover table-striped table-bordered dataTable dtr-inline">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>City</th>
                                    <th>State</th>
                                    <th>Desired Salary</th>
                                    <th class="table-width">Interest</th>
                                    <th>Job Tile</th>
                                    <th>Industry</th>
                                    <th style="width: 70px !important;display: none;padding: 0;vertical-align: middle;text-align: center;">Status</th>
                                    <th>Date Logged</th>
                                </tr>
                                </thead>
                                <tbody id="candidate-otm">


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

    window.onload=otmCandidates(10) ;

    $(document).on('change', '.custom-select', function() {

        var limitData = $('.custom-select option:selected').text() ;
        otmCandidates(limitData) ;
    });

    function otmCandidates(len) {

        $.ajax({

            url: "{{route('candidate.dnc.ajax')}}",
            type: 'post',

            data:{
                "_token": "{{ csrf_token() }}",
                "len":len,
            },

            // dataType: 'json'
        }).done(function(res){
            var json = JSON.parse(res)
            var html="";
            for (let i=0;i<json.length;i++)
            {
                var date = new Date(json[i]['created_at']);
                var newDate=(((date.getMonth() > 8) ? (date.getMonth() + 1) : ('0' + (date.getMonth() + 1))) + '/' + ((date.getDate() > 9) ? date.getDate() : ('0' + date.getDate())) + '/' + date.getFullYear());
                html+= '<tr class="add-note" data-id="'+json[i]['id']+'">\n' +
'                               <td>'+json[i]['name']+'\n' +
'                               <ul class="custom-menu custom-menu-'+json[i]['id']+'">\n' +
'                               <li><a href="{{url('admin/candidate/OTM/detail/')}}/'+json[i]['id']+'">Candidate Details</a></li>\n' +
'                               <li><a data-id="'+json[i]['id']+'" href="#statusModal" data-toggle="modal">Remove From OTM</a></li>\n' +
'                               </ul>\n' +
'                               </td>\n' +
'                               <td>'+json[i]['city']+'</td>\n' +
'                               <td>'+json[i]['state']+'</td>\n' +
'                               <td>'+json[i]['salary']+'</td>\n' +
'                               <td class="table-width"><small class="borders"><img src="'+window.location.origin+'/assets/images/checkicon.png" alt="">'+json[i]['interest'].split(",").join("</small><small class='borders'><img src='"+window.location.origin+"/assets/images/checkicon.png' alt=''>")+'</small></td>\n' +
'                               <td>'+json[i]['job_title']+'</td>\n' +
'                               <td><small class="borders">'+json[i]['Industry'].split(",").join("</small><small class='borders'><img src='"+window.location.origin+"/assets/images/checkicon.png' alt=''>")+'</small></td>\n' +
                    '<td ><img width="50px" height="50px" src="'+window.location.origin+'/status_icons/'+json[i]['status']['status_icon']+'"></td>\n' +
'                               <td>'+newDate+'</td>\n' +
                      '</tr>';
            }

            document.getElementById('candidate-otm').innerHTML = html ;
        })
    }




    // update status for otm candiate
    $(document).on('click', '.otm-change', function(e) {

         id = $(this).attr('data-id') ;

    });

    $(document).on('click', '#update-status', function(e) {

        var option = $('#status-updated-slc option:selected') ;

        var status = option.val() ;

        // alert(statusText);
        // var color = option.css('background-color');

        //color = color.replace(')', ', 0.75)').replace('rgb', 'rgba');
        $.ajax({
            url: "{{route('update.status.ajax')}}",
            type: 'post',

            data:{

                "_token": "{{ csrf_token() }}",
                "status":status,
                "candId": id,

            },

            // dataType: 'json'
        }).done(function(res){

            if(res !== 'true')
            {
                $('.add-note[data-id="'+id+'"]').remove();
            }
        });

    });
    //end update status for otm candidate

</script>

@endsection
