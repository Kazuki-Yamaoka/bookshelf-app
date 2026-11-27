<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Genre;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $owner = User::query()->first();
        $genres = Genre::query()->pluck('id', 'name');

        $books = [
            [
                'number' => 1,
                'title' => '吾輩は猫である',
                'author' => '夏目漱石',
                'isbn' => '9784101010014',
                'published_date' => '1905-01-01',
                'description' => '猫の視点から人間社会の滑稽さや世相を風刺した明治期の代表作',
                'genres' => ['小説'],
            ],
            [
                'number' => 2,
                'title' => '人を動かす',
                'author' => 'D・カーネギー',
                'isbn' => '9784422100524',
                'published_date' => '1936-10-01',
                'description' => '人間関係やコミュニケーションの本質を実践的な原則でまとめたロングセラー',
                'genres' => ['ビジネス', '自己啓発'],
            ],
            [
                'number' => 3,
                'title' => 'リーダブルコード',
                'author' => 'Dustin Boswell',
                'isbn' => '9784873115658',
                'published_date' => '2012-06-23',
                'description' => '日々の開発で読みやすく保守しやすいコードを書くための具体的なテクニック集',
                'genres' => ['技術書'],
            ],
            [
                'number' => 4,
                'title' => '7つの習慣',
                'author' => 'スティーブン・R・コヴィー',
                'isbn' => '9784863940246',
                'published_date' => '2013-08-30',
                'description' => '主体性や目的意識を軸に人格と成果を高めるための普遍的な習慣を解説',
                'genres' => ['ビジネス', '自己啓発'],
            ],
            [
                'number' => 5,
                'title' => '坊っちゃん',
                'author' => '夏目漱石',
                'isbn' => '9784101010021',
                'published_date' => '1906-04-01',
                'description' => '正義感の強い若き教師が四国の中学校で巻き起こす痛快な青春小説',
                'genres' => ['小説'],
            ],
            [
                'number' => 6,
                'title' => 'サピエンス全史',
                'author' => 'ユヴァル・ノア・ハラリ',
                'isbn' => '9784309226712',
                'published_date' => '2016-09-08',
                'description' => '認知革命から科学革命まで人類の歴史を大きな視点から描き出した一冊',
                'genres' => ['歴史', '科学'],
            ],
            [
                'number' => 7,
                'title' => 'Clean Code',
                'author' => 'Robert C. Martin',
                'isbn' => '9784048930598',
                'published_date' => '2017-12-18',
                'description' => '変更に強く理解しやすいソフトウェア設計とリファクタリングの指針',
                'genres' => ['技術書'],
            ],
            [
                'number' => 8,
                'title' => '嫌われる勇気',
                'author' => '岸見一郎・古賀史健',
                'isbn' => '9784478025819',
                'published_date' => '2013-12-13',
                'description' => 'アドラー心理学の思想を青年と哲人の対話形式で分かりやすく紐解く対話篇',
                'genres' => ['自己啓発'],
            ],
            [
                'number' => 9,
                'title' => '火花',
                'author' => '又吉直樹',
                'isbn' => '9784163902302',
                'published_date' => '2015-03-11',
                'description' => '売れないお笑い芸人の葛藤と師弟関係を描いた芥川賞受賞作',
                'genres' => ['小説'],
            ],
            [
                'number' => 10,
                'title' => 'FACTFULNESS',
                'author' => 'ハンス・ロスリング',
                'isbn' => '9784822289607',
                'published_date' => '2019-01-11',
                'description' => '思い込みや本能による誤解を解きデータに基づいて世界を捉える思考法',
                'genres' => ['ビジネス', '科学'],
            ],
            [
                'number' => 11,
                'title' => 'コンテナ物語',
                'author' => 'マルク・レビンソン',
                'isbn' => '9784822251468',
                'published_date' => '2007-01-18',
                'description' => '輸送コンテナの普及がグローバル経済と物流構造をどう変えたかを追うノンフィクション',
                'genres' => ['ビジネス', '歴史'],
            ],
        ];

        foreach ($books as $bookData) {
            $attributes = Book::factory()->make([
                'title' => $bookData['title'],
                'author' => $bookData['author'],
                'isbn' => $bookData['isbn'],
                'published_date' => $bookData['published_date'],
                'description' => $bookData['description'],
                'image_url' => "https://placehold.co/200x300/e2e8f0/475569?text={$bookData['number']}",
                'user_id' => $owner?->id,
            ])->getAttributes();

            $book = Book::firstOrCreate(
                ['isbn' => $bookData['isbn']],
                $attributes
            );

            $genreIds = collect($bookData['genres'])
                ->map(fn (string $name) => $genres[$name] ?? null)
                ->filter()
                ->values()
                ->all();

            $book->genres()->sync($genreIds);
        }
    }
}
