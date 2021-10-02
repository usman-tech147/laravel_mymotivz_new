{{--edit privileges--}}
<div class="modal fade show" id="privilegeModal" tabindex="-1" role="dialog" aria-labelledby="privilegeModalLabel"
     aria-modal="true" style="display: none; padding-right: 17px;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="privilegeModalLabel">Update Privilege</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Update Privilege</label>
                                <input id="p_name" type="text" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button id="update-privilege" type="button" data-dismiss="modal"
                                    class="btn btn-primary pull-left">Save
                            </button>
                            {{--                           <button style="margin: 0px 0px 0px 5px;" type="button" data-dismiss="modal" data-toggle="modal" data-target="#statusupdateModal" class="btn btn-primary pull-left">Add New Status</button>--}}
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
</div>

{{--end edit privileges--}


{{-- Bulk update status model--}}
<div class="modal fade show" id="bulkstatusModal" role="dialog" aria-labelledby="bulkstatusModalLabel" aria-modal="true"
     style="display: none; padding-right: 17px;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bulkstatusModalLabel">Update Status</h5>
                <button type="button" class="close" id="bulk_status_cls_btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    {{--                    hidden field for get the current status_id--}}
                    <input name="candidate_id[]" id="candidate_id_bulk" type="hidden">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <select id="bulk_status_list" name="bulk_status"
                                        class="multiselect-dropdown form-control">


                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button id="update-status-bulk_btn" type="button" class="btn btn-primary pull-left">Update
                            </button>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade show" id="candidate_sampleModal" tabindex="-1" role="dialog"
     aria-labelledby="candidate_sampleModalLabel" aria-modal="true" style="display: none; padding-right: 17px;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="candidate_sampleModalLabel">Candidate Sample</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">

                                <img src="{{asset('assets/sample_imports')}}/candidate.png" width="100%">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <a href="{{asset('assets/sample_imports')}}/candidate.png" download="Candidate Sample"
                               class="btn btn-primary pull-left">Download</a>
                            {{--                           <button style="margin: 0px 0px 0px 5px;" type="button" data-dismiss="modal" data-toggle="modal" data-target="#statusupdateModal" class="btn btn-primary pull-left">Add New Status</button>--}}
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade show" id="job_sampleModal" tabindex="-1" role="dialog" aria-labelledby="job_sampleModalLabel"
     aria-modal="true" style="display: none; padding-right: 17px;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="job_sampleModalLabel">Job Sample</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">

                                <img src="{{asset('assets/sample_imports')}}/job.png" width="100%">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <a href="{{asset('assets/sample_imports')}}/job.png" download="Job Sample"
                               class="btn btn-primary pull-left">Download</a>
                            {{--                           <button style="margin: 0px 0px 0px 5px;" type="button" data-dismiss="modal" data-toggle="modal" data-target="#statusupdateModal" class="btn btn-primary pull-left">Add New Status</button>--}}
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade show" id="client_sampleModal" tabindex="-1" role="dialog"
     aria-labelledby="client_sampleModalLabel" aria-modal="true" style="display: none; padding-right: 17px;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="client_sampleModalLabel">Client Sample</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">

                                <img src="{{asset('assets/sample_imports')}}/client.png" width="100%">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <a href="{{asset('assets/sample_imports')}}/client.png" download="Client Sample"
                               class="btn btn-primary pull-left">Download</a>
                            {{--                           <button style="margin: 0px 0px 0px 5px;" type="button" data-dismiss="modal" data-toggle="modal" data-target="#statusupdateModal" class="btn btn-primary pull-left">Add New Status</button>--}}
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="todoeditModal" role="dialog" aria-labelledby="todoeditModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="todoeditModalLabel">Edit task</h5>
                <button type="button" id="edit_todo_cls_btn" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="javascript:void(0)" id="edit_todo_form" style="margin: 0px;">
                    <input type="hidden" id="todo_edit_id" name="todo_edit_id" value="">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Actions</label>
                                <select name="todo_action" id="edit_todo_action_list"
                                        class="multiselect-dropdown form-control">

                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Date</label>
                                {{--                                <input type="text" id="edit_todo_date" placeholder="--/--/----" name="todo_date"  data-toggle="datepicker" class="form-control">--}}
                                <input type="text" id="edit_todo_date" placeholder="--/--/----" name="todo_date"
                                       class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Time</label>
                                <input name="todo_time" id="edit_todo_time" type="time" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Task Details</label>
                                <textarea name="todo_task" id="edit_todo_task" class="form-control"
                                          placeholder=""></textarea>
                            </div>
                        </div>
                    </div>
                    <button type="button" id="todo_edit_submit" class="btn btn-primary">Edit</button>
                    <button data-id="" type="button" id="todo_delete_submit"
                            class="delete_todo btn btn-primary pull-right">Delete
                    </button>

                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="todoModal" role="dialog" aria-labelledby="todoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="todoModalLabel">Add a new task</h5>
                <button type="button" id="add_todo_cls_btn" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="javascript:void(0)" id="add_todo_form" style="margin: 0px;">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Actions</label>
                                <select name="todo_action" id="todo_action_list"
                                        class="multiselect-dropdown form-control">

                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Date</label>
                                {{--                                <input type="text" id="todo_date" placeholder="--/--/----" name="todo_date"  data-toggle="datepicker" class="form-control">--}}
                                <input type="text" id="todo_date" placeholder="--/--/----" name="todo_date"
                                       class="form-control datepicker">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Time</label>
                                <input name="todo_time" id="todo_time" type="time" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Task Details</label>
                                <textarea name="todo_task" id="todo_task" class="form-control"
                                          placeholder=""></textarea>
                            </div>
                        </div>
                    </div>
                    <button type="button" id="todo_add_submit" class="btn btn-primary">ADD</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{--update action model--}}
<div class="modal fade show" id="updateActionModel" tabindex="-1" role="dialog" aria-labelledby="ActionupdateModalLabel"
     style="display: none;" aria-modal="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="actionupdateModalLabel">Update Action</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Update Action</label>
                                <input id="action_update_name" value="" type="text" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Select Action Background Color</label>
                                <input id="action_update_color" data-testing-action="1" type="color"
                                       class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button id="model-action-update" type="button" data-dismiss="modal"
                                    class="btn btn-primary pull-left">Save
                            </button>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
</div>
{{--end update action model--}}


<div class="modal fade" id="hiredModal" role="dialog" aria-labelledby="hiredModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="hiredModalLabel">Add Placement</h5>
                <button type="button" id="close_placement_btn" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="javascript:void(0)" id="add_placement_form" style="margin: 0px;">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Start Date</label>
                                <input type="text" id="placement_start_date" placeholder="--/--/----"
                                       name="placement_start_date" data-toggle="datepicker" class="form-control">
                                {{--                                <input type="date" id="placement_start_date" name="placement_start_date" class="form-control">--}}
                                {{--                                <input type="text" class="form-control">--}}
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Company</label>
                                <select onchange="job_change_company()" class="multiselect-dropdown form-control"
                                        name="hire_company_name" id="hire_company_name" disabled="disabled">
                                    <option value="" style="display: none;"></option>
                                    @if(isset($pipelineClients))
                                        @foreach($pipelineClients as $pipelineClient)
                                            <option class="client-list-op"
                                                    value="{{$pipelineClient['id']}}">{{$pipelineClient['company_name']}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Candidate</label>
                                <select class="multiselect-dropdown form-control" name="hired_candidate"
                                        id="hired_candidate" disabled>
                                    <option value="" style="display: none;"></option>
                                    @if(isset($jobCandidates))

                                        @foreach($jobCandidates as $candidate)
                                            <option value="{{$candidate['id']}}">{{$candidate['name']}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Position</label>
                                <select class="multiselect-dropdown form-control" name="job_position" id="job_position"
                                        disabled>
                                    <option value="" style="display: none;"></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Salary</label>
                                <input type="text" name="salary" id="salary" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Service Fee</label>
                                <input type="text" name="service_fee" id="service_fee" class="form-control">
                            </div>
                        </div>
                    </div>
                    <button type="submit" id="add_placement_submit" class="btn btn-primary">Placement</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="edithiredModal" role="dialog" aria-labelledby="edithiredModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edithiredModalLabel">Edit Placement</h5>
                <button type="button" id="close_edit_placement_btn" class="close" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="javascript:void(0)" id="edit_placement_form" style="margin: 0px;">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Start Date</label>
                                <input type="hidden" id="edit_placement_id">
                                {{--                                <input type="text"  data-toggle="datepicker" class="form-control">--}}
                                {{--                                <input type="text" id="edit_placement_start_date" placeholder="--/--/----" name="placement_start_date" data-toggle="datepicker" class="form-control">--}}
                                <input type="text" id="edit_placement_start_date" placeholder="--/--/----"
                                       name="placement_start_date" class="form-control">
                                {{--                                <input type="text" class="form-control">--}}
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Company</label>
                                <select class="multiselect-dropdown form-control" name="hire_company_name"
                                        id="edit_hire_company_name" disabled="disabled">
                                    <option value="" style="display: none;"></option>
                                    @if(isset($pipelineClients))
                                        @foreach($pipelineClients as $pipelineClient)
                                            <option class="client-list-op"
                                                    value="{{$pipelineClient['id']}}">{{$pipelineClient['company_name']}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Candidate</label>
                                <select class="multiselect-dropdown form-control" name="hired_candidate"
                                        id="edit_hired_candidate" disabled="disabled">
                                    <option value="" style="display: none;"></option>
                                    @if(isset($jobCandidates))

                                        @foreach($jobCandidates as $candidate)
                                            <option value="{{$candidate['id']}}">{{$candidate['name']}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Position</label>
                                <select class="multiselect-dropdown form-control" name="job_position"
                                        id="edit_job_position" disabled="disabled">
                                    <option value="" style="display: none;"></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Salary</label>
                                <input type="text" name="salary" id="edit_salary" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Service Fee</label>
                                <input type="text" name="service_fee" id="edit_service_fee" class="form-control">

                            </div>
                        </div>
                    </div>
                    <button type="submit" id="edit_placement_submit" class="btn btn-primary">Placement</button>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="editcontractformModal" role="dialog" aria-labelledby="editcontractformModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editcontractformModalLabel">Edit Contract</h5>
                <button type="button" id="edit_contract_close_btn" class="close" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('contractedit')}}" method="post" id="edit_contract_form"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Full Name</label>
                                <input type="hidden" name="contract_id_edit" id="contract_id_edit">
                                <input type="text" name="edit_full_name" id="edit_full_name" class="form-control"
                                       placeholder="" disabled>
                                @error('full_name')
                                <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Job Title</label>
                                <input type="text" name="edit_job_title" id="edit_job_title" class="form-control"
                                       placeholder="" disabled>
                                @error('job_title')
                                <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Phone Number</label>
                                <input type="text" name="edit_phone_no" id="edit_phone_no" class="form-control"
                                       placeholder="" disabled>
                                @error('phone_no')
                                <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email Address</label>
                                <input type="email" name="edit_email_address" id="edit_email_address"
                                       class="form-control" placeholder="" disabled>
                                @error('email_address')
                                <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Industry</label>
                                <input type="text" name="industry" id="edit_industry_contract" class="tags form-control"
                                       placeholder="" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Business Website</label>
                                <input type="text" name="edit_business_web" id="edit_business_web" class="form-control"
                                       placeholder="" disabled>
                                @error('business_web')
                                <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Business Main Address</label>
                                <input type="text" name="edit_business_address" id="edit_business_address"
                                       class="form-control" placeholder="">
                                @error('business_address')
                                <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Business Phone Number</label>
                                <input type="text" name="edit_business_number" id="edit_business_number"
                                       class="form-control" placeholder="">
                                @error('business_number')
                                <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Position (s) looking to fill</label>
                                <input type="text" name="edit_positions" id="edit_positions" class="form-control"
                                       placeholder="">
                                @error('positions')
                                <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Number of Openings</label>
                                <input type="number" name="edit_opening" id="edit_opening" class="form-control"
                                       placeholder="">
                                @error('opening')
                                <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Quoted Fee</label>
                                <input type="text" name="edit_quoted_fee" id="edit_quoted_fee" class="form-control"
                                       placeholder="">
                                @error('quoted_fee')
                                <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Upload Contract &nbsp;&nbsp;&nbsp;<small>Only PDF,Docx and Doc</small>
                                </label>
                                <div enctype="multipart/form-data">
                                    <input name="contract_file" id="file-error2" type="file">
                                    @error('resume')
                                    <div class="error">{{ $message }}</div>
                                    @enderror

                                </div>
                                <label id="file-upload-demo-error" class="error" for="file-error2"
                                       style="display: none">Only PDF DOC and Docx files are allowed</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="optional">Receiver's Email Address</label>
                                <input type="text" name="emails[]" class="form-control tags_5" placeholder="">

                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="pdf-remove-img">
                                <ul>
                                    {{--                                      <li id="edit-contract-file"><figure><a target="_blank" href=""><i class="fa "></i></a></figure></li>--}}
                                    <li>
                                        <figure id="edit-contract-file"></figure>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        {{--                        <div class="col-md-6">--}}
                        {{--                            <div class="form-group">--}}
                        {{--                                <label>Types of Industry</label>--}}
                        {{--                                <input type="text" id="tags_1" class="tags form-control" placeholder="">--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary pull-left">Submit</button>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="contractformModal" role="dialog" aria-labelledby="contractformModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="contractformModalLabel">Contract</h5>
                <button type="button" id="contract_close_btn" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('addcontract')}}" method="post" id="contract_form" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Business Legal Name</label>
                                <select onchange="autofill_contract()" id="contract_clients" name="client_id"
                                        class="contract_clients multiselect-dropdown form-control">


                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Full Name</label>
                                <input type="text" name="full_name" id="full_name_contract" class="form-control"
                                       placeholder="" disabled>
                                @error('full_name')
                                <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Job Title</label>
                                <input type="text" name="job_title" id="job_title_contract" class="form-control"
                                       placeholder="" disabled>
                                @error('job_title')
                                <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Phone Number</label>
                                {{--                                pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}"    --}}
                                {{--                                <input type="text" name="phone_no" id="phone_no_contract" class="form-control"  pattern="(([+][(]?[0-9]{1,3}[)]?)|([(]?[0-9]{4}[)]?))\s*[)]?[-\s\.]?[(]?[0-9]{1,3}[)]?([-\s\.]?[0-9]{3})([-\s\.]?[0-9]{3,4})"  placeholder="">--}}
                                <input type="text" name="phone_no" id="phone_no_contract" class="form-control"
                                       placeholder="" disabled>
                                @error('phone_no')
                                <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email Address</label>
                                <input type="email" name="email_address" id="email_address_contract"
                                       class="form-control" placeholder="" disabled>
                                @error('email_address')
                                <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Industry</label>
                                <input type="text" name="industry" id="industry_contract" class="tags form-control"
                                       placeholder="" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Business Website</label>
                                <input type="text" name="business_web" id="business_web_contract" class="form-control"
                                       placeholder="" disabled>
                                @error('business_web')
                                <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{--                        <div class="col-md-6">--}}
                        {{--                            <div class="form-group">--}}
                        {{--                                <label>Business Legal Name (include LLC or Inc. if available)</label>--}}
                        {{--                                <input type="text" name="business_name" class="form-control" placeholder="">--}}
                        {{--                                @error('business_name')--}}
                        {{--                                <div class="error">{{ $message }}</div>--}}
                        {{--                                @enderror--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Business Main Address</label>
                                <input type="text" name="business_address" class="form-control" placeholder="">
                                @error('business_address')
                                <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Business Phone Number</label>
                                {{--                                <input type="text" name="business_number" class="form-control" pattern="(([+][(]?[0-9]{1,3}[)]?)|([(]?[0-9]{4}[)]?))\s*[)]?[-\s\.]?[(]?[0-9]{1,3}[)]?([-\s\.]?[0-9]{3})([-\s\.]?[0-9]{3,4})" placeholder="">--}}
                                <input type="text" name="business_number" class="form-control" placeholder="">
                                @error('business_number')
                                <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Position (s) looking to fill</label>
                                <input type="text" name="positions" class="form-control" placeholder="">
                                @error('positions')
                                <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Number of Openings</label>
                                <input type="number" name="opening" class="form-control" placeholder="">
                                @error('opening')
                                <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Quoted Fee</label>
                                <input type="text" name="quoted_fee" id="quoted_fee" class="form-control"
                                       placeholder="">
                                @error('quoted_fee')
                                <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Upload Contract &nbsp;&nbsp;<small>Only PDF,Docx and Doc</small>
                                </label>
                                <div enctype="multipart/form-data">
                                    <input name="contract_file" id="file-error1" type="file">
                                    @error('resume')
                                    <div class="error">{{ $message }}</div>
                                    @enderror

                                </div>
                                <label id="file-upload-demo-error" class="error" for="file-error1"
                                       style="display: none">Only PDF DOC and Docx files are allowed</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="optional">Receiver's Email Address</label>
                                <input type="text" name="emails[]" class="form-control tags_5" placeholder="">

                            </div>
                        </div>

                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary pull-left">Submit</button>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="contact_candidateModal" role="dialog" aria-labelledby="econtact_candidateModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="contact_candidateModalLabel">Contact</h5>
                <button type="button" class="close" id="contact_candidatemodal-close" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('send_email')}}" method="post" style="margin: 0px;" id="contact_candidate_form">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="hidden" class="form-control" id="candidate_id_contact" name="candidate_id">
                                <label>Subject</label>
                                <input type="text" class="form-control" name="subject" placeholder="Type Subject">

                                @error('subject')
                                <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Message</label>
                                <textarea placeholder="Type here" id="contact_message" name="message"
                                          class="form-control"></textarea>
                                @error('message')
                                <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <button type="submit" class="btn btn-primary">send</button>
                </form>
            </div>
        </div>
    </div>
</div>


{{--<!-- Modal -->--}}
<div class="modal fade" id="interview_detail_modal" tabindex="-1" role="dialog"
     aria-labelledby="interview_detail_modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="interview_detail_modalLabel">Schedule Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table style="width: 100%;"
                           class="table table-detail table-hover table-striped table-bordered table-cursor">
                        <tbody>
                        <tr>
                            <th>Company Name:</th>
                            <td id="d_company_name"></td>
                        </tr>
                        <tr>
                            <th>Job Title:</th>
                            <td id="d_job_name"></td>
                        </tr>
                        <tr>
                            <th>Candidate Name:</th>
                            <td id="d_candidate_name"></td>
                        </tr>
                        <tr>
                            <th>Status:</th>
                            <td><img width="50px" height="50px" src="" id="d_status"></td>
                        </tr>
                        <tr>
                            <th>Location:</th>
                            <td id="d_location"></td>
                        </tr>
                        <tr>
                            <th>Date:</th>
                            <td id="d_date"></td>
                        </tr>
                        <tr>
                            <th>From:</th>
                            <td id="d_start_date"></td>
                        </tr>
                        <tr>
                            <th>To:</th>
                            <td id="d_end_date"></td>
                        </tr>
                        <tr>
                            <th>Time Zone:</th>
                            <td id="d_time_zone"></td>
                        </tr>
                        <tr>
                            <th>Subject:</th>
                            <td id="d_subject"></td>
                        </tr>
                        <tr>
                            <th>Receiver's Email Address:</th>
                            <td id="d_emails"></td>
                        </tr>
                        <tr>
                            <th>Message:</th>
                            <td id="d_message"></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


{{--{-- pipeline update status model--}}
<div class="modal fade show" id="pipelinestatusModal" role="dialog" aria-labelledby="pipelinestatusModalLabel"
     aria-modal="true" style="display: none; padding-right: 17px;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pipelinestatusModalLabel">Update Status</h5>
                <button type="button" class="close" id="pipeline_status_cls_btn" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    {{--                    hidden field for get the current status_id--}}
                    <input id="candidate_id_pipeline" type="hidden">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <select id="pipeline_status_list" name="pipeline_status"
                                        class="multiselect-dropdown form-control">


                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button id="update-status-pipeline_btn" data-dismiss="modal" type="button"
                                    class="btn btn-primary pull-left">Update
                            </button>
                            {{--                           <button style="margin: 0px 0px 0px 5px;" type="button" data-dismiss="modal" data-toggle="modal" data-target="#statusupdateModal" class="btn btn-primary pull-left">Add New Status</button>--}}
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
</div>


{{--{-- interview update status model--}}
<div class="modal fade show" id="interviewstatusModal" role="dialog" aria-labelledby="interviewstatusModalLabel"
     aria-modal="true" style="display: none; padding-right: 17px;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="statusModalLabel">Update Status</h5>
                <button type="button" class="close" id="interview_status_cls_btn" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    {{--                    hidden field for get the current status_id--}}
                    <input id="status_id_interview" type="hidden">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <select id="interview_status_list" name="interview_status"
                                        class="multiselect-dropdown form-control">


                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button id="update-status-interview_btn" data-dismiss="modal" type="button"
                                    class="btn btn-primary pull-left">Update
                            </button>
                            {{--                           <button style="margin: 0px 0px 0px 5px;" type="button" data-dismiss="modal" data-toggle="modal" data-target="#statusupdateModal" class="btn btn-primary pull-left">Add New Status</button>--}}
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="dashboard_candidate_notes_modal" tabindex="-1" role="dialog"
     aria-labelledby="dashboard_candidate_notesLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="dashboard_candidate_notesLabel">Add Notes</h5>
                <button type="button" id="candidate_add_note_close_btn" class="close" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <input id="dasboard_cadidate_id" type="hidden" name="candidate_id">
                <div class="form-group">
                    <label>Type Here</label>
                    <textarea id="pipeline_new_note" class="form-control note-val" name="note" placeholder=""
                              required></textarea>
                    <div class="error " id="empty_note" style="display: none;">Note is Required</div>
                </div>
                {{--                <button id="candidate_add_note_btn" data-dismiss="modal" class="btn btn-primary">Submit</button>--}}
                <button id="candidate_add_note_btn" class="btn btn-primary">Submit</button>

            </div>
        </div>
    </div>
</div>


<!-- -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Notes</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <input id="client_id" type="hidden" name="client_id">
                <div class="form-group">
                    <label>Type Here</label>
                    <textarea id="node-cus" class="form-control note-val" name="note" placeholder=""
                              required></textarea>
                </div>
                <button id="node-add-dashboard" data-dismiss="modal" class="btn btn-primary">Submit</button>

            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="exampleModal-1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Notes</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <input id="client_id" type="hidden" name="client_id">
                <div class="form-group">
                    <label>Type Here</label>
                    <textarea id="node-cus-cand" class="form-control" name="note" placeholder="" required></textarea>
                </div>
                <button id="node-add-candidate" data-dismiss="modal" class="btn btn-primary">Submit</button>

            </div>
        </div>
    </div>
</div>

{{--New Status pop up--}}
<div class="modal fade" id="new_status_Modal" tabindex="-1" role="dialog" aria-labelledby="new_status_ModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="new_status_ModalLabel">Add Status</h5>
                <button type="button" id="close_status_modal" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Create New Status</label>
                            <input id="status_name_modal" name="status_name" type="text" class="form-control"
                                   placeholder="" required>
                            <div class="error exist_status" style="display: none;">Status Already Exist</div>
                            <div class="error empty_status" style="display: none;">Status Name is Required</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Select Status Background Color</label>
                            <input id="status_color" name="color" type="color" class="form-control" placeholder=""
                                   required>
                        </div>
                    </div>
                </div>
                {{--                <button id="new_status_sub" data-dismiss="modal" class="btn btn-primary">Submit</button>--}}
                <button id="new_status_sub" class="btn btn-primary">Submit</button>

            </div>
        </div>
    </div>
</div>


{{--for search page--}}
<div class="modal fade" id="exampleModal-search" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Notes</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <input id="client_id" type="hidden" name="client_id">
                <input id="cand-id-custom-search" type="hidden">

                <div class="form-group">
                    <label>Type Here</label>
                    <textarea id="node-cus-cand-search" class="form-control" name="note" placeholder=""
                              required></textarea>
                </div>
                <button id="node-add-candidate-search" data-dismiss="modal" class="btn btn-primary">Submit</button>

            </div>
        </div>
    </div>
</div>
{{--end for search page--}}


<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Notes</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <input id="client_id" type="hidden" name="client_id">
                <div class="form-group">
                    <label>Type Here</label>
                    <textarea id="node-cus1" class="form-control" name="note" placeholder="" required></textarea>
                </div>
                <button id="node-add-dashboard1" data-dismiss="modal" class="btn btn-primary">Submit</button>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editNotecandidate" tabindex="-1" role="dialog" aria-labelledby="editNotecandidateLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editNotecandidateLabel">Edit Note</h5>
                <button type="button" id="edit_note_candidate_cls_btn" class="close" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <input id="note_id_note_edit" type="hidden" name="note_id">
                <div class="form-group">
                    <label>Type Here</label>
                    <textarea id="node-edit-candidate" class="form-control" name="note" placeholder=""
                              required></textarea>
                </div>
                <button id="edit_note_candidate_btn" class="btn btn-primary">Submit</button>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editNotePopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Notes</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input id="client_id" type="hidden" name="client_id">
                <div class="form-group">
                    <label>Type Here</label>
                    <textarea id="node-edit-clas" class="form-control" name="note" placeholder="" required></textarea>
                </div>
                <button id="note-edit-submit" data-dismiss="modal" class="btn btn-primary">Submit</button>

            </div>
        </div>
    </div>
</div>


{{--update status model--}}
<div class="modal fade show" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="statusModalLabel"
     aria-modal="true" style="display: none; padding-right: 17px;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="statusModalLabel">Update Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    {{--                    hidden field for get the current status_id--}}
                    <input id="status_id_cand" type="hidden">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <select id="status-updated-slc" name="status_updated_slc" class="form-control ">
                                    @if(isset($statuses))
                                        @foreach($statuses as $status)
                                            <option image="{{asset('status_icons')}}/{{$status['status_icon']}}"
                                                    value="{{$status['id']}}">{{$status['name']}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button id="update-status" type="button" data-dismiss="modal"
                                    class="btn btn-primary pull-left">Update
                            </button>
                            {{--                           <button style="margin: 0px 0px 0px 5px;" type="button" data-dismiss="modal" data-toggle="modal" data-target="#statusupdateModal" class="btn btn-primary pull-left">Add New Status</button>--}}
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
</div>

{{--end update status model--}}

{{--update interview stage--}}
<div class="modal fade show" id="updateInterviewStageModel" tabindex="-1" role="dialog"
     aria-labelledby="statusupdateModalLabel" style="display: none;" aria-modal="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="statusupdateModalLabel">Update Interview stage</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Update Interview Stage</label>
                                <input id="s_name_1" type="text" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Select Interview Stage Background Color</label>
                                <input id="s_color_1" type="color" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button id="model-interview-update" type="button" data-dismiss="modal"
                                    class="btn btn-primary pull-left">Save
                            </button>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
</div>

{{--end update interview stages--}}

{{--update interview status--}}
<div class="modal fade show" id="updateInterviewStatusModel" tabindex="-1" role="dialog"
     aria-labelledby="statusupdateModalLabel" style="display: none;" aria-modal="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="statusupdateModalLabel">Update Interview Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Update Interview Status</label>
                                <input id="s_name_2" type="text" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Select Interview Status Background Color</label>
                                <input id="s_color_2" type="color" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button id="model-interview-status-update" type="button" data-dismiss="modal"
                                    class="btn btn-primary pull-left">Save
                            </button>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
</div>

{{--end update interview status--}}

{{--create status model--}}
<div class="modal fade show" id="statusupdateModal" tabindex="-1" role="dialog" aria-labelledby="statusupdateModalLabel"
     style="display: none;" aria-modal="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="statusupdateModalLabel">Add New Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Create new status</label>
                                <input type="text" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Select Status BackgroundBackground Color</label>
                                <input type="color" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary pull-left">Submit</button>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
</div>
{{--end create status model--}}

{{--update status model--}}
<div class="modal fade show" id="updateStatusModel" tabindex="-1" role="dialog" aria-labelledby="statusupdateModalLabel"
     style="display: none;" aria-modal="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="statusupdateModalLabel">Update Status</h5>
                <button type="button" id="update_status_cls_btn" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('status.update.main')}}" enctype="multipart/form-data"
                      id="update_status_form">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Status Name</label>
                                <input id="s_name" name="name" type="text" class="form-control" placeholder="">
                                <input id="status_id" name="id" type="hidden">
                            </div>
                        </div>
                        <div class="col-md-12">
                            {{--                            <div class="form-group">--}}
                            {{--                                <label>Select Status Background Color</label>--}}
                            {{--                                <input id="s_color" type="color" class="form-control" placeholder="">--}}
                            {{--                            </div>--}}
                            <div class="form-group">
                                <label class="optional">Status Icon</label>
                                <div enctype="multipart/form-data">
                                    <input name="status_icon" class="" id="file-upload-demo" type="file">
                                    @error('status_icon')
                                    <div class="error">{{ $message }}</div>
                                    @enderror

                                </div>
                                <label id="file-upload-demo-error" class="error" for="file-upload-demo"
                                       style="display: none">Please select Status icon</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="optional">Previous Icon</label>
                                <div enctype="multipart/form-data">
                                    <img id="update_status_icon" width="50px" height="50px" src="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button id="model-stts-update" type="button" class="btn btn-primary pull-left">Save</button>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
</div>
{{--end update status model--}}

<div class="modal fade" id="emptypresentModal" role="dialog" aria-labelledby="emptypresentModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="emptypresentModalLabel">Present</h5>
                <button type="button" class="close" id="emptymodal-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('send_cv')}}" method="post" style="margin: 0px;" id="present_form_empty">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Company Name</label>
                                <select onchange="emptyfunctionSet()" id="company_name_empty_present"
                                        class="multiselect-dropdown client-list-check form-control" name="company_name">
                                    <option value="" style="display: none">Select Company</option>
                                    @if(isset($pipelineClients))
                                        @foreach($pipelineClients as $pipelineClient)
                                            <option class="client-list-op"
                                                    value="{{$pipelineClient['id']}}">{{$pipelineClient['company_name']}}</option>
                                        @endforeach
                                    @endif

                                </select>
                                @error('client')
                                <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Job Title</label>
                                <select class="multiselect-dropdown form-control" name="job_title"
                                        id="job-list-empty-present">
                                    <option value="" style="display: none;"></option>
                                </select>
                                @error('job_title')
                                <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Candidate Name</label>
                                <select class="multiselect-dropdown form-control " id="candidate-id-empty-present"
                                        multiple name="candidates[]">
                                    <option value="" style="display: none;"></option>
                                    @if(isset($jobCandidates))

                                        @foreach($jobCandidates as $candidate)
                                            <option value="{{$candidate['id']}}">{{$candidate['name']}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('candidates')
                                <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Subject</label>
                                <input type="text" class="form-control" name="subject">

                                @error('subject')
                                <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="optional">Receiver's Email Address</label>
                                <input type="text" id="recievers_emails" name="emails[]" class="form-control tags_5"
                                       placeholder="">
                                <input type="hidden" id="hidden_emails" name="hidden_emails" class="form-control "
                                       placeholder="">

                                @error('subject')
                                <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Summary</label>
                                <textarea placeholder="Type here" name="summary" class="form-control"></textarea>
                                @error('summary')
                                <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group"><strong class="note"><span>Important Note :</span> Always remove the
                                    contact info from the candidate's resume, add our company logo and our contact info
                                    before hitting the "Present" button.</strong></div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">PRESENT</button>
                </form>
            </div>
        </div>
    </div>
</div>
{{--end present--}}


{{--present--}}

<div class="modal fade" id="presentModal" role="dialog" aria-labelledby="presentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="presentModalLabel">Present</h5>
                <button type="button" class="close" id="modal-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('send_cv')}}" method="post" style="margin: 0px;" id="present_form">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Company Name</label>
                                <select onchange="functionSet()" id="company_name_present"
                                        class="multiselect-dropdown client-list-check form-control" name="company_name">
                                    <option value="" style="display: none">Select Company</option>
                                    @if(isset($pipelineClients))
                                        @foreach($pipelineClients as $pipelineClient)
                                            <option class="client-list-op"
                                                    value="{{$pipelineClient['id']}}">{{$pipelineClient['company_name']}}</option>
                                        @endforeach
                                    @endif

                                </select>
                                @error('client')
                                <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Job Title</label>
                                <select class="multiselect-dropdown form-control" name="job_title"
                                        id="job-list-present">
                                    <option value="" style="display: none;"></option>
                                </select>
                                @error('job_title')
                                <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Candidate Name</label>
                                <select class="multiselect-dropdown form-control " id="candidate-id-present" multiple
                                        name="candidates[]">
                                    <option value="" style="display: none;"></option>
                                    @if(isset($jobCandidates))

                                        @foreach($jobCandidates as $candidate)
                                            <option value="{{$candidate['id']}}">{{$candidate['name']}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('candidates')
                                <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Subject</label>
                                <input type="text" class="form-control" name="subject">

                                @error('subject')
                                <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="optional">Receiver's Email Address</label>
                                <input type="text" id="recievers_emails" name="emails[]" class="form-control tags_5"
                                       placeholder="">

                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Summary</label>
                                <textarea placeholder="Type here" name="summary" class="form-control"></textarea>
                                @error('summary')
                                <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group"><strong class="note"><span>Important Note :</span> Always remove the
                                    contact info from the candidate's resume, add our company logo and our contact info
                                    before hitting the "Present" button.</strong></div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">PRESENT</button>
                </form>
            </div>
        </div>
    </div>
</div>
{{--end present--}}


{{--edit education--}}
<div class="modal fade show" id="eduactionModal" tabindex="-1" role="dialog" aria-labelledby="statusModalLabel"
     aria-modal="true" style="display: none; padding-right: 17px;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="statusModalLabel">Update Education</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Update Education</label>
                                <input id="e_name" type="text" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button id="update-education" type="button" data-dismiss="modal"
                                    class="btn btn-primary pull-left">Save
                            </button>
                            {{--                           <button style="margin: 0px 0px 0px 5px;" type="button" data-dismiss="modal" data-toggle="modal" data-target="#statusupdateModal" class="btn btn-primary pull-left">Add New Status</button>--}}
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
</div>

{{--end edit education--}}

{{--pipeline model--}}
<div class="modal fade" id="pipelineModal_letest" role="dialog" aria-labelledby="pipelineModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pipelineModalLabel">Add to recruitment pipeline</h5>
                <button type="button" class="close" id="pipelineModal_letest_cls_btn" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" style="margin: 0px;">
                    <input id="candiate-id-for-pipeline" type="hidden">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Select Client Name</label>
                                <select onchange="jobPicker()" id="select-client-name"
                                        class="multiselect-dropdown form-control" name="" id="">
                                    @if(isset($pipelineClients) )
                                        @foreach($pipelineClients as $client)
                                            <option value="{{$client->id}}">{{$client->company_name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Select Job</label>
                                <select id="select-job-name" class="multiselect-dropdown form-control" name="">

                                </select>
                                <p style="display: none" id="error-job-cand-pipeline" class="error">Please select a
                                    job.</p>
                            </div>
                        </div>
                    </div>
                    <button id="add-candidate-pipeline-submit" type="button" class="btn btn-primary">ADD</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{--end pipeline model--}}

{{--update status model--}}
<div class="modal fade show" id="statusModal-client-dashboard" role="dialog" aria-labelledby="statusModalLabel"
     aria-modal="true" style="display: none; padding-right: 17px;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="statusModalLabel">Update Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <input id="status_id_cand" type="hidden">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <select id="status-updated-slc-client-dashboard" name="status_updated_slc"
                                        class="form-control multiselect-dropdown">


                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button id="update-status-client-dash" type="button" data-dismiss="modal"
                                    class="btn btn-primary pull-left">Update
                            </button>
                            {{--                           <button style="margin: 0px 0px 0px 5px;" type="button" data-dismiss="modal" data-toggle="modal" data-target="#statusupdateModal" class="btn btn-primary pull-left">Add New Status</button>--}}
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
</div>

{{--end update status model--}}


{{ Html::script('assets\scripts\jquery.tagsinput.min.js') }}
{{ Html::script('assets\scripts\file-input\sortable.js') }}
{{ Html::script('assets\scripts\file-input\fileinput.js') }}
{{ Html::script('assets\scripts\file-input\theme.js') }}
{{ Html::script('https://unpkg.com/sweetalert/dist/sweetalert.min.js') }}
{{-- {{ Html::script('assets\scripts\dataTables.bootstrap.min.js') }}--}}
{{--{{ Html::script('assets\scripts\datatables.min.js') }}--}}

{{ Html::script('https://cdn.ckeditor.com/ckeditor5/11.2.0/classic/ckeditor.js') }}
{{--<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>--}}
{{--<script src="https://cdn.ckeditor.com/ckeditor5/11.2.0/classic/ckeditor.js"></script>--}}
{{ Html::script('assets\scripts\additional-methods.min.js') }}

{{ Html::script('assets\scripts\functions.js') }}
{{ Html::script('assets\scripts\custom.js') }}
{{ Html::script('assets\scripts\validation.js') }}
{{--{{ Html::script('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/js/select2.full.min.js') }}--}}
{{ Html::script('https://cdnjs.cloudflare.com/ajax/libs/datepicker/0.6.5/datepicker.min.js') }}


{{--<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.min.js"></script>--}}
<script>
    function changelogin() {
        var val = $('#view_as_pipeline').val();
        $.ajax({
            url: "{{route('changelogin')}}",
            type: 'post',

            data: {

                "_token": "{{ csrf_token() }}",
                "id": val,

            },
            beforeSend: function () {
                $.blockUI({
                    message: '<div class="spinner-grow text-success"></div><div class="spinner-grow text-success"></div><div class="spinner-grow text-success"></div>',
                    css: {
                        border: 'none',
                        backgroundColor: 'transparent'
                    }
                });
            },
            complete: function (data) {
                $.unblockUI();
            }
            // dataType: 'json'
        }).done(function (res) {
            location.reload();
        });
    }

    $(document).on('click', '.admin_resume', function () {


        var id = $(this).attr('dataId');
        // alert(id);


        swal({

            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this Resume!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "{{route('sub_admin_resume_delete')}}",
                        type: 'post',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            id: id
                        },
                        beforeSend: function () {
                            $.blockUI({
                                message: '<div class="spinner-grow text-success"></div><div class="spinner-grow text-success"></div><div class="spinner-grow text-success"></div>',
                                css: {
                                    border: 'none',
                                    backgroundColor: 'transparent'
                                }
                            });
                        },
                        complete: function (data) {
                            $.unblockUI();
                        }
                    }).done(function (res) {

                        $('#resume_div').remove();
                        swal("Resume is Successfully deleted!");

                    });
                } else {
                    swal("Your Resume is safe!");
                }

            });

    });


</script>


<script>
    $(".privilege-checkbox").click(function () {
        var value = $(this).val();
        if (value == 1) {
            $('input:checkbox').not(this).prop('checked', this.checked);
        }
    });
</script>
<script>
    $("#candidate_checklist").click(function () {
        $('input:checkbox').not(this).prop('checked', this.checked);
    });
</script>
<script>
    $('.bulk_delete_todo').click(function () {
        var list = [];
        var id;
        var line1;
        var line2;
        var all_tr = $('.todo_checkboxes:checkbox:checked').parent().parent();
        // console.log(all_tr.length);
        if (all_tr.length == 1) {
            line1 = 'You really want to remove this Todo!';
            line2 = 'Your todo is safe';
        } else {
            line1 = "You really want to remove all these To dos!";
            line2 = "Your To dos are safe!";
        }
        swal({

            title: "Are you sure?",
            text: line1,
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    for (let i = 0; i < all_tr.length; i++) {
                        id = all_tr.eq(i).attr('data-id');
                        // $('#todo-'+id).prev().remove();
                        // $('#todo-'+id).remove();
                        list[i] = id;
                        // alert('eq '+id);
                    }
                    // console.log(list);
                    $.ajax({
                        url: "{{route('bulkdeletetodo')}}",
                        type: 'post',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            list: list
                        },
                        beforeSend: function () {
                            $.blockUI({
                                message: '<div class="spinner-grow text-success"></div><div class="spinner-grow text-success"></div><div class="spinner-grow text-success"></div>',
                                css: {
                                    border: 'none',
                                    backgroundColor: 'transparent'
                                }
                            });
                        },
                        complete: function (data) {
                            $.unblockUI();
                        }
                    }).done(function (response) {
                        pageloading(0);
                        // alert(id);
                    });
                } else {
                    swal(line2);
                }

            });
    });
    $("#todo_checklist").click(function () {
        $('input:checkbox').not(this).prop('checked', this.checked);
    });
</script>

<script>

    $('#todo_add_submit').click(function () {

        if ($('#add_todo_form').valid()) {
            $('#add_todo_cls_btn').click();

            var action = $('#todo_action_list').val();
            var date = $('#todo_date').val();
            var time = $('#todo_time').val();
            var task = $('#todo_task').val();
            $.ajax({
                url: "{{route('addtodo')}}",
                type: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    action: action, date: date, time: time, task: task
                },
                beforeSend: function () {
                    $.blockUI({
                        message: '<div class="spinner-grow text-success"></div><div class="spinner-grow text-success"></div><div class="spinner-grow text-success"></div>',
                        css: {
                            border: 'none',
                            backgroundColor: 'transparent'
                        }
                    });
                },
                complete: function (data) {
                    $.unblockUI();
                }
            }).done(function (res) {
                var pathname = window.location.pathname.split("/").pop();
                // console.log(pathname);
                if (pathname == 'calendar') {
                    location.reload();
                } else {

                    pageloading(0);
                    swal("Todo is Successfully Created!");
                }
            });
        }


    });
    $('#todo_edit_submit').click(function () {

        if ($('#edit_todo_form').valid()) {
            $('#edit_todo_cls_btn').click();

            var action = $('#edit_todo_action_list').val();
            var date = $('#edit_todo_date').val();
            var time = $('#edit_todo_time').val();
            var task = $('#edit_todo_task').val();
            var id = $('#todo_edit_id').val();
            $.ajax({
                url: "{{route('edittodo')}}",
                type: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    action: action, date: date, time: time, task: task, id: id
                },
                beforeSend: function () {
                    $.blockUI({
                        message: '<div class="spinner-grow text-success"></div><div class="spinner-grow text-success"></div><div class="spinner-grow text-success"></div>',
                        css: {
                            border: 'none',
                            backgroundColor: 'transparent'
                        }
                    });
                },
                complete: function (data) {
                    $.unblockUI();
                }
            }).done(function (res) {
                // $.when($('#close_edit_placement_btn').click()).then(function () {
                //     placement_table.draw();
                //     swal("Candidate placement is successfully edited!");
                //
                // });
                var pathname = window.location.pathname.split("/").pop();
                // console.log(pathname);
                if (pathname == 'calendar') {
                    location.reload();
                } else {

                    pageloading(0);
                    swal("Todo is Successfully Updated!");
                }


            });
        }
    });
    $(document).on('click', '.delete_todo', function () {

        var pathname = window.location.pathname.split("/").pop();
        // console.log(pathname);
        if (pathname == 'calendar') {
            $('#edit_todo_cls_btn').click();
        }

        var id = $(this).attr('data-id');
        // alert(id);


        swal({

            title: "Are you sure?",
            text: "You really want to remove this Todo!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "{{route('deletetodo')}}",
                        type: 'post',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            id: id
                        },
                    }).done(function (res) {

                        var pathname = window.location.pathname.split("/").pop();
                        // console.log(pathname);
                        if (pathname == 'calendar') {
                            location.reload();
                        } else {

                            pageloading(0);
                            swal("Todo is Successfully deleted!");
                        }
                    });
                } else {
                    swal("Your todo is safe!");
                }

            });

    });

    // $('.edit_todo').click(function () {
    function edit_todo(todo_id) {

        $('#todo_delete_submit').hide();

        $.ajax({
            url: "{{route('searchtodo')}}",
            type: 'post',
            data: {
                "_token": "{{ csrf_token() }}",
                id: todo_id
            },

        }).done(function (res) {

            var json = JSON.parse(res);
            // console.log(json);
            var opt = '';
            var cho = '';
            // var date = date
            $('#edit_todo_date').datepicker("setDate", json[0]['date']);
            // $('[data-toggle="datepicker"]').datepicker("setDate", json[0]['date']);

            // $('#edit_todo_date').val(json[0]['date']);
            $('#edit_todo_time').val(json[0]['todo']['time']);
            $('#edit_todo_task').val(json[0]['todo']['details']);
            $('#todo_edit_id').val(json[0]['todo']['id']);


            // console.log(json);
            for (var i = json[0]['action'].length - 1; i >= 0; i--) {
                if (json[0]['todo']['action_id'] == json[0]['action'][i]['id']) {
                    cho = 'selected';
                } else {
                    cho = '';
                }

                opt += '<option value="' + json[0]['action'][i]['id'] + '" ' + cho + '>' + json[0]['action'][i]['name'] + '</option>'
            }

            document.getElementById('edit_todo_action_list').innerHTML = opt;
        });
    }

    // });
    $('#new_todo').click(function () {
        $('#todo_date').datepicker();
        $.ajax({
            url: "{{route('todoactionslist')}}",
            type: 'get',

        }).done(function (res) {

            var json = JSON.parse(res);
            // console.log(json);
            var opt = '';
            // console.log(json);
            for (var i = json.length - 1; i >= 0; i--) {

                opt += '<option value="' + json[i]['id'] + '" >' + json[i]['name'] + '</option>'
            }

            document.getElementById('todo_action_list').innerHTML = opt;
        });
    });

    function autofill_contract() {
        var client_id = $('.contract_clients option:selected').val();
        $.ajax({
            url: "{{route('clientsearchAjax')}}",
            type: 'post',
            data: {
                "_token": "{{ csrf_token() }}",
                client_id: client_id
            },
        }).done(function (res) {

            var json = JSON.parse(res);
            // console.log(json);
            $('#full_name_contract').val(json[0]['name']);
            $('#job_title_contract').val(json[0]['job_title']);
            $('#phone_no_contract').val(json[0]['phone']);
            $('#email_address_contract').val(json[0]['email']);
            $('#business_web_contract').val(json[0]['web_url']);
            $('#industry_contract').val(json[0]['industry']);
        });
    }

    $(document).on('click', '.delete_placement', function () {
        var id = $(this).attr('data-id');

        swal({

            title: "Are you sure",
            text: "You want to remove this job placement!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "{{route('deleteplacement')}}",
                        type: 'post',

                        data: {

                            "_token": "{{ csrf_token() }}",
                            "id": id,

                        },

                        // dataType: 'json'
                    }).done(function (res) {
                        placement_table.draw();
                        swal("Your job still in pipeline!");
                        // $('#job-id-'+id).prev().remove();
                        // $('#job-id-'+id).remove();
                    });
                } else {
                    swal("Your job still in pipeline!");
                }

            });
    });
    $(document).on('click', '#edit_placement_submit', function () {
        var s_date = $('#edit_placement_start_date').val();
        var company = $('#edit_hire_company_name').val();
        var candidate = $('#edit_hired_candidate').val();
        var job = $('#edit_job_position').val();
        var salary = $('#edit_salary').val();
        var fee = $('#edit_service_fee').val();
        var id = $('#edit_placement_id').val();
        if ($("#edit_placement_form").valid()) {
            $.ajax({
                url: "{{route('editplacement')}}",
                type: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    id: id, s_date: s_date, company: company, candidate: candidate, job: job, salary: salary, fee: fee
                },
            }).done(function (res) {
                $.when($('#close_edit_placement_btn').click()).then(function () {
                    placement_table.draw();
                    swal("Candidate placement is successfully edited!");

                });

                // alert('date '+s_date+' company '+company+' candidate '+candidate+' job '+job+' salary '+salary+' fee '+fee);

            });
        }
    });
    $(document).on('click', '#add_placement_submit', function () {
        var s_date = $('#placement_start_date').val();
        var company = $('#hire_company_name').val();
        var candidate = $('#hired_candidate').val();
        var job = $('#job_position').val();
        var salary = $('#salary').val();
        var fee = $('#service_fee').val();

        if ($("#add_placement_form").valid()) {
            $.ajax({
                url: "{{route('addplacement')}}",
                type: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    s_date: s_date, company: company, candidate: candidate, job: job, salary: salary, fee: fee
                },
            }).done(function (res) {
                $.when($('#close_placement_btn').click()).then(function () {

                    swal("Candidate placement is successfully done!");
                    var j_id = $('#jobs-list').find('.color-active').attr('data-id');
                    showCandidates(j_id);
                });

                // alert('date '+s_date+' company '+company+' candidate '+candidate+' job '+job+' salary '+salary+' fee '+fee);

            });
        }
    });


    $(document).on('click', '#hired_btn', function () {
        // $('#company_name_present').val([]);
        // alert('click');
        $('#candidate-id-present').next('span').find('.select2-selection__rendered').empty();
        document.getElementById("add_placement_form").reset();
        var cand_id = $(this).attr('data-id');
        var cand_name = $('#candidate-row-' + cand_id).find('.note-box').eq(1).text();
        var company_id = $('#client-show').find('.color-active').attr('data-id');
        var company_name = $('#client-show').find('.color-active').find('a').eq(0).text();
        var job_id = $('#jobs-list').find('.color-active').attr('data-id');
        var job_name = $('#jobs-list').find('.color-active').find('.add-cursor').find('a').eq(0).text();
        // alert(company_id);
        // console.log(company_id);
        // console.log(job_id);


        $('#hire_company_name').val(company_id);
        $('#select2-hire_company_name-container').text(company_name);
        $('#hired_candidate').val(cand_id);
        $('#select2-hired_candidate-container').text(cand_name);
        var jobOp = "";
        $.ajax({
            url: "{{route('job-details-admin')}}",
            type: 'post',
            data: {
                "_token": "{{ csrf_token() }}",
                "dataId": company_id,
            },
        }).done(function (res) {
            //   var json = JSON.parse(res) ;
            var json = res;
            var chose = '';
            // console.log(json);
            for (var i = res.length - 1; i >= 0; i--) {
                if (job_id == json[i]['id']) {
                    chose = 'selected';
                } else {
                    chose = '';
                }
                jobOp += '<option value="' + json[i]['id'] + '" ' + chose + '>' + json[i]['jobtitle'] + '</option>'
            }

            document.getElementById('job_position').innerHTML = jobOp;

        });


    });

    $('#submit_contract').click(function () {
        document.getElementById("contract_form").reset();
        $.ajax({
            url: "{{route('noncontract')}}",
            type: 'get',

        }).done(function (res) {
            var json = JSON.parse(res);
            var non_con_clients = '';
            // console.log(json);
            for (var i = 0; i < json.length; i++) {

                non_con_clients += '<option value="' + json[i]['id'] + '" >' + json[i]['company_name'] + '</option>'
            }

            document.getElementById('contract_clients').innerHTML = non_con_clients;
            autofill_contract();
        });
    });
    $('#add_to_pipeline_btn').click(function () {
        jobPicker();
    });
    $(document).on('click', '#candidate_present_btn', function () {
        $('#candidate-id-present').next('span').find('.select2-selection__rendered').empty();
        var cand_id = $('#cand-id-custom').val();
        var cand_name = $('#candidate_database_name_' + cand_id).text();
        $('#candidate-id-present').val(cand_id);
        // console.log( $('#candidate-id-present').next('span'));
        $('#candidate-id-present').next('span').find('.select2-selection__rendered').prepend('<li class="select2-selection__choice" title="' + cand_name + '" ><span class="select2-selection__choice__remove" role="presentation">×</span>' + cand_name + '</li>');
    });
    $(document).on('click', '#present_modal_pipeline_candidate', function () {
        // $('#company_name_present').val([]);
        // alert('click');
        $('#candidate-id-present').next('span').find('.select2-selection__rendered').empty();
        // document.getElementById("present_form").reset();
        var cand_id = $(this).attr('data-id');
        var cand_name = $('#candidate-row-' + cand_id).find('.note-box').eq(1).text();
        var company_id = $('#client-show').find('.color-active').attr('data-id');
        var company_name = $('#client-show').find('.color-active').find('a').eq(0).text();
        var job_id = $('#jobs-list').find('.color-active').attr('data-id');
        var job_name = $('#jobs-list').find('.color-active').find('.add-cursor').find('a').eq(0).text();
        // alert(company_id);
        // console.log(company_id);
        // console.log(job_id);


        $('#company_name_present').val(company_id);
        $('#select2-company_name_present-container').text(company_name);
        $.when(functionSet()).then(function () {
            var jobOp = "";
            $.ajax({
                url: "{{route('job-details-admin')}}",
                type: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "dataId": company_id,
                },
            }).done(function (res) {
                //   var json = JSON.parse(res) ;
                var json = res;
                var chose = '';
                // console.log(json);
                for (var i = res.length - 1; i >= 0; i--) {
                    if (job_id == json[i]['id']) {
                        chose = 'selected';
                    } else {
                        chose = '';
                    }
                    jobOp += '<option value="' + json[i]['id'] + '" ' + chose + '>' + json[i]['jobtitle'] + '</option>'
                }

                document.getElementById('job-list-present').innerHTML = jobOp;

            });
        }).then(function () {
            // $('#candidate-id-present').val([]).tri;
            $('#candidate-id-present').val(cand_id);
            // console.log( $('#candidate-id-present').next('span'));
            $('#candidate-id-present').next('span').find('.select2-selection__rendered').prepend('<li class="select2-selection__choice" title="' + cand_name + '" ><span class="select2-selection__choice__remove" role="presentation">×</span>' + cand_name + '</li>');
        });
        // alert('qwe');

        // console.log($('#company_name_present').text());

        // <li class="select2-selection__choice" title="John Myer" "><span class="select2-selection__choice__remove" role="presentation">×</span>John Myer</li>
        // $('#select2-candidate-id-present-container').text(cand_name);
    });


    $(document).on('click', '.editNotecandidate', function (e) {

        var id = $(this).attr('dataid');
        var text = $('#candidate-des-' + id).text();
// alert(text);
        $('#node-edit-candidate').text(text);
        $('#note_id_note_edit').val(id);

    });
    $('#edit_note_candidate_btn').click(function () {
        // alert('click');

        var note = $('#node-edit-candidate').val();
        var noteid = $('#note_id_note_edit').val();
        $.ajax({
            url: "{{route('note.edit')}}",
            type: 'post',

            data: {

                "_token": "{{ csrf_token() }}",
                "noteId": noteid,
                "noteText": note,

            },

            // dataType: 'json'
        }).done(function (res) {

            $('#candidate-des-' + noteid).text(note);
            $('#edit_note_candidate_cls_btn').click();
            swal("Your note is successfully edited!");

        });


    });


    $('#candidate_add_note_btn').click(function () {
        // alert('click');
        // alert('closing');
        var note = $('#pipeline_new_note').val();

        var candid = $('#dasboard_cadidate_id').val();
        var html = "";
        if (note != "") {
            $.ajax({

                url: "{{route('note.created.candidate')}}",
                type: 'post',

                data: {
                    data: {candId: candid, note_des: note},
                    "_token": "{{ csrf_token() }}",
                },

                // dataType: 'json'
            }).done(function (res) {


                function formatDate(date) {
                    var d = new Date(date),
                        month = '' + (d.getMonth() + 1),
                        day = '' + d.getDate(),
                        year = d.getFullYear();

                    if (month.length < 2)
                        month = '0' + month;
                    if (day.length < 2)
                        day = '0' + day;

                    return [year, month, day].join('/');
                }

                var noteDate = formatDate(Date(res['created_at']));
                // alert(res['last_insert_id']);
                html = '<li id="candidate-note-id-' + res['last_insert_id'] + '"> <time datetime="">' + noteDate + '</time><p id="note-' + res['last_insert_id'] + '">' + note + '</p> <a  data-id="' + res['last_insert_id'] + '" href="#" class="tag btn note-candidate-delete">Delete</a> <a id="note-edit-' + res['last_insert_id'] + '" dataId="' + res['last_insert_id'] + '" href="#editNotecandidate" data-toggle="modal" class="tag btn editNote">Edit</a></li>';

                // html='<li style=" list-style-type: none;"  id="delete-id-'+res['last_insert_id']+'"><time datetime="">'+noteDate+'</time><p id="note-'+res['last_insert_id']+'">'+note_des+'</p><a id="note-del-'+res['last_insert_id']+'" dataId="'+res['last_insert_id']+'" href="javascript:void(0)" class="tag btn note-del">Delete</a><a id="note-edit-'+res['last_insert_id']+'" dataId="'+res['last_insert_id']+'"  href="#editNotePopup" data-toggle="modal" class="tag btn editNote">Edit</a></li>';
                // console.log(html);
                if ($('#notes-list-' + candid).html() != 'No Notes Available') {
                    $('#notes-list-' + candid).append(html);
                } else {
                    $('#notes-list-' + candid).html(html);
                }

                swal("Your note is successfully added!");


            });
            $('#empty_note').hide();
            $('#candidate_add_note_close_btn').click();
        } else {
            alert('empty');
            $('#empty_note').show();
        }

    });

    function new_option() {


        $.ajax({

            url: "{{route('status.ajax')}}",
            type: 'get',
        }).done(function (res) {

            var json = JSON.parse(res);
            // console.log(json);
            // alert('console');
            var index = Number(json.length - 1);
            $('#status_interview').append('<option value="' + json[index]['id'] + '" selected>' + json[index]['name'] + '</option>');
        });

    }

    $(document).on("click", "#new_status_sub", function (event) {
        var color = $('#status_color').val();
        var status = $('#status_name_modal').val();
        // alert(color);
        // alert(status);
        if (status != "") {
            // alert('not empty');

            $.ajax({

                url: "{{route('status.created')}}",
                type: 'post',

                data: {
                    "_token": "{{ csrf_token() }}",
                    "statusName": status,
                    "statusColor": color,
                },

                // dataType: 'json'
            }).done(function (res) {

                if (res === 'true') {
                    // alert('exist');
                    $('.empty_status').hide();
                    $('.exist_status').show();
                    // setTimeout( function(){$('.exist').hide();} , 4000);
                } else {
                    // alert('saved');
                    $('#close_status_modal').click();
                    new_option();
                    // $('#close_status_modal').click();
                }

            });

        } else {
            $('.exist_status').hide();
            $('.empty_status').show();
            // setTimeout( function(){$('.error').hide();} , 4000);
        }

        // $("#new_status_Modal").modal("hide");
        // $(".modal-backdrop").remove();
        // $('body').removeClass('modal-open');


        // $( "div" ).remove( ".modal-backdrop fade show" );

    });
</script>

<script>
    var editor = null;
    ClassicEditor.create(document.querySelector("#editor"), {
        heading: {
            options: [
                {model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph'},
                {model: 'heading3', view: 'h3', title: 'Heading', class: 'ck-heading_heading3'},
            ]
        },
        toolbar: {
            items: [
                "heading",
                "fontFamily",
                "|",
                "bold",
                "italic",
                "link",
                "bulletedList",
                "numberedList",
                "blockQuote",
                "undo",
                "redo",
                "|",
                "contenteditable",
            ],
        },
    })


</script>

<script>
    window.onload = functionSet();
    window.onload = emptyfunctionSet();
    window.onload = jobPicker();

    var id = '';

    // Trigger action when the contexmenu is about to be shown
    // $(".add-note").bind("contextmenu", function (event) {
    //     // Avoid the real one
    //     event.preventDefault();
    //     id=$(this).attr('data-id');
    //     $('#client_id').val(id);
    //     // Show contextmenu
    //     $(".custom-menu-"+id).finish().toggle(100);
    // });
    $(document).on("contextmenu", ".add-note", function (event) {
        event.preventDefault();
        // alert('here')
        id = $(this).attr('data-id');
        $('#client_id').val(id);
        // Show contextmenu

        $(".custom-menu-" + id).finish().toggle(100);
    });
    $(document).on("contextmenu", ".contract-note", function (event) {
        event.preventDefault();
        // alert('here')
        id = $(this).attr('data-id');
        $('#client_id').val(id);
        // Show contextmenu

        $(".custom-menu-" + id).finish().toggle(100);
    });
    $(document).on("contextmenu", ".add-note-job", function (event) {
        event.preventDefault();
        id = $(this).attr('data-id');
        $('#client_id').val(id);

        $(".custom-menu-job-" + id).finish().toggle(100);
    });
    $(document).on("contextmenu", ".add-note-candidate", function (event) {
        event.preventDefault();
        id = $(this).attr('data-id');
        $('#client_id').val(id);

        $(".custom-menu-candidate-" + id).finish().toggle(100);
    });
    // });
    // If the document is clicked somewhere
    $(document).bind("mousedown", function (e) {
        // If the clicked element is not the menu
        if (!$(e.target).parents(".custom-menu-" + id).length > 0) {
            // Hide it
            $(".custom-menu-" + id).hide(1000);
        }
        if (!$(e.target).parents(".custom-menu-job-" + id).length > 0) {
            // Hide it
            $(".custom-menu-job-" + id).hide(1000);
        }
        if (!$(e.target).parents(".custom-menu-candidate-" + id).length > 0) {
            // Hide it
            $(".custom-menu-candidate-" + id).hide(1000);
        }
    });
    // If the menu element is clicked
    $(".custom-menu li").click(function () {
        // Hide it AFTER the action was triggered
        $(".custom-menu-" + id).hide(100);
        $(".custom-menu-job-" + id).hide(100);
        $(".custom-menu-candidate-" + id).hide(100);
    });
    $(function () {
        $('.tags_1').tagsInput({
            width: 'auto',
            // defaultText: ''
        });
    });
    $(function () {
        $('.tags_2').tagsInput({
            width: 'auto',
            defaultText: 'Skills'
        });
    });
    $(function () {
        $('.tags_5').tagsInput({
            width: 'auto',
            defaultText: 'Emails(Comma Separated)'
        });
    });

    $(function () {
        $('.tags_3').tagsInput({
            width: 'auto',
            defaultText: 'Job Title'
        });
    });

    $(function () {
        $('.tags_4').tagsInput({
            width: 'auto',
            defaultText: 'Job Title'
        });
    });

    $("#node-add-dashboard").click(function (e) {
        e.preventDefault();

        var text = $('#note-val').val();
        // alert('123');
        var html = '';
        var client_id = $('#client_id').val();
        var note_des = $('#node-cus').val();

        if (note_des !== "") {
            $.ajax({

                url: "{{route('note.created')}}",
                type: 'post',

                data: {
                    data: {client_id: client_id, note_des: note_des},
                    "_token": "{{ csrf_token() }}",
                },

                // dataType: 'json'
            }).done(function (res) {
                var d = new Date();
                var mlist = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
                var monName = mlist[d.getMonth()];


                var day = d.getDate();

                var noteData = (day < 10 ? '0' : '') + day + '-' + monName + '-' + d.getFullYear();

                // alert(res['last_insert_id']);
                html = '<li  id="delete-id-' + res['last_insert_id'] + '"><time datetime="">' + noteData + '</time><p id="note-' + res['last_insert_id'] + '">' + note_des + '</p><a id="note-del-' + res['last_insert_id'] + '" dataId="' + res['last_insert_id'] + '" href="javascript:void(0)" class="tag btn note-del">Delete</a><a id="note-edit-' + res['last_insert_id'] + '" dataId="' + res['last_insert_id'] + '"  href="#editNotePopup" data-toggle="modal" class="tag btn editNote">Edit</a></li>';
                $('#append-note-' + client_id).prepend(html);
                // $( ".close" ).trigger( "click" );

            });
        } else {
            swal('Note can"t empty');
        }

    });

    $("#node-add-dashboard1").click(function (e) {
        e.preventDefault();
        // alert('123');
        var html = '';
        var client_id = $('#client_id').val();
        var note_des = $('#node-cus1').val();


        if (note_des !== "") {
            $.ajax({

                url: "{{route('note.created')}}",
                type: 'post',

                data: {
                    data: {client_id: client_id, note_des: note_des},
                    "_token": "{{ csrf_token() }}",
                },

                // dataType: 'json'
            }).done(function (res) {
                // alert(res);
                var d = new Date();

                var mlist = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

                var monName = mlist[d.getMonth()];

                var day = d.getDate();

                var noteData = (day < 10 ? '0' : '') + day + '-' + monName + '-' + d.getFullYear();

                // alert(res['last_insert_id']);
                html = '<li  id="dashboard-note-id-' + res['last_insert_id'] + '"><time datetime="">' + noteData + '</time><p id="note-' + res['last_insert_id'] + '">' + note_des + '</p><a id="note-dashboard" dataid="' + res['last_insert_id'] + '" href="#" class="tag btn">Delete</a><a id="note-edit-' + res['last_insert_id'] + '" dataId="' + res['last_insert_id'] + '"  href="#editNotePopup" data-toggle="modal" class="tag btn editNote">Edit</a></li>';
                $('#client-notes-list-' + client_id).prepend(html);
                $(".close").trigger("click");

            });

        } else {
            swal('Note can"t empty');
        }


    });


    // create note for candidate

    $("#node-add-candidate").click(function (e) {
        e.preventDefault();

        //get from candidate_database.balde.php from hidden field.
        var candId = $('#cand-id-custom').val();
        var html = '';
        var note_des = $('#node-cus-cand').val();


        if (note_des !== "") {

            $.ajax({

                url: "{{route('note.created.candidate')}}",
                type: 'post',

                data: {
                    data: {candId: candId, note_des: note_des},
                    "_token": "{{ csrf_token() }}",
                },

                // dataType: 'json'
            }).done(function (res) {

                function formatDate(date) {
                    var d = new Date(date),
                        month = '' + (d.getMonth() + 1),
                        day = '' + d.getDate(),
                        year = d.getFullYear();

                    if (month.length < 2)
                        month = '0' + month;
                    if (day.length < 2)
                        day = '0' + day;

                    return [year, month, day].join('/');
                }

                var noteDate = formatDate(Date(res['created_at']));
                // alert(res['last_insert_id']);
                html = '<li style=" list-style-type: none;"  id="delete-id-' + res['last_insert_id'] + '"><time datetime="">' + noteDate + '</time><p id="candidate-des-' + res['last_insert_id'] + '">' + note_des + '</p><a id="note-del-' + res['last_insert_id'] + '" dataId="' + res['last_insert_id'] + '" href="javascript:void(0)" class="tag btn note-del">Delete</a><a id="note-edit-' + res['last_insert_id'] + '" dataId="' + res['last_insert_id'] + '"  href="#editNotePopup" data-toggle="modal" class="tag btn editNote">Edit</a></li>';
                $('#append-note-cand-' + candId).prepend(html);

            });

        } else {
            swal('Note can"t be empty');
        }


    });


    // for search
    $("#node-add-candidate-search").click(function (e) {
        e.preventDefault();

        //get from candidate_database.balde.php from hidden field.
        var candId = $('#cand-id-custom-search').val();
        var html = '';
        var note_des = $('#node-cus-cand-search').val();

        if (note_des !== "") {

            $.ajax({

                url: "{{route('note.created.candidate')}}",
                type: 'post',

                data: {
                    data: {candId: candId, note_des: note_des},
                    "_token": "{{ csrf_token() }}",
                },

                // dataType: 'json'
            }).done(function (res) {

                function formatDate(date) {
                    var d = new Date(date),
                        month = '' + (d.getMonth() + 1),
                        day = '' + d.getDate(),
                        year = d.getFullYear();

                    if (month.length < 2)
                        month = '0' + month;
                    if (day.length < 2)
                        day = '0' + day;

                    return [year, month, day].join('/');
                }

                var noteDate = formatDate(Date(res['created_at']));
                // alert(res['last_insert_id']);
                html = '<li style=" list-style-type: none;"  id="delete-id-' + res['last_insert_id'] + '"><time datetime="">' + noteDate + '</time><p id="note-' + res['last_insert_id'] + '">' + note_des + '</p><a id="note-del-' + res['last_insert_id'] + '" dataId="' + res['last_insert_id'] + '" href="javascript:void(0)" class="tag btn note-del">Delete</a><a id="note-edit-' + res['last_insert_id'] + '" dataId="' + res['last_insert_id'] + '"  href="#editNotePopup" data-toggle="modal" class="tag btn editNote">Edit</a></li>';
                $('#append-note-cand-' + candId).prepend(html);

            });

        } else {
            swal('Note can"t be empty');
        }


    });

    // end for seach

    function emptyfunctionSet() {


        var client_id = $('.client-list-check option:selected').val();
        // alert(client_id);
        var jobOp = "";
        $.ajax({
            url: "{{route('job-details-admin')}}",
            type: 'post',
            data: {
                "_token": "{{ csrf_token() }}",
                "dataId": client_id,
            },
        }).done(function (res) {
            //   var json = JSON.parse(res) ;
            var json = res;
            // console.log(json);
            for (var i = res.length - 1; i >= 0; i--) {
                jobOp += '<option value="' + json[i]['id'] + '">' + json[i]['jobtitle'] + '</option>'
            }

            document.getElementById('job-list-empty-present').innerHTML = jobOp;

        });

    }

    function job_change_company() {


        var client_id = $('#hire_company_name').val();
        // alert(client_id);
        var jobOp = "";
        $.ajax({
            url: "{{route('job-details-admin')}}",
            type: 'post',
            data: {
                "_token": "{{ csrf_token() }}",
                "dataId": client_id,
            },
        }).done(function (res) {
            //   var json = JSON.parse(res) ;
            var json = res;
            // console.log(json);
            for (var i = res.length - 1; i >= 0; i--) {
                jobOp += '<option value="' + json[i]['id'] + '">' + json[i]['jobtitle'] + '</option>'
            }

            document.getElementById('job_position').innerHTML = jobOp;

        });

    }

    function functionSet() {


        var client_id = $('#company_name_present').val();
        // alert(client_id);
        var jobOp = "";
        $.ajax({
            url: "{{route('job-details-admin')}}",
            type: 'post',
            data: {
                "_token": "{{ csrf_token() }}",
                "dataId": client_id,
            },
        }).done(function (res) {
            //   var json = JSON.parse(res) ;
            var json = res;
            // console.log(json);
            for (var i = res.length - 1; i >= 0; i--) {
                jobOp += '<option value="' + json[i]['id'] + '">' + json[i]['jobtitle'] + '</option>'
            }

            document.getElementById('job-list-present').innerHTML = jobOp;

        });

    }


    function jobSlct() {

        var client_id = $('.client-list-check option:selected').val();
        var jobOp = "";
        $.ajax({

            url: "{{route('pipeline.client.jobs')}}",
            type: 'post',

            data: {
                data: {client_id: client_id},
                "_token": "{{ csrf_token() }}",
            },

            // dataType: 'json'
        }).done(function (res) {
            var json = JSON.parse(res);

            for (let i = 0; i < json.length; i++) {
                jobOp += '<option value="' + json[i]['id'] + '">' + json[i]['jobtitle'] + '</option>'
            }

            document.getElementById('job-list').innerHTML = "";
            document.getElementById('job-list').innerHTML = jobOp;

        });

    }

    //end create note for candidate


    //candidate pipeline

    function jobPicker() {
        var client_id = $('#select-client-name option:selected').val();
        var jobs = "";

        $.ajax({
            url: "{{route('job-details-admin')}}",
            type: 'post',
            data: {
                "_token": "{{ csrf_token() }}",
                "dataId": client_id,
            },
        }).done(function (res) {
            var json = res;
            for (let i = 0; i < json.length; i++) {
                jobs += '<option value="' + json[i]['id'] + '">' + json[i]['jobtitle'] + '</option>'
            }
            document.getElementById('select-job-name').innerHTML = "";
            document.getElementById('select-job-name').innerHTML = jobs;

        });

    }


    $('#add-candidate-pipeline-submit').click(function () {
        var candidate_id = $('#candiate-id-for-pipeline').val();
        var job_id = $('#select-job-name option:selected').val();
        var job_name = $('#select-job-name option:selected').text();
        var Client_name = $('#select-client-name option:selected').text();
        var status_id = $('#select-status-name option:selected').val();

        if (job_id === undefined) {
            $('#error-job-cand-pipeline').show(3).delay(3000).hide('slow');
        } else {
            $.ajax({
                url: "{{route('pipeline.candidate.add')}}",
                type: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    candidate_id: candidate_id,
                    'job_id': job_id,
                    'status_id': status_id
                },
            }).done(function (res) {
                if (res == "Success") {
                    sweetAlert('Candidate added in Recruitment Pipeline successfully!');
                }
                if (res == "Already in pipeline with the specified company and job") {
                    sweetAlert('Candidate already exists in pipeline!');
                }
                $('#pipelineModal_letest_cls_btn').click();

            });
        }


    });

    //end candidate pipeline


</script>
<script>


    $(document).on("click", "#update-status-pipeline_btn", function () {
        var candId = $("#candidate_id_pipeline").val();
        var status = $("#pipeline_status_list").val();

        $.ajax({

            url: "{{route('update.pipeline.status.ajax')}}",
            type: 'post',
            data: {

                "_token": "{{ csrf_token() }}",
                "status": status,
                "candId": candId,

            },
        }).done(function (res) {
            var job_id = $('#jobs-list').find('.color-active').attr('data-id');
            showCandidates(job_id);
            swal('Status successfully updated');

        });
    });
    $(document).on("click", ".pipeline_update_status", function (event) {
        var id = $(this).attr('data-id');
        $("#candidate_id_pipeline").val(id);
        var status_id = $(this).attr('data-status');
        var se = '';
        $.ajax({

            url: "{{route('status.ajax')}}",
            type: 'get',
        }).done(function (res) {
            var opt = ''
            var json = JSON.parse(res);
            // console.log(json);
            // alert('console');
            // var index =Number(json.length-1);
            for (let i = 0; i < json.length; i++) {
                if (json[i]['id'] == status_id) {
                    se = 'selected';
                    // alert(json[i]['name']);
                } else {
                    se = '';
                }
                opt += '<option value="' + json[i]['id'] + '" ' + se + '>' + json[i]['name'] + '</option>';
            }
            document.getElementById('pipeline_status_list').innerHTML = opt;

        });

    });


    $(document).on("click", "#update-status-interview_btn", function () {
        var interview_id = $("#status_id_interview").val();
        var status_id = $("#interview_status_list").val();

        $.ajax({

            url: "{{route('updateScheduledInterviewStatus')}}",
            type: 'post',
            data: {"_token": "{{ csrf_token() }}", id: interview_id, status_id: status_id},
        }).done(function (res) {

            table.draw();
            swal('Status successfully updated');

        });
    });
    $(document).on("click", "#interview_list_btn", function (event) {
        var id = $(this).attr('data-id');
        $("#status_id_interview").val(id);
        var status_id = $(this).attr('data-note');
        var se = '';
        var opt = '';
        $.ajax({

            url: "{{route('status.ajax')}}",
            type: 'get',
        }).done(function (res) {

            var json = JSON.parse(res);
            // console.log(json);
            // alert('console');
            // var index =Number(json.length-1);
            for (let i = 0; i < json.length; i++) {
                if (json[i]['id'] == status_id) {
                    se = 'selected';
                    // alert(json[i]['name']);
                } else {
                    se = '';
                }
                opt += '<option value="' + json[i]['id'] + '" ' + se + '>' + json[i]['name'] + '</option>';
            }
            document.getElementById('interview_status_list').innerHTML = opt;

        });

    });


    $(document).on("click", "#view_interview_detail", function (event) {
        var id = $(this).attr('data-id');
        $.ajax({
            url: "{{route('searchinterviews')}}",
            type: 'post',

            data: {"_token": "{{ csrf_token() }}", id: id},


            // dataType: 'json'
        }).done(function (res) {
            var json = JSON.parse(res);
            // console.log(json);
            $('#d_company_name').html(json['data']['admin_clients']['company_name']);
            $('#d_candidate_name').html(json['data']['admin_candidates']['name']);
            $('#d_job_name').html(json['data']['admin_jobs']['jobtitle']);
            $('#d_status').attr('src', window.location.origin + '/status_icons/' + json['data']['admin_status']['status_icon']);
            $('#d_location').text(json['data']['location']);
            $('#d_date').text(json['s_date']);
            $('#d_start_date').text(json['s_time']);
            $('#d_end_date').text(json['e_time']);
            $('#d_time_zone').text(json['data']['time_zone']);
            $('#d_subject').text(json['data']['subject']);
            if (json['data']['receiver_emails'].length == 0) {
                $('#d_emails').text('No email available');
            } else {
                var e_data = '';
                for (let i = 0; i < json['data']['receiver_emails'].length; i++) {
                    if (i == 0) {
                        e_data += json['data']['receiver_emails'][i]['email'];
                    } else {
                        e_data += ' , ' + json['data']['receiver_emails'][i]['email'];
                    }

                }
                $('#d_emails').text(e_data);

            }


            $('#d_message').text(json['data']['message']);


        });

    });


    var table = $('#scheduled_interviews').DataTable({
        "processing": true,
        "serverSide": true,
        "ordering": false,
        "language": {
            "search": "Search By Name ",
            "searchPlaceholder": "",
        },
        "lengthMenu": [[10, 25, 50, 100, 1000000], [10, 25, 50, 100, "All"]],
        "ajax": {
            url: "{{route('scheduled-interviews-lists')}}",
            type: "post",
            "data": function (d) {
                d._token = "{{ csrf_token() }}";
                d.company_name = $('#company_id_interview').val();
                d.job_name = $('#job_interview').val();
                d.candidate_name = $('#candidate_name_interview').val();
                d.type = $('#type_interview').val();

            }, error: function () {  // error handling
                $(".example-error").html("");
                $("#example").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                $("#example_processing").css("display", "none");
            }
        },
        "columns": [
            {"data": "company"},
            {"data": "job"},
            {"data": "candidate"},
            {"data": "date"},
            {"data": "from"},
            {"data": "to"},
            {"data": "status"},
            // {"data": "status"},

        ],
        "columnDefs": [
            {
                "className": "dt-center",
                "targets": [7],
                "orderable": true,
                "render": function (data, type, row) {
                    var but = 'fa fa-toggle-off';
                    var html = '';
                    // return '<a href="'+baseURL+'admin/dealer-details/'+row.id+'" class="fa fa-eye" data-toggle="tooltip" title="View Detail"></a><a href="'+baseURL+'admin/edit-dealer/'+row.id+'" class="fa fa-pencil" data-toggle="tooltip" title="Edit Dealer"></a> <a href="javascript:void(0);" data-id="'+row.id+'" class="fa fa-trash delete_dealer" data-toggle="tooltip" title="Delete Dealer"></a>'
                    html += '<a href="#interview_detail_modal" data-toggle="modal" id="view_interview_detail" data-id="' + row.id + '" class="tag" title="View Detail">View Detail</a><a class="tag" href="#interviewstatusModal" data-toggle="modal" id="interview_list_btn" data-id="' + row.id + '" data-note="' + row.status_id + '" >Update Status</a>';
                    return html;
                }
            }
        ],
    });

    $('#search_interview').click(function (argument) {
        // body...
        table.draw();
    });

    var placement_table = $('#placement_table').DataTable({
        "processing": true,
        "serverSide": true,
        "ordering": false,
        "language": {
            "search": "Search By Name ",
            "searchPlaceholder": "",
        },
        "lengthMenu": [[10, 25, 50, 100, 1000000], [10, 25, 50, 100, "All"]],
        "ajax": {
            url: "{{route('listplacement')}}",
            type: "post",
            "data": function (d) {
                d._token = "{{ csrf_token() }}";
                d.company_name = $('#company_id_placement').val();
                d.job_name = $('#job_placement').val();
                d.candidate_name = $('#candidate_name_placement').val();
                d.sort = $('#sorting_order').val();

            }, error: function () {  // error handling
                $(".example-error").html("");
                $("#example").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                $("#example_processing").css("display", "none");
            }
        },
        "columns": [
            {"data": "start_date"},
            {"data": "recruiter"},
            {"data": "company"},
            {"data": "candidate"},
            {"data": "job"},
            {"data": "salary"},
            {"data": "fee"},

            // {"data": "status"},

        ],
        "columnDefs": [
            {
                "className": "dt-center",
                "targets": [7],
                "orderable": true,
                "render": function (data, type, row) {
                    var but = 'fa fa-toggle-off';
                    var html = '';
                    html += '<a href="#edithiredModal" data-toggle="modal"  data-id="' + row.id + '" class="edit_placement_btn tag" title="Edit">Edit</a>@if(auth()->user()->is_super_admin==1) <a class="tag delete_placement" href="javascript:void(0)" data-toggle="modal" id="" data-id="' + row.id + '" > Delete</a>@endif';
                    return html;
                }
            }
        ],
    });

    $('#search_placement').click(function (argument) {
        // body...
        placement_table.draw();
    });


</script>


<!-- select2 -->
