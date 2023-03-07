<?php

namespace App\Http\Controllers;

use App\Jobs\SendingMail;
use Illuminate\Support\Str;

class SendMailController extends Controller
{
    public static function send_mail($mail_type,$token,$user_email)
    {
        if($mail_type == 'signUp') {
        $url=route('sign_up');
        $link="$url/$token";
        SendingMail::dispatch($user_email,$mail_type,$link);
        }
        if($mail_type == 'forgotPassword') {
            $url=route('forgot_password');
            $link="$url/$token";
            SendingMail::dispatch($user_email,$mail_type,$link);
         }
    }
}
