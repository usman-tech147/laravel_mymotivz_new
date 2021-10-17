<?php

namespace App\Http\Controllers\User;

use App\career_job_notify;
use App\Client;
use App\Industry;
use App\JobNotify;
use App\Mail\CompanyReceiveNewCandidateMail;
use App\Mail\FindTalentMail;
use App\Mail\CareerDevelopMail;
use App\Mail\ContactUserMail;
use App\Mail\SendJobApplyEmailVerifyCode;
use App\Candidate;
use App\Models\PayPal\Package;
use App\Models\PayPal\PaypalAgreement;
use App\NewCandidate;
use App\candidate_resume;
use App\NewClient;
use App\favourite_job;
use App\recruitment_service;
use App\Applied_Jobs;
use App\Http\Requests\JobDetailRequest;
use App\new_job_notify;
use App\Http\Requests\PasswordRequest;
use App\Job;
use App\Education;
use App\Resume;
use App\Rules\AlphaNumericSpace;
use App\Rules\AlphaSpace;
use App\Rules\CurrencyValidation;
use App\Rules\PhoneNumber;
use App\Rules\ValidLocation;
use App\Rules\ValidUrl;
use App\user_job;
use App\Find_Talent;
use App\Country;
use App\State;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Session;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\SendRegistrationCode;
use App\Mail\JobApplySuccessMail;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    //this controller is for client (company) oprations, its better to create other controller for candidate (employee)

    //Candidate Registration

    public function welcome()
    {
//        if (Session::get('status') == 1 || Session::has('c_email')) {
//            return view('user.employer_welcome');
//        }
//        dd("job seekers welcome page");
        Session::forget('status');
        return view('user.welcome');
    }

    public function change($slug)
    {
        if ($slug == 'Employers') {
            session(['status' => 1]);
        } elseif ($slug == 'Job Seekers') {
            Session::forget('status');
        }
        return redirect()->back();

    }

    public function employerWelcome()
    {
        session(['status' => 1]);
        return view('user.employer_welcome');
    }

    public function findTalent(Request $request)
    {

//        dd($request->all());
        $response = $request->validate([
            'name' => 'required|regex:/^[a-zA-Z ]+$/u|max:255',
            'title' => 'required|regex:/^[a-zA-Z ]+$/u|max:255',
            'company' => 'required|max:255',
            'industry' => 'required|max:255',
            'email' => 'required|email|unique:find__talent',
//            'phone_ext' => 'required|regex:/^\+[0-9]+$/u|min:3|max:5',
            'phone_no' => 'required|regex:/^[0-9\-\(\)\s]+$/|min:14|max:14',
            'position' => 'required|max:255',
            'job_desc' => 'required|max:500',
            'sel_service' => 'required',
            'g-recaptcha-response' => 'required',
        ], [
            'name.required' => 'FullName is required',
            'name.regex' => 'FullName only contain alphabets',
            'name.max' => 'FullName must be less than 255 characters',
            'title.required' => 'Job title is required',
            'title.regex' => 'Title only contain alphabets',
            'title.max' => 'Title must be less than 255 characters long',
            'company.required' => 'Company is required',
            'company.max' => 'Company must be less than 255 characters',
            'industry.required' => 'Industry is required',
            'industry.max' => 'Industry must be less than 255 characters',
            'email.required' => 'Email is required',
            'email.email' => 'Email should be valid',
            'phone_ext.required' => 'Phone extension is required',
            'phone_ext.regex' => 'Phone extension must be valid',
            'phone_ext.min' => 'Phone extension must be minimum 2 digits long',
            'phone_ext.max' => 'Phone extension must be less than 4 digits long',
            'phone_no.required' => 'Phone number is required',
            'phone_no.regex' => 'Phone number must be in digits form',
            'phone_no.min' => 'Phone number must be equal to 14 digits',
            'phone_no.max' => 'Phone number must be equal to 14 digits',
            'position.required' => 'Position is required',
            'position.max' => 'Position must be less than 30 characters',
            'job_desc.required' => 'Description is required',
            'job_desc.max' => 'Description must be less than 500 characters',
            'sel_service.required' => 'Service is required',
            'g-recaptcha-response.required' => 'Recaptcha is required',
        ]);

        $data = ["name" => $request->name, "title" => $request->title, "company" => $request->company, "industry" => $request->industry, "email" => $request->email, "phone_ext" => $request->phone_ext, "phone_no" => $request->phone_no, "position" => $request->position,
            "job_desc" => $request->job_desc, "sel_service" => $request->sel_service];


        $find_talent = new Find_Talent;
        $find_talent->name = $request->name;
        $find_talent->title = $request->title;
        $find_talent->company = $request->company;
//        $find_talent->industry = $request->industry;
        $find_talent->industry_id = $request->industry;
        $find_talent->email = $request->email;
        $find_talent->contact = $request->phone_ext . '' . $request->phone_no;
        $find_talent->position = $request->position;
        $find_talent->job_desc = $request->job_desc;
        $find_talent->sel_service = $request->sel_service;
        $find_talent->save();

        $email = new FindTalentMail($data);
        /*$from_email = "hananbhatti440@gmail.com";*/
        $from_email = "admin@softenica.com";
        Mail::to($from_email)->send($email);

//        session()->flash('verify', 'Your Request submitted successfully.');

        return back()->with('verify', 'Your Request Submitted Successfully.');
    }

    public function userContactMail(Request $request)
    {
        $request->validate([
            'name' => 'required|regex:/^[a-zA-Z ]+$/u|max:255',
            'email' => 'required|email',
            'phone' => 'required|regex:/^[0-9\-\(\)\s]+$/|min:14|max:14',
            'subject' => 'required|max:255',
            'message' => 'required|max:500',
            'g-recaptcha-response' => 'required',
        ], [
            'g-recaptcha-response.required' => 'Recaptcha is required.',
        ]);


        $data = ["name" => $request->name, "email" => $request->email, "phone" => $request->phone, "subject" => $request->subject, "message" => $request->message];
        $email = new ContactUserMail($data);
        /*softenicauser@gmail.com*/
        $from_email = "usama.softenica@gmail.com";
        Mail::to($from_email)->send($email);
        return back()->with('success', 'Your have successfully submitted.');


    }

    public function careerDevelopMail(Request $request)
    {
        $candidate = NewCandidate::where('email', $request->email)->first();
        if ($candidate->career_dev == 1) {
            return json_encode('error');
        } else {
            $data = ["email" => $request->email];
            $email = new CareerDevelopMail($data);
            $from_email = "admin@softenice.com";
            Mail::to($from_email)->send($email);
            $candidate = NewCandidate::where('email', $request->email)->first();
            $candidate->career_dev = 1;
            $candidate->save();
            return json_encode('success');
        }

    }

    public function candidateDashboard()
    {
        $Candidate = NewCandidate::where('id', session()->get('candidate_id'))->first();
        $applied_jobs = Applied_Jobs::where('candidate_id', $Candidate->id)
            ->count();
        $favourite_job = favourite_job::where('candidate_id', $Candidate->id)->count();
//        return view('user.candidate_dashboard')->with(compact('Candidate'));
//        dd($Candidate->applied_job);
        session(['candidate_name' => $Candidate->name]);
//        dd($applied_jobs);
        return view('user.user_new_dashboard')->with(compact('Candidate', 'applied_jobs', 'favourite_job'));
    }

    public function candidateProfile()
    {
        $Education = Education::all();
        $Candidate = NewCandidate::with('industry', 'education')->where('id', session()->get('candidate_id'))->first();
        $candidate_resume = candidate_resume::where([['candidate_id', session()->get('candidate_id')], ['status', 1]])->get();
        return view('user.new-profile')->with(compact('Education', 'Candidate', 'candidate_resume'));
    }

    public function editCandProfile()
    {
//        dd('edit profile');
        $Education = Education::all();
        $industries = Industry::all();
        $Candidate = NewCandidate::where('id', session()->get('candidate_id'))->first();
        $candidate_resume = candidate_resume::where([['candidate_id', session()->get('candidate_id')], ['status', 1]])
            ->get();

//        return view('user.profile-settings')->with(compact('Education', 'Candidate', 'candidate_resume','industries'));
//        dd($Candidate->auth_status);

        return view('user.new-edit-profile')->with(compact('Education', 'Candidate', 'candidate_resume', 'industries'));
    }

    public function saveProfile(Request $request)
    {
//        dd($request->all());
        $request->validate(
            [
                'full_name' => 'required|regex:/^[a-zA-Z ]+$/u|max:20',
                'job_title' => ['required', 'min:2', 'max:255'],
                'phone_no' => ['required', 'min:14', 'max:14', new PhoneNumber()],
                'linkedin_url' => ['nullable', new ValidUrl()],
//               'location' => 'required|regex:/^[a-zA-Z,.\s]*$/|min:2|max:255',
                'location' => 'required',
                'package' => ['required', 'min:1', 'max:20', new CurrencyValidation()],
                'package_to' => ['nullable', 'min:1', 'max:20', new CurrencyValidation()],
                'skills' => 'nullable|max:500',
                'interest' => 'nullable|max:255',
                'sel_experience' => 'required|not_in:0',
                'sel_education' => 'required|not_in:0',
                'industry' => 'required',
                'sel_job_type' => 'required|not_in:0',
                'resume' => 'mimes:doc,docx,pdf',
//                'prof_summary' => 'max:500',
                'required_certification' => 'nullable|max:500',
                'auth_status' => 'required',
            ],
            [
                'full_name.required' => 'FullName is required',
                'full_name.regex' => 'FullName only contain alphabets',
                'full_name.max' => 'FullName must be less than 20 characters',
                'job_title.required' => 'Job title is required',
//                'job_title.regex' => 'Job Title only contain alphabets',
                'job_title.max' => 'Job title must be less than 255 characters long',
                'phone_no.required' => 'Phone No is required',
                'phone_no.regex' => 'Phone number must be in digits form',
                'phone_no.min' => 'Phone number must be equal to 14 digits',
                'phone_no.max' => 'Phone number must be equal to 14 digits',
//                'skills.required' => 'Skills are required',
                'skills.max' => 'Skills must be less than 500 characters long',
//                'interest.required' => 'Interests are required',
                'interest.max' => 'Interest must be less than 255 characters',
                'sel_experience.required' => 'Education is Required',
                'sel_experience.not-in' => 'Select Education Type',
                'sel_education.required' => 'Education is Required',
                'sel_education.not-in' => 'Select Education Type',
                'industry.required' => 'Industry is required',
                'sel_job_type.required' => 'Job type is required',
                'sel_job_type.not-in' => 'Kindly select Job Type',
                'resume.mimes' => 'Only pdf, doc and docx files are allowed.',
                'prof_summary.max' => 'Professional summary must be less than 500 characters',
                'required_certification' => 'Certification must be less than 500 characters long'

            ]);

//        dd($request->all());
        $candidate_prof = NewCandidate::where('id', session()->get('candidate_id'))->first();

        if ($request->curr_sign == 'USD') {
            $candidate_prof->salary_sign = '$';
        } else if ($request->curr_sign == "CAD") {
            $candidate_prof->salary_sign = 'C$';
        } else if ($request->curr_sign == "GBP") {
            $candidate_prof->salary_sign = '£';
        } else if ($request->curr_sign == "AUD") {
            $candidate_prof->salary_sign = 'A$';
        } else {
            $candidate_prof->salary_sign = '€';
        }

//        dd($candidate_prof);

        $candidate_prof->name = $request->full_name;
        $candidate_prof->job_title = $request->job_title;
        $candidate_prof->phone = $request->phone_no;
        $candidate_prof->email = session()->get('email');
        $candidate_prof->location = $request->location;
//        $candidate_prof->salary_sign = $request->hidd_curr_sign;
        $candidate_prof->salary = $request->package;
        $candidate_prof->salary_to = $request->package_to;
        $candidate_prof->salary_type = $request->salary_duration;
        $candidate_prof->skills = $request->skills;
        $candidate_prof->interest = $request->interest;
        $candidate_prof->experience = $request->sel_experience;
        $candidate_prof->industry_id = $request->industry;
        $candidate_prof->prof_summary = $request->prof_summary;
        $candidate_prof->job_type = $request->sel_job_type;
        $candidate_prof->education_id = $request->get('sel_education');
        $candidate_prof->auth_status = $request->auth_status;
        $candidate_prof->certifications = $request->required_certification;
        $candidate_prof->linkedin_url = $request->linkedin_url;

        if ($request->pro_img != '') {
//            dd('inside profimg');
            if ($candidate_prof->prof_image != '') {
                $img_path = public_path('/uploads/Candidate_Profile_Images/' . $candidate_prof->prof_image);
                unlink($img_path);
            }
            $canidate_img = $request->file('pro_img');
            $name = $canidate_img->getClientOriginalName();
            $curr_date = date('Y_m_d-H-i-s');
            $filename = pathinfo($name, PATHINFO_FILENAME);
            $extension = pathinfo($name, PATHINFO_EXTENSION);
            $image_name = $filename . '-' . $curr_date . '.' . $extension;
            $path = public_path('/uploads/Candidate_Profile_Images');
            $canidate_img->move($path, $image_name);
            $candidate_prof->prof_image = $image_name;

        }


        $candidate_prof->save();
//        dd($candidate_prof);
//        dd($candidate_prof->salary_sign);
        session(['candidate_name' => $request->full_name]);
        session(['cand_prof_img' => $candidate_prof->prof_image]);
//        dd($candidate_prof);
        if ($request->resume != '') {
            $chk_resume = candidate_resume::where([['candidate_id', session()->get('candidate_id')], ['status', 0]])->first();
//            if ($chk_resume == '') {
//                $resume = new candidate_resume();
            $canidate_resume = $request->file('resume');
            $curr_date = date('Y_m_d-H-i-s');
            $name = $canidate_resume->getClientOriginalName();
            $filename = pathinfo($name, PATHINFO_FILENAME);
            $extension = pathinfo($name, PATHINFO_EXTENSION);
            $resume_name = $filename . '-' . $curr_date . '.' . $extension;
            $path = public_path('/files');
            $canidate_resume->move($path, $resume_name);
            $resume_dest_path = $resume_name;
//                $resume->resume = $resume_dest_path;
            $chk_resume->resume = $resume_dest_path;
            $chk_resume->status = 1;
            $chk_resume->save();

            $applied_jobs_resumes = Applied_Jobs::where('candidate_id', session()->get('candidate_id'))->get();
            foreach ($applied_jobs_resumes as $resume) {
                $resume->resume_id = $chk_resume->id;
                $resume->save();
            }

//                $resume->candidate_id = session()->get('candidate_id');
//                $resume->save();
//            } else {
//                return back()->with('resume_err', 'Only one Resume is allowed.');
//            }
        }


        return back()->with('updated', 'Profile Updated Successfully');
    }

    public function saveProfileImage(Request $request)
    {
        $request->validate([
            'prof_img' => 'required|mimes:jpg,jpeg,png,gif.',
        ], [
            'prof_img.required' => 'Image is Required.',
            'prof_img.mimes' => 'Only jpg,jpeg,png,gif Image Formats are allowed.'
        ]);
        $candidate = NewCandidate::where('id', session()->get('candidate_id'))->first();
        if ($candidate->prof_image != '') {
            $img_path = public_path('/uploads/Candidate_Profile_Images/' . $candidate->prof_image);
            unlink($img_path);
        }
        $canidate_img = $request->file('prof_img');
        $name = $canidate_img->getClientOriginalName();
        $curr_date = date('Y_m_d-H-i-s');
        $filename = pathinfo($name, PATHINFO_FILENAME);
        $extension = pathinfo($name, PATHINFO_EXTENSION);
        $image_name = $filename . '-' . $curr_date . '.' . $extension;
        $path = public_path('/uploads/Candidate_Profile_Images');
        $canidate_img->move($path, $image_name);
        $candidate->prof_image = $image_name;
        $query = $candidate->save();

        if ($query) {
            $cand_img = NewCandidate::where('id', session()->get('candidate_id'))->first();
            $cand_prof_img = $cand_img->prof_image;
            //update in session to change for all views
            session(['cand_prof_img' => $cand_prof_img]);
            return json_encode(['success' => $cand_prof_img]);
        } else {
            return json_encode('error');
        }
//        return back()->with('updated', 'Profile Image Uploaded Successfully');
    }

    public function delCandidateResume(Request $request)
    {
        $id = $request->id;
        $resumes = candidate_resume::where('id', $id)->where('candidate_id', session()->get('candidate_id'))->first();
        $resume_path = public_path('/files/' . $resumes->resume);
        unlink($resume_path);

        $app_job_resumes = $resumes->applied_jobs;
        foreach ($app_job_resumes as $resume) {
            $resume->resume_id = null;
            $resume->save();
        }

        $resumes->status = 0;
        $resumes->save();

        return response('deleted');
    }

    public function delCandidateImg(Request $request)
    {
        $id = $request->id;
//        $company = NewClient::where('id', $id)->get('candidate_id')->first();
        $candidate = NewCandidate::find($id);
        $img_path = public_path('/uploads/Candidate_Profile_Images/' . $candidate->prof_image);
        unlink($img_path);

        $candidate->prof_image = '';
        $candidate->save();
        session(['cand_prof_img' => '']);
        return response('deleted');
    }

    public function delCompanyLogo(Request $request)
    {
        $id = $request->id;
//        $company = NewClient::where('id', $id)->get('candidate_id')->first();
        $company = NewClient::find($id);
        $logo_path = public_path('/user/company_logo/' . $company->logo);
        unlink($logo_path);
        $company->logo = '';
        $company->save();
        session(['c_email.logo' => '']);
        return response('deleted');
    }

    /*Saved jobs interface Functions*/
    public function savedJobs()
    {
        $Candidate = NewCandidate::where('id', session()->get('candidate_id'))->first();
//        return view('user.favourite_jobs')->with(compact('Candidate'));
        return view('user.saved_jobs')->with(compact('Candidate'));
    }

    public function viewSavedJobs(Request $request)
    {
        $start = 0;
        if ($request->current) {
            $start = ($request->current - 1) * $request->length;
        }
        $find_saved_jobs_query = favourite_job::where(function ($query) use ($request) {
            $query->whereHas('job', function ($query) use ($request) {
                if (!is_null($request->place)) {
                    $place = $request->place;
                    $query->where('location', 'like', "%$place%");
                }
                if (!is_null($request->job_title)) {
                    $job_title = $request->job_title;
                    $query->where('job_title', 'like', "%$job_title%");

                }
            });
        })->where('candidate_id', session()->get('candidate_id'));
        $total = $find_saved_jobs_query->count();
        $find_saved_jobs = $find_saved_jobs_query->orderBy('created_at', 'DESC')
            ->offset($start)
            ->limit($request->length)
            ->get();
        $f = $find_saved_jobs;
        if ($find_saved_jobs) {
            $f = $find_saved_jobs->load(['job', 'job.client', 'job.admin']);
        }
        $arrayName = array('0' => '', '1' => $f->toArray(), '2' => $total);
        return json_encode($arrayName);
    }

    public function viewRelevantJobs(Request $request)
    {
        if ($request->current == 1) {
            $start = 0;
        } else {
            $start = ($request->current - 1) * $request->length;
        }

        $candidate = NewCandidate::where('id', session()->get('candidate_id'))->first();

        $where_filter = ' ( industry_id = ' . $candidate->industry_id . '';

        $where_filter .= ' OR location = "' . $candidate->location . '"';


        $job_skills = explode(",", $candidate->skills);
        if (!is_null($job_skills)) {
            for ($i = 0; $i < count($job_skills); $i++) {
                $where_filter .= ' OR job_title LIKE "%' . $job_skills[$i] . '%"';
            }
        }
//        dd($where_filter);

        $job_title = explode(",", $candidate->job_title);
        if (!is_null($job_title)) {
            for ($i = 0; $i < count($job_title); $i++) {
                $where_filter .= ' OR job_title LIKE "%' . $job_title[$i] . '%"';
            }

        }
        $where_filter .= ')';

        $find_relevant_jobs = user_job::
        with('Client', 'Industry', 'admin')
            ->where(['job_approved' => 1])
            ->whereRaw($where_filter)
            ->whereDate('applied_before', '>', Carbon::now())->orderBy('created_at', 'DESC')
            ->offset($start)->limit($request->length)
            ->get()
            ->toArray();

        $arrayName = array('0' => '', '1' => $find_relevant_jobs);
        return json_encode($arrayName);
    }

    public function removeSavedJobs(Request $request)
    {
        $fav_job = favourite_job::where('id', $request->id)->first();
        $fav_job->delete();
        return response('deleted');
    }

    public function viewAppliedJobs()
    {
        $Candidate = NewCandidate::where('id', session()->get('candidate_id'))->first();
        $applied_jobs = Applied_Jobs::with('Job', 'Job.Client')->where('candidate_id', session()->get('candidate_id'))->get();

//        $saved_jobs = implode(',' , $saved_jobs);
//        dd($saved_jobs);
//        dd($applied_jobs->toArray());
//        return view('user.applied_jobs')->with(compact('Candidate', 'applied_jobs'));
        return view('user.new-applied-jobs')->with(compact('Candidate', 'applied_jobs'));
    }

    public function searchAppliedJobs(Request $request)
    {
        if ($request->current == 1) {
            $start = 0;
        } else {
            $start = ($request->current - 1) * $request->length;
        }
        $find_applied_jobs_query = Applied_Jobs::with('Job', 'Job.Client', 'Job.industry', 'Job.admin')
            ->where('candidate_id', session()->get('candidate_id'))
            ->where(function ($query) use ($request) {
                if (!empty($request->job_title)) {
                    $query->whereHas('job', function ($query) use ($request) {
                        $query->where('job_title', 'LIKE', '%' . $request->job_title . '%');
                    });
                }
                if (!empty($request->place)) {
                    $query->whereHas('job', function ($query) use ($request) {
                        $query->where('location', 'LIKE', '%' . $request->place . '%');
                    });
                }
            });
        $total = $find_applied_jobs_query->count();
        $find_applied_jobs = $find_applied_jobs_query
            ->orderBy('created_at', 'DESC')
            ->offset($start)
            ->limit($request->length)
            ->get()
            ->toArray();
//        $saved_jobs = favourite_job::select('job_id')->where('candidate_id', session()->get('candidate_id'))->get()->toArray();
//        $arrayName = array('0' => '', '1' => $find_applied_jobs, '2' => $saved_jobs);
        $arrayName = array('0' => '', '1' => $find_applied_jobs, '2' => $total);
        return json_encode($arrayName);
    }

    public function viewChangePassword()
    {
        $Candidate = NewCandidate::where('id', session()->get('candidate_id'))->first();
//        return view('user.change-password')->with(compact('Candidate'));
        return view('user.new-change-password')->with(compact('Candidate'));
    }

    public function changePassword(Request $request)
    {
        $Candidate = NewCandidate::where('id', session()->get('candidate_id'))->first();
        $cand_pass = $Candidate->password;

        $request->validate([
            'old_pass' => 'required',
            'new_pass' => 'required|min:6|max:20|regex:/^(?=.*[0-9])(?=.*[A-Z])(?=.*\d).+$/',
            'new_pass_confirm' => 'required|same:new_pass',
        ], [
            'old_pass.required' => 'Old Password is Required',
            'new_pass.required' => 'New Password is Required',
            'new_pass.min' => 'New Password should be minimum 6 characters long',
            'new_pass.max' => 'New Password should be maximum 20 characters long',
            'new_pass.regex' => 'New Password must contain at least 1 number 1 uppercase and 1 Special Character',
            'new_pass_confirm.required' => 'Confirm Password is Required',
            'new_pass_confirm.same' => 'Confirm Password must be same as New Password',
        ]);
        if (Hash::check($request->old_pass, $cand_pass)) {
            $Candidate->password = Hash::make($request->new_pass);

//            dd('password match');
            $Candidate->save();
            return back()->with('pass_changed', 'Password Changed Successfully!');
        } else {
//            dd('password didnot match');
            return back()->with('old_pass_not_match', 'Old Password is not Correct');
        }
    }

    /*Profile Completed*/
    public function profileCompleted()
    {
        $Candidate = NewCandidate::where('id', session()->get('candidate_id'))->first();
        if ($Candidate->career_dev == 0) {
            $Candidate->career_dev = 1;
            $Candidate->save();
            return response('completed');
        } else {
            return response('already_completed');
        }
    }

    public function deleteCandidateAccount()
    {
        $candidate = NewCandidate::where('id', session()->get('candidate_id'))->first();
        if (!is_null($candidate)) {
            $candidate->deleted = 1;
            $candidate->save();
            session()->flush();
//            return response()->json(['url'=>url('/account/logout')]);
            return redirect()->route('user.login')->with('account_del', 'Your Account deleted successfully.');
        }
    }

    /*Changed View of Find Jobs functions*/
    public function findUserJobs()
    {
        $candidate = NewCandidate::where('id', session()->get('candidate_id'))->first();
        $fav_jobs = favourite_job::where('candidate_id', session()->get('candidate_id'))->get();
        $candidate_resumes = candidate_resume::where([['candidate_id', session()->get('candidate_id')], ['status', 1]])->get();
        $industries = Industry::all();
        $jobs = user_job::with('Client', 'admin')
            ->where('featured', 1)
            ->whereDate('applied_before', '>', Carbon::now())
            ->where('job_approved', 1)
            ->get();
        return view('user.find_jobs')->with(compact('jobs', 'fav_jobs', 'candidate', 'industries', 'candidate_resumes'));
    }

    public function searchedJobs(Request $request)
    {
        if (session()->has('search_job_title')) {
            session()->forget('search_job_title');
        }
        if (session()->has('search_location')) {
            session()->forget('search_location');
        }
        if ($request->current == 1) {
            $start = 0;
        } else {
            $start = ($request->current - 1) * $request->length;
        }
        $where_filter = 'id IS NOT NULL';
        /*(Date Filter) to search Job*/
        if ($request->date_filter == '1 hour') {
            $where_filter .= ' AND created_at >= "' . Carbon::now()->subHours(1) . '"';
        } elseif ($request->date_filter == '24 hour') {
            $where_filter .= ' AND created_at >= "' . Carbon::now()->subDays(1) . '"';
        } elseif ($request->date_filter == '7 days') {
            $where_filter .= ' AND created_at >= "' . Carbon::now()->subDays(7) . '"';
        } elseif ($request->date_filter == '14 days') {
            $where_filter .= ' AND created_at >= "' . Carbon::now()->subDays(14) . '"';
        } elseif ($request->date_filter == '30 days') {
            $where_filter .= ' AND created_at >= "' . Carbon::now()->subDays(30) . '"';
        } else {
            $where_filter .= '';
        }

        /*(Service type Filter) to search Job*/
        $industry_filter = $request->industry_select;
        if (!is_null($industry_filter)) {
            for ($i = 0; $i < count($industry_filter); $i++) {
                if ($i == 0) {
                    $where_filter .= ' AND( industry_id = "' . $industry_filter[$i] . '"';
                } else {
                    $where_filter .= ' OR industry_id = "' . $industry_filter[$i] . '"';
                }
            }
            $where_filter .= ')';
        }

        /*Job type filter*/
        $jobtype_filter = $request->jobtype_select;
        if (!is_null($jobtype_filter)) {
            for ($i = 0; $i < count($jobtype_filter); $i++) {
                if ($i == 0) {
                    $where_filter .= ' AND( service = "' . $jobtype_filter[$i] . '"';
                } else {
                    $where_filter .= ' OR service = "' . $jobtype_filter[$i] . '"';
                }
            }
            $where_filter .= ')';
        }

        /*Experience filter*/
        $experience_filter = $request->experience_select;
        if (!is_null($experience_filter)) {
            for ($i = 0; $i < count($experience_filter); $i++) {
                if ($i == 0) {
                    $where_filter .= ' AND( required_experience = "' . $experience_filter[$i] . '"';
                } else {
                    $where_filter .= ' OR required_experience = "' . $experience_filter[$i] . '"';
                }
            }
            $where_filter .= ')';
        }

        /*Filters for sorting*/
        if ($request->sel_option == 1)/*(1)By Job Title ASC*/ {
            $order_by_col = 'job_title';
            $order_by_action = 'ASC';
        } elseif ($request->sel_option == 2)/*2 for Company Name*/ {
            $order_by_col = 'company_name';
            $order_by_action = 'ASC';
        } else {
            $order_by_col = 'created_at';/*Best Match*/
            $order_by_action = 'DESC';
        }

        if (is_null($request->job_title) && is_null($request->place)) {
            if ($request->sel_option == 2) {

            } else {
                $find_jobs = user_job::with('Client', 'admin')
                    ->whereRaw($where_filter)
                    ->whereDate('applied_before', '>', Carbon::now())
                    ->where('job_approved', 1)
                    ->orderBy($order_by_col, $order_by_action)
                    ->offset($start)->limit($request->length)
                    ->get();
            }
            $total_jobs = user_job::whereRaw($where_filter)
                ->whereDate('applied_before', '>', Carbon::now())
                ->where('job_approved', 1)->get();
        } elseif (!is_null($request->job_title) && is_null($request->place)) {
            $where = [['job_title', 'LIKE', '%' . $request->job_title . '%']];
        } elseif (!is_null($request->place) && is_null($request->job_title)) {
            $where = [['location', 'LIKE', '%' . $request->place . '%']];
        } else {
            $where = [['job_title', 'LIKE', '%' . $request->job_title . '%'],
                ['location', 'LIKE', '%' . $request->place . '%']];
        }

        if (!is_null($request->job_title) || !is_null($request->place)) {
            if ($request->sel_option == 2) {

            } else {
                $find_jobs = user_job::with('Client', 'industry', 'admin')
                    ->orderBy($order_by_col, $order_by_action)
                    ->where($where)
                    ->whereRaw($where_filter)
                    ->whereDate('applied_before', '>', Carbon::now())->where('job_approved', 1)->offset($start)->limit($request->length)->get();
            }
            $total_jobs = user_job::where($where)->whereDate('applied_before', '>', Carbon::now())
                ->where('job_approved', 1)
                ->whereRaw($where_filter)
                ->get();
        }
        $jobsCountWhere = count($total_jobs);
        /*Count Saved jobs to Show color of saved jobs*/
        $find_saved_job = favourite_job::where('candidate_id', session()->get('candidate_id'))->get();

        $arrayName = array('0' => $jobsCountWhere, '1' => $find_jobs, '2' => $find_saved_job);
        return json_encode($arrayName);
    }

    public function saveFavJob(Request $request)
    {
        if (session()->has('candidate_id')) {
            $candidate_id = session()->get('candidate_id');
            /*Condition to check if record already exists or not*/
            $fav_job = favourite_job::where('candidate_id', $candidate_id)
                ->where('job_id', $request->id)->first();
            if (is_null($fav_job)) {
                /*Save if not record exists*/
                $fav_jobs = new favourite_job();
                $fav_jobs->candidate_id = $candidate_id;
                $fav_jobs->job_id = $request->id;
                $fav_jobs->save();
                return response('saved');
            } else {
                $fav_jobs = favourite_job::where('id', $fav_job->id);
                $fav_jobs->delete();
                return response('deleted');
            }
        } else {
            return response('notloggedin');
        }
    }

    public function companytempRecruitment()
    {
//        $recruitment = recruitment_service::with('industry')
//            ->where('client_id', session('c_email.id'))->get();
//        $client_logo = NewClient::find(session('c_email.id'))->only('logo');
//        return view('user.company_dashboard.new-active-recruitments')->with(compact('recruitment', 'client_logo'));

        return view('user.company_dashboard.new-active-recruitments');
    }

    public function activeRecruitments(Request $request)
    {
        if ($request->current == 1) {
            $start = 0;
        } else {
            $start = ($request->current - 1) * $request->length;
        }
        $recruitments = recruitment_service::with('industry')
            ->where('client_id', session('c_email.id'))
            ->orderBy('id', 'desc')
            ->offset($start)
            ->limit($request->length)
            ->get()
            ->toArray();

        $total = recruitment_service::with('industry')
            ->where('client_id', session('c_email.id'))
            ->orderBy('id', 'desc')
            ->count();

        $arr = [];
        $arrayName = array('0' => '', '1' => $recruitments, '2' => $arr, 'total' => $total);
        return json_encode($arrayName);
    }

    public function companytempRecruitmentDetail($id)
    {
        $recruitment = recruitment_service::with('industry', 'education')->where('client_id', session('c_email.id'))->where('id', $id)->first();
//        return view('user.company_dashboard.recruitment_details')->with(compact('recruitment'));
        return view('user.company_dashboard.new-recruitment-details')->with(compact('recruitment'));
    }

    public function companyRecruitmentDetaildelete(Request $request)
    {
        $recruitment = recruitment_service::where('id', $request->id);
        $recruitment->delete();
        return response('deleted');;
    }

    public function AjaxJobDetails(Request $request)
    {
        $job = user_job::with('Client', 'admin', 'industry', 'education')->where('id', $request->id)->first();
        $candidate = '';;
        $candidate_resumes = '';
        $job_check = '';
        $candidate_fav_job = '';
        if (session()->has('candidate_id')) {
            $job_check = Applied_Jobs::where('job_id', $request->id)->where('candidate_id', session()->get('candidate_id'))->first();
            $candidate = NewCandidate::where('id', session()->get('candidate_id'))->first();
            $candidate_resumes = candidate_resume::where([['candidate_id', session()->get('candidate_id')], ['status', 1]])->get();
            $candidate_fav_job = favourite_job::where('candidate_id', session()->get('candidate_id'))->get();
        }
        $arrayName = array('0' => $job, '1' => $candidate, '2' => $candidate_resumes, '3' => $job_check, '4' => $candidate_fav_job);

        return json_encode($arrayName);
    }

    public function jobDetails($id)
    {
        $job = user_job::with('Client', 'industry', 'education', 'admin')->where('id', $id)->first();
        $candidate = '';;
        $candidate_resumes = '';
        $job_check = '';
        $fav_check = '';
        if (session()->has('candidate_id')) {
            $job_check = Applied_Jobs::where('job_id', $id)->where('candidate_id', session()->get('candidate_id'))->first();
            $fav_check = favourite_job::where('job_id', $id)->where('candidate_id', session()->get('candidate_id'))->first();
            $candidate = NewCandidate::where('id', session()->get('candidate_id'))->first();
            $candidate_resumes = candidate_resume::where([['candidate_id', session()->get('candidate_id')], ['status', 1]])->get();
        }
        return view('user.job-details')->with(compact('job', 'candidate', 'candidate_resumes', 'job_check', 'fav_check'));
    }

    public function jobApply(Request $request)
    {
        if (session()->has('candidate_id')) {
            $request->validate([
//                'location' => 'required|regex:/^[a-zA-Z,.\s]*$/|min:2|max:255',
                'location' => 'required',
                'full_name' => 'required|regex:/^[a-zA-Z ]+$/u|max:255',
                'phone_no' => 'required|regex:/^[0-9\-\(\)\s]+$/|min:14|max:14',
                'email' => 'required|email',
                'resume' => 'nullable|mimes:doc,docx,pdf',
            ], [
                'resume.required' => 'Resume is Required',
            ]);

            /*check if user already applied to job or not*/
            $job_check = Applied_Jobs::where('job_id', $request->id)
                ->where('candidate_id', session()->get('candidate_id'))
                ->first();
            $job_chk_last_date = user_job::with('client', 'admin')->where('id', $request->id)->first();
            $job_last_date = Date('Y-m-d', strtotime($job_chk_last_date->applied_before));
            $candidate = NewCandidate::where('id', session()->get('candidate_id'))->first();
            $curr_date = Date('Y-m-d');

            if (!is_null($job_check)) {
                return back()->with('already_applied', 'Already applied to this job.');
            } elseif ($curr_date > $job_last_date) {
                return back()->with('last_date', 'Cannot apply to Job after Last Date.');
            } else {
                $resume_path = '';
                if ($request->resume != '') {
                    $chk_resume = candidate_resume::where('candidate_id', session()->get('candidate_id'))->first();
//                    if ($chk_resume == '') {
//                        $resume = new candidate_resume();
                    $canidate_resume = $request->file('resume');
                    $curr_date = date('Y_m_d-H-i-s');
                    $name = $canidate_resume->getClientOriginalName();
                    $filename = pathinfo($name, PATHINFO_FILENAME);
                    $extension = pathinfo($name, PATHINFO_EXTENSION);
                    $resume_name = $filename . '-' . $curr_date . '.' . $extension;
                    $path = public_path('/files');
                    $canidate_resume->move($path, $resume_name);
                    $resume_dest_path = $resume_name;
                    $chk_resume->resume = $resume_dest_path;
                    $chk_resume->status = 1;
//                        $resume->candidate_id = session()->get('candidate_id');
                    $chk_resume->save();
                    $resume_path = $resume_dest_path;
//                    } else {
//                        return back()->with('resume_err', 'Only one Resume is allowed.');
//                    }
                }
                $resume = candidate_resume::where('candidate_id', session()->get('candidate_id'))->first();
                $job_apply = new Applied_Jobs();
                $job_apply->job_id = $request->id;
                $job_apply->candidate_id = session()->get('candidate_id');
                $job_apply->resume_id = $resume->id;
                $job_apply->name = $request->full_name;
                $job_apply->location = $request->location;
                $job_apply->phone = $request->phone_no;
                $job_apply->save();

                $details['job_title'] = $job_chk_last_date->job_title;
                $details['job_location'] = $job_chk_last_date->location;
                if ($job_chk_last_date['client']) {
                    $details['company_name'] = $job_chk_last_date['client']['company_name'];
                    $candidateDetails['company_name'] = $job_chk_last_date['client']['company_name'];
                } else {
                    $details['company_name'] = "MyMotivz";
                    $candidateDetails['company_name'] = "MyMotivz";
                }
                $candidateDetails['job_title'] = $job_chk_last_date->job_title;
                $candidateDetails['candidate_name'] = $candidate->name;
                $candidateDetails['location'] = $candidate->location;
                $candidateDetails['experience'] = $candidate->experience;
                $candidateDetails['resume'] = $resume->resume;
                $email = new JobApplySuccessMail($details);
                $companyMail = new CompanyReceiveNewCandidateMail($candidateDetails);
                Mail::to($request->email)->send($email);
                if ($job_chk_last_date['client']) {
                    Mail::to($job_chk_last_date['client']['email'])->send($companyMail);
                } else {
                    Mail::to($job_chk_last_date['admin']['email'])->send($companyMail);
                }

                return back()->with('success', 'Successfully Applied to the Job');
            }
        } else {
            $request->validate([
//                'city' => 'required|regex:/^[a-zA-Z ]+$/u|max:255',
//                'location' => 'required|regex:/^[a-zA-Z,.\s]*$/|min:2|max:255',
                'location' => 'required',
                'full_name' => 'required|regex:/^[a-zA-Z ]+$/u|max:255',
                'phone_no' => 'required|regex:/^[0-9\-\(\)\s]+$/|min:14|max:14',
                'email' => 'required|email',
                'resume' => 'nullable|mimes:doc,docx,pdf',
            ], [
                'resume.required' => 'Resume is Required',
            ]);

            $password = Hash::make($request->password);
            $candidate_chk = NewCandidate::where('email', $request->email)->first();

            if (is_null($candidate_chk)) {
                $code['code'] = Str::random(5);
                $code['stringRand'] = Str::random(20);
                $code['user'] = "as a Job Seeker";

                $candidate = new NewCandidate();
                $candidate->email = $request->email;
                $candidate->location = $request->location;
                $candidate->code = $code['code'];
                $candidate->random_code = $code['stringRand'];
                $candidate->save();


                $email = new SendRegistrationCode($code);
                Mail::to($request->email)->send($email);

                $candidate_id = $candidate->id;

                $resume = new candidate_resume();
                $canidate_resume = $request->file('resume');
                $curr_date = date('Y_m_d-H-i-s');
                $name = $canidate_resume->getClientOriginalName();
                $filename = pathinfo($name, PATHINFO_FILENAME);
                $extension = pathinfo($name, PATHINFO_EXTENSION);
                $resume_name = $filename . '-' . $curr_date . '.' . $extension;
                $path = public_path('/files');
                $canidate_resume->move($path, $resume_name);
                $resume_dest_path = $resume_name;
                $resume->resume = $resume_dest_path;
                $resume->status = 1;
                $resume->candidate_id = $candidate_id;
                $resume->save();

                $job_apply = new Applied_Jobs();
                $job_apply->job_id = $request->id;
                $job_apply->candidate_id = $candidate_id;
                $job_apply->resume_id = $resume->id;
                $job_apply->name = $request->full_name;
//                $job_apply->city = $request->city;
                $job_apply->location = $request->location;
                $job_apply->phone = $request->phone_no;
                $job_apply->save();

                return redirect()->route('user.login')->with('verify', 'A verification link has been sent to your email. Please verify your account in order to process your job application');
            } else {
                $candidate_chk_code = $candidate_chk->code;
                if (is_null($candidate_chk_code)) {
                    return redirect()->route('user.login')->with('non_verify', 'A verification link has been sent to your email. Please verify your account fist and then apply for Job.');
                } else {
                    return redirect()->route('user.login')->with('email_exists', 'Your account already exists. Please login first and then apply for Job.');
                }
            }

        }

    }

    public function viewCareerDevelopment()
    {
        $Education = Education::all();
        $industries = Industry::all();
//        $Candidate = NewCandidate::where('id', session()->get('candidate_id'))->first();
        return view('user.career_development')->with(compact('Education', 'industries'));
    }

    public function jobNotify(Request $request)
    {
        $request->validate(
            [
                'full_name' => 'required|regex:/^[a-zA-Z ]+$/u|max:255',
                'job_title' => ['required', 'min:2', 'max:255', new AlphaNumericSpace()],
                'phone_no' => 'required|regex:/^[0-9\-\(\)\s]+$/|min:14|max:14',
                'email' => 'required|email|max:255',
//                'location' => 'required|regex:/^[a-zA-Z,.\s]*$/|min:2|max:255',
                'location' => 'required',
                'package' => ['required', 'min:1', 'max:20', new CurrencyValidation()],
                'package_to' => ['nullable', 'min:1', 'max:20', new CurrencyValidation()],
                'sel_education' => 'required|not_in:0',
                'industry' => 'required',
                'sel_job_type' => 'required|not_in:0',
                'description' => 'required|max:500',
            ],
            [
                'full_name.required' => 'FullName is required',
                'full_name.regex' => 'FullName only contain alphabets',
                'full_name.max' => 'FullName must be less than 255 characters',
                'job_title.required' => 'Job title is required',
                'job_title.regex' => 'Job Title only contain alphabets',
                'job_title.max' => 'Job title must be less than 255 characters long',
                'phone_no.required' => 'Phone No is required',
                'phone_no.regex' => 'Phone number must be in digits form',
                'phone_no.min' => 'Phone number must be equal to 14 digits',
                'phone_no.max' => 'Phone number must be equal to 14 digits',
                'email.required' => 'Email is required',
                'email.email' => 'Email must be valid',
                'email.max' => 'Email must be less than 255 characters',
                'sel_education.required' => 'Education is Required',
                'sel_education.not-in' => 'Select Education Type',
                'industry.required' => 'Industry is required',
                'sel_job_type.required' => 'Job type is required',
                'sel_job_type.not-in' => 'Kindly select Job Type',
                'description.required' => 'Description is required',
                'description.max' => 'Description must be less than 500 characters'

            ]);
//        dd($request);
        $job_notify = new career_job_notify();
        $job_notify->name = $request->full_name;
        $job_notify->email = $request->email;
        $job_notify->phone = $request->phone_no;
        $job_notify->location = $request->location;
        $job_notify->industry_id = $request->get('industry');
        $job_notify->job_title = $request->job_title;
        $job_notify->salary_sign = $request->hidd_curr_sign;
        $job_notify->salary = $request->package;
        $job_notify->salary_to = $request->package_to;
        $job_notify->salary_type = $request->salary_duration;
        $job_notify->job_type = $request->sel_job_type;
        $job_notify->education_id = $request->get('sel_education');
        $job_notify->description = $request->description;
        $job_notify->save();
        return back()->with('success', 'Thank you for submitting your profile. We will reach out should there be a match based on your job requirements.');
    }

    public function UploadResume(Request $request)
    {
        $request->validate([
            'resume' => 'required|mimes:docx,pdf',
        ],
            [
                'resume.required' => 'Resume is required',
                'resume.mimes' => 'Only PDF and Docx file types are allowed',
            ]);
        $resume = new candidate_resume();
        $canidate_resume = $request->file('resume');
        $curr_date = date('Y_m_d-H-i-s');
        $name = $canidate_resume->getClientOriginalName();
        $filename = pathinfo($name, PATHINFO_FILENAME);
        $extension = pathinfo($name, PATHINFO_EXTENSION);
        $resume_name = $filename . '-' . $curr_date . '.' . $extension;
        $path = public_path('/files');
        $canidate_resume->move($path, $resume_name);
        $resume_dest_path = $resume_name;
        $resume->resume = $resume_dest_path;
        $resume->candidate_id = session()->get('candidate_id');
        $resume->save();
        return back()->with('success', 'Resume Uploaded Successfully');
    }

    public function mainSearchJob(Request $request)
    {
//        dd($request->all());
        session()->put('search_job_title', trim($request->search_job_title));
        session()->put('search_location', trim($request->search_place));
//        return redirect('/find/jobs');
        return redirect()->route('user.find.jobs');
    }

//    Changes in company backend
    public function companyeditDashboard()
    {
//        dd('company edit');
        $client = NewClient::where('id', session('c_email.id'))->first();
        $industries = Industry::all();
        $countries = Country::all();
        if (!is_null($client->country_id)) {
            $states = State::where('country_id', $client->country_id)->get();
        } else {
            $states = '';
        }
        session(['company_name' => $client->company_name]);
//        dd($client);
//        return view('user.company_dashboard.company_profile', compact('client','industries','countries','states'));
        return view('user.company_dashboard.new-company-edit-profile', compact('client', 'industries', 'countries', 'states'));
    }

    public function companyDashboard()
    {
        $client = NewClient::with('industry', 'country', 'state')->where('id', session('c_email.id'))->first();
        $active_jobs = user_job::where('client_id', $client->id)->where('job_approved', 1)->whereDate('applied_before', '>', Carbon::now())->count();
        $new_applicants = 0;
        $active_jobs1 = user_job::where('client_id', $client->id)->where('job_approved', 1)->whereDate('applied_before', '>', Carbon::now())->get();

//        dd($active_jobs1);
        foreach ($active_jobs1 as $active_job) {
            $new_applicants += Applied_Jobs::where(['job_id' => $active_job->id, 'is_new' => 1])->count();
//            $new_applicants += Applied_Jobs::where('job_id', $active_job->id)->count();
        }
        $expired = user_job::where('client_id', $client->id)->whereDate('applied_before', '<=', Carbon::now())->count();
        $recruit = recruitment_service::with('industry')->where('client_id', $client->id)->count();
        session(['company_name' => $client->company_name]);
        return view('user.company_dashboard.company-new-dashboard', compact('client', 'active_jobs', 'expired', 'recruit', 'new_applicants'));
    }

    public function companyProfile()
    {

        $client = NewClient::with('industry', 'country', 'state')->where('id', session('c_email.id'))->first();
//        dd($client);
//        return view('user.company_dashboard.edit_company_profile', compact('client'));
        session(['company_name' => $client->company_name]);
        return view('user.company_dashboard.new-company-profile', compact('client'));
    }

    public function submitCompnayProfile(Request $request)
    {

        $request->validate([
            'company_name' => ['required', 'min:1', 'max:255'],
//            'company_name' => ['required', new AlphaNumericSpace(), 'min:1', 'max:255'],
            'name' => ['required', new AlphaSpace(), 'min:1', 'max:255'],
            'address' => 'required|max:255',
//            'country' => 'required',
//            'city' => 'required|regex:/^[a-zA-Z,.\s]*$/|min:2|max:255',
//           'state' => 'required',
            'complete_address' => [new ValidLocation()],
            'zip_code' => 'required|regex:/^[0-9]*$/|min:2|max:255',
            'job_title' => ['required', 'min:2', 'max:255', new AlphaNumericSpace()],
            'phone' => ['required', 'min:14', 'max:14', new PhoneNumber()],
            'web_url' => ['required', new ValidUrl()],
            'industry' => 'required',
//            'job_discription' => 'max:500',
//            'job_discription' => 'required|max:500',
        ], [
            'company_name.required' => 'Company Name is required',
            'company_name.regex' => 'Only alphabets are allowed in company name',
            'company_name.min' => 'Company Name must be greater than 1 characters',
            'company_name.max' => 'Company name must be less than 255 characters',
            'name.required' => ' Name is required',
            'name.regex' => 'Only Alphabets are allowed in  Name',
            'name.min' => ' Name must be greater than 1 characters',
            'name.max' => ' Name must be less than 255 characters',
            'job_title.required' => 'Job title is required',
            'job_title.regex' => 'Only Alphabets are allowed in Job Title',
            'job_title.min' => 'Job Title must be greater than 1 characters',
            'job_title.max' => 'Job Title must be less than 255 characters',
            'phone.required' => 'Phone is required',
            'phone.regex' => 'Phone number must be in valid format',
            'phone.min' => 'Phone number must be equal to 14 digits',
            'phone.max' => 'Phone number must be equal to 14 digits',
            'web_url.required' => 'Web URL is required',
//            'web_url.url' => 'URL must be valid',
            'industry.required' => 'Industry is required',
//            'job_discription.required' => 'Job Description is required',
//            'job_discription.max' => 'Job Description must be less than 500 characters',
        ]);

        NewClient::where('id', $request->company_id)->update([
            'company_name' => $request->company_name,
            'name' => $request->name,
            'job_title' => $request->job_title,
            'phone' => $request->phone,
            'address' => $request->address,
            'country_id' => $request->country,
            'city' => $request->city,
            'state_id' => $request->state,
            'zip_code' => $request->zip_code,
            'web_url' => $request->web_url,
            'industry_id' => $request->get('industry'),
            'job_discription' => $request->job_discription,
            'complete_address' => $request->complete_address

        ]);

        $company = NewClient::where('id', session()->get('c_email.id'))->first();
        if ($request->company_logo != null) {

            if ($company->logo != '') {
                $img_path = public_path('/user/company_logo/' . $company->logo);
                unlink($img_path);
//                dd('inside if');
            }
//            dd('inside else');
            $company_img = $request->file('company_logo');
            $name = $company_img->getClientOriginalName();
            $curr_date = date('Y_m_d-H-i-s');
            $filename = pathinfo($name, PATHINFO_FILENAME);
            $extension = pathinfo($name, PATHINFO_EXTENSION);
            $image_name = $filename . '-' . $curr_date . '.' . $extension;
            $path = public_path('/user/company_logo');
            $company_img->move($path, $image_name);
            $company->logo = $image_name;
        }

        $company->save();


        session(['c_email.name' => $request->name]);
        session(['c_email.logo' => $company->logo]);
        return redirect()->back()->with('success', "Profile updated successfully");
    }

    public function companyLogoUpload(Request $request)
    {

        $request->validate([
            'company_logo' => 'required|mimes:jpg,jpeg,png,gif',
        ], [
            'company_logo.required' => 'Image is Required.',
            'company_logo.mimes' => 'Only jpg,jpeg,png,gif Image Formats are allowed.'
        ]);
        $company = NewClient::where('id', session()->get('c_email.id'))->first();
        if ($company->logo != '') {
            $img_path = public_path('/user/company_logo/' . $company->logo);
            unlink($img_path);
        }
        $company_img = $request->file('company_logo');
        $name = $company_img->getClientOriginalName();
        $curr_date = date('Y_m_d-H-i-s');
        $filename = pathinfo($name, PATHINFO_FILENAME);
        $extension = pathinfo($name, PATHINFO_EXTENSION);
        $image_name = $filename . '-' . $curr_date . '.' . $extension;
        $path = public_path('/user/company_logo');
        $company_img->move($path, $image_name);
        $company->logo = $image_name;
        $query = $company->save();

        if ($query) {
            $company_img = NewClient::where('id', session()->get('c_email.id'))->first();
            $company_logo = $company_img->logo;
            //update in session to change for all views
            session(['c_email.logo' => $company_logo]);
            return json_encode(['success' => $company_logo]);
        } else {
            return json_encode('error');
        }

    }

    public function postJob()
    {
        $industries = Industry::all();
        $Education = Education::all();
//        return view('user.company_dashboard.post_job')->with(compact('industries','Education'));
        return view('user.company_dashboard.new-post-job')->with(compact('industries', 'Education'));
    }

    public function createJob()
    {
        $industries = Industry::all();
        $Education = Education::all();
//        return view('user.company_dashboard.create_recruitment')->with(compact('industries','Education'));
        return view('user.company_dashboard.new-recruiting-services')->with(compact('industries', 'Education'));
    }

    public function clean($str)
    {
        $str = utf8_decode($str);
        $str = str_replace("&nbsp;", " ", $str);
        $str = preg_replace('/\s+/', ' ', $str);
        $str = trim($str);
        return $str;
    }

    public function submitJob(JobDetailRequest $request)
    {
        $description = $this->clean($request->job_discription);
        $job = user_job::create([
            'client_id' => $request->company_name,
            'job_title' => $request->jobtitle,
            'package_sign' => $request->hidd_curr_sign,
            'package' => $request->package,
            'package_to' => $request->package_to,
            'package_type' => $request->salary_duration,
            'education_id' => $request->education,
            'location' => $request->location,
            'web_url' => $request->web_url,
            'industry_id' => $request->industry,
            'job_description' => $description,
            'job_opening' => $request->num_hires,
            'job_benefits' => $request->job_benefits,
            'required_skills' => $request->required_skills,
            'certifications' => $request->required_certification,
            'required_experience' => $request->required_experience,
            'service' => $request->service,
            'applied_before' => $request->applied_before,
            'job_approved' => 0,
            'posted_at' => Carbon::now(),
        ]);

        return redirect()->back()->with('success', 'Job Created Successfully');
    }

    public function submitRecruitmentService(Request $request)
    {
        $request->validate([
            'jobtitle' => ['required', 'min:2', 'max:255', new AlphaNumericSpace()],
            'education' => 'required',
//            'location' => 'required|regex:/^[a-zA-Z,.\s]*$/|min:2|max:255',
            'location' => 'required',
//            'web_url' => 'required|url',
            'web_url' => ['required', new ValidUrl()],
            'package' => ['required', 'min:1', 'max:20', new CurrencyValidation()],
            'package_to' => ['nullable', 'min:1', 'max:20', new CurrencyValidation()],
            'salary_duration' => 'required',
            'industry' => 'required',
            'service' => 'required',
//            'job_discription' => 'required|max:500',
            'job_discription' => 'required',
            'document' => 'nullable|mimes:doc,docx,pdf',
        ]);
        if ($request->document != '') {
            $recruitment_doc = $request->file('document');
            $curr_date = date('Y_m_d-H-i-s');
            $name = $recruitment_doc->getClientOriginalName();
            $filename = pathinfo($name, PATHINFO_FILENAME);
            $extension = pathinfo($name, PATHINFO_EXTENSION);
            $doc_name = $filename . '-' . $curr_date . '.' . $extension;
            $path = public_path('/uploads/Recruitment_Services_Files');
            $recruitment_doc->move($path, $doc_name);
            $doc_dest_path = $doc_name;
            $job_desc = $doc_dest_path;
        } else {
            $job_desc = '';
        }
        $recruitment_service = recruitment_service::create([
            'client_id' => session('c_email.id'),
            'job_title' => $request->jobtitle,
            'education_id' => $request->education,
            'location' => $request->location,
            'web_url' => $request->web_url,
            'salary_sign' => $request->hidd_curr_sign,
            'salary' => $request->package,
            'salary_to' => $request->package_to,
            'salary_type' => $request->salary_duration,
            'service' => $request->service,
            'industry_id' => $request->industry,
            'job_desc' => $request->job_discription,
            'document' => $job_desc,
        ]);

        return redirect()->back()->with('success', 'Request Created Successfully');
    }

    public function viewactiveJobs()
    {
        return view('user.company_dashboard.new-active-jobs');
    }

    public function activeJobs(Request $request)
    {
        if ($request->current == 1) {
            $start = 0;
        } else {
            $start = ($request->current - 1) * $request->length;
        }
        $jobs = user_job::with('client')
            ->where('client_id', session('c_email.id'))
            ->where('job_approved', 1)
            ->whereDate('applied_before', '>', Carbon::now())
            ->orderBy('id', 'desc')
            ->offset($start)
            ->limit($request->length)
            ->get()
            ->toArray();
        $total = user_job::with('client')
            ->where('client_id', session('c_email.id'))
//            ->where('job_approved', 1)
            ->whereDate('applied_before', '>', Carbon::now())
            ->orderBy('id', 'desc')
//            ->offset($start)
//            ->limit($request->length)
            ->count();
        $arr = [];

        foreach ($jobs as $job) {
//            $count = Applied_Jobs::where(['job_id' => $job['id']])->count();
            $count = Applied_Jobs::where(['job_id' => $job['id'], 'is_new' => 1])->count();
            array_push($arr, $count);
        }


        $arrayName = array('0' => '', '1' => $jobs, '2' => $arr, 'total' => $total);
        return json_encode($arrayName);
        //        return view('user.company_dashboard.active_jobs' , compact('jobs'));
    }

    public function viewPendingJobs()
    {
        return view('user.company_dashboard.pending-jobs');
    }

    public function pendingJobs(Request $request)
    {
        if ($request->current == 1) {
            $start = 0;
        } else {
            $start = ($request->current - 1) * $request->length;
        }
        $jobs = user_job::with('client', 'industry')
            ->where('client_id', session('c_email.id'))
            ->where('job_approved', 0)
            ->whereDate('applied_before', '>', Carbon::now())
            ->orderBy('id', 'desc')
            ->offset($start)
            ->limit($request->length)
            ->get()
            ->toArray();
        $total = user_job::with('client', 'industry')
            ->where('client_id', session('c_email.id'))
            ->where('job_approved', 0)
            ->whereDate('applied_before', '>', Carbon::now())
            ->orderBy('id', 'desc')
            ->count();

        $arrayName = array('0' => '', '1' => $jobs, 'total' => $total);
        return json_encode($arrayName);
    }

    public function viewRejectedJobs()
    {
        return view('user.company_dashboard.rejected-jobs');
    }

    public function rejectedJobs(Request $request)
    {
        if ($request->current == 1) {
            $start = 0;
        } else {
            $start = ($request->current - 1) * $request->length;
        }
        $jobs = user_job::with('client', 'industry')
            ->where('client_id', session('c_email.id'))
            ->where('job_approved', 2)
            ->whereDate('applied_before', '>', Carbon::now())
            ->orderBy('id', 'desc')
            ->offset($start)
            ->limit($request->length)
            ->get()
            ->toArray();
        $total = user_job::with('client', 'industry')
            ->where('client_id', session('c_email.id'))
            ->where('job_approved', 2)
            ->whereDate('applied_before', '>', Carbon::now())
            ->orderBy('id', 'desc')
            ->count();
        $arrayName = array('0' => '', '1' => $jobs, 'total' => $total);
        return json_encode($arrayName);
    }

    public function viewJobCandidates($job_id)
    {
        $job = DB::table('user_jobs')->where('id', $job_id)->get(['job_title']);
        $job_title = $job[0]->job_title;
        return view('user.company_dashboard.job_candidates', compact('job_id', 'job_title'));
    }

    public function getJobCandidates(Request $request)
    {
        if ($request->current == 1) {
            $start = 0;
        } else {
            $start = ($request->current - 1) * $request->length;
        }

        $jobs = Applied_Jobs::with('job:id,job_title', 'candidate', 'candidate.education')
            ->where('job_id', $request->job_id);
        $jobs_total = $jobs->count();

        $filtered_jobs = $jobs->offset($start)
            ->orderBy('id', 'desc')
            ->limit($request->length)
            ->get()
            ->toArray();
        $arr = [];

        foreach ($jobs as $job) {
//            $count = Applied_Jobs::where(['job_id' => $job['id']])->count();
            $count = Applied_Jobs::where(['job_id' => $job['id'], 'is_new' => 1])->count();
            array_push($arr, $count);
        }
        $arrayName = array('0' => '', '1' => $filtered_jobs, '2' => $arr, '3' => $jobs_total);
        return json_encode($arrayName);
    }

    public function jobViewDetails($id)
    {
        $job = user_job::findOrFail($id);
        $candidates_applied = Applied_Jobs::with('candidate', 'candidate.education')
            ->where('job_id', $id)
            ->orderBy('id', 'desc')
            ->get();
//        Applied_Jobs::where(['is_new' => 1, 'job_id' => $id])->update(['is_new' => 0]);
        return view('user.company_dashboard.job_details', compact('job', 'candidates_applied'));
    }

    public function userDelJob(Request $request)
    {
        $job = user_job::where('id', $request->id);
        $fav_jobs = favourite_job::where('job_id', $request->id)->get();
        $applied_jobs = Applied_Jobs::where('job_id', $request->id)->get();
        $status = "error";
        foreach ($fav_jobs as $fav_job) {
            $fav_job->delete();
        }
        foreach ($applied_jobs as $applied_job) {
            $applied_job->delete();
        }
        if ($job->delete()) {
            $status = 'deleted';
        }
        return response($status);
    }


    public function viewExpiredJobs()
    {
//        $jobs = user_job::with('client')->where('client_id' , session('c_email.id'))->orderBy('applied_before','desc')->whereDate('applied_before','<=',Carbon::now())->simplePaginate(5) ;
//        return view('user.company_dashboard.expired_jobs');
        return view('user.company_dashboard.new-inactive-jobs');
    }

    public function expiredJobs(Request $request)
    {
        if ($request->current == 1) {
            $start = 0;
        } else {
            $start = ($request->current - 1) * $request->length;
        }

        $jobs = user_job::with('client', 'industry')
            ->where('client_id', session('c_email.id'))
            ->whereDate('applied_before', '<', Carbon::now());
        $total = $jobs->count();
        $expired_jobs =
            $jobs->orderBy('applied_before', 'desc')
                ->offset($start)
                ->limit($request->length)
                ->get()
                ->toArray();
        $arrayName = array('0' => '', '1' => $expired_jobs, '2' => $total);
        return json_encode($arrayName);
    }

    public function changePasswordClient()
    {

//        return view('user.company_dashboard.change_password');
        return view('user.company_dashboard.new-change-password');
    }

    public function submitChangePasswordClient(Request $request)
    {


        $request->validate([
            'password' => 'required',
            'new_password' => 'required|min:6|max:20|regex:/^(?=.*[0-9])(?=.*[A-Z])(?=.*\d).+$/',
            'confirm_password' => 'required|same:new_password',
        ], [
            'password.required' => 'Old Password is Required',
            'new_password.required' => 'New Password is Required',
            'new_password.min' => 'New Password should be minimum 6 characters long',
            'new_password.max' => 'New Password should be maximum 20 characters long',
            'new_password.regex' => 'New Password must contain at least 1 number 1 uppercase and 1 Special Character',
            'confirm_password.required' => 'Confirm Password is Required',
            'confirm_password.same' => 'Confirm Password must be same as New Password',
        ]);
//        dd($request->all());
        $client = NewClient::findOrFail(session('c_email.id'));
        if (Hash::check($request->password, $client->password)) {
            $client->password = Hash::make($request->new_password);
//            dd('match password');
            $client->save();
        } else {
//            dd('password did not match');
            return redirect()->back()->with('danger', 'Current Password Doesn\'t Match');
        }
        return redirect()->back()->with('success', 'Password Changed');
    }

    public function resubmit(Request $request)
    {

        $request->validate([
            'date' => "required|after:today",
        ], [
            'date.required' => 'Date is Required',
            'date.after' => 'Date must be after today\'s Date',
        ]);
//        dd($request->input('job_id'));
        $client = NewClient::find(session('c_email.id'));
        $job = $client->user_jobs->find($request->job_id);
        $job->applied_before = $request->date;
        $job->posted_at = Carbon::now();
        $job->save();

        return redirect()->back()->with('success', 'Resubmitted Successfully');
    }

    public function candidateDetails($cand, $jobID)
    {
        $id = Crypt::decrypt($cand);
        $job_id = Crypt::decrypt($jobID);

//        $client=NewClient::find(session('c_email.id'));
//        $jobIds=$client->user_jobs->pluck('id');
//        $candidate=user_job::with('candidates')->whereIn('id',$jobIds)->simplePaginate()->pluck('candidates')->collapse()->where('id',$id)->first();

        $candidate = NewCandidate::with('industry', 'education')->where('id', $id)->first();
        $cand_apply_job = Applied_Jobs::where('candidate_id', $id)->where('job_id', $job_id)->first();
        $cand_apply_job->is_new = 0;
        $cand_apply_job->save();
        $cand_resume_id = $cand_apply_job->resume_id;
        $cand_resume = candidate_resume::where([['id', $cand_resume_id], ['status', 1]])->first();
        if (empty($candidate)) {
            abort(404, "Candidate Not Found!");
        }
        return view('user.company_dashboard.candidate-details', compact('candidate', 'cand_apply_job', 'cand_resume'));

    }

    public function editJobDetails($id)
    {
        $client = NewClient::find(session('c_email.id'));
        $job = $client->user_jobs->find($id);
        $job = user_job::with('industry', 'education')->where('id', $id)->where('client_id', session('c_email.id'))->first();
        $Education = Education::all();
        $industries = Industry::all();
//        return view('user.company_dashboard.edit_job_details',compact('job','Education','industries'));
        return view('user.company_dashboard.new-edit-job', compact('job', 'Education', 'industries'));

    }

    public function submitEditJobDetails(JobDetailRequest $request, $id)
    {
//        $str = explode('<', $request->job_discription);
//        if(strpos($request->job_discription, 'href') !== false){
//            echo "Word Found!";
//        } else{
//            echo "Word Not Found!";
//        }
//
//        dd($str);
//        dd($request->job_discription);

        $user = NewClient::find(session('c_email.id'));
        $job = $user->user_jobs->find($id);

        $description = $this->clean($request->job_discription);


        $job->job_title = $request->jobtitle;
        $job->package_sign = $request->hidd_curr_sign;
        $job->package = $request->package;
        $job->package_to = $request->package_to;
        $job->package_type = $request->salary_duration;
        $job->education_id = $request->education;
        $job->location = $request->location;
        $job->web_url = $request->web_url;
        $job->industry_id = $request->industry;
        $job->job_description = $description;
        $job->job_benefits = $request->job_benefits;
        $job->required_skills = $request->required_skills;
        $job->required_experience = $request->required_experience;
        $job->service = $request->service;
        $job->applied_before = $request->applied_before;
        $job->certifications = $request->required_certification;
        $job->save();

        return redirect()->back()->with('success', 'Job details updated successfully');
    }

    public function deleteCompanyAccount()
    {
        $user = NewClient::find(session('c_email.id'));
        $user->delete();
        session()->flush();
        return redirect()->route('user.login')->with('account_del', 'Your Account deleted successfully.');
    }
//    public function downloadResume($id){
//        $resume = candidate_resume::where('id',$id)->first();
////        dd($resume);
//        $path=public_path('files/'.$resume->resume);
//        return Response::download($path);
//    }
    /*New Update Candidate Functions 15/01/2021*/
    public function viewPersonalDetails()
    {
        $Education = Education::all();
        $industries = Industry::all();
        $Candidate = NewCandidate::where('id', session()->get('candidate_id'))->first();
//        dd($Candidate->toArray());
        $candidate_resume = candidate_resume::where('candidate_id', session()->get('candidate_id'))->get();
        return view('user.profile-details')->with(compact('Education', 'Candidate', 'candidate_resume', 'industries'));
    }

    public function savePersonalDetails(Request $request)
    {
        $request->validate(
            [
                'full_name' => ['required', new AlphaSpace(), 'max:255', 'min:3'],
                'phone_no' => ['required', new PhoneNumber(), 'min:14', 'max:14'],
                'email' => ['required', 'email'],
                'linkedin_url' => ['nullable', new ValidUrl()],
                'location' => ['required', 'max:255', new ValidLocation()],
                'auth_status' => 'required',
                'resume' => 'mimes:doc,docx,pdf',
            ]);

        if ($request->hasFile('resume')) {
            $chk_resume = candidate_resume::where('candidate_id', session()->get('candidate_id'))->first();
            if (empty($chk_resume)) {
                $resume = new candidate_resume();
                $canidate_resume = $request->file('resume');
                $curr_date = date('Y_m_d-H-i-s');
                $name = $canidate_resume->getClientOriginalName();
                $filename = pathinfo($name, PATHINFO_FILENAME);
                $extension = pathinfo($name, PATHINFO_EXTENSION);
                $resume_name = $filename . '-' . $curr_date . '.' . $extension;
                $path = public_path('/files');
                $canidate_resume->move($path, $resume_name);
                $resume_dest_path = $resume_name;
                $resume->resume = $resume_dest_path;
                $resume->candidate_id = session()->get('candidate_id');
                $resume->status = 1;
                $resume->save();
            } else {
                return back()->with('resume_err', 'Only one resume is allowed.');
            }
        }

        $candidate = NewCandidate::where('id', session()->get('candidate_id'))->first();
        $candidate->name = $request->full_name;
        $candidate->phone = $request->phone_no;
        $candidate->location = $request->location;
        $candidate->linkedin_url = $request->linkedin_url;
        $candidate->auth_status = $request->auth_status;
        $candidate->save();

//        dd($candidate);

        return redirect()->route('candidate.view.personal.job.details');
    }

    public function viewPersonalJobDetails()
    {
        $Education = Education::all();
        $industries = Industry::all();
        $Candidate = NewCandidate::where('id', session()->get('candidate_id'))->first();
        $candidate_resume = candidate_resume::where('candidate_id', session()->get('candidate_id'))->get();
        return view('user.profile-job-details')->with(compact('Education', 'Candidate', 'candidate_resume', 'industries'));
    }

    public function savePersonalJobDetails(Request $request)
    {
//        dd($request->all());
        $request->validate(
            [
                'sel_job_type' => 'required',
                'industry' => 'required|exists:industries,id',
                'job_title' => ['required', 'min:2', 'max:255'],
                'sel_experience' => 'required',
            ]);
        $candidate = NewCandidate::where('id', session()->get('candidate_id'))->first();
        $candidate->job_type = $request->sel_job_type;
        $candidate->industry_id = $request->industry;
        $candidate->job_title = $request->job_title;
        $candidate->experience = $request->sel_experience;
        $candidate->save();
        return redirect()->route('candidate.view.skills.details');
    }

    public function viewSkillsDetails()
    {
        $Education = Education::all();
        $industries = Industry::all();
        $Candidate = NewCandidate::where('id', session()->get('candidate_id'))->first();
        $candidate_resume = candidate_resume::where('candidate_id', session()->get('candidate_id'))->get();
        return view('user.profile-skills')->with(compact('Education', 'Candidate', 'candidate_resume', 'industries'));
    }

    public function saveSkillsDetails(Request $request)
    {
        $request->validate(
            [
//                'skills' => 'required|max:500',
                'sel_education' => 'required',
//                'required_certification' => 'required|max:500',
            ]);
        $candidate = NewCandidate::where('id', session()->get('candidate_id'))->first();
        $candidate->skills = $request->skills;
        $candidate->education_id = $request->sel_education;
        $candidate->certifications = $request->required_certification;
        $candidate->save();
        return redirect()->route('candidate.view.salary.details');
    }

    public function viewSalaryDetails()
    {
        $Education = Education::all();
        $industries = Industry::all();
        $Candidate = NewCandidate::where('id', session()->get('candidate_id'))->first();
        $candidate_resume = candidate_resume::where('candidate_id', session()->get('candidate_id'))->get();
        return view('user.profile-salary-details')->with(compact('Education', 'Candidate', 'candidate_resume', 'industries'));
    }

    public function saveSalaryDetails(Request $request)
    {
//        dd($request->all());
        $request->validate(
            [
                'package' => ['required', 'min:1', 'max:20', new CurrencyValidation()],
                'package_to' => ['nullable', 'min:1', 'max:20', new CurrencyValidation()],
            ]);
        $candidate = NewCandidate::where('id', session()->get('candidate_id'))->first();
        $candidate->salary_sign = $request->hidd_curr_sign;
        $candidate->salary = $request->package;
        $candidate->salary_to = $request->package_to;
        $candidate->salary_type = $request->salary_duration;
        $candidate->save();
        return redirect()->route('candidate.view.interest.details');
    }

    public function viewInterestDetails()
    {
        $Education = Education::all();
        $industries = Industry::all();
        $Candidate = NewCandidate::where('id', session()->get('candidate_id'))->first();
        $candidate_resume = candidate_resume::where('candidate_id', session()->get('candidate_id'))->get();
        return view('user.profile-interest-details')->with(compact('Education', 'Candidate', 'candidate_resume', 'industries'));
    }

    public function saveInterestDetails(Request $request)
    {
        $request->validate(
            [
                'interest' => 'nullable|max:255',
            ]);
        $candidate = NewCandidate::where('id', session()->get('candidate_id'))->first();
        $candidate->interest = $request->interest;
        $candidate->save();
        return redirect()->route('new.candidate.dashboard');
    }

    public function resendCode(Request $request)
    {
        $candidate = NewCandidate::where('email', $request->email)->first();
        if ($candidate) {
            $code['code'] = Str::random(5);
            $code['stringRand'] = Str::random(20);
            $candidate->code = $code['code'];
            $candidate->random_code = $code['stringRand'];
            $email = new SendJobApplyEmailVerifyCode($code);

            Mail::to($request->email)->send($email);

            $candidate->save();
            return json_encode('success');
        } else {
            return json_encode('error');
        }

    }

    /*Apply Job Update*/
    public function jobApplyVerifyEmail(Request $request)
    {
        $candidate = NewCandidate::where('email', $request->email)->first();
        if (is_null($candidate) || empty($candidate) || $candidate->deleted == 2 || $candidate->deleted == 1) {
            $request->validate([
//                'location' => 'required|regex:/^[a-zA-Z,.\s]*$/|min:2|max:255',
                'location' => 'required',
                'full_name' => 'required|regex:/^[a-zA-Z ]+$/u|max:255',
                'phone_no' => 'required|regex:/^[0-9\-\(\)\s]+$/|min:14|max:14',
                'email' => 'required|email',
                'resume' => 'nullable|mimes:doc,docx,pdf',
            ], [
                'resume.required' => 'Resume is Required',
            ]);
            $code['code'] = rand(100000, 999999);
            $code['password'] = Str::random(8);
            $password = Hash::make($code['password']);
            if (is_null($candidate) || empty($candidate)) {
                $candidate = new NewCandidate();
            } // Check for non-logged in user already applied to this Job with same email
            elseif ($candidate->deleted == 2 || $candidate->deleted == 1) // 2 for non-registered user & 1 for Deleted Account
            {
                $job_check = Applied_Jobs::where('job_id', $request->id)->where('candidate_id', $candidate->id)->first();
                if (!is_null($job_check)) {
                    return response('already_apply_same_mail');
                }
            }
            $candidate->email = $request->email;
            $candidate->name = $request->full_name;
            $candidate->phone = $request->phone_no;
            $candidate->location = $request->location;
            $candidate->random_code = $code['code'];
            if ($candidate->deleted == 1) {
                $candidate->deleted = 1;
            } else {
                $candidate->deleted = 2;
            }
            $candidate->save();
            $email = new SendJobApplyEmailVerifyCode($code);
            Mail::to($request->email)->send($email);
            return response('success');
        } else {
            return response('email_exist');
        }

    }

    public function chkVerifyEmailCode(Request $request)
    {
        $candidate = NewCandidate::where('email', $request->email)->first();
        if ($candidate && $candidate->random_code == $request->code) {
            $candidate->random_code = '';
            $candidate->save();
            return response('success');
        } elseif (empty($request->code)) {
            return response('empty');
        } else {
            return response('error');
        }
    }

    public function nonLoggedinJobApply(Request $request)
    {
        $candidate_chk = NewCandidate::where('email', $request->email)->first();
        $can_resume = candidate_resume::where('candidate_id', $candidate_chk->id)->first();
        if ($can_resume != null) {
            if (file_exists(public_path() . '/files/' . $can_resume->resume)) {
                unlink(public_path() . '/files/' . $can_resume->resume);
            }
            $canidate_resume = $request->file('resume');
            $curr_date = date('Y_m_d-H-i-s');
            $name = $canidate_resume->getClientOriginalName();
            $filename = pathinfo($name, PATHINFO_FILENAME);
            $extension = pathinfo($name, PATHINFO_EXTENSION);
            $resume_name = $filename . '-' . $curr_date . '.' . $extension;
            $path = public_path('/files');
            $canidate_resume->move($path, $resume_name);
            $resume_dest_path = $resume_name;
            $can_resume->resume = $resume_dest_path;
            $can_resume->status = 1;
            $can_resume->save();
            $resume_id = $can_resume->id;
        } else {
            $resume = new candidate_resume();
            $canidate_resume = $request->file('resume');
            $curr_date = date('Y_m_d-H-i-s');
            $name = $canidate_resume->getClientOriginalName();
            $filename = pathinfo($name, PATHINFO_FILENAME);
            $extension = pathinfo($name, PATHINFO_EXTENSION);
            $resume_name = $filename . '-' . $curr_date . '.' . $extension;
            $path = public_path('/files');
            $canidate_resume->move($path, $resume_name);
            $resume_dest_path = $resume_name;
            $resume->resume = $resume_dest_path;
            $resume->status = 1;
            $resume->candidate_id = $candidate_chk->id;
            $resume->save();
            $resume_id = $resume->id;
        }

        $job_apply = new Applied_Jobs();
        $job_apply->job_id = $request->id;
        $job_apply->candidate_id = $candidate_chk->id;
        $job_apply->resume_id = $resume_id;
        $job_apply->name = $request->full_name;
        $job_apply->location = $request->location;
        $job_apply->phone = $request->phone_no;
        $job_apply->save();

        $job_details = user_job::with('client', 'admin')
            ->where('id', $request->id)
            ->first();

        $details['job_title'] = $job_details->job_title;
        $details['job_location'] = $job_details->location;
        if ($job_details['client']) {
            $details['company_name'] = $job_details['client']['company_name'];
            $candidateDetails['company_name'] = $job_details['client']['company_name'];
        } else {
            $details['company_name'] = "MyMotivz";
            $candidateDetails['company_name'] = "MyMotivz";
        }
        $candidateDetails['job_title'] = $job_details->job_title;
        $candidateDetails['candidate_name'] = $candidate_chk->name;
        $candidateDetails['location'] = $candidate_chk->location;
        $candidateDetails['experience'] = $candidate_chk->experience;
        $candidateDetails['resume'] = $resume_dest_path;
        $email = new JobApplySuccessMail($details);
        $companyMail = new CompanyReceiveNewCandidateMail($candidateDetails);
        Mail::to($request->email)->send($email);
        if ($job_details['client']) {
            Mail::to($job_details['client']['email'])->send($companyMail);
        } else {
            Mail::to($job_details['admin']['email'])->send($companyMail);
        }
        return json_encode('success');

    }

    /*Update 2-/01/2021*/
    public function submitJobNotify(Request $request)
    {
        $request->validate([
            'full_name_notify' => 'required|regex:/^[a-zA-Z ]+$/u|max:255',
            'email_notify' => 'required|email',
//            'desired_location_notify' => 'required|regex:/^[a-zA-Z,.\s]*$/|min:2|max:255',
            'desired_location_notify' => 'required',
            'desired_job_notify' => 'required|regex:/^[a-zA-Z,.\s]*$/|min:2|max:255',
            'industry_notify' => 'required',
        ]);
        $job_notify = new JobNotify();
        $job_notify->name = $request->full_name_notify;
        $job_notify->email = $request->email_notify;
        $job_notify->location = $request->desired_location_notify;
        $job_notify->job_title = $request->desired_job_notify;
        $job_notify->industry_id = $request->industry_notify;
        $job_notify->save();
        return back()->with('success_notify', 'Successfully Notify');
    }

    public function getIndustries()
    {
        $industries = Industry::all();
        return json_encode($industries);
    }

    public function getStates(Request $request)
    {
        $states = State::where('country_id', $request->id)->get();
        return Response::json(['states' => $states]);
    }

    public function pricingPlans()
    {
        $package_ids = Package::all()->pluck('id');
        return view('user.pricing_plan', compact('package_ids'));
    }

    public function paymentDetails($id)
    {
        $user = new NewClient();
//        $billingAgreement = PayPalAgreement::where('agreement_id', 'I-J8C1KJU684JU')->first();
//        $user = NewClient::find(38);
//        $userPackage = $user->packages->where('pivot.billing_agreement_id', 'I-J8C1KJU684JU')->first();
//
//        dd($userPackage->pivot->renewal_status);
        return view('user.payment_details', compact('id'));
    }
//    public function upload_image_cke(Request $request)
//    {
//        if ($request->hasFile('upload')) {
//            $originName = $request->file('upload')->getClientOriginalName();
//            $fileName = pathinfo($originName, PATHINFO_FILENAME);
//            $extension = $request->file('upload')->getClientOriginalExtension();
//            $fileName = $fileName . '_' . time() . '.' . $extension;
//
//            $request->file('upload')->move(public_path(), $fileName);
//
////            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
////            $url = asset('media/' . $fileName);
////            $msg = 'upload successfully';
////            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
////
////            @header('Content-type: text/html; charset=utf-8');
//            echo json_encode(array('file_name' => $request->file('upload')->getClientOriginalName()));
//
//        }
//        echo json_encode(array('file_name' => 'not working'));
//    }


}
