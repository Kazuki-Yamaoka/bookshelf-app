<?php

namespace Database\Seeders;

use App\Models\Review;
use App\Models\ReviewLike;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReviewLikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::query()->get();
        $reviews = Review::query()->get();

        if ($users->isEmpty() || $reviews->isEmpty()) {
            return;
        }

        foreach ($reviews as $review) {
            // 自分のレビュー投稿者を除外したユーザーから0〜3人を選択
            $eligibleUsers = $users->where('id', '!=', $review->user_id);
            $likeCount = min($eligibleUsers->count(), fake()->numberBetween(0, 3));

            if ($likeCount === 0) {
                continue;
            }

            $likedUserIds = $eligibleUsers->random($likeCount)->pluck('id')->all();

            foreach ($likedUserIds as $userId) {
                $attributes = ReviewLike::factory()->make([
                    'user_id' => $userId,
                    'review_id' => $review->id,
                ])->getAttributes();

                ReviewLike::firstOrCreate(
                    ['user_id' => $userId, 'review_id' => $review->id],
                    $attributes
                );
            }
        }
    }
}
