<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Requests\Auth\SignUpRequest;
use App\Models\Auth\Usertoken;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    //
    public function signUp(SignUpRequest $request)
    {
        $user_email=$request->email;
        $user_role = 'is_user';
        $token_type='signUp';

        if($request->hasFile('profile_picture')) 
        {
           $user_image= Helper::save_image_in_local_path($request->profile_picture);
        }

        if($user_email == 'Moazzammughal781@gmail.com'){
            $user_role = 'is_admin';
        }
        
        $token_type='signUp';
        $user= User::create_user($request,$user_image,$user_role);
        $user_token= Usertoken::user_token($user->id,$token_type);
        SendMailController::send_mail('signUp',$user_token->token,$user->email);
        return response()->json([
            'error' => false,
            'message' => "Email send successfully , go to email account for further verification"
        ]);
    }

    public function verifyAccount()
    {
        dd("ok");
    }
}
