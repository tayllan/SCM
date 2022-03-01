<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
    public function run()
    {
        $brands = [
            ['brand_name' => 'Lemonnade', 'brand_logo_path' => 'https://picsum.photos/100/100'],
            ['brand_name' => 'Emerald Sky', 'brand_logo_path' => 'https://picsum.photos/100/100'],
            ['brand_name' => 'West Coast Cure', 'brand_logo_path' => 'https://picsum.photos/100/100'],
            ['brand_name' => 'Garden Society', 'brand_logo_path' => 'https://picsum.photos/100/100'],
            ['brand_name' => 'Sticks', 'brand_logo_path' => 'https://picsum.photos/100/100'],
            ['brand_name' => 'Care By Design', 'brand_logo_path' => 'https://picsum.photos/100/100'],
            ['brand_name' => 'Friendly Farms', 'brand_logo_path' => 'https://picsum.photos/100/100'],
        ];

        foreach ($brands as $brand) {
            DB::table('brands')->insert($brand);
        }
    }
}
