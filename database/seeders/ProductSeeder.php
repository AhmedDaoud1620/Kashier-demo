<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'name' => 'Product 1',
                'description' => 'An itsy-bitsy Description for Product 1',
                'price' => 1500.00,
                'image' => 'https://images.pexels.com/photos/2783873/pexels-photo-2783873.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Product 2',
                'description' => 'An itsy-bitsy Description for Product 2',
                'price' => 1200.99,
                'image' => 'https://images.pexels.com/photos/376464/pexels-photo-376464.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Product 3',
                'description' => 'An itsy-bitsy Description for Product 3',
                'price' => 300.50,
                'image' => 'https://images.pexels.com/photos/3587478/pexels-photo-3587478.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Product 4',
                'description' => 'An itsy-bitsy Description for Product 4',
                'price' => 3000.00,
                'image' => 'https://images.pexels.com/photos/6634651/pexels-photo-6634651.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Product 5',
                'description' => 'An itsy-bitsy Description for Product 5',
                'price' => 2000.00,
                'image' => 'https://images.pexels.com/photos/6412835/pexels-photo-6412835.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Product 6',
                'description' => 'An itsy-bitsy Description for Product 6',
                'price' => 2500.00,
                'image' => 'https://images.pexels.com/photos/6187595/pexels-photo-6187595.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Product 7',
                'description' => 'An itsy-bitsy Description for Product 7',
                'price' => 1620.20,
                'image' => 'https://images.pexels.com/photos/90946/pexels-photo-90946.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Product 8',
                'description' => 'An itsy-bitsy Description for Product 8',
                'price' => 5500.00,
                'image' => 'https://images.pexels.com/photos/4158/apple-iphone-smartphone-desk.jpg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($products as $productData) {
            Product::create($productData);
        }
    }
}
