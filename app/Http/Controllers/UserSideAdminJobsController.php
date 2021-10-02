<?php

namespace App\Http\Controllers;

use App\Applied_Jobs;
use App\candidate_resume;
use App\Education;
use App\favourite_job;
use App\Http\Middleware\Admin;
use App\Industry;
use App\Models\Admin\AdminUser;
use App\NewCandidate;
use App\user_job;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserSideAdminJobsController extends Controller
{
    public function createUserSideJob()
    {
        $industries = Industry::all();
        $educations = Education::all();
        return view('admin.user_side.new_post', compact('industries', 'educations'));
    }

    public function storeUserSideJob(Request $request)
    {
        $description = clean($request->job_discription);
        $job = user_job::create([
            'admin_id' => Auth::id(),
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
            'job_approved' => 1,
            'posted_at' => Carbon::now(),
        ]);

        return redirect()->back()->with('success', 'Job Created Successfully');
    }

    public function editUserSideJob($id)
    {
        $industries = Industry::all();
        $educations = Education::all();
        $job = user_job::find($id);
        return view('admin.user_side.edit_post', compact('job', 'industries', 'educations'));
    }

    public function updateUserSideJob(Request $request)
    {
        $description = clean($request->job_discription);
        $job = user_job::find($request->id);
        $job->job_title = $request->jobtitle;
        $job->package_sign = $request->hidd_curr_sign;
        $job->package = $request->package;
        $job->package_to = $request->package_to;
        $job->package_type = $request->salary_duration;
        $job->education_id = $request->education;
        $job->location = $request->location;
        $job->web_url = $request->web_url;
        $job->job_opening = $request->num_hires;
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

    public function deleteUserSideJob(Request $request)
    {
        $job = user_job::where('id', $request->jobId);
        $fav_jobs = favourite_job::where('job_id',$request->jobId)->get();
        $applied_jobs = Applied_Jobs::where('job_id', $request->jobId)->get();
        foreach ($fav_jobs as $fav_job)
        {
            $fav_job->delete();
        }
        foreach ($applied_jobs as $applied_job)
        {
            $applied_job->delete();
        }
        $job->delete();

        return response(['deleted',$fav_jobs, $applied_jobs]);
    }

    public function viewJobs()
    {
        return view('admin.user_side.view_jobs');
    }

    public function viewJobsAjaxAll(Request $request)
    {
        if ($request->current == 1) {
            $start = 0;
        } else {
            $start = ($request->current - 1) * $request->length;
        }
        $admin_jobs_query = user_job::where(function ($query) use ($request){
            if($request->title){
                $query->where('job_title', 'like', '%'.$request->title.'%');
            }
            if($request->location){
                $query->where('location', 'like', '%'.$request->location.'%');
            }
            if($request->job_status)
            {
                if($request->job_status == 1)
                {
                    $query->whereDate('applied_before','>',now());
                }
                if($request->job_status == 2)
                {
                    $query->whereDate('applied_before','<',now());
                }
            }
        })->where('admin_id',Auth::id());
        $total_admin_jobs = $admin_jobs_query->count();
        $adminJobs = $admin_jobs_query
            ->offset($start)
            ->limit($request->length)
            ->orderBy('id','desc')
            ->get();
        if($adminJobs){
            $j = $adminJobs->load(['admin','industry', 'education']);
        }
        $arrayName = array('0' => $total_admin_jobs, '1' => $j);
        return json_encode($arrayName);
    }
    public function viewJobDetail(Request $request)
    {
        $job_details = user_job::with('admin','industry', 'education')->find($request->jobId);
        $applied_candidates = user_job::find($request->jobId)->applied_job->where('is_new',1)->count();
//        $applied_candidates = user_job::find($request->jobId)->applied_job->count();
        return json_encode(['0' => $job_details, '1' => $applied_candidates]);
    }

    public function viewAppliedCandidates($id)
    {
        return view('admin.user_side.view_canidates', compact('id'));
    }

    public function viewAppliedCandidatesAjaxAll(Request $request)
    {
        if ($request->current == 1) {
            $start = 0;
        } else {
            $start = ($request->current - 1) * $request->length;
        }
        $find_applied_jobs_query = Applied_Jobs::with('job:id,job_title', 'candidate', 'candidate.education')
            ->where(function ($query) use ($request) {
                if (!empty($request->name)) {
                    $query->whereHas('candidate', function ($query) use ($request) {
                        $query->where('name', 'LIKE', '%' . $request->name . '%');
                    });
                }
            })->where('job_id', $request->id);

//        $jobs = Applied_Jobs::with('job:id,job_title', 'candidate', 'candidate.education')
//            ->where('job_id', $request->id);
        $jobs_total = $find_applied_jobs_query->count();
        $filtered_jobs = $find_applied_jobs_query
            ->offset($start)
            ->orderBy('id', 'desc')
            ->limit($request->length)
            ->get()
            ->toArray();
        $arr = [];
        foreach ($find_applied_jobs_query as $job) {
            $count = Applied_Jobs::where(['job_id' => $job['id'], 'is_new' => 1])->count();
            array_push($arr, $count);
        }
        $arrayName = array('0' => $jobs_total, '1' => $filtered_jobs, '2' => $arr, '3' => $jobs_total);
        return json_encode($arrayName);
    }
    public function viewCandidateDetail(Request $request)
    {
        $candidate = NewCandidate::with('industry', 'education')
            ->where('id', $request->candidateId)
            ->get();
//        return json_encode($candidate);
        $cand_apply_job = Applied_Jobs::where('candidate_id', $request->candidateId)
            ->where('job_id', $request->jobId)
            ->first();
        $cand_apply_job->is_new = 0;
        $cand_apply_job->save();
        $cand_resume_id = $cand_apply_job->resume_id;
        $cand_resume = candidate_resume::where('id', $cand_resume_id)->first();


        return json_encode(['0' => $candidate, '1' => $cand_apply_job, '2' => $cand_resume]);
    }
}
