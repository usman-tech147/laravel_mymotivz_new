<?php

namespace App\Http\Controllers;

use App\Models\Admin\AdminCandidate;
use App\Models\Admin\AdminClient;
use App\Models\Admin\AdminJob;
use App\Models\Admin\AdminReceiverEmail;
use App\Models\Admin\AdminResume;
use App\Models\Admin\AdminScheduleInterview;
use App\Models\Admin\AdminStatus;
use App\Notifications\Info;
use App\Candidate;
use App\Client;
use App\Job;
use App\Resume;
use App\schedule_interview;
use App\receiver_email;
use App\Status;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailable;
use App\User;

use App\Mail\interview;
use App\Mail\contactmail;
use Illuminate\Http\Request;
use PHPUnit\Framework\Constraint\Count;

class mailController extends Controller
{
    //
    public function send_email(Request $request)
    {
        $request->validate([
            'message' => 'required',
            'subject' => 'required',
            'candidate_id' => 'required',
        ]);
//        dd($request->all());
        $cad_ids = explode(",", $request->candidate_id);
//        dd(count($cad_ids));
        foreach ($cad_ids as $id) {
            $candidate = Candidate::find($id);
//        dd($candidate->toArray());
            $email = $candidate->email;

//        print_r($email);
            $message = nl2br($request->message);
            $data = array(

                'message' => $message,
                'subject' => $request->subject
            );
//            $email = 'zain.waheed.softenica@gmail.com';
//            $email = 'test2@development-env.com';
            Mail::to($email)->send(new contactmail($data));
        }

        if (count($cad_ids) == 1) {
            session()->flash('Email', 'Email was successfully delivered');
        } else {
            session()->flash('Email', 'Emails were successfully delivered');
        }

        return redirect()->back();
    }

    public function send_cv(Request $request)
    {
        $request->validate([
            'company_name' => 'required',
            'job_title' => 'required',
            'candidates' => 'required|array|min:1',
            'summary' => 'required',
            'subject' => 'required',
        ]);

        $company = AdminClient::where('id', $request->company_name)->first();
        $job_title = AdminJob::where('id', $request->job_title)->first();

        $candidates_resume = AdminResume::with('adminCandidate')
            ->whereIn('admin_candidate_id', $request->candidates)->get();
        $summary = nl2br($request->summary);
        $data = array(
            'company' => $company,
            'job_title' => $job_title->jobtitle,
            'resumes' => $candidates_resume->toArray(),
            'summary' => $summary,
            'subject' => $request->subject
        );

        $email = $company->email;
        //Testing email
//       $email = 'test2@development-env.com';
//       $email = 'zain.waheed.softenica@gmail.com';
//       $email = 'aroojfatima2067@gmail.com';
//        dd($request->emails);
        $fake_mails = array();
        if ($request->emails[0] != null) {
//    dd($request->emails);
            $cc_mails = [];
            $extra_mails = explode(",", $request->emails[0]);
            foreach ($extra_mails as $e_mail) {
                $result = filter_var($e_mail, FILTER_VALIDATE_EMAIL);
                if ($result != false) {
                    $cc_mails[] = $result;
                } else {
                    $fake_mails[] = $e_mail;
                }

            }
            Mail::to($email)->cc($cc_mails)->send(new SendMailable($data));
        } else {
            Mail::to($email)->send(new SendMailable($data));
        }


//dd('end');
        foreach ($request->candidates as $id) {
            $candidate = AdminCandidate::find($id);
//
            $status = AdminStatus::where('name', 'PRESENTED')->get();
            if ($status->isEmpty()) {
                $new_status = new AdminStatus();
                $new_status->name = 'PRESENTED';
                $new_status->color = '#e6d942';
                $new_status->reminder = 'Weekly';
                $new_status->save();

            } else {
//                dd($status->toArray());
                $candidate->admin_status_id = $status[0]['id'];
                $candidate->save();
            }

            $check = $job_title->adminCandidates()->where('admin_candidate_id', $id)->exists();
//          dd($check);
            if (!$check) {
                $job_title->adminCandidates()->attach($id);
            }

        }
        if (count($request->candidates) == 1) {
            session()->flash('Email', 'This candidate has been presented and added to the pipeline');

        } else {
            session()->flash('Email', 'These candidates has been presented and added to the pipeline');

        }
        return redirect()->back();
    }

    public function scheduleinterview(Request $request)
    {
        $request->validate([
            'client' => 'required',
            'status' => 'required',
            'candidate' => 'required',
            'job_title' => 'required',
            'location' => 'required',
            's_date' => 'required',
            's_time' => 'required',
            'e_time' => 'required',
            'time_zone' => 'required',
            'subject' => 'required',
            'message' => 'required',
//            'emails' => 'email',
        ]);
        $company = AdminClient::where('id', $request->client)->first();
        $job_title = AdminJob::where('id', $request->job_title)->first();

        $candidate = AdminCandidate::where('id', $request->candidate)->first();
        $message = nl2br($request->message);
        $interview = new AdminScheduleInterview();
        $interview->admin_client_id = $request->client;
        $interview->admin_job_id = $request->job_title;
        $interview->admin_candidate_id = $request->candidate;
        $interview->admin_status_id = $request->status;
        $s_date = date('Y-m-d', strtotime(str_replace('-', '/', $request->s_date)));
        $interview->start_date = $s_date;
        $interview->start_time = $request->s_time;
        $interview->end_time = $request->e_time;
        $interview->time_zone = $request->time_zone;
        $interview->location = $request->location;
        $interview->subject = $request->subject;
        $interview->message = $message;
        $interview->admin_user_id = Auth::id();
        $interview->save();

        $data = array(
            'company' => $company,
            'candidate' => $candidate,
            'job_title' => $job_title,
            'location' => $request->location,
            's_date' => $request->s_date,
            's_time' => $request->s_time,
            'e_date' => $request->e_date,
            'e_time' => $request->e_time,
            'time_zone' => $request->time_zone,
            'subject' => $request->subject,
            'message' => $message,
            'emails' => $request->emails,

        );
//                dd($data);
        //email should be this
        $email1 = $company->email;
//        //email should be this
        $email2 = $candidate->email;
        //Testing email
//        $email1 = 'test2@development-env.com';
//        $email1 = 'zain.waheed.softenica@gmail.com';
//        $email2 = 'zain.waheed.softenica@gmail.com';
        if ($request->emails[0] != null) {
//    dd($request->emails);
            $cc_mails = [];
            $extra_mails = explode(",", $request->emails[0]);
            foreach ($extra_mails as $e_mail) {
                $result = filter_var($e_mail, FILTER_VALIDATE_EMAIL);
                if ($result != false) {
                    $r_email = new AdminReceiverEmail();
                    $cc_mails[] = $result;
                    $r_email->interview_id = $interview->id;
                    $r_email->email = $result;
                    $r_email->save();
                }
            }

            Mail::to($email1)->cc($cc_mails)->send(new interview($data));
        } else {
            Mail::to($email1)->send(new interview($data));
        }
        Mail::to($email2)->send(new interview($data));
        session()->flash('Email', 'Emails are successfully delivered');
        $user_id = Auth::id();
        if ($user_id != 1) {
            $user = AdminUser::find(1);
            $details =
                [
                    'info' => 'New Interview has been Scheduled',
                    'data' => Auth::user()->name . ' Scheduled an interview with ' . $candidate->name . ' at <br> <b class="text-danger">' . date('M jS, Y', strtotime($interview->start_date)) . '</b> from  <b class="text-danger">' . date('h:i A', strtotime($interview->start_time)) . '</b> to <b class="text-danger">' . date('h:i A', strtotime($interview->end_time)) . '</b>  <br>  <a href="' . route('scheduled-interviews') . '">View Details<a>',

                ];
            $user->notify(new Info($details));
        }

        return redirect()->route('scheduled-interviews');

    }

//    public function upload_image_cke(Request $request)
//    {
//        if ($request->hasFile('file')) {
//            $originName = $request->file('file')->getClientOriginalName();
//            $fileName = pathinfo($originName, PATHINFO_FILENAME);
//            $extension = $request->file('file')->getClientOriginalExtension();
//            $fileName = $fileName . '_' . time() . '.' . $extension;
//
//            $request->file('upload')->move(public_path('uploads'), $fileName);
//
//            return json_encode(['location' => asset('uploads/'.$fileName)]);

//            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
//            $url = asset('media/' . $fileName);
//            $msg = 'upload successfully';
//            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
//
//            @header('Content-type: text/html; charset=utf-8');
//            echo $response;
//            echo json_encode(array('file_name' => $request->file('upload')->getClientOriginalName()));

//        }
//        echo json_encode(array('file_name outside' => $request->file('upload')->getClientOriginalName()));
//    }

}
