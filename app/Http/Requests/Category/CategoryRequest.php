<?php

namespace App\Http\Requests\Category;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CategoryRequest extends FormRequest
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
    public function rules(): array {
        return [
            'name'        => 'required|min:4|max:20|unique:categories',
            'description' => 'min:10|max:50'
        ];
    }

    public function failedValidation (Validator $validator) {
        throw new HttpResponseException(response()->json([
            'Status' => 'Failed',
            'Errors' => $validator->errors()
        ]));
    }
}
