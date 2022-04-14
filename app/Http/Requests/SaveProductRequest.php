<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'product-image' => 'required',
            'product-name' => 'required|min:5|max:250',
            'product-description' => 'required|min:10|max:10000',
            'product-price' => 'required'
        ];
    }

    /**
     * 
     * Custom validation messages
     * 
     * @return array
     */
    public function messages()
    {
        return [
            'product-image.required' => 'The image of the product is required',
            'product-name.required' => 'The name of the product is required',
            'product-name.min' => 'Please provide more text for the product name',
            'product-description.required' => 'The description of the product is required',
            'product-description.min' => 'Please provide more text for the product description',
            'product-price.required' => 'The product price is required'
        ];
    }
}
