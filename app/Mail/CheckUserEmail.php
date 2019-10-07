<?php

namespace App\Mail;

use Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CheckUserEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $msg;
    public $user;
    public $subject;

    /**
     * Create a new message instance.
     *
     * @param $sendTo
     */
    public function __construct($msg, $subject, $user)
    {
        $this->msg = $msg;
        $this->user = $user;
        $this->subject = $subject;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
	    return $this
		    ->subject($this->subject)
		    ->view('emails.email')
		    ->with([
		    	'user' => $this->user,
			    'msg' => $this->msg,
			    'subject' => $this->subject
		    ]);
    }
}
