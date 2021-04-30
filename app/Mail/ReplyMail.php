<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReplyMail extends Mailable
{
    use Queueable, SerializesModels;

    public $reply;
    public $refenrence_no;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($reply,$refenrence_no)
    {
        $this->reply = $reply;
        $this->refenrence_no = $refenrence_no;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.reply_mail');
    }
}
