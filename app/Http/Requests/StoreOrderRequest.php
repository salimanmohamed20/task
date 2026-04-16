<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'product_name' => ['required', 'string', 'max:255'],
            'quantity'     => ['required', 'integer', 'min:1'],
            'price'        => ['required', 'numeric', 'min:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'product_name.required' => 'A product name is required.',
            'quantity.min'          => 'Quantity must be at least 1.',
            'price.min'             => 'Price must be a positive value.',
        ];
    }
}
