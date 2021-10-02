@extends('admin.layouts.layouts')
@section('title', 'Add New Employee')
@section('content')

    @if(session()->has('SubAdmin'))
        <div class="alert alert-success custom-toster">
            {{ session()->get('SubAdmin') }}
        </div>
    @endif

    <div class="app-main__inner">
        <div class="card-header-tab card-header">
            <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><i
                    class="pe-7s-user mr-3 text-muted opacity-6" style="font-size: 35px; color: white !important;"> </i>Add
                New Employee
            </div>
        </div>
        <div class="tabs-animation">
            <form id="sub_admin_create_form" action="{{route('sub_admin_created')}}" method="post"
                  enctype="multipart/form-data">
                @csrf
                <div class="row">

                    <div class="col-md-12">
                        <div class="main-card mb-3 card">
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Full name</label>
                                            <input type="text" name="name" class="form-control" placeholder=""
                                                   value="{{ old('name') }}">
                                            @error('name')
                                            <label class="error">{{ $message }}</label>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Email Address</label>
                                            <input type="email" name="email" class="form-control" placeholder=""
                                                   value="{{ old('email') }}">
                                            @error('email')
                                            <label class="error">{{ $message }}</label>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" name="password" class="form-control" placeholder=""
                                                   value="{{ old('password') }}">
                                            @error('password')
                                            <label class="error">{{ $message }}</label>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Phone Number</label>
                                            <input type="text" name="phone_no" class="form-control" placeholder=""
                                                   value="{{ old('phone_no') }}">
                                            @error('phone_no')
                                            <label class="error">{{ $message }}</label>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Hire Date</label>
                                            <input type="text" name="hire_date" placeholder="--/--/----"
                                                   class="form-control" data-toggle="datepicker"
                                                   value="{{ old('hire_date') }}">
                                            @error('hire_date')
                                            <label class="error">{{ $message }}</label>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Job Title</label>
                                            <input type="text" name="job_title" class="form-control" placeholder=""
                                                   value="{{ old('job_title') }}">
                                            @error('job_title')
                                            <label class="error">{{ $message }}</label>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Home Address</label>
                                            <input type="text" name="home_address" class="form-control" placeholder=""
                                                   value="{{ old('home_address') }}">
                                            @error('home_address')
                                            <label class="error">{{ $message }}</label>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="optional">Resume</label>
                                            <div enctype="multipart/form-data">
                                                <input name="resume" id="file-upload-demo" type="file"
                                                       value="{{ old('resume') }}">
                                                @error('resume')
                                                <div class="error">{{ $message }}</div>
                                                @enderror

                                            </div>
                                            <label id="file-upload-demo-error" class="error" for="file-upload-demo"
                                                   style="display: none">Please select resume</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea name="description" class="form-control"
                                                      placeholder="">{{ old('description') }}</textarea>
                                            @error('description')
                                            <label class="error">{{ $message }}</label>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                                <div class="clearfix"></div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card-header-tab card-header">
                            <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><i
                                    class="pe-7s-user mr-3 text-muted opacity-6"
                                    style="font-size: 35px; color: white !important;"> </i>Select Privileges
                            </div>
                        </div>
                        <div class="main-card mb-3 card">
                            <div class="card-body">

                                <div class="row">
                                    <?php $count = 1; ?>
                                    @foreach($privileges as $privilege)
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="optional"><input name="privileges[]"
                                                                               class="privilege-checkbox"
                                                                               value="{{$privilege->id}}"
                                                                               type="checkbox" {{ (is_array(old('privileges')) && in_array($count, old('privileges'))) ? ' checked' : '' }} > {{$privilege->name}}
                                                </label>
                                            </div>
                                        </div>
                                        <?php $count = $count + 1; ?>
                                    @endforeach

                                    @error('privileges')
                                    <label class="error">{{ $message }}</label>
                                    @enderror
                                    <label id="privileges[]-error" class="error" for="privileges[]"
                                           style="display: none">Please Select at least one Privilege</label>
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary pull-right">Add Employee</button>
                                    </div>
                                </div>
                                <div class="clearfix"></div>

                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>


@endsection
