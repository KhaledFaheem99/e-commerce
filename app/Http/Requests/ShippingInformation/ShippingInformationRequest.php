<?php

namespace App\Http\Requests\ShippingInformation;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ShippingInformationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize (): bool {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules (): array {
        return [
            'user_name'    => 'required|string|min:8|max:25',
            'address'      => 'required|min:10|max:40',
            'first_phone'  => 'required|string|max:11|min:11',
            'second_phone' => 'nullable|string|max:11|min:11',
            'notes'        => 'nullable|string|max:1000|regex:/^[^<>]*$/'
        ];
    }

    public function failedValidation (Validator $validator) {
        throw new HttpResponseException(response()->json([
            'Status' => 'Failed',
            'Errors' => $validator->errors()
        ]));
    }
}
