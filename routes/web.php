<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These

| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\HomeController;

//user
Route::get('/candidate/profile-template', function () {
    return view('user.main');
})->name('user.main');
Route::get('/company/profile-template', function () {
    return view('user.company');
})->name('user.company');

//Route::get('/', function () {
//    return view('user.welcome');
//})->name('welcome');
Route::get('/', [HomeController::class, 'welcome'])->name('welcome');
// employer welcome page
Route::get('/employer/home', [HomeController::class, 'employerWelcome'])->name('employer.welcome');

Route::get('/pricing-plan',[HomeController::class, 'pricingPlans'])->name('pricing.details');
Route::get('/payment-details/{plan}', [HomeController::class, 'paymentDetails'])
    ->name('payment.details')->middleware('paymentDetails');

//Route::get('/change/{slug}', [HomeController::class, 'change'])->name('change');

Route::get('/company-dashboard', function () {
    return view('layouts.company');
});


Route::group(['middleware' => 'UserNotAuth'], function () {
    Route::get('/sign-in', 'User\RegisterController@AuthLogin')->name('user.login');

    Route::post('/sign-up', 'User\RegisterController@register')->name('user.register');


    Route::get('/sign-up', function () {
        return view('user.sign_up');
    })->name('user.signUp');

    Route::post('/login', 'User\RegisterController@login')->name('login.post');


    Route::get('/sign-up/company', function () {
        return view('user.sign_up_company');
    })->name('user.signUp.company');

    Route::get('/verify/account/{code}', 'User\RegisterController@registerVerifyWithLink')->name('candidate.register.verify');

//Route::get('/forgot/password', function () {
//    return view('user.forgot_password') ;
//})->name('user.forgot.password');
    Route::get('/forgot/password', 'User\RegisterController@forgotPassword')->name('forgot.password');

    Route::post('/forgot/password/', 'User\RegisterController@submitForgotPassword')->name('user.forgot.password');
    Route::get('/change/password/{code}', 'User\RegisterController@changePassword')->name('user.change.Password');
    Route::post('/update/password', 'User\RegisterController@updatePassword')->name('user.update.Password');

    Route::post('/company/sign-up/', 'User\RegisterController@companyRegister')->name('company.register.verify');
});

Route::get('/account/logout', 'User\RegisterController@logout')->name('user.logout');

Route::group(['prefix' => 'candidate', 'middleware' => ['CustomAuth', 'CandidateProfileAuth']], function () {
//    Route::get('/dashboard', 'User\HomeController@candidateDashboard')->name('new.candidate.dashboard');
    Route::post('/view/relevant-jobs', [HomeController::class,'viewRelevantJobs'])->name('view.relevant.jobs');
//    Route::get('/edit-profile', 'User\HomeController@editCandProfile')->name('temp.candidate.dashboard') ;
//    Route::get('/profile', 'User\HomeController@candidateProfile')->name('candidate.dashboard') ;
    Route::post('/dashboard/save-profile', [HomeController::class,'saveProfile'])->name('candidate.saveProfile');
    Route::post('/dashboard/save/profile-image', 'User\HomeController@saveProfileImage')->name('profile.img.upload');
//    Route::get('/saved-jobs','User\HomeController@savedJobs')->name('saved.jobs');
    /*Route of Candidate Saved Jobs Interface*/
    Route::post('/view/saved-jobs', [HomeController::class,'viewSavedJobs'])->name('view.saved.jobs');
    Route::post('/remove/saved-jobs', 'User\HomeController@removeSavedJobs')->name('Ajax.remove.saved.job');
    /*Applied Jobs Routes*/
//    Route::get('/applied-jobs','User\HomeController@viewAppliedJobs')->name('view.applied.jobs');
    Route::post('/find/applied-jobs', [HomeController::class,'searchAppliedJobs'])->name('ajax.applied.jobs');
    /*Change Password Routes*/
//    Route::get('/change-password','User\HomeController@viewChangePassword')->name('view.change.password');
//    Route::post('/password-changed','User\HomeController@changePassword')->name('candidate.change.password');
    /*Resume Upload*/
    Route::post('/resume-upload', 'User\HomeController@UploadResume')->name('upload.resume');
    Route::post('/delete-resume', 'User\HomeController@delCandidateResume')->name('delete.resume');

    Route::post('/career-develop', 'User\HomeController@careerDevelopMail')->name('career.develop.mail');
    Route::post('/profile/completed', [HomeController::class,'profileCompleted'])->name('prof_completed');
    Route::get('/delete/account', 'User\HomeController@deleteCandidateAccount')->name('delete.candidate.account');


    /*Candidate Profile in 5 Stages*/
    Route::get('/profile-details', [HomeController::class,'viewPersonalDetails'])->name('candidate.view.personal.details');
    Route::post('/save/personal-details', [HomeController::class,'savePersonalDetails'])->name('candidate.save.personal.details');

    Route::get('/profile/job-details', [HomeController::class,'viewPersonalJobDetails'])->name('candidate.view.personal.job.details');
    Route::post('/save/job-details', [HomeController::class,'savePersonalJobDetails'])->name('candidate.save.personal.job.details');

    Route::get('/profile/skills-details', [HomeController::class,'viewSkillsDetails'])->name('candidate.view.skills.details');
    Route::post('/save/skills-details', [HomeController::class,'saveSkillsDetails'])->name('candidate.save.skills.details');

    Route::get('/profile/salary-details', [HomeController::class,'viewSalaryDetails'])->name('candidate.view.salary.details');
    Route::post('/save/salary-details', [HomeController::class,'saveSalaryDetails'])->name('candidate.save.salary.details');

    Route::get('/profile/interest-details', [HomeController::class,'viewInterestDetails'])->name('candidate.view.interest.details');
    Route::post('/save/interest-details', [HomeController::class,'saveInterestDetails'])->name('candidate.save.interest.details');

    /* New pages */
    Route::get('/dashboard', [HomeController::class,'candidateDashboard'])->name('new.candidate.dashboard');
    Route::get('/profile', 'User\HomeController@candidateProfile')->name('candidate.dashboard');
    Route::get('/saved-jobs', [HomeController::class, 'savedJobs'])->name('saved.jobs');
    Route::get('/applied-jobs', [HomeController::class,'viewAppliedJobs'])->name('view.applied.jobs');
    Route::post('/password-changed', 'User\HomeController@changePassword')->name('candidate.change.password');
    Route::get('/change-password', 'User\HomeController@viewChangePassword')->name('view.change.password');
    Route::get('/edit-profile', [HomeController::class,'editCandProfile'])->name('temp.candidate.dashboard');
    Route::post('/delete-img', 'User\HomeController@delCandidateImg')->name('candidate.delete.image');

});
/*Routes for Non loggedin to Apply for Job */
Route::post('/job/apply/verify-email', [HomeController::class,'jobApplyVerifyEmail'])->name('user.job.apply.verify.mail');
Route::post('/job/apply/resend-code', 'User\HomeController@resendCode')->name('user.job.apply.resend.code');
Route::post('/job/apply/verify-code', 'User\HomeController@chkVerifyEmailCode')->name('job.apply.verify.mail.code');
Route::post('/job/apply/non-verify', [HomeController::class,'nonLoggedinJobApply'])->name('job.apply.non.verify');

Route::post('/apply/job', [HomeController::class, 'jobApply'])->name('job.apply');
Route::post('/save/fav-job', 'User\HomeController@saveFavJob')->name('Ajax.save.job');
Route::get('/career-development', 'User\HomeController@viewCareerDevelopment')
    ->name('view.career.develop');
Route::post('/job-notify', 'User\HomeController@jobNotify')->name('job.notify');
/*Route to redirect from main page to Find Jobs Page*/
Route::post('/main/find-job', 'User\HomeController@mainSearchJob')->name('main.search.job');

Route::post('/find/searched-jobs', [HomeController::class, 'searchedJobs'])->name('ajax.searched.jobs');
Route::get('/job/details/{id}', [HomeController::class, 'jobDetails'])->name('view.job.details');
Route::post('ajax/job/details', [HomeController::class, 'AjaxJobDetails'])->name('ajax.job.details');
Route::get('/find/jobs', [HomeController::class, 'findUserJobs'])
    ->name('user.find.jobs');
Route::post('/submit/job-notify', 'User\HomeController@submitJobNotify')->name('submit.job.notify');
Route::post('/industries', 'User\HomeController@getIndustries')->name('get.industries');


Route::group(['prefix' => 'company', 'middleware' => 'CustomAuthCompany'], function () {
//changes
//    Route::get('/dashboard', 'User\HomeController@companyDashboard')->name('company.dashboard') ;
//    Route::get('/recruitment-details/{id}', 'User\HomeController@companytempRecruitmentDetail')->name('company.recruitment.detail') ;
    Route::post('/recruitment/delete', [HomeController::class, 'companyRecruitmentDetaildelete'])->name('company.recruitment.detail.delete');
//    Route::get('/recruitment', 'User\HomeController@companytempRecruitment')->name('company.recruitment') ;
//    Route::get('/edit-dashboard', 'User\HomeController@companyeditDashboard')->name('user.company.edit.dashboard') ;
    Route::post('created/job', [HomeController::class, 'submitJob'])->name('user.client.job.created');
    Route::post('created/recruitment-service', [HomeController::class,'submitRecruitmentService'])->name('user.client.recruitment.created');
//    Route::get('/profile', 'User\HomeController@companyProfile')->name('user.client.dashboard') ;
    Route::post('/submit/profile', [HomeController::class,'submitCompnayProfile'])->name('user.client.profile.submit');
    Route::post('/logo', 'User\HomeController@companyLogoUpload')->name('user.client.logo.ajax');
//    Route::get('post/job', 'User\HomeController@postJob')->name('user.client.job.post') ;
//    Route::get('create/recruitment-service', 'User\HomeController@createJob')->name('user.client.job.create') ;
//    Route::post('created/job', 'User\HomeController@submitJob')->name('user.client.job.created');
//    Route::get('active/jobs', 'User\HomeController@viewactiveJobs')->name('user.client.view.job.active') ;
    Route::post('view/active/jobs', [HomeController::class,'activeJobs'] )->name('user.client.job.active');
//    new routes
    Route::get('view/job/applicants/{id}', [HomeController::class, 'viewJobCandidates'])->name('job.candidates');
    Route::post('get/job/candidates', [HomeController::class, 'getJobCandidates'])->name('get.job.candidates');
    Route::get('jobs/view-details/{id}', [HomeController::class, 'jobViewDetails'])->name('user.job.details');
    Route::post('delete/job', [HomeController::class, 'userDelJob'])->name('user.client.job.delete');
//    Route::put('/make-job-favourite',[HomeController::class,'makeFav'])->name('user.active_job.favourite');
//    Route::get('/expired/jobs',[HomeController::class,'viewExpiredJobs'])->name('user.client.view.job.expired');
    Route::post('view/expired/jobs', [HomeController::class, 'expiredJobs'])->name('user.client.job.expired');
    Route::get('/candidates', [HomeController::class, 'candidates'])->name('user.client.candidates');
//    Route::get('/change-password',[HomeController::class,'changePasswordClient'])->name('user.client.change-password');
    Route::put('/change-password', [HomeController::class, 'submitChangePasswordClient'])->name('user.client.change-password');
    Route::put('/job/resubmit', [HomeController::class, 'resubmit']);
    Route::get('/candidate-details/{cand}/{jobID}', [HomeController::class, 'candidateDetails'])->name('user.candidate-details');
    Route::get('/edit/job/details/{id}', [HomeController::class, 'editJobDetails'])->name('user.edit.job.details');
    Route::put('/edit/job/details/{id}', [HomeController::class, 'submitEditJobDetails'])->name('user.edit.job.details');
    Route::get('/download/resume/{id}', [HomeController::class, 'downloadResume'])->name('user.download.resume');
    Route::get('/delete/account', 'User\HomeController@deleteCompanyAccount')->name('delete.company.account');
    Route::post('/get/states', [HomeController::class, 'getStates'])->name('ajax.get.states');

    // new pages
    Route::get('/dashboard', [HomeController::class,'companyDashboard'])->name('company.dashboard');
    Route::get('/profile', 'User\HomeController@companyProfile')->name('user.client.dashboard');
    Route::get('/edit-profile', [HomeController::class,'companyeditDashboard'])->name('user.company.edit.dashboard');
    Route::get('post/job', [HomeController::class, 'postJob'])->name('user.client.job.post');
    Route::get('create/recruitment-service', [HomeController::class,'createJob'])->name('user.client.job.create');
    Route::get('/recruitment', [HomeController::class, 'companytempRecruitment'])->name('company.recruitment');
    Route::post('view/active/recruitment', [HomeController::class,'activeRecruitments'] )->name('active.recruitment');
    Route::get('/recruitment-details/{id}', 'User\HomeController@companytempRecruitmentDetail')->name('company.recruitment.detail');
    Route::get('active/jobs', [HomeController::class, 'viewactiveJobs'])->name('user.client.view.job.active');
    Route::get('/expired/jobs', [HomeController::class, 'viewExpiredJobs'])->name('user.client.view.job.expired');
    Route::get('/change-password', [HomeController::class, 'changePasswordClient'])->name('user.client.change-password');
    Route::post('/delete-logo', [HomeController::class, 'delCompanyLogo'])->name('user.client.delete-logo');
//    pending and rejected routes
    Route::get('view/pending/jobs', [HomeController::class, 'viewPendingJobs'])->name('user.client.job.pending');
    Route::post('pending/jobs', [HomeController::class, 'pendingJobs'])->name('user.client.view.job.pending');

    Route::get('view/rejected/jobs', [HomeController::class, 'viewRejectedJobs'])->name('user.client.job.rejected');
    Route::post('rejected/jobs', [HomeController::class, 'rejectedJobs'])->name('user.client.view.job.rejected');


});

/*Route to FInd Talent Email*/
Route::post('/find-talent', [HomeController::class, 'findTalent'])->name('find.talent');
Route::post('/user-contact-mail', [HomeController::class, 'userContactMail'])->name('user.contact.mail');


Route::get('/about-us', function () {

    return view('user.about_us');
})->name('about.us');

Route::get('/contact/{id?}', function () {
    return view('user.contact');
})->name('contact');

Route::get('/recruiting-services', function () {
    return view('user.recruiting_services');
})->name('user.recruiting.services');

Route::get('/direct-placement', function () {
    return view('user.direct_placement');
})->name('user.direct.placement');

Route::get('/temporary-staffing', function () {
    return view('user.temporary_staffing');
})->name('user.temporary.staffing');

Route::get('/industry-insights', function () {
    return view('user.industry_insights');
})->name('user.industry.insights');

Route::get('/career-resources', function () {
    return view('user.career_resources');
})->name('user.career.resources');


//end user
//Mail
Route::post('/send-cv', 'mailController@send_cv')->name('send_cv')->middleware('auth');
Route::post('/send-email', 'mailController@send_email')->name('send_email')->middleware('auth');
Route::post('/interview/mail', 'mailController@scheduleinterview')->name('interviewmail')->middleware('auth');


Route::get('/test', function () {
    \App\NewCandidate::where('salary_type','=','Per Hour')
        ->update(['salary_type' => 'hourly']);
    \App\NewCandidate::where('salary_type','=','Per Day')
        ->update(['salary_type' => 'daily']);
    \App\NewCandidate::where('salary_type','=','Per Month')
        ->update(['salary_type' => 'monthly']);
    \App\NewCandidate::where('salary_type','=','Per Week')
        ->update(['salary_type' => 'weekly']);
    \App\NewCandidate::where('salary_type','=','Per Year')
        ->update(['salary_type' => 'yearly']);

    return 1;
//    Artisan::call('optimize:clear');
//    return response()->json(['mes' => "clear"]);
})->name('clear-cache');



//Route::post('post/ckeditor/upload', 'mailController@upload_image_cke')->name('ckeditor.upload');

//new routes
//Route::get('employeer/homepage', function (){
//    return view('user.employeer_welcome');
//});

//Route::get('employeer/pricing-plan', function (){
//    return view('user.pricing_plan');
//});

//Route::get('employeer/payment', function (){
//    return view('user.payment');
//});
Route::get('employeer/view-job-details', function (){
    return view('user.view_job_details');
});
Route::get('employeer/view-billing-information', function (){
    return view('user.view_billing_information');
});
Route::get('employeer/update-billing-information', function (){
    return view('user.update_billing_information');
});
Route::get('employeer/orders-history', function (){
    return view('user.orders_history');
});
Route::get('employeer/post-job/', function (){
    return view('user.employeer_post_job');
});

Route::get('employeer/job-qualification/', function (){
    return view('user.employeer_job_qualification');
});
Route::get('employeer/job-benefits/', function (){
    return view('user.employeer_job_benefits');
});
Route::get('employeer/update-company-profile/', function (){
    return view('user.update_com_profile');
});
Route::get('employeer/personal-details/', function (){
    return view('user.employeer_personal_details');
});

