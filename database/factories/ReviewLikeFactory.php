<?php

namespace Database\Factories;

use App\Models\Review;
use App\Models\ReviewLike;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ReviewLike>
 */
class ReviewLikeFactory extends Factory
{
    protected $model = ReviewLike::class;
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::query()->inRandomOrder()->first()?->id ?? User::factory(),
            'review_id' => Review::query()->inRandomOrder()->first()?->id ?? Review::factory(),
        ];
    }
}
