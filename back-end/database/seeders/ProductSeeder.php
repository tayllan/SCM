<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $products = [
            ['product_name' => 'Lemonnade - Lemon - 1pk - 100mg THC', 'product_flavor' => 'Lemon', 'brand_name' => 'Lemonnade'],
            ['product_name' => 'Emerald Sky - Wild Berry - 100mg THC', 'product_flavor' => 'Wild Berry', 'brand_name' => 'Emerald Sky'],
            ['product_name' => 'Emerald Sky - Licorice - Ruby Fruits - 50mg THC - 50mg CBD', 'product_flavor' => 'Ruby Fruits', 'brand_name' => 'Emerald Sky'],
            ['product_name' => 'West Coast Cure - Gummies - Wild Blueberry - 100mg THC', 'product_flavor' => 'Wild Blueberry', 'brand_name' => 'West Coast Cure'],
            ['product_name' => 'West Coast Cure - Gummies - Tropical Pineapple - 100mg THC', 'product_flavor' => 'Tropical Pineapple', 'brand_name' => 'West Coast Cure'],
            ['product_name' => 'Emerald Sky - Spicy Chili Mango - 100mg THC', 'product_flavor' => 'Spicy Chili Mango', 'brand_name' => 'Emerald Sky'],
            ['product_name' => 'Garden Society - Calm & Focus - Sparkling Strawberry Rose - 20mg THC - 100mg CBD', 'product_flavor' => 'Sparkling Strawberry Rose', 'brand_name' => 'Garden Society'],
            ['product_name' => 'Garden Society - Brighter Day - Peach Prosecco - 100mg THC', 'product_flavor' => 'Peach Prosecco', 'brand_name' => 'Garden Society'],
            ['product_name' => 'Sticks - Fruit Punch - 1pk - 10mg THC', 'product_flavor' => 'Fruit Punch', 'brand_name' => 'Sticks'],
            ['product_name' => 'Care By Design - Mixed Berry - 5.5mg THC - 100mg CBD', 'product_flavor' => 'Mixed Berry', 'brand_name' => 'Care By Design'],
            ['product_name' => 'Friendly Farms - Sativa - 10pk - 100mg THC', 'product_flavor' => 'Sativa', 'brand_name' => 'Friendly Farms'],
        ];


        foreach ($products as $product) {
            $brand_id = DB::table('brands')
                ->where('brand_name', '=', $product['brand_name'])
                ->select('id')
                ->first()
                ->id;

            unset($product['brand_name']);

            $product['brand_id'] = $brand_id;
            DB::table('products')->insert($product);
        }
    }
}
