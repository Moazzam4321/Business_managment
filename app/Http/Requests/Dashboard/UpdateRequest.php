<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
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
            'first_name'  =>  'required|string|min:3|max:50',
            'last_name'   =>  'required|string|min:3|max:50',
            'email'       =>  'required|email',
            'dob'         =>  'nullable|date_format:Y-m-d|before:today',
            'profile_pic' =>  'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
    }
}
