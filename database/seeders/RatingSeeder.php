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
        $totalBooks = 100000;
        $targetRatings = 500000;

        $ratings = [];

        // Step 1: Minimal 5 rating per buku
        for ($bookId = 1; $bookId <= $totalBooks; $bookId++) {
            for ($i = 0; $i < 5; $i++) {
                $ratings[] = [
                    'book_id' => $bookId,
                    'rating' => $faker->biasedNumberBetween(3, 9, function ($x) { 
                        return 1 - abs(5 - $x) / 5;
                    }),
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }
            if (count($ratings) >= $batchSize) {
                Rating::insert($ratings);
                $ratings = [];
            }
        }

        // Step 2: Sisa rating acak
        $alreadyInserted = $totalBooks * 5;
        $remaining = $targetRatings - $alreadyInserted;

        for ($i = 0; $i < $remaining; $i++) {
            $ratings[] = [
                'book_id' => rand(1, $totalBooks),
                'rating' => $faker->biasedNumberBetween(1, 10, function ($x) { 
                    return 1 - abs(5 - $x) / 5;
                }),
                'created_at' => now(),
                'updated_at' => now()
            ];
            if (count($ratings) >= $batchSize) {
                Rating::insert($ratings);
                $ratings = [];
            }
        }

        if (!empty($ratings)) {
            Rating::insert($ratings);
        }
    }

}


