<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use App\Rules\Base64FileWithExtension;

class SignUpRequest extends FormRequest
{
    /** 
     * Stop on first validation error
     */
    protected $stopOnFirstFailure = true;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(Request $request)
    {
        return [
            //
            'first_name'  =>  'required|string|min:3|max:50',
            'last_name'   =>  'required|string|min:3|max:50',
            'email'       =>  'required|email',
            'dob'         =>  'nullable|date_format:Y-m-d|before:today',
            'profile_picture_base64' =>  ['nullable',new Base64FileWithExtension(5000000)],
        ];
    }
}  
