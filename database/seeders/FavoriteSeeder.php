<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Favorite;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FavoriteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::query()->get();
        $books = Book::query()->get();

        if ($users->isEmpty() || $books->isEmpty()) {
            return;
        }

        foreach ($users as $user) {
            $takeCount = min($books->count(), fake()->numberBetween(3, 5));
            $favoriteBookIds = $books->random($takeCount)->pluck('id')->all();

            foreach ($favoriteBookIds as $bookId) {
                $attributes = Favorite::factory()->make([
                    'user_id' => $user->id,
                    'book_id' => $bookId,
                ])->getAttributes();

                // Factoryのmake()にtimestampsが含まれる場合は必要に応じて除外
                unset($attributes['created_at'], $attributes['updated_at']);

                Favorite::firstOrCreate(
                    [
                        'user_id' => $user->id,
                        'book_id' => $bookId,
                    ],
                    $attributes
                );
            }
        }
    }
}
