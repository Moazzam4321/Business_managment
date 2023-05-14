<?php

namespace App\Http\Requests\Dashboard;

use App\Models\User;
use Exception;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdateItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(Request $request): bool
    {
        dd("ok");
        try{
            $message = false;
            $user_id = data_get($request, 'user_data.id');
            $user_data = User::get_user_data_by_id($user_id);
            $user_role = data_get($user_data,'role',null);
            if($user_role == 'is_admin'){
                $message = true;
            }
        } catch (Exception $e){
            return false;
        }
         return $message;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        dd("ok");
        return [
            //
        ];
    }
}
