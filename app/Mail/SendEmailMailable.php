<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEmailMailable extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    public $subject;
    public $body;
    public $fromUser;
    public $toUser;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($fromUser, $toUser, $subject, $body)
    {
        $this->fromUser = $fromUser;
        $this->toUser   = $toUser;
        $this->subject  = $subject;
        $this->body     = $body;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subject)
            ->markdown('emails.send_email');
    }
}
