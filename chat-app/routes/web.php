<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\EnterController;
use App\Http\Controllers\ReactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


// 削除処理
Route::delete('/messages/{message}', [ChatController::class, 'destroy']);

// 編集画面
Route::get('/messages/{message}/edit', [ChatController::class, 'edit']);

// 更新処理
Route::patch('/messages/{message}', [ChatController::class, 'update']);

// ルーム一覧へ移動
Route::get('/rooms',[RoomController::class, 'index']);

// ルームの中を見る
Route::get('/rooms/{room}', [RoomController::class, 'show']);

// 各ルームの作成
Route::post('/rooms/{room}', [ChatController::class, 'store']);

// チャット欄の入り口
Route::get('/enter', [EnterController::class, 'show']);

// ニックネームでログイン
Route::post('/enter', [EnterController::class, 'store']);

// リアクションを付ける・外す
Route::post('/messages/{message}/reactions', [ReactionController::class, 'store']);
