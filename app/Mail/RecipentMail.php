<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Recipient;

class RecipentMail extends Mailable
{
    use Queueable, SerializesModels;

    public $recipient;
    public $customer;

    public function __construct(Recipient $recipient, $customer)
    {
        $this->recipient = $recipient;
        $this->customer = $customer;
    }

    public function build()
    {
        return $this->subject('WBS Recipient Added')
            ->view('emails.recipient')
            // ->view('emails.admin-recipient')
            ->with([
                'recipient' => $this->recipient,
                'customer' => $this->customer
            ]);
    }
}
