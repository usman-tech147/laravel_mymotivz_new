@extends('admin.layouts.layouts')
@section('title', 'Todo List')
@section('content')

    <div class="app-main__inner">
        <div class="card-header-tab card-header">
            <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><i class="pe-7s-file mr-3 text-muted opacity-6" style="font-size: 35px; color: #fff !important;"> </i>TO DO LIST</div>
        </div>
        <div class="tabs-animation">
            <div class="row">
                <div class="col-md-12">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <a data-toggle="modal" id="new_todo" href="#todoModal" class="btn btn-primary btn-shine pull-right" style="margin: 0px 0px 20px; background-color: green"> + New</a>
                            <a class="bulk_delete_todo tag">Delete</a>
                            <div class="table-responsive to-do-list">
                                <table style="width: 100%;" class="table table-hover table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th><input type="checkbox" id="todo_checklist"></th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th class="width-3">Task Details</th>
                                        <th>Subject</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody id="todo_view">

                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <ul id="example-2" class="pagination"></ul>
                                    <div class="show"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script>
    function timeConvert (time) {
        // Check correct time format and split into components
        time = time.toString ().match (/^([01]\d|2[0-3])(:)([0-5]\d)(:[0-5]\d)?$/) || [time];
        var s_time = '';
        if (time.length > 1) { // If time format correct
            time = time.slice (1);  // Remove full string match value
            // if(time[0]<=9)
            // {
            //
            //     time[0] = '0'+time[0];
            // }
            time[3] = +time[0] < 12 ? 'AM' : 'PM'; // Set AM/PM
            time[0] = +time[0] % 12 || 12; // Adjust hours
            // console.log(time);
        }
        s_time= time[0]+time[1]+time[2]+' '+time[3];
        // return time.join (''); // return adjusted time or original string
        return s_time; // return adjusted time or original string
    }

    window.onload = pageloading(0);
    var page_number=0;
    var client = 0;
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
                page_number=options.current;
                $.ajax({
                    url: "{{route('todolist')}}",
                    type: 'post',

                    data: {

                        "_token": "{{ csrf_token() }}",
                        'page_num': options.current,

                    },

                    // dataType: 'json'
                }).done(function (res) {
                    var json = JSON.parse(res);
                    // console.log(json);
                    var html = "";
                    var newHtml = "";
                    var start = '';
                    for (let i = 0; i < json[0]['todo'].length; i++) {

                        var time = timeConvert(json[0]['todo'][i]['time']);
                        var date = new Date(json[0]['todo'][i]['date']);

                        var mlist = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
                        var monName = mlist[date.getMonth()];
                        //
                        //
                        var day = date.getDate();

                        var newDate = monName +' '+(day < 10 ? '0' : '') + day +  ',' + date.getFullYear();


                        html+='<tr><td colspan="5" style="background: #fff;cursor: default;padding: 1px;"></td></tr>\n'+
                        '<tr id="todo-'+json[0]['todo'][i]['id']+'" data-id="'+json[0]['todo'][i]['id']+'">\n' +
                            '<td><input type="checkbox" class="todo_checkboxes"></td>\n' +
                            '<td id="date-'+json[0]['todo'][i]['id']+'" class="bold-green">'+newDate+'</td>\n' +
                            '<td id="time-'+json[0]['todo'][i]['id']+'"><b>'+time+'</b></td>\n' +
                            '<td id="task-'+json[0]['todo'][i]['id']+'">'+json[0]['todo'][i]['details']+'</td>\n' +
                            '<td><span class="status" id="action-'+json[0]['todo'][i]['id']+'" data-id="'+json[0]['todo'][i]['action_id']+'" style="background-color: '+json[0]['todo'][i]['action']['color']+';"><small>'+json[0]['todo'][i]['action']['name']+'</small></span></td>\n'+
                            '<td><a href="#todoeditModal" onclick="edit_todo('+json[0]['todo'][i]['id']+')" data-id="'+json[0]['todo'][i]['id']+'" class="tag" data-toggle="modal">Edit</a> <a data-id="'+json[0]['todo'][i]['id']+'" href="javascript:void(0)" class="tag delete_todo">Delete</a></td>\n' +
                            '</tr>'

                    }
                    if (html == '')
                    {
                        html = 'No Data Available';
                    }
                    document.getElementById('todo_view').innerHTML = html;


                    refresh({
                        total: json[0]['total'], // 可选
                        length: 10, // 可选
                    });
                });
            }
        });
    }
</script>
    @stop

{{--    <script>--}}
{{--var id='';--}}
{{--// Trigger action when the contexmenu is about to be shown--}}
{{--$(".add-note").bind("contextmenu", function (event) {--}}
{{--    // Avoid the real one--}}
{{--    event.preventDefault();--}}
{{--     id=$(this).attr('data-id');--}}
{{--    // Show contextmenu--}}
{{--   --}}
{{--    $(".custom-menu-"+id).finish().toggle(100).--}}
{{--    --}}
{{--    // In the right position (the mouse)--}}
{{--    css({--}}
{{--        top: event.Y + "px",--}}
{{--        left: event.X + "px"--}}
{{--    });--}}
{{--});--}}


{{--// If the document is clicked somewhere--}}
{{--$(document).bind("mousedown", function (e) {--}}
{{--    // If the clicked element is not the menu--}}
{{--    if (!$(e.target).parents(".custom-menu-"+id).length > 0) {--}}
{{--        --}}
{{--        // Hide it--}}
{{--        $(".custom-menu-"+id).hide(100);--}}
{{--    }--}}
{{--});--}}


{{--// If the menu element is clicked--}}
{{--$(".custom-menu li").click(function(){--}}
{{--    // Hide it AFTER the action was triggered--}}
{{--    $(".custom-menu-"+id).hide(100);--}}
{{--  });--}}


{{--$(function () {--}}
{{--        $('.tags_1').tagsInput({--}}
{{--            width: 'auto',--}}
{{--            defaultText: 'Type here and press enter btn'--}}
{{--        });--}}
{{--    });--}}
{{--    </script>--}}


