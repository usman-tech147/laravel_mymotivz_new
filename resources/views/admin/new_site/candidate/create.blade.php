@extends('admin.layouts.layouts')
@section('title', 'New Candidate')
@section('content')

    @if(session()->has('candidateSuccess'))
        <div class="alert alert-success custom-toster">
            {{ session()->get('candidateSuccess') }}
        </div>
    @endif

    <div class="app-main__inner">
        <div class="card-header-tab card-header">
            <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><i class="pe-7s-user mr-3 text-muted opacity-6" style="font-size: 35px; color: white !important;"> </i>Add New Candidate</div>
        </div>
        <div class="tabs-animation">
            <div class="row">
                <div class="col-md-12">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <form id="candidate-validation" method="post" action="{{route('new.candidate.submit')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Full name</label>
                                            <input name="full_name" type="text" class="form-control" placeholder="" value="{{ old('full_name') }}">
                                            @error('full_name')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Job Title</label>
                                            <input name="job_title" type="text" class="form-control" placeholder="" value="{{ old('job_title') }}">
                                            @error('job_title')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Phone number</label>
                                            <input name="phone" type="text" class="form-control" placeholder="" value="{{ old('phone') }}">
                                            @error('phone')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input name="email" type="text" class="form-control" placeholder="" value="{{ old('email') }}">
                                            @error('email')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>City</label>
                                            <input name="city" type="text" class="form-control" placeholder="" value="{{ old('city') }}">
                                            @error('city')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>State</label>
                                            <input name="state" type="text" class="form-control" placeholder="" value="{{ old('state') }}">
                                            @error('state')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="optional">Employer</label>
                                            <input name="employer" type="text" class="form-control" placeholder="" value="{{ old('employer') }}">
                                            @error('employer')
                                            <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Salary Requirements</label>
                                            <input name="salary" type="text" class="form-control" placeholder="" value="{{ old('salary') }}">
                                            @error('salary')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Skills <small>(Please add a comma separated list.)</small></label>
                                            <input name="skills"  type="text" class="tags_1 tags form-control" placeholder="" value="{{ old('skills') }}">
                                            @error('skills')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Interest <small>(Please add a comma separated list.)</small></label>
                                            <input name="interest" type="text" class="tags_1 tags form-control" placeholder="" value="{{ old('interest') }}">
                                            @error('interest')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Experience</label>
                                            <select name="experience" id="" class="form-control" >
                                                <option value="" selected disabled>Select Experience</option>
                                                <option value="1">1 Year</option>
                                                <option value="2">2 Year</option>
                                                <option value="3">3 Year</option>
                                                <option value="4">4 Year</option>
                                                <option value="5">5 Year</option>
                                                <option value="6">6 Year</option>
                                                <option value="7">7 Year</option>
                                                <option value="8">8 Year</option>
                                                <option value="9">9 Year</option>
                                                <option value="10">10 Year</option>
                                                <option value="11">More than 10</option>
                                            </select>
                                            @error('experience')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Education</label>
                                            <select class="form-control" name="education">
                                                <option value="" selected disabled>Select Education</option>
                                                @foreach($education as $edu)
                                                    <option value="{{$edu['id']}}">{{$edu['name']}}</option>
                                                @endforeach
                                            </select>
{{--                                            <input name="education" type="text" class="tags_1 tags form-control" placeholder="" value="{{ old('education') }}">--}}
                                            @error('education')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select name="status_id" id="" class="form-control">
                                                <option value="" selected disabled>Select Job Type</option>
                                                @foreach($statuses as $status)
                                                    <option value="{{$status->id}}">{{$status->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
{{--                                    <div class="col-md-4">--}}
{{--                                        <div class="form-group">--}}
{{--                                            <label class="optional">Create New Status <span>(Optional)</span></label>--}}
{{--                                            <input name="name" type="text" class="form-control" placeholder="" value="{{ old('name') }}">--}}
{{--                                            @error('name')--}}
{{--                                                <div class="error">{{ $message }}</div>--}}
{{--                                            @enderror--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-md-4">--}}
{{--                                        <div class="form-group">--}}
{{--                                            <label class="optional">Select Background Color For New Status <span>(Optional)</span></label>--}}
{{--                                            <input name="color" type="color" class="form-control" placeholder="" value="{{ old('color') }}">--}}
{{--                                            @error('color')--}}
{{--                                                <div class="error">{{ $message }}</div>--}}
{{--                                            @enderror--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Industry <small>(Please add a comma separated list.)</small></label>
                                            <input name="Industry" type="text" class="tags_1 tags form-control" placeholder="" value="{{ old('Industry') }}">
                                            @error('Industry')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="optional">Upload Resume</label>
                                            <div enctype="multipart/form-data">
                                                <input name="resume[]" id="file-upload-demo" type="file" value="{{ old('resume[]') }}" multiple>
                                                @error('resume')
                                                    <div class="error">{{ $message }}</div>
                                                @enderror

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="optional">Add Notes</label>
                                            <textarea name="candidate_note" class="form-control" placeholder="">{{ old('candidate_note') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary pull-right">Add New Candidate</button>
                                <div class="clearfix"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        var id='';
        // Trigger action when the contexmenu is about to be shown
        $(".add-note").bind("contextmenu", function (event) {
            // Avoid the real one
            event.preventDefault();
            id=$(this).attr('data-id');
            // Show contextmenu

            $(".custom-menu-"+id).finish().toggle(100).

            // In the right position (the mouse)
            css({
                top: event.Y + "px",
                left: event.X + "px"
            });
        });


        // If the document is clicked somewhere
        $(document).bind("mousedown", function (e) {
            // If the clicked element is not the menu
            if (!$(e.target).parents(".custom-menu-"+id).length > 0) {

                // Hide it
                $(".custom-menu-"+id).hide(100);
            }
        });


        // If the menu element is clicked
        $(".custom-menu li").click(function(){
            // Hide it AFTER the action was triggered
            $(".custom-menu-"+id).hide(100);
        });


    </script>
@endsection
