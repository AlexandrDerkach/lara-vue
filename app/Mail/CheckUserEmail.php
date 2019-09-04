<?php

namespace App\Mail;

use Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CheckUserEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $msgData;
    public $user;

    /**
     * Create a new message instance.
     *
     * @param $sendTo
     */
    public function __construct($msgData, $user)
    {
        $this->msgData = $msgData;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $user = $this->user;
        $msgData = $this->msgData;

        \Mail::send('emails.email', $msgData, function($message) use($user, $msgData){
            $message->from($user->email, $user->name);
            $message->to($msgData['email'])->subject($msgData['subject']);
        });

        /*return $this->from($user->email)
            ->view('emails.email')
            ->text('emails.email_plain');*/
    }
}
