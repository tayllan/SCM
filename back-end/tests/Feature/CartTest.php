<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\BrandSeeder;
use Database\Seeders\ProductSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CartTest extends TestCase
{
    use RefreshDatabase;

    public function test_add_item_to_cart_bad_request()
    {
        $this->seed(BrandSeeder::class);
        $this->seed(ProductSeeder::class);
        $this->seed(UserSeeder::class);

        $response = $this->post('/api/cart');
        $response->assertStatus(400);
    }

    public function test_add_item_to_cart()
    {
        $this->seed(BrandSeeder::class);
        $this->seed(ProductSeeder::class);
        $this->seed(UserSeeder::class);

        $user_id = User::all()->toArray()[0]['id'];

        $response = $this->get('/api/product');
        $product = $response->getData()[0];
        $product_id = $product->product_id;

        $response = $this->post('/api/cart', [
            'product_id' => $product_id,
            'quantity' => 3,
            'user_id' => $user_id
        ]);
        $response->assertStatus(201);
    }

    public function test_list_items()
    {
        $this->seed(BrandSeeder::class);
        $this->seed(ProductSeeder::class);
        $this->seed(UserSeeder::class);

        $user_id = User::all()->toArray()[0]['id'];

        $response = $this->get('/api/product');
        $product = $response->getData()[0];
        $product_id = $product->product_id;

        $response = $this->post('/api/cart', [
            'product_id' => $product_id,
            'quantity' => 3,
            'user_id' => $user_id
        ]);
        $response->assertStatus(201);
        $cart_id = $response->getContent();

        $response = $this->get("/api/cart/$cart_id");
        $response->assertStatus(200);
        $response->assertJsonCount(1);
    }

    public function test_remove_item_from_cart()
    {
        $this->seed(BrandSeeder::class);
        $this->seed(ProductSeeder::class);
        $this->seed(UserSeeder::class);

        $user_id = User::all()->toArray()[0]['id'];

        $response = $this->get('/api/product');
        $product = $response->getData()[0];
        $product_id = $product->product_id;

        $response = $this->post('/api/cart', [
            'product_id' => $product_id,
            'quantity' => 3,
            'user_id' => $user_id
        ]);
        $response->assertStatus(201);
        $cart_id = $response->getContent();

        $response = $this->get("/api/cart/$cart_id");
        $response->assertStatus(200);
        $response->assertJsonCount(1);
        $item = $response->getData()[0];

        $response = $this->delete('/api/item', [
            'cart_id' => $cart_id,
            'item_id' => $item->item_id
        ]);
        $response->assertStatus(200);
    }

    public function test_update_item()
    {
        $this->seed(BrandSeeder::class);
        $this->seed(ProductSeeder::class);
        $this->seed(UserSeeder::class);

        $user_id = User::all()->toArray()[0]['id'];

        $response = $this->get('/api/product');
        $product = $response->getData()[0];
        $product_id = $product->product_id;

        $response = $this->post('/api/cart', [
            'product_id' => $product_id,
            'quantity' => 3,
            'user_id' => $user_id
        ]);
        $response->assertStatus(201);
        $cart_id = $response->getContent();

        $response = $this->get("/api/cart/$cart_id");
        $response->assertStatus(200);
        $response->assertJsonCount(1);
        $item = $response->getData()[0];

        $new_quantity = 999;
        $response = $this->post('/api/item', [
            'item_id' => $item->item_id,
            'quantity' => $new_quantity,
        ]);
        $response->assertStatus(200);

        $response = $this->get("/api/cart/$cart_id");
        $item = $response->getData()[0];
        $this->assertEquals($new_quantity, $item->quantity);
    }
}
