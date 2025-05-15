<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::query()->get();

        foreach ($products as $product) {
            ProductImage::query()->create([
                'product_id' => $product->id,
                'urls'       => ['images' => ["/images/123.jpg", "/images/123.jpg", "/images/123.jpg"]],
            ]);
        }
    }
}
