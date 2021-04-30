<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AcknowledgeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $refenrence_no;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($refenrence_no)
    {
        $this->refenrence_no = $refenrence_no;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.acknowledgement');
    }
}
