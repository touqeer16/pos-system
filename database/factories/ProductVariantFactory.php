<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ProductVariant;
use App\Models\Product;

class ProductVariantFactory extends Factory {
    protected $model = ProductVariant::class;

    public function definition() {
        return [
            'product_id' => Product::factory(),
            'sku' => $this->faker->unique()->bothify('SKU-####'),
            'color' => $this->faker->safeColorName(),
            'size' => $this->faker->randomElement(['S', 'M', 'L', 'XL']),
            'price' => $this->faker->randomFloat(2, 5, 200),
            'stock' => $this->faker->numberBetween(0, 100),
        ];
    }
}