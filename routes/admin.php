<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserSideAdminJobsController;

Route::get('/notification/read', 'AdminController@markread')->name('markread')->middleware('auth');

Route::get('/admin/dashboard', 'HomeController@index')->name('admin')->middleware('auth');
Route::get('/admin', 'AdminController@index')->name('admin')->middleware('auth');
Route::get('/admin', 'AdminController@index')->name('admin')->middleware('auth');
Route::get('admin/routes', 'HomeController@admin')->middleware('admin')->middleware('auth');


Route::prefix('admin')->group(function () {

    Auth::routes();

    //Pipeline Routes
    Route::middleware(['auth'])->group(function () {
        Route::get('/pipeline', [AdminController::class, 'index'])->name('admin');
        Route::post('/add/piplinejob', [AdminController::class, 'addJobPipeline'])->name('jobpipline.created');
        Route::post('/job/removePiplineAjax/', [AdminController::class, 'removePipelineJobAjax'])->name('job.removePiplinejobAjax');
        Route::post('/client/addPiplineClient/', [AdminController::class, 'addToPipelineClient'])->name('client.addToPipeline');
        Route::post('/client/removePiplineClient/', [AdminController::class, 'removeFromPipelineClient'])->name('client.removePiplineClient');
        Route::post('/client/removePiplineClientAjax', [AdminController::class, 'removePipelineClientAjax'])->name('client.removePiplineClientAjax');
        Route::post('/otm/remove/pipeline', 'AdminController@otmRemovePipeline')->name('otm.remove.pipeline');
        Route::post('/candidate/remove/pipeline', [AdminController::class, 'removeCandidatePipeline'])->name('candidate.remove.pipeline');
        Route::post('/client/pipeline/jobs', [AdminController::class, 'pipelineClientJobs'])->name('pipeline.client.jobs');
        Route::post('/candidate/pipeline/', [AdminController::class, 'pipelineCandidate'])->name('pipeline.candidate.add');
        Route::post('/candidate/update/pipeline/status', [AdminController::class, 'updatepipelineStatusAjax'])->name('update.pipeline.status.ajax');
        Route::post('/job/pipeline', 'AdminController@pipelineJob')->name('job.pipeline');
        Route::get('search/add/piplinejob/', 'AdminController@addJobPiplineForSearch')->name('search.jobpipline.created');
        Route::get('/job/removePipline/{jobId}', 'AdminController@removePipline')->name('job.removePipline');
    });


    Route::post('/add/placement', [AdminController::class, 'placementCreate'])->name('addplacement')->middleware('auth');
    Route::post('/edit/placement', [AdminController::class, 'editPlacement'])->name('editplacement')->middleware('auth');
    Route::post('/delete/placement', [AdminController::class, 'deletePlacement'])->name('deleteplacement')->middleware('auth');
    Route::get('/placement/all', [AdminController::class, 'allPlacement'])->name('allplacement')->middleware('auth');
    Route::post('/placement/list', [AdminController::class, 'listPlacement'])->name('listplacement')->middleware('auth');
    Route::post('/search/placement', [AdminController::class, 'searchPlacement'])->name('searchplacement')->middleware('auth');


//search
    Route::get('/search', [AdminController::class, 'mainSearch'])->name('search')->middleware('auth');
    Route::post('/search', 'AdminController@searchSubmit')->name('search.submit')->middleware('auth');
//end search

    Route::post('/change-login', 'AdminController@change_login')->name('changelogin')->middleware('auth');
    Route::get('/switch-back', 'AdminController@switch_back')->name('switchback')->middleware('auth');


    route::post('/contract/search', [AdminController::class, 'contractDetails'])->name('contractdetails')->middleware('auth');
    route::post('/contract/edit', [AdminController::class, 'contractEdit'])->name('contractedit')->middleware('auth');
    route::post('/contract/delete', [AdminController::class, 'contractDelete'])->name('contractdelete')->middleware('auth');
    Route::get('/non_contract_clients', [AdminController::class, 'nonContract'])->name('noncontract')->middleware('auth');
    Route::post('/add/contract', [AdminController::class, 'contractCreate'])->name('addcontract')->middleware('auth');
    Route::get('/all/contract', [AdminController::class, 'allContracts'])->name('allcontract')->middleware('auth');
    Route::post('/sign/contract', [AdminController::class, 'signContract'])->name('signcontract')->middleware('auth');
    Route::post('/all/contract/ajax', [AdminController::class, 'contractsAjax'])->name('contractsajax')->middleware('auth');

    Route::get('/schedule-interview', [AdminController::class, 'scheduleInterview'])->name('schedule-interview')->middleware('auth');
    Route::post('/company-schedule-interview/', [AdminController::class, 'companyScheduleInterview'])->name('company-schedule-interview')->middleware('auth');
//Route::get('/candidate-schedule-interview/{id?}', 'AdminController@companyscheduleinterview')->name('company-schedule-interview')->middleware('auth');
    Route::get('/scheduled/interview', [AdminController::class, 'scheduledInterviews'])->name('scheduled-interviews')->middleware('auth');
    Route::post('/search_interview', [AdminController::class, 'searchInterviews'])->name('searchinterviews')->middleware('auth');
    Route::post('/scheduled/interview/list', [AdminController::class, 'scheduledinterviewslists'])->name('scheduled-interviews-lists')->middleware('auth');


    route::post('/company/search', [AdminController::class, 'dashSearch'])->name('company.search.dashboard.ajax')->middleware('auth');
    route::post('view-as/company/search', 'AdminController@viewasdashSearch')->name('viewas.company.search.dashboard.ajax')->middleware('auth');

    route::post('/interview/status/update', [AdminController::class, 'updateScheduledInterviewStatus'])->name('updateScheduledInterviewStatus')->middleware('auth');

    Route::get('/all/client/ajax', 'AdminController@allClientajax')->name('client.all.ajax')->middleware('auth');

    //job details against client
    Route::get('/client/jobs/details/{id?}', [AdminController::class, 'clientJobsView'])->name('client.jobs.view')->middleware('auth');
    Route::post('/client/jobs/details', [AdminController::class, 'clientJobsDetails'])->name('client.jobs.details')->middleware('auth');
    //job details
    //for ajax

    //ajax


    Route::get('/client/import/', 'AdminController@clientimportpage')->name('clientimportpage')->middleware('auth');
    Route::post('/client/import/submit', 'AdminController@clientimportsubmit')->name('clientimportsubmit')->middleware('auth');


    // New Candidate Routes
    Route::get('/create/new-candidate/', 'AdminController@createNewCandidate')->name('new.candidate.create')->middleware('auth');
    Route::post('/create/new-candidate/', 'AdminController@new_candidateSubmit')->name('new.candidate.submit')->middleware('auth');
    Route::get('/new-candidate/import/', 'AdminController@newCandidateImportpage')->name('new.candidate.importpage')->middleware('auth');
    Route::post('/new-candidate/import/submit', 'AdminController@newCandidateimportsubmit')->name('new.candidateimportsubmit')->middleware('auth');
    /*Candidate Database Routes*/
    Route::get('/new-candidate/database/', 'AdminController@newCandidateDatabaseView')->name('new.candidate.database')->middleware('auth');
    Route::post('/new-candidate/database/', 'AdminController@newCandidateDatabase')->name('new.candidate.database.ajax')->middleware('auth');
    Route::post('/new-candidate/database/detail', 'AdminController@newCandidateDatabaseDetailAjax')->name('new.candidate.database.detail.ajax')->middleware('auth');

    //candidate routes


    Route::get('/candidate/import/', 'AdminController@candidateimportpage')->name('candidateimportpage')->middleware('auth');
    Route::post('/candidate/import/submit', 'AdminController@candidateimportsubmit')->name('candidateimportsubmit')->middleware('auth');


    Route::post('/candidate/status/bulk', [AdminController::class, 'candidateBulkStatus'])->name('candidate.bulk.status')->middleware('auth');


    Route::post('/client/jobs/', 'AdminController@picJobsAgaintsClient')->name('client.jobs')->middleware('auth');

    //end candidate route


    //interview stages
    Route::get('/interviewStages', 'AdminController@interviewStage')->name('interviewStage')->middleware('auth');
    Route::get('/interview_stage/create', 'AdminController@createInterviewStage')->name('interview.stages.create')->middleware('auth');
    Route::post('/interview_stage/create', 'AdminController@createdInterviewStage')->name('interview.stages.created')->middleware('auth');
    Route::post('/interview_stage/update', 'AdminController@updateInterviewStage')->name('interview.stage.update')->middleware('auth');
    Route::post('/interview_stage/delete', 'AdminController@interviewStageDelete')->name('interview.stage.delete')->middleware('auth');
    //end interview stages

    //interview status
    Route::get('/interviewStatus', 'AdminController@interviewStatus')->name('interviewStatus')->middleware('auth');
    Route::get('/create/interview_status', 'AdminController@createInterviewStatus')->name('interview.status.create')->middleware('auth');
    Route::post('/create/interview_status', 'AdminController@createdInterviewStatus')->name('interview.Status.created')->middleware('auth');
    Route::post('/update/interview_status', 'AdminController@updateInterviewStatus')->name('interview.Status.update')->middleware('auth');
    Route::post('/delete/interview_status', 'AdminController@interviewStatusDelete')->name('interview.Status.delete')->middleware('auth');
    //end interview status


    Route::get('/job/import/', 'AdminController@jobimportpage')->name('jobimportpage')->middleware('auth');
    Route::post('/job/import/submit', 'AdminController@jobimportsubmit')->name('jobimportsubmit')->middleware('auth');


    //delete by ajax

    //end delete by ajax

//

    Route::post('/create/note', 'AdminController@addNote')->name('note.created')->middleware('auth');
    Route::post('/create/note/candidate', [AdminController::class, 'addNoteCandidate'])->name('note.created.candidate')->middleware('auth');


    Route::post('/job/list-view/', [AdminController::class, 'jobListForOneCompany'])->name('job-details-admin')->middleware('auth');
    Route::post('/job/all-list-view/', 'AdminController@alljoblForOneCompany')->name('all-job-admin')->middleware('auth');


    //code by amir
    // Route::get('/create/note' , 'AdminController@addNote')->name('note.created')->middleware('auth');


    Route::get('/job/detail/{jobId}', [AdminController::class, 'jobDetail'])->name('job.detail')->middleware('auth');


    Route::get('/settings', 'AdminController@change_password')->name('change.password')->middleware('auth');
    Route::post('/updatepassword', [AdminController::class, 'updatePassword'])->name('update.password')->middleware('auth');
    Route::post('/update/profile/pic', [AdminController::class, 'updatePic'])->name('update.pic')->middleware('auth');
    Route::get('/list/dashboard/{id?}', [AdminController::class, 'dashboard'])->name('dashboard.database')->middleware('auth');
    //end code by amir


    //client dashboard
    Route::get('/client/dashboard', [AdminController::class, 'clientDashboard'])->name('client.dashboard')->middleware('auth');
    Route::post('/client/dashboard/search', [AdminController::class, 'clientDashboardSearch'])->name('client.dashboard.search.dropdown')->middleware('auth');
    Route::post('/client/dashboard/search/option', [AdminController::class, 'clientDashboardSearchOption'])->name('client.dashboard.search.option')->middleware('auth');
    Route::post('/client/dashboard/job/candidate', [AdminController::class, 'clientDashboardJobCandidate'])->name('client.dashboard.job.candidate')->middleware('auth');
    Route::post('/client/dashboard/job/candidate/detail', [AdminController::class, 'clientDashboardJobCandidateDetail'])
        ->name('client.dashboard.job.candidate.detail')->middleware('auth');
    //end client dashboard


    //todo-module
    Route::get('/todo/all', 'AdminController@todo')->name('todo')->middleware('auth');
    Route::post('/todo/list', 'AdminController@todolist')->name('todolist')->middleware('auth');
    Route::get('/todo/ajax', 'AdminController@todoajax')->name('todoajax')->middleware('auth');
    Route::post('/todo/add', 'AdminController@addtodo')->name('addtodo')->middleware('auth');
    Route::post('/todo/edit', 'AdminController@edittodo')->name('edittodo')->middleware('auth');
    Route::post('/todo/search', 'AdminController@searchtodo')->name('searchtodo')->middleware('auth');
    Route::post('/todo/delete', 'AdminController@deletetodo')->name('deletetodo')->middleware('auth');
    Route::post('/todo/delete/bulk', 'AdminController@bulkdeletetodo')->name('bulkdeletetodo')->middleware('auth');

    // Calendar
    Route::get('/calendar', [AdminController::class, 'calendar'])->name('calendar')->middleware('auth');


    //Sub Admins Routes
    Route::get('/sub-admin/create', [AdminController::class, 'subAdminCreate'])->name('sub_admin_create')->middleware('auth');
    Route::post('/sub-admin/created', [AdminController::class, 'subAdminStore'])->name('sub_admin_created')->middleware('auth');
    Route::get('/sub-admin/edit/{id}', [AdminController::class, 'subAdminEdit'])->name('sub_admin_edit')->middleware('auth');
    Route::post('/sub-admin/update', [AdminController::class, 'subAdminUpdate'])->name('sub_admin_update')->middleware('auth');
    Route::post('/sub-admin/delete', [AdminController::class, 'subAdminDelete'])->name('sub_admin_delete')->middleware('auth');
    Route::get('/sub-admin/all', [AdminController::class, 'subAdminAll'])->name('sub_admin_all')->middleware('auth');
    Route::post('/sub-admin/all/ajax', [AdminController::class, 'ajaxSubAdminAll'])->name('sub_admin_ajax')->middleware('auth');
    Route::post('/sub-admin/search/ajax', [AdminController::class, 'ajaxSubAdminSearch'])->name('sub_admin_ajax_search')->middleware('auth');

    // Client Routes
    Route::get('/create/client', [AdminController::class, 'clientCreate'])->name('client.create')->middleware('auth');
    Route::post('/create/client', [AdminController::class, 'clientStore'])->name('client.created')->middleware('auth');
    Route::get('/client/database/{id?}', [AdminController::class, 'clientAll'])->name('client.database')->middleware('auth');
    Route::post('/client/database', [AdminController::class, 'ajaxClientAll'])->name('client.database.ajax')->middleware('auth');;
    Route::post('/client/databasedetails', [AdminController::class, 'ajaxClientSearch'])->name('client.database.ajax.detail')->middleware('auth');
    Route::get('/client/edit/{clientId}', [AdminController::class, 'clientEdit'])->name('client.edit')->middleware('auth');
    Route::post('/client/edit', [AdminController::class, 'clientUpdate'])->name('client.edit.submit')->middleware('auth');
    Route::post('/client/delete/', [AdminController::class, 'clientDelete'])->name('client.delete')->middleware('auth');
    Route::post('/delete/notes/', [AdminController::class, 'noteDelete'])->name('note.delete')->middleware('auth');
    Route::post('/edit/notes/', [AdminController::class, 'noteEdit'])->name('note.edit')->middleware('auth');
    Route::post('/Client/search', [AdminController::class, 'clientSearchAjax'])->name('clientsearchAjax')->middleware('auth');

//    Job Routes
    Route::get('/create/job', [AdminController::class, 'jobCreate'])->name('job.create')->middleware('auth');
    Route::post('/create/job', [AdminController::class, 'jobStore'])->name('job.created')->middleware('auth');
    Route::get('/job/database/{id?}', [AdminController::class, 'jobAll'])->name('job.database')->middleware('auth');
    Route::post('/job/databaseAjax', [AdminController::class, 'ajaxJobAll'])->name('jobs.ajax')->middleware('auth');
    Route::post('/job/details', [AdminController::class, 'jobSearchAjax'])->name('job-Details-Ajax')->middleware('auth');
    Route::get('/job/edit/{jobId}', [AdminController::class, 'jobEdit'])->name('job.edit')->middleware('auth');
    Route::post('/job/edit', [AdminController::class, 'jobUpdate'])->name('job.edit.submit')->middleware('auth');
    Route::post('/job/delete/', [AdminController::class, 'jobDelete'])->name('job.delete')->middleware('auth');
    Route::post('/job/candidate/ajax', [AdminController::class, 'dashboardJobCandidate'])->name('dashboardjobcandidate')->middleware('auth');


    //Candidate Routes
    Route::get('/create/candidate/', [AdminController::class, 'candidateCreate'])->name('candidate.create')->middleware('auth');
    Route::post('/create/candidate/', [AdminController::class, 'candidateStore'])->name('candidate.submit')->middleware('auth');
    Route::get('/candidate/database/', [AdminController::class, 'candidateAll'])->name('candidate.database')->middleware('auth');
    Route::post('/candidate/database/', [AdminController::class, 'ajaxCandidateAll'])->name('candidate.database.ajax')->middleware('auth');
    Route::post('/candidate/database/detail', [AdminController::class, 'candidateSearchAjax'])->name('candidate.database.detail.ajax')->middleware('auth');
    Route::get('/candidate/otm', [AdminController::class, 'candidateOtm'])->name('candidate.otm')->middleware('auth');
    Route::post('/candidate/otm', [AdminController::class, 'candidateSearchOtmAjax'])->name('candidate.otm.ajax')->middleware('auth');
    Route::get('/candidate/dnc', [AdminController::class, 'candidateDnc'])->name('candidate.dnc')->middleware('auth');

    /*TodoActions Routes*/
    Route::get('/todo/actions', [AdminController::class, 'todoActions'])->name('todoactions')->middleware('auth');
    Route::get('/todo/actions/list', [AdminController::class, 'todoActionsList'])->name('todoactionslist')->middleware('auth');
    Route::post('/todo/actions/add', [AdminController::class, 'createdAction'])->name('createdaction')->middleware('auth');
    Route::post('/todo/actions/update', [AdminController::class, 'updateaction'])->name('updateaction')->middleware('auth');

    //Status Routes
    Route::get('/create/status', [AdminController::class, 'statusCreate'])->name('status.create')->middleware('auth');
    Route::post('/create/status', [AdminController::class, 'statusStore'])->name('status.created')->middleware('auth');
    Route::get('/status', [AdminController::class, 'statusAjaxAll'])->name('status.ajax')->middleware('auth');
    Route::post('/update/status', [AdminController::class, 'statusUpdateAjax'])->name('status.update.main')->middleware('auth');
    Route::post('/delete/status', [AdminController::class, 'statusDeleteAjax'])->name('status.delete.ajax')->middleware('auth');
    Route::post('/status/reminder', [AdminController::class, 'statusReminder'])->name('status.reminder.ajax')->middleware('auth');

    //Education Routes
    Route::get('/create/education', [AdminController::class, 'educationCreate'])->name('education.create')->middleware('auth');
    Route::post('/created/education', [AdminController::class, 'educationStore'])->name('education.created')->middleware('auth');
    Route::get('/education/list', [AdminController::class, 'educationAjaxAll'])->name('education.list.ajax')->middleware('auth');
    Route::post('/edit/education', [AdminController::class, 'educationEdit'])->name('education.edit')->middleware('auth');
    Route::post('/delete/education', [AdminController::class, 'educationDelete'])->name('education.delete')->middleware('auth');
    //end education

    Route::post('/todo/actions/delete', 'AdminController@deleteaction')->name('deleteaction')->middleware('auth');
    Route::post('/candidate/dnc', [AdminController::class, 'candidateSearchDncAjax'])->name('candidate.dnc.ajax')->middleware('auth');
    Route::get('/candidate/OTM/detail/{candId}', 'AdminController@candidateOtmDetail')->name('candidate.otm.detail')->middleware('auth');
    Route::get('/candidate/detail/{candId}', [AdminController::class, 'candidateDetail'])->name('candidate.detail')->middleware('auth');
//    Route::get('/candidate/OTM/recruitment/status/update' , 'AdminController@candidateOtmDetail')->name('candidate.recruitment.status.update')->middleware('auth') ;
    Route::post('/candidate/update/status', [AdminController::class, 'updateStatusAjax'])->name('update.status.ajax')->middleware('auth');

    Route::post('/candidate/delete/', [AdminController::class, 'candidateDelete'])->name('candidate.delete')->middleware('auth');
    Route::get('/candidate/edit/{candId}', [AdminController::class, 'candidateEdit'])->name('candidate.edit')->middleware('auth');
    Route::post('/candidate/edit/', [AdminController::class, 'candidateUpdate'])->name('candidate.edited')->middleware('auth');
    Route::post('/resume/delete', [AdminController::class, 'resumeDelete'])->name('resume.del')->middleware('auth');
    Route::post('/otm/update', 'AdminController@otmUpdate')->name('otm.update')->middleware('auth');
    Route::post('/sub-admin/resume/delete', [AdminController::class, 'subAdminDeleteResume'])->name('sub_admin_resume_delete')->middleware('auth');

    //  Front Routes
    Route::prefix('/front-site')->group(function (){
        Route::middleware(['auth'])->group(function () {
            //  Front Client Routes
            Route::get('clients', [AdminController::class, 'frontClients'])->name('front.clients');
            Route::post('clients-ajax', [AdminController::class, 'frontClientsAjaxAll'])->name('front.clients.ajax.all');
            Route::post('client-detail', [AdminController::class, 'frontClientDetailsAjax'])->name('front.client.details.ajax');
            Route::get('client-detail/{id}', [AdminController::class, 'getFrontClientDetails'])->name('get.front.client.details');

            // Front Jobs Routes

            Route::get('pending/jobs', [AdminController::class, 'frontPendingJobs'])->name('front.pending.jobs');
            Route::post('pending/jobs-ajax', [AdminController::class, 'frontPendingJobsAjaxAll'])->name('front.pending.jobs.ajax.all');
            Route::post('pending/job-detail', [AdminController::class, 'frontJobDetailsAjax'])->name('front.pending.job.details.ajax');

            Route::get('active/jobs', [AdminController::class, 'frontActiveJobs'])->name('front.active.jobs');
            Route::post('active/jobs-ajax', [AdminController::class, 'frontActiveJobsAjaxAll'])->name('front.active.jobs.ajax.all');
            Route::post('active/job-detail', [AdminController::class, 'frontJobDetailsAjax'])->name('front.active.job.details.ajax');

            Route::get('inactive/jobs', [AdminController::class, 'frontInActiveJobs'])->name('front.inactive.jobs');
            Route::post('inactive/jobs-ajax', [AdminController::class, 'frontInActiveJobsAjaxAll'])->name('front.inactive.jobs.ajax.all');
            Route::post('inactive/job-detail', [AdminController::class, 'frontJobDetailsAjax'])->name('front.inactive.job.details.ajax');
//            Route::post('inactive/job-delete', [AdminController::class, 'frontInActiveJobDeleteAjax'])->name('front.inactive.job.delete.ajax');
            Route::post('job-delete', [AdminController::class, 'frontJobDeleteAjax'])->name('front.job.delete.ajax');


            Route::get('rejected/jobs', [AdminController::class, 'frontRejectedJobs'])->name('front.rejected.jobs');
            Route::post('rejected/jobs-ajax', [AdminController::class, 'frontRejectedJobsAjaxAll'])->name('front.rejected.jobs.ajax.all');
            Route::post('rejected/job-detail', [AdminController::class, 'frontJobDetailsAjax'])->name('front.rejected.job.details.ajax');

            Route::get('job-detail/{id}', [AdminController::class, 'getFrontJobDetails'])->name('get.front.job.details');

            Route::post('job-approved',[AdminController::class, 'jobApproval'])->name('job.approval.ajax');
            Route::post('job-rejected',[AdminController::class, 'jobRejected'])->name('job.rejected.ajax');
            // Front Candidates Routes
            Route::get('candidates', [AdminController::class, 'frontCandidates'])->name('front.candidates');
            Route::post('candidates-ajax', [AdminController::class, 'frontCandidatesAjaxAll'])->name('front.candidates.ajax.all');
            Route::post('candidate-detail', [AdminController::class, 'frontCandidateDetailsAjax'])->name('front.candidate.details.ajax');
            Route::get('candidate-detail/{id}', [AdminController::class, 'getFrontCandidateDetails'])->name('get.front.candidate.details');

            //User Side Admin Jobs
            Route::get('/post-new-job', [UserSideAdminJobsController::class, 'createUserSideJob'])->name('user_side.create.job');
            Route::post('/post-new-job', [UserSideAdminJobsController::class, 'storeUserSideJob'])->name('user_side.post.job');
            Route::get('/edit-new-job/{id}', [UserSideAdminJobsController::class, 'editUserSideJob'])->name('user_side.edit.job');
            Route::post('/update-new-job', [UserSideAdminJobsController::class, 'updateUserSideJob'])->name('user_side.update.job');
            Route::post('/delete-admin-job', [UserSideAdminJobsController::class, 'deleteUserSideJob'])->name('user_side.delete.job');
            Route::get('/view_jobs', [UserSideAdminJobsController::class, 'viewJobs'])->name('user_side.view.jobs');
            Route::post('/view_jobs/ajax_all', [UserSideAdminJobsController::class, 'viewJobsAjaxAll'])->name('user_side.view.jobs.ajax');
            Route::post('/view_job_detail/ajax', [UserSideAdminJobsController::class, 'viewJobDetail'])->name('user_side.view.job_detail');

            Route::get('/view_applied_candidates/{jobId}', [UserSideAdminJobsController::class, 'viewAppliedCandidates'])->name('user_side.view.candidates');
            Route::post('/view_applied_candidates/ajax_all', [UserSideAdminJobsController::class, 'viewAppliedCandidatesAjaxAll'])
                ->name('user_side.view.candidates.ajax');
            Route::post('/view_candidate_detail/ajax', [UserSideAdminJobsController::class, 'viewCandidateDetail'])
                ->name('user_side.view.candidate_detail');
        });
    });

});


//    Route::post('/candidate/pipeline/' , 'AdminController@pipelinecandidate')->name('pipeline.candidate.add')->middleware('auth') ;

//delete job from ajax

//end delete job from ajax
//    Privileges
//    Route::get('/create/privilege' , 'AdminController@createprivilege')->name('privileges.create')->middleware('auth') ;
//    Route::post('/created/privilege' , 'AdminController@createdprivilege')->name('privilege.created')->middleware('auth') ;
//    Route::post('/delete/privilege' , 'AdminController@deleteprivilege')->name('privilege.delete')->middleware('auth') ;
//    Route::post('/edit/privilege' , 'AdminController@editprivilege')->name('privilege.edit')->middleware('auth') ;
//    Route::get('/privilege/list' , 'AdminController@privilegeList')->name('privilege.list.ajax')->middleware('auth') ;
//    end privileges


