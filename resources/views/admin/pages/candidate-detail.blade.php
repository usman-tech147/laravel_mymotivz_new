@extends('admin.layouts.layouts')
@section('title', 'Candidate Details')
@section('content')

    @php

        $exp = 'year' ;
       $experience = $candidate[0]['experience'];
       $salary = $candidate[0]['salary'];
        if($experience > 1)
           {
               $exp = 'years' ;
           }
       if ($experience==-1)
           {
           $exp = ' ';
           $experience = 'N/A' ;
           }
           if ($salary==-1)
           {
           $salary = 'N/A' ;
           }
    @endphp

    <div class="app-main__inner">
        <div class="col-md-12">
            <div class="card mb-3">
                <div class="card-header-tab card-header">
                    <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><i
                                class="pe-7s-notebook mr-3 text-muted opacity-6" style="font-size: 35px;"> </i>Candidate
                        Details
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table-data-ajax" class="table-detail table table-hover table-striped table-bordered">
                            <tr id="job-del-' + json[i]['id'] + '"></tr>
                            <tr>
                                <th>Date Logged:</th>
                                <td>{{$candidate[0]['created_at']}}</td>
                            </tr>
                            <tr>
                                <th>Full Name:</th>
                                <td>{{$candidate[0]['name']}}</td>
                            </tr>
                            <tr>
                                <th>Job Title:</th>
                                <td>{{$candidate[0]['job_title']}}</td>
                            </tr>
                            <tr>
                                <th>Salary Requirements:</th>
                                <td>{{$salary}}</td>
                            </tr>
                            <tr>
                                <th>Phone Number:</th>
                                <td>{{$candidate[0]['phone']}}</td>
                            </tr>
                            <tr>
                                <th>Interest:</th>
                                <td>{{preg_replace('/,/', ' | ', $candidate[0]['interest'])}}</td>
                            </tr>
                            <tr>
                                <th>Email:</th>
                                <td>{{$candidate[0]['email']}}</td>
                            </tr>
                            <tr>
                                <th>City:</th>
                                <td>{{$candidate[0]['city']}}</td>
                            </tr>
                            <tr>
                                <th>State:</th>
                                <td>{{$candidate[0]['state']}}</td>
                            </tr>
                            <tr>
                                <th>Employer:</th>
                                <td>{{$candidate[0]['employer']}}</td>
                            </tr>
                            <tr>
                                <th>Experience:</th>
                                <td>{{$experience}}{{" ".$exp}}</td>
                            </tr>
                            <tr>
                                <th>Education:</th>
                                <td>
                                    {{--{{$candidate[0]['admin_education']['name']}}--}}
                                    Education
                                </td>
                            </tr>
                            <tr>
                                <th>Skills:</th>
                                <td>
                                    {{preg_replace('/,/', ' | ', $candidate[0]['skills'])}}
                                </td>
                            </tr>
                            <tr>
                                <th>Types of industry:</th>
                                <td>
                                    {{preg_replace('/,/', '', $candidate[0]['Industry'])}}
                                </td>
                            </tr>
                            <tr>
                                <th>Status:</th>
                                <td><img width="50px" height="50px"
                                         src="{{asset('status_icons')}}/{{$candidate[0]['admin_status']['status_icon']}}">
                                </td>
                            </tr>
                            <tr>
                                <th>Notes:</th>
                                <td>
                                    <div class="note-wrap detail">
                                        <ul>
                                            @foreach($candidate[0]['admin_notes'] as $note )
                                                <li id="delete-id-{{$note['id']}}">
                                                    <time>{{$note['created_at']}} </time>
                                                    <p id="note-{{$note['id']}}">{{$note['description']}}</p>
                                                    <a id="note-del-28" dataid="{{$note['id']}}"
                                                       href="javascript:void(0)" class="tag btn note-del">Delete</a>
                                                    <a id="note-edit-{{$note['id']}}" dataid="{{$note['id']}}"
                                                       href="#editNotePopup" data-toggle="modal"
                                                       class="tag btn editNote">Edit</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </td>
                            </tr>

                        </table>
                        <div class="col-md-12">
                            <div class="pdf-remove-img cls-rs">
                                <ul>
                                    @foreach($candidate[0]['admin_resumes'] as $resume)

                                        @if(pathinfo($resume['resume'], PATHINFO_EXTENSION)=== 'pdf')
                                            <li id="resume-{{$resume['id']}}"><a target="_blank"
                                                                                 href="{{url('/files/'.$resume['resume'])}}"><i
                                                            class="fa fa-file-pdf-o"></i></a></li>

                                        @else
                                            <li id="resume-{{$resume['id']}}"><a target="_blank"
                                                                                 href="{{url('/files/'.$resume['resume'])}}"><i
                                                            class="fa fa-file-word-o"></i> </a></li>

                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <a class="btn btn-success" href="{{route('candidate.database')}}">View All Candidates</a>
                        <a class="btn btn-success" href="{{route('candidate.edit' , $candidate[0]['id'])}}">Edit</a>
                        <div id="buttons-job"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>


    <script>
        //edit note
        $(document).on('click', '.editNote', function (e) {


            id = $(this).attr('dataid');

            var text = $('#note-' + id).text();
            $('#node-edit-clas').text(text);

        });

        $(document).on('click', '#note-edit-submit', function (e) {

            var noteText = $('#node-edit-clas').val();
            $.ajax({
                url: "{{route('note.edit')}}",
                type: 'post',

                data: {

                    "_token": "{{ csrf_token() }}",
                    "noteId": id,
                    "noteText": noteText,

                },

                // dataType: 'json'
            }).done(function (res) {

                $('#note-' + id).text(noteText);

            });

        });


        //end edit note


        //note delete
        $(document).on('click', '.note-del', function (e) {
            // e.preventDefault();
            var id = $(this).attr('dataid');

            swal({
                title: "Are you sure",
                text: "Once deleted, you will not be able to recover this note!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: "{{route('note.delete')}}",
                            type: 'post',

                            data: {

                                "_token": "{{ csrf_token() }}",
                                "noteId": id,

                            },

                            // dataType: 'json'
                        }).done(function (res) {
                            $('#delete-id-' + id).remove();
                        });
                    } else {
                        swal("Your note is safe!");
                    }

                });
        });


    </script>

@endsection


