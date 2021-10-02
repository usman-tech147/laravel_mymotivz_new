<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Str;

class SendMailable extends Mailable
{
    use Queueable, SerializesModels;
    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       $email =  $this->view('mail.mail')
           ->from('usman.softenica@gmail.com', 'By Softenica')
           ->subject($this->data['subject'])
           ->with([ 'data' => $this->data ]);


//        foreach($this->data['resumes'] as $resume){
//           $exten= explode(".",$resume['resume']);
//           $count = count($exten);
//            $email->attach(asset('public').'/files'.$resume['resume'], [
//                'as' => Str::slug($resume['admin_candidate']['name']).'.'.$exten[$count-1]
//            ]);
//            $email->attach(asset('public').'/files'.$resume['resume']);
//        }
        return $email;
    }
}
