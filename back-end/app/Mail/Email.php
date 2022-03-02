<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Email extends Mailable
{
    use Queueable, SerializesModels;

    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        return $this->view('emails.checkout')
            ->from($this->data['from_address'], $this->data['from_name'])
            ->cc($this->data['from_address'], $this->data['from_name'])
            ->bcc($this->data['from_address'], $this->data['from_name'])
            ->replyTo($this->data['from_address'], $this->data['from_name'])
            ->subject($this->data['subject'])
            ->with($this->data);
    }
}
