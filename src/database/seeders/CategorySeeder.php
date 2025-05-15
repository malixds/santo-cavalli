<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = ['t-shirts', 'hoodies', 'jackets', 'bags'];

        foreach ($categories as $name) {
            Category::query()->create(['name' => $name]);
        }
    }
}
