<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class subAdminmail extends Mailable
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
        //
//        dd($data);
        $this->data = $data;
//        dd($this->data);
//        $this->email = $data->email;
//        $this->subject = $data->subject;
//        $this->msg = $data->msg;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email =  $this->view('mail.subAdmin_mail')->from('admin@mymotivz.com', 'MyMotivz')->subject('MyMotivz | Account Login ')->with([ 'data' => $this->data ]);

        return $email;
    }
}
