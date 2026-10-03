<?php

use App\Http\Controllers\ChatController;
use App\Models\Message;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// 初めましての表示
Route::get('/hello', function (){
    return '初めまして！';
});

// チャット欄一覧
Route::get('/chat', function (){
    
    // Models/Message.phpの中のクラス「Message」を呼びだす（）
    $messages = Message::all();

    // chat.bladeの$messageの中身
    return view('chat', ['talks' => $messages]);
});

// 入力結果をデータベースへ渡す。
Route::post('/chat', [ChatController::class, 'store']);

// 削除処理
Route::delete('/messages/{message}', [ChatController::class, 'destroy']);

// 編集画面
Route::get('/messages/{message}/edit', [ChatController::class, 'edit']);

// 更新処理
Route::patch('/messages/{message}', [ChatController::class, 'update']);

