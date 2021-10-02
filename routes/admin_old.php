<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminControllerOld;

Route::get('/notification/read', 'AdminControllerOld@markread')->name('markread')->middleware('auth');


Route::get('/admin/dashboard', 'HomeController@index')->name('admin')->middleware('auth');
Route::get('/admin', 'AdminControllerOld@index')->name('admin')->middleware('auth');
Route::get('/admin', 'AdminControllerOld@index')->name('admin')->middleware('auth');
Route::get('admin/routes', 'HomeController@admin')->middleware('admin')->middleware('auth');


Route::prefix('admin')->group(function () {

    Auth::routes();

    Route::post('/add/placement', 'AdminControllerOld@addplacement')->name('addplacement')->middleware('auth');
    Route::post('/edit/placement', 'AdminControllerOld@editplacement')->name('editplacement')->middleware('auth');
    Route::post('/delete/placement', 'AdminControllerOld@deleteplacement')->name('deleteplacement')->middleware('auth');
    Route::get('/placement/all', 'AdminControllerOld@allplacement')->name('allplacement')->middleware('auth');
    Route::post('/placement/list', 'AdminControllerOld@listplacement')->name('listplacement')->middleware('auth');
    Route::post('/search/placement', 'AdminControllerOld@searchplacement')->name('searchplacement')->middleware('auth');


//search
    Route::get('/search', 'AdminControllerOld@mainSearch')->name('search')->middleware('auth');
    Route::post('/search', 'AdminControllerOld@searchSubmit')->name('search.submit')->middleware('auth');
//end search

    Route::post('/change-login', 'AdminControllerOld@change_login')->name('changelogin')->middleware('auth');
    Route::get('/switch-back', 'AdminControllerOld@switch_back')->name('switchback')->middleware('auth');


    Route::get('/pipeline', [AdminControllerOld::class, 'index'])->name('admin')->middleware('auth');
    route::post('/contract/search', 'AdminControllerOld@contractdetails')->name('contractdetails')->middleware('auth');
    route::post('/contract/edit', 'AdminControllerOld@contractedit')->name('contractedit')->middleware('auth');
    route::post('/contract/delete', 'AdminControllerOld@contractdelete')->name('contractdelete')->middleware('auth');
    Route::get('/non_contract_clients', 'AdminControllerOld@noncontract')->name('noncontract')->middleware('auth');
    Route::post('/add/contract', 'AdminControllerOld@addcontract')->name('addcontract')->middleware('auth');
    Route::get('/all/contract', 'AdminControllerOld@allcontract')->name('allcontract')->middleware('auth');
    Route::post('/sign/contract', 'AdminControllerOld@signcontract')->name('signcontract')->middleware('auth');
    Route::post('/all/contract/ajax', 'AdminControllerOld@contractsajax')->name('contractsajax')->middleware('auth');

    Route::get('/schedule-interview', 'AdminControllerOld@scheduleinterview')->name('schedule-interview')->middleware('auth');
    Route::post('/company-schedule-interview/', 'AdminControllerOld@companyscheduleinterview')->name('company-schedule-interview')->middleware('auth');
//Route::get('/candidate-schedule-interview/{id?}', 'AdminControllerOld@companyscheduleinterview')->name('company-schedule-interview')->middleware('auth');
    Route::get('/scheduled/interview', 'AdminControllerOld@scheduledinterviews')->name('scheduled-interviews')->middleware('auth');
    Route::post('/search_interview', 'AdminControllerOld@searchinterviews')->name('searchinterviews')->middleware('auth');
    Route::post('/scheduled/interview/list', 'AdminControllerOld@scheduledinterviewslists')->name('scheduled-interviews-lists')->middleware('auth');


    route::post('/company/search', 'AdminControllerOld@dashSearch')->name('company.search.dashboard.ajax')->middleware('auth');
    route::post('view-as/company/search', 'AdminControllerOld@viewasdashSearch')->name('viewas.company.search.dashboard.ajax')->middleware('auth');

    route::post('/interview/status/update', 'AdminControllerOld@updateScheduledInterviewStatus')->name('updateScheduledInterviewStatus')->middleware('auth');

    Route::get('/all/client/ajax', 'AdminControllerOld@allClientajax')->name('client.all.ajax')->middleware('auth');

    //job details against client
    Route::get('/client/jobs/details/{id?}', [AdminControllerOld::class, 'clientJobsView'])->name('client.jobs.view')->middleware('auth');
    Route::post('/client/jobs/details', [AdminControllerOld::class, 'clientJobsDetails'])->name('client.jobs.details')->middleware('auth');
    //job details
    //for ajax

    //ajax



    Route::get('/client/import/', 'AdminControllerOld@clientimportpage')->name('clientimportpage')->middleware('auth');
    Route::post('/client/import/submit', 'AdminControllerOld@clientimportsubmit')->name('clientimportsubmit')->middleware('auth');


    // New Candidate Routes
    Route::get('/create/new-candidate/', 'AdminControllerOld@createNewCandidate')->name('new.candidate.create')->middleware('auth');
    Route::post('/create/new-candidate/', 'AdminControllerOld@new_candidateSubmit')->name('new.candidate.submit')->middleware('auth');
    Route::get('/new-candidate/import/', 'AdminControllerOld@newCandidateImportpage')->name('new.candidate.importpage')->middleware('auth');
    Route::post('/new-candidate/import/submit', 'AdminControllerOld@newCandidateimportsubmit')->name('new.candidateimportsubmit')->middleware('auth');
    /*Candidate Database Routes*/
    Route::get('/new-candidate/database/', 'AdminControllerOld@newCandidateDatabaseView')->name('new.candidate.database')->middleware('auth');
    Route::post('/new-candidate/database/', 'AdminControllerOld@newCandidateDatabase')->name('new.candidate.database.ajax')->middleware('auth');
    Route::post('/new-candidate/database/detail', 'AdminControllerOld@newCandidateDatabaseDetailAjax')->name('new.candidate.database.detail.ajax')->middleware('auth');

    //candidate routes


    Route::get('/candidate/import/', 'AdminControllerOld@candidateimportpage')->name('candidateimportpage')->middleware('auth');
    Route::post('/candidate/import/submit', 'AdminControllerOld@candidateimportsubmit')->name('candidateimportsubmit')->middleware('auth');


    Route::post('/candidate/status/bulk', 'AdminControllerOld@candidatebulkstatus')->name('candidate.bulk.status')->middleware('auth');



    Route::post('/client/jobs/', 'AdminControllerOld@picJobsAgaintsClient')->name('client.jobs')->middleware('auth');

    //end candidate route



    //interview stages
    Route::get('/interviewStages', 'AdminControllerOld@interviewStage')->name('interviewStage')->middleware('auth');
    Route::get('/interview_stage/create', 'AdminControllerOld@createInterviewStage')->name('interview.stages.create')->middleware('auth');
    Route::post('/interview_stage/create', 'AdminControllerOld@createdInterviewStage')->name('interview.stages.created')->middleware('auth');
    Route::post('/interview_stage/update', 'AdminControllerOld@updateInterviewStage')->name('interview.stage.update')->middleware('auth');
    Route::post('/interview_stage/delete', 'AdminControllerOld@interviewStageDelete')->name('interview.stage.delete')->middleware('auth');
    //end interview stages

    //interview status
    Route::get('/interviewStatus', 'AdminControllerOld@interviewStatus')->name('interviewStatus')->middleware('auth');
    Route::get('/create/interview_status', 'AdminControllerOld@createInterviewStatus')->name('interview.status.create')->middleware('auth');
    Route::post('/create/interview_status', 'AdminControllerOld@createdInterviewStatus')->name('interview.Status.created')->middleware('auth');
    Route::post('/update/interview_status', 'AdminControllerOld@updateInterviewStatus')->name('interview.Status.update')->middleware('auth');
    Route::post('/delete/interview_status', 'AdminControllerOld@interviewStatusDelete')->name('interview.Status.delete')->middleware('auth');
    //end interview status




    Route::get('/job/import/', 'AdminControllerOld@jobimportpage')->name('jobimportpage')->middleware('auth');
    Route::post('/job/import/submit', 'AdminControllerOld@jobimportsubmit')->name('jobimportsubmit')->middleware('auth');



    //delete by ajax

    //end delete by ajax

//

    Route::post('/create/note', 'AdminControllerOld@addNote')->name('note.created')->middleware('auth');
    Route::post('/create/note/candidate', 'AdminControllerOld@addNoteCandidate')->name('note.created.candidate')->middleware('auth');


    Route::post('/job/list-view/', [AdminControllerOld::class, 'jobListForOneCompany'])->name('job-details-admin')->middleware('auth');
    Route::post('/job/all-list-view/', 'AdminControllerOld@alljoblForOneCompany')->name('all-job-admin')->middleware('auth');


    //code by amir
    // Route::get('/create/note' , 'AdminControllerOld@addNote')->name('note.created')->middleware('auth');
    Route::post('/add/piplinejob', [AdminControllerOld::class, 'addJobPipeline'])->name('jobpipline.created')->middleware('auth');

    //repete bcz of job pipeine featue also exist in search page..
    Route::get('search/add/piplinejob/', 'AdminControllerOld@addJobPiplineForSearch')->name('search.jobpipline.created')->middleware('auth');

    Route::get('/job/removePipline/{jobId}', 'AdminControllerOld@removePipline')->name('job.removePipline')->middleware('auth');

    Route::post('/job/removePiplineAjax/', [AdminControllerOld::class,'removePipelineJobAjax'])->name('job.removePiplinejobAjax')->middleware('auth');
    Route::get('/job/detail/{jobId}', 'AdminControllerOld@jobDetail')->name('job.detail')->middleware('auth');

//    Pipeline Routes
    Route::post('/client/addPiplineClient/', [AdminControllerOld::class, 'addToPipelineClient'])->name('client.addToPipeline')->middleware('auth');
    Route::post('/client/removePiplineClient/', [AdminControllerOld::class, 'removeFromPipelineClient'])->name('client.removePiplineClient')->middleware('auth');
    Route::post('/client/removePiplineClientAjax', [AdminControllerOld::class, 'removePipelineClientAjax'])->name('client.removePiplineClientAjax')->middleware('auth');

    Route::get('/settings', 'AdminControllerOld@change_password')->name('change.password')->middleware('auth');
    Route::post('/updatepassword', 'AdminControllerOld@update_password')->name('update.password')->middleware('auth');
    Route::post('/update/profile/pic', 'AdminControllerOld@update_pic')->name('update.pic')->middleware('auth');
    Route::get('/list/dashboard/{id?}', 'AdminControllerOld@dashboard')->name('dashboard.database')->middleware('auth');
    //end code by amir


    //client dashboard
    Route::get('/client/dashboard', [AdminControllerOld::class,'clientDashboard'])->name('client.dashboard')->middleware('auth');
    Route::post('/client/dashboard/search', 'AdminControllerOld@clientDashboardSearch')->name('client.dashboard.search.dropdown')->middleware('auth');
    Route::post('/client/dashboard/search/option', 'AdminControllerOld@clientDashboardSearchOption')->name('client.dashboard.search.option')->middleware('auth');
    Route::post('/client/dashboard/job/candidate', 'AdminControllerOld@clientDashboardJobCandidate')->name('client.dashboard.job.candidate')->middleware('auth');
    Route::post('/client/dashboard/job/candidate/detail', 'AdminControllerOld@clientDashboardJobCandidateDetail')->name('client.dashboard.job.candidate.detail')->middleware('auth');
    //end client dashboard


    //todo-module
    Route::get('/todo/all', 'AdminControllerOld@todo')->name('todo')->middleware('auth');
    Route::post('/todo/list', 'AdminControllerOld@todolist')->name('todolist')->middleware('auth');
    Route::get('/todo/ajax', 'AdminControllerOld@todoajax')->name('todoajax')->middleware('auth');
    Route::post('/todo/add', 'AdminControllerOld@addtodo')->name('addtodo')->middleware('auth');
    Route::post('/todo/edit', 'AdminControllerOld@edittodo')->name('edittodo')->middleware('auth');
    Route::post('/todo/search', 'AdminControllerOld@searchtodo')->name('searchtodo')->middleware('auth');
    Route::post('/todo/delete', 'AdminControllerOld@deletetodo')->name('deletetodo')->middleware('auth');
    Route::post('/todo/delete/bulk', 'AdminControllerOld@bulkdeletetodo')->name('bulkdeletetodo')->middleware('auth');

    // Calendar
    Route::get('/calendar', [AdminControllerOld::class, 'calendar'])->name('calendar')->middleware('auth');


    //Sub Admins Routes
    Route::get('/sub-admin/create', [AdminControllerOld::class, 'subAdminCreate'])->name('sub_admin_create')->middleware('auth');
    Route::post('/sub-admin/created', [AdminControllerOld::class, 'subAdminStore'])->name('sub_admin_created')->middleware('auth');
    Route::get('/sub-admin/edit/{id}', [AdminControllerOld::class, 'subAdminEdit'])->name('sub_admin_edit')->middleware('auth');
    Route::post('/sub-admin/update', [AdminControllerOld::class, 'subAdminUpdate'])->name('sub_admin_update')->middleware('auth');
    Route::post('/sub-admin/delete', [AdminControllerOld::class, 'subAdminDelete'])->name('sub_admin_delete')->middleware('auth');
    Route::get('/sub-admin/all', [AdminControllerOld::class, 'subAdminAll'])->name('sub_admin_all')->middleware('auth');
    Route::post('/sub-admin/all/ajax', [AdminControllerOld::class, 'ajaxSubAdminAll'])->name('sub_admin_ajax')->middleware('auth');
    Route::post('/sub-admin/search/ajax', [AdminControllerOld::class, 'ajaxSubAdminSearch'])->name('sub_admin_ajax_search')->middleware('auth');

    // Client Routes
    Route::get('/create/client', [AdminControllerOld::class, 'clientCreate'])->name('client.create')->middleware('auth');
    Route::post('/create/client', [AdminControllerOld::class, 'clientStore'])->name('client.created')->middleware('auth');
    Route::get('/client/database/{id?}', [AdminControllerOld::class, 'clientAll'])->name('client.database')->middleware('auth');
    Route::post('/client/database', [AdminControllerOld::class, 'ajaxClientAll'])->name('client.database.ajax')->middleware('auth');;
    Route::post('/client/databasedetails', [AdminControllerOld::class, 'ajaxClientSearch'])->name('client.database.ajax.detail')->middleware('auth');
    Route::get('/client/edit/{clientId}', [AdminControllerOld::class, 'clientEdit'])->name('client.edit')->middleware('auth');
    Route::post('/client/edit', [AdminControllerOld::class, 'clientUpdate'])->name('client.edit.submit')->middleware('auth');
    Route::post('/client/delete/', [AdminControllerOld::class, 'clientDelete'])->name('client.delete')->middleware('auth');
    Route::post('/delete/notes/', [AdminControllerOld::class, 'noteDelete'])->name('note.delete')->middleware('auth');
    Route::post('/edit/notes/', [AdminControllerOld::class,'noteEdit'])->name('note.edit')->middleware('auth');
    Route::post('/Client/search', 'AdminControllerOld@clientsearchAjax')->name('clientsearchAjax')->middleware('auth');

//    Job Routes
    Route::get('/create/job', [AdminControllerOld::class, 'jobCreate'])->name('job.create')->middleware('auth');
    Route::post('/create/job', [AdminControllerOld::class, 'jobStore'])->name('job.created')->middleware('auth');
    Route::get('/job/database/{id?}', [AdminControllerOld::class, 'jobAll'])->name('job.database')->middleware('auth');
    Route::post('/job/databaseAjax', [AdminControllerOld::class, 'ajaxJobAll'])->name('jobs.ajax')->middleware('auth');
    Route::post('/job/details', [AdminControllerOld::class, 'jobSearchAjax'])->name('job-Details-Ajax')->middleware('auth');
    Route::get('/job/edit/{jobId}', [AdminControllerOld::class, 'jobEdit'])->name('job.edit')->middleware('auth');
    Route::post('/job/edit', [AdminControllerOld::class, 'jobUpdate'])->name('job.edit.submit')->middleware('auth');
    Route::post('/job/delete/', [AdminControllerOld::class,'jobDelete'])->name('job.delete')->middleware('auth');
    Route::post('/job/candidate/ajax', [AdminControllerOld::class, 'dashboardJobCandidate'])->name('dashboardjobcandidate')->middleware('auth');
    Route::post('/job/pipeline', 'AdminControllerOld@pipelineJob')->name('job.pipeline')->middleware('auth');

    //Candidate Routes
    Route::get('/create/candidate/', [AdminControllerOld::class,'candidateCreate'])->name('candidate.create')->middleware('auth');
    Route::post('/create/candidate/', [AdminControllerOld::class, 'candidateStore'])->name('candidate.submit')->middleware('auth');
    Route::get('/candidate/database/', [AdminControllerOld::class, 'candidateAll'])->name('candidate.database')->middleware('auth');
    Route::post('/candidate/database/', [AdminControllerOld::class,'ajaxCandidateAll'])->name('candidate.database.ajax')->middleware('auth');
    Route::post('/candidate/database/detail', [AdminControllerOld::class, 'candidateSearchAjax'])->name('candidate.database.detail.ajax')->middleware('auth');
    Route::get('/candidate/otm', [AdminControllerOld::class,'candidateOtm'])->name('candidate.otm')->middleware('auth');
    Route::post('/candidate/otm', [AdminControllerOld::class,'candidateSearchOtmAjax'])->name('candidate.otm.ajax')->middleware('auth');
    Route::get('/candidate/dnc', [AdminControllerOld::class, 'candidateDnc'])->name('candidate.dnc')->middleware('auth');

    /*TodoActions Routes*/
    Route::get('/todo/actions', [AdminControllerOld::class, 'todoActions'])->name('todoactions')->middleware('auth');
    Route::get('/todo/actions/list', [AdminControllerOld::class, 'todoActionsList'])->name('todoactionslist')->middleware('auth');
    Route::post('/todo/actions/add', [AdminControllerOld::class, 'createdAction'])->name('createdaction')->middleware('auth');
    Route::post('/todo/actions/update', [AdminControllerOld::class, 'updateaction'])->name('updateaction')->middleware('auth');

    //Status Routes
    Route::get('/create/status', [AdminControllerOld::class, 'statusCreate'])->name('status.create')->middleware('auth');
    Route::post('/create/status', [AdminControllerOld::class, 'statusStore'])->name('status.created')->middleware('auth');
    Route::get('/status', [AdminControllerOld::class, 'statusAjaxAll'])->name('status.ajax')->middleware('auth');
    Route::post('/update/status', [AdminControllerOld::class, 'statusUpdateAjax'])->name('status.update.main')->middleware('auth');
    Route::post('/delete/status', [AdminControllerOld::class, 'statusDeleteAjax'])->name('status.delete.ajax')->middleware('auth');
    Route::post('/status/reminder', [AdminControllerOld::class,'statusReminder'])->name('status.reminder.ajax')->middleware('auth');

    //Education Routes
    Route::get('/create/education', [AdminControllerOld::class, 'educationCreate'])->name('education.create')->middleware('auth');
    Route::post('/created/education', [AdminControllerOld::class, 'educationStore'])->name('education.created')->middleware('auth');
    Route::get('/education/list', [AdminControllerOld::class,'educationAjaxAll'])->name('education.list.ajax')->middleware('auth');
    Route::post('/edit/education', [AdminControllerOld::class ,'educationEdit'])->name('education.edit')->middleware('auth');
    Route::post('/delete/education', [AdminControllerOld::class, 'educationDelete'])->name('education.delete')->middleware('auth');
    //end education

    Route::post('/todo/actions/delete', 'AdminControllerOld@deleteaction')->name('deleteaction')->middleware('auth');
    Route::post('/candidate/dnc', [AdminControllerOld::class, 'candidateSearchDncAjax'])->name('candidate.dnc.ajax')->middleware('auth');
    Route::get('/candidate/OTM/detail/{candId}', 'AdminControllerOld@candidateOtmDetail')->name('candidate.otm.detail')->middleware('auth');
    Route::get('/candidate/detail/{candId}', 'AdminControllerOld@candidateDetail')->name('candidate.detail')->middleware('auth');
//    Route::get('/candidate/OTM/recruitment/status/update' , 'AdminControllerOld@candidateOtmDetail')->name('candidate.recruitment.status.update')->middleware('auth') ;
    Route::post('/candidate/update/status', 'AdminControllerOld@updateStatusAjax')->name('update.status.ajax')->middleware('auth');
    Route::post('/candidate/update/pipeline/status', 'AdminControllerOld@updatepipelineStatusAjax')->name('update.pipeline.status.ajax')->middleware('auth');
    Route::post('/candidate/delete/', 'AdminControllerOld@deleteCandidate')->name('candidate.delete')->middleware('auth');
    Route::get('/candidate/edit/{candId}', 'AdminControllerOld@editCandidate')->name('candidate.edit')->middleware('auth');
    Route::post('/candidate/edit/', 'AdminControllerOld@editedCandidate')->name('candidate.edited')->middleware('auth');
    Route::post('/resume/delete', 'AdminControllerOld@resumeDel')->name('resume.del')->middleware('auth');
    Route::post('/otm/update', 'AdminControllerOld@otmUpdate')->name('otm.update')->middleware('auth');
    Route::post('/otm/remove/pipeline', 'AdminControllerOld@otmRemovePipeline')->name('otm.remove.pipeline')->middleware('auth');
    Route::post('/candidate/remove/pipeline', [AdminControllerOld::class, 'removeCandidatePipeline'])->name('candidate.remove.pipeline')->middleware('auth');
    Route::post('/client/pipeline/jobs', 'AdminControllerOld@pipelineClientJobs')->name('pipeline.client.jobs')->middleware('auth');
    Route::post('/candidate/pipeline/', [AdminControllerOld::class, 'pipelineCandidate'])->name('pipeline.candidate.add')->middleware('auth');
//    Route::post('/candidate/pipeline/' , 'AdminControllerOld@pipelinecandidate')->name('pipeline.candidate.add')->middleware('auth') ;

    //delete job from ajax

    //end delete job from ajax
//    Privileges
//    Route::get('/create/privilege' , 'AdminControllerOld@createprivilege')->name('privileges.create')->middleware('auth') ;
//    Route::post('/created/privilege' , 'AdminControllerOld@createdprivilege')->name('privilege.created')->middleware('auth') ;
//    Route::post('/delete/privilege' , 'AdminControllerOld@deleteprivilege')->name('privilege.delete')->middleware('auth') ;
//    Route::post('/edit/privilege' , 'AdminControllerOld@editprivilege')->name('privilege.edit')->middleware('auth') ;
//    Route::get('/privilege/list' , 'AdminControllerOld@privilegeList')->name('privilege.list.ajax')->middleware('auth') ;
//    end privileges


    Route::post('/sub-admin/resume/delete', [AdminControllerOld::class, 'subAdminDeleteResume'])->name('sub_admin_resume_delete')->middleware('auth');
});
