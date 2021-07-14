<?php

namespace App\Models;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailSender;

class MailManager
{
    public static function sendEmail($to, $title, $body)
    {
        $details = [
            'title' => $title,
            'body' => $body
        ];

        Mail::to($to)->send(new MailSender($details));
    }
}
