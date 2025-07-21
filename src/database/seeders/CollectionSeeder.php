<?php

namespace Database\Seeders;

use App\Models\Collection;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CollectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Collection::query()->create([
            'name'          => 'bloody_white_bitch',
            'preview_photo' => 'https://plantacv4hrdpi7j.storage.yandexcloud.net/iblock/318/318c65d787d842f77027f532f7f7ddf7/66a9e0fefc18172cf1ca71d0909cfbae.jpg',
        ]);
    }
}
