<?php

namespace App\Http\Controllers;

use App\Http\Requests\Dashboard\AddItemRequest;
use App\Http\Requests\Dashboard\UpdateItemRequest;
use App\Http\Requests\Dashboard\UpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Models\Item;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use function App\Helpers\get_file_extension;

class DashboardController extends Controller
{
    //
    public function update_profile(UpdateRequest $request)
    {
        try{
        $response = ['error' => false , 'message' => 'User data not found'];
        $data = [];
        $user_id = data_get($request , 'user_data.id');
        $existing_fields = ['first_name', 'last_name','dob','profile_pic','password'];
        $data = array_intersect_key($request->all(), array_flip($existing_fields));

        if(isset($data['profile_pic'])) 
        {
            $data['profile_pic']= get_file_extension($data['profile_pic']);
        }
 
        $user = User::update_user_data($user_id,$data);

        if(isset($user)){
            $response = ['error' => false , 'message' => 'User updated successfully'];
        } else {
            $response = $response;
        }
        return response()->json($response);
    } catch(Exception $e){
        Log::error('Something went wrong while updating',['user_id'=> $user_id]);
    }
    }

    public function get_user_data(Request $request)
    {
        $response = ['error'=> true , 'data' => null];
        try{
        $user_id = data_get($request, 'user_data.id');
        $user_data = User::get_user_data_by_id($user_id);
        $user_data= new UserResource($user_data);
        $response = ['error' => false , 'data'=> $user_data];  
        } catch (Exception $e){
            Log::emetrgency('Something went wrong',['user_id'=>$user_id]);
            return $response ;
        }        
        return response()->json($response);
    }

    public function add_item(AddItemRequest $request)
    {
        try{
            $response = ['erorr'=>false , 'message'=> 'Item added successfully'];
            $item_name = data_get($request,'item_name',null);
            $item_type = data_get($request,'item_type',null);
            $item_price = data_get($request,'item_price',null);
            $item_description = data_get($request,'item_description',null);
            $item_pic = data_get($request,'item_pic',null);
            $user_id = data_get($request , 'user_data.id',null);

            if(!empty($item_pic))
            {
                $item_pic= get_file_extension($item_pic);
            }
            
            Item::create_item($item_name,$item_type,$item_price,$item_description,$item_pic);
        } catch (Exception $e){
            Log::critical('Something went wrong while adding item',['user_id'=>$user_id]);
            $response = null;
        }
          return $response;
    }

    public function update_item(UpdateItemRequest $request)
    {
        $response = ['erorr'=>true , 'message'=> 'Some issue found while updating data'];
        try{
            $response = ['erorr'=>false , 'message'=> 'Item added successfully'];
            $item_id = data_get($request , 'item_id',null);

            $update_data = [];
            $existing_fields = ['item_name','item_type','item_price','item_description','item_pic'];

            foreach ($existing_fields as $existing_field){
                if($request->has($existing_field)){
                    $update_data[] =  $request->existing_field;
                }
            }

            DB::table('items')->where('item_id',$item_id)->update($update_data);
        } catch (Exception $e){
            return $response;
        }
    }
}
