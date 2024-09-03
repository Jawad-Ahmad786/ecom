<?php

namespace App\Http\Requests\ProductReviews;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
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
            'review' => ['required', 'string', 'max:255'],
            'rating' => ['required', 'integer', Rule::in([1, 2, 3, 4, 5])],
            'images' => ['sometimes', 'array'],
            'images.*' => ['image', 'mimes:jpeg,jpg,png,giff', 'max:2048']
        ];
    }

/**
 * Get the validation messages that apply to the request.
 *
 * @return array<string, string>
 */
    public function messages(): array
    {
        return [
            'review.exists' => 'The provided review ID does not exist.',
            'rating.in' => 'The rating must be between 1 and 5.',
        ];
    }
}
