<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApiOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $rules = [
            'propertyID'   =>   'required|numeric',
            'agencyID'     =>   'required|numeric'
        ];
        if ($taskType ==='upSell'){
            $rules['payOrderId'] = 'required|numeric';
            $rules['payOrderItems'] = 'required|json';
        }

        return $rules;
        return [
            //
        ];
    }
}
