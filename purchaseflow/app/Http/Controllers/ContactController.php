<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMe;
use App\Mail\Email;
use App\EmailData;


class ContactController extends Controller
{
    

    public function sendEmail($emailAddress,$emailData) {
        $emailMessage = new Email($emailData);
        
        $sendingEmail =  Mail::to($emailAddress)->send($emailMessage);
        return $sendingEmail;
    }
}
