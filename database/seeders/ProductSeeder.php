<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductVariant;

class ProductSeeder extends Seeder
{
    public function run()
    {
        Product::factory(10)->create();
        ProductVariant::factory(20)->create();
    }
}
