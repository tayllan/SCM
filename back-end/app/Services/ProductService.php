<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Collection;

class ProductService
{
    public function get_products(): Collection
    {
        $products = Product::join('brands', 'products.brand_id', '=', 'brands.id')
            ->get([
                'products.id AS product_id',
                'products.product_name',
                'products.product_flavor',
                'products.price',
                'brands.brand_name',
                'brands.brand_logo_path',
            ]);

        return $products;
    }

    public function get_product(int $product_id)
    {
        $product = Product::join('brands', 'products.brand_id', '=', 'brands.id')
            ->where('products.id', '=', $product_id)
            ->get([
                'products.id',
                'products.product_name',
                'products.product_flavor',
                'brands.brand_name',
                'brands.brand_logo_path'
            ])
            ->firstOrFail();

        return $product;
    }
}