<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContractAgencyRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' =>  'required',
            'password'  =>  'required|confirmed|min:8|max:20|regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
        ];
    }

    public function messages()
    {
         return [
             'password'=>'Password must be (8) characters in length, contain (1) uppercase, (1) lowercase , (1) special and (1) numeric.'
         ];
    }
}
