@extends('admin.layouts.layouts')
@section('title', 'All Contracts')
@section('content')

  <div class="app-main__inner">
                    <div class="card-header-tab card-header">
                        <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><i class="pe-7s-wallet mr-3 text-muted opacity-6" style="font-size: 35px; color: white !important;"> </i>All Contracts</div>
                    </div>
                    <div class="tabs-animation">

{{--                        <div class="row">--}}
{{--                            @if ($errors->any())--}}
{{--                                {{$errors}}--}}
{{--                            @endif--}}
{{--                        </div>--}}
                       <input type="hidden" id="contract_session" value="@if(session()->has('contract_session')) {{session('contract_session')}}  <?php session()->forget('contract_session') ?> @else 0 @endif">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="card mb-3">
                                    <div class="card-body">
                                      <form action="">
                                        <ul class="search-form">
                                          <li>
{{--                                            <label>Contract</label>--}}
                                              <select  id="search_contract_clients" name="" class="form-control second-select multiselect-dropdown">


                                              </select>
                                          </li>
                                          <li><button type="button" id="search_client_contract" class="btn btn-primary pull-left">Search</button></li>
                                        </ul>
                                      </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card mb-3">
                                    <div class="card-header-tab card-header">
                                        <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><i class="pe-7s-users mr-3 text-muted opacity-6" style="font-size: 35px;"> </i>Clients</div>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table style="width: 100%;" class="table table-hover table-striped table-bordered table-cursor">
                                                <thead>
                                                    <tr>
                                                        <th>Company Names</th>
{{--                                                        <th>Location</th>--}}
                                                    </tr>
                                                </thead>
                                                <tbody id="contract_clients_list">


                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="card mb-3">
                                    <div class="card-header-tab card-header">
                                        <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><i class="pe-7s-notebook mr-3 text-muted opacity-6" style="font-size: 35px;"> </i>Contract Details</div>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table-detail table table-hover table-striped table-bordered" id="contract_detail_table">

                                            </table>
                                            <div id="multiple_pages">
                                            <div id="contact_detail_btn">

                                            </div>
                                                <ul id="example-3" class="pagination" style="float: right"></ul>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                            <ul id="example-2" class="pagination"></ul>
                            <div class="show"></div>
                            </div>
                        </div>
                    </div>
                </div>
<script>
    // window.onload = pageloading(0);
    var start_click = 0;
    var client = $('#contract_session').val();
    $(document).ready(function () {
        //
        client = $('#contract_session').val();
        pageloading(0);
    });
    var page_number=0;
    var contract_page_number=0;

    function pageloading(page) {
        $('#example-2').pagination({
            total: 1, // 总数据条数
            current: 1, // 当前页码
            length: 1, // 每页数据量
            size: 1, // 显示按钮个数
            prev: 'Previous',
            next: 'Next',
            /**
             * [click description]
             * @param  {[object]} options = {
             *      current: options.current,
             *      length: options.length,
             *      total: options.total
             *  }
             */

            ajax: function (options, refresh, $target) {
                // console.log(options);
                // alert('Idhrrrrr hnnnn');

                $.ajax({

                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    url: "{{route('contractsajax')}}",
                    type: "post",
                    data: {
                        'page_num': options.current,
                        'client_id':client,

                    },
                    beforeSend: function(){
                        {{--$.blockUI({ message: '<img src="{{asset('assets/images')}}/loader-circle.gif" />', css: {border:     'none',--}}
                        {{--        backgroundColor:'transparent'} }); --}}
                        $.blockUI({ message: '<div class="spinner-grow text-success"></div><div class="spinner-grow text-success"></div><div class="spinner-grow text-success"></div>', css: {border:     'none',
                                backgroundColor:'transparent'} });
                    },
                    complete:function(data){
                        $.unblockUI();
                    }

                }).done(function (response) {
                    page_number = options.current;
                    var html ='';
                    var search ='<option value="" style="display: none">Select Company</option>';
                    var json = JSON.parse(response);
                    var session_chose = '';
                    console.log(json);
                    // alert(json[0]['clients'].length);
                    for (let i = 0; i < json[0]['clients'].length; i++) {
                        // alert(json[0]['clients'].length);

                        var newHtml="";

                            html += '<tr><td  style="background: #fff;cursor: default;padding: 1px;"></td></tr><tr data-contract-id="'+json[0]['clients'][i]['admin_contracts'][0]['id']+'"  class="contract-note contract-note-'+json[0]['clients'][i]['admin_contracts'][0]['id']+'" data-id="'+json[0]['clients'][i]['id']+'" ONCLICK="showcontract('+json[0]['clients'][i]['admin_contracts'][0]['id']+')" ><td><div id="remove-id-'+json[0]['clients'][i]['id']+'"class="note-box"><div class="add-cursor"> <a class="note-box" href="javascript:void(0)"><h4 class="bold-green">'+json[0]['clients'][i]["company_name"]+'</h4></a><small><b>'+json[0]['clients'][i]['city']+', '+json[0]['clients'][i]['state']+'</b></small></div></div></td></tr>'
                    }
                    for(let k=0;k<json[0]['drop_down'].length;k++)
                    {
                        // if ($('#contract_session').val()!=0)
                        // {
                            // if (json[0]['drop_down'][k]['id']==$('#contract_session').val())
                            // {
                            //     session_chose = 'selected'
                            // }
                            // else
                            // {
                            //     session_chose = '';
                            // }
                        // }
                        search+='<option value="'+json[0]['drop_down'][k]['id']+'" '+session_chose+' >'+json[0]['drop_down'][k]["company_name"]+'</option>';

                    }

                    //
                    //


                        // console.log($('#client-show tr:nth-child(2)'));
                        //  alert('not');
                        // Openings($('#client-show').find('tr').eq(1).attr('data-id'));

                    if(html == ""){
                        html = "No Company Avaliable";
                        var newhtml = "<center>No contract detail avaliable</center>";
                        document.getElementById('contract_detail_table').innerHTML=newhtml;
                        $('#contact_detail_btn').hide();
                    }
                    document.getElementById('contract_clients_list').innerHTML=html;
                    document.getElementById('search_contract_clients').innerHTML=search;
                    // if (start_click==0)
                    // {
                    //     $('#search_client_contract').click();
                    //     start_click = 1;
                    //     $('#contract_session').val(0);
                    // }
                    var first_contract= $('#contract_clients_list tr:eq(1)').attr('data-contract-id');
                    // alert(first_contract);
                    if(html!="No Company Avaliable") {
                        showcontract(first_contract);
                    }

                    //
                    //
                    // $('#contract_clients_list').html(html);


                    refresh({
                        total: json[0]['total'], // 可选
                        length: 10, // 可选
                    });
                });
            }
        });
    }
    function showcontract(id) {
        $('#example-3').pagination({
            total: 1, // 总数据条数
            current: 1, // 当前页码
            length: 1, // 每页数据量
            size: 1, // 显示按钮个数
            showPrevious: false,
            showNext: false,
            // prev: 'Previous',
            // next: 'Next',
            /**
             * [click description]
             * @param  {[object]} options = {
             *      current: options.current,
             *      length: options.length,
             *      total: options.total
             *  }
             */
            ajax: function (options, refresh, $target) {
                // console.log(options);
                // alert('Idhrrrrr hnnnn');
                contract_page_number = options.current;
                $('.contract-note').removeClass('color-active');
                $('.contract-note-' + id).addClass('color-active');
                var client_id= $('.contract-note-' + id).attr('data-id');
                var html ='';
                var html_btn ='';
                var exs = '';
                $.ajax({
                    url: "{{route('contractdetails')}}",
                    type: 'post',
                    data:{
                        "_token": "{{ csrf_token() }}",
                        "contract_id":id,"client_id":client_id,'page_num': options.current,
                    },
                }).done(function(response){
                    var json = JSON.parse(response);
                    // console.log(json);
                    var resume='';
                    exs = json[0]['client'][0]['admin_contracts'][0]['status'] ;
                    // console.log(exs);
                    if(exs == 0)
                    {
                        resume += '<figure><a target="_blank" href="'+window.location.origin+'/public/files/'+json[0]['client'][0]['admin_contracts'][0]['contract_file']+'" style="font-size: 45px; margin: 0px 10px 0px 0px;" data-toggle="tooltip" title="" class=" "  ><img id="img-'+id+'" height="50" width="50" src="'+window.location.origin+'/assets/images/contract_sent.png"></a></figure>'
                    }
                    else {
                        resume += '<figure><a target="_blank" href="'+window.location.origin+'/public/files/'+json[0]['client'][0]['admin_contracts'][0]['contract_file']+'" style="font-size: 45px; margin: 0px 10px 0px 0px;" data-toggle="tooltip" title="" class="" ><img id="img-'+id+'" height="50" width="50" src="'+window.location.origin+'/assets/images/contract_signed.png"></a></figure>'

                    }
                    // console.log(resume);
                    html ='<tr>\n' +
                        '                                                  <th>Business Legal Name:</th>\n' +
                        '                                                  <td id="b_name">'+json[0]['client'][0]['company_name']+'</td>\n' +
                        '                                                </tr>\n' +
                        '                                                <tr>\n' +
                        '                                                  <th>Full Name:</th>\n' +
                        '                                                  <td id="b_fname">'+json[0]['client'][0]['name']+'</td>\n' +
                        '                                                </tr>\n' +
                        '                                                <tr>\n' +
                        '                                                  <th>Job Title:</th>\n' +
                        '                                                  <td id="b_job">'+json[0]['client'][0]['job_title']+'</td>\n' +
                        '                                                </tr>\n' +
                        '                                                <tr>\n' +
                        '                                                  <th>Phone Number:</th>\n' +
                        '                                                  <td id="b_pnumber">'+json[0]['client'][0]['phone']+'</td>\n' +
                        '                                                </tr>\n' +
                        '                                                <tr>\n' +
                        '                                                  <th>Email Address:</th>\n' +
                        '                                                  <td id="b_email">'+json[0]['client'][0]['email']+'</td>\n' +
                        '                                                </tr>\n' +
                        '                                                <tr>\n' +
                        '                                                  <th>Industry:</th>\n' +
                        '                                                  <td id="b_industry">'+json[0]['client'][0]['industry']+'</td>\n' +
                        '                                                </tr>'+
                        '                                                <tr>'+
                        '                                                <tr>\n' +
                        '                                                  <th>Business Website:</th>\n' +
                        '                                                  <td id="b_web">'+json[0]['client'][0]['web_url']+'</td>\n' +
                        '                                                </tr>\n' +
                        '                                                  <th>Business Main Address:</th>\n' +
                        '                                                  <td id="b_address">'+json[0]['client'][0]['admin_contracts'][0]['business_address']+'</td>\n' +
                        '                                                </tr>\n' +
                        '                                                <tr>\n' +
                        '                                                  <th>Business Phone Number:</th>\n' +
                        '                                                  <td id="b_number">'+json[0]['client'][0]['admin_contracts'][0]['business_number']+'</td>\n' +
                        '                                                </tr>\n' +
                        '                                                <tr>\n' +
                        '                                                  <th>Position (s) looking to fill:</th>\n' +
                        '                                                  <td id="b_position">'+json[0]['client'][0]['admin_contracts'][0]['positions']+'</td>\n' +
                        '                                                </tr>\n' +
                        '                                                <tr>\n' +
                        '                                                  <th>Number of openings:</th>\n' +
                        '                                                  <td id="b_opening">'+json[0]['client'][0]['admin_contracts'][0]['openings']+'</td>\n' +
                        '                                                </tr>'+
                        '                                               <tr>\n' +
                        '                                                  <th>Quoted Fee:</th>\n' +
                        '                                                  <td id="b_quoted_fee">'+json[0]['client'][0]['admin_contracts'][0]['quoted_fee']+'</td>\n' +
                        '                                                </tr>' +
                        '<tr><th>Status:</th>' +
                    '<td>' +
                    resume +
                    '</td>' +
                    '</tr>';


                    if(json[0]['total']==1)
                    {
                        $('#example-3').hide();
                    }
                    else
                    {
                        $('#example-3').show();
                    }
                    document.getElementById('contract_detail_table').innerHTML=html;
                    //
                    var s_btn = '';
                    if(exs==0)
                    {
                        s_btn = '<a class="tag sign_contract" data-id="'+id+'" >Sign Contract</a>';
                    }
                    var newhtml = '<a class="tag" data-client="'+json[0]['client'][0]['id']+'" data-id="'+json[0]['client'][0]['admin_contracts'][0]['id']+'" id="contract_edit_btn" href="#editcontractformModal" data-toggle="modal">Edit</a>\n' +
                        '  @can('delete', \App\Models\Admin\AdminContract::class) <a class="tag delete_contract" data-id="'+json[0]['client'][0]['admin_contracts'][0]['id']+'" >Delete</a> @endcan' +
                        ''+s_btn+' ';

                    document.getElementById('contact_detail_btn').innerHTML=newhtml;
                    refresh({
                        total: json[0]['total'], // 可选
                        length: 1, // 可选
                    });
                });

            }
        });
            // body...
        // alert(id);
        // alert(id);



    }
    $(document).on('click', '#search_client_contract', function() {
        client = $('#search_contract_clients').val();
        pageloading(0);
    });
    $(document).on('click', '.delete_contract', function() {
        var id = $(this).attr('data-id');
        swal({
            title: "Are you sure",
            text: "You want to remove this Contract ",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "{{route('contractdelete')}}",
                        type: 'post',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "interview_id": id,
                        },

                    }).done(function (res) {
                        swal("Contract is successfully deleted ");
                        pageloading(page_number);
                    });
                } else {
                    swal("Contract is safe!");
                }

            });
    });
    $(document).on('click', '.sign_contract', function() {
        var id = $(this).attr('data-id');
        swal({
            title: "Are you sure",
            text: "You want to mark this contract as signed?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "{{route('signcontract')}}",
                        type: 'post',

                        data: {

                            "_token": "{{ csrf_token() }}",
                            "contract_id": id,


                        },

                        // dataType: 'json'
                    }).done(function (res) {

                        // console.log(res);
                        swal("Contract is successfully Signed ");
                        showcontract(id);
                        // $("#img-"+id).attr('src',window.location.origin+'/public/assets/images/contract_signed.png');
                        // pageloading(page_number);

                    });
                } else {
                    swal("Contract is not marked as signed!");
                }

            });
    });
    $(document).on('click', '#contract_edit_btn', function() {
        var id =$(this).attr('data-id');
        var client_id=$(this).attr('data-client');

        $.ajax({
            url: "{{route('contractdetails')}}",
            type: 'post',
            data:{
                "_token": "{{ csrf_token() }}",
                "contract_id":id,"client_id":client_id,'page_num': contract_page_number,
            },
        }).done(function(response) {
            var json = JSON.parse(response);
            // console.log(json[0]['client'][0]['contracts'][0]['contract_file']);
            // $('#edit_business_name').val(json[0]['client'][0]['name']);
            $('#edit_business_address').val(json[0]['client'][0]['admin_contracts'][0]['business_address']);
            $('#edit_business_number').val(json[0]['client'][0]['admin_contracts'][0]['business_number']);
            $('#edit_business_web').val(json[0]['client'][0]['web_url']);
            $('#edit_full_name').val(json[0]['client'][0]['name']);
            $('#edit_job_title').val(json[0]['client'][0]['job_title']);
            $('#edit_phone_no').val(json[0]['client'][0]['phone']);
            $('#edit_industry_contract').val(json[0]['client'][0]['industry']);
            $('#edit_email_address').val(json[0]['client'][0]['email']);
            $('#edit_positions').val(json[0]['client'][0]['admin_contracts'][0]['positions']);
            $('#edit_opening').val(json[0]['client'][0]['admin_contracts'][0]['openings']);
            $('#edit_quoted_fee').val(json[0]['client'][0]['admin_contracts'][0]['quoted_fee']);

            if (json[0]['client'][0]['admin_contracts'][0]['contract_file'])
            {
                var file ='';
               var  exs = json[0]['client'][0]['admin_contracts'][0]['status'] ;
                // console.log(exs);
                if(exs == 0)
                {
                    file += '<a target="_blank" href="'+window.location.origin+'/public/files/'+json[0]['client'][0]['admin_contracts'][0]['contract_file']+'" style="font-size: 45px; margin: 0px 10px 0px 0px;" data-toggle="tooltip" title="" class=" "  ><img id="img-'+id+'" height="50" width="50" src="'+window.location.origin+'/assets/images/contract_sent.png"></a>'
                }
                else {
                    file += '<a target="_blank" href="'+window.location.origin+'/public/files/'+json[0]['client'][0]['admin_contracts'][0]['contract_file']+'" style="font-size: 45px; margin: 0px 10px 0px 0px;" data-toggle="tooltip" title="" class="" ><img id="img-'+id+'" height="50" width="50" src="'+window.location.origin+'/assets/images/contract_signed.png"></a>'
                }
                $('#edit-contract-file').html(file);
            // $('#edit-contract-file').find('a').attr('href',''+window.location.origin+'/public/files/'+json[0]['client'][0]['contracts'][0]['contract_file']);
            // var ext = json[0]['client'][0]['contracts'][0]['contract_file'].split('.').pop();
            //     console.log(ext);
            //
            // var pre = '';
            // if (ext=="pdf")
            // {
            //     pre = 'fa-file-pdf-o';
            // }
            // else
            // {
            //     pre = 'fa-file-word-o';
            //
            // }
            // $('#edit-contract-file').find('a').find('i').addClass(pre);
            }
            else {
                // $('#edit-contract-file').hide();
            }
            $('#contract_id_edit').val(id);
        });



    })

</script>
  @if ($errors->any())
      <script>

          $( document ).ready(function() {
              swal("Contract updation failed please try again");
          });

      </script>
  @endif
@stop

