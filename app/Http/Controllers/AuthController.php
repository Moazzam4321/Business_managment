<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Requests\AccountVerificationRequest as RequestsAccountVerificationRequest;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Http\Requests\Auth\SignUpRequest;
use App\Http\Resources\UserResource;
use App\Models\Auth\Usertoken;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use function App\Helpers\get_file_extension;

class AuthController extends Controller
{
    /**
     * 1. This method first get input paramters
     * 2. Check if any file in input paramter if exist save in local storage and return its path by calling function "Helper::save_image_in_local_path"
     * 3. Then check input email is against admin or not 
     * 4. Then save record and register new user against its role
     * 5. Generate token and send mail with endpoint and token attach in it
     * @param Request $request
     * @return Illuminate\Http\Response
     */
    public function signUp(SignUpRequest $request)
    {
        $user_email=strtolower(trim(data_get($request,'email',null)));
        $user_image = data_get($request , 'profile_picture', null);
        $first_name = data_get($request , 'first_name' , null);
        $last_name = data_get($request , 'last_name' , null);
        $dob = data_get($request , 'dob' , null);
        $user_role = 'is_user';
        $token_type='signUp';

        if($user_image !== null) 
        {
           $user_image= get_file_extension($user_image);
           $user_image = str_replace(storage_path('app'), '', $user_image);
           @list(, $user_image) = explode("\\", $user_image);
        }

        if( $user_email == 'moazzammughal781@gmail.com'){
            $user_role = 'is_admin';
        }
       
        $user= User::create_user($first_name,$last_name,$user_email,$dob,$user_image,$user_role);
        $user_token= Usertoken::user_token($user->id,$token_type);
        SendMailController::send_mail('signUp',$user_token->token,$user->email);
        return response()->json([
            'error' => false,
            'message' => "Email send successfully , go to email account for further verification"
        ]);
    }

    /**
     * 1. This function check token first
     * 2. if exist then update user account with input password 
     * 3. Delete input token form database
     * @param Request $request
     * @return Illuminate\Http\Response
     */

    public function verifyAccount(RequestsAccountVerificationRequest $request)
    {
        $response = ['error' => true, 'message' => 'Invalid token or token expired'];
        $token = Usertoken::is_token_exist(data_get($request,'token'));
        $data = [];
      
        if($token) {
         $data['password'] = data_get($request,'password');
         $data['email_verified_at'] = true;
         $user_id = data_get($token->user,'id',null); 
         User::update_user_data($user_id,$data);
         Usertoken::delete_token(data_get($token,'id'));
         $response = ['error' => false, 'message' => 'Account registered Successfully'];
       } 

       return $response;
    }
   
    /**
     * 1. This functiuon get input paramters first
     * 2. Check user exist in database against input email 
     * 3. Ifexist then match password if matched 
     * 4. Generate token and save in database
     * 5. Call Api resource to return format data against this user
     * @param Request $request
     * @return Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {
        $response = ['error'=>true , 'message' => 'Invalid records'];
        $email = strtolower(trim(data_get($request,'email',null)));
        $password = data_get($request,'password');
        $user_data = User::get_user_data_by_email($email);
       
        if(isset($user_data) && $user_data->email_verified_at)
       {
        if($user_data && Hash::check($password,data_get($user_data,'password'))) {
           $token_type = 'login';
           $user_token =  Usertoken::user_token(data_get($user_data,'id'),$token_type);
           $user_data= new UserResource($user_data);

           $response = response()->json([
            'error'=>true , 
            'message' => 'Successfully Login' ,
            'data'=>$user_data,
            'token'=> $user_token->token]);
        }}else {
            $response = ['error'=>true , 'message' => 'You are not verified, First go to your gmail account for verification'];
        }

       return $response;
    }


    /**
     * 1. This function get email from input parameter
     * 2. Match this email with database records 
     * 3. If exist generate a toekn and send mail with endpoint and attached generated token with it
     * @param Request $request
     * @return Response $response
     */
    public function forgotPassword(ForgotPasswordRequest $request)
    {
        $response = ['error' => true , 'message' => "Invalid email"];
        $email = strtolower(trim(data_get($request,'email',null)));
       $user_data = User::find_user_by_email($email);
    
       if($user_data) {
        $token_type = 'Forgot Password';
        $user_token =  Usertoken::user_token(data_get($user_data,'id'),$token_type);
        SendMailController::send_mail('forgotPassword',$user_token->token,$email);
        $response = ['error' => false , 'message' => "Go to ur gmail for further verification"];
       }

       return $response;
    }

    /**
     * 1. This function get token from url 
     * 2. Check record against this token 
     * 3. If exist then fetch user against this user and update its password with input password and also delete its token
      * @param Request $request
     * @return Response $response 
     */
    public function resetPassword(ResetPasswordRequest $request)
    {
        $response = ['error' => true, 'message' => 'Invalid token or token expired'];
        $token = Usertoken::is_token_exist(data_get($request,'token'));
      
        if($token) {
         $user_id = data_get($token->user,'id',null); 
         User::update_user($user_id,data_get($request,'password'));
         Usertoken::delete_token(data_get($token,'id'));
         $response = ['error' => false, 'message' => 'Password reset Successfully'];
       } 

       return $response;
    }

    public function showRegistrationForm()
   {
    //dd("ok");
    return view('SignUp');
   }

   public function showLoginForm()
   {
    //dd("ok");
    return view('Login');
   }
}
