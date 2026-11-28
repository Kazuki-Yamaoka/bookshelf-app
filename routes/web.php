<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// 仮ルート（後で本実装に置き換え）
Route::middleware('auth')->group(function () {
	Route::get('/', fn() => '書籍一覧画面（準備中）')->name('books.index');
	Route::get('/books', fn() => '書籍一覧画面（準備中）')->name('books.index');
    Route::get('/genres', fn() => 'ジャンル一覧画面（準備中）')->name('genres.index');
    Route::get('/reviews/{review}/edit', fn() => 'レビュー編集画面（準備中）')->name('reviews.index');
    Route::get('/favorites', fn() => 'お気に入り一覧画面（準備中）')->name('favorites.index');
    Route::get('/ranking', fn() => 'ランキング画面（準備中）')->name('ranking.index');
    Route::get('/reports', fn() => ' マイ読書レポート画面（準備中）')->name('reports.index');
    Route::get('/reading-plans', fn() => '読書計画一覧画面（準備中）')->name('reading-plans.index');
    Route::get('/notifications', fn() => '通知一覧画面（準備中）')->name('notifications.index');
});