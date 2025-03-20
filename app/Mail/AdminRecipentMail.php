<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminRecipentMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $recipient;

    public function __construct($user, $recipient)
    {
        $this->user = $user;
        $this->recipient = $recipient;
    }

    public function build()
    {
        return $this->subject('Recipient Added')
            ->view('emails.admin-recipient')
            ->with([
                'recipient' => $this->recipient
            ]);
    }
}
