<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(): array
    {
        $products = Product::join('brands', 'products.brand_id', '=', 'brands.id')
            ->get(['products.id', 'products.product_name', 'products.product_flavor', 'brands.brand_name', 'brands.brand_logo_path']);

        $resources = [];
        foreach ($products as $product) {
            $resources[] = new ProductResource($product);
        }

        return $resources;
    }

    public function show(int $id): ProductResource
    {
        $product = Product::join('brands', 'products.brand_id', '=', 'brands.id')
            ->where('products.id', '=', $id)
            ->get(['products.id', 'products.product_name', 'products.product_flavor', 'brands.brand_name', 'brands.brand_logo_path'])
            ->firstOrFail();

        return new ProductResource($product);
    }
}
