<?php

namespace App\Services;

use App\Mail\Email;
use Illuminate\Support\Facades\Mail;

class EmailService
{
    public function send_email(array $data)
    {
        Mail::to($data['user_email'])->send(new Email($data));
    }
}