<?php

namespace App\Http\Requests\Orders;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
    public function rules(): array
    {
        return [
              'product_ids' => ['required', 'array'],
              'product_ids.*' => ['exists:products,id'],
              'quantity' => ['required', 'array'],
              'quantity.*' => ['required', 'integer', 'min:1'],
        ];
    }

    public function messages()
    {
        $attributes = [
                 'product_ids.required' => 'At least one Product is required.',
                 'product_ids.*.exists' => 'One or more selected products do not exist.',
                 'quantity.*.required' => 'Quantity is required.',
        ];
        return $attributes;
    }
}
