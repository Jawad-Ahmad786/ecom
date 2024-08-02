<?php

namespace App\Http\Requests\ProductReviews;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
             'user_id' => ['required', 'exists:users,id'],
             'review' => ['required', 'string', 'max:255'],
             'rating' => ['required', 'integer', Rule::in([1,2,3,4,5])],
        ];
    }
    public function messages(): array
    {
        $attributes = [
             'user_id.exists' => 'The provided User does not exist.',
             'rating' => 'Please give rating in b/w 1,2,3,4,5'
        ];
        return $attributes;
    }
}
