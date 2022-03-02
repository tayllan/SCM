<?php

namespace App\Services;

use App\Mail\Email;
use Illuminate\Support\Facades\Mail;

class EmailService
{
    public function send_email(string $from_address, string $from_name, string $subject, string $user_name,
                               string $user_email)
    {
        $data = [
            'from_address' => $from_address,
            'from_name' => $from_name,
            'subject' => $subject,
            'user_name' => $user_name,
        ];

        $emailer = new Email($data);
        Mail::to($user_email)->send($emailer);
    }
}