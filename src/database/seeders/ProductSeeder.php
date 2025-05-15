<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    const NUMBER_OF_PRODUCTS = 7;

    public function run(): void
    {
        $faker       = Faker::create();
        $categoryIds = [1, 2, 3, 4];

        foreach ($categoryIds as $categoryId) {
            for ($j = 0; $j <= self::NUMBER_OF_PRODUCTS; $j++) {
                Product::create([
                    'uuid'        => Str::uuid(),
                    'category_id' => $categoryId,
                    'price'       => $faker->numberBetween(1000, 10000),
                    'description' => 'Хороший продукт',
                    'information' => ['description' => 'Хороший товар', 'structure' => ['Хлопок' => 20, 'Полиэстер' => 80]],
                    'name'        => $faker->words(3, true),
                ]);
            }
        }
    }
}
