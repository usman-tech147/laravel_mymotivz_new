<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Str;

class contractmail extends Mailable
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

        $this->data = $data;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email =  $this->view('mail.contract_mail')
            ->from('usman.softenica@gmail.com', 'By Softenica')
            ->subject('TERMS OF ENGAGEMENT ')
            ->with([ 'data' => $this->data ]);
//        $exten= explode(".",$this->data[0]['contract_file']);
//        $count = count($exten);
//        $email->attach(asset('public').'/files/'.$this->data[0]['contract_file'], [
//            'as' => str_slug($this->data[0]['client']['company_name']).'.'.$exten[$count-1]
//        ]);
        return $email;    }
}
