<?php

namespace App\Http\Controllers\User;

use App\Candidate;
use App\Http\Requests\companyRegistrationRequest;
use App\Http\Requests\UserCandidateRegisterationRequest;
use App\Mail\ForgotPassword;
use App\Mail\SendRegistrationCode;
use App\NewCandidate;
use App\NewClient;
use App\candidate_resume;
use App\Applied_Jobs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Session;

class RegisterController extends Controller
{

    //Candidate Registration
    public function register(UserCandidateRegisterationRequest $request)
    {
//        dd($request->all());
        /* deleted=0 for candidates those account are active.
         * deleted=1 for candidates those account is deleted.
         * deleted=2 for candidates that Apply for job without creating account & didn't create account yet.
        */
        try {

            DB::beginTransaction();
            $candidate = NewCandidate::where(['email' => $request->email/*,'deleted'=>2*/])->whereIn('deleted', [1, 2])->first();
            $candidate_chk = NewCandidate::where(['email' => $request->email])->whereIn('deleted', [0])->first();
            if ($candidate_chk) {
                return redirect()->back()->with('email_already_exists', 'Email already exists.');
            }
            $code['code'] = Str::random(5);
            $code['stringRand'] = Str::random(20);
            $code['user'] = "as a Job Seeker";
            $password = Hash::make($request->password);
            if ($candidate) {
                if ($candidate->deleted == 2 || $candidate->deleted == 1) {
                    $cand_resume = candidate_resume::where('candidate_id', $candidate->id)->orderby('id', 'DESC')->first();

                    if (!is_null($cand_resume)) {
                        $cand_applied_jobs = Applied_Jobs::where('candidate_id', $candidate->id)->update(['resume_id' => $cand_resume->id]);
                        $resumes = candidate_resume::where('candidate_id', $candidate->id)->whereNotIn('id', [$cand_resume->id])->get();
                        if (count($resumes) > 0) {
                            foreach ($resumes as $resume) {
                                $resume_path = public_path('/files/' . $resume->resume);
                                unlink($resume_path);
                                $resume->delete();
                            }
                        }
                    }
                }
            } else {
                $candidate = new NewCandidate();
                $candidate->email = $request->email;
            }

            $candidate->password = $password;
            $candidate->code = $code['code'];
            $candidate->random_code = $code['stringRand'];
            $candidate->deleted = 0;
            $candidate->save();

            $email = new SendRegistrationCode($code);
            Mail::to($request->email)->send($email);
            DB::commit();
            session()->flash('verify', 'Please verify your account by clicking on the link sent to your email.');

        } catch (\Exception $exception) {
            DB::rollBack();
            session()->flash('verifyFailed', 'Some error has occurred while creating your account please try again later.');

        }

        return redirect()->route('user.register');

    }

    //this funtion is using for both company and candidate..
    public function registerVerifyWithLink($code)
    {
//        dd('code :'.$code);
        if (session()->has('company')) {

            if (NewClient::where('random_code', '=', $code)->exists()) {

                $client = NewClient::where('random_code', $code)->get();

                NewClient::where('random_code', $code)->update([

                    'code' => "",
                    'random_code' => ""
                ]);


                session(['c_email' => $client[0]['email']]);
                session(['c_email.id' => $client[0]->id]);
                session(['c_email.name' => $client[0]->name]);
                session(['c_email.company_name' => $client[0]->company_name]);
                session(['c_email.logo' => $client[0]->logo]);
                return redirect()->route('user.client.dashboard');

            } else {

                return redirect()->route('user.login');
            }
        } else {

            if (NewCandidate::where('random_code', '=', $code)->exists()) {

                $candidate = NewCandidate::where('random_code', $code)->get();

                NewCandidate::where('random_code', $code)->update([

                    'code' => "",
                    'random_code' => ""
                ]);

                session(['email' => $candidate[0]['email']]);
                session(['candidate_id' => $candidate[0]['id']]);
                session(['cand_prof_img' => $candidate[0]['prof_image']]);
                session(['candidate_name' => $candidate[0]['name']]);
                return redirect()->route('candidate.dashboard');

            } else {

                return redirect()->route('user.login');
            }
        }


    }

    //company registration

    public function companyRegister(companyRegistrationRequest $request)
    {
        try {

            DB::beginTransaction();

            $code['code'] = Str::random(5);
            $code['stringRand'] = Str::random(20);
            $code['user'] = "as an Employer";
            $password = Hash::make($request->password);

            NewClient::create([
                'email' => $request->email,
                'password' => $password,
                'company_name' => $request->compnay_name,
                'code' => $code['code'],
                'random_code' => $code['stringRand']
            ]);

            $email = new SendRegistrationCode($code);
            Mail::to($request->email)->send($email);

            session(['company' => "register"]);

            session()->flash('verifyCompnay', 'Please verify your account by clicking on link sent to this email');
            DB::commit();

        } catch (\Exception $exception) {
            DB::rollBack();

            session()->flash('verifyFailed', 'Some error has occurred while creating your account please try again later.');

        }
        return redirect()->route('user.signUp.company');

    }

    public function AuthLogin()
    {
        if (session()->has('candidate_id')) {
            return redirect()->route('candidate.dashboard');
        } elseif (session()->has('c_email.id')) {
            return redirect()->route('user.client.dashboard');
        } else
            return view('user.login');
    }

    //this funtion is using for both company and candidate..
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);


        // dd($candidate->toArray());
        if ($request->chk_login == 'candidate') {
            $candidate = NewCandidate::where('email', $request->email)->where('deleted', 0)->first();
            if ($candidate == null) {

                return redirect()->back()->with('error', "Couldn't find your Account.")->withInput();
            }
            $checkVerification = $candidate->code;
            $chkAccountDeleted = $candidate->deleted;
            if ($checkVerification != null) {
                // send the email from here to user.

                return redirect()->back()->with('error', 'Your Account is not Verified yet.')->withInput();
            } elseif ($chkAccountDeleted == 1) {
                return redirect()->back()->with('error', 'Your Account is Deleted.')->withInput();
            } else {
                $password = $candidate->password;
                if (Hash::check($request->password, $password)) {
                    session()->put('candidate_id', $candidate->id);
                    session()->put('candidate_name', $candidate->name);
                    session()->put('cand_prof_img', $candidate->prof_image);
                    session(['email' => $request->email]);
                    session(['status' => 1]);
                    Session::forget('status');
                    return redirect()->route('new.candidate.dashboard')->with(compact('candidate'));
                } else {

                    return redirect()->back()->with('error', 'Email or Password entered is incorrect.')->withInput();
                }
            }
        } elseif ($request->chk_login == 'company') {

            $client = NewClient::where('email', $request->email)->first();


            if ($client == null) {

                return redirect()->back()->with('error', "Couldn't find your Account.")->withInput();
            }
            if ($client != null) {
                $checkVerification = $client->code;
                if ($checkVerification != null) {
                    return redirect()->back()->with('error', 'Your Account is not Verified yet.')->withInput();
                } else {

                    $password = $client->password;
                    if (Hash::check($request->password, $password)) {
                        session(['c_email' => $request->email]);
                        session(['c_email.id' => $client->id]);
                        session(['c_email.name' => $client->name]);
                        session(['c_email.company_name' => $client->company_name]);
                        session(['c_email.logo' => $client->logo]);
                        session(['status' => 0]);
                        return redirect()->route('company.dashboard');
                    } else {

                        return redirect()->back()->with('error', 'Email or Password entered is incorrect.')->withInput();
                    }
                }
            }

        }
    }

    public function forgotPassword()
    {
        if (session()->has('candidate_id')) {
            return redirect()->route('candidate.dashboard');
        } elseif (session()->has('c_email.id')) {
            return redirect()->route('user.client.dashboard');
        } else {
            return view('user.forgot_password');
        }
    }

    //this funtion is using for both company and candidate..
    public function submitForgotPassword(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
        ]);

        $code['stringRand'] = Str::random(20);

        $candidate = NewCandidate::where('email', $request->email)->where('deleted', 0)->get();
        $client = NewClient::where('email', $request->email)->get();

        if (!$candidate->isEmpty()) {

            session(['forgot' => 'candidate']);

            $email = new ForgotPassword($code);
            Mail::to($request->email)->send($email);

            $candidate = NewCandidate::where('email', $request->email)->first();
            $candidate->random_code = $code['stringRand'];
            $candidate->email_verify = 1;
            $candidate->save();
            return redirect()->back()->with('success', 'Please check your email to reset password');
        }

        if (!$client->isEmpty()) {

            session(['forgot' => 'client']);

            $email = new ForgotPassword($code);
            Mail::to($request->email)->send($email);

//            NewClient::where('email' , $request->email)->update([ 'random_code'=> $code['stringRand'] ]) ;
            $client = NewClient::where('email', $request->email)->first();
            $client->random_code = $code['stringRand'];
            $client->email_verify = 1;
            $client->save();
            return redirect()->back()->with('success', 'Please check your email to reset password');
        } else {

            return redirect()->back()->with('error', 'Email does not exist');
        }
    }

    //this funtion is using for both company and candidate..
    public function changePassword($code)
    {


        if (session('forgot') == "candidate") {

            $user = NewCandidate::where('random_code', $code)->get();

            if (!$user->isEmpty()) {
                $user = NewCandidate::where('random_code', $code)->first();
                if ($user->email_verify == 1)
                    return view('user.update_password', compact('code'));
                else
                    return redirect()->route('user.login')->with('error', "Link has been expired. Please try again");
            } else {

                return redirect()->route('user.login')->with('error', "Your link has been expired");
            }

        } else {

            $user = NewClient::where('random_code', $code)->get();
            if (!$user->isEmpty()) {
                $user = NewClient::where('random_code', $code)->first();
                if ($user->email_verify == 1)
                    return view('user.update_password', compact('code'));
                else
                    return redirect()->route('user.login')->with('error', "Link has been expired. Please try again");
            } else {

                return redirect()->route('user.login')->with('error', "Your link has been expired");
            }

        }
    }

    //this funtion is using for both company and candidate..
    public function updatePassword(Request $request)
    {

//        dd('working');
        $request->validate([
            'password' => 'required|confirmed',
        ]);

        if (session('forgot') == "candidate") {

            $candidate = NewCandidate::where('random_code', $request->code)->first();

            $candidate->password = Hash::make($request->password);
            $candidate->email_verify = 0;
            $candidate->save();
            return redirect()->route('user.login')->with('success', "Password updated successfully");
        } else {

            $client = NewClient::where('random_code', $request->code)->first();
            $client->password = Hash::make($request->password);
            $client->email_verify = 0;
            $client->save();
            return redirect()->route('user.login')->with('success', "Password updated successfully");
        }
    }


    public function logout()
    {

//        session()->forget('company');
//        session()->forget('email');
//        session()->forget('c_email');
//        session()->forget('forgot');
//        session()->forget('candidate_id');
//        session()->forget('cand_prof_img');
//        session()->forget('candidate_name');
        session()->flush();
        return redirect()->route('user.login');
    }

}
