<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Base64FileWithExtension;

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
            'first_name'  =>  'string|min:3|max:50',
            'last_name'   =>  'string|min:3|max:50',
            'email'       =>  'email',
            'dob'         =>  'nullable|date_format:Y-m-d|before:today',
            'profile_pic' =>  ['nullable',new Base64FileWithExtension(5000000)],
        ];
    }
}
