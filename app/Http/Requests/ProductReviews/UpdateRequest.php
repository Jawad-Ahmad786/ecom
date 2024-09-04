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
            'rating' => ['required', 'integer', Rule::in([1,2,3,4,5])],
            'images' => ['sometimes', 'array'],
            'images.*' => ['image', 'mimes:jpeg,jgp,png,gif', 'max:2048']
        ];
    }
    public function messages(): array
    {
        $attributes = [
            'review' => 'Review is required',
            'rating.in' => 'The rating must be between 1 and 5.',
        ];
        return $attributes;
    }
}

