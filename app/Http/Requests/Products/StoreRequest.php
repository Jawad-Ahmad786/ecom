<?php

namespace App\Http\Requests\Products;

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
             'name' => ['required'],
             'sku' => ['required', 'unique:products,sku'],
             'slug' => ['required', 'unique:products,slug'],
             'category_id' => ['required', 'exists:categories,id'],
             'brand_id' => ['required', 'exists:brands,id'],
             'description' => ['required', 'string'],
             'short_description' => ['sometimes', 'string', 'max:255'],
             'stock' => ['required', 'integer'],
             'price' => ['required', 'numeric'],
             'status' => ['sometimes', 'boolean'],
             'featured' => ['sometimes', 'boolean'],
             'discount' => ['sometimes', 'integer'],
             'images' => ['required', 'array'],
             'images.*' => ['image', 'mimes:jpeg,jpg,png', 'max:2048'],
        ];
    }
    public function messages()
    {
        $attributes = [
        'images.required' => 'At least one image is required.',
        'category_id.exists' => 'The provided Category does not exist',
        'brand_id.exists' => 'The provided Brand does not exist'
        ];
        return $attributes;

    }
}
