<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review;
use App\Models\User;
use App\Models\Hotel;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $hotels = Hotel::all();

        if ($users->isEmpty() || $hotels->isEmpty()) {
            $this->command->info('No users or hotels found. Skipping ReviewSeeder.');
            return;
        }

        foreach ($hotels as $hotel) {
            // Pick 3 distinct random users so we never violate the
            // unique (user_id, hotel_id) constraint on reviews
            $randomUsers = $users->random(min(3, $users->count()));

            foreach ($randomUsers as $index => $user) {
                Review::create([
                    'user_id' => $user->id,
                    'hotel_id' => $hotel->id,
                    'rating' => rand(1, 5),
                    'comment' => 'Sample review comment number ' . ($index + 1),
                ]);
            }
        }
    }
}