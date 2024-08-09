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
              'customer_mobile_no' => ['required'],
              'customer_address' => ['required'],
              'city_id' => ['required', 'exists:cities,id'],
              'shipping_method_id' => ['required', 'exists:shipping_methods,id'],
              'product_ids' => ['required', 'array'],
              'product_ids.*' => ['exists:products,id'],
              'quantity' => ['required', 'array'],
              'quantity.*' => ['required', 'integer', 'min:1'],
        ];
    }

    public function messages()
    {
        $attributes = [
                 'customer_address.required' => 'Address is required.',
                 'customer_mobile_no.required' => 'Mobile Number is required.',
                 'shipping_method_id.required' => 'Shipping Method is required.',
                 'city_id.required' => 'City is required.',
                 'product_ids.required' => 'At least one Product is required.',
                 'product_ids.*.exists' => 'One or more selected products do not exist.',
                 'quantity.*.required' => 'Quantity is required.',
        ];
        return $attributes;
    }
}
