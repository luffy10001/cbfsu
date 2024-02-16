<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewPropertyRequest extends FormRequest
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
         //   'priceCategory' => 'required|string',
          //  'titleQuality' => 'required',
           // 'detailsQuality' => 'required',
           // 'locationDistance' => 'required',
            'reviewStatus' => 'required',
            //'descriptionQuality' => 'required',
        ];
    }

}
