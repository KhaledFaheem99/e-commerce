<?php

namespace App\Http\Requests\Auth;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserCreateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array {
        return [
            'name'     => 'required|string|min:8|max:25',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed'
        ];
    }

    public function failedValidation (Validator $validator) {
        throw new HttpResponseException(response()->json([
            'Status' => 'Failed',
            'Errors' => $validator->errors()
        ]));
    }
}
