<?php

namespace App\Http\Controllers;

use App\Jobs\SendingMail;
use Exception;
use Illuminate\Support\Facades\Log;

class SendMailController extends Controller
{
    public static function send_mail($mail_type,$token,$user_email)
    {
        try{
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
        } catch(Exception $e){
            Log::error('Some issue while sending mail',['user_email',$user_email]);
            return   $e->getMessage();
        }
    }
}
