<?php

namespace Tests\Feature;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Product;

class ProductApiTest extends TestCase {
    use RefreshDatabase;

    public function test_can_list_products() {
        Product::factory(5)->create();
        $this->getJson('/api/products')->assertOk()->assertJsonCount(5);
    }
}