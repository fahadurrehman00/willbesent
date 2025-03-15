<?php

namespace App\Mail;


use Illuminate\Mail\Mailable;

use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use SerializesModels;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        return $this->subject('New Contact Form Submission')
            ->view('emails.contact');
    }
}
