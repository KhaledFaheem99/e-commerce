<?php

namespace App\Http\Requests\Product;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array {
        return [
            'name'        => 'required|min:2|unique:products',
            'price'       => 'required|integer',
            'size'        => 'required|in:XS,S,M,L,XL,2XL,3XL',
            'brand'       => 'required|string|min:3|max:15',
            'stock'       => 'required|integer',
            'category_id' => 'required|exists:categories,id'
        ];
    }

    public function failedValidation (Validator $validator) {
        throw new HttpResponseException(response()->json([
            'Status' => 'Failed',
            'Errors' => $validator->errors()
        ]));
    }
}
