<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::query()->get();
        $books = Book::query()->orderBy('id')->get();

        if ($users->isEmpty() || $books->isEmpty()) {
            return;
        }

        // 11冊に2〜4件ずつ配分して合計32件にする
        $countsPerBook = [3, 4, 3, 2, 3, 4, 3, 3, 2, 3, 2];

        $comments = [
            '読み応えがあり、日々の考え方を整理するのにとても参考になりました',
            '具体例が多くて理解しやすく、仕事や学習にすぐ活かせる内容でした',
            'テンポよく読めて最後まで引き込まれました。何度も読み返したい一冊です',
            '本質的な視点が得られ、自分の課題が明確になったと感じています',
            '少し難しそうなテーマでも丁寧に噛み砕かれていて読みやすかったです',
        ];

        $userIndex = 0;
        $commentIndex = 0;

        foreach ($books as $bookIndex => $book) {
            $count = $countsPerBook[$bookIndex] ?? 2;

            for ($i = 0; $i < $count; $i++) {
                $user = $users[$userIndex % $users->count()];
                $comment = $comments[$commentIndex % count($comments)];

                Review::factory()->create([
                    'user_id' => $user->id,
                    'book_id' => $book->id,
                    'rating' => fake()->numberBetween(3, 5),
                    'comment' => $comment,
                ]);

                $userIndex++;
                $commentIndex++;
            }
        }
    }
}
