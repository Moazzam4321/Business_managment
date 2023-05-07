<?php

namespace App\Http\Requests\Dashboard;

use App\Models\User;
use App\Rules\Base64FileWithExtension;
use Exception;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class AddItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(Request $request): bool
    {
        try{
            $message = false;
            $user_id = data_get($request, 'user_data.id');
            $user_data = User::get_user_data_by_id($user_id);
            $user_role = data_get($user_data,'user_role',null);
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
        return [
            //
            'item_name' => 'required|min:3|max:255',
            'item_price' => 'required|Integer',
            'item_description' => 'nullable|min:3|max:255',
            'item_pic' => ['nullable',new Base64FileWithExtension(5000000)],
        ];
    }
}
