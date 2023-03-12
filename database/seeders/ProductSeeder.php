<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
//        make some products for testing
        $products = [
            [
                "name" => "Jersey Menchester United",
                "price" => 100000,
                "description" => "Jersey Manchester United 2020/2021",
                "photo" => "jersey mu.jpg",
                "stock" => 10,
                "size" => "M"
            ],
            [
                "name" => "Jersey Liverpool",
                "price" => 120000,
                "description" => "Jersey Liverpool 2020/2021",
                "photo" => "jersey liverpool.jpg",
                "stock" => 6,
                "size" => "L"
            ],
            [
                "name" => "Jersey Menchester United",
                "price" => 150000,
                "description" => "Jersey Menchester United 2020/2021",
                "photo" => "jersey mu.jpg",
                "stock" => 3,
                "size" => "XL"
            ],
        ];

        foreach($products as $product) {
            Product::create($product);
        }
    }
}
