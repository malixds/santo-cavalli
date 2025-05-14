<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    const NUMBER_OF_PRODUCTS = 7;

    public function run(): void
    {
        $categoryIds = [1, 2, 3, 4];
        $faker       = Faker::create();

        for ($i = 0; $i < count($categoryIds); $i++) {
            for ($j = 0; $j <= self::NUMBER_OF_PRODUCTS; $j++) {
                Product::query()->create([
                    'category_id' => $categoryIds[$i],
                    'price'       => $faker->numberBetween([1000], [10000]),
                    'description' => 'Хороший продукт',
                    'name'        => $faker->uuid(),
                ]);
            }
        }
    }
}

