<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    const USER_COUNT = 7;

    public function run(): void
    {
        $faker = Faker::create();
        for ($i = 0; $i <= 7; $i++) {
            User::query()->create([
                'token' => Str::uuid(),
                'first_name' => $faker->firstName('male'),
                'last_name' => $faker->lastName(),
                'phone' => $faker->phoneNumber(),
            ]);
        }
    }
}
