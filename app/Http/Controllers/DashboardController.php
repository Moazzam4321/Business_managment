<?php

namespace App\Http\Controllers;

use App\Http\Requests\Dashboard\UpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Auth\Usertoken;
use App\Http\Resources\UserResource;

use function App\Helpers\get_file_extension;

class DashboardController extends Controller
{
    //
    public function update_profile(UpdateRequest $request)
    {
        $response = ['error' => false , 'message' => 'User data not found'];
        $data = [];
        $user_id = data_get($request , 'user_data.id');
        $existing_fields = ['first_name', 'last_name','dob','profile_pic','password'];
        $data = array_intersect_key($request->all(), array_flip($existing_fields));

        if(isset($data['profile_pic'])) 
        {
           $user_image= get_file_extension($data['profile_pic']);
           $user_image = str_replace(storage_path('app'), '', $user_image);
           @list(, $data['profile_pic']) = explode("\\", $user_image);
        }
 
        $user = User::update_user_data($user_id,$data);

        if(isset($user)){
            $response = ['error' => false , 'message' => 'User updated successfully'];
        } else {
            $response = $response;
        }
        return response()->json($response);
    }

    public function get_user_data(Request $request)
    {
        $response = ['error'=> true , 'data' => null];
        $user_id = data_get($request, 'user_data.id');
        $user_data = User::get_user_data_by_id($user_id);
        $user_data= new UserResource($user_data);
        if($user_data)
        {
            $response = ['error' => false , 'data'=> $user_data];          
        }
        return response()->json($response);
    }
}
