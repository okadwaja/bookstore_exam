<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Faker\Factory as Faker;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        $categories = [];
        for ($i = 0; $i < 3000; $i++) {
            $categories[] = ['name' => $faker->word, 'created_at' => now(), 'updated_at' => now()];
        }

        Category::insert($categories);
    }
}

