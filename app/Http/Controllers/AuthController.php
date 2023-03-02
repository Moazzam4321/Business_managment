<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Requests\AccountVerificationRequest as RequestsAccountVerificationRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\SignUpRequest;
use App\Http\Resources\UserResource;
use App\Models\Auth\Usertoken;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    //
    public function signUp(SignUpRequest $request)
    {
        $user_email=data_get($request,'email',null);
        $user_role = 'is_user';
        $token_type='signUp';

        if($request->hasFile('profile_picture')) 
        {
           $user_image= Helper::save_image_in_local_path($request->profile_picture);
        }

        if($user_email == 'Moazzammughal781@gmail.com'){
            $user_role = 'is_admin';
        }
       
        $user= User::create_user($request,$user_image,$user_role);
        $user_token= Usertoken::user_token($user->id,$token_type);
        SendMailController::send_mail('signUp',$user_token->token,$user->email);
        return response()->json([
            'error' => false,
            'message' => "Email send successfully , go to email account for further verification"
        ]);
    }

    public function verifyAccount(RequestsAccountVerificationRequest $request)
    {
        $response = ['error' => true, 'message' => 'Invalid token or token expired'];
        $token = Usertoken::is_token_exist(data_get($request,'token'));
      
        if($token) {
         $user_id = data_get($token->user,'id',null); 
         User::update_user($user_id,data_get($request,'password'));
         Usertoken::delete_token(data_get($token,'id'));
         $response = ['error' => false, 'message' => 'Account registered Successfully'];
       } 

       return $response;
    }

    public function login(LoginRequest $request)
    {
        $response = ['error'=>true , 'message' => 'Invalid records'];
        $email = data_get($request,'email');
        $password = data_get($request,'password');
        $user_data = User::find_login_user($email);
      
        if($user_data->email_verified_at == true)
       {
        if($user_data && Hash::check($password,data_get($user_data,'password'))) {
           $token_type = 'login';
           $user_token =  Usertoken::user_token(data_get($user_data,'id'),$token_type);
           $user_data= UserResource::collect($user_data);
           $response = response()->json(['error'=>true , 'message' => 'Successfully Login' ,'data'=>$user_data,'token'=> $user_token->token]);
        }}else {
            $response = ['error'=>true , 'message' => 'You are not verified, First go to your gmail account for verification'];
        }
       return $response;
    }
}
