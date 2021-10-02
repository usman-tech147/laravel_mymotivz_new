<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>MyMotivz | @yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <meta name="viewport"
          content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no">
    <meta name="description" content="">
    <link rel="shortcut icon" href="{{asset('assets')}}/images/favicon.png" type="image/png"/>


    @include('admin.includes.style')
    @yield('style')
    @yield('script')

    {{--    {{ Html::script('https://code.jquery.com/jquery-3.4.1.js') }}--}}
    {{ Html::script('assets\scripts\jquery-3.4.1.js') }}
    {{ Html::script('assets\scripts\main.js') }}
    {{ Html::script('assets\scripts\bootstrap.min.js') }}
    {{ Html::script('assets\scripts\pagination.js') }}
    {{ Html::script('assets\scripts\jquery.validate.js') }}
    {{ Html::script('assets\scripts\additional-methods.min.js') }}
    {{ Html::script('assets\scripts\jquery.dataTables.min.js') }}
    {{ Html::script('assets\scripts\file-input\fileinput.js') }}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.js"
            integrity="sha256-oQaw+JJuUcJQ9QVYMcFnPxICDT+hv8+kuxT2FNzTGhc=" crossorigin="anonymous"></script>
    <script type="text/javascript"
            src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_API')}}&libraries=places"></script>
    <script async src="{{asset('google-map.js')}}"></script>
    <script src="{{asset('easy-number-separator.js')}}"></script>
    <script src="{{asset('helper.js')}}"></script>
    {{--    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>--}}

</head>
<body>

<input type="hidden" id="admin_id" value="{{auth()->id()}}">
@csrf


<!-- code by amir -->

<div class="modal fade" id="pipelineModal" role="dialog" aria-labelledby="pipelineModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pipelineModalLabel">Add to recruitment pipeline</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('jobpipline.created')}}" id="form-id-job-pipline" style="margin: 0px;">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Select Client Name</label>

                                <?php if(!empty($jobDetail) && count($jobDetail) > 0){?>
                                <input type="hidden" name="id" id="form-id-job-pipline-id-field"
                                       value="{{$jobDetail[0]->id}}">
                                <?php } ?>
                                <select name="name" value="{{ old('name') }}" required
                                        class="multiselect-dropdown form-control" id="client_name">
                                    <?php if(!empty($clientss)){?>
                                    @forelse($clientss as $client)
                                        <option value="{{$client->id}}">{{$client->company_name}}</option>
                                    @empty
                                        <option value="">No Client Add in Pipeline</option>
                                    @endforelse
                                    <?php } ?>
                                </select>
                                <input id="job-pipeline" type="hidden" name="recruitment_pipeline" value="1">
                            </div>
                        </div>
                    </div>
                    <button id="job-pipe-sub" type="button" data-dismiss="modal" class="btn btn-primary">ADD</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- end code by amir -->


{{--repete for search bcz job pipeline feature is also exist in search    --}}
{{--job-pipeline search    --}}
<div class="modal fade" id="pipelineModal-search" role="dialog" aria-labelledby="pipelineModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pipelineModalLabel">Add to recruitment pipeline</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('search.jobpipline.created')}}" id="form-id-job-pipline" style="margin: 0px;">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Select Client Name</label>

                                <?php if(!empty($jobDetail) && count($jobDetail) > 0){?>
                                <input type="hidden" name="id" id="form-id-job-pipline-id-field"
                                       value="{{$jobDetail[0]->id}}">
                                <?php } ?>
                                <select name="name" value="{{ old('name') }}" required
                                        class="multiselect-dropdown form-control" id="">
                                    <?php if(!empty($clientss)){?>
                                    @forelse($clientss as $client)
                                        <option value="{{$client->id}}">{{$client->company_name}}</option>
                                    @empty
                                        <option value="">No Client Add in Pipeline</option>
                                    @endforelse
                                    <?php } ?>
                                </select>
                                <input type="hidden" name="recruitment_pipeline" value="1">
                            </div>
                        </div>
                    </div>
                    <button id="job-pipe-sub" type="submit" class="btn btn-primary">ADD</button>
                </form>
            </div>
        </div>
    </div>
</div>
{{--end job-pipeline search    --}}

<div class="app-container app-theme-white body-tabs-shadow fixed-header fixed-sidebar">


    @include('admin.includes.header')
    <div class="app-main">
        @include('admin.includes.sidebar')
        <div class="app-main__outer">
            @yield('content')
            @csrf
            @include('admin.includes.footer')
        </div>
    </div>
</div>
{{--    /asdasda/--}}
@include('admin.includes.scripts')
@include('partials.additional_validator')
<!--  -->
{{--<script src="{{ asset('js/app.js') }}" ></script>--}}
{{--<script>--}}
{{--    var userId = $('#admin_id').val();--}}
{{--    var data ='';--}}
{{--    var type ='';--}}

{{--    Echo.private('App.User.' + userId)--}}
{{--        .notification((notification) => {--}}
{{--            console.log(notification);--}}
{{--            data = notification.data;--}}
{{--            type = notification.info;--}}
{{--            var html = ' <div class="vertical-timeline-item vertical-timeline-element">\n' +--}}
{{--                '                                                            <div><span class="vertical-timeline-element-icon bounce-in"><i class="badge badge-dot badge-dot-xl badge-danger"> </i></span>\n' +--}}
{{--                '                                                                <div class="vertical-timeline-element-content bounce-in">\n' +--}}
{{--                '                                                                    <h4 class="timeline-title">'+type+'</h4>\n' +--}}
{{--                '                                                                    <p>\n' +--}}
{{--                '                                                                        '+data+'</p>\n' +--}}
{{--                '                                                                       <span class="vertical-timeline-element-date"></span>\n' +--}}
{{--                '                                                                </div>\n' +--}}
{{--                '                                                            </div>\n' +--}}
{{--                '                                                        </div>';--}}

{{--            var old = $('#notification_count').text();--}}
{{--            old= Number(old) +1;--}}
{{--            document.getElementById('notification_dot').innerHTML=old;--}}
{{--            $('#notification_count').text(old);--}}
{{--            $('#notification_menu').prepend(html);--}}
{{--        });--}}

{{--    $('#mark_as_read').click(function () {--}}
{{--        $.ajax({--}}
{{--            url: "{{route('markread')}}",--}}
{{--            type: 'get',--}}

{{--        }).done(function (res) {--}}
{{--            var json = JSON.parse(res);--}}
{{--            var html ='';--}}
{{--console.log(json.length);--}}
{{--            for (var i = 0 ; i <json.length; i++) {--}}
{{--                html += ' <div class="vertical-timeline-item vertical-timeline-element">\n' +--}}
{{--                    '                                                            <div><span class="vertical-timeline-element-icon bounce-in"><i class="badge badge-dot badge-dot-xl badge-success"> </i></span>\n' +--}}
{{--                    '                                                                <div class="vertical-timeline-element-content bounce-in">\n' +--}}
{{--                    '                                                                    <h4 class="timeline-title">' + json[i].data.info + '</h4>\n' +--}}
{{--                    '                                                                    <p>\n' +--}}
{{--                    '                                                                        ' + json[i].data.data + '</p>\n' +--}}
{{--                    '                                                                       <span class="vertical-timeline-element-date"></span>\n' +--}}
{{--                    '                                                                </div>\n' +--}}
{{--                    '                                                            </div>\n' +--}}
{{--                    '                                                        </div>';--}}
{{--            }--}}
{{--            $('#notification_count').text('0');--}}

{{--            document.getElementById('notification_dot').innerHTML='';--}}
{{--            $('#notification_menu').html(html);--}}

{{--        });--}}
{{--    });--}}
{{--</script>--}}
</body>
{{--<script>--}}
{{--    $('button#job-pipe-sub').css('display' , 'none');--}}
{{--</script>--}}
</html>

{{--{{ Html::script('public/assets\scripts\functions.js') }}--}}
