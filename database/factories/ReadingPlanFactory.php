<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\ReadingPlan;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ReadingPlan>
 */
class ReadingPlanFactory extends Factory
{
    protected $model = ReadingPlan::class;
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::query()->inRandomOrder()->first()?->id ?? User::factory(),
            'book_id' => Book::query()->inRandomOrder()->first()?->id ?? Book::factory(),
            'due_date' => fake()->dateTimeBetween('+1 week', '+1 month')->format('Y-m-d'),
            'status' => fake()->randomElement(['in_progress', 'overdue', 'completed']),
            'completed_at' => null,
        ];
    }
}
