<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',


            // Variants are optional but must be an array if provided
            'variants' => 'nullable|array',

            // Validate each variant's attributes only if variants are provided
            'variants.*.sku' => 'required|string|unique:product_variants,sku',
            'variants.*.color' => 'required|string|max:50',
            'variants.*.size' => 'required|string|max:10',
            'variants.*.price' => 'required|numeric|min:0',
            'variants.*.stock' => 'required|integer|min:0',

        ];
    }
}
