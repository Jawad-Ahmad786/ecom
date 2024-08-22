<?php

namespace App\Http\Requests\Orders;

use Illuminate\Foundation\Http\FormRequest;

class PlaceOrderRequest extends FormRequest
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
            'courier_id' => ['required', 'exists:couriers,id'],
            'city_id' => ['required', 'exists:cities,id']
        ];
    }
    public function messages()
    {
        return [
            'courier_id.required' => 'Courier is required',
            'courier_id.exists' => 'Provided Courier does not exist',
            'city_id.exists' => 'Provided City does not exist',
            'city_id.required' => 'City is required',
        ];
    }
}
