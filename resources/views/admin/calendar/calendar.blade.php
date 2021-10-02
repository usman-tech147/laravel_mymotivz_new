@extends('admin.layouts.layouts')
@section('title', 'Calender')
@section('content')
    <a href="#todoeditModal" id="calendar_edit_btn" class="tag" data-toggle="modal" style="display: none">Edit</a>
    <div class="app-main__inner">
        <div class="card-header-tab card-header">
            <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><i class="pe-7s-date mr-3 text-muted opacity-6" style="font-size: 35px; color: #fff !important;"> </i>Calendar</div>
        </div>
        <div class="tabs-animation">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="box box-primary">
                                <div class="box-body no-padding">
                                    <div id="calendar"></div>
                                </div>
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
        $(document).on('click', '.fc-day', function() {
            // var da = $(this).parent().attr('data-date');
            var da = $(this).attr('data-date');
            var short = da.split("-");
            var new_date = short[1]+'/'+short[2]+'/'+short[0];
            console.log(new_date);
            console.log(da);
            $('#todo_date').datepicker("setDate", new_date );
            $.ajax({
                url: "{{route('todoactionslist')}}",
                type: 'get',

            }).done(function(res){

                var json = JSON.parse(res) ;
                console.log(json);
                var opt = '';
                // console.log(json);
                for (var i = json.length - 1; i >= 0; i--) {

                    opt += '<option value="'+json[i]['id']+'" >'+json[i]['name']+'</option>'
                }

                document.getElementById('todo_action_list').innerHTML=opt;
            });
            $('#todoModal').modal();

        });
    </script>
@stop
