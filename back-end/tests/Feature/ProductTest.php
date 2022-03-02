<?php

namespace Tests\Feature;

use Database\Seeders\BrandSeeder;
use Database\Seeders\ProductSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_list_products()
    {
        $this->seed(BrandSeeder::class);
        $this->seed(ProductSeeder::class);

        $response = $this->get('/api/product');
        $response->assertStatus(200);
        $response->assertJsonCount(11);
    }

    public function test_get_product()
    {
        $this->seed(BrandSeeder::class);
        $this->seed(ProductSeeder::class);

        $response = $this->get('/api/product');
        $product = $response->getData()[0];
        $product_id = $product->product_id;

        $response = $this->get("/api/product/$product_id");
        $response->assertStatus(200);
        $actual_product = $response->getData();

        $this->assertEquals($product->product_name, $actual_product->product_name);
        $this->assertEquals($product->product_flavor, $actual_product->product_flavor);
        $this->assertEquals($product->brand_name, $actual_product->brand_name);
        $this->assertEquals($product->brand_logo_path, $actual_product->brand_logo_path);
    }
}
