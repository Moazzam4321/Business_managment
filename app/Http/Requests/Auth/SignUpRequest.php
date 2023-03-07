<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

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
    public function rules()
    {
        return [
            //
            'first_name'  =>  'required|string|min:3|max:50',
            'last_name'   =>  'required|string|min:3|max:50',
            'email'       =>  'required|email',
            'dob'         =>  'nullable|date_format:Y-m-d|before:today',
            'profile_pic' =>  'image|mimes:jpeg,png,jpg,gif,svg|max:2048' 
        ];
    }
    /**
     * Custom error messages 
     */
    // public function messages()
    // {
    //     return [
    //      'first_name.required' => 'First name field must not be empty',
    //      'first_name.string'   => 'Name must be in string format',
    //      'first_name.e'
    // }
}  
