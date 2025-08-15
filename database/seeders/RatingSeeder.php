<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rating;
use Faker\Factory as Faker;

class RatingSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();
        $batchSize = 1000;
        $total = 500000;

        $ratings = [];

        for ($i = 1; $i <= $total; $i++) {
            $ratings[] = [
                'book_id' => rand(1, 100000),
                'rating' => rand(1, 10),
                'created_at' => now(),
                'updated_at' => now()
            ];

            if ($i % $batchSize === 0) {
                Rating::insert($ratings);
                $ratings = [];
            }
        }

        if (!empty($ratings)) {
            Rating::insert($ratings);
        }
    }
}


