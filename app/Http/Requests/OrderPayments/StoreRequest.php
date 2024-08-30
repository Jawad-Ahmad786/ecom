<?php

namespace App\Http\Requests\OrderPayments;

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
             'payment_method_id' => ['required', 'exists:payment_methods,id'],
             'paid_amount' => ['required', 'integer']
        ];
    }

    public function messages()
    {
        return [
            'payment_method_id.required' => 'Payment Method is required',
            'payment_method_id.exists' => 'Payment Method does not exist',
            'paid_amount.required' => 'Please enter the amount to be paid',
            'paid_amount.integer' => 'Please provide a valid amount'
        ];
    }
}
