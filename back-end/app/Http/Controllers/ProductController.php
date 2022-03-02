<?php

namespace App\Http\Controllers;

use App\Services\ProductService;

class ProductController extends Controller
{
    private $product_service;

    public function __construct(ProductService $product_service)
    {
        $this->product_service = $product_service;
    }

    public function index()
    {
        return $this->product_service->get_products();
    }

    public function show(int $product_id)
    {
        return $this->product_service->get_product($product_id);
    }
}
