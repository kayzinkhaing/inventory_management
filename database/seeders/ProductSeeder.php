<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'iPhone 14',
                'code' => 'IPH14',
                'category_id' => 1,
                'brand_id' => 2,
                'price' => 2100000, 
                'quantity' => 50,
                'description' => 'Latest iPhone model.',
                'image' => 'products/iphone14.jpg',
            ],
            [
                'name' => 'Galaxy S23',
                'code' => 'GALS23',
                'category_id' => 1,
                'brand_id' => 1,
                'price' => 1900000, 
                'quantity' => 40,
                'description' => 'Samsung flagship smartphone.',
                'image' => 'products/galaxy_s23.jpg',
            ],
            [
                'name' => 'Nike Air Max',
                'code' => 'NIKAMAX',
                'category_id' => 3,
                'brand_id' => 3,
                'price' => 280000, 
                'quantity' => 100,
                'description' => 'Comfortable running shoes.',
                'image' => 'products/nike_air_max.jpg',
            ],
            [
                'name' => 'Samsung Galaxy Tab',
                'code' => 'GALAXYTAB',
                'category_id' => 1,
                'brand_id' => 1,
                'price' => 1050000, 
                'quantity' => 30,
                'description' => 'High-performance tablet.',
                'image' => 'products/galaxy_tab.jpg',
            ],
            [
                'name' => 'The Great Gatsby',
                'code' => 'GATSBY',
                'category_id' => 2,
                'brand_id' => null,
                'price' => 23000, 
                'quantity' => 200,
                'description' => 'Classic novel by F. Scott Fitzgerald.',
                'image' => 'products/gatsby.jpg',
            ],
        ];

        foreach ($products as $item) {
            $imagePath = $item['image'];
            unset($item['image']);

            $product = Product::create($item);

            $product->images()->create([
                'url' => $imagePath,
            ]);
        }
    }
}
