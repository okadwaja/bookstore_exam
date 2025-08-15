<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;
use Faker\Factory as Faker;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();
        $batchSize = 5000;
        $total = 100000;

        $books = [];

        for ($i = 1; $i <= $total; $i++) {
            $books[] = [
                'author_id' => rand(1, 1000),
                'category_id' => rand(1, 3000),
                'title' => $faker->sentence(3),
                'created_at' => now(),
                'updated_at' => now()
            ];

            if ($i % $batchSize === 0) {
                Book::insert($books);
                $books = [];
            }
        }

        if (!empty($books)) {
            Book::insert($books);
        }
    }
}


