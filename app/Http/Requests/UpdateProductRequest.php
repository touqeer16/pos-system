<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'sometimes|string|max:255',
            'description' => 'sometimes|string|nullable',
            'price' => 'sometimes|numeric|min:0',

            // Variants are optional but must be an array if provided
            'variants' => 'nullable|array',

            // Validate each variant's attributes if provided
            'variants.*.id' => 'sometimes|exists:product_variants,id',
            'variants.*.sku' => 'required|string|unique:product_variants,sku,' . $this->id,
            'variants.*.color' => 'required|string|max:50',
            'variants.*.size' => 'required|string|max:10',
            'variants.*.price' => 'required|numeric|min:0',
            'variants.*.stock' => 'required|integer|min:0',
        ];
    }
}
