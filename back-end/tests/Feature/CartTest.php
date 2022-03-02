<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CartTest extends TestCase
{
    use RefreshDatabase;

    public function test_bad_request()
    {
        $response = $this->post('/cart');

        $response->assertStatus(400);
    }
}
